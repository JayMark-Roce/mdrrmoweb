<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reports - Completed Cases Log</title>

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

.reports-page-container {
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

.logs-field {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}

.logs-field span {
    font-size: 0.78rem;
    text-transform: uppercase;
    font-weight: 800;
    letter-spacing: 0.06em;
    color: var(--muted);
}

.logs-input,
.logs-select {
    border-radius: 14px;
    border: 1.5px solid rgba(148, 163, 184, 0.5);
    padding: 0.7rem 0.85rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--heading);
    background: #f8fafc;
    transition: border 0.2s ease, box-shadow 0.2s ease;
}

.logs-input:focus,
.logs-select:focus {
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

.table-actions button.placeholder-action {
    border: 1px dashed rgba(148, 163, 184, 0.8);
    background: rgba(241, 245, 249, 0.6);
    color: #94a3b8;
    cursor: not-allowed;
}

.table-actions button:hover {
    transform: translateY(-2px);
}

.logs-table-wrapper {
    overflow-x: auto;
}

.logs-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.92rem;
}

.logs-table thead {
    background: #f8fafc;
}

.logs-table th {
    text-align: left;
    padding: 0.95rem 1rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted);
    font-weight: 800;
    border-bottom: 1px solid var(--border-color);
}

.logs-table td {
    padding: 1rem;
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    color: #0f172a;
    vertical-align: top;
    background: #ffffff;
}

.logs-table tbody tr:hover td {
    background: rgba(248, 250, 252, 0.7);
}

.logs-table th:last-child,
.logs-table td:last-child {
    position: sticky;
    right: 0;
    background: #ffffff;
    box-shadow: -6px 0 12px rgba(15, 23, 42, 0.08);
}

