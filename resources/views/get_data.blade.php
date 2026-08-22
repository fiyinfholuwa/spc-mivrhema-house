<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registration Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root{--ink:#172033;--muted:#718096;--brand:#5b5bd6;--brand-dark:#4646b8;--line:#e7eaf0;--canvas:#f5f7fb;--green:#139c6d}
        *{box-sizing:border-box} body{margin:0;background:var(--canvas);color:var(--ink);font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif}
        .topbar{background:#fff;border-bottom:1px solid var(--line);position:sticky;top:0;z-index:1020}.brand-mark{width:42px;height:42px;border-radius:13px;background:linear-gradient(135deg,var(--brand),#8b5cf6);display:grid;place-items:center;color:#fff;box-shadow:0 8px 18px #5b5bd633}
        .page-shell{max-width:1500px;margin:auto;padding:30px 24px 50px}.eyebrow{color:var(--brand);font-size:.75rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase}.page-title{font-weight:750;letter-spacing:-.035em}.soft-btn{border:1px solid var(--line);background:#fff;color:var(--ink);border-radius:12px;padding:.65rem .9rem;font-weight:600}.soft-btn:hover{background:#f8f8ff;border-color:#cfd1ff;color:var(--brand)}
        .stat-card{height:100%;background:#fff;border:1px solid var(--line);border-radius:17px;padding:19px;box-shadow:0 8px 28px rgba(32,41,64,.045);transition:.2s}.stat-card:hover{transform:translateY(-2px);box-shadow:0 12px 32px rgba(32,41,64,.08)}.stat-icon{width:42px;height:42px;border-radius:12px;display:grid;place-items:center;font-size:1.1rem}.stat-label{color:var(--muted);font-size:.78rem;font-weight:700}.stat-value{font-size:1.65rem;font-weight:760;letter-spacing:-.04em;margin-top:7px}
        .panel{background:#fff;border:1px solid var(--line);border-radius:20px;box-shadow:0 10px 35px rgba(32,41,64,.055);overflow:hidden}.toolbar{padding:20px;border-bottom:1px solid var(--line)}.search-box{position:relative}.search-box i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#9aa3b2}.search-box input{padding-left:41px}.form-control,.form-select{border-color:var(--line);border-radius:11px;min-height:43px}.form-control:focus,.form-select:focus{border-color:#aaaaf1;box-shadow:0 0 0 .22rem #5b5bd615}
        .table{margin:0;min-width:930px}.table thead th{padding:14px 18px;background:#fafbfc;border-bottom:1px solid var(--line);color:#697386;font-size:.7rem;letter-spacing:.08em;text-transform:uppercase;white-space:nowrap}.table tbody td{padding:15px 18px;border-color:#eff1f5;vertical-align:middle}.table tbody tr{transition:.15s}.table tbody tr:hover{background:#fafaff}.person{display:flex;align-items:center;gap:11px}.avatar{width:38px;height:38px;border-radius:12px;background:#ededff;color:var(--brand);display:grid;place-items:center;font-weight:800}.person-name{font-weight:700}.subtext{font-size:.78rem;color:var(--muted)}
        .badge-soft{display:inline-flex;align-items:center;gap:6px;border-radius:999px;padding:6px 10px;font-size:.75rem;font-weight:700}.badge-confirmed{background:#e8f8f1;color:#087d55}.badge-pending{background:#fff5dc;color:#a06600}.group-pill{background:#f0efff;color:#514bc4}.action-btn{border:1px solid var(--line);background:#fff;width:36px;height:36px;border-radius:10px;color:#616b7d}.action-btn:hover{border-color:#b9b9ec;color:var(--brand);background:#f6f6ff}.action-btn.confirm:hover{color:var(--green);border-color:#9cdbc4;background:#f0fbf6}
        .pagination-wrap{padding:17px 20px;border-top:1px solid var(--line)}.page-link{border:0;border-radius:9px!important;margin:0 2px;color:#596274}.page-item.active .page-link{background:var(--brand)}.loading-layer{position:absolute;inset:0;background:#ffffffbf;backdrop-filter:blur(1px);display:none;place-items:center;z-index:5}.table-zone{position:relative;min-height:250px}.empty-state{padding:64px 20px;text-align:center;color:var(--muted)}.details-grid{display:grid;grid-template-columns:1fr 1fr;gap:0 30px}.detail{padding:11px 0;border-bottom:1px solid var(--line)}.detail label{display:block;color:var(--muted);font-size:.72rem;font-weight:700;text-transform:uppercase;margin-bottom:3px}.detail div{word-break:break-word}.modal-content{border:0;border-radius:20px;box-shadow:0 30px 80px #17203333}.modal-header,.modal-footer{border-color:var(--line)}
        @media(max-width:767px){.page-shell{padding:20px 12px}.details-grid{grid-template-columns:1fr}.toolbar{padding:15px}.top-actions .label{display:none}}
    </style>
</head>
<body>
<header class="topbar">
    <div class="container-fluid px-3 px-md-4 py-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3"><div class="brand-mark"><i class="bi bi-people-fill"></i></div><div><div class="fw-bold">SPC Admin</div><div class="subtext">Registration management</div></div></div>
        <div class="d-flex gap-2 top-actions">
            <a href="{{ route('special-accommodations.index') }}" class="soft-btn text-decoration-none"><i class="bi bi-stars me-md-2"></i><span class="label">Special Accommodation</span></a>
            <a href="{{ route('room-keys.index') }}" class="soft-btn text-decoration-none"><i class="bi bi-key me-md-2"></i><span class="label">Room Keys</span></a>
            <a href="{{ route('analytics') }}" class="soft-btn text-decoration-none"><i class="bi bi-bar-chart-line me-md-2"></i><span class="label">Analytics</span></a>
            <a href="{{ route('home') }}" class="soft-btn text-decoration-none"><i class="bi bi-globe2 me-md-2"></i><span class="label">Website</span></a>
            <a href="{{ route('get.feedback') }}" class="soft-btn text-decoration-none"><i class="bi bi-chat-left-text me-md-2"></i><span class="label">Feedback</span></a>
            <form action="{{ route('logout') }}" method="POST">@csrf<button class="soft-btn text-danger" title="Log out"><i class="bi bi-box-arrow-right"></i></button></form>
        </div>
    </div>
</header>

<main class="page-shell">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
        <div><div class="eyebrow mb-2">Conference overview</div><h1 class="page-title h2 mb-1">Registrations</h1><p class="text-secondary mb-0">Review attendees and confirm arrivals in real time.</p></div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('room-keys.index') }}" class="btn btn-primary rounded-3 px-3 py-2"><i class="bi bi-key-fill me-2"></i>Manage room keys</a>
            <button id="exportBtn" class="btn btn-dark rounded-3 px-3 py-2"><i class="bi bi-download me-2"></i>Export current results</button>
        </div>
    </div>

    @php
        $cards = [
            ['total','Total submissions','people','color:#4f46e5;background:#eeedff'],
            ['confirmed','Confirmed','check2-circle','color:#08875d;background:#e9f9f2'],
            ['pending','Awaiting arrival','clock','color:#b16d00;background:#fff4da'],
            ['assigned','Group assigned','book','color:#7c3aed;background:#f2eaff'],
            ['individual','Individuals','person','color:#d23c82;background:#ffebf5'],
            ['group','Group entries','people','color:#1675d1;background:#e8f4ff'],
        ];
    @endphp
    <div class="row g-3 mb-4" id="statsRow">
        @foreach($cards as [$key,$label,$icon,$style])
            <div class="col-6 col-md-4 col-xl-2"><div class="stat-card"><div class="d-flex justify-content-between"><div class="stat-label">{{ $label }}</div><div class="stat-icon" style="{{ $style }}"><i class="bi bi-{{ $icon }}"></i></div></div><div class="stat-value" data-stat="{{ $key }}">{{ number_format($stats[$key]) }}</div></div></div>
        @endforeach
    </div>

    <section class="panel">
        <div class="toolbar">
            <div class="row g-2 align-items-center">
                <div class="col-12 col-lg-6"><div class="search-box"><i class="bi bi-search"></i><input id="searchInput" class="form-control" value="{{ request('search') }}" placeholder="Search name, email, phone or location"></div></div>
                <div class="col-6 col-lg-2"><select id="statusFilter" class="form-select"><option value="">All statuses</option><option value="confirmed" @selected(request('status') === 'confirmed')>Confirmed</option><option value="pending" @selected(request('status') === 'pending')>Pending</option></select></div>
                <div class="col-6 col-lg-2"><select id="typeFilter" class="form-select"><option value="">All types</option><option value="individual" @selected(request('type') === 'individual')>Individual</option><option value="group" @selected(request('type') === 'group')>Group</option></select></div>
                <div class="col-12 col-lg-2 text-lg-end"><span class="subtext" id="resultSummary">Loading records…</span></div>
            </div>
        </div>
        <div class="table-zone">
            <div class="loading-layer" id="loading"><div class="spinner-border text-primary" role="status"></div></div>
            <div class="table-responsive"><table class="table"><thead><tr><th>Attendee</th><th>Contact</th><th>Location</th><th>Status</th><th>Bible group</th><th class="text-end">Actions</th></tr></thead><tbody id="tableBody"></tbody></table></div>
        </div>
        <div class="pagination-wrap d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"><div class="subtext" id="rangeText"></div><nav><ul class="pagination pagination-sm mb-0" id="pagination"></ul></nav></div>
    </section>
</main>

<div class="modal fade" id="detailsModal" tabindex="-1"><div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content"><div class="modal-header px-4"><div><div class="eyebrow">Attendee profile</div><h5 class="modal-title mt-1">Registration details</h5></div><button class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body px-4" id="modalBody"></div><div class="modal-footer px-4"><button class="btn btn-light" data-bs-dismiss="modal">Close</button></div></div></div></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const dashboardUrl = @json(route('dashboard'));
const confirmUrl = @json(url('/confirm-arrival'));
const csrf = document.querySelector('meta[name="csrf-token"]').content;
let pageData = @json($registrations);
let requestController;

const escapeHtml = value => { const el = document.createElement('div'); el.textContent = value ?? ''; return el.innerHTML; };
const title = value => value ? String(value).replaceAll('_',' ').replace(/\b\w/g, c => c.toUpperCase()) : 'N/A';
const debounce = (fn, wait=400) => { let timer; return (...args) => { clearTimeout(timer); timer=setTimeout(() => fn(...args), wait); }; };

function render(data) {
    pageData = data;
    const rows = data.data || [];
    document.getElementById('tableBody').innerHTML = rows.length ? rows.map(reg => {
        const confirmed = reg.confirmed_reg === 'confirmed';
        const initials = (reg.fullname || '?').split(/\s+/).slice(0,2).map(x => x[0]).join('').toUpperCase();
        return `<tr><td><div class="person"><div class="avatar">${escapeHtml(initials)}</div><div><div class="person-name">${escapeHtml(reg.fullname)}</div><div class="subtext">#${reg.id} · ${escapeHtml(title(reg.registration_type))}</div></div></div></td><td><div>${escapeHtml(reg.email || 'No email')}</div><div class="subtext">${escapeHtml(reg.phone || 'No phone')}</div></td><td><div>${escapeHtml(reg.location || 'N/A')}</div><div class="subtext">${escapeHtml(reg.state || '')}</div></td><td><span class="badge-soft ${confirmed?'badge-confirmed':'badge-pending'}"><i class="bi bi-${confirmed?'check-circle-fill':'clock-fill'}"></i>${confirmed?'Confirmed':'Pending'}</span></td><td>${reg.bible_group ? `<span class="badge-soft group-pill">Group ${escapeHtml(reg.bible_group)}</span>` : '<span class="subtext">Not assigned</span>'}</td><td><div class="d-flex gap-2 justify-content-end"><button class="action-btn" title="View details" onclick="viewDetails(${reg.id})"><i class="bi bi-eye"></i></button>${confirmed?'':`<button class="action-btn confirm" title="Confirm arrival" onclick="confirmArrival(${reg.id})"><i class="bi bi-check2"></i></button>`}</div></td></tr>`;
    }).join('') : '<tr><td colspan="6"><div class="empty-state"><i class="bi bi-search fs-2 d-block mb-2"></i><strong>No registrations found</strong><div class="mt-1">Try changing your search or filters.</div></div></td></tr>';
    document.getElementById('resultSummary').textContent = `${data.total.toLocaleString()} result${data.total === 1 ? '' : 's'}`;
    document.getElementById('rangeText').textContent = data.total ? `Showing ${data.from}–${data.to} of ${data.total}` : 'No records to show';
    renderPagination(data);
}

function renderPagination(data) {
    const list = document.getElementById('pagination');
    if (data.last_page <= 1) { list.innerHTML=''; return; }
    const pages = new Set([1, data.last_page, data.current_page-1, data.current_page, data.current_page+1]);
    const visible = [...pages].filter(p => p >= 1 && p <= data.last_page).sort((a,b)=>a-b);
    let previous = 0, html = `<li class="page-item ${data.current_page===1?'disabled':''}"><button class="page-link" data-page="${data.current_page-1}"><i class="bi bi-chevron-left"></i></button></li>`;
    visible.forEach(p => { if (previous && p-previous>1) html += '<li class="page-item disabled"><span class="page-link">…</span></li>'; html += `<li class="page-item ${p===data.current_page?'active':''}"><button class="page-link" data-page="${p}">${p}</button></li>`; previous=p; });
    html += `<li class="page-item ${data.current_page===data.last_page?'disabled':''}"><button class="page-link" data-page="${data.current_page+1}"><i class="bi bi-chevron-right"></i></button></li>`;
    list.innerHTML=html;
}

async function loadPage(page=1, pushState=true) {
    if (requestController) requestController.abort(); requestController = new AbortController();
    const params = new URLSearchParams({page});
    const search=document.getElementById('searchInput').value.trim(), status=document.getElementById('statusFilter').value, type=document.getElementById('typeFilter').value;
    if(search) params.set('search',search); if(status) params.set('status',status); if(type) params.set('type',type);
    document.getElementById('loading').style.display='grid';
    try {
        const response=await fetch(`${dashboardUrl}?${params}`,{headers:{Accept:'application/json','X-Requested-With':'XMLHttpRequest'},signal:requestController.signal});
        if(!response.ok) throw new Error('Could not load registrations');
        const payload=await response.json(); render(payload.registrations);
        Object.entries(payload.stats).forEach(([key,value]) => { const el=document.querySelector(`[data-stat="${key}"]`); if(el) el.textContent=Number(value).toLocaleString(); });
        if(pushState) history.replaceState({},'',`${dashboardUrl}?${params}`);
    } catch(error) { if(error.name!=='AbortError') Swal.fire({icon:'error',title:'Unable to load data',text:error.message}); }
    finally { document.getElementById('loading').style.display='none'; }
}

function viewDetails(id) {
    const reg=pageData.data.find(item=>item.id===id); if(!reg) return;
    const fields=[['Full name',reg.fullname],['Gender',reg.gender],['Email',reg.email],['Phone',reg.phone],['Location',reg.location],['State',reg.state],['Participation mode',reg.mode_of_participation],['Registration type',title(reg.registration_type)],['Group name',reg.group_name],['Group size',reg.group_size],['Marital status',reg.marital_status],['Coming with spouse',reg.coming_with_spouse],['Previous participation',reg.previous_participation],['How they heard',reg.how_heard],['Accommodation',reg.accommodation_preference],['Bible group',reg.bible_group?`Group ${reg.bible_group}`:'Not assigned'],['Receives updates',title(reg.receive_updates)]];
    document.getElementById('modalBody').innerHTML=`<div class="details-grid">${fields.map(([label,value])=>`<div class="detail"><label>${escapeHtml(label)}</label><div>${escapeHtml(value ?? 'N/A')}</div></div>`).join('')}</div><div class="detail mt-3"><label>Expectations</label><div>${escapeHtml(reg.expectations || 'N/A')}</div></div><div class="detail"><label>Commitment</label><div>${escapeHtml(reg.commitment || 'N/A')}</div></div>`;
    bootstrap.Modal.getOrCreateInstance(document.getElementById('detailsModal')).show();
}

async function confirmArrival(id) {
    const reg=pageData.data.find(item=>item.id===id); if(!reg) return;
    const result=await Swal.fire({title:'Confirm arrival?',text:`Mark ${reg.fullname} as arrived and assign a Bible group.`,icon:'question',showCancelButton:true,confirmButtonText:'Yes, confirm',confirmButtonColor:'#139c6d'}); if(!result.isConfirmed) return;
    Swal.fire({title:'Confirming arrival…',allowOutsideClick:false,didOpen:()=>Swal.showLoading()});
    try {
        const response=await fetch(`${confirmUrl}/${id}`,{method:'POST',headers:{Accept:'application/json','X-CSRF-TOKEN':csrf,'X-Requested-With':'XMLHttpRequest'}}); const payload=await response.json(); if(!response.ok||!payload.success) throw new Error(payload.message||'Confirmation failed');
        await loadPage(pageData.current_page,false);
        Swal.fire({toast:true,position:'top-end',icon:'success',title:`Arrival confirmed · Group ${payload.assigned_group}`,showConfirmButton:false,timer:3000,timerProgressBar:true});
    } catch(error) { Swal.fire({icon:'error',title:'Could not confirm arrival',text:error.message}); }
}

document.getElementById('searchInput').addEventListener('input',debounce(()=>loadPage(1)));
document.getElementById('statusFilter').addEventListener('change',()=>loadPage(1)); document.getElementById('typeFilter').addEventListener('change',()=>loadPage(1));
document.getElementById('pagination').addEventListener('click',event=>{ const button=event.target.closest('[data-page]'); if(button&&!button.closest('.disabled')) { loadPage(button.dataset.page); document.querySelector('.panel').scrollIntoView({behavior:'smooth',block:'start'}); }});
document.getElementById('exportBtn').addEventListener('click',()=>{ const headers=['ID','Full Name','Email','Phone','Location','State','Status','Bible Group','Registration Type']; const rows=pageData.data.map(r=>[r.id,r.fullname,r.email,r.phone,r.location,r.state,r.confirmed_reg||'Pending',r.bible_group||'Not Assigned',r.registration_type]); const csv=[headers,...rows].map(row=>row.map(cell=>`"${String(cell??'').replaceAll('"','""')}"`).join(',')).join('\n'); const a=document.createElement('a'); a.href=URL.createObjectURL(new Blob([csv],{type:'text/csv'})); a.download=`conference-registrations-page-${pageData.current_page}.csv`; a.click(); URL.revokeObjectURL(a.href); });

render(pageData);
</script>
</body>
</html>
