<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pairing Management - SILANG MDRRMO</title>

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

.pairing-page-container {
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

.pairing-field {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
    position: relative;
}

.pairing-field span {
    font-size: 0.78rem;
    text-transform: uppercase;
    font-weight: 800;
    letter-spacing: 0.06em;
    color: var(--muted);
}

.pairing-input,
.pairing-select {
    border-radius: 14px;
    border: 1.5px solid rgba(148, 163, 184, 0.5);
    padding: 0.7rem 0.85rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--heading);
    background: #f8fafc;
    transition: border 0.2s ease, box-shadow 0.2s ease;
}

.pairing-input:focus,
.pairing-select:focus {
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

.pairing-table-wrapper {
    overflow-x: auto;
}

.pairing-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.92rem;
}

.pairing-table thead {
    background: #f8fafc;
}

.pairing-table th {
    text-align: left;
    padding: 0.95rem 1rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted);
    font-weight: 800;
    border-bottom: 1px solid var(--border-color);
}

.pairing-table td {
    padding: 1rem;
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    color: #0f172a;
    vertical-align: top;
    background: #ffffff;
}

.pairing-table tbody tr:hover td {
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

.action-buttons {
    display: flex;
    gap: 0.4rem;
}

.action-btn {
    border: none;
    border-radius: 8px;
    padding: 0.4rem 0.7rem;
    font-size: 0.8rem;
    cursor: pointer;
    transition: transform 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}

.action-btn.complete {
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
}

.action-btn.cancel {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
}

.action-btn:hover {
    transform: translateY(-1px);
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

/* Panel Styles */
.modal-overlay {
    animation: fadeIn 0.2s ease;
}

.modal-content {
    animation: slideUp 0.3s cubic-bezier(0.25, 1, 0.5, 1);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.pairing-type-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2) !important;
}

.modal-field input:focus,
.modal-field select:focus,
.modal-field textarea:focus {
    outline: none;
    border-color: var(--accent) !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
    background: #ffffff !important;
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

    .pairing-panel {
        width: 100%;
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
    <div class="pairing-page-container">

        <section class="hero-card">
            <div>
                <span class="hero-badge">
                    <i class="fas fa-link"></i> Pairing Management
                </span>
                <h3>Connect teams, coordinate resources.</h3>
                <p>
                    Efficiently pair drivers with medics and ambulances. Manage schedules, track assignments, and ensure optimal resource allocation for emergency response.
                </p>
                <div class="hero-actions">
                    <button type="button" class="primary" onclick="openPairingTypeModal()"><i class="fas fa-plus"></i> Create Pairing</button>
                    <button type="button" class="secondary" onclick="window.location.href='{{ route('admin.pairing.log') }}'"><i class="fas fa-clock"></i> View Log</button>
                </div>
            </div>
            <div class="hero-kpis">
                <div class="hero-kpi-card">
                    <span>Active Pairings</span>
                    <strong id="metricActivePairings">{{ $groupedDriverMedicPairings->count() + $groupedDriverAmbulancePairings->count() }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Drivers</span>
                    <strong>{{ $drivers->count() }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Medics</span>
                    <strong>{{ $medics->count() }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Ambulances</span>
                    <strong>{{ $ambulances->count() }}</strong>
                </div>
            </div>
        </section>

        <section class="insight-grid">
            <article class="insight-card">
                <small>Driver-Medic Teams</small>
                <h4>{{ $groupedDriverMedicPairings->count() }}</h4>
                @php
                    $activeDriverMedic = 0;
                    foreach($groupedDriverMedicPairings as $pairings) {
                        if($pairings->pluck('status')->contains('active')) {
                            $activeDriverMedic++;
                        }
                    }
                @endphp
                <div class="insight-trend"><i class="fas fa-user-md" style="color: var(--success);"></i><span>{{ $activeDriverMedic }} active</span></div>
            </article>
            <article class="insight-card">
                <small>Driver-Ambulance</small>
                <h4>{{ $groupedDriverAmbulancePairings->count() }}</h4>
                @php
                    $activeDriverAmbulance = 0;
                    foreach($groupedDriverAmbulancePairings as $pairings) {
                        if($pairings->pluck('status')->contains('active')) {
                            $activeDriverAmbulance++;
                        }
                    }
                @endphp
                <div class="insight-trend"><i class="fas fa-ambulance" style="color: var(--accent);"></i><span>{{ $activeDriverAmbulance }} active</span></div>
            </article>
            <article class="insight-card">
                <small>Available Drivers</small>
                <h4>{{ $drivers->where('status', 'active')->count() }}</h4>
                <div class="insight-trend"><i class="fas fa-users" style="color: var(--warning);"></i><span>Ready for assignment</span></div>
            </article>
            <article class="insight-card">
                <small>Available Medics</small>
                <h4>{{ $medics->where('status', 'active')->count() }}</h4>
                <div class="insight-trend"><i class="fas fa-stethoscope" style="color: var(--danger);"></i><span>Medical personnel</span></div>
            </article>
        </section>

        <section class="filters-card">
            <div class="filters-header">
                <h5>Search & Filter</h5>
            </div>
            <form method="GET" action="{{ route('admin.pairing.index') }}" class="filters-grid" id="searchForm" onsubmit="event.preventDefault(); return false;">
                <label class="pairing-field">
                    <span>Search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search pairings..." class="pairing-input" id="liveSearchInput">
                    <div id="searchIndicator" style="display: none; position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: var(--accent);">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </label>
                <label class="pairing-field">
                    <span>Driver</span>
                    <select name="driver_id" class="pairing-select" id="driverSelect">
                        <option value="">All Drivers</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ request('driver_id') == $driver->id ? 'selected' : '' }}>
                                {{ $driver->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label class="pairing-field">
                    <span>View Type</span>
                    <select name="view_type" class="pairing-select" id="viewTypeSelect">
                        <option value="driver_medic" {{ request('view_type') != 'driver_ambulance' ? 'selected' : '' }}>Driver-Medic</option>
                        <option value="driver_ambulance" {{ request('view_type') == 'driver_ambulance' ? 'selected' : '' }}>Driver-Ambulance</option>
                    </select>
                </label>
            </form>
        </section>

        <!-- Driver-Medic Pairings Table -->
        <section class="table-card" id="driverMedicSection" style="display: {{ request('view_type') != 'driver_ambulance' ? 'block' : 'none' }};">
            <div class="table-card-header">
                <div>
                    <h4>Driver-Medic Pairings</h4>
                </div>
                <div class="table-actions">
                    <button type="button" class="primary" onclick="openPairingTypeModal()"><i class="fas fa-plus"></i> Create Pairing</button>
                </div>
            </div>

            <div class="pairing-table-wrapper">
                <table class="pairing-table" data-paginate="true" data-page-size="10">
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Medics</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($groupedDriverMedicPairings as $groupKey => $pairings)
                            @php
                                $firstPairing = $pairings->first();
                                $driver = $firstPairing->driver;
                                $medics = $pairings->pluck('medic')->filter();
                                $allStatuses = $pairings->pluck('status')->unique();
                                $isActive = $allStatuses->contains('active');
                            @endphp
                            <tr>
                                <td>
                                    <div style="font-weight: 700; color: #0f172a;">{{ $driver ? $driver->name : 'Deleted Driver' }}</div>
                                    @if($driver && $driver->phone)
                                        <div style="font-size: 0.85rem; color: var(--muted);">📞 {{ $driver->phone }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; flex-wrap: wrap; gap: 0.4rem;">
                                        @foreach($medics as $medic)
                                            <span style="background: rgba(16, 185, 129, 0.1); color: #059669; padding: 0.25rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 700;">
                                                {{ $medic->name }}
                                                @if($medic->specialization)
                                                    <span style="opacity: 0.7;">({{ $medic->specialization }})</span>
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 700;">{{ $firstPairing->pairing_date->format('M d, Y') }}</div>
                                    <div style="font-size: 0.85rem; color: var(--muted);">{{ $firstPairing->pairing_date->format('l') }}</div>
                                </td>
                                <td>
                                    @if($firstPairing->start_time && $firstPairing->end_time)
                                        <div style="font-weight: 600;">{{ \Carbon\Carbon::parse($firstPairing->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($firstPairing->end_time)->format('g:i A') }}</div>
                                    @else
                                        <span style="color: var(--muted);">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($allStatuses->count() == 1)
                                        <span class="status-badge {{ $allStatuses->first() }}">
                                            {{ ucfirst($allStatuses->first()) }}
                                        </span>
                                    @else
                                        <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
                                            @foreach($allStatuses as $status)
                                                <span class="status-badge {{ $status }}">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($isActive)
                                        <div class="action-buttons">
                                            <button onclick="bulkActionGroup('driver_medic', '{{ $groupKey }}', 'complete')" class="action-btn complete" title="Complete">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button onclick="bulkActionGroup('driver_medic', '{{ $groupKey }}', 'cancel')" class="action-btn cancel" title="Cancel">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span style="color: var(--muted); font-size: 0.85rem;">No actions</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">No driver-medic pairings found.</td>
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

        <!-- Driver-Ambulance Pairings Table -->
        <section class="table-card" id="driverAmbulanceSection" style="display: {{ request('view_type') == 'driver_ambulance' ? 'block' : 'none' }};">
            <div class="table-card-header">
                <div>
                    <h4>Driver-Ambulance Pairings</h4>
                </div>
                <div class="table-actions">
                    <button type="button" class="primary" onclick="window.location.href='{{ route('admin.pairing.driver-ambulance.create') }}'"><i class="fas fa-plus"></i> Create Pairing</button>
                </div>
            </div>

            <div class="pairing-table-wrapper">
                <table class="pairing-table" data-paginate="true" data-page-size="10">
                    <thead>
                        <tr>
                            <th>Drivers</th>
                            <th>Ambulance</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($groupedDriverAmbulancePairings as $groupKey => $pairings)
                            @php
                                $firstPairing = $pairings->first();
                                $groupDrivers = isset($groupOperators[$groupKey]) ? $groupOperators[$groupKey] : $pairings->pluck('driver');
                                $ambulance = $firstPairing->ambulance;
                                $allStatuses = $pairings->pluck('status')->unique();
                                $isActive = $allStatuses->contains('active');
                            @endphp
                            <tr>
                                <td>
                                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                        @foreach($groupDrivers as $op)
                                            <div style="font-weight: 700; color: #0f172a;">{{ $op ? $op->name : 'Deleted Driver' }}</div>
                                        @endforeach
                                    </div>
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
                                    <div style="font-weight: 700;">{{ $firstPairing->pairing_date->format('M d, Y') }}</div>
                                    <div style="font-size: 0.85rem; color: var(--muted);">{{ $firstPairing->pairing_date->format('l') }}</div>
                                </td>
                                <td>
                                    @if($allStatuses->count() == 1)
                                        <span class="status-badge {{ $allStatuses->first() }}">
                                            {{ ucfirst($allStatuses->first()) }}
                                        </span>
                                    @else
                                        <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
                                            @foreach($allStatuses as $status)
                                                <span class="status-badge {{ $status }}">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($isActive)
                                        <div class="action-buttons">
                                            <button onclick="bulkActionGroup('driver_ambulance', '{{ $groupKey }}', 'complete')" class="action-btn complete" title="Complete">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button onclick="bulkActionGroup('driver_ambulance', '{{ $groupKey }}', 'cancel')" class="action-btn cancel" title="Cancel">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span style="color: var(--muted); font-size: 0.85rem;">No actions</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">No driver-ambulance pairings found.</td>
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

<!-- Pairing Type Selection Modal -->
<div id="pairingTypeModal" class="modal-overlay" style="display:none; position:fixed; inset:0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index:3000; align-items:center; justify-content:center;">
    <div class="modal-content" style="background: #ffffff; width: 90%; max-width: 500px; border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); position: relative; overflow: hidden;">
        <button type="button" onclick="closePairingTypeModal()" style="position: absolute; top: 16px; right: 16px; background: #f3f4f6; color: #6b7280; border: none; width: 36px; height: 36px; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; transition: all 0.2s;">
            <i class="fas fa-times"></i>
        </button>
        <div style="background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #ffffff; padding: 2rem; text-align: center;">
            <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 16px; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                <i class="fas fa-link"></i>
            </div>
            <h3 style="margin: 0; font-size: 1.5rem; font-weight: 800;">Create New Pairing</h3>
            <p style="margin: 0.75rem 0 0; font-size: 1rem; opacity: 0.9;">Choose the type of pairing you want to create</p>
        </div>
        <div style="padding: 2rem;">
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <button onclick="openDriverMedicModal()" class="pairing-type-btn" style="background: linear-gradient(135deg, #10b981, #059669); color: #ffffff; border: none; padding: 1.5rem; border-radius: 16px; cursor: pointer; display: flex; align-items: center; gap: 1.25rem; transition: all 0.2s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                    <div style="width: 56px; height: 56px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div style="flex: 1; text-align: left;">
                        <div style="font-weight: 800; font-size: 1.2rem; margin-bottom: 0.25rem;">Driver-Medic Pairing</div>
                        <div style="font-size: 0.9rem; opacity: 0.9;">Pair a driver with medical personnel</div>
                    </div>
                    <i class="fas fa-chevron-right" style="font-size: 1.1rem; opacity: 0.8;"></i>
                </button>
                <button onclick="openDriverAmbulanceModal()" class="pairing-type-btn" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: #ffffff; border: none; padding: 1.5rem; border-radius: 16px; cursor: pointer; display: flex; align-items: center; gap: 1.25rem; transition: all 0.2s; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">
                    <div style="width: 56px; height: 56px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <div style="flex: 1; text-align: left;">
                        <div style="font-weight: 800; font-size: 1.2rem; margin-bottom: 0.25rem;">Driver-Ambulance Pairing</div>
                        <div style="font-size: 0.9rem; opacity: 0.9;">Assign a driver to an ambulance vehicle</div>
                    </div>
                    <i class="fas fa-chevron-right" style="font-size: 1.1rem; opacity: 0.8;"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Driver-Medic Pairing Modal -->
<div id="driverMedicModal" class="modal-overlay" style="display:none; position:fixed; inset:0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index:3001; align-items:center; justify-content:center; overflow-y: auto; padding: 2rem;">
    <div class="modal-content" style="background: #ffffff; width: 90%; max-width: 700px; border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); position: relative; overflow: hidden; margin: auto;">
        <button type="button" onclick="closeDriverMedicModal()" style="position: absolute; top: 16px; right: 16px; background: #f3f4f6; color: #6b7280; border: none; width: 36px; height: 36px; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; transition: all 0.2s; z-index: 10;">
            <i class="fas fa-times"></i>
        </button>
        <div style="background: linear-gradient(135deg, #10b981, #059669); color: #ffffff; padding: 2rem; text-align: center;">
            <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 16px; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                <i class="fas fa-user-md"></i>
            </div>
            <h3 style="margin: 0; font-size: 1.5rem; font-weight: 800;">Driver-Medic Pairing</h3>
            <p style="margin: 0.75rem 0 0; font-size: 1rem; opacity: 0.9;">Pair a driver with medical personnel</p>
        </div>
        <div style="padding: 2rem;">
            <form id="driverMedicForm" onsubmit="submitDriverMedicForm(event)">
                @csrf
                <div style="display: grid; gap: 1.5rem;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                        <div class="modal-field">
                            <label style="display: block; font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Driver *</label>
                            <select name="driver_id" id="dmDriverSelect" required style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1.5px solid #e5e7eb; font-size: 0.95rem; font-weight: 600; background: #f8fafc; transition: all 0.2s;">
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            <div id="dmDriverIdError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                        </div>
                        <div class="modal-field">
                            <label style="display: block; font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Medic *</label>
                            <select name="medic_id" id="dmMedicSelect" required style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1.5px solid #e5e7eb; font-size: 0.95rem; font-weight: 600; background: #f8fafc; transition: all 0.2s;">
                                <option value="">Select Medic</option>
                                @foreach($medics as $medic)
                                    <option value="{{ $medic->id }}" data-specialization="{{ $medic->specialization ?? '' }}">{{ $medic->name }}@if($medic->specialization) ({{ $medic->specialization }})@endif</option>
                                @endforeach
                            </select>
                            <div id="dmMedicIdError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                            <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">Each medic can only be paired with one driver per date</p>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                        <div class="modal-field">
                            <label style="display: block; font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Pairing Date *</label>
                            <input type="date" name="pairing_date" id="dmPairingDate" value="{{ $selectedDate }}" required style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1.5px solid #e5e7eb; font-size: 0.95rem; font-weight: 600; background: #f8fafc; transition: all 0.2s;" onchange="updateDriverMedicOptions()">
                            <div id="dmPairingDateError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                        </div>
                        <div class="modal-field">
                            <label style="display: block; font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Start Time *</label>
                            <input type="time" name="start_time" id="dmStartTime" required style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1.5px solid #e5e7eb; font-size: 0.95rem; font-weight: 600; background: #f8fafc; transition: all 0.2s;">
                            <div id="dmStartTimeError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                        </div>
                        <div class="modal-field">
                            <label style="display: block; font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">End Time *</label>
                            <input type="time" name="end_time" id="dmEndTime" required style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1.5px solid #e5e7eb; font-size: 0.95rem; font-weight: 600; background: #f8fafc; transition: all 0.2s;">
                            <div id="dmEndTimeError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                        </div>
                    </div>
                    <div class="modal-field">
                        <label style="display: block; font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Notes</label>
                        <textarea name="notes" id="dmNotes" rows="3" placeholder="Any additional notes about this pairing..." style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1.5px solid #e5e7eb; font-size: 0.95rem; font-weight: 600; background: #f8fafc; transition: all 0.2s; resize: vertical;"></textarea>
                    </div>
                    <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1rem;">
                        <button type="button" onclick="closeDriverMedicModal()" style="padding: 0.85rem 1.75rem; border-radius: 12px; border: 1px solid #e5e7eb; background: #f1f5f9; color: #0f172a; font-weight: 700; cursor: pointer; transition: all 0.2s;">
                            Cancel
                        </button>
                        <button type="submit" id="dmSubmitBtn" style="padding: 0.85rem 1.75rem; border-radius: 12px; border: none; background: linear-gradient(135deg, #10b981, #059669); color: #ffffff; font-weight: 700; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                            <i class="fas fa-check"></i> Create Pairing
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Driver-Ambulance Pairing Modal -->
<div id="driverAmbulanceModal" class="modal-overlay" style="display:none; position:fixed; inset:0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index:3001; align-items:center; justify-content:center; overflow-y: auto; padding: 2rem;">
    <div class="modal-content" style="background: #ffffff; width: 90%; max-width: 700px; border-radius: 24px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); position: relative; overflow: hidden; margin: auto;">
        <button type="button" onclick="closeDriverAmbulanceModal()" style="position: absolute; top: 16px; right: 16px; background: #f3f4f6; color: #6b7280; border: none; width: 36px; height: 36px; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; transition: all 0.2s; z-index: 10;">
            <i class="fas fa-times"></i>
        </button>
        <div style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: #ffffff; padding: 2rem; text-align: center;">
            <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 16px; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                <i class="fas fa-ambulance"></i>
            </div>
            <h3 style="margin: 0; font-size: 1.5rem; font-weight: 800;">Driver-Ambulance Pairing</h3>
            <p style="margin: 0.75rem 0 0; font-size: 1rem; opacity: 0.9;">Assign a driver to an ambulance vehicle</p>
        </div>
        <div style="padding: 2rem;">
            <form id="driverAmbulanceForm" onsubmit="submitDriverAmbulanceForm(event)">
                @csrf
                <div style="display: grid; gap: 1.5rem;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                        <div class="modal-field">
                            <label style="display: block; font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Driver *</label>
                            <select name="driver_id" id="daDriverSelect" required style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1.5px solid #e5e7eb; font-size: 0.95rem; font-weight: 600; background: #f8fafc; transition: all 0.2s;">
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            <div id="daDriverIdError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                            <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">Drivers paired with medics can still be paired with ambulances</p>
                        </div>
                        <div class="modal-field">
                            <label style="display: block; font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Ambulance *</label>
                            <select name="ambulance_id" id="daAmbulanceSelect" required style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1.5px solid #e5e7eb; font-size: 0.95rem; font-weight: 600; background: #f8fafc; transition: all 0.2s;">
                                <option value="">Select Ambulance</option>
                                @foreach($ambulances as $ambulance)
                                    <option value="{{ $ambulance->id }}">{{ $ambulance->name }}@if($ambulance->plate_number) ({{ $ambulance->plate_number }})@endif</option>
                                @endforeach
                            </select>
                            <div id="daAmbulanceIdError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                            <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">Maximum 2 drivers per ambulance</p>
                        </div>
                    </div>
                    <div class="modal-field">
                        <label style="display: block; font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Pairing Date *</label>
                        <input type="date" name="pairing_date" id="daPairingDate" value="{{ $selectedDate }}" required style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1.5px solid #e5e7eb; font-size: 0.95rem; font-weight: 600; background: #f8fafc; transition: all 0.2s;" onchange="updateDriverAmbulanceOptions()">
                        <div id="daPairingDateError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                    </div>
                    <div class="modal-field">
                        <label style="display: block; font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Notes</label>
                        <textarea name="notes" id="daNotes" rows="3" placeholder="Any additional notes about this pairing..." style="width: 100%; padding: 0.85rem; border-radius: 12px; border: 1.5px solid #e5e7eb; font-size: 0.95rem; font-weight: 600; background: #f8fafc; transition: all 0.2s; resize: vertical;"></textarea>
                    </div>
                    <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1rem;">
                        <button type="button" onclick="closeDriverAmbulanceModal()" style="padding: 0.85rem 1.75rem; border-radius: 12px; border: 1px solid #e5e7eb; background: #f1f5f9; color: #0f172a; font-weight: 700; cursor: pointer; transition: all 0.2s;">
                            Cancel
                        </button>
                        <button type="submit" id="daSubmitBtn" style="padding: 0.85rem 1.75rem; border-radius: 12px; border: none; background: linear-gradient(135deg, #3b82f6, #2563eb); color: #ffffff; font-weight: 700; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">
                            <i class="fas fa-check"></i> Create Pairing
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success/Error Toast -->
<div id="pairingToast" style="display: none; position: fixed; top: 2rem; right: 2rem; background: #ffffff; border-radius: 12px; padding: 1rem 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.2); z-index: 4000; min-width: 300px; border-left: 4px solid #10b981;">
    <div style="display: flex; align-items: center; gap: 0.75rem;">
        <i id="toastIcon" class="fas fa-check-circle" style="font-size: 1.5rem; color: #10b981;"></i>
        <div style="flex: 1;">
            <div id="toastMessage" style="font-weight: 700; color: #0f172a;"></div>
        </div>
        <button onclick="closeToast()" style="background: transparent; border: none; color: #6b7280; cursor: pointer; font-size: 1.2rem;">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<script>
// Include all existing JavaScript functionality from the original file
// This is a simplified version - you may want to include the full script section

function toggleSidebar() {
    const sidenav = document.getElementById('sidenav');
    if (sidenav) {
        sidenav.classList.toggle('active');
    }
}

// Modal Functions
function openPairingTypeModal() {
    document.getElementById('pairingTypeModal').style.display = 'flex';
}

function closePairingTypeModal() {
    document.getElementById('pairingTypeModal').style.display = 'none';
}

function openDriverMedicModal() {
    closePairingTypeModal();
    setTimeout(() => {
        document.getElementById('driverMedicModal').style.display = 'flex';
        updateDriverMedicOptions();
    }, 200);
}

function closeDriverMedicModal() {
    document.getElementById('driverMedicModal').style.display = 'none';
    document.getElementById('driverMedicForm').reset();
    clearDriverMedicErrors();
}

function openDriverAmbulanceModal() {
    closePairingTypeModal();
    setTimeout(() => {
        document.getElementById('driverAmbulanceModal').style.display = 'flex';
        updateDriverAmbulanceOptions();
    }, 200);
}

function closeDriverAmbulanceModal() {
    document.getElementById('driverAmbulanceModal').style.display = 'none';
    document.getElementById('driverAmbulanceForm').reset();
    clearDriverAmbulanceErrors();
}

// Toast Functions
function showToast(message, type = 'success') {
    const toast = document.getElementById('pairingToast');
    const toastMessage = document.getElementById('toastMessage');
    const toastIcon = document.getElementById('toastIcon');
    
    toastMessage.textContent = message;
    
    if (type === 'success') {
        toast.style.borderLeftColor = '#10b981';
        toastIcon.className = 'fas fa-check-circle';
        toastIcon.style.color = '#10b981';
    } else {
        toast.style.borderLeftColor = '#ef4444';
        toastIcon.className = 'fas fa-exclamation-circle';
        toastIcon.style.color = '#ef4444';
    }
    
    toast.style.display = 'block';
    setTimeout(() => {
        closeToast();
    }, 5000);
}

function closeToast() {
    document.getElementById('pairingToast').style.display = 'none';
}

// Update options based on selected date
async function updateDriverMedicOptions() {
    const date = document.getElementById('dmPairingDate')?.value;
    if (!date) return;
    
    try {
        const response = await fetch(`{{ route('admin.pairing.index') }}?pairing_date=${date}&get_options=driver_medic`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        const data = await response.json();
        if (data.options) {
            updateDriverMedicSelects(data.options);
        }
    } catch (error) {
        console.error('Error updating options:', error);
    }
}

async function updateDriverAmbulanceOptions() {
    const date = document.getElementById('daPairingDate')?.value;
    if (!date) return;
    
    try {
        const response = await fetch(`{{ route('admin.pairing.index') }}?pairing_date=${date}&get_options=driver_ambulance`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        const data = await response.json();
        if (data.options) {
            updateDriverAmbulanceSelects(data.options);
        }
    } catch (error) {
        console.error('Error updating options:', error);
    }
}

function updateDriverMedicSelects(options) {
    const medicSelect = document.getElementById('dmMedicSelect');
    if (!medicSelect) return;
    
    const currentValue = medicSelect.value;
    medicSelect.innerHTML = '<option value="">Select Medic</option>';
    
    if (options && options.medics) {
        options.medics.forEach(medic => {
            const option = document.createElement('option');
            option.value = medic.id;
            option.textContent = medic.name + (medic.specialization ? ` (${medic.specialization})` : '');
            option.disabled = medic.isPaired;
            if (medic.isPaired) {
                option.textContent += ' - Already paired';
                option.style.color = '#9ca3af';
            }
            medicSelect.appendChild(option);
        });
        
        if (currentValue && !options.medics.find(m => m.id == currentValue && !m.isPaired)) {
            medicSelect.value = '';
        }
    }
}

function updateDriverAmbulanceSelects(options) {
    const driverSelect = document.getElementById('daDriverSelect');
    const ambulanceSelect = document.getElementById('daAmbulanceSelect');
    
    if (!options) return;
    
    if (driverSelect && options.drivers) {
        const currentDriverValue = driverSelect.value;
        options.drivers.forEach(driver => {
            const option = driverSelect.querySelector(`option[value="${driver.id}"]`);
            if (option) {
                option.disabled = driver.isPaired;
                if (driver.isPaired) {
                    option.textContent = driver.name + ' - Already paired';
                    option.style.color = '#9ca3af';
                } else {
                    option.textContent = driver.name;
                    option.style.color = '';
                }
            }
        });
        if (currentDriverValue && options.drivers.find(d => d.id == currentDriverValue && d.isPaired)) {
            driverSelect.value = '';
        }
    }
    
    if (ambulanceSelect && options.ambulances) {
        const currentAmbulanceValue = ambulanceSelect.value;
        options.ambulances.forEach(ambulance => {
            const option = ambulanceSelect.querySelector(`option[value="${ambulance.id}"]`);
            if (option) {
                const plateText = ambulance.plate_number ? ` (${ambulance.plate_number})` : '';
                option.disabled = ambulance.isFull;
                if (ambulance.isFull) {
                    option.textContent = ambulance.name + plateText + ' - Full (2/2 drivers)';
                    option.style.color = '#9ca3af';
                } else {
                    const count = ambulance.driverCount || 0;
                    option.textContent = ambulance.name + plateText + (count > 0 ? ` (${count}/2 drivers)` : '');
                    option.style.color = '';
                }
            }
        });
        if (currentAmbulanceValue && options.ambulances.find(a => a.id == currentAmbulanceValue && a.isFull)) {
            ambulanceSelect.value = '';
        }
    }
}

function clearDriverMedicErrors() {
    ['dmDriverIdError', 'dmMedicIdError', 'dmPairingDateError', 'dmStartTimeError', 'dmEndTimeError'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.style.display = 'none';
            el.textContent = '';
        }
    });
}

function clearDriverAmbulanceErrors() {
    ['daDriverIdError', 'daAmbulanceIdError', 'daPairingDateError'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.style.display = 'none';
            el.textContent = '';
        }
    });
}

// Form Submission
async function submitDriverMedicForm(event) {
    event.preventDefault();
    const form = event.target;
    const submitBtn = document.getElementById('dmSubmitBtn');
    const originalText = submitBtn.innerHTML;
    
    clearDriverMedicErrors();
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';
    
    const formData = new FormData(form);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    try {
        const response = await fetch('{{ route("admin.pairing.driver-medic.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        
        let data;
        const contentType = response.headers.get('content-type');
        const isJson = contentType && contentType.includes('application/json');
        
        if (isJson) {
            data = await response.json();
        } else {
            // If response is not JSON (redirect or HTML), reload page
            if (response.ok || response.redirected) {
                showToast('Driver-Medic pairing created successfully!', 'success');
                closeDriverMedicModal();
                setTimeout(() => window.location.reload(), 1500);
                return;
            } else {
                showToast('An error occurred. Please try again.', 'error');
                return;
            }
        }
        
        if (response.ok && data.success !== false) {
            showToast('Driver-Medic pairing created successfully!', 'success');
            closeDriverMedicModal();
            // Refresh the page to show new pairing
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            // Handle validation errors
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    // Map field names to error element IDs
                    const fieldMap = {
                        'driver_id': 'dmDriverIdError',
                        'medic_id': 'dmMedicIdError',
                        'pairing_date': 'dmPairingDateError',
                        'start_time': 'dmStartTimeError',
                        'end_time': 'dmEndTimeError',
                    };
                    const errorId = fieldMap[field] || `dm${field.charAt(0).toUpperCase() + field.slice(1).replace('_', '')}Error`;
                    const errorEl = document.getElementById(errorId);
                    if (errorEl) {
                        errorEl.textContent = Array.isArray(data.errors[field]) ? data.errors[field][0] : data.errors[field];
                        errorEl.style.display = 'block';
                    }
                });
            } else {
                showToast(data.message || 'Failed to create pairing', 'error');
            }
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
}

async function submitDriverAmbulanceForm(event) {
    event.preventDefault();
    const form = event.target;
    const submitBtn = document.getElementById('daSubmitBtn');
    const originalText = submitBtn.innerHTML;
    
    clearDriverAmbulanceErrors();
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';
    
    const formData = new FormData(form);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    try {
        const response = await fetch('{{ route("admin.pairing.driver-ambulance.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        
        let data;
        const contentType = response.headers.get('content-type');
        const isJson = contentType && contentType.includes('application/json');
        
        if (isJson) {
            data = await response.json();
        } else {
            // If response is not JSON (redirect or HTML), reload page
            if (response.ok || response.redirected) {
                showToast('Driver-Ambulance pairing created successfully!', 'success');
                closeDriverAmbulanceModal();
                setTimeout(() => window.location.reload(), 1500);
                return;
            } else {
                showToast('An error occurred. Please try again.', 'error');
                return;
            }
        }
        
        if (response.ok && data.success !== false) {
            showToast('Driver-Ambulance pairing created successfully!', 'success');
            closeDriverAmbulanceModal();
            // Refresh the page to show new pairing
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            // Handle validation errors
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    // Map field names to error element IDs
                    const fieldMap = {
                        'driver_id': 'daDriverIdError',
                        'ambulance_id': 'daAmbulanceIdError',
                        'pairing_date': 'daPairingDateError',
                    };
                    const errorId = fieldMap[field] || `da${field.charAt(0).toUpperCase() + field.slice(1).replace('_', '')}Error`;
                    const errorEl = document.getElementById(errorId);
                    if (errorEl) {
                        errorEl.textContent = Array.isArray(data.errors[field]) ? data.errors[field][0] : data.errors[field];
                        errorEl.style.display = 'block';
                    }
                });
            } else {
                showToast(data.message || 'Failed to create pairing', 'error');
            }
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('An error occurred. Please try again.', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
}

// Close modals when clicking outside
document.addEventListener('click', function(event) {
    const pairingTypeModal = document.getElementById('pairingTypeModal');
    const driverMedicModal = document.getElementById('driverMedicModal');
    const driverAmbulanceModal = document.getElementById('driverAmbulanceModal');
    
    if (event.target === pairingTypeModal) {
        closePairingTypeModal();
    }
    if (event.target === driverMedicModal) {
        closeDriverMedicModal();
    }
    if (event.target === driverAmbulanceModal) {
        closeDriverAmbulanceModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closePairingTypeModal();
        closeDriverMedicModal();
        closeDriverAmbulanceModal();
    }
});

function toggleTableView(type) {
    const driverMedicSection = document.getElementById('driverMedicSection');
    const driverAmbulanceSection = document.getElementById('driverAmbulanceSection');
    
    if (type === 'driver_ambulance') {
        driverMedicSection.style.display = 'none';
        driverAmbulanceSection.style.display = 'block';
    } else {
        driverMedicSection.style.display = 'block';
        driverAmbulanceSection.style.display = 'none';
    }
    
    // Trigger search to update the visible table
    const performSearch = window.performSearch;
    if (performSearch && typeof performSearch === 'function') {
        setTimeout(performSearch, 100);
    }
}

// Pairing panel functions removed - using direct navigation instead

function bulkActionGroup(pairingType, groupKey, action) {
    if (!confirm(`Are you sure you want to ${action} this pairing group?`)) {
        return;
    }
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("admin.pairing.group.action") }}';
    
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);
    
    const typeInput = document.createElement('input');
    typeInput.type = 'hidden';
    typeInput.name = 'pairing_type';
    typeInput.value = pairingType;
    form.appendChild(typeInput);
    
    const keyInput = document.createElement('input');
    keyInput.type = 'hidden';
    keyInput.name = 'group_key';
    keyInput.value = groupKey;
    form.appendChild(keyInput);
    
    const actionInput = document.createElement('input');
    actionInput.type = 'hidden';
    actionInput.name = 'action';
    actionInput.value = action;
    form.appendChild(actionInput);
    
    document.body.appendChild(form);
    form.submit();
}

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

// Live search functionality with AJAX
document.addEventListener('DOMContentLoaded', function(){
    const searchInput = document.getElementById('liveSearchInput');
    const driverSelect = document.getElementById('driverSelect');
    const viewTypeSelect = document.getElementById('viewTypeSelect');
    const searchIndicator = document.getElementById('searchIndicator');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    let searchTimeout;
    let isSearching = false;
    
    window.performSearch = function performSearch() {
        if (isSearching) return;
        
        const search = searchInput?.value || '';
        const driverId = driverSelect?.value || '';
        const viewType = viewTypeSelect?.value || 'driver_medic';
        
        // Show loading indicator
        if (searchIndicator) {
            searchIndicator.style.display = 'block';
        }
        
        isSearching = true;
        
        // Build query parameters
        const params = new URLSearchParams();
        if (search) params.append('search', search);
        if (driverId) params.append('driver_id', driverId);
        params.append('view_type', viewType);
        
        // Fetch data via AJAX
        fetch(`{{ route('admin.pairing.index') }}?${params.toString()}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            updateTables(data, viewType);
            if (searchIndicator) {
                searchIndicator.style.display = 'none';
            }
            isSearching = false;
        })
        .catch(error => {
            console.error('Search error:', error);
            if (searchIndicator) {
                searchIndicator.style.display = 'none';
            }
            isSearching = false;
        });
    }
    
    function updateTables(data, viewType) {
        // Update Driver-Medic table
        if (viewType === 'driver_medic' || !viewType) {
            updateDriverMedicTable(data.driverMedicPairings || []);
        }
        
        // Update Driver-Ambulance table
        if (viewType === 'driver_ambulance') {
            updateDriverAmbulanceTable(data.driverAmbulancePairings || []);
        }
    }
    
    function updateDriverMedicTable(pairings) {
        const tbody = document.querySelector('#driverMedicSection tbody');
        if (!tbody) return;
        
        if (pairings.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" class="empty-state">No driver-medic pairings found.</td></tr>';
            return;
        }
        
        tbody.innerHTML = pairings.map(pairing => {
            const medicsHtml = pairing.medics.map(medic => 
                `<span style="background: rgba(16, 185, 129, 0.1); color: #059669; padding: 0.25rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 700;">
                    ${medic.name}${medic.specialization ? ` <span style="opacity: 0.7;">(${medic.specialization})</span>` : ''}
                </span>`
            ).join('');
            
            const statusBadges = pairing.status.map(s => 
                `<span class="status-badge ${s}">${s.charAt(0).toUpperCase() + s.slice(1)}</span>`
            ).join('');
            
            const timeHtml = pairing.start_time && pairing.end_time 
                ? `<div style="font-weight: 600;">${formatTime(pairing.start_time)} - ${formatTime(pairing.end_time)}</div>`
                : '<span style="color: var(--muted);">N/A</span>';
            
            const actionsHtml = pairing.isActive 
                ? `<div class="action-buttons">
                    <button onclick="bulkActionGroup('driver_medic', '${pairing.groupKey}', 'complete')" class="action-btn complete" title="Complete">
                        <i class="fas fa-check"></i>
                    </button>
                    <button onclick="bulkActionGroup('driver_medic', '${pairing.groupKey}', 'cancel')" class="action-btn cancel" title="Cancel">
                        <i class="fas fa-times"></i>
                    </button>
                </div>`
                : '<span style="color: var(--muted); font-size: 0.85rem;">No actions</span>';
            
            return `
                <tr>
                    <td>
                        <div style="font-weight: 700; color: #0f172a;">${pairing.driver ? pairing.driver.name : 'Deleted Driver'}</div>
                        ${pairing.driver && pairing.driver.phone ? `<div style="font-size: 0.85rem; color: var(--muted);">📞 ${pairing.driver.phone}</div>` : ''}
                    </td>
                    <td>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.4rem;">${medicsHtml}</div>
                    </td>
                    <td>
                        <div style="font-weight: 700;">${pairing.pairing_date_formatted}</div>
                        <div style="font-size: 0.85rem; color: var(--muted);">${pairing.pairing_date_day}</div>
                    </td>
                    <td>${timeHtml}</td>
                    <td>
                        ${pairing.status.length === 1 
                            ? `<span class="status-badge ${pairing.status[0]}">${pairing.status[0].charAt(0).toUpperCase() + pairing.status[0].slice(1)}</span>`
                            : `<div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">${statusBadges}</div>`
                        }
                    </td>
                    <td>${actionsHtml}</td>
                </tr>
            `;
        }).join('');
        
        // Reinitialize pagination
        initializePagination('#driverMedicSection');
    }
    
    function updateDriverAmbulanceTable(pairings) {
        const tbody = document.querySelector('#driverAmbulanceSection tbody');
        if (!tbody) return;
        
        if (pairings.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="empty-state">No driver-ambulance pairings found.</td></tr>';
            return;
        }
        
        tbody.innerHTML = pairings.map(pairing => {
            const driversHtml = pairing.drivers.map(driver => 
                `<div style="font-weight: 700; color: #0f172a;">${driver.name}</div>`
            ).join('');
            
            const statusBadges = pairing.status.map(s => 
                `<span class="status-badge ${s}">${s.charAt(0).toUpperCase() + s.slice(1)}</span>`
            ).join('');
            
            const actionsHtml = pairing.isActive 
                ? `<div class="action-buttons">
                    <button onclick="bulkActionGroup('driver_ambulance', '${pairing.groupKey}', 'complete')" class="action-btn complete" title="Complete">
                        <i class="fas fa-check"></i>
                    </button>
                    <button onclick="bulkActionGroup('driver_ambulance', '${pairing.groupKey}', 'cancel')" class="action-btn cancel" title="Cancel">
                        <i class="fas fa-times"></i>
                    </button>
                </div>`
                : '<span style="color: var(--muted); font-size: 0.85rem;">No actions</span>';
            
            return `
                <tr>
                    <td>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">${driversHtml}</div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-ambulance" style="color: var(--accent);"></i>
                            <div>
                                <div style="font-weight: 700; color: #0f172a;">${pairing.ambulance ? pairing.ambulance.name : 'Deleted Ambulance'}</div>
                                ${pairing.ambulance && pairing.ambulance.plate_number ? `<div style="font-size: 0.85rem; color: var(--muted);">Plate: ${pairing.ambulance.plate_number}</div>` : ''}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 700;">${pairing.pairing_date_formatted}</div>
                        <div style="font-size: 0.85rem; color: var(--muted);">${pairing.pairing_date_day}</div>
                    </td>
                    <td>
                        ${pairing.status.length === 1 
                            ? `<span class="status-badge ${pairing.status[0]}">${pairing.status[0].charAt(0).toUpperCase() + pairing.status[0].slice(1)}</span>`
                            : `<div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">${statusBadges}</div>`
                        }
                    </td>
                    <td>${actionsHtml}</td>
                </tr>
            `;
        }).join('');
        
        // Reinitialize pagination
        initializePagination('#driverAmbulanceSection');
    }
    
    function formatTime(timeString) {
        if (!timeString) return '';
        const [hours, minutes] = timeString.split(':');
        const hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const displayHour = hour % 12 || 12;
        return `${displayHour}:${minutes} ${ampm}`;
    }
    
    function initializePagination(sectionId) {
        const section = document.querySelector(sectionId);
        if (!section) return;
        
        const tbl = section.querySelector('table[data-paginate="true"]');
        if (!tbl) return;
        
        const pageSize = parseInt(tbl.getAttribute('data-page-size') || '10', 10);
        const tbody = tbl.querySelector('tbody');
        if (!tbody) return;
        const rows = Array.from(tbody.children);
        if (rows.length <= pageSize) {
            const prevBtn = section.querySelector('.table-pager [data-prev]');
            const nextBtn = section.querySelector('.table-pager [data-next]');
            if (prevBtn) prevBtn.disabled = true;
            if (nextBtn) nextBtn.disabled = true;
            return;
        }

        let page = 0;
        const prevBtn = section.querySelector('.table-pager [data-prev]');
        const nextBtn = section.querySelector('.table-pager [data-next]');

        function render(){
            rows.forEach((tr, i)=>{
                const inPage = i >= page*pageSize && i < (page+1)*pageSize;
                tr.style.display = inPage ? '' : 'none';
            });
            if (prevBtn) prevBtn.disabled = page === 0;
            if (nextBtn) nextBtn.disabled = (page+1)*pageSize >= rows.length;
        }
        
        // Remove old event listeners by cloning
        const newPrevBtn = prevBtn?.cloneNode(true);
        const newNextBtn = nextBtn?.cloneNode(true);
        if (prevBtn && newPrevBtn) {
            prevBtn.parentNode.replaceChild(newPrevBtn, prevBtn);
            newPrevBtn.addEventListener('click', function(){ if (page>0){ page--; render(); } });
        }
        if (nextBtn && newNextBtn) {
            nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);
            newNextBtn.addEventListener('click', function(){ if ((page+1)*pageSize < rows.length){ page++; render(); } });
        }
        render();
    }
    
    if (searchInput) {
        // Real-time search with debouncing
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 300);
        });
    }
    
    if (driverSelect) {
        // Auto-search when driver select changes
        driverSelect.addEventListener('change', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 50);
        });
    }
    
    if (viewTypeSelect) {
        // Auto-search when view type changes and toggle view
        viewTypeSelect.addEventListener('change', function() {
            toggleTableView(this.value);
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 50);
        });
    }
});

// Simple pagination
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('table.pairing-table[data-paginate="true"]').forEach(function(tbl){
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