.logs-pill {
    border-radius: 999px;
    padding: 0.35rem 0.9rem;
    font-size: 0.78rem;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.logs-pill--priority-low { background: rgba(14, 165, 233, 0.15); color: #0369a1; }
.logs-pill--priority-medium { background: rgba(245, 158, 11, 0.15); color: #92400e; }
.logs-pill--priority-high { background: rgba(239, 68, 68, 0.15); color: #991b1b; }
.logs-pill--priority-critical { background: rgba(185, 28, 28, 0.18); color: #7f1d1d; }
.logs-pill--muted { background: #e2e8f0; color: #475569; }
.logs-pill--info { background: rgba(59, 130, 246, 0.12); color: #1e40af; }

.logs-print-btn {
    border: none;
    border-radius: 999px;
    padding: 0.55rem 1rem;
    font-size: 0.8rem;
    font-weight: 800;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #ffffff;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    letter-spacing: 0.08em;
}

.logs-print-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.35);
}

.logs-print-btn--archived {
    border-radius: 999px;
    padding: 0.35rem 0.9rem;
    font-size: 0.78rem;
    font-weight: 700;
    background: #f9fafb;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    box-shadow: none;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}
.logs-print-btn--archived:hover {
    background: #e0f2fe;
}

.logs-archive-btn {
    border: none;
    border-radius: 999px;
    padding: 0.45rem 1rem;
    font-size: 0.78rem;
    font-weight: 700;
    background: linear-gradient(135deg, #f97316, #ea580c);
    color: #ffffff;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    box-shadow: 0 12px 24px rgba(249, 115, 22, 0.35);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.logs-archive-btn:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 16px 30px rgba(249, 115, 22, 0.35);
}
.logs-archive-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    box-shadow: none;
}
.logs-restore-btn {
    border: none;
    border-radius: 999px;
    padding: 0.35rem 0.9rem;
    font-size: 0.78rem;
    font-weight: 700;
    background: linear-gradient(135deg, #10b981, #059669);
    color: #ffffff;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    box-shadow: 0 12px 24px rgba(16, 185, 129, 0.35);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    width: 100%;
    justify-content: center;
    margin-top: 0.3rem;
}
.logs-restore-btn:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 16px 30px rgba(16, 185, 129, 0.35);
}
.logs-restore-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    box-shadow: none;
}
.logs-action-cell-inner {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
    align-items: flex-start;
    width: fit-content;
    min-width: 0;
}
.logs-action-cell-inner--archived {
    align-items: stretch;
    width: 100%;
}
.logs-action-cell-inner--archived .logs-print-btn--archived {
    width: 100%;
    justify-content: center;
}
.archive-meta {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    padding: 0.4rem 0.55rem;
    border-radius: 10px;
    background: rgba(15, 23, 42, 0.04);
    border: 1px solid rgba(148, 163, 184, 0.4);
    font-size: 0.8rem;
}
.archive-meta span {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    color: #0f172a;
    font-weight: 600;
}
.archive-meta small {
    color: #6b7280;
    font-size: 0.75rem;
}

.logs-empty,
.logs-error {
    padding: 2rem;
    text-align: center;
    color: var(--muted);
    display: flex;
    flex-direction: column;
    gap: 0.65rem;
    align-items: center;
}

.logs-empty i,
.logs-error i {
    font-size: 1.9rem;
    opacity: 0.6;
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

.print-modal-close:hover {
    background: #e5e7eb !important;
    color: #374151 !important;
}

.print-option-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2) !important;
}

.print-option-btn:active {
    transform: translateY(0);
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

@php
    $viewMode = $viewMode ?? 'completed';
    $isArchivedView = $viewMode === 'archived';
@endphp

<body data-view-mode="{{ $isArchivedView ? 'archived' : 'completed' }}">
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

<!-- Print Options Modal -->
<div id="print-options-modal" class="modal-overlay" style="display:none; position:fixed; inset:0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index:3000; align-items:center; justify-content:center;">
    <div class="print-modal-content" style="background: #ffffff; width: 90%; max-width: 500px; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); position: relative; overflow: hidden;">
        <button type="button" id="close-print-modal" class="print-modal-close" style="position: absolute; top: 12px; right: 12px; background: #f3f4f6; color: #6b7280; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; transition: all 0.2s;">
            <i class="fas fa-times"></i>
        </button>
        <div class="print-modal-header" style="background: linear-gradient(135deg, #2563eb, #1d4ed8); color: #ffffff; padding: 1.5rem; text-align: center;">
            <div style="width: 56px; height: 56px; background: rgba(255,255,255,0.2); border-radius: 12px; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-print"></i>
            </div>
            <h3 style="margin: 0; font-size: 1.25rem; font-weight: 800;">Select Print Format</h3>
            <p style="margin: 0.5rem 0 0; font-size: 0.9rem; opacity: 0.9;">Choose the format you want to print</p>
        </div>
        <div class="print-modal-body" style="padding: 2rem;">
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <button id="print-conduction-form" class="print-option-btn" style="background: linear-gradient(135deg, #10b981, #059669); color: #ffffff; border: none; padding: 1.25rem; border-radius: 12px; cursor: pointer; display: flex; align-items: center; gap: 1rem; transition: all 0.2s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                    <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div style="flex: 1; text-align: left;">
                        <div style="font-weight: 800; font-size: 1.1rem; margin-bottom: 0.25rem;">Conduction Form</div>
                        <div style="font-size: 0.85rem; opacity: 0.9;">Print the official conduction form</div>
                    </div>
                    <i class="fas fa-chevron-right" style="font-size: 1.1rem; opacity: 0.8;"></i>
                </button>
                <button id="print-case-details" class="print-option-btn" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: #ffffff; border: none; padding: 1.25rem; border-radius: 12px; cursor: pointer; display: flex; align-items: center; gap: 1rem; transition: all 0.2s; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">
                    <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div style="flex: 1; text-align: left;">
                        <div style="font-weight: 800; font-size: 1.1rem; margin-bottom: 0.25rem;">Case Details</div>
                        <div style="font-size: 0.85rem; opacity: 0.9;">Print detailed case information</div>
                    </div>
                    <i class="fas fa-chevron-right" style="font-size: 1.1rem; opacity: 0.8;"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Archive Case Modal -->
<div id="archiveCaseModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); backdrop-filter:blur(4px); -webkit-backdrop-filter:blur(4px); z-index:2000; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:24px; border:1px solid #e5e7eb; box-shadow:0 10px 25px rgba(0,0,0,0.12); width:min(440px, 92vw); position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(90deg, #f59e0b 0%, #f97316 100%); border-radius:24px 24px 0 0;"></div>
        <div style="padding:18px 20px; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between; margin-top:4px;">
            <div style="font-weight:700; color:#111827;">Archive case</div>
            <button onclick="closeArchiveCaseModal()" style="border:none; background:transparent; font-size:18px; cursor:pointer; color:#6b7280; transition:color 0.2s ease;">✕</button>
        </div>
        <div style="padding:18px 20px; color:#374151;">
            <p id="archiveCaseText" style="margin:0 0 12px 0;">Are you sure you want to archive this case?</p>
            <label style="display:block; margin-bottom:8px; font-size:13px; font-weight:600; color:#374151;">Optional note (leave blank to skip):</label>
            <textarea id="archiveCaseReason" placeholder="e.g., Case resolved, No longer needed, etc." style="width:100%; min-height:80px; padding:10px; border:1.5px solid #d1d5db; border-radius:8px; font-size:14px; font-family:inherit; resize:vertical; outline:none; transition:border 0.2s ease;" onfocus="this.style.borderColor='#2563eb';" onblur="this.style.borderColor='#d1d5db';"></textarea>
        </div>
        <div style="padding:16px 20px; border-top:1px solid #f3f4f6; display:flex; gap:10px; justify-content:flex-end;">
            <button onclick="closeArchiveCaseModal()" class="modal-cancel-btn" style="padding:10px 16px; border-radius:10px; border:1px solid #e5e7eb; background:#000000; color:#ffffff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Cancel</button>
            <button id="archiveCaseConfirm" class="modal-logout-btn" style="padding:10px 16px; border-radius:10px; border:none; background:linear-gradient(135deg, #f59e0b 0%, #f97316 100%); color:#fff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Archive</button>
        </div>
    </div>
</div>

<!-- Restore Case Modal -->
<div id="restoreCaseModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); backdrop-filter:blur(4px); -webkit-backdrop-filter:blur(4px); z-index:2000; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:24px; border:1px solid #e5e7eb; box-shadow:0 10px 25px rgba(0,0,0,0.12); width:min(440px, 92vw); position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(90deg, #10b981 0%, #059669 100%); border-radius:24px 24px 0 0;"></div>
        <div style="padding:18px 20px; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between; margin-top:4px;">
            <div style="font-weight:700; color:#111827;">Restore case</div>
            <button onclick="closeRestoreCaseModal()" style="border:none; background:transparent; font-size:18px; cursor:pointer; color:#6b7280; transition:color 0.2s ease;">✕</button>
        </div>
        <div style="padding:18px 20px; color:#374151;">
            <p id="restoreCaseText" style="margin:0;">Are you sure you want to restore this case?</p>
        </div>
        <div style="padding:16px 20px; border-top:1px solid #f3f4f6; display:flex; gap:10px; justify-content:flex-end;">
            <button onclick="closeRestoreCaseModal()" class="modal-cancel-btn" style="padding:10px 16px; border-radius:10px; border:1px solid #e5e7eb; background:#000000; color:#ffffff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Cancel</button>
            <button id="restoreCaseConfirm" class="modal-logout-btn" style="padding:10px 16px; border-radius:10px; border:none; background:linear-gradient(135deg, #10b981 0%, #059669 100%); color:#fff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Restore</button>
        </div>
    </div>
</div>

<!-- Main content -->
<main class="maincontentt pt-24">
    <div class="reports-page-container">

        <section class="hero-card">
            <div>
                <span class="hero-badge">
                    @if($isArchivedView)
                        <i class="fas fa-box-archive"></i> Archived Cases
                    @else
                        <i class="fas fa-bolt"></i> Completed Responses
                    @endif
                </span>
                <h3>{{ $isArchivedView ? 'The archive never forgets.' : 'Every mission documented beautifully.' }}</h3>
                <p>
                    @if($isArchivedView)
                        Browse preserved case files, revisit mission details, and keep institutional memory within reach.
                    @else
                        Explore a living history of emergency deployments, monitor performance, and print polished reports in just a few clicks.
                    @endif
                </p>
                <div class="hero-actions">
                    <button type="button" class="primary" id="refreshHeroBtn"><i class="fas fa-rotate"></i> Refresh data</button>
                    <button type="button" class="secondary" onclick="window.print()"><i class="fas fa-print"></i> Quick print</button>
                    @if($isArchivedView)
                        <button type="button" class="secondary" onclick="window.location.href='{{ route('admin.reports') }}'"><i class="fas fa-arrow-left"></i> Back to completed</button>
                    @else
                        <button type="button" class="secondary" onclick="window.location.href='{{ route('admin.reports.archived') }}'"><i class="fas fa-box-archive"></i> View archives</button>
                    @endif
                </div>
            </div>
            <div class="hero-kpis">
                <div class="hero-kpi-card">
                    <span>Cases logged</span>
                    <strong id="metricTotalCasesSmall">--</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Critical handled</span>
                    <strong id="metricHighPrioritySmall">--</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Active ambulances</span>
                    <strong id="metricUniqueAmbulancesSmall">--</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Last completion</span>
                    <strong id="metricLastCompletedSmall">--</strong>
                </div>
            </div>
        </section>

        <section class="insight-grid" id="reportsInsights">
            <article class="insight-card">
                <small>Total cases</small>
                <h4 id="metricTotalCases">--</h4>
                <div class="insight-trend" id="metricTotalTrend"><i class="fas fa-circle-up" style="color: var(--success);"></i><span>Awaiting data</span></div>
            </article>
            <article class="insight-card">
                <small>High & critical</small>
                <h4 id="metricHighPriority">--</h4>
                <div class="insight-trend" id="metricHighTrend"><i class="fas fa-heartbeat" style="color: var(--danger);"></i><span>Awaiting data</span></div>
            </article>
            <article class="insight-card">
                <small>Unique ambulances</small>
                <h4 id="metricUniqueAmbulances">--</h4>
                <div class="insight-trend"><i class="fas fa-ambulance" style="color: var(--accent);"></i><span id="metricUniqueLabel">Awaiting data</span></div>
            </article>
            <article class="insight-card">
                <small>Last completed case</small>
                <h4 id="metricLastCompleted">--</h4>
                <div class="insight-trend"><i class="fas fa-clock" style="color: var(--warning);"></i><span id="metricLastLabel">Awaiting data</span></div>
            </article>
        </section>

        <section class="filters-card">
            <div class="filters-header">
                <h5>Smart filters</h5>
                <div class="active-filters" id="activeFilters">
                    <span class="filter-chip muted">No filters applied</span>
                </div>
            </div>
            <div class="filters-grid">
                <label class="logs-field">
                    <span>Search</span>
                    <input id="logs-search" type="text" placeholder="Search name, address or case #" class="logs-input">
                </label>
                <label class="logs-field">
                    <span>Priority</span>
                    <select id="logs-priority" class="logs-select">
                        <option value="">All</option>
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                        <option>Critical</option>
                    </select>
                </label>
                <label class="logs-field">
                    <span>Ambulance</span>
                    <input id="logs-ambulance" type="text" placeholder="Ambulance name" class="logs-input">
                </label>
            </div>
        </section>

        <section class="table-card">
            <div class="table-card-header">
                <div>
                    <h4>{{ $isArchivedView ? 'Archived cases log' : 'Completed cases log' }}</h4>
                    <div class="table-meta">
                        <span id="lastRefreshedLabel">Waiting for first sync...</span>
                        <span id="tableCountLabel">0 entries visible</span>
                    </div>
                </div>
                <div class="table-actions">
                    <button type="button" class="primary" id="refreshLogsBtn"><i class="fas fa-rotate"></i> Refresh</button>
                    <button type="button" id="exportCsvBtn"><i class="fas fa-file-export"></i> Export CSV</button>
                    <button type="button" id="printTableBtn"><i class="fas fa-print"></i> Print table</button>
                    @if($isArchivedView)
                        <button type="button" onclick="window.location.href='{{ route('admin.reports') }}'"><i class="fas fa-arrow-left"></i> Back to completed</button>
                    @else
                        <button type="button" onclick="window.location.href='{{ route('admin.reports.archived') }}'"><i class="fas fa-box-archive"></i> View archives</button>
                    @endif
                </div>
            </div>

            <div class="logs-table-wrapper">
                <table class="logs-table" data-paginate="true" data-page-size="10">
                    <thead>
                        <tr>
                            <th>Case #</th>
                            <th>Caller</th>
                            <th>Caller Contact</th>
                            <th>Patient</th>
                            <th>Pickup Address</th>
                            <th>Destination Address</th>
                            <th>Priority</th>
                            <th>Type</th>
                            <th>Ambulance</th>
                            <th>Created</th>
                            <th>Completed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="logs-table-body">
                        <tr>
            <td colspan="12">
                <div class="logs-empty">
                    <i class="fas fa-spinner fa-spin"></i>
                    <p>{{ $isArchivedView ? 'Loading archived cases...' : 'Loading completed cases...' }}</p>
                </div>
            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination-bar">
                <div>
                    <strong>Tip:</strong> Click column headers to copy values quickly.
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
const reportsViewMode = document.body.dataset.viewMode || 'completed';
const isArchivedView = reportsViewMode === 'archived';

let reportsCasesCache = [];
let lastFetchTimestamp = null;
const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
const csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : '';

const CASE_ENDPOINTS = {
    completed: '/admin/cases/completed',
    archived: '/admin/cases/archived',
};

function getReferenceDate(record) {
    if (!record) return null;
    if (isArchivedView) {
        return record.archived_at || record.completed_at || record.updated_at || null;
    }
    return record.completed_at || record.updated_at || null;
}

async function loadReportsCases() {
    try {
        const endpoint = CASE_ENDPOINTS[reportsViewMode] || CASE_ENDPOINTS.completed;
        const response = await fetch(endpoint, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        });

        if (!response.ok) {
            if (response.status === 401 || response.status === 403) {
                throw new Error('Authentication required. Please log in as admin.');
            }
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('text/html')) {
            throw new Error('Authentication required. Please log in as admin.');
        }

        const data = await response.json();
        const cases = Array.isArray(data) ? data : (data.cases || []);
        reportsCasesCache = cases;
        lastFetchTimestamp = Date.now();

        updateReportsInsights();
        renderLogsList();
        updateLastRefreshedLabel();
    } catch (error) {
        console.error('Error loading cases:', error);
        const logsTableBody = document.getElementById('logs-table-body');
        if (logsTableBody) {
            let errorMessage = 'Error loading cases';
            if (error.message.includes('Authentication required')) {
                errorMessage = 'Please log in as admin to view cases';
            }

            logsTableBody.innerHTML = `
                <tr>
                    <td colspan="11">
                        <div class="logs-error">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p class="logs-error-title">${errorMessage}</p>
                            <p class="logs-error-subtitle">${error.message}</p>
                        </div>
                    </td>
                </tr>
            `;
        }
    }
}

function getLogsFilters() {
    const search = (document.getElementById('logs-search')?.value || '').toLowerCase().trim();
    const priority = document.getElementById('logs-priority')?.value || '';
    const ambulance = (document.getElementById('logs-ambulance')?.value || '').toLowerCase().trim();
    return { search, priority, ambulance };
}

function filterCases(list) {
    const { search, priority, ambulance } = getLogsFilters();
    return list.filter(c => {
        const matchesPriority = !priority || (c.priority || 'Medium') === priority;
        const haystack = `${c.case_num || ''} ${c.name || ''} ${c.address || ''} ${c.destination || c.to_go_to || c.destination_address || ''}`.toLowerCase();
        const matchesSearch = !search || haystack.includes(search);
        const ambName = (c.ambulance && c.ambulance.name ? c.ambulance.name : '').toLowerCase();
        const matchesAmb = !ambulance || ambName.includes(ambulance);
        return matchesPriority && matchesSearch && matchesAmb;
    });
}




function getPriorityClassName(priority) {
    const value = (priority || '').toLowerCase();
    if (value === 'low') return 'logs-pill--priority-low';
    if (value === 'high') return 'logs-pill--priority-high';
    if (value === 'critical' || value === 'emergency') return 'logs-pill--priority-critical';
    return 'logs-pill--priority-medium';
}

function generateCasePrintHtml(caseData) {
    const styles = `
        <style>
            @page { size: A4 portrait; margin: 0; }
            html, body { height: 100%; }
            body { font-family: Arial, sans-serif; color: #000; height: 100%; margin: 0; }
            .toolbar { text-align: right; margin-bottom: 8px; }
            .toolbar button { background:#111827;color:#fff;border:none;border-radius:6px;padding:6px 10px; font-weight:700; cursor:pointer; }
            .page { position: relative; width: 100%; height: 297mm; background: #fff; }
            .bg-img { position:absolute; inset:0; width:100%; height:100%; object-fit: cover; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            
            .field-name { position: absolute; left: 19mm; top: 62mm; font-size: 7pt; font-weight: bold; color: #000; max-width: 80mm; }
            .field-age { position: absolute; left: 19mm; top: 66mm; font-size: 7pt; font-weight: bold; color: #000; max-width: 15mm; }
            .field-sex { position: absolute; left: 45mm; top: 66mm; font-size: 7pt; font-weight: bold; color: #000; max-width: 15mm; }
            .field-dob { position: absolute; left: 70mm; top: 66mm; font-size: 7pt; font-weight: bold; color: #000; max-width: 25mm; }
            .field-contact { position: absolute; left: 19mm; top: 69mm; font-size: 7pt; font-weight: bold; color: #000; max-width: 80mm; }
            .field-address { position: absolute; left: 19mm; top: 73mm; font-size: 7pt; font-weight: bold; color: #000; max-width: 80mm; }
            .field-from { position: absolute; left: 19mm; top: 80mm; font-size: 7pt; font-weight: bold; color: #000; max-width: 80mm; }
            .field-to { position: absolute; left: 19mm; top: 86mm; font-size: 7pt; font-weight: bold; color: #000; max-width: 80mm; }
            
            @media print { .no-print { display: none; } .toolbar { display:none; } }
        </style>
    `;
    
    const now = new Date().toLocaleString();
    const fromText = (caseData.address || '').toString();
    const toText = (caseData.destination || caseData.to_go_to || '').toString();
    const patientName = caseData.name || 'Unidentified Patient';
    const patientContact = caseData.contact || '';
    const callerContact = caseData.caller_contact || '';
    const bestContact = patientContact || callerContact || '—';
    
    let fourPsStatus = 'None';
    if (caseData.four_ps_member) {
        fourPsStatus = caseData.four_ps_member;
    }
    
    return `
        <!DOCTYPE html>
        <html><head><meta charset="utf-8">${styles}<title>Case #${caseData.case_num || ''}</title></head>
        <body>
            <div class="toolbar no-print"><button onclick="window.print()">Print</button></div>
            <div class="page">
                <img class="bg-img" src="{{ asset('image/ConductionForm.png') }}" alt="Conduction Form" />
                
                <div class="field-name">Name: ${patientName}</div>
                <div class="field-age">Age: ${caseData.age || '—'}</div>
                <div class="field-sex">Sex: ${caseData.sex || caseData.gender || '—'}</div>
                <div class="field-dob">Date of Birth: ${caseData.date_of_birth ? new Date(caseData.date_of_birth).toLocaleDateString() : '—'}</div>
                <div class="field-contact">Contact No/s.: ${bestContact}</div>
                <div class="field-address">Address: ${caseData.address || '—'}</div>
                <div class="field-from">From: ${fromText}</div>
                <div class="field-to">To: ${toText}</div>
            </div>
        </body>
        </html>
    `;
}

// Store current case data for printing
let currentPrintCaseData = null;

function showPrintOptionsModal(caseData) {
    currentPrintCaseData = caseData;
    const modal = document.getElementById('print-options-modal');
    if (modal) {
        modal.style.display = 'flex';
    }
}

function closePrintOptionsModal() {
    const modal = document.getElementById('print-options-modal');
    if (modal) {
        modal.style.display = 'none';
    }
    currentPrintCaseData = null;
}

function printCase(caseData, format = 'conduction') {
    let html;
    if (format === 'conduction') {
        html = generateCasePrintHtml(caseData);
    } else {
        html = generateCaseDetailsPrintHtml(caseData);
    }
    
    const w = window.open('', '_blank');
    if (!w) return;
    w.document.open();
    w.document.write(html);
    w.document.close();
    w.onload = () => w.print();
    
    // Close modal after printing
    closePrintOptionsModal();
}

function generateCaseDetailsPrintHtml(caseData) {
    const styles = `
        <style>
            @page { size: A4 portrait; margin: 10mm 8mm; }
            html, body { margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
            body { color: #0f172a; background: #fff; font-size: 10pt; width: 100%; }
            .print-wrapper {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                gap: 0.65rem;
                width: 100%;
            }
            .print-header { 
                text-align: center; 
                border-bottom: 2px solid #0f172a; 
                padding: 1rem 0 0.85rem; 
                background: #f8fafc;
            }
            .print-header-logo { 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                gap: 1.5rem; 
                margin-bottom: 0.5rem; 
            }
            .print-header-logo img { 
                max-height: 100px; 
                max-width: 100px; 
                object-fit: contain; 
                filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
            }
            .print-header-content { flex: 1; }
            .print-header h1 { 
                margin: 0; 
                color: #031273; 
                font-size: 26pt; 
                font-weight: 900; 
                letter-spacing: 0.5px;
                text-transform: uppercase;
            }
            .print-header .org-name {
                margin: 0.5rem 0 0;
                color: #1e40af;
                font-size: 14pt;
                font-weight: 700;
            }
            .print-header .org-subtitle {
                margin: 0.25rem 0 0;
                color: #6b7280;
                font-size: 11pt;
                font-weight: 500;
            }
            .case-info { margin-bottom: 0.5rem; }
            .sections-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
                gap: 0.65rem;
            }
            .info-section { 
                page-break-inside: avoid; 
                background: #f9fafb;
                padding: 0.85rem 1rem;
                border-radius: 8px;
                border-left: 3px solid #142851;
            }
            .info-section h2 { 
                color: #031273; 
                font-size: 13pt; 
                font-weight: 800; 
                margin: 0 0 0.4rem 0; 
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
            .info-row { 
                display: flex; 
                margin-bottom: 0.45rem; 
                padding: 0.35rem 0;
                border-bottom: 1px dotted #d1d5db;
            }
            .info-row:last-child {
                border-bottom: none;
            }
            .info-label { 
                font-weight: 700; 
                color: #0f172a; 
                width: 165px; 
                font-size: 10pt;
                min-width: 165px;
            }
            .info-value { 
                color: #1f2937; 
                font-size: 10pt; 
                flex: 1;
                font-weight: 500;
            }
            .info-value strong {
                color: #031273;
                font-weight: 700;
            }
            .info-grid { 
                display: grid; 
                grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); 
                gap: 0.75rem; 
            }
            .badge { 
                display: inline-block; 
                padding: 5px 14px; 
                border-radius: 14px; 
                font-size: 9.5pt; 
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.3px;
            }
            .badge-medium { background: #fef3c7; color: #92400e; border: 1px solid #fbbf24; }
            .badge-high { background: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }
            .badge-low { background: #dbeafe; color: #1e40af; border: 1px solid #3b82f6; }
            .badge-critical { background: #fecaca; color: #7f1d1d; border: 1px solid #dc2626; }
            .badge-training { background: #dbeafe; color: #1e40af; border: 1px solid #3b82f6; }
            .badge-emergency { background: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }
            .personnel-section {
                background: #f1f5f9;
                border: 1px solid #d0dceb;
                border-radius: 6px;
                padding: 0.6rem 0.75rem;
                margin-top: 0.25rem;
            }
            .personnel-row {
                display: flex;
                align-items: center;
                gap: 0.55rem;
                margin-bottom: 0.55rem;
            }
            .personnel-row:last-child {
                margin-bottom: 0;
            }
            .personnel-label {
                font-weight: 700;
                color: #0f172a;
                width: 105px;
                font-size: 9.3pt;
            }
            .personnel-value {
                flex: 1;
                font-size: 10pt;
                font-weight: 600;
                color: #1f2937;
            }
            .signature-section {
                display: flex;
                justify-content: flex-end;
                margin-top: 0.75rem;
                page-break-inside: avoid;
            }
            .signature-block {
                width: 220px;
                text-align: center;
                margin-left: auto;
            }
            .signature-line {
                border-top: 1px solid #0f172a;
                margin: 1.8rem 0 0.25rem;
            }
            .signature-label {
                font-size: 9pt;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                color: #4b5563;
            }
            .footer {
                margin-top: 0.5rem;
                padding-top: 0.65rem;
                border-top: 2px solid #e5e7eb;
                text-align: center;
                color: #6b7280;
                font-size: 9pt;
            }
            .footer p {
                margin: 0.5rem 0;
            }
            @media print {
                .no-print { display: none; }
                body { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
                .info-section { page-break-inside: avoid; }
            }
        </style>
    `;
    
    const priority = caseData.priority || 'Medium';
    const priorityClass = `badge-${priority.toLowerCase()}`;
    const typeClass = caseData.type ? `badge-${caseData.type.toLowerCase().replace(/\s+/g, '-')}` : '';
    
    const createdAt = caseData.created_at ? new Date(caseData.created_at).toLocaleString() : 'Unknown';
    const completedAt = caseData.completed_at ? new Date(caseData.completed_at).toLocaleString() : 'Unknown';
    const pickupAddress = caseData.address || 'Not specified';
    const destinationAddress = caseData.destination || caseData.to_go_to || caseData.destination_address || 'Not specified';
    const ambulanceName = caseData.ambulance && caseData.ambulance.name ? caseData.ambulance.name : 'Not assigned';
    
    // Get pairing information
    const driverName = caseData.driver_pairing && caseData.driver_pairing.name ? caseData.driver_pairing.name : 'Not assigned';
    const driverPhone = caseData.driver_pairing && caseData.driver_pairing.phone ? caseData.driver_pairing.phone : 'N/A';
    
    // Get all medics (use medic_pairings array if available, otherwise fall back to medic_pairing)
    const medics = (caseData.medic_pairings && Array.isArray(caseData.medic_pairings) && caseData.medic_pairings.length > 0) 
        ? caseData.medic_pairings 
        : (caseData.medic_pairing ? [caseData.medic_pairing] : []);
    
    // Get logo path - try multiple formats with fallback
    const baseUrl = window.location.origin;
    const logoPath = baseUrl + '/image/mdrrmologo.png';
    const logoPathJpg = baseUrl + '/image/mdrrmologo.jpg';
    const logoPathWebp = baseUrl + '/image/mdrrmologo.webp';
    
    return `
        <!DOCTYPE html>
        <html><head><meta charset="utf-8">${styles}<title>Case Details #${caseData.case_num || ''}</title></head>
        <body>
        <div class="print-wrapper">
            <div class="print-header">
                <div class="print-header-logo">
                    <img src="${logoPath}" alt="MDRRMO Logo" onerror="this.onerror=null; this.src='${logoPathJpg}'; this.onerror=function(){this.onerror=null; this.src='${logoPathWebp}'; this.onerror=function(){this.style.display='none';};};">
                    <div class="print-header-content">
                        <h1>EMERGENCY CASE REPORT</h1>
                        <div class="org-name">MUNICIPAL DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</div>
                        <div class="org-subtitle">SILANG, CAVITE - Case Details Document</div>
                    </div>
                </div>
            </div>
            
            <div class="case-info">
                <div class="sections-grid">
                    <div class="info-section">
                        <h2>Case Information</h2>
                        <div class="info-row">
                            <span class="info-label">Case Number:</span>
                            <span class="info-value"><strong>#${caseData.case_num || 'N/A'}</strong></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="info-value"><strong style="color: #10b981;">✓ Completed</strong></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Priority Level:</span>
                            <span class="info-value"><span class="badge ${priorityClass}">${priority}</span></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Case Type:</span>
                            <span class="info-value"><span class="badge ${typeClass || 'badge-training'}">${caseData.type || 'N/A'}</span></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Date Created:</span>
                            <span class="info-value">${createdAt}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Date Completed:</span>
                            <span class="info-value">${completedAt}</span>
                        </div>
                    </div>
                    
                    <div class="info-section">
                        <h2>Caller Information</h2>
                        <div class="info-row">
                            <span class="info-label">Caller Name:</span>
                            <span class="info-value"><strong>${caseData.caller_name || 'Unknown Caller'}</strong></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Contact Number:</span>
                            <span class="info-value">${caseData.caller_contact || 'N/A'}</span>
                        </div>
                    </div>
                    
                    <div class="info-section">
                        <h2>Patient Information</h2>
                        <div class="info-row">
                            <span class="info-label">Patient Name:</span>
                            <span class="info-value"><strong>${caseData.name || 'Unidentified Patient'}</strong></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Contact Number:</span>
                            <span class="info-value">${caseData.contact || 'N/A'}</span>
                        </div>
                        ${caseData.age ? `
                        <div class="info-row">
                            <span class="info-label">Age:</span>
                            <span class="info-value">${caseData.age} years old</span>
                        </div>
                        ` : ''}
                        ${caseData.sex || caseData.gender ? `
                        <div class="info-row">
                            <span class="info-label">Sex/Gender:</span>
                            <span class="info-value">${caseData.sex || caseData.gender}</span>
                        </div>
                        ` : ''}
                        ${caseData.date_of_birth ? `
                        <div class="info-row">
                            <span class="info-label">Date of Birth:</span>
                            <span class="info-value">${new Date(caseData.date_of_birth).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</span>
                        </div>
                        ` : ''}
                    </div>
                </div>

                <div class="sections-grid">
                    <div class="info-section">
                        <h2>Location Information</h2>
                        <div class="info-row">
                            <span class="info-label">Pickup Address:</span>
                            <span class="info-value">${pickupAddress}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Destination Address:</span>
                            <span class="info-value">${destinationAddress}</span>
                        </div>
                    </div>

                    <div class="info-section">
                        <h2>Assigned Resources</h2>
                        <div class="info-row">
                            <span class="info-label">Ambulance Unit:</span>
                            <span class="info-value"><strong>${ambulanceName}</strong></span>
                        </div>
                        <div class="personnel-section">
                            <div class="personnel-row">
                                <span class="personnel-label">Driver:</span>
                                <span class="personnel-value">${driverName}${driverPhone !== 'N/A' ? ` | Contact: ${driverPhone}` : ''}</span>
                            </div>
                            ${medics.length > 0 ? `
                            ${medics.map((medic, index) => `
                            <div class="personnel-row">
                                <span class="personnel-label">${medics.length > 1 ? `Medic ${index + 1}:` : 'Medic:'}</span>
                                <span class="personnel-value">${medic.name || 'Not assigned'}${medic.phone && medic.phone !== 'N/A' ? ` | Contact: ${medic.phone}` : ''}${medic.specialization && medic.specialization !== 'N/A' ? ` | Specialization: ${medic.specialization}` : ''}</span>
                            </div>
                            `).join('')}
                            ` : `
                            <div class="personnel-row">
                                <span class="personnel-label">Medic:</span>
                                <span class="personnel-value">Not assigned</span>
                            </div>
                            `}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="signature-section">
                <div class="signature-block">
                    <div class="signature-line"></div>
                    <div class="signature-label">Authorized Administrator</div>
                </div>
            </div>

            <div class="footer">
                <p><strong>Document Generated:</strong> ${new Date().toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</p>
                <p><strong>SILANG MDRRMO</strong> - Emergency Response Management System</p>
                <p style="font-size: 8pt; margin-top: 0.75rem;">This is an official document generated by the Municipal Disaster Risk Reduction and Management Office</p>
            </div>
        </div>
        </body>
        </html>
    `;
}

function formatNumber(value) {
    return new Intl.NumberFormat('en-US').format(value || 0);
}

function formatDateTime(value) {
    if (!value) return 'Not available';
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

function escapeHtml(value) {
    if (value === null || value === undefined) return '';
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function buildArchiveMeta(caseData) {
    const archivedAtText = caseData.archived_at ? formatDateTime(caseData.archived_at) : 'Unknown date';
    const archivedByText = caseData.archived_by ? caseData.archived_by : 'System';
    const archivedReason = caseData.archived_reason ? escapeHtml(caseData.archived_reason) : '';
    return `
        <div class="archive-meta">
            <span><i class="fas fa-box-archive"></i> Archived ${archivedAtText}</span>
            <span><i class="fas fa-user-shield"></i> ${archivedByText}</span>
            ${archivedReason ? `<small>Note: ${archivedReason}</small>` : ''}
        </div>
    `;
}

function updateReportsInsights() {
    const total = reportsCasesCache.length;
    const high = reportsCasesCache.filter(c => ['high', 'critical', 'emergency'].includes((c.priority || '').toLowerCase())).length;
    const ambulanceSet = new Set(reportsCasesCache.map(c => (c.ambulance && c.ambulance.name) || '').filter(Boolean));
    const lastRecord = reportsCasesCache
        .slice()
        .filter(c => getReferenceDate(c))
        .sort((a, b) => new Date(getReferenceDate(b)) - new Date(getReferenceDate(a)))[0];

    const totalEl = document.getElementById('metricTotalCases');
    const totalSmall = document.getElementById('metricTotalCasesSmall');
    if (totalEl) totalEl.textContent = formatNumber(total);
    if (totalSmall) totalSmall.textContent = formatNumber(total);

    const highEl = document.getElementById('metricHighPriority');
    const highSmall = document.getElementById('metricHighPrioritySmall');
    if (highEl) highEl.textContent = formatNumber(high);
    if (highSmall) highSmall.textContent = formatNumber(high);

    const uniqueEl = document.getElementById('metricUniqueAmbulances');
    const uniqueSmall = document.getElementById('metricUniqueAmbulancesSmall');
    if (uniqueEl) uniqueEl.textContent = formatNumber(ambulanceSet.size);
    if (uniqueSmall) uniqueSmall.textContent = formatNumber(ambulanceSet.size);

    const lastEl = document.getElementById('metricLastCompleted');
    const lastSmall = document.getElementById('metricLastCompletedSmall');
    const lastLabel = document.getElementById('metricLastLabel');
    const awaitingLabel = isArchivedView ? 'Awaiting archive data' : 'Awaiting data';
    if (lastEl) lastEl.textContent = lastRecord ? `#${lastRecord.case_num || '—'}` : '--';
    if (lastSmall) lastSmall.textContent = lastRecord ? (lastRecord.case_num || '—') : '--';
    if (lastLabel) lastLabel.textContent = lastRecord ? formatDateTime(getReferenceDate(lastRecord)) : awaitingLabel;

    const highTrend = document.getElementById('metricHighTrend');
    if (highTrend) {
        const percentage = total ? Math.round((high / total) * 100) : 0;
        highTrend.innerHTML = `<i class="fas fa-shield-heart" style="color: var(--danger);"></i><span>${percentage}% of cases</span>`;
    }

    const uniqueLabel = document.getElementById('metricUniqueLabel');
    if (uniqueLabel) {
        uniqueLabel.textContent = ambulanceSet.size ? `${ambulanceSet.size} vehicle${ambulanceSet.size > 1 ? 's' : ''} engaged` : 'Awaiting data';
    }

    const totalTrend = document.getElementById('metricTotalTrend');
    if (totalTrend) {
        const label = total ? (isArchivedView ? 'Archive refreshed' : 'Live history updated') : (isArchivedView ? 'Awaiting archive data' : 'Awaiting data');
        totalTrend.innerHTML = `<i class="fas fa-chart-line" style="color: var(--success);"></i><span>${label}</span>`;
    }
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

function getVisibleCases() {
    return filterCases(reportsCasesCache || []);
}

function updateActiveFiltersUI() {
    const container = document.getElementById('activeFilters');
    if (!container) return;

    const { search, priority, ambulance } = getLogsFilters();
    container.innerHTML = '';
    const chips = [];

    if (search) {
        chips.push({ label: `Search: "${search}"`, clear: () => { document.getElementById('logs-search').value = ''; } });
    }
    if (priority) {
        chips.push({ label: `Priority: ${priority}`, clear: () => { document.getElementById('logs-priority').value = ''; } });
    }
    if (ambulance) {
        chips.push({ label: `Ambulance: ${ambulance}`, clear: () => { document.getElementById('logs-ambulance').value = ''; } });
    }

    if (!chips.length) {
        const span = document.createElement('span');
        span.className = 'filter-chip muted';
        span.textContent = 'No filters applied';
        container.appendChild(span);
        return;
    }

    chips.forEach(chip => {
        const el = document.createElement('span');
        el.className = 'filter-chip';
        el.innerHTML = `${chip.label} <button type="button" aria-label="Remove filter">&times;</button>`;
        const btn = el.querySelector('button');
        btn.addEventListener('click', () => {
            chip.clear();
            renderLogsList();
        });
        container.appendChild(el);
    });
}

function renderLogsList() {
    const logsTableBody = document.getElementById('logs-table-body');
    if (!logsTableBody) return;
    logsTableBody.innerHTML = '';
    const filtered = getVisibleCases();
    updateTableCountLabel(filtered.length);
    updateActiveFiltersUI();

    if (!Array.isArray(filtered) || filtered.length === 0) {
        const emptyLabel = isArchivedView ? 'No archived cases found' : 'No completed cases found';
        logsTableBody.innerHTML = `
            <tr>
                <td colspan="12">
                    <div class="logs-empty">
                        <i class="fas fa-inbox"></i>
                        <p>${emptyLabel}</p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    filtered.forEach(caseData => {
        const priority = caseData.priority || 'Medium';
        const priorityClass = getPriorityClassName(priority);
        const typeTag = caseData.type ? `<span class="logs-pill logs-pill--info">${caseData.type}</span>` : '';
        const ambulanceNameRaw = caseData.ambulance && caseData.ambulance.name ? caseData.ambulance.name : 'Unknown Ambulance';
        const ambulanceName = String(ambulanceNameRaw).replace(/\s+/g, ' ').trim();
        const createdAt = caseData.created_at ? new Date(caseData.created_at).toLocaleString() : 'Unknown';
        const completedAt = caseData.completed_at ? new Date(caseData.completed_at).toLocaleString() : 'Unknown';
        const pickupAddress = caseData.address || 'No pickup address';
        const destinationAddress = caseData.destination || caseData.to_go_to || caseData.destination_address || 'No destination address';

        const actionCellHtml = isArchivedView
            ? `
                <div class="logs-action-cell-inner logs-action-cell-inner--archived">
                    ${buildArchiveMeta(caseData)}
                    <button class="logs-print-btn--archived" data-case="${caseData.case_num ?? ''}">
                        <i class="fas fa-print"></i><span>Print</span>
                    </button>
                    <button class="logs-restore-btn" type="button" data-case="${caseData.case_num ?? ''}" data-archived-id="${caseData.id ?? ''}">
                        <i class="fas fa-undo"></i><span>Restore</span>
                    </button>
                </div>
            `
            : `
                <div class="logs-action-cell-inner">
                    <button class="logs-print-btn" data-case="${caseData.case_num ?? ''}"><i class="fas fa-print"></i> Print</button>
                    <button class="logs-archive-btn" type="button" data-case="${caseData.case_num ?? ''}">
                        <i class="fas fa-box-archive"></i> Archive
                    </button>
                </div>
            `;

        const callerName = caseData.caller_name || 'Unknown Caller';
        const callerContact = caseData.caller_contact || caseData.contact || null;
        const patientName = caseData.name ?? 'Unidentified Patient';
        const patientContact = caseData.contact || null;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>Case #${caseData.case_num ?? '—'}</td>
            <td><div style="font-weight:700;">${callerName}</div></td>
            <td class="logs-contact-cell">${callerContact ? `📞 ${callerContact}` : 'N/A'}</td>
            <td>
                <div style="font-weight:700;">${patientName}</div>
                ${patientContact ? `<div style="font-size:0.85rem; color:#6b7280;">Patient contact: ${patientContact}</div>` : ''}
            </td>
            <td>${pickupAddress}</td>
            <td>${destinationAddress}</td>
            <td><span class="logs-pill ${priorityClass}">${priority}</span></td>
            <td>${typeTag || '<span class="logs-pill logs-pill--muted">N/A</span>'}</td>
            <td class="logs-ambulance-cell">${ambulanceName}</td>
            <td>${createdAt}</td>
            <td>${completedAt}</td>
            <td>${actionCellHtml}</td>
        `;

        const printBtn = row.querySelector('.logs-print-btn, .logs-print-btn--archived');
        if (printBtn) {
            printBtn.addEventListener('click', (e) => {
                e.preventDefault();
                showPrintOptionsModal(caseData);
            });
        }

        if (!isArchivedView) {
            const archiveBtn = row.querySelector('.logs-archive-btn');
            if (archiveBtn) {
                archiveBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    archiveCase(caseData, archiveBtn);
                });
            }
        } else {
            const restoreBtn = row.querySelector('.logs-restore-btn');
            if (restoreBtn) {
                restoreBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    restoreCase(caseData, restoreBtn);
                });
            }
        }

        logsTableBody.appendChild(row);
    });
}

// Archive Case Modal Functions
let selectedArchiveCaseData = null;
let selectedArchiveTriggerButton = null;

function openArchiveCaseModal(caseData, triggerButton = null) {
    selectedArchiveCaseData = caseData;
    selectedArchiveTriggerButton = triggerButton;
    const modal = document.getElementById('archiveCaseModal');
    const text = document.getElementById('archiveCaseText');
    const reasonInput = document.getElementById('archiveCaseReason');
    if (text) text.textContent = `Are you sure you want to archive Case #${caseData.case_num}? This will remove it from the completed log but keep a copy in the archives.`;
    if (reasonInput) reasonInput.value = '';
    if (modal) modal.style.display = 'flex';
    const btn = document.getElementById('archiveCaseConfirm');
    if (btn) {
        btn.onclick = submitArchiveCase;
    }
}

function closeArchiveCaseModal() {
    const modal = document.getElementById('archiveCaseModal');
    if (modal) modal.style.display = 'none';
    selectedArchiveCaseData = null;
    selectedArchiveTriggerButton = null;
    const reasonInput = document.getElementById('archiveCaseReason');
    if (reasonInput) reasonInput.value = '';
}

async function submitArchiveCase() {
    if (!selectedArchiveCaseData || !selectedArchiveCaseData.case_num) {
        alert('Invalid case selected for archiving.');
        return;
    }

    const caseNum = selectedArchiveCaseData.case_num;
    const triggerBtn = selectedArchiveTriggerButton;
    const reasonInput = document.getElementById('archiveCaseReason');
    const reason = reasonInput ? reasonInput.value.trim() : '';

    if (triggerBtn) {
        triggerBtn.disabled = true;
    }

    try {
        const response = await fetch(`/admin/cases/${caseNum}/archive`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                reason: reason && reason.length ? reason : null
            })
        });

        const result = await response.json().catch(() => ({}));

        if (!response.ok || !result.success) {
            throw new Error(result && result.message ? result.message : `Server returned ${response.status}`);
        }

        closeArchiveCaseModal();
        alert(`Case #${caseNum} was archived successfully.`);
        loadReportsCases();
    } catch (error) {
        console.error('Failed to archive case:', error);
        alert(`Unable to archive case #${caseNum}: ${error.message}`);
    } finally {
        if (triggerBtn) {
            triggerBtn.disabled = false;
        }
    }
}

