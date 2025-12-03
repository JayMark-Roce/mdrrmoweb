<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create & Manage - MDRRMO</title>
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
    margin-bottom: 2rem;
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

.tab-navigation {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    background: #f8fafc;
    padding: 0.5rem;
    border-radius: 16px;
    border: 1px solid rgba(226, 232, 240, 0.8);
}

.tab-btn {
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
    background: transparent;
    color: var(--muted);
    position: relative;
}

.tab-btn:hover {
    background: rgba(37, 99, 235, 0.08);
    color: var(--accent);
}

.tab-btn.active {
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #ffffff;
    box-shadow: 0 15px 35px rgba(124, 58, 237, 0.35);
}

.panel-content {
    display: none;
    animation: fadeIn 0.4s ease-in;
}

.panel-content.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
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

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.25rem;
}

.form-field {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-field label {
    font-size: 0.85rem;
    text-transform: uppercase;
    font-weight: 800;
    letter-spacing: 0.06em;
    color: var(--muted);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-field input,
.form-field select,
.form-field textarea {
    border-radius: 14px;
    border: 1.5px solid rgba(148, 163, 184, 0.5);
    padding: 0.7rem 0.85rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--heading);
    background: #f8fafc;
    transition: all 0.2s ease;
    font-family: inherit;
}

.form-field input:focus,
.form-field select:focus,
.form-field textarea:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    background: #ffffff;
}

