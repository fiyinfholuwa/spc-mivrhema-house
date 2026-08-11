<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root{--ink:#172033;--muted:#718096;--brand:#5b5bd6;--line:#e7eaf0;--canvas:#f5f7fb}
        *{box-sizing:border-box}body{margin:0;background:var(--canvas);color:var(--ink);font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif}.topbar{background:#fff;border-bottom:1px solid var(--line)}.page-shell{max-width:1380px;margin:auto;padding:30px 24px 55px}.brand-mark{width:42px;height:42px;border-radius:13px;background:linear-gradient(135deg,var(--brand),#8b5cf6);display:grid;place-items:center;color:#fff;box-shadow:0 8px 18px #5b5bd633}.soft-btn{border:1px solid var(--line);background:#fff;color:var(--ink);border-radius:12px;padding:.65rem .95rem;font-weight:650;text-decoration:none}.soft-btn:hover{color:var(--brand);border-color:#bdbdf0}.eyebrow{color:var(--brand);font-size:.75rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase}.page-title{font-weight:760;letter-spacing:-.04em}.summary{height:100%;background:#fff;border:1px solid var(--line);border-radius:18px;padding:20px;box-shadow:0 8px 28px rgba(32,41,64,.05)}.summary-icon{width:43px;height:43px;border-radius:13px;display:grid;place-items:center}.summary-label{color:var(--muted);font-size:.78rem;font-weight:700}.summary-value{font-size:1.8rem;line-height:1;font-weight:780;letter-spacing:-.05em;margin-top:12px}.summary-note{color:var(--muted);font-size:.75rem;margin-top:7px}
        .chart-card{height:100%;background:#fff;border:1px solid var(--line);border-radius:20px;padding:22px;box-shadow:0 10px 34px rgba(32,41,64,.05)}.chart-title{font-size:1rem;font-weight:760;margin:0}.chart-subtitle{color:var(--muted);font-size:.78rem;margin-top:4px}.metric{margin-top:21px}.metric-head{display:flex;justify-content:space-between;align-items:flex-end;gap:12px;margin-bottom:8px}.metric-label{font-size:.86rem;font-weight:680}.metric-number{font-weight:780}.metric-percent{color:var(--muted);font-size:.75rem;margin-left:5px}.track{height:9px;background:#eef0f5;border-radius:999px;overflow:hidden}.bar{height:100%;border-radius:999px;background:linear-gradient(90deg,var(--brand),#8b5cf6);min-width:3px}.chart-card.green .bar{background:linear-gradient(90deg,#0d9b6b,#47c995)}.chart-card.orange .bar{background:linear-gradient(90deg,#e28425,#f5b84b)}.chart-card.blue .bar{background:linear-gradient(90deg,#207bc5,#54acee)}.empty{color:var(--muted);padding:40px 0;text-align:center}.total-pill{display:inline-flex;align-items:center;gap:7px;background:#eeeeff;color:#514bc4;padding:7px 11px;border-radius:999px;font-size:.75rem;font-weight:750}@media(max-width:767px){.page-shell{padding:20px 12px}.top-label{display:none}}
    </style>
</head>
<body>
<header class="topbar"><div class="container-fluid px-3 px-md-4 py-3 d-flex align-items-center justify-content-between"><div class="d-flex align-items-center gap-3"><div class="brand-mark"><i class="bi bi-bar-chart-fill"></i></div><div><div class="fw-bold">SPC Analytics</div><div class="text-secondary small">Registration insights</div></div></div><a href="{{ route('dashboard') }}" class="soft-btn"><i class="bi bi-arrow-left me-md-2"></i><span class="top-label">Back to dashboard</span></a></div></header>

<main class="page-shell">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4"><div><div class="eyebrow mb-2">Audience insights</div><h1 class="page-title h2 mb-1">Registration analytics</h1><p class="text-secondary mb-0">A clear breakdown of all {{ number_format($total) }} submitted registrations.</p></div><span class="total-pill"><i class="bi bi-database"></i>{{ number_format($total) }} total records</span></div>

    @php
        $findCount = function ($items, $wanted) {
            foreach ($items as $label => $count) {
                if (in_array(strtolower($label), (array) $wanted, true)) return $count;
            }
            return 0;
        };
        $highlights = [
            ['Virtual', $findCount($analytics['participation'], ['virtual', 'online']), 'camera-video', '#eeedff', '#514bc4'],
            ['Physical', $findCount($analytics['participation'], ['physical', 'in person', 'onsite', 'on-site']), 'geo-alt', '#e8f8f1', '#087d55'],
            ['Male', $findCount($analytics['gender'], 'male'), 'gender-male', '#e8f4ff', '#1675d1'],
            ['Female', $findCount($analytics['gender'], 'female'), 'gender-female', '#ffebf5', '#c43577'],
        ];
        $sections = [
            ['Participation mode', 'Virtual and physical attendance choices', 'participation', 'camera-video', ''],
            ['Gender', 'Gender distribution across registrations', 'gender', 'people', 'green'],
            ['How people heard', 'Every distinct discovery source submitted', 'how_heard', 'megaphone', 'orange'],
            ['Marital status', 'Submitted marital status breakdown', 'marital_status', 'heart', 'blue'],
        ];
    @endphp

    <div class="row g-3 mb-4">
        @foreach($highlights as [$label,$count,$icon,$background,$color])
            <div class="col-6 col-lg-3"><div class="summary"><div class="d-flex justify-content-between"><div class="summary-label">{{ $label }}</div><div class="summary-icon" style="background:{{ $background }};color:{{ $color }}"><i class="bi bi-{{ $icon }}"></i></div></div><div class="summary-value">{{ number_format($count) }}</div><div class="summary-note">{{ $total ? number_format(($count / $total) * 100, 1) : 0 }}% of all registrations</div></div></div>
        @endforeach
    </div>

    <div class="row g-4">
        @foreach($sections as [$heading,$subtitle,$key,$icon,$colorClass])
            <div class="col-12 col-lg-6"><section class="chart-card {{ $colorClass }}"><div class="d-flex align-items-start justify-content-between"><div><h2 class="chart-title">{{ $heading }}</h2><div class="chart-subtitle">{{ $subtitle }}</div></div><div class="summary-icon" style="background:#f2f3f7;color:#687386"><i class="bi bi-{{ $icon }}"></i></div></div>
                @forelse($analytics[$key] as $label => $count)
                    @php $percentage = $total ? ($count / $total) * 100 : 0; @endphp
                    <div class="metric"><div class="metric-head"><span class="metric-label">{{ $label }}</span><span><span class="metric-number">{{ number_format($count) }}</span><span class="metric-percent">{{ number_format($percentage, 1) }}%</span></span></div><div class="track"><div class="bar" style="width:{{ $percentage }}%"></div></div></div>
                @empty
                    <div class="empty"><i class="bi bi-inbox fs-3 d-block mb-2"></i>No data available yet.</div>
                @endforelse
            </section></div>
        @endforeach
    </div>
</main>
</body>
</html>