let selectedRestoreCaseData = null;
let selectedRestoreTriggerButton = null;

function openRestoreCaseModal(caseData, triggerButton = null) {
    selectedRestoreCaseData = caseData;
    selectedRestoreTriggerButton = triggerButton;
    const modal = document.getElementById('restoreCaseModal');
    const text = document.getElementById('restoreCaseText');
    if (text) text.textContent = `Are you sure you want to restore Case #${caseData.case_num}? This will move it back to the completed cases log.`;
    if (modal) modal.style.display = 'flex';
    const btn = document.getElementById('restoreCaseConfirm');
    if (btn) {
        btn.onclick = submitRestoreCase;
    }
}

function closeRestoreCaseModal() {
    const modal = document.getElementById('restoreCaseModal');
    if (modal) modal.style.display = 'none';
    selectedRestoreCaseData = null;
    selectedRestoreTriggerButton = null;
}

async function submitRestoreCase() {
    if (!selectedRestoreCaseData || !selectedRestoreCaseData.case_num) {
        alert('Invalid case selected for restoration.');
        return;
    }

    const caseNum = selectedRestoreCaseData.case_num;
    const triggerBtn = selectedRestoreTriggerButton;

    if (triggerBtn) {
        triggerBtn.disabled = true;
    }

    try {
        const archivedId = selectedRestoreCaseData.id || triggerBtn?.dataset?.archivedId;
        if (!archivedId) {
            throw new Error('Archived case ID not found');
        }

        const response = await fetch(`/admin/cases/archived/${archivedId}/restore`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        });

        const result = await response.json().catch(() => ({}));

        if (!response.ok || !result.success) {
            throw new Error(result && result.message ? result.message : `Server returned ${response.status}`);
        }

        closeRestoreCaseModal();
        alert(`Case #${caseNum} was restored successfully.`);
        loadReportsCases();
    } catch (error) {
        console.error('Failed to restore case:', error);
        alert(`Unable to restore case #${caseNum}: ${error.message}`);
    } finally {
        if (triggerBtn) {
            triggerBtn.disabled = false;
        }
    }
}

