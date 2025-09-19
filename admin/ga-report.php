<?php
// ga-report.php
// Returns JSON for the dashboard by querying GA4 Data API.
// REQUIREMENTS (composer):
//   composer require google/analytics-data
//
// IMPORTANT: Set your credentials & property ID:
//   1) Put your service-account JSON at:  /secure/ga4-key.json  (or anywhere safe)
//   2) Share that service account email with your GA4 Property (Read & Analyze).
//   3) Set $propertyId to your GA4 property numeric ID (NOT the G- tag).

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\OrderBy;

header('Content-Type: application/json');

require __DIR__ . '/vendor/autoload.php';

$keyFilePath = __DIR__ . '/secure/ga4-key.json';  // TODO: change if needed
$propertyId  = 'YOUR_GA4_PROPERTY_ID';            // TODO: e.g. 123456789

// If credentials/property not set, return demo data so UI doesn't break
function demo_out(){
  echo json_encode([
    "cards" => [
      "sessions" => 6732,
      "avgDuration" => 205,        // seconds (3m25s)
      "calls" => 132,
      "emails" => 84,
      // optional fillers for top strip
      "needsAttention" => 1,
      "overdue" => 2
    ],
    "timeseries" => [
      "labels" => ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
      "values" => [1200, 1900, 1700, 2200, 2500, 1800, 2100]
    ],
    "sources" => [
      "labels" => ['Organic','Direct','Referral','Social'],
      "values" => [55,25,15,5]
    ],
    "topPages" => [
      ["path"=>"/aircrafts","views"=>4322],
      ["path"=>"/engines","views"=>2145],
      ["path"=>"/vendors","views"=>1833],
      ["path"=>"/parts","views"=>1221],
      ["path"=>"/contact","views"=>845],
    ],
    "demo" => true
  ]);
  exit;
}

if (!is_file($keyFilePath) || $propertyId === 'YOUR_GA4_PROPERTY_ID') {
  demo_out();
}

try {
  $client = new BetaAnalyticsDataClient([
    'credentials' => $keyFilePath,
  ]);

  $last7 = new DateRange(['start_date' => '7daysAgo', 'end_date' => 'today']);

  // 1) KPI: sessions + avgSessionDuration
  $kpiResp = $client->runReport([
    'property' => 'properties/' . $propertyId,
    'dateRanges' => [$last7],
    'metrics' => [
      new Metric(['name' => 'sessions']),
      new Metric(['name' => 'averageSessionDuration']),
    ],
  ]);

  $sessions = (int)($kpiResp->getRows()[0]->getMetricValues()[0]->getValue() ?? 0);
  $avgDuration = (float)($kpiResp->getRows()[0]->getMetricValues()[1]->getValue() ?? 0);

  // 2) Events: calls/emails (assumes custom events "call_click" & "email_click")
  $eventsResp = $client->runReport([
    'property' => 'properties/' . $propertyId,
    'dateRanges' => [$last7],
    'dimensions' => [new Dimension(['name' => 'eventName'])],
    'metrics' => [new Metric(['name' => 'eventCount'])],
  ]);
  $calls = 0; $emails = 0;
  foreach ($eventsResp->getRows() as $r) {
    $ev = $r->getDimensionValues()[0]->getValue();
    $ct = (int)$r->getMetricValues()[0]->getValue();
    if ($ev === 'call_click')  $calls  = $ct;
    if ($ev === 'email_click') $emails = $ct;
  }

  // 3) Time series (sessions by date)
  $tsResp = $client->runReport([
    'property' => 'properties/' . $propertyId,
    'dateRanges' => [$last7],
    'dimensions' => [new Dimension(['name' => 'date'])],
    'metrics' => [new Metric(['name' => 'sessions'])],
    'orderBys' => [ new OrderBy([
      'dimension' => new OrderBy\DimensionOrderBy(['dimensionName' => 'date']),
      'desc' => false
    ])]
  ]);
  $tsLabels = []; $tsValues = [];
  foreach ($tsResp->getRows() as $row) {
    $d = $row->getDimensionValues()[0]->getValue(); // YYYYMMDD
    $tsLabels[] = substr($d,4,2) . '/' . substr($d,6,2); // MM/DD
    $tsValues[] = (int)$row->getMetricValues()[0]->getValue();
  }

  // 4) Sources (sessionDefaultChannelGroup)
  $srcResp = $client->runReport([
    'property' => 'properties/' . $propertyId,
    'dateRanges' => [$last7],
    'dimensions' => [ new Dimension(['name' => 'sessionDefaultChannelGroup']) ],
    'metrics' => [ new Metric(['name' => 'sessions']) ],
    'orderBys' => [ new OrderBy([
      'metric' => new OrderBy\MetricOrderBy(['metricName' => 'sessions']),
      'desc' => true
    ])],
    'limit' => 6
  ]);
  $srcLabels=[]; $srcValues=[];
  foreach ($srcResp->getRows() as $r) {
    $srcLabels[] = $r->getDimensionValues()[0]->getValue();
    $srcValues[] = (int)$r->getMetricValues()[0]->getValue();
  }

  // 5) Top pages
  $pagesResp = $client->runReport([
    'property' => 'properties/' . $propertyId,
    'dateRanges' => [$last7],
    'dimensions' => [ new Dimension(['name' => 'pagePath']) ],
    'metrics' => [ new Metric(['name' => 'screenPageViews']) ],
    'orderBys' => [ new OrderBy([
      'metric' => new OrderBy\MetricOrderBy(['metricName' => 'screenPageViews']),
      'desc' => true
    ])],
    'limit' => 5
  ]);
  $topPages=[];
  foreach ($pagesResp->getRows() as $r) {
    $topPages[] = [
      'path' => $r->getDimensionValues()[0]->getValue(),
      'views'=> (int)$r->getMetricValues()[0]->getValue()
    ];
  }

  echo json_encode([
    "cards" => [
      "sessions" => $sessions,
      "avgDuration" => $avgDuration,
      "calls" => $calls,
      "emails" => $emails,
      // you can compute these two from your DB if you like
      "needsAttention" => 1,
      "overdue" => 2
    ],
    "timeseries" => [ "labels"=>$tsLabels, "values"=>$tsValues ],
    "sources" =>   [ "labels"=>$srcLabels, "values"=>$srcValues ],
    "topPages" =>  $topPages,
    "demo" => false
  ]);
} catch (\Throwable $e) {
  // If GA fails (bad creds, etc.) return demo data so page still works
  demo_out();
}
