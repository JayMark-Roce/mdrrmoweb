<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pairing Log - SILANG MDRRMO</title>

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

.log-page-container {
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

.filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 1rem;
}

.log-field {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
    position: relative;
}

.log-field span {
    font-size: 0.78rem;
    text-transform: uppercase;
    font-weight: 800;
    letter-spacing: 0.06em;
    color: var(--muted);
}

.log-input,
.log-select {
    border-radius: 14px;
    border: 1.5px solid rgba(148, 163, 184, 0.5);
    padding: 0.7rem 0.85rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--heading);
    background: #f8fafc;
    transition: border 0.2s ease, box-shadow 0.2s ease;
}

.log-input:focus,
.log-select:focus {
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

.log-table-wrapper {
    overflow-x: auto;
}

.log-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.92rem;
}

.log-table thead {
    background: #f8fafc;
}

.log-table th {
    text-align: left;
    padding: 0.95rem 1rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted);
    font-weight: 800;
    border-bottom: 1px solid var(--border-color);
}

.log-table td {
    padding: 1rem;
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    color: #0f172a;
    vertical-align: top;
    background: #ffffff;
}

.log-table tbody tr:hover td {
    background: rgba(248, 250, 252, 0.7);
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.35rem 0.9rem;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.status-badge.completed {
    background: rgba(16, 185, 129, 0.15);
    color: #059669;
}

.status-badge.cancelled {
    background: rgba(239, 68, 68, 0.15);
    color: #dc2626;
}

.status-badge.active {
    background: rgba(59, 130, 246, 0.15);
    color: #2563eb;
}

.pagination-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.75rem;
    border-top: 1px solid rgba(226, 232, 240, 0.8);
    background: #f8fafc;
    flex-wrap: wrap;
    gap: 1rem;
}

.table-pager {
    display: flex;
    gap: 0.5rem;
}

.pager-btn {
    border: none;
    background: #ffffff;
    border-radius: 10px;
    padding: 0.5rem 0.95rem;
    font-weight: 700;
    cursor: pointer;
    border: 1px solid rgba(148, 163, 184, 0.5);
    transition: background 0.2s ease;
}

.pager-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pager-btn:not(:disabled):hover {
    background: rgba(37, 99, 235, 0.08);
}