.form-field textarea {
    resize: vertical;
    min-height: 100px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(226, 232, 240, 0.8);
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

.btn-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #ffffff;
    box-shadow: 0 15px 35px rgba(245, 158, 11, 0.35);
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px rgba(245, 158, 11, 0.4);
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

.status-badge.available {
    background: rgba(16, 185, 129, 0.15);
    color: #059669;
}

.status-badge.out {
    background: rgba(245, 158, 11, 0.15);
    color: #d97706;
}

.status-badge.unavailable {
    background: rgba(239, 68, 68, 0.15);
    color: #dc2626;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
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
}

.action-btn.edit {
    background: rgba(245, 158, 11, 0.15);
    color: #d97706;
}

.action-btn.edit:hover {
    background: rgba(245, 158, 11, 0.25);
}

.action-btn.delete {
    background: rgba(239, 68, 68, 0.15);
    color: #dc2626;
}

.action-btn.delete:hover {
    background: rgba(239, 68, 68, 0.25);
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

.grid-view {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.25rem;
}

.grid-item {
    background: #f8fafc;
    border: 2px solid rgba(226, 232, 240, 0.8);
    border-radius: 16px;
    padding: 1.25rem;
    transition: all 0.3s ease;
}

.grid-item:hover {
    border-color: var(--accent);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.grid-item h5 {
    margin: 0 0 0.75rem 0;
    color: var(--heading);
    font-size: 1.1rem;
    font-weight: 800;
}

.step-indicator {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
}

.step {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(148, 163, 184, 0.5);
    transition: all 0.3s ease;
}

.step.active {
    background: var(--accent);
    width: 32px;
    border-radius: 6px;
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

.modal-card--danger .modal-card__header {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.modal-card--info .modal-card__header {
    background: linear-gradient(135deg, #0ea5e9, #2563eb);
}

.modal-card__body .status-note {
    margin-top: 0.35rem;
    font-size: 0.85rem;
    color: #94a3b8;
}

.modal-card form {
    margin: 0;
}

.modal-card form .form-grid {
    margin-bottom: 0.5rem;
}

.modal-card form .form-field label {
    font-size: 0.8rem;
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

    .form-grid {
        grid-template-columns: 1fr;
    }

    .tab-navigation {
        flex-direction: column;
    }

    .tab-btn {
        width: 100%;
        justify-content: center;
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
                    <h3><i class="fas fa-plus-circle"></i> Create & Manage Resources</h3>
                    <p>Register new users, manage medics, drivers, and ambulance units for your emergency response team.</p>
                </div>
            </div>
            
            <!-- Tab Navigation -->
            <div class="tab-navigation">
                <button class="tab-btn active" onclick="showPanel('register')" id="register-tab">
                    <i class="fas fa-user-plus"></i>
                    <span>Register User</span>
                </button>
                <button class="tab-btn" onclick="showPanel('medic')" id="medic-tab">
                    <i class="fas fa-user-md"></i>
                    <span>Medics</span>
                </button>
                <button class="tab-btn" onclick="showPanel('ambulance')" id="ambulance-tab">
                    <i class="fas fa-ambulance"></i>
                    <span>Ambulances</span>
                </button>
                <button class="tab-btn" onclick="showPanel('driver')" id="driver-tab">
                    <i class="fas fa-car"></i>
                    <span>Drivers</span>
                </button>
            </div>
        </section>

        <!-- Register Panel -->
        <div id="register-panel" class="panel-content active">
            <div class="content-card">
                <div class="card-header">
                    <h4><i class="fas fa-user-plus"></i> Register New User</h4>
                </div>
                <form method="POST" action="{{ route('register') }}" class="register-form">
                    @csrf
                    <div class="form-grid">
                        <div class="form-field">
                            <label for="name"><i class="fas fa-user"></i> Full Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter full name">
                        </div>
                        <div class="form-field">
                            <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Enter email address">
                        </div>
                        <div class="form-field">
                            <label for="password"><i class="fas fa-lock"></i> Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Enter password">
                        </div>
                        <div class="form-field">
                            <label for="password_confirmation"><i class="fas fa-lock"></i> Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm password">
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('login') }}" class="btn btn-secondary">
                            <i class="fas fa-sign-in-alt"></i> Already registered?
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Register
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Medic Panel -->
        <div id="medic-panel" class="panel-content">
            <div class="content-card">
                <div class="card-header">
                    <h4><i class="fas fa-user-md"></i> Medics Management</h4>
                    <a href="{{ route('admin.medics.archived') }}" class="btn btn-secondary">
                        <i class="fas fa-box-archive"></i> View Archived
                    </a>
                </div>

                <div style="margin-bottom: 2rem;">
                    <h5 style="margin: 0 0 1rem 0; font-size: 1.1rem; font-weight: 800; color: var(--heading);">
                        <i class="fas fa-plus-circle"></i> Add New Medic
                    </h5>
                    <form action="{{ route('admin.medics.store') }}" method="POST" style="background: #f8fafc; padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(226, 232, 240, 0.8);">
                        @csrf
                        
                        @if($errors->any())
                            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem;">
                                <div style="font-weight: 800; margin-bottom: 0.5rem;">Validation Errors:</div>
                                <ul style="margin: 0; padding-left: 1.5rem;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="form-grid">
                            <div class="form-field">
                                <label><i class="fas fa-user"></i> Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter medic name">
                            </div>
                            <div class="form-field">
                                <label><i class="fas fa-phone"></i> Phone</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number">
                            </div>
                            <div class="form-field">
                                <label><i class="fas fa-stethoscope"></i> Specialization</label>
                                <input type="text" name="specialization" value="{{ old('specialization') }}" placeholder="Enter specialization">
                            </div>
                            <div class="form-field">
                                <label><i class="fas fa-toggle-on"></i> Status</label>
                                <select name="status" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(226, 232, 240, 0.8);">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add Medic
                            </button>
                        </div>
                    </form>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                        <h5 style="margin: 0; font-size: 1.1rem; font-weight: 800; color: var(--heading);">
                            <i class="fas fa-list"></i> Existing Medics
                        </h5>
                        <div class="search-container" style="margin: 0; flex: 1; max-width: 400px;">
                            <input type="text" id="medicSearchInput" class="search-input" placeholder="Search by name, phone, or specialization...">
                            <button type="button" id="clearMedicSearch" class="btn btn-secondary" style="display: none;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="table-wrapper">
                    <table class="data-table" data-paginate="true" data-page-size="10">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Specialization</th>
                                <th>Status</th>
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
                                    <td class="action-buttons">
                                        <button onclick="openEditModal({{ $medic->id }}, '{{ $medic->name }}', '{{ $medic->phone }}', '{{ $medic->specialization }}', '{{ $medic->status }}')" class="action-btn edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openArchiveMedicModal({{ $medic->id }}, '{{ $medic->name }}')" class="action-btn" style="background: rgba(245, 158, 11, 0.15); color: #d97706;">
                                            <i class="fas fa-box-archive"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <i class="fas fa-user-md"></i>
                                            <p>No medics found.</p>
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
        </div>

        <!-- Ambulance Panel -->
        <div id="ambulance-panel" class="panel-content">
            <div class="content-card">
                <div class="card-header">
                    <h4><i class="fas fa-ambulance"></i> Ambulance Management</h4>
                </div>

                <div style="margin-bottom: 2rem;">
                    <h5 style="margin: 0 0 1rem 0; font-size: 1.1rem; font-weight: 800; color: var(--heading);">
                        <i class="fas fa-plus-circle"></i> Add New Ambulance
                    </h5>
                    <form action="{{ route('admin.ambulances.store') }}" method="POST" style="background: #f8fafc; padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(226, 232, 240, 0.8);">
                        @csrf
                        <div class="form-grid">
                            <div class="form-field">
                                <label>Ambulance Name</label>
                                <input type="text" name="name" required placeholder="Enter ambulance name">
                            </div>
                            <div class="form-field">
                                <label>Status</label>
                                <select name="status" required>
                                    <option value="Available">Available</option>
                                    <option value="Out">Out</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(226, 232, 240, 0.8);">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add Ambulance
                            </button>
                        </div>
                    </form>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <h5 style="margin: 0; font-size: 1.1rem; font-weight: 800; color: var(--heading);">
                            <i class="fas fa-list"></i> Existing Ambulances
                        </h5>
                        <div class="search-container" style="margin: 0; flex: 1; max-width: 400px;">
                            <input type="text" id="ambulanceSearchInput" class="search-input" placeholder="Search ambulances...">
                            <button type="button" id="clearAmbulanceSearch" class="btn btn-secondary" style="display: none;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="grid-view">
                        @forelse ($ambulances as $amb)
                            <div class="grid-item">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                                    <h5 style="margin: 0; flex: 1;">{{ $amb->name }}</h5>
                                    <button onclick="openEditAmbulanceModal({{ $amb->id }}, '{{ $amb->name }}', '{{ $amb->status }}')" class="action-btn edit" style="padding: 0.4rem 0.6rem; font-size: 0.8rem;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                                <span class="status-badge {{ strtolower($amb->status) }}">
                                    {{ $amb->status }}
                                </span>
                            </div>
                        @empty
                            <div class="empty-state" style="grid-column: 1 / -1;">
                                <i class="fas fa-ambulance"></i>
                                <p>No ambulances yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Driver Panel -->
        <div id="driver-panel" class="panel-content">
            <div class="content-card">
                <div class="card-header">
                    <h4><i class="fas fa-car"></i> Driver Management</h4>
                </div>

                @if($errors->any())
                    <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem;">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Step 1: Basic Information -->
                    <div id="driver-section-1" class="driver-section">
                        <div class="step-indicator">
                            <div class="step active"></div>
                            <div class="step"></div>
                            <div class="step"></div>
                        </div>
                        <h5 style="margin: 0 0 1.5rem 0; font-size: 1.1rem; font-weight: 800; color: var(--heading);">
                            <i class="fas fa-user"></i> Basic Information
                        </h5>
                        <div class="form-grid">
                            <div class="form-field">
                                <label>Full Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter driver's full name">
                            </div>
                            <div class="form-field">
                                <label>Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number">
                            </div>
                            <div class="form-field">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Enter email address">
                            </div>
                            <div class="form-field">
                                <label>Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
                            </div>
                            <div class="form-field">
                                <label>Gender</label>
                                <select name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="form-field">
                                <label>Password</label>
                                <input type="password" name="password" required placeholder="Enter password">
                            </div>
                            <div class="form-field">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" required placeholder="Confirm password">
                            </div>
                            <div class="form-field" style="grid-column: 1 / -1;">
                                <label>Address</label>
                                <textarea name="address" rows="2" placeholder="Enter address">{{ old('address') }}</textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn btn-primary" onclick="nextDriverStep()">Next <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Professional + Emergency -->
                    <div id="driver-section-2" class="driver-section" style="display: none;">
                        <div class="step-indicator">
                            <div class="step active"></div>
                            <div class="step active"></div>
                            <div class="step"></div>
                        </div>
                        <h5 style="margin: 0 0 1.5rem 0; font-size: 1.1rem; font-weight: 800; color: var(--heading);">
                            <i class="fas fa-briefcase"></i> Professional Information
                        </h5>
                        <div class="form-grid">
                            <div class="form-field">
                                <label>Employee ID</label>
                                <input type="text" name="employee_id" value="{{ old('employee_id') }}" placeholder="Enter employee ID">
                            </div>
                            <div class="form-field">
                                <label>Status</label>
                                <select name="status" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                    <option value="on_leave" {{ old('status') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                                </select>
                            </div>
                        </div>
                        <h5 style="margin: 2rem 0 1.5rem 0; font-size: 1.1rem; font-weight: 800; color: var(--heading);">
                            <i class="fas fa-phone"></i> Emergency Contact
                        </h5>
                        <div class="form-grid">
                            <div class="form-field">
                                <label>Emergency Contact Name</label>
                                <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" placeholder="Enter emergency contact name">
                            </div>
                            <div class="form-field">
                                <label>Emergency Contact Phone</label>
                                <input type="text" name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" placeholder="Enter emergency contact phone">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="prevDriverStep()"><i class="fas fa-arrow-left"></i> Prev</button>
                            <button type="button" class="btn btn-primary" onclick="nextDriverStep()">Next <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- Step 3: Skills and Certifications -->
                    <div id="driver-section-3" class="driver-section" style="display: none;">
                        <div class="step-indicator">
                            <div class="step active"></div>
                            <div class="step active"></div>
                            <div class="step active"></div>
                        </div>
                        <h5 style="margin: 0 0 1.5rem 0; font-size: 1.1rem; font-weight: 800; color: var(--heading);">
                            <i class="fas fa-certificate"></i> Skills and Certifications
                        </h5>
                        <div class="form-grid">
                            <div class="form-field">
                                <label>Certifications (one per line)</label>
                                <textarea name="certifications_text" rows="4" placeholder="e.g., First Aid Certification&#10;CPR Certification&#10;Emergency Response Training">{{ old('certifications_text') }}</textarea>
                            </div>
                            <div class="form-field">
                                <label>Skills (one per line)</label>
                                <textarea name="skills_text" rows="4" placeholder="e.g., Defensive Driving&#10;Emergency Response&#10;Vehicle Maintenance">{{ old('skills_text') }}</textarea>
                            </div>
                            <div class="form-field" style="grid-column: 1 / -1;">
                                <label>Notes</label>
                                <textarea name="notes" rows="3" placeholder="Additional notes about the driver...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="prevDriverStep()"><i class="fas fa-arrow-left"></i> Prev</button>
                            <button type="button" onclick="showPanel('medic')" class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Create Driver
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Edit Medic Modal -->
<div id="editMedicModal" class="modal">
    <div class="modal-card modal-card--info">
        <div class="modal-card__header">
            <div class="modal-card__title">
                <span class="modal-card__icon"><i class="fas fa-user-md"></i></span>
                <div>
                    <h3>Edit Medic</h3>
                    <p>Keep medic profiles up to date.</p>
                </div>
            </div>
            <button class="modal-card__close" type="button" onclick="closeEditModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="editMedicForm" method="POST" class="modal-form">
            @csrf
            @method('PUT')
            <div class="modal-card__body">
                <div class="form-grid">
                    <div class="form-field">
                        <label for="edit_name"><i class="fas fa-user"></i> Name</label>
                        <input id="edit_name" type="text" name="name" required placeholder="Enter medic name">
                    </div>
                    <div class="form-field">
                        <label for="edit_phone"><i class="fas fa-phone"></i> Phone</label>
                        <input id="edit_phone" type="text" name="phone" placeholder="Enter phone number">
                    </div>
                    <div class="form-field">
                        <label for="edit_specialization"><i class="fas fa-stethoscope"></i> Specialization</label>
                        <input id="edit_specialization" type="text" name="specialization" placeholder="Enter specialization">
                    </div>
                    <div class="form-field">
                        <label for="edit_status"><i class="fas fa-toggle-on"></i> Status</label>
                        <select id="edit_status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" onclick="closeEditModal()" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update Medic
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Ambulance Modal -->
<div id="editAmbulanceModal" class="modal">
    <div class="modal-card modal-card--info">
        <div class="modal-card__header">
            <div class="modal-card__title">
                <span class="modal-card__icon"><i class="fas fa-ambulance"></i></span>
                <div>
                    <h3>Edit Ambulance</h3>
                    <p>Adjust the unit name and availability.</p>
                </div>
            </div>
            <button class="modal-card__close" type="button" onclick="closeEditAmbulanceModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="editAmbulanceForm" method="POST" class="modal-form">
            @csrf
            @method('PUT')
            <div class="modal-card__body">
                <div class="form-grid">
                    <div class="form-field">
                        <label for="edit_ambulance_name"><i class="fas fa-ambulance"></i> Ambulance Name</label>
                        <input id="edit_ambulance_name" type="text" name="name" required placeholder="Enter ambulance name">
                    </div>
                    <div class="form-field">
                        <label for="edit_ambulance_status"><i class="fas fa-toggle-on"></i> Status</label>
                        <select id="edit_ambulance_status" name="status" required>
                            <option value="Available">Available</option>
                            <option value="Out">Out</option>
                            <option value="Unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" onclick="closeEditAmbulanceModal()" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update Ambulance
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Archive Medic Confirmation Modal -->
<div id="archiveMedicModal" class="modal">
    <div class="modal-card modal-card--warning">
        <div class="modal-card__header">
            <div class="modal-card__title">
                <span class="modal-card__icon"><i class="fas fa-box-archive"></i></span>
                <div>
                    <h3>Archive Medic</h3>
                    <p>Move the medic to the archive list.</p>
                </div>
            </div>
            <button class="modal-card__close" type="button" onclick="closeArchiveMedicModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-card__body">
            <p>
                Are you sure you want to archive <strong id="archiveMedicName"></strong>? This medic will be
                moved to the archived section and can be restored later.
            </p>
        </div>
        <div class="modal-actions">
            <button type="button" onclick="closeArchiveMedicModal()" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </button>
            <form id="archiveMedicForm" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-box-archive"></i> Archive
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="modal">
    <div class="modal-card modal-card--success">
        <div class="modal-card__header">
            <div class="modal-card__title">
                <span class="modal-card__icon"><i class="fas fa-check-circle"></i></span>
                <div>
                    <h3>Success</h3>
                    <p>Everything worked as expected.</p>
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

<!-- Error Modal -->
<div id="errorModal" class="modal">
    <div class="modal-card modal-card--danger">
        <div class="modal-card__header">
            <div class="modal-card__title">
                <span class="modal-card__icon"><i class="fas fa-exclamation-triangle"></i></span>
                <div>
                    <h3>Something went wrong</h3>
                    <p>Review the message below.</p>
                </div>
            </div>
            <button class="modal-card__close" type="button" onclick="closeErrorModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-card__body">
            <p id="errorMessage"></p>
        </div>
        <div class="modal-actions">
            <button onclick="closeErrorModal()" class="btn btn-secondary" type="button">
                <i class="fas fa-check"></i> Got it
            </button>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    const sidenav = document.getElementById('sidenav');
    if (!sidenav) return;
    sidenav.classList.toggle('active');
}

function showPanel(panelName) {
    // Hide all panels
    const panels = document.querySelectorAll('.panel-content');
    panels.forEach(panel => {
        panel.classList.remove('active');
    });

    // Remove active class from all tabs
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(tab => {
        tab.classList.remove('active');
    });

    // Show selected panel
    const selectedPanel = document.getElementById(panelName + '-panel');
    if (selectedPanel) {
        selectedPanel.classList.add('active');
    }

    // Add active class to selected tab
    const selectedTab = document.getElementById(panelName + '-tab');
    if (selectedTab) {
        selectedTab.classList.add('active');
    }

    // Reset driver form if switching to driver panel
    if (panelName === 'driver') {
        showDriverSection(1);
    }
}

function openEditModal(id, name, phone, specialization, status) {
    document.getElementById('editMedicForm').action = `/admin/medics/${id}`;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_phone').value = phone || '';
    document.getElementById('edit_specialization').value = specialization || '';
    document.getElementById('edit_status').value = status;
    document.getElementById('editMedicModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeEditModal() {
    document.getElementById('editMedicModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function openEditAmbulanceModal(id, name, status) {
    document.getElementById('editAmbulanceForm').action = `/admin/ambulances/${id}`;
    document.getElementById('edit_ambulance_name').value = name;
    document.getElementById('edit_ambulance_status').value = status;
    document.getElementById('editAmbulanceModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeEditAmbulanceModal() {
    document.getElementById('editAmbulanceModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function openArchiveMedicModal(id, name) {
    document.getElementById('archiveMedicName').textContent = name;
    document.getElementById('archiveMedicForm').action = `/admin/medics/${id}/archive`;
    document.getElementById('archiveMedicModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeArchiveMedicModal() {
    document.getElementById('archiveMedicModal').style.display = 'none';
    document.body.style.overflow = 'auto';
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

function showErrorModal(message) {
    document.getElementById('errorMessage').textContent = message;
    document.getElementById('errorModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeErrorModal() {
    document.getElementById('errorModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

window.onclick = function(event) {
    const editModal = document.getElementById('editMedicModal');
    const editAmbulanceModal = document.getElementById('editAmbulanceModal');
    const archiveMedicModal = document.getElementById('archiveMedicModal');
    const successModal = document.getElementById('successModal');
    const errorModal = document.getElementById('errorModal');
    
    if (event.target === editModal) closeEditModal();
    if (event.target === editAmbulanceModal) closeEditAmbulanceModal();
    if (event.target === archiveMedicModal) closeArchiveMedicModal();
    if (event.target === successModal) closeSuccessModal();
    if (event.target === errorModal) closeErrorModal();
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

function filterAmbulanceTable() {
    const searchInput = document.getElementById('ambulanceSearchInput');
    const clearBtn = document.getElementById('clearAmbulanceSearch');
    const grid = document.querySelector('.grid-view');
    
    if (!searchInput || !grid) return;
    
    const searchTerm = searchInput.value.toLowerCase().trim();
    const items = grid.querySelectorAll('.grid-item');
    
    let visibleCount = 0;
    
    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        const matches = text.includes(searchTerm);
        
        if (matches || searchTerm === '') {
            item.style.display = '';
            visibleCount++;
        } else {
            item.style.display = 'none';
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

function clearAmbulanceSearch() {
    const searchInput = document.getElementById('ambulanceSearchInput');
    if (searchInput) {
        searchInput.value = '';
        filterAmbulanceTable();
    }
}

let currentDriverSection = 1;

function showDriverSection(index) {
    for (let i = 1; i <= 3; i++) {
        const el = document.getElementById(`driver-section-${i}`);
        if (!el) continue;
        el.style.display = i === index ? 'block' : 'none';
    }
    currentDriverSection = index;
}

function nextDriverStep() {
    if (currentDriverSection < 3) {
        showDriverSection(currentDriverSection + 1);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

function prevDriverStep() {
    if (currentDriverSection > 1) {
        showDriverSection(currentDriverSection - 1);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

function setupDriverFormSubmission() {
    const form = document.querySelector('form[action*="drivers.store"]');
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        const certificationsText = document.querySelector('textarea[name="certifications_text"]');
        if (certificationsText) {
            const certifications = certificationsText.value.split('\n').filter(item => item.trim() !== '');
            const certificationsInput = document.createElement('input');
            certificationsInput.type = 'hidden';
            certificationsInput.name = 'certifications[]';
            certificationsInput.value = JSON.stringify(certifications);
            form.appendChild(certificationsInput);
        }
        
        const skillsText = document.querySelector('textarea[name="skills_text"]');
        if (skillsText) {
            const skills = skillsText.value.split('\n').filter(item => item.trim() !== '');
            const skillsInput = document.createElement('input');
            skillsInput.type = 'hidden';
            skillsInput.name = 'skills[]';
            skillsInput.value = JSON.stringify(skills);
            form.appendChild(skillsInput);
        }
    });
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

document.addEventListener('DOMContentLoaded', function(){
    showDriverSection(1);
    setupDriverFormSubmission();

    @if(session('success'))
        showSuccessModal('{{ session('success') }}');
    @endif

    const medicSearchInput = document.getElementById('medicSearchInput');
    const ambulanceSearchInput = document.getElementById('ambulanceSearchInput');
    const clearMedicBtn = document.getElementById('clearMedicSearch');
    const clearAmbulanceBtn = document.getElementById('clearAmbulanceSearch');

    if (medicSearchInput) {
        medicSearchInput.addEventListener('input', filterMedicTable);
    }

    if (ambulanceSearchInput) {
        ambulanceSearchInput.addEventListener('input', filterAmbulanceTable);
    }

    if (clearMedicBtn) {
        clearMedicBtn.addEventListener('click', clearMedicSearch);
    }

    if (clearAmbulanceBtn) {
        clearAmbulanceBtn.addEventListener('click', clearAmbulanceSearch);
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
