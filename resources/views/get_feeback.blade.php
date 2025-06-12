<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conference Feedback Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

        .rating-badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-weight: 600;
        }

        .rating-excellent {
            background-color: rgba(16, 185, 129, 0.15);
            color: #10B981;
        }

        .rating-good {
            background-color: rgba(59, 130, 246, 0.15);
            color: #3B82F6;
        }

        .rating-average {
            background-color: rgba(245, 158, 11, 0.15);
            color: #F59E0B;
        }

        .rating-poor {
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
            <h2 class="page-title mb-0 text-center text-md-start">Conference Feedback Dashboard</h2>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end gap-2">
            <a href="{{route('dashboard')}}"  style="background-color: red;" class="btn btn-export btn-danger">
                <i class="bi bi-home me-2"></i>Main Dashboard
            </a>

<button id="exportBtn" class="btn btn-export btn-success">
                <i class="bi bi-download me-2"></i>Export CSV
            </button>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="row stats-cards mb-4">
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Feedback</div>
                        <p class="stat-value" id="totalFeedback">0</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(59, 130, 246, 0.1); color: var(--primary-color);">
                        <i class="bi bi-chat-left-text"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Excellent Rating</div>
                        <p class="stat-value" id="excellentCount">0</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.1); color: var(--accent-color);">
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">High Impact</div>
                        <p class="stat-value" id="highImpactCount">0</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.1); color: #F59E0B;">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Will Attend Again</div>
                        <p class="stat-value" id="attendAgainCount">0</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(99, 102, 241, 0.1); color: #6366F1;">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Inspiring Speakers</div>
                        <p class="stat-value" id="inspiringSpeakersCount">0</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(236, 72, 153, 0.1); color: #EC4899;">
                        <i class="bi bi-mic-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Exceptional Content</div>
                        <p class="stat-value" id="exceptionalContentCount">0</p>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(168, 85, 247, 0.1); color: #A855F7;">
                        <i class="bi bi-book-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <div class="search-wrapper mb-2 mb-md-0" style="min-width: 300px;">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" class="form-control search-input" placeholder="Search by name, email, rating...">
            </div>
            <div class="text-secondary small">
                Showing <span id="showingCount">0</span> of <span id="totalCount">0</span> entries
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="feedbackTable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Overall Rating</th>
                        <th>Spiritual Impact</th>
                        <th>Content Quality</th>
                        <th>Speaker Rating</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    <!-- Content will be populated by JavaScript -->
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
                <h5 class="modal-title" id="detailsModalLabel">Feedback Details</h5>
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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Your feedback data
    const feedbackData =@json($registrations);

    // Global variables
    let allRows = [];

    // Initialize on DOM load
    document.addEventListener('DOMContentLoaded', function() {
        populateTable();
        updateStats();
        setupSearch();
    });

    function getRatingClass(rating) {
        if (!rating) return 'rating-poor';

        const lowerRating = rating.toLowerCase();
        if (lowerRating.includes('excellent') || lowerRating.includes('exceptional')) {
            return 'rating-excellent';
        } else if (lowerRating.includes('good') || lowerRating.includes('inspiring')) {
            return 'rating-good';
        } else if (lowerRating.includes('average') || lowerRating.includes('moderate')) {
            return 'rating-average';
        } else {
            return 'rating-poor';
        }
    }

    function populateTable() {
        const tableBody = document.getElementById('tableBody');

        if (feedbackData.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center py-4">No feedback found</td></tr>';
            return;
        }

        tableBody.innerHTML = feedbackData.map(feedback => `
            <tr data-feedback='${JSON.stringify(feedback)}' data-id="${feedback.id}">
                <td>${feedback.full_name || 'N/A'}</td>
                <td>${feedback.email || 'N/A'}</td>
                <td>
                    <span class="rating-badge ${getRatingClass(feedback.rating_overall)}">
                        ${feedback.rating_overall || 'N/A'}
                    </span>
                </td>
                <td>
                    <span class="rating-badge ${getRatingClass(feedback.spiritual_impact)}">
                        ${feedback.spiritual_impact || 'N/A'}
                    </span>
                </td>
                <td>
                    <span class="rating-badge ${getRatingClass(feedback.content_quality)}">
                        ${feedback.content_quality || 'N/A'}
                    </span>
                </td>
                <td>
                    <span class="rating-badge ${getRatingClass(feedback.speaker_rating)}">
                        ${feedback.speaker_rating || 'N/A'}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-sm btn-outline-primary view-details-btn"
                                onclick="viewDetails(${feedback.id})"
                                data-bs-toggle="modal"
                                data-bs-target="#detailsModal">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');

        allRows = Array.from(document.querySelectorAll('#tableBody tr[data-id]'));
    }

    function updateStats() {
        document.getElementById('totalFeedback').textContent = feedbackData.length;

        // Count excellent ratings
        const excellentCount = feedbackData.filter(f =>
            f.rating_overall && f.rating_overall.toLowerCase().includes('excellent')
        ).length;
        document.getElementById('excellentCount').textContent = excellentCount;

        // Count high spiritual impact
        const highImpactCount = feedbackData.filter(f =>
            f.spiritual_impact && (f.spiritual_impact.toLowerCase().includes('high') || f.spiritual_impact.toLowerCase().includes('very'))
        ).length;
        document.getElementById('highImpactCount').textContent = highImpactCount;

        // Count will attend again
        const attendAgainCount = feedbackData.filter(f =>
            f.attend_again && f.attend_again.toLowerCase().includes('yes')
        ).length;
        document.getElementById('attendAgainCount').textContent = attendAgainCount;

        // Count inspiring speakers
        const inspiringSpeakersCount = feedbackData.filter(f =>
            f.speaker_rating && f.speaker_rating.toLowerCase().includes('inspiring')
        ).length;
        document.getElementById('inspiringSpeakersCount').textContent = inspiringSpeakersCount;

        // Count exceptional content
        const exceptionalContentCount = feedbackData.filter(f =>
            f.content_quality && f.content_quality.toLowerCase().includes('exceptional')
        ).length;
        document.getElementById('exceptionalContentCount').textContent = exceptionalContentCount;

        // Update showing counts
        document.getElementById('showingCount').textContent = feedbackData.length;
        document.getElementById('totalCount').textContent = feedbackData.length;
    }

    // Search functionality
    function setupSearch() {
        const searchInput = document.getElementById('searchInput');
        const showingCount = document.getElementById('showingCount');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            let visibleCount = 0;

            allRows.forEach(row => {
                const feedbackDataRow = JSON.parse(row.dataset.feedback);
                const searchableText = [
                    feedbackDataRow.full_name,
                    feedbackDataRow.email,
                    feedbackDataRow.rating_overall,
                    feedbackDataRow.spiritual_impact,
                    feedbackDataRow.content_quality,
                    feedbackDataRow.speaker_rating
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
    function viewDetails(feedbackId) {
        const feedback = feedbackData.find(f => f.id == feedbackId);
        if (!feedback) return;

        const modalBody = document.getElementById('modalBody');
        modalBody.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">ID:</span>
                        <span>${feedback.id}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Full Name:</span>
                        <span>${feedback.full_name || 'N/A'}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Email:</span>
                        <span>${feedback.email || 'N/A'}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Overall Rating:</span>
                        <span>${feedback.rating_overall || 'N/A'}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Spiritual Impact:</span>
                        <span>${feedback.spiritual_impact || 'N/A'}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Content Quality:</span>
                        <span>${feedback.content_quality || 'N/A'}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Speaker Rating:</span>
                        <span>${feedback.speaker_rating || 'N/A'}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Logistics:</span>
                        <span>${feedback.logistics || 'N/A'}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Venue Rating:</span>
                        <span>${feedback.venue_rating || 'N/A'}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Attend Again:</span>
                        <span>${feedback.attend_again || 'N/A'}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Created:</span>
                        <span>${new Date(feedback.created_at).toLocaleDateString()}</span>
                    </div>
                    <div class="info-row d-flex justify-content-between">
                        <span class="info-label">Updated:</span>
                        <span>${new Date(feedback.updated_at).toLocaleDateString()}</span>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="info-row">
                    <div class="info-label mb-2">Highlight Sessions:</div>
                    <div class="text-muted">${feedback.highlight_sessions || 'N/A'}</div>
                </div>
                <div class="info-row mt-3">
                    <div class="info-label mb-2">Improvements:</div>
                    <div class="text-muted">${feedback.improvements || 'N/A'}</div>
                </div>
                <div class="info-row mt-3">
                    <div class="info-label mb-2">Testimonies:</div>
                    <div class="text-muted">${feedback.testimonies || 'N/A'}</div>
                </div>
            </div>
        `;
    }

    // Export CSV functionality
    document.getElementById('exportBtn').addEventListener('click', function() {
        const headers = [
            'ID', 'Full Name', 'Email', 'Overall Rating', 'Spiritual Impact', 'Highlight Sessions',
            'Content Quality', 'Speaker Rating', 'Logistics', 'Venue Rating', 'Attend Again',
            'Improvements', 'Testimonies', 'Created At', 'Updated At'
        ];

        const rows = feedbackData.map(feedback => [
            feedback.id,
            feedback.full_name || '',
            feedback.email || '',
            feedback.rating_overall || '',
            feedback.spiritual_impact || '',
            feedback.highlight_sessions || '',
            feedback.content_quality || '',
            feedback.speaker_rating || '',
            feedback.logistics || '',
            feedback.venue_rating || '',
            feedback.attend_again || '',
            feedback.improvements || '',
            feedback.testimonies || '',
            feedback.created_at || '',
            feedback.updated_at || ''
        ].map(cell => `"${String(cell).replace(/"/g, '""')}"`));

        const csvContent = [
            headers.map(h => `"${h}"`).join(','),
            ...rows.map(r => r.join(','))
        ].join('\n');

        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = url;
        a.download = `conference_feedback_${new Date().toISOString().split('T')[0]}.csv`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);

        // Show success message
        Swal.fire({
            toast: true,
            icon: 'success',
            title: 'CSV exported successfully!',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    });
</script>

</body>
</html>
