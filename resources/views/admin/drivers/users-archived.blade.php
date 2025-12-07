<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Archived Users - MDRRMO</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/stylish.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-view.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Laravel CSRF Token -->
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

.users-page-container {
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
    border: 1px solid rgba(239, 68, 68, 0.12);
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: clamp(1.25rem, 3vw, 2.5rem);
    align-items: center;
    position: relative;
    overflow: hidden;
    isolation: isolate;
}

.hero-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(239, 68, 68, 0.15), transparent 55%);
    z-index: -1;
}

.hero-card h3 {
    margin: 0;
    font-size: clamp(1.4rem, 4vw, 2.35rem);
    font-weight: 900;
}

.hero-card p {
    margin: 0.65rem 0 0;
    color: var(--muted);
    font-size: 1rem;
    line-height: 1.6;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.35rem 0.85rem;
    border-radius: 999px;
    background: rgba(239, 68, 68, 0.1);
    color: #991b1b;
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-top: 1.25rem;
}

.hero-actions button {
    border: none;
    border-radius: 14px;
    padding: 0.85rem 1.35rem;
    font-weight: 800;
    font-size: 0.95rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    color: #ffffff;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    box-shadow: 0 15px 35px rgba(124, 58, 237, 0.35);
}

.hero-actions button.secondary {
    background: rgba(15, 23, 42, 0.08);
    color: var(--heading);
    border: 1px solid rgba(15, 23, 42, 0.08);
    box-shadow: none;
}

.hero-actions button:hover {
    transform: translateY(-2px);
}

.hero-kpis {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.hero-kpi-card {
    background: rgba(239, 68, 68, 0.08);
    border-radius: 18px;
    padding: 1rem 1.1rem;
    border: 1px solid rgba(239, 68, 68, 0.2);
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.hero-kpi-card span {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-weight: 700;
    color: #991b1b;
}

.hero-kpi-card strong {
    font-size: 1.65rem;
    font-weight: 900;
    color: #7f1d1d;
}

.filters-card {
    background: var(--card-bg);
    border-radius: 24px;
    padding: 1.5rem;
    box-shadow: 0 20px 55px rgba(15, 23, 42, 0.08);
    border: 1px solid rgba(15, 23, 42, 0.08);
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.filters-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.filters-header h5 {
    margin: 0;
    font-size: 1.05rem;
    font-weight: 800;
    color: var(--heading);
}

.filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 1rem;
}

.users-field {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}

.users-field span {
    font-size: 0.78rem;
    text-transform: uppercase;
    font-weight: 800;
    letter-spacing: 0.06em;
    color: var(--muted);
}

.users-input,
.users-select {
    border-radius: 14px;
    border: 1.5px solid rgba(148, 163, 184, 0.5);
    padding: 0.7rem 0.85rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--heading);
    background: #f8fafc;
    transition: border 0.2s ease, box-shadow 0.2s ease;
}

.users-input:focus,
.users-select:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    background: #ffffff;
}

.table-card {
    background: var(--card-bg);
    border-radius: 26px;
    border: 1px solid rgba(15, 23, 42, 0.08);
    box-shadow: 0 25px 60px rgba(15, 23, 42, 0.12);
    overflow: hidden;
}

.table-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem 1.75rem;
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    flex-wrap: wrap;
}

.table-card-header h4 {
    margin: 0;
    font-size: 1.35rem;
    font-weight: 900;
}

.table-meta {
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
    font-size: 0.9rem;
    color: var(--muted);
}

.table-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem;
}

.table-actions button {
    border: none;
    border-radius: 12px;
    padding: 0.55rem 1rem;
    font-weight: 700;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    cursor: pointer;
    background: #f1f5f9;
    color: #0f172a;
    transition: background 0.2s ease, transform 0.2s ease;
}

.table-actions button.primary {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #ffffff;
    box-shadow: 0 15px 35px rgba(37, 99, 235, 0.35);
}

.table-actions button:hover {
    transform: translateY(-2px);
}

.users-table-wrapper {
    overflow-x: auto;
}

.users-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.92rem;
}

.users-table thead {
    background: #f8fafc;
}

.users-table th {
    text-align: left;
    padding: 0.95rem 1rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted);
    font-weight: 800;
    border-bottom: 1px solid var(--border-color);
}

