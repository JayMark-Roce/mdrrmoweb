<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Management - MDRRMO</title>

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
    border: 1px solid rgba(99, 102, 241, 0.12);
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
    background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent 55%);
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
    background: rgba(37, 99, 235, 0.1);
    color: #1d4ed8;
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
    background: rgba(99, 102, 241, 0.08);
    border-radius: 18px;
    padding: 1rem 1.1rem;
    border: 1px solid rgba(99, 102, 241, 0.2);
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.hero-kpi-card span {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-weight: 700;
    color: #4338ca;
}

.hero-kpi-card strong {
    font-size: 1.65rem;
    font-weight: 900;
    color: #1e1b4b;
}

.insight-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.25rem;
}

.insight-card {
    background: var(--card-bg);
    border-radius: 22px;
    padding: 1.35rem;
    border: 1px solid rgba(15, 23, 42, 0.08);
    box-shadow: 0 25px 50px rgba(15, 23, 42, 0.08);
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}

.insight-card small {
    font-weight: 800;
    text-transform: uppercase;
    color: var(--muted);
    letter-spacing: 0.1em;
}

.insight-card h4 {
    margin: 0;
    font-size: 2rem;
    font-weight: 900;
    color: var(--heading);
}

.insight-trend {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-weight: 700;
    font-size: 0.9rem;
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

.active-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 0.45rem;
}

.filter-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.35rem 0.9rem;
    border-radius: 999px;
    background: rgba(37, 99, 235, 0.1);
    color: #1d4ed8;
    font-weight: 700;
    font-size: 0.8rem;
}
.filter-chip.muted {
    background: rgba(15, 23, 42, 0.1);
    color: var(--muted);
}

