<?php 
session_start();
include "header.php";
include "config.php";

// Redirect to login page if user is not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>KPI Dashboard</title>

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Tailwind (utility classes) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>

  <!-- GA tag (tracking only) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-V5JJXEWQ6S"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-V5JJXEWQ6S'); // your measurement ID
  </script>

  <style>
    :root{
      --bg:#f5f7fb; --card:#ffffff; --border:#e9edf4; --text:#0f172a; --muted:#6b7280;
      --radius:16px;
    }
    body{ background:var(--bg); font-family:Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;}
    .soft-card{
      background:var(--card); border:1px solid var(--border); border-radius:var(--radius);
      box-shadow: 0 2px 10px rgba(15,23,42,.04);
    }
    .soft-card:hover{ box-shadow:0 6px 18px rgba(15,23,42,.08); }
    .mini{ padding:16px; }
    .mini h6{ color:var(--muted); font-weight:600; letter-spacing:.2px; }
    .mini .num{ font-weight:700; font-size:20px; margin:6px 0 0; }
    .section-title{ font-weight:700; font-size:18px; color:var(--text); }
    .divider{ height:1px; background:var(--border); margin:12px 0 16px;}
    .pill{ padding:4px 10px; border-radius:999px; font-size:12px; font-weight:600; }
    .btn-ghost{ border:1px solid var(--border); background:#fff; }
    .empty{
      border:2px dashed var(--border); border-radius:var(--radius);
      display:flex; align-items:center; justify-content:center; min-height:220px; color:var(--muted);
    }
    .list-row{ display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid var(--border);}
    .list-row:last-child{ border-bottom:0;}
    .circle{
      width:36px; height:36px; border-radius:50%; display:grid; place-items:center;
      background:#eef2ff; color:#4f46e5;
    }
    .progress-bar-slim{
      height:8px; background:#eef2f7; border-radius:999px; overflow:hidden;
    }
    .progress-bar-slim > span{ display:block; height:100%; border-radius:999px; }
    .table-xs th, .table-xs td{ padding:.55rem .75rem; vertical-align:middle;}
    .skeleton{ background:linear-gradient(90deg,#f0f3f8, #e9eef6, #f0f3f8); background-size:200% 100%; animation:shimmer 1.2s infinite; border-radius:8px; }
    @keyframes shimmer{ 0%{background-position:200% 0} 100%{background-position:-200% 0} }
  </style>
</head>
<body>

  <div class="container-fluid p-4 p-lg-5">

    <!-- Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
      <div>
        <h2 class="fw-bold mb-1">Admin KpI  <span class="text-muted">Dashboard</span></h2>
        <div class="text-muted">Analytics & marketplace overview</div>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-ghost btn-sm"><i class="bi bi-gear me-1"></i> Settings</button>
        <button class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Add to dashboard</button>
      </div>
    </div>

    <!-- TOP STRIP of small KPI cards (like your screenshot) -->
    <div class="row g-3 mb-4">
      <div class="col-6 col-md-3 col-xl-2">
        <div class="soft-card mini h-100">
          <div class="d-flex align-items-center gap-2"><i class="bi bi-exclamation-circle text-danger"></i><h6 class="mb-0">Total Page Visits</h6></div>
          <div class="num" id="kpi-needs">—</div>
        </div>
      </div>
      <div class="col-6 col-md-3 col-xl-2">
        <div class="soft-card mini h-100">
          <div class="d-flex align-items-center gap-2"><i class="bi bi-alarm text-warning"></i><h6 class="mb-0">Total click</h6></div>
          <div class="num" id="kpi-overdue">—</div>
        </div>
      </div>
      <div class="col-6 col-md-3 col-xl-2">
        <div class="soft-card mini h-100">
          <div class="d-flex align-items-center gap-2"><i class="bi bi-graph-up text-primary"></i><h6 class="mb-0">Sessions</h6></div>
          <div class="num text-primary" id="kpi-sessions">—</div>
        </div>
      </div>
      <div class="col-6 col-md-3 col-xl-2">
        <div class="soft-card mini h-100">
          <div class="d-flex align-items-center gap-2"><i class="bi bi-stopwatch text-success"></i><h6 class="mb-0">Avg. time</h6></div>
          <div class="num text-success" id="kpi-avgtime">—</div>
        </div>
      </div>
      <div class="col-6 col-md-3 col-xl-2">
        <div class="soft-card mini h-100">
          <div class="d-flex align-items-center gap-2"><i class="bi bi-telephone text-danger"></i><h6 class="mb-0">Calls</h6></div>
          <div class="num text-danger" id="kpi-calls">—</div>
        </div>
      </div>
      <div class="col-6 col-md-3 col-xl-2">
        <div class="soft-card mini h-100">
          <div class="d-flex align-items-center gap-2"><i class="bi bi-envelope-open text-indigo-600"></i><h6 class="mb-0">Emails</h6></div>
          <div class="num text-indigo-600" id="kpi-emails">—</div>
        </div>
      </div>
    </div>

    <!-- MAIN GRID -->
    <div class="row g-4">

      <!-- LEFT COLUMN -->
      <div class="col-lg-6 col-12">

        <!-- Active Aircraft (static sample list) -->
        <div class="soft-card p-3 p-lg-4 mb-4">
          <div class="d-flex align-items-center justify-content-between">
            <div class="section-title">My active aircraft</div>
            <span class="pill bg-success-subtle text-success">In progress</span>
          </div>
          <div class="divider"></div>

          <div class="list-row">
            <div class="circle"><i class="bi bi-airplane-fill"></i></div>
            <div class="flex-grow-1">
              <div class="fw-semibold">Cessna 172 · Client A</div>
              <div class="text-muted small">Training category</div>
            </div>
            <div class="w-25">
              <div class="progress-bar-slim"><span style="width:62%; background:#ef4444"></span></div>
            </div>
            <div class="text-muted small">08/09</div>
          </div>

          <div class="list-row">
            <div class="circle" style="background:#ecfeff;color:#06b6d4"><i class="bi bi-airplane"></i></div>
            <div class="flex-grow-1">
              <div class="fw-semibold">Retainer Fleet · Client A</div>
              <div class="text-muted small">Fleet marketing</div>
            </div>
            <div class="w-25">
              <div class="progress-bar-slim"><span style="width:78%; background:#f59e0b"></span></div>
            </div>
            <div class="text-muted small">28/02/2025</div>
          </div>

          <div class="list-row">
            <div class="circle" style="background:#fefce8;color:#ca8a04"><i class="bi bi-airplane-engines"></i></div>
            <div class="flex-grow-1">
              <div class="fw-semibold">Time & Material · Client B</div>
              <div class="text-muted small">Refurb project</div>
            </div>
            <div class="w-25">
              <div class="progress-bar-slim"><span style="width:41%; background:#22c55e"></span></div>
            </div>
            <div class="text-muted small">16/09</div>
          </div>
        </div>

        <!-- Team hours logged (we’ll reuse GA timeseries as bars) -->
        <div class="soft-card p-3 p-lg-4">
          <div class="section-title mb-2">Visits by day (last 7)</div>
          <div class="text-muted small mb-3">From Google Analytics</div>
          <div class="px-1">
            <canvas id="barVisits" height="160"></canvas>
          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN -->
      <div class="col-lg-6 col-12">

        <!-- GA: Sessions trend + Sources + Top pages (mirroring your screenshot layout) -->
        <div class="soft-card p-3 p-lg-4 mb-4">
          <div class="d-flex align-items-center justify-content-between">
            <div class="section-title">Sessions trend</div>
            <div class="text-muted small" id="date-range">Last 7 days</div>
          </div>
          <div class="divider"></div>
          <canvas id="lineSessions" height="110"></canvas>
        </div>

        <div class="soft-card p-3 p-lg-4 mb-4">
          <div class="section-title">Traffic sources</div>
          <div class="divider"></div>
          <canvas id="doughnutSources" height="180"></canvas>
        </div>

        <div class="soft-card p-3 p-lg-4">
          <div class="d-flex align-items-center justify-content-between">
            <div class="section-title">Top pages</div>
            <a class="btn btn-ghost btn-sm" id="btnMorePages"><i class="bi bi-box-arrow-up-right me-1"></i>View in GA</a>
          </div>
          <div class="divider"></div>
          <div id="topPagesWrap">
            <!-- skeleton while loading -->
            <div class="skeleton" style="height:36px;margin-bottom:10px;"></div>
            <div class="skeleton" style="height:36px;margin-bottom:10px;"></div>
            <div class="skeleton" style="height:36px;margin-bottom:10px;"></div>
          </div>
        </div>

      </div>
    </div>

    <!-- AIRCRAFT MARKET (static for now) -->
    <div class="row g-4 mt-1">
      <div class="col-12">
        <div class="soft-card p-3 p-lg-4">
          <div class="section-title mb-2">Aircraft market insights</div>
          <div class="text-muted small">Static examples (your scrapers/DB can replace these).</div>
          <div class="divider"></div>
          <div class="row g-3">
            <div class="col-md-4">
              <div class="soft-card mini">
                <div class="d-flex justify-content-between">
                  <div class="fw-semibold">Cessna 172</div><span class="pill bg-primary-subtle text-primary">45 on market</span>
                </div>
                <div class="text-muted small mt-2">Avg price</div>
                <div class="fw-bold">$180,000</div>
                <div class="text-muted small">Avg hours · <b>4,200</b></div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="soft-card mini">
                <div class="d-flex justify-content-between">
                  <div class="fw-semibold">Boeing 737</div><span class="pill bg-primary-subtle text-primary">12 on market</span>
                </div>
                <div class="text-muted small mt-2">Avg price</div>
                <div class="fw-bold">$42,000,000</div>
                <div class="text-muted small">Avg hours · <b>16,000</b></div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="soft-card mini">
                <div class="d-flex justify-content-between">
                  <div class="fw-semibold">Piper PA-28</div><span class="pill bg-primary-subtle text-primary">28 on market</span>
                </div>
                <div class="text-muted small mt-2">Avg price</div>
                <div class="fw-bold">$95,000</div>
                <div class="text-muted small">Avg hours · <b>3,500</b></div>
              </div>
            </div>
          </div>
          <div class="text-end mt-2">
            <a href="all-aircraft-types.php" class="btn btn-sm btn-primary">View all types</a>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /container -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Globals for charts
    let sessionsLine, sourcesDoughnut, visitsBar;

    function fmtNumber(x){ return x?.toLocaleString?.() ?? x; }
    function fmtDuration(sec){
      if(!sec && sec !== 0) return "—";
      const m = Math.floor(sec/60), s = Math.round(sec%60);
      return `${m}m ${s}s`;
    }

    async function loadGA(){
      try{
        const res = await fetch('ga-report.php');
        const data = await res.json();

        // ---- KPI cards ----
        document.getElementById('kpi-sessions').textContent = fmtNumber(data.cards.sessions);
        document.getElementById('kpi-avgtime').textContent  = fmtDuration(data.cards.avgDuration);
        document.getElementById('kpi-calls').textContent    = fmtNumber(data.cards.calls);
        document.getElementById('kpi-emails').textContent   = fmtNumber(data.cards.emails);

        // Optional sample fill for “needs attention / overdue” (replace with your own logic)
        document.getElementById('kpi-needs').textContent    = data.cards.needsAttention ?? 1;
        document.getElementById('kpi-overdue').textContent  = data.cards.overdue ?? 2;

        // ---- Sessions Line ----
        const labels = data.timeseries.labels;
        const values = data.timeseries.values;
        if(sessionsLine) sessionsLine.destroy();
        sessionsLine = new Chart(document.getElementById('lineSessions'), {
          type:'line',
          data:{ labels, datasets:[{label:'Sessions', data:values, fill:true, tension:.35,
            borderColor:'#4f46e5', backgroundColor:'rgba(79,70,229,.12)'}]},
          options:{ plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}}}
        });

        // ---- Visits Bar (same data as line, different viz) ----
        if(visitsBar) visitsBar.destroy();
        visitsBar = new Chart(document.getElementById('barVisits'), {
          type:'bar',
          data:{ labels, datasets:[{label:'Visits', data:values, borderRadius:8, backgroundColor:'#22c55e'}]},
          options:{ plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}}}
        });

        // ---- Sources doughnut ----
        if(sourcesDoughnut) sourcesDoughnut.destroy();
        sourcesDoughnut = new Chart(document.getElementById('doughnutSources'), {
          type:'doughnut',
          data:{ labels:data.sources.labels, datasets:[{ data:data.sources.values, 
              backgroundColor:['#4ade80','#60a5fa','#f87171','#fbbf24','#a78bfa','#34d399']}]},
          options:{ plugins:{legend:{position:'bottom'}}}
        });

        // ---- Top pages list ----
        const wrap = document.getElementById('topPagesWrap');
        wrap.innerHTML = '';
        data.topPages.forEach(p=>{
          const row = document.createElement('div');
          row.className = 'd-flex justify-content-between align-items-center py-2 border-bottom';
          row.innerHTML = `<div class="text-truncate" style="max-width:70%"><i class="bi bi-link-45deg me-1 text-primary"></i><span class="fw-semibold">${p.path}</span></div>
                           <div class="text-muted small">${fmtNumber(p.views)} views</div>`;
          wrap.appendChild(row);
        });

        // Link to GA
        document.getElementById('btnMorePages').href = 'https://analytics.google.com/analytics/web/';
      }catch(e){
        console.error('GA load error', e);
      }
    }

    loadGA();
  </script>



<?php include "footer.php"; ?>
</body>
</html>