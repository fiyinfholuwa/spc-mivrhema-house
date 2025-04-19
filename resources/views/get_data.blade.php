<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conference Submissions Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #3B82F6;
            --secondary-color: #6B7280;
            --accent-color: #10B981;
            --light-bg: #F9FAFB;
            --border-radius: 10px;
        }

        body {
            background-color: #F3F4F6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .page-title {
            color: #1F2937;
            font-weight: 600;
        }

        .table-container {
            background-color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #F3F4F6;
            color: var(--secondary-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            border-bottom: none;
            padding: 1rem 0.75rem;
        }

        .table tbody tr {
            border-bottom: 1px solid #F3F4F6;
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        .search-wrapper {
            position: relative;
        }

        .search-wrapper i {
            position: absolute;
            left: 15px;
            top: 13px;
            color: var(--secondary-color);
        }

        .search-input {
            padding-left: 40px;
            border-radius: 20px;
            border: 1px solid #E5E7EB;
        }

        .btn-export {
            background-color: var(--accent-color);
            border: none;
            border-radius: 20px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }

        .btn-export:hover {
            background-color: #0DA271;
        }

        .pagination-container {
            margin-top: 1.5rem;
        }

        .page-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin: 0 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .page-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #F3F4F6;
            padding: 1.25rem 1.5rem;
        }

        .card-body {
            padding: 0;
        }

        .stats-cards .card {
            transition: transform 0.2s;
        }

        .stats-cards .card:hover {
            transform: translateY(-5px);
        }

        .stat-title {
            color: var(--secondary-color);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1F2937;
            margin-top: 5px;
            margin-bottom: 0;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
    </style>
</head>
<body>

<div class="container-fluid py-4">
    <div class="row mb-4 align-items-center">
        <div class="col-12 col-md-6 mb-2 mb-md-0">
            <h2 class="page-title mb-0 text-center text-md-start">Conference Submissions</h2>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end gap-2">
            <a style="background-color: royalblue; color: white" href="{{ route('home') }}" class="btn btn-export">
                <i class="bi bi-globe2 me-2"></i>Visit Website
            </a>
            <button id="exportBtn" class="btn btn-export btn-success">
                <i class="bi bi-download me-2"></i>Export CSV
            </button>
            <a href="{{ route('logout') }}"  style="background-color: red;" class="btn btn-export btn-danger"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    <!-- Stats Overview -->
    <div class="row stats-cards mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Submissions</div>
                        <p class="stat-value" id="totalSubmissions">0</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(59, 130, 246, 0.1); color: var(--primary-color);">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Individual Registrations</div>
                        <p class="stat-value" id="individualReg">0</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.1); color: var(--accent-color);">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Group Registrations</div>
                        <p class="stat-value" id="groupReg">0</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.1); color: #F59E0B;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Receiving Updates</div>
                        <p class="stat-value" id="receivingUpdates">0</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(236, 72, 153, 0.1); color: #EC4899;">
                        <i class="bi bi-bell-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <div class="search-wrapper mb-2 mb-md-0" style="min-width: 300px;">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" class="form-control search-input" placeholder="Search submissions...">
            </div>
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel me-1"></i>Filters
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="#" data-filter="all">All Submissions</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="individual">Individual Only</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="group">Groups Only</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" data-filter="updates-yes">Receiving Updates</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="updates-no">Not Receiving Updates</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="registrationsTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>How Heard</th>
                        <th>Previous Participation</th>
                        <th>Registration Type</th>
                        <th>Group Name</th>
                        <th>Group Size</th>
                        <th>Expectations</th>
                        <th>Commitment</th>
                        <th>Receive Updates</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    @foreach ($registrations as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->location }}</td>
                            <td>{{ $item->how_heard }}</td>
                            <td>{{ $item->previous_participation }}</td>
                            <td>{{ $item->registration_type }}</td>
                            <td>{{ $item->group_name }}</td>
                            <td>{{ $item->group_size }}</td>
                            <td>{{ $item->expectations }}</td>
                            <td>{{ $item->commitment }}</td>
                            <td>{{ $item->receive_updates }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-top-0">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="text-secondary small mb-2 mb-md-0">
                    Showing <span id="showingCount">0</span> of <span id="totalCount">0</span> entries
                </div>
                <div class="pagination-container d-flex justify-content-center" id="pagination"></div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript Section -->
<script>
    const rowsPerPage = 10;
    const tableBody = document.getElementById("tableBody");
    const allRows = Array.from(tableBody.querySelectorAll("tr"));
    const pagination = document.getElementById("pagination");
    const searchInput = document.getElementById("searchInput");
    const showingCountEl = document.getElementById("showingCount");
    const totalCountEl = document.getElementById("totalCount");
    let currentPage = 1;
    let currentFilter = 'all';

    // Initialize stats
    function updateStats() {
        document.getElementById("totalSubmissions").textContent = allRows.length;

        const individualCount = allRows.filter(row =>
            row.children[8].textContent.trim().toLowerCase() === 'individual'
        ).length;
        document.getElementById("individualReg").textContent = individualCount;

        const groupCount = allRows.filter(row =>
            row.children[8].textContent.trim().toLowerCase() === 'group'
        ).length;
        document.getElementById("groupReg").textContent = groupCount;

        const updatesCount = allRows.filter(row =>
            row.children[13].textContent.trim().toLowerCase() === 'yes' ||
            row.children[13].textContent.trim().toLowerCase() === '1'
        ).length;
        document.getElementById("receivingUpdates").textContent = updatesCount;
    }

    function displayRows(rows) {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const displayedRows = rows.slice(start, end);

        allRows.forEach(row => row.style.display = "none");
        displayedRows.forEach(row => row.style.display = "");

        showingCountEl.textContent = displayedRows.length;
        totalCountEl.textContent = rows.length;
    }

    function updatePagination(rows) {
        const totalPages = Math.ceil(rows.length / rowsPerPage);
        pagination.innerHTML = "";

        // Previous button
        if (totalPages > 1) {
            const prevBtn = document.createElement("button");
            prevBtn.innerHTML = '<i class="bi bi-chevron-left"></i>';
            prevBtn.className = `btn btn-sm btn-outline-secondary page-btn ${currentPage === 1 ? 'disabled' : ''}`;
            prevBtn.addEventListener("click", () => {
                if (currentPage > 1) {
                    currentPage--;
                    displayRows(rows);
                    updatePagination(rows);
                }
            });
            pagination.appendChild(prevBtn);
        }

        // Page buttons
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);

        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }

        for (let i = startPage; i <= endPage; i++) {
            const btn = document.createElement("button");
            btn.innerText = i;
            btn.className = `btn btn-sm btn-outline-primary page-btn ${i === currentPage ? 'active' : ''}`;
            btn.addEventListener("click", () => {
                currentPage = i;
                displayRows(rows);
                updatePagination(rows);
            });
            pagination.appendChild(btn);
        }

        // Next button
        if (totalPages > 1) {
            const nextBtn = document.createElement("button");
            nextBtn.innerHTML = '<i class="bi bi-chevron-right"></i>';
            nextBtn.className = `btn btn-sm btn-outline-secondary page-btn ${currentPage === totalPages ? 'disabled' : ''}`;
            nextBtn.addEventListener("click", () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    displayRows(rows);
                    updatePagination(rows);
                }
            });
            pagination.appendChild(nextBtn);
        }
    }

    function applyFilter(filterType) {
        let filtered = [...allRows];

        switch(filterType) {
            case 'individual':
                filtered = allRows.filter(row =>
                    row.children[8].textContent.trim().toLowerCase() === 'individual'
                );
                break;
            case 'group':
                filtered = allRows.filter(row =>
                    row.children[8].textContent.trim().toLowerCase() === 'group'
                );
                break;
            case 'updates-yes':
                filtered = allRows.filter(row =>
                    row.children[13].textContent.trim().toLowerCase() === 'yes' ||
                    row.children[13].textContent.trim().toLowerCase() === '1'
                );
                break;
            case 'updates-no':
                filtered = allRows.filter(row =>
                    row.children[13].textContent.trim().toLowerCase() === 'no' ||
                    row.children[13].textContent.trim().toLowerCase() === '0'
                );
                break;
            default:
                filtered = [...allRows];
        }

        // Also apply search filter if there's text in the search box
        const query = searchInput.value.toLowerCase();
        if (query) {
            filtered = filtered.filter(row => row.innerText.toLowerCase().includes(query));
        }

        currentPage = 1;
        displayRows(filtered);
        updatePagination(filtered);
    }

    searchInput.addEventListener("input", function () {
        const query = this.value.toLowerCase();
        let filtered = [...allRows];

        if (currentFilter !== 'all') {
            // First apply the current filter
            switch(currentFilter) {
                case 'individual':
                    filtered = filtered.filter(row =>
                        row.children[8].textContent.trim().toLowerCase() === 'individual'
                    );
                    break;
                case 'group':
                    filtered = filtered.filter(row =>
                        row.children[8].textContent.trim().toLowerCase() === 'group'
                    );
                    break;
                case 'updates-yes':
                    filtered = filtered.filter(row =>
                        row.children[13].textContent.trim().toLowerCase() === 'yes' ||
                        row.children[13].textContent.trim().toLowerCase() === '1'
                    );
                    break;
                case 'updates-no':
                    filtered = filtered.filter(row =>
                        row.children[13].textContent.trim().toLowerCase() === 'no' ||
                        row.children[13].textContent.trim().toLowerCase() === '0'
                    );
                    break;
            }
        }

        // Then apply search filter
        filtered = filtered.filter(row => row.innerText.toLowerCase().includes(query));

        currentPage = 1;
        displayRows(filtered);
        updatePagination(filtered);
    });

    document.getElementById("exportBtn").addEventListener("click", function () {
        const headers = Array.from(document.querySelectorAll("#registrationsTable thead th")).map(th => `"${th.innerText}"`);
        const rows = Array.from(document.querySelectorAll("#registrationsTable tbody tr")).map(row => {
            return Array.from(row.querySelectorAll("td")).map(td => `"${td.innerText.replace(/"/g, '""')}"`).join(",");
        });

        const csv = [headers.join(","), ...rows].join("\n");
        const blob = new Blob([csv], { type: "text/csv" });
        const url = URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.href = url;
        a.download = "conference_submissions.csv";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    });

    // Set up filter dropdown clicks
    document.querySelectorAll('[data-filter]').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            currentFilter = e.target.dataset.filter;
            applyFilter(currentFilter);

            // Update dropdown button text
            let filterText = 'All Submissions';
            switch(currentFilter) {
                case 'individual': filterText = 'Individual Only'; break;
                case 'group': filterText = 'Groups Only'; break;
                case 'updates-yes': filterText = 'Receiving Updates'; break;
                case 'updates-no': filterText = 'Not Receiving Updates'; break;
            }
            document.getElementById('filterDropdown').innerHTML = `<i class="bi bi-funnel me-1"></i>${filterText}`;
        });
    });

    // Init
    updateStats();
    displayRows(allRows);
    updatePagination(allRows);
    showingCountEl.textContent = Math.min(rowsPerPage, allRows.length);
    totalCountEl.textContent = allRows.length;
</script>

</body>
</html>