.empty-state {
    padding: 2rem;
    text-align: center;
    color: var(--muted);
    font-style: italic;
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
        <img src="{{ asset('image/mdrrmologo.jpg') }}" alt="Logo" class="logo-img" style="display: block; margin: 0 auto;">
        <div style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 800; color: #ffffff; letter-spacing: .5px;">SILANG MDRRMO</div>
    </div>
    <nav class="nav-links">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
        @if(auth()->check())
            <span class="nav-link-locked" style="display: block; text-decoration: none; color: #9ca3af; font-size: 1rem; font-weight: 600; padding: 0.75rem 1rem; border-radius: 8px; cursor: not-allowed; opacity: 0.6; position: relative;"><i class="fas fa-pen"></i> Posting <i class="fas fa-lock" style="font-size: 10px; margin-left: 8px; opacity: 0.7;"></i></span>
            <a href="{{ url('/admin/pairing') }}" class="{{ request()->is('admin/pairing') ? 'active' : '' }}"><i class="fas fa-link"></i> Pairing</a>
            <a href="{{ url('/admin/drivers') }}" class="{{ request()->is('admin/drivers*') ? 'active' : '' }}"><i class="fas fa-car"></i> Drivers</a>
            <a href="{{ url('/admin/medics') }}" class="{{ request()->is('admin/medics*') ? 'active' : '' }}"><i class="fas fa-plus"></i> Create</a>
            <a href="{{ url('/admin/gps') }}" class="{{ request()->is('admin/gps') ? 'active' : '' }}"><i class="fas fa-map-marker-alt mr-1"></i> GPS Tracker</a>
            <a href="{{ url('/admin/reports') }}" class="{{ request()->is('admin/reports*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Reports</a>
        @else
            <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
        @endif
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
    <div class="log-page-container">

        <section class="hero-card">
            <div>
                <span class="hero-badge">
                    <i class="fas fa-history"></i> Pairing Log
                </span>
                <h3>Complete history of all pairings.</h3>
                <p>
                    Track completed and cancelled pairings. Review past assignments, analyze patterns, and maintain comprehensive records of all pairing activities.
                </p>
                <div class="hero-actions">
                    <button type="button" class="secondary" onclick="window.location.href='{{ route('admin.pairing.index') }}'"><i class="fas fa-arrow-left"></i> Back to Pairing</button>
                </div>
            </div>
            <div class="hero-kpis">
                <div class="hero-kpi-card">
                    <span>Total Logs</span>
                    <strong>{{ $driverMedicPairings->count() + $driverAmbulancePairings->count() }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Completed</span>
                    <strong>{{ $driverMedicPairings->where('status', 'completed')->count() + $driverAmbulancePairings->where('status', 'completed')->count() }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Cancelled</span>
                    <strong>{{ $driverMedicPairings->where('status', 'cancelled')->count() + $driverAmbulancePairings->where('status', 'cancelled')->count() }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Driver-Medic</span>
                    <strong>{{ $driverMedicPairings->count() }}</strong>
                </div>
            </div>
        </section>

        <section class="insight-grid">
            <article class="insight-card">
                <small>Driver-Medic Logs</small>
                <h4>{{ $driverMedicPairings->count() }}</h4>
                <div class="insight-trend"><i class="fas fa-user-md" style="color: var(--success);"></i><span>{{ $driverMedicPairings->where('status', 'completed')->count() }} completed</span></div>
            </article>
            <article class="insight-card">
                <small>Driver-Ambulance Logs</small>
                <h4>{{ $driverAmbulancePairings->count() }}</h4>
                <div class="insight-trend"><i class="fas fa-ambulance" style="color: var(--accent);"></i><span>{{ $driverAmbulancePairings->where('status', 'completed')->count() }} completed</span></div>
            </article>
            <article class="insight-card">
                <small>Completion Rate</small>
                @php
                    $total = $driverMedicPairings->count() + $driverAmbulancePairings->count();
                    $completed = $driverMedicPairings->where('status', 'completed')->count() + $driverAmbulancePairings->where('status', 'completed')->count();
                    $rate = $total > 0 ? round(($completed / $total) * 100) : 0;
                @endphp
                <h4>{{ $rate }}%</h4>
                <div class="insight-trend"><i class="fas fa-chart-line" style="color: var(--warning);"></i><span>Success rate</span></div>
            </article>
            <article class="insight-card">
                <small>Recent Activity</small>
                @php
                    $recent = $driverMedicPairings->merge($driverAmbulancePairings)->sortByDesc('updated_at')->first();
                @endphp
                <h4>{{ $recent ? \Carbon\Carbon::parse($recent->updated_at)->diffForHumans() : 'N/A' }}</h4>
                <div class="insight-trend"><i class="fas fa-clock" style="color: var(--danger);"></i><span>Last update</span></div>
            </article>
        </section>

        <section class="filters-card">
            <div class="filters-header">
                <h5>Search & Filter</h5>
            </div>
            <form method="GET" action="{{ route('admin.pairing.log') }}" class="filters-grid" id="searchForm">
                <label class="log-field">
                    <span>Search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search logs..." class="log-input" id="liveSearchInput">
                    <div id="searchIndicator" style="display: none; position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: var(--accent);">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </label>
                <label class="log-field">
                    <span>Driver</span>
                    <select name="driver_id" class="log-select" id="driverSelect">
                        <option value="">All Drivers</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ request('driver_id') == $driver->id ? 'selected' : '' }}>
                                {{ $driver->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label class="log-field">
                    <span>Status</span>
                    <select name="status" class="log-select" id="statusSelect">
                        <option value="">All Status</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </label>
                <label class="log-field">
                    <span>View Type</span>
                    <select name="view_type" class="log-select" onchange="toggleLogTableView(this.value)">
                        <option value="driver_ambulance" {{ request('view_type') != 'driver_medic' ? 'selected' : '' }}>Driver-Ambulance</option>
                        <option value="driver_medic" {{ request('view_type') == 'driver_medic' ? 'selected' : '' }}>Driver-Medic</option>
                    </select>
                </label>
            </form>
        </section>

        <!-- Driver-Medic Pairings Log -->
        <section class="table-card" id="driverMedicLogSection" style="display: {{ request('view_type') == 'driver_medic' ? 'block' : 'none' }};">
            <div class="table-card-header">
                <div>
                    <h4>Driver-Medic Pairings Log</h4>
                </div>
            </div>

            <div class="log-table-wrapper">
                <table class="log-table" data-paginate="true" data-page-size="10">
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Medic</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Completed/Cancelled At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($driverMedicPairings as $pairing)
                            @php
                                $driver = $pairing->driver;
                                $medic = $pairing->medic;
                                $updatedAt = \Carbon\Carbon::parse($pairing->updated_at)->setTimezone('Asia/Manila');
                            @endphp
                            <tr>
                                <td>
                                    <div style="font-weight: 700; color: #0f172a;">{{ $driver ? $driver->name : 'Deleted Driver' }}</div>
                                    @if($driver && $driver->phone)
                                        <div style="font-size: 0.85rem; color: var(--muted);">📞 {{ $driver->phone }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight: 700; color: #0f172a;">{{ $medic ? $medic->name : 'Deleted Medic' }}</div>
                                    @if($medic && $medic->specialization)
                                        <div style="font-size: 0.85rem; color: var(--muted);">{{ $medic->specialization }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight: 700;">{{ $pairing->pairing_date->format('M d, Y') }}</div>
                                    <div style="font-size: 0.85rem; color: var(--muted);">{{ $pairing->pairing_date->format('l') }}</div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $pairing->status }}">{{ ucfirst($pairing->status) }}</span>
                                </td>
                                <td>
                                    <div style="font-weight: 700;">{{ $updatedAt->format('M d, Y') }}</div>
                                    <div style="font-size: 0.85rem; color: var(--muted);">{{ $updatedAt->format('H:i') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">No completed or cancelled driver-medic pairings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-bar">
                <div>
                    <strong>Tip:</strong> Use filters to find specific pairings.
                </div>
                <div class="table-pager">
                    <button class="pager-btn" data-prev>Prev</button>
                    <button class="pager-btn" data-next>Next</button>
                </div>
            </div>
        </section>

        <!-- Driver-Ambulance Pairings Log -->
        <section class="table-card" id="driverAmbulanceLogSection" style="display: {{ request('view_type') != 'driver_medic' ? 'block' : 'none' }};">
            <div class="table-card-header">
                <div>
                    <h4>Driver-Ambulance Pairings Log</h4>
                </div>
            </div>

            <div class="log-table-wrapper">
                <table class="log-table" data-paginate="true" data-page-size="10">
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Ambulance</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Completed/Cancelled At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($driverAmbulancePairings as $pairing)
                            @php
                                $driver = $pairing->driver;
                                $ambulance = $pairing->ambulance;
                                $updatedAt = \Carbon\Carbon::parse($pairing->updated_at)->setTimezone('Asia/Manila');
                            @endphp
                            <tr>
                                <td>
                                    <div style="font-weight: 700; color: #0f172a;">{{ $driver ? $driver->name : 'Deleted Driver' }}</div>
                                    @if($driver && $driver->phone)
                                        <div style="font-size: 0.85rem; color: var(--muted);">📞 {{ $driver->phone }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="fas fa-ambulance" style="color: var(--accent);"></i>
                                        <div>
                                            <div style="font-weight: 700; color: #0f172a;">{{ $ambulance ? $ambulance->name : 'Deleted Ambulance' }}</div>
                                            @if($ambulance && $ambulance->plate_number)
                                                <div style="font-size: 0.85rem; color: var(--muted);">Plate: {{ $ambulance->plate_number }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 700;">{{ $pairing->pairing_date->format('M d, Y') }}</div>
                                    <div style="font-size: 0.85rem; color: var(--muted);">{{ $pairing->pairing_date->format('l') }}</div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $pairing->status }}">{{ ucfirst($pairing->status) }}</span>
                                </td>
                                <td>
                                    <div style="font-weight: 700;">{{ $updatedAt->format('M d, Y') }}</div>
                                    <div style="font-size: 0.85rem; color: var(--muted);">{{ $updatedAt->format('H:i') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">No completed or cancelled driver-ambulance pairings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-bar">
                <div>
                    <strong>Tip:</strong> Use filters to find specific pairings.
                </div>
                <div class="table-pager">
                    <button class="pager-btn" data-prev>Prev</button>
                    <button class="pager-btn" data-next>Next</button>
                </div>
            </div>
        </section>

    </div>
</main>

<script>
function toggleSidebar() {
    const sidenav = document.getElementById('sidenav');
    if (sidenav) {
        sidenav.classList.toggle('active');
    }
}

function toggleLogTableView(type) {
    const driverMedicSection = document.getElementById('driverMedicLogSection');
    const driverAmbulanceSection = document.getElementById('driverAmbulanceLogSection');
    
    if (type === 'driver_medic') {
        driverMedicSection.style.display = 'block';
        driverAmbulanceSection.style.display = 'none';
    } else {
        driverMedicSection.style.display = 'none';
        driverAmbulanceSection.style.display = 'block';
    }
}

// Live search functionality
document.addEventListener('DOMContentLoaded', function(){
    const searchInput = document.getElementById('liveSearchInput');
    const driverSelect = document.getElementById('driverSelect');
    const statusSelect = document.getElementById('statusSelect');
    const searchForm = document.getElementById('searchForm');
    const searchIndicator = document.getElementById('searchIndicator');
    let searchTimeout;
    let isSubmitting = false;
    
    if (searchInput && searchForm) {
        // Real-time search with debouncing
        searchInput.addEventListener('input', function() {
            if (isSubmitting) return;
            
            clearTimeout(searchTimeout);
            
            if (searchIndicator) {
                searchIndicator.style.display = 'block';
            }
            
            searchTimeout = setTimeout(() => {
                if (!isSubmitting) {
                    isSubmitting = true;
                    searchForm.submit();
                }
            }, 300);
        });
        
        // Auto-submit when driver select changes
        if (driverSelect) {
            driverSelect.addEventListener('change', function() {
                if (isSubmitting) return;
                
                clearTimeout(searchTimeout);
                
                if (searchIndicator) {
                    searchIndicator.style.display = 'block';
                }
                
                searchTimeout = setTimeout(() => {
                    if (!isSubmitting) {
                        isSubmitting = true;
                        searchForm.submit();
                    }
                }, 50);
            });
        }
        
        // Auto-submit when status select changes
        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                if (isSubmitting) return;
                
                clearTimeout(searchTimeout);
                
                if (searchIndicator) {
                    searchIndicator.style.display = 'block';
                }
                
                searchTimeout = setTimeout(() => {
                    if (!isSubmitting) {
                        isSubmitting = true;
                        searchForm.submit();
                    }
                }, 50);
            });
        }
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

// Simple pagination
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('table.log-table[data-paginate="true"]').forEach(function(tbl){
        const pageSize = parseInt(tbl.getAttribute('data-page-size') || '10', 10);
        const tbody = tbl.querySelector('tbody');
        if (!tbody) return;
        const rows = Array.from(tbody.children);
        if (rows.length <= pageSize) return;

        let page = 0;
        const container = tbl.parentElement.parentElement;
        const prevBtn = container.querySelector('.table-pager [data-prev]');
        const nextBtn = container.querySelector('.table-pager [data-next]');

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