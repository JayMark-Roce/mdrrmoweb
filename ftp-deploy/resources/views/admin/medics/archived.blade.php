<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Archived Medics - MDRRMO</title>
    <link rel="stylesheet" href="{{ asset('css/stylish.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
:root {
    --bg-gradient: radial-gradient(circle at top, #fdf2ff 0%, #eef2ff 45%, #f5f7fb 100%);
    --card-bg: #ffffff;
    --border-color: #e2e8f0;
    --heading: #0f172a;
    --muted: #6b7280;
    --accent: #2563eb;
    --accent-alt: #6366f1;
    --danger: #ef4444;
    --success: #10b981;
    --warning: #f59e0b;
    --shadow-lg: 0 30px 60px rgba(15, 23, 42, 0.12);
    --rounded-xl: 28px;
    --glass: rgba(255, 255, 255, 0.65);
}

html, body {
    min-height: 100vh;
    background: var(--bg-gradient);
    font-family: 'Nunito', 'Segoe UI', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    color: var(--heading);
    overflow-x: hidden;
}

.sidenav {
    position: fixed;
    left: 0;
    top: 0;
    width: 260px;
    height: 100vh;
    background: linear-gradient(180deg, #031273 0%, #1e3a8a 100%);
    z-index: 1000;
    overflow-y: auto;
    transition: transform 0.3s ease;
    box-shadow: 15px 0 35px rgba(15, 23, 42, 0.35);
}

.toggle-btn {
    display: none;
    position: fixed;
    top: 1rem;
    left: 1rem;
    z-index: 1001;
    background: #031273;
    color: #ffffff;
    border: none;
    padding: 0.55rem 0.85rem;
    border-radius: 10px;
    cursor: pointer;
    font-size: 1.1rem;
    box-shadow: 0 12px 35px rgba(3, 18, 115, 0.35);
}

.maincontentt {
    margin-left: 260px;
    width: calc(100% - 260px);
    padding: 2.5rem clamp(0.25rem, 0vw, 0rem) 3.5rem;
    padding-top: calc(var(--header-height) + 2.5rem);
    box-sizing: border-box;
}

.create-page-container {
    max-width: 1500px;
    margin: 0 auto;
    width: 100%;
    padding: 0 clamp(1.25rem, 0.8vw, 0.8rem);
    display: flex;
    flex-direction: column;
    gap: 1.75rem;
}

.hero-card {
    background: var(--card-bg);
    border-radius: var(--rounded-xl);
    padding: clamp(1.5rem, 4vw, 2.75rem);
    box-shadow: var(--shadow-lg);
    border: 1px solid rgba(99, 102, 241, 0.12);
    position: relative;
    overflow: hidden;
    isolation: isolate;
}

.hero-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent 55%);
    z-index: -1;
}

.hero-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.hero-title-section h3 {
    margin: 0;
    font-size: clamp(1.4rem, 4vw, 2.35rem);
    font-weight: 900;
    color: var(--heading);
}

.hero-title-section p {
    margin: 0.65rem 0 0;
    color: var(--muted);
    font-size: 1rem;
    line-height: 1.6;
}

.content-card {
    background: var(--card-bg);
    border-radius: 24px;
    padding: 1.5rem;
    box-shadow: 0 20px 55px rgba(15, 23, 42, 0.08);
    border: 1px solid rgba(15, 23, 42, 0.08);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
}

.card-header h4 {
    margin: 0;
    font-size: 1.35rem;
    font-weight: 900;
    color: var(--heading);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.search-container {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.search-input {
    flex: 1;
    min-width: 250px;
    border-radius: 14px;
    border: 1.5px solid rgba(148, 163, 184, 0.5);
    padding: 0.7rem 0.85rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--heading);
    background: #f8fafc;
    transition: all 0.2s ease;
}

.search-input:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    background: #ffffff;
}

.table-wrapper {
    overflow-x: auto;
    border-radius: 16px;
    border: 1px solid rgba(226, 232, 240, 0.8);
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.92rem;
}

.data-table thead {
    background: #f8fafc;
}

.data-table th {
    text-align: left;
    padding: 0.95rem 1rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted);
    font-weight: 800;
    border-bottom: 1px solid var(--border-color);
}

.data-table td {
    padding: 1rem;
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    color: #0f172a;
    vertical-align: top;
    background: #ffffff;
}

