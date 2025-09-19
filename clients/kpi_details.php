<?php
session_start();
require_once "config.php";      // $pdo
require_once "header.php";
if (!isset($_SESSION['vendor_id'])) exit;

$id = (int)($_GET['id'] ?? 0);
if (!$id)  exit("Invalid ID");

// اصل ائیرکرافٹ
$stmt = $pdo->prepare("SELECT * FROM aircrafts WHERE aircraft_id=?");
$stmt->execute([$id]);
$ac = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$ac) exit("Listing not found");

// ──► فنکشن: دیے گئے ماڈل کیلئے اعدادوشمار
function fetchStats(PDO $pdo, string $model): array {
    $sql = "SELECT
              AVG(price)              AS avg_price,
              MIN(price)              AS min_price,
              MAX(price)              AS max_price,
              AVG(year)               AS avg_year,
              MIN(year)               AS min_year,
              MAX(year)               AS max_year,
              AVG(total_time_hours)   AS avg_hours,
              MIN(total_time_hours)   AS min_hours,
              MAX(total_time_hours)   AS max_hours
            FROM aircrafts
            WHERE model = ?";
    $q = $pdo->prepare($sql);
    $q->execute([$model]);
    return $q->fetch(PDO::FETCH_ASSOC) ?: [];
}

$stats = fetchStats($pdo, $ac['model']);
?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="kpi-container">
  
  <?php
    $metrics = [
      'price' => ['label'=>'Price', 'value'=>$ac['price'], 'avg'=>$stats['avg_price'],
                  'min'=>$stats['min_price'], 'max'=>$stats['max_price']],
      'year'  => ['label'=>'Year',  'value'=>$ac['year'],  'avg'=>$stats['avg_year'],
                  'min'=>$stats['min_year'],  'max'=>$stats['max_year']],
      'hours' => ['label'=>'Hours', 'value'=>$ac['total_time_hours'],'avg'=>$stats['avg_hours'],
                  'min'=>$stats['min_hours'], 'max'=>$stats['max_hours']]
    ];
  ?>

  <?php foreach ($metrics as $key => $m): ?>
    <div class="kpi-block">
      <canvas id="<?= $key ?>Chart"></canvas>
      <p><?= $m['label'] ?> <br>
         <strong>You:</strong> <?= number_format($m['value']) ?> &nbsp;|&nbsp;
         <strong>Avg:</strong> <?= number_format($m['avg']) ?>
      </p>
    </div>
  <?php endforeach; ?>
</div>


  </div>
</div>
<?php include "footer.php"; ?>
<style>
.kpi-container{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1.5rem;margin-top:2rem}
.kpi-block{text-align:center;padding:1rem;border:1px solid #eee;border-radius:.75rem}
.kpi-block canvas{max-width:220px;margin:auto}
</style>

<script>
<?php foreach ($metrics as $key => $m): ?>
(() => {
    const ctx = document.getElementById('<?= $key ?>Chart').getContext('2d');
    const diffBelow = Math.max(0, <?= $m['value'] ?> - <?= $m['min'] ?>);
    const diffAbove = Math.max(0, <?= $m['max'] ?> - <?= $m['value'] ?>);
    new Chart(ctx, {
      type:'doughnut',
      data:{
        labels:['Below','You','Above'],
        datasets:[{data:[diffBelow,1,diffAbove],borderWidth:0}]
      },
      options:{cutout:'74%',plugins:{legend:{display:false}},rotation:-90,circumference:180}
    });
})();
<?php endforeach; ?>
</script>