async function archiveCase(caseData, triggerButton = null) {
    if (isArchivedView) {
        return;
    }
    if (!caseData || !caseData.case_num) {
        alert('Invalid case selected for archiving.');
        return;
    }
    openArchiveCaseModal(caseData, triggerButton);
}

async function restoreCase(caseData, triggerButton = null) {
    if (!isArchivedView) {
        return;
    }
    if (!caseData || !caseData.case_num) {
        alert('Invalid case selected for restoration.');
        return;
    }
    openRestoreCaseModal(caseData, triggerButton);
}

function csvEscape(value) {
    if (value === null || value === undefined) return '""';
    const str = String(value).replace(/"/g, '""');
    return `"${str}"`;
}

function exportCasesCsv() {
    const visible = getVisibleCases();
    if (!visible.length) {
        alert(`No ${isArchivedView ? 'archived ' : ''}cases available to export with the current filters.`);
        return;
    }
    const headers = ['Case Number','Caller Name','Caller Contact','Patient Name','Patient Contact','Pickup Address','Destination Address','Priority','Type','Ambulance','Created At','Completed At'];
    if (isArchivedView) {
        headers.push('Archived At','Archived By','Archive Note');
    }
    const rows = visible.map(c => [
        c.case_num ?? '',
        c.caller_name ?? '',
        c.caller_contact ?? '',
        c.name ?? '',
        c.contact ?? '',
        c.address ?? '',
        c.destination || c.to_go_to || c.destination_address || '',
        c.priority ?? '',
        c.type ?? '',
        c.ambulance && c.ambulance.name ? c.ambulance.name : '',
        c.created_at ? formatDateTime(c.created_at) : '',
        c.completed_at ? formatDateTime(c.completed_at) : '',
        ...(isArchivedView ? [
            c.archived_at ? formatDateTime(c.archived_at) : '',
            c.archived_by ?? '',
            c.archived_reason ?? ''
        ] : [])
    ]);
    const csvContent = [headers.map(csvEscape).join(',')]
        .concat(rows.map(row => row.map(csvEscape).join(',')))
        .join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = `${isArchivedView ? 'archived' : 'completed'}-cases-${new Date().toISOString().slice(0,10)}.csv`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    setTimeout(() => URL.revokeObjectURL(url), 500);
}

function printVisibleCasesTable() {
    const visible = getVisibleCases();
    if (!visible.length) {
        alert(`No ${isArchivedView ? 'archived ' : ''}cases available to print with the current filters.`);
        return;
    }
    const rowsHtml = visible.map(c => `
        <tr>
            <td>${c.case_num ?? '—'}</td>
            <td>${c.caller_name ?? 'Unknown Caller'}</td>
            <td>${c.caller_contact ?? c.contact ?? 'N/A'}</td>
            <td>${c.name ?? 'Unidentified'}</td>
            <td>${c.contact ?? 'N/A'}</td>
            <td>${c.address ?? 'N/A'}</td>
            <td>${c.destination || c.to_go_to || c.destination_address || 'N/A'}</td>
            <td>${c.priority ?? 'N/A'}</td>
            <td>${c.type ?? 'N/A'}</td>
            <td>${c.ambulance && c.ambulance.name ? c.ambulance.name : 'N/A'}</td>
            <td>${c.created_at ? formatDateTime(c.created_at) : 'N/A'}</td>
            <td>${c.completed_at ? formatDateTime(c.completed_at) : 'N/A'}</td>
            ${isArchivedView ? `<td>${c.archived_at ? formatDateTime(c.archived_at) : 'N/A'}</td>` : ''}
        </tr>
    `).join('');

    const archivedHeader = isArchivedView ? '<th>Archived</th>' : '';
    const html = `
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>${isArchivedView ? 'Archived' : 'Completed'} Cases Log</title>
            <style>
                body { font-family: 'Segoe UI', sans-serif; padding: 1.5rem; color: #0f172a; }
                h2 { margin-top: 0; }
                table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
                th, td { border: 1px solid #cbd5f5; padding: 0.5rem; text-align: left; }
                th { background: #e0e7ff; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.08em; }
                tr:nth-child(even) td { background: #f8fafc; }
            </style>
        </head>
        <body>
            <h2>${isArchivedView ? 'Archived' : 'Completed'} Cases (${visible.length})</h2>
            <table>
                <thead>
                    <tr>
                        <th>Case #</th>
                        <th>Caller</th>
                        <th>Caller Contact</th>
                        <th>Patient</th>
                        <th>Patient Contact</th>
                        <th>Pickup</th>
                        <th>Destination</th>
                        <th>Priority</th>
                        <th>Type</th>
                        <th>Ambulance</th>
                        <th>Created</th>
                        <th>Completed</th>
                        ${archivedHeader}
                    </tr>
                </thead>
                <tbody>${rowsHtml}</tbody>
            </table>
            <script>window.onload = () => window.print();<\/script>
        </body>
        </html>
    `;

    const w = window.open('', '_blank');
    if (!w) return;
    w.document.write(html);
    w.document.close();
}
// Logs controls events
document.getElementById('logs-search')?.addEventListener('input', () => renderLogsList());
document.getElementById('logs-ambulance')?.addEventListener('input', () => renderLogsList());
document.getElementById('logs-priority')?.addEventListener('change', () => renderLogsList());

document.getElementById('refreshLogsBtn')?.addEventListener('click', () => loadReportsCases());
document.getElementById('refreshHeroBtn')?.addEventListener('click', () => loadReportsCases());
document.getElementById('exportCsvBtn')?.addEventListener('click', exportCasesCsv);
document.getElementById('printTableBtn')?.addEventListener('click', printVisibleCasesTable);

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

// Print modal event listeners
document.getElementById('close-print-modal')?.addEventListener('click', function(e) {
    e.preventDefault();
    closePrintOptionsModal();
});

document.getElementById('print-conduction-form')?.addEventListener('click', function(e) {
    e.preventDefault();
    if (currentPrintCaseData) {
        printCase(currentPrintCaseData, 'conduction');
    }
});

document.getElementById('print-case-details')?.addEventListener('click', function(e) {
    e.preventDefault();
    if (currentPrintCaseData) {
        printCase(currentPrintCaseData, 'details');
    }
});

// Close modal when clicking outside
document.getElementById('print-options-modal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closePrintOptionsModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePrintOptionsModal();
        closeArchiveCaseModal();
        closeRestoreCaseModal();
    }
});

// Close modals when clicking outside
document.getElementById('archiveCaseModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeArchiveCaseModal();
    }
});

document.getElementById('restoreCaseModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeRestoreCaseModal();
    }
});

// Load cases on page load
document.addEventListener('DOMContentLoaded', function() {
    updateActiveFiltersUI();
    loadReportsCases();
});
</script>

</body>
</html>