.data-table tbody tr:hover td {
    background: rgba(248, 250, 252, 0.7);
}

.status-badge {
    border-radius: 999px;
    padding: 0.35rem 0.9rem;
    font-size: 0.78rem;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    text-transform: uppercase;
}

.status-badge.active {
    background: rgba(16, 185, 129, 0.15);
    color: #059669;
}

.status-badge.inactive {
    background: rgba(239, 68, 68, 0.15);
    color: #dc2626;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    min-width: 120px;
}

.action-btn {
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 0.85rem;
    font-weight: 700;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    white-space: nowrap;
}

.action-btn.restore {
    background: rgba(16, 185, 129, 0.15);
    color: #059669;
    min-width: 110px;
    justify-content: center;
}

.action-btn.restore:hover {
    background: rgba(16, 185, 129, 0.25);
}

.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--muted);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state p {
    margin: 0;
    font-size: 1.1rem;
}

.btn {
    border: none;
    border-radius: 12px;
    padding: 0.85rem 1.35rem;
    font-weight: 800;
    font-size: 0.95rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #ffffff;
    box-shadow: 0 15px 35px rgba(124, 58, 237, 0.35);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.4);
}

.btn-secondary {
    background: rgba(15, 23, 42, 0.08);
    color: var(--heading);
    border: 1px solid rgba(15, 23, 42, 0.08);
}

.btn-secondary:hover {
    background: rgba(15, 23, 42, 0.12);
}

.btn-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #ffffff;
    box-shadow: 0 15px 35px rgba(16, 185, 129, 0.35);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px rgba(16, 185, 129, 0.4);
}

.modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 12000;
    padding: 1.5rem;
    background: rgba(15, 23, 42, 0.55);
    backdrop-filter: blur(6px) saturate(140%);
    align-items: center;
    justify-content: center;
}

.modal-card {
    width: min(520px, 100%);
    background: #ffffff;
    border-radius: 22px;
    border: 1px solid rgba(148, 163, 184, 0.35);
    box-shadow: 0 35px 80px rgba(15, 23, 42, 0.25);
    overflow: hidden;
    animation: modalPop 0.35s ease;
}

.modal-card__header {
    padding: 1.35rem 1.75rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #ffffff;
}

.modal-card__title {
    display: flex;
    align-items: center;
    gap: 0.85rem;
}

.modal-card__title div h3 {
    margin: 0;
    font-size: 1.15rem;
    font-weight: 800;
    letter-spacing: 0.01em;
}

.modal-card__title div p {
    margin: 0.2rem 0 0;
    font-size: 0.85rem;
    opacity: 0.85;
}

.modal-card__icon {
    width: 44px;
    height: 44px;
    border-radius: 16px;
    background: rgba(255, 255, 255, 0.2);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
}

