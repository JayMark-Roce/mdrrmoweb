
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reported Cases - SILANG MDRRMO</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/stylish.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-view.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Laravel CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

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
    vertical-align: middle;
    background: #ffffff;
}

.logs-table tbody tr:hover td {
    background: rgba(248, 250, 252, 0.7);
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

.logs-pill--muted { background: #e2e8f0; color: #475569; }
.logs-pill--info { background: rgba(59, 130, 246, 0.12); color: #1e40af; }

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

.action-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    align-items: center;
}

.action-btn {
    border: none;
    border-radius: 8px;
    padding: 0.5rem 0.85rem;
    font-weight: 700;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}

.action-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.action-btn-details {
    background: #64748b;
    color: white;
}

.action-btn-map {
    background: #3b82f6;
    color: white;
}

.action-btn-accept {
    background: #22c55e;
    color: white;
}

.action-btn-dispatch {
    background: #2563eb;
    color: white;
}

.action-btn-resolve {
    background: #16a34a;
    color: white;
}

.action-btn-decline {
    background: #dc2626;
    color: white;
}

.action-btn-resolved {
    font-size: 0.75rem;
    color: #16a34a;
    font-weight: 600;
    background: transparent;
    padding: 0;
}

.action-btn-declined {
    font-size: 0.75rem;
    color: #dc2626;
    font-weight: 600;
    background: transparent;
    padding: 0;
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);
    z-index: 10000;
    display: none;
    align-items: center;
    justify-content: center;
}

.modal-box {
    background: white;
    width: 90%;
    max-width: 500px;
    border-radius: 16px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.25);
    overflow: hidden;
    animation: popIn 0.3s ease-out;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-header {
    background: linear-gradient(135deg, #0b2a55, #1e40af);
    padding: 20px 25px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-close {
    background: transparent;
    border: none;
    color: rgba(255,255,255,0.7);
    font-size: 24px;
    cursor: pointer;
}

.modal-body {
    padding: 25px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 12px;
}

.detail-label {
    font-weight: 700;
    color: #94a3b8;
    font-size: 12px;
    text-transform: uppercase;
    width: 120px;
}

.detail-value {
    font-weight: 600;
    color: #334155;
    font-size: 14px;
    flex: 1;
}

.modal-image-container {
    text-align: center;
    margin-top: 15px;
    border-top: 1px solid #f1f5f9;
    padding-top: 15px;
}

.modal-image {
    max-width: 100%;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    margin-top: 10px;
    cursor: pointer;
}

.image-gallery {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 8px;
}

.gallery-main {
    flex: 1;
}

.gallery-nav {
    background: #e2e8f0;
    border: none;
    border-radius: 999px;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-weight: 700;
    color: #334155;
}

.gallery-nav:disabled {
    opacity: 0.4;
    cursor: default;
}

.thumbnail-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 6px;
    margin-top: 10px;
}

.thumbnail-image {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 6px;
    border: 2px solid transparent;
    cursor: pointer;
}

.thumbnail-image.active {
    border-color: #0b2a55;
}

.modal-actions {
    background: #f8fafc;
    padding: 15px 25px;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

@keyframes popIn {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.loading-text {
    font-style: italic;
    color: #94a3b8;
    font-size: 12px;
}

#liveStatus {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 8px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
    background: gray;
    color: white;
    z-index: 9999;
}

.highlight {
    animation: flash 1s ease-in-out 2;
}

@keyframes flash {
    0% { background: #fff3cd; }
    50% { background: #ffeeba; }
    100% { background: transparent; }
}

@keyframes highlightNew {
    from { background-color: #fee2e2; }
    to { background-color: white; }
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

/* Notification Bell & Panel */
.notif-bell-container { position: fixed; bottom: 60px; right: 30px; z-index: 9999; }
.notif-bell { background: #0b2a55; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.3); transition: transform 0.2s; position: relative; }
.notif-bell:hover { transform: scale(1.1); }
.notif-badge { position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; font-size: 12px; font-weight: bold; padding: 4px 8px; border-radius: 50%; border: 2px solid white; display: none; }
.notif-panel { position: absolute; bottom: 80px; right: 0; width: 350px; background: white; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); display: none; flex-direction: column; overflow: hidden; border: 1px solid #e5e7eb; }
.notif-panel.active { display: flex; }
.notif-header { padding: 15px; background: #f8fafc; border-bottom: 1px solid #e5e7eb; font-weight: 700; display: flex; justify-content: space-between; }
.notif-list { max-height: 400px; overflow-y: auto; }
.notif-item { padding: 15px; border-bottom: 1px solid #f1f5f9; cursor: pointer; display: flex; gap: 12px; }
.notif-item:hover { background: #f1f5f9; }
.notif-item.new { background: #eff6ff; }
.notif-item .icon-box { width: 36px; height: 36px; background: #fee2e2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }

/* Global Toast */
#global-toast-container { position: fixed; top: 20px; right: 20px; z-index: 10000; display: flex; flex-direction: column; gap: 10px; pointer-events: none; }
.global-toast { background: white; border-left: 5px solid #ef4444; padding: 15px 20px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 15px; min-width: 300px; pointer-events: auto; animation: slideIn 0.4s ease-out; cursor: pointer; }
@keyframes slideIn { from { transform: translateX(100%); } to { transform: translateX(0); } }
    </style>
</head>

@php
    $firstName = auth()->check() ? explode(' ', auth()->user()->name ?? 'Admin')[0] : 'Admin';
@endphp

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
    <div class="reports-page-container">

        <section class="hero-card">
            <div>
                <span class="hero-badge">
                    <i class="fas fa-exclamation-triangle"></i> Live Reports
                </span>
                <h3>Real-time incident monitoring.</h3>
                <p>
                    Monitor incoming emergency reports, manage case statuses, and coordinate response teams in real-time. Every second counts.
                </p>
                <div class="hero-actions">
                    <button type="button" class="primary" onclick="window.location.reload()"><i class="fas fa-rotate"></i> Refresh</button>
                </div>
            </div>
            <div class="hero-kpis">
                <div class="hero-kpi-card">
                    <span>Total Reports</span>
                    <strong id="metricTotalReports">{{ $cases->total() ?? 0 }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Pending</span>
                    <strong id="metricPending">{{ $cases->where('status', 'PENDING')->count() ?? 0 }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Active</span>
                    <strong id="metricActive">{{ $cases->whereIn('status', ['ACKNOWLEDGED', 'ON_GOING'])->count() ?? 0 }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Resolved</span>
                    <strong id="metricResolved">{{ $cases->where('status', 'RESOLVED')->count() ?? 0 }}</strong>
                </div>
            </div>
        </section>

        <section class="insight-grid" id="reportsInsights">
            <article class="insight-card">
                <small>Today's Reports</small>
                <h4 id="metricToday">{{ $cases->filter(function($case) { return \Carbon\Carbon::parse($case->incident_datetime)->isToday(); })->count() }}</h4>
                <div class="insight-trend"><i class="fas fa-calendar-day" style="color: var(--accent);"></i><span>Last 24 hours</span></div>
            </article>
            <article class="insight-card">
                <small>High Priority</small>
                <h4 id="metricHighPriority">{{ $cases->whereIn('incident_type', ['Fire', 'Vehicular Accident'])->count() }}</h4>
                <div class="insight-trend"><i class="fas fa-fire" style="color: var(--danger);"></i><span>Critical incidents</span></div>
            </article>
            <article class="insight-card">
                <small>Medical Cases</small>
                <h4 id="metricMedical">{{ $cases->where('incident_type', 'Medical')->count() }}</h4>
                <div class="insight-trend"><i class="fas fa-heartbeat" style="color: var(--success);"></i><span>Health emergencies</span></div>
            </article>
            <article class="insight-card">
                <small>Response Rate</small>
                <h4 id="metricResponseRate">{{ $cases->total() > 0 ? round(($cases->whereIn('status', ['ACKNOWLEDGED', 'ON_GOING', 'RESOLVED'])->count() / $cases->total()) * 100) : 0 }}%</h4>
                <div class="insight-trend"><i class="fas fa-chart-line" style="color: var(--success);"></i><span>Active response</span></div>
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
                <label class="logs-field">
                    <span>Search</span>
                    <form action="{{ route('reported-cases') }}" method="GET" style="display:flex; gap:10px;">
                        <input type="text" name="search" placeholder="Search reporter, location, type..." value="{{ request('search') }}" class="logs-input">
                        <button type="submit" style="border:none; background:linear-gradient(135deg, #2563eb, #1d4ed8); color:white; padding:0.7rem 1.2rem; border-radius:14px; font-weight:700; cursor:pointer;"><i class="fas fa-search"></i></button>
                    </form>
                </label>
            </div>
        </section>

        <section class="table-card">
            <div class="table-card-header">
                <div>
                    <h4>Reported Cases</h4>
                    <div class="table-meta">
                        <span id="lastRefreshedLabel">Live data</span>
                        <span id="tableCountLabel">{{ $cases->total() }} total reports</span>
                    </div>
                </div>
                <div class="table-actions">
                    <button type="button" class="primary" onclick="window.location.reload()"><i class="fas fa-rotate"></i> Refresh</button>
                </div>
            </div>

            @if(session('success'))
                <div style="background-color: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; margin: 15px 20px; border-left: 4px solid #16a34a;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="background-color: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 8px; margin: 15px 20px; border-left: 4px solid #dc2626;">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            <div class="logs-table-wrapper">
                <table class="logs-table" id="reports-table">
                    <thead>
                        <tr>
                            <th>Reporter</th>
                            <th>Contact #</th>
                            <th>Type</th>
                            <th>Patient Status</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cases as $case)
                        <tr data-id="{{ $case->id }}" data-user-id="{{ $case->user_id }}">

                            @php
                                $images = $case->uploaded_media;
                                if (is_string($images)) {
                                    $images = str_replace(['{', '}', '"'], '', $images);
                                    $images = explode(',', $images);
                                }
                                $firstImage = is_array($images) && count($images) > 0 ? $images[0] : '';

                                // Determine status color
                                $status = $case->status ?? 'PENDING';
                                switch($status) {
                                    case 'PENDING':
                                        $statusColor = '#d97706';
                                        break;
                                    case 'ACKNOWLEDGED':
                                        $statusColor = '#2563eb';
                                        break;
                                    case 'ON_GOING':
                                        $statusColor = '#ca8a04';
                                        break;
                                    case 'RESOLVED':
                                        $statusColor = '#16a34a';
                                        break;
                                    case 'DECLINED':
                                        $statusColor = '#dc2626';
                                        break;
                                    default:
                                        $statusColor = '#64748b';
                                }

                                // Incident Type Colors
                                $incidentType = $case->incident_type ?? null;
                                switch($incidentType) {
                                    case 'Fire':
                                        $incidentColor = '#FF6B35';
                                        break;
                                    case 'Medical':
                                        $incidentColor = '#3B82F6';
                                        break;
                                    case 'Vehicular Accident':
                                        $incidentColor = '#FF4444';
                                        break;
                                    case 'Flood':
                                        $incidentColor = '#4A90E2';
                                        break;
                                    case 'Earthquake':
                                        $incidentColor = '#8B4513';
                                        break;
                                    case 'Electrical':
                                        $incidentColor = '#F59E0B';
                                        break;
                                    default:
                                        $incidentColor = '#64748b';
                                }

                                // Patient Status (AVPU) Colors
                                $patientStatus = $case->patient_status ?? null;
                                switch($patientStatus) {
                                    case 'Alert':
                                        $avpuColor = '#10B981';
                                        break;
                                    case 'Voice':
                                        $avpuColor = '#F59E0B';
                                        break;
                                    case 'Pain':
                                        $avpuColor = '#FF6B35';
                                        break;
                                    case 'Unresponsive':
                                        $avpuColor = '#EF4444';
                                        break;
                                    default:
                                        $avpuColor = '#334155';
                                }
                            @endphp

                            <td style="font-weight:bold; color:#0b2a55;">{{ $case->reporter_name ?? 'Guest/Unknown' }}</td>
                            <td>{{ $case->contact_number ?? '—' }}</td>
                            <td><span class="logs-pill" style="background-color:{{ $incidentColor }}; color:white;">{{ $case->incident_type ?? '—' }}</span></td>
                            <td>
                                <span class="logs-pill" style="background-color:{{ $avpuColor }}; color:white;">
                                    {{ $case->patient_status ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="address-cell" data-lat="{{ $case->latitude }}" data-lng="{{ $case->longitude }}" title="{{ $case->location }}">
                                {{ Str::limit($case->location, 30) }}
                            </td>
                            <td>
                                <span class="logs-pill" style="background-color: {{ $statusColor }}; color: white;">
                                    {{ ucfirst(strtolower(str_replace('_', ' ', $case->status ?? 'PENDING'))) }}
                                </span>
                            </td>
                            <td style="font-size:12px; color:#64748b;">{{ \Carbon\Carbon::parse($case->incident_datetime)->setTimezone('Asia/Manila')->format('M d, Y h:i A') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn action-btn-details" 
                                        title="See Details"
                                        onclick="openModal('{{ addslashes(json_encode($case)) }}', '{{ $firstImage }}')">
                                        <i class="fas fa-eye"></i> Details
                                    </button>

                                    <a href="{{ url('/admin/gps') }}?lat={{ $case->latitude }}&lng={{ $case->longitude }}&location={{ urlencode($case->location) }}&name={{ urlencode($case->reporter_name) }}&contact={{ urlencode($case->contact_number ?? '') }}" 
                                        class="action-btn action-btn-map" 
                                        title="Pin on Map">
                                        <i class="fas fa-map-marker-alt"></i> Map
                                    </a>

                                    @php $workflowStatus = $case->status ?? 'PENDING'; @endphp
                                    @if($workflowStatus === 'PENDING')
                                        <button type="button"
                                            class="action-btn action-btn-accept" 
                                            title="Accept Report"
                                            onclick="handleStatusAction('{{ $case->id }}', 'ACKNOWLEDGED')">
                                            <i class="fas fa-check"></i> Accept
                                        </button>
                                        <button type="button"
                                            class="action-btn action-btn-decline" 
                                            title="Decline Report"
                                            onclick="handleStatusAction('{{ $case->id }}', 'DECLINED')">
                                            <i class="fas fa-times"></i> Decline
                                        </button>
                                        
                                    @elseif($workflowStatus === 'ACKNOWLEDGED')
                                        <button type="button"
                                            class="action-btn action-btn-dispatch" 
                                            title="Dispatch Team"
                                            onclick="handleStatusAction('{{ $case->id }}', 'ON_GOING')">
                                            <i class="fas fa-paper-plane"></i> Dispatch
                                        </button>
                                        <button type="button"
                                            class="action-btn action-btn-decline" 
                                            title="Decline Report"
                                            onclick="handleStatusAction('{{ $case->id }}', 'DECLINED')">
                                            <i class="fas fa-times"></i> Decline
                                        </button>
                                    @elseif($workflowStatus === 'ON_GOING')
                                        <button type="button"
                                            class="action-btn action-btn-resolve" 
                                            title="Mark as Resolved"
                                            onclick="handleStatusAction('{{ $case->id }}', 'RESOLVED')">
                                            <i class="fas fa-check-circle"></i> Resolve
                                        </button>
                                    @elseif($workflowStatus === 'RESOLVED')
                                        <span class="action-btn-resolved">
                                            <i class="fas fa-check-circle"></i> Case Resolved!
                                        </span>
                                    @elseif($workflowStatus === 'DECLINED')
                                        <span class="action-btn-declined">
                                            <i class="fas fa-ban"></i> Report Declined
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align:center; padding:30px;">
                                <div class="logs-empty">
                                    <i class="fas fa-inbox"></i>
                                    <p>No reported cases found.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-bar">
                <div>
                    <strong>Tip:</strong> Click actions to manage case status.
                </div>
                <div>
                    {{ $cases->links() }}
                </div>
            </div>
        </section>

    </div>
</main>

<!-- Case Details Modal -->
<div id="caseModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h3><i class="fas fa-file-medical"></i> Incident Details</h3>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="detail-row"><span class="detail-label">Reporter</span><span class="detail-value" id="m_reporter"></span></div>
            <div class="detail-row"><span class="detail-label">Contact No.</span><span class="detail-value" id="m_contact_number"></span></div>
            <div class="detail-row"><span class="detail-label">Incident Type</span><span class="detail-value" id="m_type"></span></div>
            <div class="detail-row"><span class="detail-label">Patient Status</span><span class="detail-value" id="m_patient_status"></span></div>
            <div class="detail-row"><span class="detail-label">Status</span><span class="detail-value" id="m_status"></span></div>
            <div class="detail-row"><span class="detail-label">Location</span><span class="detail-value" id="m_location"></span></div>
            <div class="detail-row"><span class="detail-label">Description</span><span class="detail-value" id="m_description" style="font-style:italic;"></span></div>
            <div class="detail-row" style="border:none;"><span class="detail-label">Time Reported</span><span class="detail-value" id="m_time"></span></div>

            <div id="m_image_container" class="modal-image-container" style="display:none;">
                <div class="detail-label" style="width:100%; text-align:left; margin-bottom:5px;">Evidence Photo</div>
                <div id="m_image_gallery" class="image-gallery">
                    <button type="button" id="m_image_prev" class="gallery-nav" onclick="showPrevImage()">&#10094;</button>
                    <div class="gallery-main">
                        <a id="m_image_link" href="#" target="_blank">
                            <img id="m_image" class="modal-image" src="" alt="Evidence Photo">
                        </a>
                    </div>
                    <button type="button" id="m_image_next" class="gallery-nav" onclick="showNextImage()">&#10095;</button>
                </div>
                <div id="m_thumbnails" class="thumbnail-row"></div>
            </div>
        </div>
        <div class="modal-actions">
            <button onclick="printReportDetails()" style="padding:10px 18px; border-radius:8px; background:#0b2a55; color:white; font-weight:600; border:none; cursor:pointer; margin-right:auto;">
                <i class="fas fa-print"></i> Print
            </button>
            <button onclick="closeModal()" style="padding:10px 18px; border:1px solid #cbd5e1; border-radius:8px; background:#64748b; color:white; font-weight:600; cursor:pointer;">Close</button>
        </div>
    </div>
</div>

<!-- Status Confirmation Modal -->
<div id="statusConfirmModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Confirm Action</h3>
            <button class="modal-close" onclick="closeStatusConfirmModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p id="statusConfirmMessage" style="margin: 0; color: #334155; font-weight: 500;"></p>
        </div>
        <div class="modal-actions">
            <button onclick="closeStatusConfirmModal()" style="padding:10px 18px; border-radius:8px; background:white; color:#0f172a; font-weight:600; border:1px solid #cbd5e1; cursor:pointer;">Cancel</button>
            <button onclick="performStatusUpdate()" style="padding:10px 18px; border-radius:8px; background:#0b2a55; color:white; font-weight:600; border:none; cursor:pointer;">Yes, Continue</button>
        </div>
    </div>
</div>

<!-- Status Error Modal -->
<div id="statusErrorModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header" style="background:#dc2626;">
            <h3>Status Update Failed</h3>
            <button class="modal-close" onclick="closeStatusErrorModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p id="statusErrorMessage" style="margin: 0; color: #b91c1c; font-weight: 500;"></p>
        </div>
        <div class="modal-actions">
            <button onclick="closeStatusErrorModal()" style="padding:10px 18px; border-radius:8px; background:#dc2626; color:white; font-weight:600; border:none; cursor:pointer;">Close</button>
        </div>
    </div>
</div>

<div id="liveStatus">CONNECTING...</div>

<!-- Notification Bell Container -->
<div class="notif-bell-container">
    <div class="notif-panel" id="notifPanel">
        <div class="notif-header">
            <span>Notifications</span>
            <a href="#" onclick="clearBadge()" style="font-size:12px; color:#3b82f6;">Mark read</a>
        </div>
        <div class="notif-list" id="notifList">
            <div style="padding:20px; text-align:center; color:#94a3b8;">No notifications</div>
        </div>
    </div>
    <div class="notif-bell" onclick="toggleNotif()">
        <i class="fas fa-bell"></i>
        <span class="notif-badge" id="notifBadge">0</span>
    </div>
</div>

<!-- Global Toast Container -->
<div id="global-toast-container"></div>

<!-- Audio Element for Notifications -->
<audio id="globalSound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>

<script>
    let currentReportId = null;
    let modalMediaList = [];
    let modalMediaIndex = 0;
    let pendingStatusReportId = null;
    let pendingStatusNewStatus = null;

    // Status Action Handler
    function openStatusConfirmModal(message, reportId, newStatus) {
        pendingStatusReportId = reportId;
        pendingStatusNewStatus = newStatus;

        const messageEl = document.getElementById('statusConfirmMessage');
        if (messageEl) {
            messageEl.textContent = message;
        }

        const modal = document.getElementById('statusConfirmModal');
        if (modal) {
            const header = modal.querySelector('.modal-header');
            if (header) {
                let bgColor = '#0b2a55';
                if (newStatus === 'ACKNOWLEDGED') bgColor = '#22c55e';
                else if (newStatus === 'ON_GOING') bgColor = '#2563eb';
                else if (newStatus === 'DECLINED') bgColor = '#dc2626';
                else if (newStatus === 'RESOLVED') bgColor = '#16a34a';
                header.style.background = bgColor;
            }
            modal.style.display = 'flex';
        }
    }

    function closeStatusConfirmModal() {
        const modal = document.getElementById('statusConfirmModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    function showStatusError(message) {
        const messageEl = document.getElementById('statusErrorMessage');
        if (messageEl) {
            messageEl.textContent = message;
        }
        const modal = document.getElementById('statusErrorModal');
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    function closeStatusErrorModal() {
        const modal = document.getElementById('statusErrorModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    async function handleStatusAction(reportId, newStatus) {
        let confirmMessage;
        if (newStatus === 'ACKNOWLEDGED') {
            confirmMessage = 'Are you sure you want to ACCEPT this report?';
        } else if (newStatus === 'ON_GOING') {
            confirmMessage = 'Are you sure you want to DISPATCH a team for this report?';
        } else if (newStatus === 'DECLINED') {
            confirmMessage = 'Decline this report? This will mark it as acknowledged and it cannot be changed afterwards.';
        } else if (newStatus === 'RESOLVED') {
            confirmMessage = 'Mark this report as RESOLVED? This cannot be changed afterwards.';
        } else {
            confirmMessage = 'Apply this status change?';
        }

        openStatusConfirmModal(confirmMessage, reportId, newStatus);
    }

    async function performStatusUpdate() {
        const reportId = pendingStatusReportId;
        const newStatus = pendingStatusNewStatus;

        if (!reportId || !newStatus) {
            closeStatusConfirmModal();
            return;
        }

        const row = document.querySelector(`tr[data-id="${reportId}"]`);
        if (!row) {
            closeStatusConfirmModal();
            return;
        }

        closeStatusConfirmModal();

        try {
            const response = await fetch(`/admin/reports/${reportId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ status: newStatus }),
            });

            if (!response.ok) {
                const text = await response.text();
                console.error('Status update failed:', text);
                showStatusError('Failed to update status. Please refresh and try again.');
                return;
            }

            if (newStatus === 'ACKNOWLEDGED') {
                const userId = row.getAttribute('data-user-id');
                if (userId) {
                    try {
                        await fetch('/api/send-push', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({ user_id: userId, report_id: reportId }),
                        });
                    } catch (err) {
                        console.error('Push notification failed:', err);
                    }
                }
            }

            window.location.reload();
        } catch (error) {
            console.error('Error updating report status:', error);
            showStatusError('An unexpected error occurred while updating status.');
        }
    }

    // Address Processing
    document.addEventListener("DOMContentLoaded", function() {
        processAddressCells(document.querySelectorAll('.address-cell'));

        const statusBadge = document.getElementById("liveStatus");
        window.addEventListener("online", () => { statusBadge.innerText = "ONLINE"; statusBadge.style.background = "green"; });
        window.addEventListener("offline", () => { statusBadge.innerText = "OFFLINE"; statusBadge.style.background = "red"; });
    });

    async function processAddressCells(cells) {
        for (const cell of cells) {
            if (cell.dataset.processed) continue;

            const lat = cell.getAttribute('data-lat');
            const lng = cell.getAttribute('data-lng');
            const currentText = cell.innerText.trim();
            const isCoordinates = /^-?\d+(\.\d+)?(,\s*-?\d+(\.\d+)?)$/.test(currentText);

            if (lat && lng && isCoordinates) {
                try {
                    cell.innerHTML = '<span class="loading-text">Loading...</span>';
                    const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;
                    const response = await fetch(url);
                    const data = await response.json();
                    if (data && (data.display_name || data.address)) { cell.innerText = data.display_name; } 
                    else { cell.innerText = currentText; }
                } catch (error) {
                    cell.innerText = currentText;
                }
                cell.dataset.processed = "true";
                await new Promise(r => setTimeout(r, 800)); 
            }
        }
    }

    // Modal Logic
    async function openModal(caseJson, firstImage) {
        const data = typeof caseJson === 'string' ? JSON.parse(caseJson) : caseJson;

        currentReportId = data.id || null;

        document.getElementById('m_reporter').innerText = data.reporter_name || 'Guest';
        document.getElementById('m_contact_number').innerText = data.contact_number || 'N/A';

        const incidentTypeEl = document.getElementById('m_type');
        const incidentType = data.incident_type || 'N/A';
        const incidentColor = {
            'Fire': '#FF6B35',
            'Medical': '#3B82F6',
            'Vehicular Accident': '#FF4444',
            'Flood': '#4A90E2',
            'Earthquake': '#8B4513',
            'Electrical': '#F59E0B'
        }[incidentType] || '#64748b';
        incidentTypeEl.innerHTML = `<span style="background-color:${incidentColor}; color:white; padding:3px 7px; border-radius:6px; font-size:13px; font-weight:600;">${incidentType}</span>`;

        const patientStatusEl = document.getElementById('m_patient_status');
        const patientStatus = data.patient_status || 'N/A';
        const avpuColor = {
            'Alert': '#10B981',
            'Voice': '#F59E0B',
            'Pain': '#FF6B35',
            'Unresponsive': '#EF4444'
        }[patientStatus] || '#64748b';
        patientStatusEl.innerHTML = `<span style="background-color:${avpuColor}; color:white; padding:3px 7px; border-radius:6px; font-size:13px; font-weight:600;">${patientStatus}</span>`;

        document.getElementById('m_status').innerText = data.status || 'Pending';
        document.getElementById('m_description').innerText = data.description || 'No description.';

        const dateObj = new Date(data.incident_datetime || data.created_at);
        document.getElementById('m_time').innerText = dateObj.toLocaleString();

        const locationEl = document.getElementById('m_location');
        locationEl.innerText = data.location || `${data.latitude}, ${data.longitude}`;

        if (data.latitude && data.longitude) {
            try {
                const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${data.latitude}&lon=${data.longitude}`;
                const response = await fetch(url);
                const geoData = await response.json();
                if(geoData.display_name) locationEl.innerText = geoData.display_name;
            } catch (e) { console.warn("Modal Address Failed"); }
        }

        modalMediaList = [];
        if (data.uploaded_media) {
            modalMediaList = parseMediaValue(data.uploaded_media);
        }
        if ((!modalMediaList || modalMediaList.length === 0) && firstImage) {
            modalMediaList = parseMediaValue(firstImage);
        }
        modalMediaIndex = 0;
        updateModalImage();

        document.getElementById('caseModal').style.display = 'flex';
    }

    function parseMediaValue(value) {
        if (!value) return [];
        if (Array.isArray(value)) {
            return value.filter(function (item) { return !!item; });
        }
        let str = String(value).trim();
        if (!str) return [];
        try {
            const parsed = JSON.parse(str);
            if (Array.isArray(parsed)) {
                return parsed.filter(function (item) { return !!item; });
            }
            if (typeof parsed === 'string') {
                str = parsed.trim();
            }
        } catch (e) {}
        str = str.replace(/^[{\[]/, '').replace(/[}\]]$/, '');
        str = str.replace(/"/g, '');
        const parts = str.split(',').map(function (item) {
            return item.trim();
        }).filter(function (item) {
            return item.length > 0;
        });
        return parts;
    }

    function updateModalImage() {
        const imgContainer = document.getElementById('m_image_container');
        const img = document.getElementById('m_image');
        const link = document.getElementById('m_image_link');
        const thumbs = document.getElementById('m_thumbnails');
        const prevBtn = document.getElementById('m_image_prev');
        const nextBtn = document.getElementById('m_image_next');

        if (!imgContainer || !img || !link) {
            return;
        }

        if (!modalMediaList || modalMediaList.length === 0) {
            imgContainer.style.display = 'none';
            img.src = '';
            link.href = '#';
            if (thumbs) {
                thumbs.innerHTML = '';
            }
            if (prevBtn) prevBtn.disabled = true;
            if (nextBtn) nextBtn.disabled = true;
            return;
        }

        if (modalMediaIndex < 0) {
            modalMediaIndex = 0;
        }
        if (modalMediaIndex >= modalMediaList.length) {
            modalMediaIndex = modalMediaList.length - 1;
        }

        const rawUrl = modalMediaList[modalMediaIndex];
        if (!rawUrl) {
            imgContainer.style.display = 'none';
            return;
        }
        const mediaUrl = String(rawUrl).replace(/^{|}$/g, '').replace(/"/g, '').trim();

        img.src = mediaUrl;
        link.href = mediaUrl;
        imgContainer.style.display = 'block';

        if (thumbs) {
            thumbs.innerHTML = '';
            if (modalMediaList.length > 1) {
                for (let i = 0; i < modalMediaList.length; i++) {
                    const thumbRaw = modalMediaList[i];
                    const thumbUrl = String(thumbRaw).replace(/^{|}$/g, '').replace(/"/g, '').trim();
                    if (!thumbUrl) {
                        continue;
                    }
                    const thumb = document.createElement('img');
                    thumb.src = thumbUrl;
                    thumb.className = 'thumbnail-image' + (i === modalMediaIndex ? ' active' : '');
                    (function (index) {
                        thumb.addEventListener('click', function () {
                            modalMediaIndex = index;
                            updateModalImage();
                        });
                    })(i);
                    thumbs.appendChild(thumb);
                }
            }
        }

        if (prevBtn) {
            prevBtn.disabled = modalMediaList.length <= 1;
        }
        if (nextBtn) {
            nextBtn.disabled = modalMediaList.length <= 1;
        }
    }

    function showPrevImage() {
        if (!modalMediaList || modalMediaList.length === 0) return;
        modalMediaIndex = (modalMediaIndex - 1 + modalMediaList.length) % modalMediaList.length;
        updateModalImage();
    }

    function showNextImage() {
        if (!modalMediaList || modalMediaList.length === 0) return;
        modalMediaIndex = (modalMediaIndex + 1) % modalMediaList.length;
        updateModalImage();
    }

    function closeModal() {
        document.getElementById('caseModal').style.display = 'none';
        currentReportId = null;
    }

    function printReportDetails() {
        const reporterName = document.getElementById('m_reporter').innerText;
        const contactNumber = document.getElementById('m_contact_number').innerText;
        const incidentType = document.getElementById('m_type').innerText;
        const patientStatus = document.getElementById('m_patient_status').innerText;
        const status = document.getElementById('m_status').innerText;
        const location = document.getElementById('m_location').innerText;
        const description = document.getElementById('m_description').innerText;
        const timeReported = document.getElementById('m_time').innerText;
        const imageElement = document.getElementById('m_image');

        let imagesHtml = '';

        if (modalMediaList && modalMediaList.length > 0) {
            imagesHtml += '<div class="print-section">';
            imagesHtml += '<div class="print-label" style="width:100%; text-align:left; margin-bottom:5px;">Evidence Photos</div>';
            for (let i = 0; i < modalMediaList.length; i++) {
                const rawUrl = modalMediaList[i];
                if (!rawUrl) continue;
                const mediaUrl = String(rawUrl).replace(/^{|}$/g, '').replace(/"/g, '').trim();
                if (!mediaUrl) continue;

                const isFirst = i === 0;
                const isLast = i === modalMediaList.length - 1;
                let wrapperStyle = 'text-align:center; margin-top:' + (isFirst ? '100px' : '100px') + '; page-break-inside: avoid;';
                if (!isLast) {
                    wrapperStyle += ' page-break-after: always; break-after: page;';
                }

                const imgStyleAttr = isFirst ? ' style="max-height:260px;"' : '';

                imagesHtml += '<div class="print-image-wrapper" style="' + wrapperStyle + '">';
                imagesHtml += '<div class="print-image-label" style="font-weight:600; margin-bottom:6px; color:#0b2a55;">Photo ' + (i + 1) + '</div>';
                imagesHtml += '<img src="' + mediaUrl + '" class="print-image" alt="Evidence Photo ' + (i + 1) + '"' + imgStyleAttr + ' />';
                imagesHtml += '</div>';
            }
            imagesHtml += '</div>';
        } else if (imageElement && imageElement.src) {
            imagesHtml += '<div class="print-section">';
            imagesHtml += '<div class="print-image-wrapper" style="text-align:center; margin-top:15px;">';
            imagesHtml += '<div class="print-image-label" style="font-weight:600; margin-bottom:8px; color: blue;">Evidence Photo</div>';
            imagesHtml += '<img src="' + imageElement.src + '" class="print-image" alt="Evidence Photo" style="display:inline-block;" />';
            imagesHtml += '</div>';
            imagesHtml += '</div>';
        }

        let printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(`
            <html>
            <head>
                <title style="text-align: right">Report Details</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; background: white; }
                    .print-header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #0b2a55; padding-bottom: 15px; }
                    .print-header h1 { color: #0b2a55; margin: 0; }
                    .print-section { margin-bottom: 15px; }
                    .print-label { font-weight: bold; color: #0b2a55; }
                    .print-value { color: #334155; margin-top: 5px; }
                    .print-image { max-width: 400px; margin-top: 10px; border: 1px solid #ddd; }
                </style>
            </head>
            <body>
                <div class="print-header">
                    <h1>Incident Report Details</h1>
                </div>
                <div>
                <table class="print-table" style="width:100%; margin-bottom:20px; border-collapse:collapse;">
                    <tr>
                        <th style="color: blue;">Reporter: </th>
                        <td style="text-decoration: underline;"> ${reporterName}</td>

                        <th style="color: blue;">Contact No.: </th>
                        <td style="text-decoration: underline;"> ${contactNumber}</td>

                        <th style="color: blue;">Incident Type: </th>
                        <td style="text-decoration: underline;"> ${incidentType}</td>
                    </tr>
                </table>
                </div>
                <div>
                <table class="print-table" style="margin-bottom:20px;">
                    <tr>
                        <th style="color: blue;">Patient Status: </th>
                        <td>${patientStatus}</td>
                        <th style="color: blue;">Status: </th>
                        <td>${status}</td>
                    </tr>
                </table>
                </div>
                <div>
                <table class="print-table" style="margin-bottom:20px;">
                    <tr>
                        <th style="color: blue;">Description: </th>
                        <td>${description}</td>
                    </tr>
                </table>
                </div>
                <div>
                <table class="print-table" style="margin-bottom:20px;">
                    <tr>
                        <th style="color: blue;">Location: </th>
                        <td>${location}</td>
                    </tr>
                </table>
                </div>
                <table class="print-table" style="margin-bottom:20px;">
                    <tr>
                        <th style="color: blue;">Time Reported: </th>
                        <td>${timeReported}</td>
                    </tr>
                </table>
                </div>
                ${imagesHtml}
                <script>
                    window.print();
                    window.close();
                <\/script>
            </body>
            </html>
        `);
        printWindow.document.close();
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('caseModal')) closeModal();
        if (event.target == document.getElementById('statusConfirmModal')) closeStatusConfirmModal();
        if (event.target == document.getElementById('statusErrorModal')) closeStatusErrorModal();
    };

    // Realtime updates
    document.addEventListener("DOMContentLoaded", () => {
        const tableBody = document.querySelector("#reports-table tbody");
        const notifySound = new Audio("https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3");
        notifySound.loop = true;

        const supabaseClient = window.supabaseClient || null;
        if (!supabaseClient) {
            const el = document.getElementById("liveStatus");
            if (el) {
                el.innerText = "REALTIME DISCONNECTED";
                el.style.background = "gray";
            }
            return;
        }

        supabaseClient
            .channel("reports-live")
            .on(
                "postgres_changes",
                { event: "INSERT", schema: "public", table: "reports" },
                async (payload) => {
                    const report = payload.new;
                    const row = addNewRow(report);

                    if (report.user_id) {
                        try {
                            const { data: user, error } = await supabaseClient.rpc("get_reporter_info", { uid: report.user_id });

                            if (!error && user && user.length > 0) {
                                report.reporter_name = user[0].name || "Guest";
                                report.contact_number = user[0].contact_number || "—";
                            } else {
                                report.reporter_name = "Guest";
                                report.contact_number = "—";
                            }
                        } catch (err) {
                            report.reporter_name = "Guest";
                            report.contact_number = "—";
                            console.error("Error fetching user via RPC:", err);
                        }
                    }

                    if (row) {
                        row.querySelector("td:nth-child(1)").innerText = report.reporter_name;
                        row.querySelector("td:nth-child(2)").innerText = report.contact_number;

                        const reportJson = encodeURIComponent(JSON.stringify(report));
                        const detailsBtn = row.querySelector(".action-btn-details");
                        if (detailsBtn) {
                            detailsBtn.setAttribute("onclick", `openModal(decodeURIComponent('${reportJson}'), '')`);
                        }
                    }

                    notifySound.play().catch(() => {});
                }
            )
            .subscribe((status) => {
                const el = document.getElementById("liveStatus");
                if (status === "SUBSCRIBED") {
                    el.innerText = "LIVE CONNECTED";
                    el.style.background = "green";
                }
            });
    });

    function addNewRow(report) {
        if (document.querySelector(`tr[data-id="${report.id}"]`)) return null;

        const row = document.createElement("tr");
        row.setAttribute("data-id", report.id);
        if (report.user_id) {
            row.setAttribute("data-user-id", report.user_id);
        }
        row.style.animation = "highlightNew 2s ease-out";

        const dateStr = new Date(report.incident_datetime || report.created_at).toLocaleString();
        const status = report.status || 'PENDING';

        let statusColor;
        switch (status) {
            case 'PENDING': statusColor = '#d97706'; break;
            case 'ACKNOWLEDGED': statusColor = '#2563eb'; break;
            case 'ON_GOING': statusColor = '#ca8a04'; break;
            case 'RESOLVED': statusColor = '#16a34a'; break;
            case 'DECLINED': statusColor = '#dc2626'; break;
            default: statusColor = '#64748b';
        }

        const incidentType = report.incident_type || 'N/A';
        const incidentColor = {
            'Fire': '#FF6B35',
            'Medical': '#3B82F6',
            'Vehicular Accident': '#FF4444',
            'Flood': '#4A90E2',
            'Earthquake': '#8B4513',
            'Electrical': '#F59E0B'
        }[incidentType] || '#64748b';

        const patientStatus = report.patient_status || 'N/A';
        const avpuColor = {
            'Alert': '#10B981',
            'Voice': '#F59E0B',
            'Pain': '#FF6B35',
            'Unresponsive': '#EF4444'
        }[patientStatus] || '#334155';

        const reportJson = encodeURIComponent(JSON.stringify(report));
        const reporterName = (report.reporter_name || 'Guest/Unknown').replace(/"/g, '&quot;');
        const contactNumber = (report.contact_number || '').replace(/"/g, '&quot;');
        const location = (report.location || '').replace(/"/g, '&quot;');
        const encodedName = encodeURIComponent(reporterName);
        const encodedContact = encodeURIComponent(contactNumber);
        const encodedLocation = encodeURIComponent(location);
        
        let actionsHtml = `
            <button class="action-btn action-btn-details" onclick="openModal(decodeURIComponent('${reportJson}'), '')"><i class="fas fa-eye"></i> Details</button>
            <a href="/admin/gps?lat=${report.latitude}&lng=${report.longitude}&location=${encodedLocation}&name=${encodedName}&contact=${encodedContact}" class="action-btn action-btn-map"><i class="fas fa-map-marker-alt"></i> Map</a>
        `;

        if (status === 'PENDING') {
            actionsHtml += `<button type="button" class="action-btn action-btn-accept" onclick="handleStatusAction('${report.id}', 'ACKNOWLEDGED')"><i class="fas fa-check"></i> Accept</button>`;
            actionsHtml += `<button type="button" class="action-btn action-btn-decline" onclick="handleStatusAction('${report.id}', 'DECLINED')"><i class="fas fa-times"></i> Decline</button>`;
        } else if (status === 'ACKNOWLEDGED') {
            actionsHtml += `<button type="button" class="action-btn action-btn-dispatch" onclick="handleStatusAction('${report.id}', 'ON_GOING')"><i class="fas fa-paper-plane"></i> Dispatch</button>`;
            actionsHtml += `<button type="button" class="action-btn action-btn-decline" onclick="handleStatusAction('${report.id}', 'DECLINED')"><i class="fas fa-times"></i> Decline</button>`;
        } else if (status === 'ON_GOING') {
            actionsHtml += `<button type="button" class="action-btn action-btn-resolve" onclick="handleStatusAction('${report.id}', 'RESOLVED')"><i class="fas fa-check-circle"></i> Resolve</button>`;
        } else if (status === 'RESOLVED') {
            actionsHtml += `<span class="action-btn-resolved"><i class="fas fa-check-circle"></i> Case Resolved!</span>`;
        } else if (status === 'DECLINED') {
            actionsHtml += `<span class="action-btn-declined"><i class="fas fa-ban"></i> Report Declined</span>`;
        }

        row.innerHTML = `
            <td style="font-weight:bold; color:#0b2a55;">${report.reporter_name || "Loading..."}</td>
            <td>${report.contact_number || "Loading..."}</td>
            <td><span class="logs-pill" style="background-color:${incidentColor}; color:white;">${incidentType}</span></td>
            <td><span class="logs-pill" style="background-color:${avpuColor}; color:white;">${patientStatus}</span></td>
            <td class="address-cell" data-lat="${report.latitude}" data-lng="${report.longitude}">${report.location || "Locating..."}</td>
            <td><span class="logs-pill" style="background-color: ${statusColor}; color: white;">${status === 'DECLINED' ? 'RECORDED' : (status || 'PENDING').replace('_', ' ')}</span></td>
            <td style="font-size:12px; color:#64748b;">${dateStr}</td>
            <td>
                <div class="action-buttons">
                    ${actionsHtml}
                </div>
            </td>
        `;

        const tableBody = document.querySelector("#reports-table tbody");
        if (tableBody) {
            tableBody.prepend(row);
            processAddressCells([row.querySelector(".address-cell")]);
        }

        return row;
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
    });

    // ===== NOTIFICATION BELL FUNCTIONALITY (from app.blade.php) =====
    // SINGLE Supabase client (avoid multiple instances)
    let supabaseClient = window.supabaseClient || null;
    if (!supabaseClient && typeof supabase !== 'undefined') {
        const SUPABASE_URL = "https://bhcecrbyknorjzkjazxu.supabase.co";
        const SUPABASE_KEY = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJoY2VjcmJ5a25vcmp6a2phenh1Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTkyMDYwNDMsImV4cCI6MjA3NDc4MjA0M30.Nfv0vHVk1IyN1gz1Y4mdogL9ChsV0DkiMQivuYnolt4";
        supabaseClient = supabase.createClient(SUPABASE_URL, SUPABASE_KEY);
        window.supabaseClient = supabaseClient;
    }

    let unread = 0;

    // Real-time listener for notifications
    if (supabaseClient) {
        const reportsChannel = supabaseClient
            .channel('public:reports')
            .on(
                'postgres_changes',
                { event: 'INSERT', schema: 'public', table: 'reports' },
                (payload) => {
                    const data = payload.new;

                    // Play sound
                    const audio = document.getElementById('globalSound');
                    if (audio) {
                        audio.loop = true;
                        audio.playbackRate = 1.5;
                        audio.play().catch(() => console.log('Autoplay prevented'));
                    }

                    // Show toast
                    const toast = document.createElement('div');
                    toast.className = 'global-toast';
                    toast.innerHTML = `
                        <div style="font-size:20px; color:#ef4444;"><i class="fas fa-exclamation-circle"></i></div>
                        <div>
                            <div style="font-weight:800; color:#1e293b;">New Incident!</div>
                            <div style="font-size:13px; color:#64748b;">${data.incident_type} at ${data.location || 'Unknown'}</div>
                        </div>
                    `;
                    toast.onclick = () => window.location.href = "{{ route('reported-cases') }}";
                    document.getElementById('global-toast-container').appendChild(toast);
                    setTimeout(() => toast.remove(), 10000);

                    // Update bell badge
                    unread++;
                    const badge = document.getElementById('notifBadge');
                    if (badge) {
                        badge.innerText = unread;
                        badge.style.display = 'block';
                    }

                    // Add to notification list
                    const item = document.createElement('div');
                    item.className = 'notif-item new';
                    item.innerHTML = `
                        <div class="icon-box"><i class="fas fa-fire"></i></div>
                        <div>
                            <div style="font-weight:700; font-size:14px;">${data.incident_type}</div>
                            <div style="font-size:12px; color:#64748b;">${data.location}</div>
                        </div>
                    `;
                    item.onclick = () => window.location.href = "{{ route('reported-cases') }}";
                    const list = document.getElementById('notifList');
                    if (list && list.children[0]?.innerText.includes('No notifications')) {
                        list.innerHTML = '';
                    }
                    if (list) {
                        list.prepend(item);
                    }

                    // Dispatch custom event for other scripts if needed
                    window.dispatchEvent(new CustomEvent('new-incident-reported', { detail: data }));
                }
            )
            .subscribe();
    }

    function toggleNotif() {
        const panel = document.getElementById('notifPanel');
        if (panel) {
            panel.classList.toggle('active');
        }
    }

    function clearBadge() {
        unread = 0;
        const badge = document.getElementById('notifBadge');
        if (badge) {
            badge.style.display = 'none';
        }
        const audio = document.getElementById('globalSound');
        if (audio) {
            audio.pause();
            audio.currentTime = 0;
            audio.loop = false;
        }
    }
    // ===== END NOTIFICATION BELL FUNCTIONALITY =====
</script>

</body>
</html>