.filter-chip button {
    border: none;
    background: transparent;
    cursor: pointer;
    font-size: 1rem;
    color: inherit;
    line-height: 1;
    padding: 0;
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
                    <i class="fas fa-users-cog"></i> Admin Management
                </span>
                <h3>Manage system administrators.</h3>
                <p>
                    View, manage, and control administrator accounts and access across the MDRRMO system.
                </p>
                <div class="hero-actions">
                    <button type="button" class="primary" id="refreshUsersBtn"><i class="fas fa-rotate"></i> Refresh data</button>
                    <button type="button" class="secondary" onclick="window.location.href='{{ route('admin.drivers.index') }}'"><i class="fas fa-arrow-left"></i> Back to Personnels</button>
                </div>
            </div>
            <div class="hero-kpis">
                <div class="hero-kpi-card">
                    <span>Total Admins</span>
                    <strong id="metricTotalUsers">--</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Active Admins</span>
                    <strong id="metricAdmins">--</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Inactive Admins</span>
                    <strong id="metricActiveUsers">--</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Last Login</span>
                    <strong id="metricLastLogin">--</strong>
                </div>
            </div>
        </section>

        <section class="insight-grid" id="usersInsights">
            <article class="insight-card">
                <small>Total admins</small>
                <h4 id="insightTotal">--</h4>
                <div class="insight-trend"><i class="fas fa-user-shield" style="color: var(--accent);"></i><span>Administrator accounts</span></div>
            </article>
            <article class="insight-card">
                <small>Active admins</small>
                <h4 id="insightAdmins">--</h4>
                <div class="insight-trend"><i class="fas fa-circle" style="color: var(--success);"></i><span>Currently active</span></div>
            </article>
            <article class="insight-card">
                <small>Inactive admins</small>
                <h4 id="insightRegular">--</h4>
                <div class="insight-trend"><i class="fas fa-user-slash" style="color: var(--muted);"></i><span>Inactive accounts</span></div>
            </article>
            <article class="insight-card">
                <small>Recent logins</small>
                <h4 id="insightActive">--</h4>
                <div class="insight-trend"><i class="fas fa-clock" style="color: var(--accent-alt);"></i><span>Last 24 hours</span></div>
            </article>
        </section>

        <section class="filters-card">
            <div class="filters-header">
                <h5>Search & Filter</h5>
                <div class="active-filters" id="activeFilters">
                    <span class="filter-chip muted">No filters applied</span>
                </div>
            </div>
            <div class="filters-grid">
                <label class="users-field">
                    <span>Search</span>
                    <input id="users-search" type="text" placeholder="Search by name or email" class="users-input">
                </label>
                <label class="users-field">
                    <span>Role</span>
                    <select id="users-role" class="users-select">
                        <option value="">All</option>
                        <option value="admin">Admin</option>
                    </select>
                </label>
                <label class="users-field">
                    <span>Status</span>
                    <select id="users-status" class="users-select">
                        <option value="">All</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </label>
            </div>
        </section>

        <section class="table-card">
            <div class="table-card-header">
                <div>
                    <h4>Admins Directory</h4>
                    <div class="table-meta">
                        <span id="lastRefreshedLabel">Waiting for first sync...</span>
                        <span id="tableCountLabel">0 entries visible</span>
                    </div>
                </div>
                <div class="table-actions">
                    <button type="button" class="primary" id="refreshUsersTableBtn"><i class="fas fa-rotate"></i> Refresh</button>
                    <button type="button" onclick="window.location.href='{{ route('admin.users.archived') }}'" style="background: rgba(148, 163, 184, 0.15); color: #475569;"><i class="fas fa-archive"></i> View Archived</button>
                    <button type="button" id="exportCsvBtn"><i class="fas fa-file-export"></i> Export CSV</button>
                </div>
            </div>

            <div class="users-table-wrapper">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        <tr>
                            <td colspan="7">
                                <div class="users-empty">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    <p>Loading admins...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</main>

<!-- Edit User Modal -->
<div id="editUserModal" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: #ffffff; border-radius: 20px; max-width: 480px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 60px rgba(0,0,0,0.3);">
        <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 1.25rem; font-weight: 900; color: #0f172a;">Edit Admin</h3>
            <button id="closeEditModal" style="background: transparent; border: none; font-size: 1.5rem; color: #6b7280; cursor: pointer; padding: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: background 0.2s;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="editUserForm" style="padding: 1.5rem;">
            <input type="hidden" id="editUserId" name="id">
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <label style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <span style="font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 0.06em; color: #6b7280;">Name</span>
                    <input type="text" id="editUserName" name="name" required style="border-radius: 12px; border: 1.5px solid rgba(148, 163, 184, 0.5); padding: 0.7rem 0.85rem; font-size: 0.95rem; font-weight: 600; color: #0f172a; background: #f8fafc; transition: border 0.2s, box-shadow 0.2s;" placeholder="Full Name" onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px rgba(37, 99, 235, 0.15)'; this.style.background='#ffffff';" onblur="this.style.borderColor='rgba(148, 163, 184, 0.5)'; this.style.boxShadow='none'; this.style.background='#f8fafc';">
                </label>
                <label style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <span style="font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 0.06em; color: #6b7280;">Email</span>
                    <input type="email" id="editUserEmail" name="email" required style="border-radius: 12px; border: 1.5px solid rgba(148, 163, 184, 0.5); padding: 0.7rem 0.85rem; font-size: 0.95rem; font-weight: 600; color: #0f172a; background: #f8fafc; transition: border 0.2s, box-shadow 0.2s;" placeholder="email@example.com" onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px rgba(37, 99, 235, 0.15)'; this.style.background='#ffffff';" onblur="this.style.borderColor='rgba(148, 163, 184, 0.5)'; this.style.boxShadow='none'; this.style.background='#f8fafc';">
                </label>
                <label style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <span style="font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 0.06em; color: #6b7280;">Role</span>
                    <select id="editUserRole" name="role" required style="border-radius: 12px; border: 1.5px solid rgba(148, 163, 184, 0.5); padding: 0.7rem 0.85rem; font-size: 0.95rem; font-weight: 600; color: #0f172a; background: #f8fafc; transition: border 0.2s, box-shadow 0.2s;" onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px rgba(37, 99, 235, 0.15)'; this.style.background='#ffffff';" onblur="this.style.borderColor='rgba(148, 163, 184, 0.5)'; this.style.boxShadow='none'; this.style.background='#f8fafc';">
                        <option value="admin">Admin</option>
                    </select>
                </label>
                <label style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <span style="font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 0.06em; color: #6b7280;">Status</span>
                    <select id="editUserStatus" name="status" required style="border-radius: 12px; border: 1.5px solid rgba(148, 163, 184, 0.5); padding: 0.7rem 0.85rem; font-size: 0.95rem; font-weight: 600; color: #0f172a; background: #f8fafc; transition: border 0.2s, box-shadow 0.2s;" onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px rgba(37, 99, 235, 0.15)'; this.style.background='#ffffff';" onblur="this.style.borderColor='rgba(148, 163, 184, 0.5)'; this.style.boxShadow='none'; this.style.background='#f8fafc';">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </label>
            </div>
            <div style="display: flex; gap: 0.75rem; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                <button type="submit" style="flex: 1; border: none; border-radius: 12px; padding: 0.75rem; font-weight: 800; font-size: 0.9rem; cursor: pointer; background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #ffffff; box-shadow: 0 15px 35px rgba(37, 99, 235, 0.35); transition: transform 0.2s;">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <button type="button" id="cancelEditModal" style="flex: 1; border: 1.5px solid #e5e7eb; border-radius: 12px; padding: 0.75rem; font-weight: 800; font-size: 0.9rem; cursor: pointer; background: #ffffff; color: #0f172a; transition: background 0.2s;">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let usersCache = [];
let lastFetchTimestamp = null;
const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
const csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : '';

async function loadUsers() {
    try {
        const response = await fetch('/admin/users', {
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
        usersCache = Array.isArray(data) ? data : (data.users || []);
        lastFetchTimestamp = Date.now();

        updateUsersInsights();
        renderUsersList();
        updateLastRefreshedLabel();
    } catch (error) {
        console.error('Error loading users:', error);
        const usersTableBody = document.getElementById('users-table-body');
        if (usersTableBody) {
            usersTableBody.innerHTML = `
                <tr>
                    <td colspan="7">
                        <div class="users-error">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p>Error loading admins: ${error.message}</p>
                            <p style="font-size: 0.8rem; margin-top: 0.5rem;">Please check the console for details.</p>
                        </div>
                    </td>
                </tr>
            `;
        }
    }
}

function getUsersFilters() {
    const search = (document.getElementById('users-search')?.value || '').toLowerCase().trim();
    const role = document.getElementById('users-role')?.value || '';
    const status = document.getElementById('users-status')?.value || '';
    return { search, role, status };
}

function filterUsers(list) {
    const { search, role, status } = getUsersFilters();
    return list.filter(u => {
        const matchesRole = !role || (u.role || 'admin').toLowerCase() === role.toLowerCase();
        const matchesStatus = !status || (u.status || 'active').toLowerCase() === status.toLowerCase();
        const haystack = `${u.name || ''} ${u.email || ''}`.toLowerCase();
        const matchesSearch = !search || haystack.includes(search);
        return matchesRole && matchesStatus && matchesSearch;
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

function updateUsersInsights() {
    const total = usersCache.length;
        const active = usersCache.filter(u => (u.status || 'active').toLowerCase() === 'active').length;
    const inactive = total - active;

    document.getElementById('metricTotalUsers').textContent = total || '--';
    document.getElementById('metricAdmins').textContent = active || '--';
    document.getElementById('metricActiveUsers').textContent = inactive || '--';
    
    document.getElementById('insightTotal').textContent = total || '--';
    document.getElementById('insightAdmins').textContent = active || '--';
    document.getElementById('insightRegular').textContent = inactive || '--';
    document.getElementById('insightActive').textContent = usersCache.filter(u => {
        if (!u.last_login_at && !u.last_login) return false;
        const lastLogin = new Date(u.last_login_at || u.last_login);
        const now = new Date();
        const hoursDiff = (now - lastLogin) / (1000 * 60 * 60);
        return hoursDiff <= 24;
    }).length || '--';
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

function getVisibleUsers() {
    return filterUsers(usersCache || []);
}

function renderUsersList() {
    const usersTableBody = document.getElementById('users-table-body');
    if (!usersTableBody) return;
    usersTableBody.innerHTML = '';
    const filtered = getVisibleUsers();
    updateTableCountLabel(filtered.length);

    if (!Array.isArray(filtered) || filtered.length === 0) {
        usersTableBody.innerHTML = `
            <tr>
                <td colspan="7">
                    <div class="users-empty">
                        <i class="fas fa-inbox"></i>
                        <p>No admins found</p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    filtered.forEach(user => {
        const role = (user.role || 'admin').toLowerCase();
        const status = (user.status || 'active').toLowerCase();
        const roleClass = 'users-pill--role-admin';
        const statusClass = status === 'active' ? 'users-pill--status-active' : 'users-pill--status-inactive';

        const row = document.createElement('tr');
        const userName = (user.name || 'Unknown').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        const userEmail = (user.email || 'N/A').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        const userId = user.id;
        
        row.innerHTML = `
            <td><strong>${userName}</strong></td>
            <td>${userEmail}</td>
            <td><span class="users-pill ${roleClass}">${role.charAt(0).toUpperCase() + role.slice(1)}</span></td>
            <td><span class="users-pill ${statusClass}">${status.charAt(0).toUpperCase() + status.slice(1)}</span></td>
            <td>${formatDateTime(user.last_login_at || user.last_login)}</td>
            <td>${formatDateTime(user.created_at)}</td>
            <td>
                <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                    <button class="users-action-btn edit-user-btn" data-user-id="${userId}" style="padding: 0.4rem 0.8rem; border-radius: 8px; border: 1px solid #e5e7eb; background: #f1f5f9; color: #0f172a; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: all 0.2s;">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="users-action-btn archive-user-btn" data-user-id="${userId}" data-user-name="${userName}" style="padding: 0.4rem 0.8rem; border-radius: 8px; border: 1px solid #fca5a5; background: #fee2e2; color: #991b1b; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: all 0.2s;">
                        <i class="fas fa-archive"></i> Archive
                    </button>
                </div>
            </td>
        `;
        usersTableBody.appendChild(row);
    });
}

// Event listeners
document.getElementById('users-search')?.addEventListener('input', () => renderUsersList());
document.getElementById('users-role')?.addEventListener('change', () => renderUsersList());
document.getElementById('users-status')?.addEventListener('change', () => renderUsersList());

document.getElementById('refreshUsersBtn')?.addEventListener('click', () => loadUsers());
document.getElementById('refreshUsersTableBtn')?.addEventListener('click', () => loadUsers());

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

// Edit User Modal Functions
function openEditModal(userId) {
    const user = usersCache.find(u => u.id == userId);
    if (!user) {
        alert('Admin not found');
        return;
    }
    
    document.getElementById('editUserId').value = user.id;
    document.getElementById('editUserName').value = user.name || '';
    document.getElementById('editUserEmail').value = user.email || '';
    document.getElementById('editUserRole').value = (user.role || 'admin').toLowerCase();
    document.getElementById('editUserStatus').value = (user.status || 'active').toLowerCase();
    
    document.getElementById('editUserModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editUserModal').style.display = 'none';
    document.getElementById('editUserForm').reset();
}

// Archive User Function
async function archiveUser(userId, userName) {
    if (!confirm(`Are you sure you want to archive "${userName}"?`)) {
        return;
    }
    
    try {
        const response = await fetch(`/admin/users/${userId}/archive`, {
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
            alert('Admin archived successfully');
            loadUsers();
        } else {
            alert(data.message || 'Failed to archive admin');
        }
    } catch (error) {
        console.error('Error archiving admin:', error);
        alert('Error archiving admin. Please try again.');
    }
}

// Event Listeners for Edit and Archive
document.addEventListener('click', function(e) {
    if (e.target.closest('.edit-user-btn')) {
        const btn = e.target.closest('.edit-user-btn');
        const userId = btn.getAttribute('data-user-id');
        openEditModal(userId);
    }
    
    if (e.target.closest('.archive-user-btn')) {
        const btn = e.target.closest('.archive-user-btn');
        const userId = btn.getAttribute('data-user-id');
        const userName = btn.getAttribute('data-user-name');
        archiveUser(userId, userName);
    }
});

// Edit Form Submit
document.getElementById('editUserForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const userId = document.getElementById('editUserId').value;
    const formData = {
        name: document.getElementById('editUserName').value,
        email: document.getElementById('editUserEmail').value,
        role: document.getElementById('editUserRole').value,
        status: document.getElementById('editUserStatus').value,
    };
    
    try {
        const response = await fetch(`/admin/users/${userId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData),
            credentials: 'same-origin'
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert('Admin updated successfully');
            closeEditModal();
            loadUsers();
        } else {
            alert(data.message || 'Failed to update admin');
        }
    } catch (error) {
        console.error('Error updating admin:', error);
        alert('Error updating admin. Please try again.');
    }
});

// Close modal handlers
document.getElementById('closeEditModal')?.addEventListener('click', closeEditModal);
document.getElementById('cancelEditModal')?.addEventListener('click', closeEditModal);

// Close modal on backdrop click
document.getElementById('editUserModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Update date/time immediately and then every second
document.addEventListener('DOMContentLoaded', function() {
    updateSidebarDateTime();
    setInterval(updateSidebarDateTime, 1000);
    loadUsers(); // Load admins data on page load
});
</script>

</body>
</html>