.users-table td {
    padding: 1rem;
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    color: #0f172a;
    vertical-align: top;
    background: #ffffff;
}

.users-table tbody tr:hover td {
    background: rgba(248, 250, 252, 0.7);
}

.users-pill {
    border-radius: 999px;
    padding: 0.35rem 0.9rem;
    font-size: 0.78rem;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.users-pill--role-admin { background: rgba(239, 68, 68, 0.15); color: #991b1b; }
.users-pill--role-user { background: rgba(59, 130, 246, 0.15); color: #1e40af; }
.users-pill--status-active { background: rgba(16, 185, 129, 0.15); color: #047857; }
.users-pill--status-inactive { background: rgba(148, 163, 184, 0.25); color: #475569; }

.users-empty,
.users-error {
    padding: 2rem;
    text-align: center;
    color: var(--muted);
    display: flex;
    flex-direction: column;
    gap: 0.65rem;
    align-items: center;
}

.users-empty i,
.users-error i {
    font-size: 1.9rem;
    opacity: 0.6;
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

@media (max-width: 1100px) {
    .hero-card {
        grid-template-columns: 1fr;
    }
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

    .hero-actions button,
    .table-actions button {
        width: 100%;
        justify-content: center;
    }

    .table-card-header {
        flex-direction: column;
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
        <img src="{{ asset('image/LOGOMDRRMO.png') }}" alt="Logo" class="logo-img" style="display: block; margin: 0 auto;">
        <div style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 800; color: #ffffff; letter-spacing: .5px;">SILANG DRRMO</div>
        <div id="sidebarDateTime" style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 600; color: #ffffff; font-size: 0.9rem; letter-spacing: 0.3px; padding: 0 12px;">
            <div id="sidebarDate" style="margin-bottom: 4px; font-weight: 600; font-size: 0.85rem;"></div>
            <div id="sidebarTime" style="font-weight: 800; font-size: 1rem;"></div>
        </div>
    </div>
    <nav class="nav-links">
     <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a href="{{ url('/admin/pairing') }}" class="{{ request()->is('admin/pairing') ? 'active' : '' }}"><i class="fas fa-link"></i> Pairing</a>
      <a href="{{ url('/admin/drivers') }}" class="{{ request()->is('admin/drivers*') ? 'active' : '' }}"><i class="fas fa-car"></i> Personnels</a>
      <a href="{{ url('/admin/medics') }}" class="{{ request()->is('admin/medics*') ? 'active' : '' }}"><i class="fas fa-plus"></i> Create</a>
      <a href="{{ url('/admin/gps') }}" class="{{ request()->is('admin/gps') ? 'active' : '' }}"><i class="fas fa-map-marker-alt mr-1"></i> GPS Tracker</a>
      <a href="{{ url('/admin/reports') }}" class="{{ request()->is('admin/reports*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Case Logs</a>
      <a href="{{ route('reported-cases') }}" class="{{ request()->routeIs('reported-cases') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Reported Cases</a>
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
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Main content -->
<main class="maincontentt pt-24">
    <div class="users-page-container">

        <section class="hero-card">
            <div>
                <span class="hero-badge">
                    <i class="fas fa-archive"></i> Archived Users
                </span>
                <h3>Restore or manage archived users.</h3>
                <p>
                    View archived user accounts and restore them to active status when needed.
                </p>
                <div class="hero-actions">
                    <button type="button" class="primary" id="refreshArchivedBtn"><i class="fas fa-rotate"></i> Refresh data</button>
                    <button type="button" class="secondary" onclick="window.location.href='{{ route('admin.drivers.users') }}'"><i class="fas fa-arrow-left"></i> Back to Users</button>
                </div>
            </div>
            <div class="hero-kpis">
                <div class="hero-kpi-card">
                    <span>Archived Users</span>
                    <strong id="metricArchivedUsers">--</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Admins</span>
                    <strong id="metricArchivedAdmins">--</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Regular Users</span>
                    <strong id="metricArchivedRegular">--</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Oldest Archive</span>
                    <strong id="metricOldestArchive" style="font-size: 1.1rem;">--</strong>
                </div>
            </div>
        </section>

        <section class="filters-card">
            <div class="filters-header">
                <h5>Search & Filter</h5>
            </div>
            <div class="filters-grid">
                <label class="users-field">
                    <span>Search</span>
                    <input id="archived-search" type="text" placeholder="Search by name or email" class="users-input">
                </label>
                <label class="users-field">
                    <span>Role</span>
                    <select id="archived-role" class="users-select">
                        <option value="">All</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </label>
            </div>
        </section>

        <section class="table-card">
            <div class="table-card-header">
                <div>
                    <h4>Archived Users Directory</h4>
                    <div class="table-meta">
                        <span id="lastRefreshedLabel">Waiting for first sync...</span>
                        <span id="tableCountLabel">0 entries visible</span>
                    </div>
                </div>
                <div class="table-actions">
                    <button type="button" class="primary" id="refreshArchivedTableBtn"><i class="fas fa-rotate"></i> Refresh</button>
                    <button type="button" onclick="window.location.href='{{ route('admin.drivers.users') }}'" style="background: rgba(148, 163, 184, 0.15); color: #475569;"><i class="fas fa-users"></i> View Active</button>
                </div>
            </div>

            <div class="users-table-wrapper">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Archived Date</th>
                            <th>Last Login</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="archived-table-body">
                        <tr>
                            <td colspan="7">
                                <div class="users-empty">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    <p>Loading archived users...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</main>

<script>
let archivedUsersCache = [];
let lastFetchTimestamp = null;
const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
const csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : '';

async function loadArchivedUsers() {
    try {
        const response = await fetch('/admin/users/archived', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        archivedUsersCache = Array.isArray(data) ? data : (data.users || []);
        lastFetchTimestamp = Date.now();

        updateArchivedInsights();
        renderArchivedList();
        updateLastRefreshedLabel();
    } catch (error) {
        console.error('Error loading archived users:', error);
        const archivedTableBody = document.getElementById('archived-table-body');
        if (archivedTableBody) {
            archivedTableBody.innerHTML = `
                <tr>
                    <td colspan="7">
                        <div class="users-error">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p>Error loading archived users. Please try again later.</p>
                        </div>
                    </td>
                </tr>
            `;
        }
    }
}

function getArchivedFilters() {
    const search = (document.getElementById('archived-search')?.value || '').toLowerCase().trim();
    const role = document.getElementById('archived-role')?.value || '';
    return { search, role };
}

function filterArchivedUsers(list) {
    const { search, role } = getArchivedFilters();
    return list.filter(u => {
        const matchesRole = !role || (u.role || 'user').toLowerCase() === role.toLowerCase();
        const haystack = `${u.name || ''} ${u.email || ''}`.toLowerCase();
        const matchesSearch = !search || haystack.includes(search);
        return matchesRole && matchesSearch;
    });
}

function formatDateTime(value) {
    if (!value) return 'Never';
    const date = new Date(value);
    if (Number.isNaN(date.getTime())) return value;
    return date.toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function formatDate(value) {
    if (!value) return 'Never';
    const date = new Date(value);
    if (Number.isNaN(date.getTime())) return value;
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

function updateArchivedInsights() {
    const total = archivedUsersCache.length;
    const admins = archivedUsersCache.filter(u => (u.role || 'user').toLowerCase() === 'admin').length;
    const regular = total - admins;
    
    const archivedDates = archivedUsersCache
        .filter(u => u.archived_at)
        .map(u => new Date(u.archived_at))
        .sort((a, b) => a - b);
    const oldestArchive = archivedDates.length > 0 ? formatDate(archivedDates[0]) : '--';

    document.getElementById('metricArchivedUsers').textContent = total || '--';
    document.getElementById('metricArchivedAdmins').textContent = admins || '--';
    document.getElementById('metricArchivedRegular').textContent = regular || '--';
    document.getElementById('metricOldestArchive').textContent = oldestArchive;
}

function updateTableCountLabel(count = 0) {
    const label = document.getElementById('tableCountLabel');
    if (label) {
        label.textContent = `${count} entr${count === 1 ? 'y' : 'ies'} visible`;
    }
}

function updateLastRefreshedLabel() {
    const label = document.getElementById('lastRefreshedLabel');
    if (!label) return;
    if (!lastFetchTimestamp) {
        label.textContent = 'Waiting for first sync...';
        return;
    }
    const date = new Date(lastFetchTimestamp);
    label.textContent = `Last refreshed ${date.toLocaleString()}`;
}

function getVisibleArchivedUsers() {
    return filterArchivedUsers(archivedUsersCache || []);
}

function renderArchivedList() {
    const archivedTableBody = document.getElementById('archived-table-body');
    if (!archivedTableBody) return;
    archivedTableBody.innerHTML = '';
    const filtered = getVisibleArchivedUsers();
    updateTableCountLabel(filtered.length);

    if (!Array.isArray(filtered) || filtered.length === 0) {
        archivedTableBody.innerHTML = `
            <tr>
                <td colspan="7">
                    <div class="users-empty">
                        <i class="fas fa-inbox"></i>
                        <p>No archived users found</p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    filtered.forEach(user => {
        const role = (user.role || 'user').toLowerCase();
        const roleClass = role === 'admin' ? 'users-pill--role-admin' : 'users-pill--role-user';
        const userId = user.id;
        const userName = (user.name || 'Unknown').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        const userEmail = (user.email || 'N/A').replace(/</g, '&lt;').replace(/>/g, '&gt;');

        const row = document.createElement('tr');
        row.innerHTML = `
            <td><strong>${userName}</strong></td>
            <td>${userEmail}</td>
            <td><span class="users-pill ${roleClass}">${role.charAt(0).toUpperCase() + role.slice(1)}</span></td>
            <td>${formatDateTime(user.archived_at)}</td>
            <td>${formatDateTime(user.last_login_at || user.last_login)}</td>
            <td>${formatDateTime(user.created_at)}</td>
            <td>
                <button class="users-action-btn restore-user-btn" data-user-id="${userId}" data-user-name="${userName}" style="padding: 0.4rem 0.8rem; border-radius: 8px; border: 1px solid #86efac; background: #dcfce7; color: #166534; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: all 0.2s;">
                    <i class="fas fa-undo"></i> Restore
                </button>
            </td>
        `;
        archivedTableBody.appendChild(row);
    });
}

// Restore User Function
async function restoreUser(userId, userName) {
    if (!confirm(`Are you sure you want to restore "${userName}"?`)) {
        return;
    }
    
    try {
        const response = await fetch(`/admin/users/${userId}/restore`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin'
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('User restored successfully');
            loadArchivedUsers();
        } else {
            alert(data.message || 'Failed to restore user');
        }
    } catch (error) {
        console.error('Error restoring user:', error);
        alert('Error restoring user. Please try again.');
    }
}

// Event listeners
document.getElementById('archived-search')?.addEventListener('input', () => renderArchivedList());
document.getElementById('archived-role')?.addEventListener('change', () => renderArchivedList());

document.getElementById('refreshArchivedBtn')?.addEventListener('click', () => loadArchivedUsers());
document.getElementById('refreshArchivedTableBtn')?.addEventListener('click', () => loadArchivedUsers());

// Restore button handler
document.addEventListener('click', function(e) {
    if (e.target.closest('.restore-user-btn')) {
        const btn = e.target.closest('.restore-user-btn');
        const userId = btn.getAttribute('data-user-id');
        const userName = btn.getAttribute('data-user-name');
        restoreUser(userId, userName);
    }
});

// User menu toggle
document.getElementById('userMenu')?.addEventListener('click', function(e) {
    e.stopPropagation();
    const dropdown = document.getElementById('userDropdown');
    if (dropdown) {
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }
});

document.addEventListener('click', function(e) {
    const userMenu = document.getElementById('userMenu');
    const dropdown = document.getElementById('userDropdown');
    if (userMenu && dropdown && !userMenu.contains(e.target)) {
        dropdown.style.display = 'none';
    }
});

// Sidebar toggle function
function toggleSidebar() {
    const sidenav = document.getElementById('sidenav');
    if (sidenav) {
        sidenav.classList.toggle('active');
    }
}

// Update sidebar date and time
function updateSidebarDateTime() {
    const now = new Date();
    const dateEl = document.getElementById('sidebarDate');
    const timeEl = document.getElementById('sidebarTime');
    
    if (dateEl) {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        dateEl.textContent = now.toLocaleDateString('en-US', options);
    }
    
    if (timeEl) {
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        timeEl.textContent = `${hours}:${minutes}:${seconds}`;
    }
}

// Update date/time immediately and then every second
document.addEventListener('DOMContentLoaded', function() {
    updateSidebarDateTime();
    setInterval(updateSidebarDateTime, 1000);
    loadArchivedUsers(); // Load archived users data on page load
});
</script>

</body>
</html>

