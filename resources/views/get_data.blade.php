<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conference Submissions Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            border-radius: 6px;
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

        .status-badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-weight: 600;
        }

        .status-confirmed {
            background-color: rgba(16, 185, 129, 0.15);
            color: #10B981;
        }

        .status-pending {
            background-color: rgba(245, 158, 11, 0.15);
            color: #F59E0B;
        }

        .status-cancelled {
            background-color: rgba(239, 68, 68, 0.15);
            color: #EF4444;
        }

        .modal-header {
            border-bottom: 1px solid #E5E7EB;
        }

        .modal-footer {
            border-top: 1px solid #E5E7EB;
        }

        .info-row {
            padding: 0.5rem 0;
            border-bottom: 1px solid #F3F4F6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: var(--secondary-color);
        }

        .action-buttons {
            display: flex;
            gap: 0.25rem;
        }

        .table td {
            vertical-align: middle;
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
            <a href="{{ route('logout') }}" style="background-color: red;" class="btn btn-export btn-danger"
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
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Submissions</div>
                        <p class="stat-value">{{ $registrations->count() }}</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(59, 130, 246, 0.1); color: var(--primary-color);">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Confirmed</div>
                        <p class="stat-value">{{ $registrations->where('confirmed_reg', 'confirmed')->count() }}</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.1); color: var(--accent-color);">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Pending</div>
                        <p class="stat-value">
                            {{ $registrations->filter(function ($reg) {
                                return is_null($reg->confirmed_reg) || $reg->confirmed_reg === 'pending';
                            })->count() }}
                        </p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.1); color: #F59E0B;">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Bible Groups</div>
                        <p class="stat-value">{{ $registrations->whereNotNull('bible_group')->where('bible_group', '!=', '')->count() }}</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(99, 102, 241, 0.1); color: #6366F1;">
                        <i class="bi bi-book-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Individual</div>
                        <p class="stat-value">{{ $registrations->where('registration_type', 'individual')->count() }}</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(236, 72, 153, 0.1); color: #EC4899;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Groups</div>
                        <p class="stat-value">{{ $registrations->where('registration_type', 'group')->count() }}</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(168, 85, 247, 0.1); color: #A855F7;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <div class="search-wrapper mb-2 mb-md-0" style="min-width: 300px;">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" class="form-control search-input" placeholder="Search by name, email, phone, location...">
            </div>
            <div class="text-secondary small">
                Showing <span id="showingCount">{{ $registrations->count() }}</span> of <span id="totalCount">{{ $registrations->count() }}</span> entries
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="registrationsTable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Bible Group</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    @forelse ($registrations as $item)
                        <tr data-registration="{{ json_encode($item) }}" data-id="{{ $item->id }}">
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->location }}</td>
                            <td>
                                <span class="status-badge status-{{ strtolower($item->confirmed_reg ?? 'pending') }}" id="status-{{ $item->id }}">
                                    {{ ucfirst($item->confirmed_reg ?? 'Pending') }}
                                </span>
                            </td>
                            <td>{{ $item->bible_group ?? 'Not Assigned' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary view-details-btn"
                                            onclick="viewDetails({{ $item->id }})"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detailsModal">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success confirm-arrival-btn"
                                            onclick="confirmArrival({{ $item->id }}, '{{ $item->fullname }}')"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmModal">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No registrations found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Registration Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content will be populated by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Arrival Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Arrival</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to confirm the arrival of <strong id="confirm-name"></strong>?</p>
                <p class="text-muted small">This will update their registration status to "Confirmed".</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="proceedConfirm">Confirm Arrival</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Global variables
    let allRows = [];
    let currentRegistrationId = null;
    let registrationsData = @json($registrations);

    // Initialize on DOM load
    document.addEventListener('DOMContentLoaded', function() {
        allRows = Array.from(document.querySelectorAll('#tableBody tr[data-id]'));
        setupSearch();
    });

    // Search functionality
    function setupSearch() {
        const searchInput = document.getElementById('searchInput');
        const showingCount = document.getElementById('showingCount');
        const totalCount = document.getElementById('totalCount');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            let visibleCount = 0;

            allRows.forEach(row => {
                const registrationData = JSON.parse(row.dataset.registration);
                const searchableText = [
                    registrationData.fullname,
                    registrationData.email,
                    registrationData.phone,
                    registrationData.location,
                    registrationData.confirmed_reg,
                    registrationData.bible_group
                ].join(' ').toLowerCase();

                if (query === '' || searchableText.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            showingCount.textContent = visibleCount;
        });
    }

    // View details function
    function viewDetails(registrationId) {
        const registration = registrationsData.find(r => r.id == registrationId);
        if (!registration) return;

        const modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">ID:</span>
                    <span>${registration.id}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Full Name:</span>
                    <span>${registration.fullname || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Gender:</span>
                    <span>${registration.gender || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Phone:</span>
                    <span>${registration.phone || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Email:</span>
                    <span>${registration.email || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Location:</span>
                    <span>${registration.location || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">How Heard:</span>
                    <span>${registration.how_heard || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Registration Type:</span>
                    <span>${registration.registration_type || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Marital Status:</span>
                    <span>${registration.marital_status || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Coming with Spouse:</span>
                    <span>${registration.coming_with_spouse || 'N/A'}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Previous Participation:</span>
                    <span>${registration.previous_participation || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Source Type:</span>
                    <span>${registration.source_type || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Group Name:</span>
                    <span>${registration.group_name || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Group Size:</span>
                    <span>${registration.group_size || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Confirmation Status:</span>
                    <span>${registration.confirmed_reg || 'Pending'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Bible Group:</span>
                    <span>${registration.bible_group || 'Not Assigned'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Receive Updates:</span>
                    <span>${registration.receive_updates || 'N/A'}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Created:</span>
                    <span>${new Date(registration.created_at).toLocaleDateString()}</span>
                </div>
                <div class="info-row d-flex justify-content-between">
                    <span class="info-label">Updated:</span>
                    <span>${new Date(registration.updated_at).toLocaleDateString()}</span>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div class="info-row">
                <div class="info-label mb-2">Expectations:</div>
                <div class="text-muted">${registration.expectations || 'N/A'}</div>
            </div>
            <div class="info-row mt-3">
                <div class="info-label mb-2">Commitment:</div>
                <div class="text-muted">${registration.commitment || 'N/A'}</div>
            </div>
        </div>
    `;
    }

    // Confirm arrival function
    function confirmArrival(registrationId, fullname) {
        currentRegistrationId = registrationId;
        document.getElementById('confirm-name').textContent = fullname;
    }

    // Handle confirmation
    document.getElementById('proceedConfirm').addEventListener('click', function() {
        if (!currentRegistrationId) return;

        $.ajax({
            url: `/confirm-arrival/${currentRegistrationId}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: JSON.stringify({
                confirmed_reg: 'confirmed'
            }),
            success: function(response) {
                if (response.success) {
                    // Update the status badge
                    const statusBadge = document.getElementById(`status-${currentRegistrationId}`);
                    statusBadge.textContent = 'Confirmed';
                    statusBadge.className = 'status-badge status-confirmed';

                    // Update the data
                    const registration = registrationsData.find(r => r.id == currentRegistrationId);
                    if (registration) {
                        registration.confirmed_reg = 'confirmed';
                    }

                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
                    modal.hide();

                    // Show success message
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Arrival confirmed successfully!',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    // Refresh page to update stats
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Failed to confirm arrival'
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Something went wrong! Please try again.'
                });
            }
        });
    });

    // Export CSV functionality
    document.getElementById('exportBtn').addEventListener('click', function() {
        const headers = [
            'ID', 'Full Name', 'Gender', 'Phone', 'Email', 'Location', 'How Heard',
            'Previous Participation', 'Registration Type', 'Source Type', 'Marital Status',
            'Coming with Spouse', 'Group Name', 'Group Size', 'Expectations', 'Commitment',
            'Receive Updates', 'Confirmed Registration', 'Bible Group', 'Created At', 'Updated At'
        ];

        const rows = registrationsData.map(registration => [
            registration.id,
            registration.fullname || '',
            registration.gender || '',
            registration.phone || '',
            registration.email || '',
            registration.location || '',
            registration.how_heard || '',
            registration.previous_participation || '',
            registration.registration_type || '',
            registration.source_type || '',
            registration.marital_status || '',
            registration.coming_with_spouse || '',
            registration.group_name || '',
            registration.group_size || '',
            registration.expectations || '',
            registration.commitment || '',
            registration.receive_updates || '',
            registration.confirmed_reg || 'Pending',
            registration.bible_group || 'Not Assigned',
            registration.created_at || '',
            registration.updated_at || ''
        ].map(cell => `"${String(cell).replace(/"/g, '""')}"`));

        const csvContent = [
            headers.map(h => `"${h}"`).join(','),
            ...rows.map(r => r.join(','))
        ].join('\n');

        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = url;
        a.download = `conference_submissions_${new Date().toISOString().split('T')[0]}.csv`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });
</script>

</body>
</html>