.modal-card__close {
    background: rgba(255, 255, 255, 0.18);
    border: none;
    color: #ffffff;
    width: 36px;
    height: 36px;
    border-radius: 12px;
    cursor: pointer;
    transition: background 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.modal-card__close:hover {
    background: rgba(255, 255, 255, 0.35);
}

.modal-card__body {
    padding: 1.5rem 1.75rem 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.modal-card__body p {
    margin: 0;
    font-size: 0.95rem;
    color: var(--muted);
    line-height: 1.6;
}

.modal-actions {
    padding: 0 1.75rem 1.5rem;
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.modal-card--warning .modal-card__header {
    background: linear-gradient(135deg, #f97316, #ea580c);
}

.modal-card--success .modal-card__header {
    background: linear-gradient(135deg, #10b981, #059669);
}

.modal-card--info .modal-card__header {
    background: linear-gradient(135deg, #0ea5e9, #2563eb);
}

.modal-card form {
    margin: 0;
}

@keyframes modalPop {
    from {
        opacity: 0;
        transform: translateY(15px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

body .nav-links {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
    padding: 1.25rem 1rem 2rem;
}

body .nav-links a,
body .nav-links span {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    color: #e5e7eb;
    font-size: 1rem;
    font-weight: 600;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    transition: background 0.2s ease, color 0.2s ease;
}

body .nav-links a:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
}

body .nav-links a.active {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
    font-weight: 800;
}

@media (max-width: 768px) {
    .toggle-btn {
        display: flex;
    }

    .maincontentt {
        margin-left: 0;
        width: 100%;
        padding: 1.25rem;
        padding-top: calc(var(--header-height) + 1.25rem);
    }

    .sidenav {
        transform: translateX(-100%);
    }

    .sidenav.active {
        transform: translateX(0);
    }
}
    </style>
</head>
<body>
<!-- Toggle Button for Mobile -->
<button class="toggle-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidenav -->
<aside class="sidenav" id="sidenav">
    <div class="logo-container" style="display: flex; flex-direction: column; align-items: center;">
        <img src="{{ asset('image/mdrrmologo.jpg') }}" alt="Logo" class="logo-img" style="display: block; margin: 0 auto;">
        <div style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 800; color: #ffffff; letter-spacing: .5px;">SILANG MDRRMO</div>
    </div>
    <nav class="nav-links">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
        <span class="nav-link-locked" style="display: block; padding: 12px 16px; color: #9ca3af; cursor: not-allowed; opacity: 0.6; position: relative;"><i class="fas fa-pen"></i> Posting <i class="fas fa-lock" style="font-size: 10px; margin-left: 8px; opacity: 0.7;"></i></span>
        <a href="{{ url('/admin/pairing') }}" class="{{ request()->is('admin/pairing') ? 'active' : '' }}"><i class="fas fa-link"></i> Pairing</a>
        <a href="{{ url('/admin/drivers') }}" class="{{ request()->is('admin/drivers*') ? 'active' : '' }}"><i class="fas fa-car"></i> Drivers</a>
        <a href="{{ url('/admin/medics') }}" class="{{ request()->is('admin/medics*') ? 'active' : '' }}"><i class="fas fa-plus"></i> Create</a>
        <a href="{{ url('/admin/gps') }}" class="{{ request()->is('admin/gps') ? 'active' : '' }}"><i class="fas fa-map-marker-alt mr-1"></i> GPS Tracker</a>
        <a href="{{ url('/admin/reports') }}" class="{{ request()->is('admin/reports*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Reports</a>
    </nav>
</aside>

<!-- Fixed Top Header -->
<div class="mdrrmo-header" style="background:#F7F7F7; box-shadow: 0 2px 8px rgba(0,0,0,0.12); border: none; min-height: var(--header-height); padding: 1rem 2rem; display: flex; align-items: center; justify-content: center; position:fixed; top:0; left:0; right:0; z-index:1000;">
    <h2 class="header-title" style="display:none;"></h2>
    @php $firstName = explode(' ', auth()->user()->name ?? 'Admin')[0]; @endphp
    <div id="userMenu" style="position: fixed; right: 16px; top: 16px; display: inline-flex; align-items: center; gap: 10px; cursor: pointer; color: #e5e7eb; z-index: 1000; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); padding: 6px 10px; border-radius: 9999px; box-shadow: 0 6px 18px rgba(0,0,0,0.18); backdrop-filter: saturate(140%);">
        <div style="width: 28px; height: 28px; border-radius: 9999px; background: linear-gradient(135deg,#4CC9F0,#031273); display: inline-flex; align-items: center; justify-content: center; position: relative;">
            <i class="fas fa-user-shield" style="font-size: 14px; color: #ffffff;"></i>
            <span style="position: absolute; right: -1px; bottom: -1px; width: 8px; height: 8px; border-radius: 9999px; background: #22c55e; box-shadow: 0 0 0 2px #0c2d5a;"></span>
        </div>
        <span style="font-weight: 800; color: #000000; letter-spacing: .2px;">{{ $firstName }}</span>
        <i class="fas fa-chevron-down" style="font-size: 10px; color: rgba(255,255,255,0.85);"></i>
        <div id="userDropdown" style="display: none; position: absolute; right: 0; top: calc(100% + 12px); background: #ffffff; color: #0f172a; border-radius: 10px; box-shadow: 0 10px 24px rgba(0,0,0,0.2); padding: 8px; min-width: 160px; z-index: 1001;">
            <div style="position: absolute; right: 12px; top: -8px; width: 0; height: 0; border-left: 8px solid transparent; border-right: 8px solid transparent; border-bottom: 8px solid #ffffff;"></div>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button id="changeAccountBtn" type="submit" style="width: 100%; background: linear-gradient(135deg,#ef4444,#b91c1c); color: #ffffff; border: none; border-radius: 8px; padding: 6px 8px; font-weight: 700; font-size: 12px; display: inline-flex; align-items: center; justify-content: center; gap: 6px; cursor: pointer; box-shadow: 0 4px 12px rgba(239,68,68,0.28);">
                    <i class="fas fa-right-left" style="font-size: 12px;"></i>
                    <span>Change account</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Main content -->
<main class="maincontentt pt-24">
    <div class="create-page-container">
        <!-- Hero Section -->
        <section class="hero-card">
            <div class="hero-header">
                <div class="hero-title-section">
                    <h3><i class="fas fa-box-archive"></i> Archived Medics</h3>
                    <p>View and manage archived medics. You can restore them back to active status if needed.</p>
                </div>
                <a href="{{ route('admin.medics.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Back to Medics
                </a>
            </div>
        </section>

        <!-- Archived Medics List -->
        <div class="content-card">
            <div class="card-header">
                <h4><i class="fas fa-box-archive"></i> Archived Medics</h4>
            </div>

            <div class="search-container">
                <input type="text" id="medicSearchInput" class="search-input" placeholder="Search by name, phone, or specialization...">
                <button type="button" id="clearMedicSearch" class="btn btn-secondary" style="display: none;">
                    <i class="fas fa-times"></i> Clear
                </button>
            </div>

            <div class="table-wrapper">
                <table class="data-table" data-paginate="true" data-page-size="10">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Specialization</th>
                            <th>Status</th>
                            <th>Archived At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medics as $medic)
                            <tr>
                                <td style="font-weight: 700;">{{ $medic->name }}</td>
                                <td>{{ $medic->phone ?? 'N/A' }}</td>
                                <td>{{ $medic->specialization ?? 'N/A' }}</td>
                                <td>
                                    <span class="status-badge {{ $medic->status === 'active' ? 'active' : 'inactive' }}">
                                        {{ ucfirst($medic->status) }}
                                    </span>
                                </td>
                                <td>{{ $medic->archived_at ? $medic->archived_at->format('M d, Y h:i A') : 'N/A' }}</td>
                                <td class="action-buttons">
                                    <button onclick="openRestoreModal({{ $medic->id }}, '{{ $medic->name }}')" class="action-btn restore">
                                        <i class="fas fa-undo"></i> Restore
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-box-archive"></i>
                                        <p>No archived medics found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 0.5rem; padding: 1rem;">
                <button class="btn btn-secondary" data-prev>Prev</button>
                <button class="btn btn-secondary" data-next>Next</button>
            </div>
        </div>
    </div>
</main>

<!-- Success Modal -->
<div id="successModal" class="modal">
    <div class="modal-card modal-card--success">
        <div class="modal-card__header">
            <div class="modal-card__title">
                <span class="modal-card__icon"><i class="fas fa-check-circle"></i></span>
                <div>
                    <h3>Success</h3>
                    <p>Action completed.</p>
                </div>
            </div>
            <button class="modal-card__close" type="button" onclick="closeSuccessModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-card__body">
            <p id="successMessage">{{ session('success') }}</p>
        </div>
        <div class="modal-actions">
            <button onclick="closeSuccessModal()" class="btn btn-success" type="button">
                <i class="fas fa-check"></i> Continue
            </button>
        </div>
    </div>
</div>

<!-- Restore Confirmation Modal -->
<div id="restoreConfirmModal" class="modal">
    <div class="modal-card modal-card--success">
        <div class="modal-card__header">
            <div class="modal-card__title">
                <span class="modal-card__icon"><i class="fas fa-undo"></i></span>
                <div>
                    <h3>Restore Medic</h3>
                    <p>Send the medic back to the active roster.</p>
                </div>
            </div>
            <button class="modal-card__close" type="button" onclick="closeRestoreConfirmModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-card__body">
            <p>
                Are you sure you want to restore <strong id="restoreMedicName"></strong>? This medic will be moved
                back to the active medics list.
            </p>
        </div>
        <div class="modal-actions">
            <button type="button" onclick="closeRestoreConfirmModal()" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </button>
            <form id="restoreConfirmForm" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-undo"></i> Restore
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    const sidenav = document.getElementById('sidenav');
    if (!sidenav) return;
    sidenav.classList.toggle('active');
}

function showSuccessModal(message) {
    document.getElementById('successMessage').textContent = message;
    document.getElementById('successModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

let selectedRestoreMedicId = null;

function openRestoreModal(id, name) {
    selectedRestoreMedicId = id;
    document.getElementById('restoreMedicName').textContent = name;
    document.getElementById('restoreConfirmForm').action = `/admin/medics/${id}/restore`;
    document.getElementById('restoreConfirmModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeRestoreConfirmModal() {
    document.getElementById('restoreConfirmModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    selectedRestoreMedicId = null;
}

function filterMedicTable() {
    const searchInput = document.getElementById('medicSearchInput');
    const clearBtn = document.getElementById('clearMedicSearch');
    const table = document.querySelector('.data-table tbody');
    
    if (!searchInput || !table) return;
    
    const searchTerm = searchInput.value.toLowerCase().trim();
    const rows = table.querySelectorAll('tr');
    
    let visibleCount = 0;
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const matches = text.includes(searchTerm);
        
        if (matches || searchTerm === '') {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    clearBtn.style.display = searchTerm !== '' ? 'block' : 'none';
}

function clearMedicSearch() {
    const searchInput = document.getElementById('medicSearchInput');
    if (searchInput) {
        searchInput.value = '';
        filterMedicTable();
    }
}

// User menu toggle
(function(){
    const userMenu = document.getElementById('userMenu');
    const userDropdown = document.getElementById('userDropdown');
    const changeBtn = document.getElementById('changeAccountBtn');
    if (changeBtn) {
        changeBtn.addEventListener('click', function(ev){
            ev.preventDefault();
            const form = changeBtn.closest('form');
            if (!form) return;
            const action = form.getAttribute('action');
            const tokenInput = form.querySelector('input[name="_token"]');
            const token = tokenInput ? tokenInput.value : '';
            fetch(action, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({})
            }).finally(() => { window.location.href = '{{ route('login') }}'; });
        });
    }
    if (userMenu && userDropdown) {
        userMenu.addEventListener('click', function(e){
            e.stopPropagation();
            const isOpen = userDropdown.style.display === 'block';
            userDropdown.style.display = isOpen ? 'none' : 'block';
        });
        document.addEventListener('click', function(){
            if (userDropdown.style.display === 'block') userDropdown.style.display = 'none';
        });
    }
})();

window.onclick = function(event) {
    const successModal = document.getElementById('successModal');
    const restoreModal = document.getElementById('restoreConfirmModal');
    if (event.target === successModal) closeSuccessModal();
    if (event.target === restoreModal) closeRestoreConfirmModal();
}

document.addEventListener('DOMContentLoaded', function(){
    @if(session('success'))
        showSuccessModal('{{ session('success') }}');
    @endif

    const medicSearchInput = document.getElementById('medicSearchInput');
    const clearMedicBtn = document.getElementById('clearMedicSearch');

    if (medicSearchInput) {
        medicSearchInput.addEventListener('input', filterMedicTable);
    }

    if (clearMedicBtn) {
        clearMedicBtn.addEventListener('click', clearMedicSearch);
    }

    // Simple pagination
    document.querySelectorAll('table.data-table[data-paginate="true"]').forEach(function(tbl){
        const pageSize = parseInt(tbl.getAttribute('data-page-size') || '10', 10);
        const tbody = tbl.querySelector('tbody');
        if (!tbody) return;
        const rows = Array.from(tbody.children);
        if (rows.length <= pageSize) return;

        let page = 0;
        const container = tbl.closest('.content-card');
        const prevBtn = container.querySelector('[data-prev]');
        const nextBtn = container.querySelector('[data-next]');

        function render(){
            rows.forEach((tr, i)=>{
                const inPage = i >= page*pageSize && i < (page+1)*pageSize;
                tr.style.display = inPage ? '' : 'none';
            });
            if (prevBtn) prevBtn.disabled = page === 0;
            if (nextBtn) nextBtn.disabled = (page+1)*pageSize >= rows.length;
        }
        if (prevBtn) prevBtn.addEventListener('click', function(){ if (page>0){ page--; render(); } });
        if (nextBtn) nextBtn.addEventListener('click', function(){ if ((page+1)*pageSize < rows.length){ page++; render(); } });
        render();
    });
});
</script>
</body>
</html>

