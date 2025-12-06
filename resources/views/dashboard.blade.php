<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Command Dashboard · MDRRMO</title>
    <link rel="stylesheet" href="{{ asset('css/stylish.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg-gradient: radial-gradient(circle at top, #eff6ff 0%, #eef2ff 45%, #f5f7fb 100%);
            --card: #ffffff;
            --border: rgba(148, 163, 184, 0.25);
            --heading: #0f172a;
            --muted: #6b7280;
            --accent: #2563eb;
            --accent-alt: #6366f1;
            --success: #10b981;
            --warning: #f97316;
            --danger: #ef4444;
            --shadow-lg: 0 30px 60px rgba(15, 23, 42, 0.12);
            --header-height: 72px;
            --nav-width: 260px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg-gradient);
            font-family: 'Nunito', 'Segoe UI', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--heading);
        }

        .mdrrmo-header {
            background: #f7f7f7;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            border: none;
            min-height: var(--header-height);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .dashboard-main {
            margin-left: var(--nav-width);
            padding: 2.75rem clamp(1.25rem, 3vw, 3rem);
            padding-top: calc(var(--header-height) + 2.5rem);
        }

        @media (max-width: 992px) {
            .dashboard-main {
                margin-left: 0;
                padding: calc(var(--header-height) + 1.5rem) 1.25rem 2rem;
            }
        }

        .dashboard-page-container {
            max-width: 1500px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.65rem;
        }

        .hero-card {
            background: var(--card);
            border-radius: 30px;
            border: 1px solid rgba(99, 102, 241, 0.15);
            box-shadow: var(--shadow-lg);
            padding: clamp(1.75rem, 4vw, 3rem);
            display: grid;
            gap: 2.5rem;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 0.8fr);
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

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.4rem 0.95rem;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: #1d4ed8;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .hero-card h1 {
            margin: 0.85rem 0 0.35rem;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
        }

        .hero-card p {
            margin: 0.65rem 0 1.25rem;
            color: var(--muted);
            font-size: 1rem;
            max-width: 520px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .hero-card__panel {
            background: rgba(99, 102, 241, 0.08);
            border-radius: 24px;
            padding: 1.5rem;
            border: 1px solid rgba(99, 102, 241, 0.2);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .panel-heading {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.25em;
            color: var(--muted);
            font-weight: 800;
            margin: 0;
        }

        .live-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            font-weight: 700;
            background: #fff;
            border-radius: 999px;
            padding: 0.45rem 0.85rem;
            border: 1px solid rgba(15, 23, 42, 0.08);
            font-size: 0.85rem;
        }

        .hero-card__panel label {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--muted);
            font-weight: 800;
        }

        .hero-card__panel input[type="date"] {
            width: 100%;
            border-radius: 18px;
            border: 1.6px solid rgba(148, 163, 184, 0.6);
            padding: 0.95rem 1rem;
            font-weight: 700;
            color: var(--heading);
            background: #ffffff;
            box-shadow: inset 0 1px 2px rgba(15,23,42,0.05);
        }

        .hero-note {
            font-size: 0.85rem;
            color: var(--muted);
            font-weight: 600;
            display: flex;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .btn {
            border: none;
            border-radius: 14px;
            padding: 0.85rem 1.35rem;
            font-weight: 800;
            letter-spacing: 0.02em;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-alt));
            color: #ffffff;
            box-shadow: 0 18px 35px rgba(37, 99, 235, 0.35);
        }

        .btn-tonal {
            background: rgba(15, 23, 42, 0.05);
            color: var(--heading);
            border: 1px solid rgba(15, 23, 42, 0.08);
            text-decoration: none;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }

        .kpi-card {
            background: var(--card);
            border-radius: 22px;
            padding: 1.2rem 1.4rem;
            border: 1px solid var(--border);
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.08);
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 25px 55px rgba(37, 99, 235, 0.15);
        }

        .kpi-card__eyebrow {
            font-size: 0.72rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 800;
        }

        .kpi-card__value {
            font-size: 2.4rem;
            font-weight: 900;
        }

        .kpi-card__hint {
            font-size: 0.85rem;
            color: var(--muted);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .insight-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
        }

        .insight-card {
            background: var(--card);
            border-radius: 24px;
            border: 1px solid var(--border);
            padding: 1.4rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .insight-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 30px 60px rgba(37, 99, 235, 0.15);
        }

        .insight-card small {
            font-weight: 800;
            text-transform: uppercase;
            color: var(--muted);
            letter-spacing: 0.12em;
        }

        .insight-card h3 {
            margin: 0;
            font-size: 2.2rem;
            font-weight: 900;
        }

        .readiness-layout {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 1100px) {
            .hero-card {
                grid-template-columns: 1fr;
            }
            .readiness-layout {
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            }
        }

        .readiness-card,
        .queue-card,
        .quick-card,
        .notes-card {
            background: var(--card);
            border-radius: 26px;
            border: 1px solid var(--border);
            box-shadow: 0 20px 55px rgba(15, 23, 42, 0.08);
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .progress-row {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .progress-row span {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--heading);
        }

        .progress-bar {
            height: 12px;
            border-radius: 999px;
            background: #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .progress-fill {
            position: absolute;
            inset: 0;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--accent), var(--accent-alt));
        }

        .queue-list,
        .notes-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .queue-list li {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            color: var(--heading);
        }

        .queue-list span {
            font-size: 0.9rem;
            color: var(--muted);
            font-weight: 600;
        }

        .quick-link {
            border: 1px solid rgba(148, 163, 184, 0.4);
            border-radius: 16px;
            padding: 0.95rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: var(--heading);
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .quick-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 35px rgba(37, 99, 235, 0.18);
        }

        .notes-card p {
            margin: 0;
            color: var(--muted);
            font-weight: 600;
            line-height: 1.6;
        }

        .toggle-btn {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1100;
            background: #031273;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 0.65rem 0.85rem;
            cursor: pointer;
            box-shadow: 0 12px 35px rgba(3, 18, 115, 0.35);
        }

        @media (max-width: 768px) {
            .toggle-btn {
                display: inline-flex;
            }
            .sidenav {
                transform: translateX(-100%);
            }
            .sidenav.active {
                transform: translateX(0);
            }
        }

        .sidenav {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--nav-width);
            height: 100vh;
            background: linear-gradient(180deg, #031273 0%, #1e3a8a 100%);
            z-index: 900;
            overflow-y: auto;
            transition: transform 0.3s ease;
            box-shadow: 15px 0 35px rgba(15, 23, 42, 0.35);
        }

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            padding: 1.25rem 1rem 2rem;
        }

        .nav-links a,
        .nav-links span {
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

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
        }

        .nav-links a.active {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
            font-weight: 800;
        }
    </style>
</head>
<body class="dashboard-page">
@php
    $firstName = auth()->check() ? explode(' ', auth()->user()->name ?? 'Admin')[0] : 'Guest';
    $driverPercent = $staffMetrics['drivers']['total'] ? round(($staffMetrics['drivers']['online'] / max(1, $staffMetrics['drivers']['total'])) * 100) : 0;
    $medicPercent = $staffMetrics['medics']['total'] ? round(($staffMetrics['medics']['active'] / max(1, $staffMetrics['medics']['total'])) * 100) : 0;
    $ambulanceText = number_format($systemMetrics['ambulances']['available']).' ready / '.number_format($systemMetrics['ambulances']['total']).' fleet';
@endphp

<button class="toggle-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

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

<div class="mdrrmo-header">
    <h2 class="header-title" style="display:none;"></h2>
    <div id="userMenu" style="position:fixed; right:16px; top:16px; display:inline-flex; align-items:center; gap:10px; cursor:pointer; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); padding:6px 10px; border-radius:999px; box-shadow:0 6px 18px rgba(0,0,0,0.18); backdrop-filter:saturate(140%);">
        <div style="width:28px; height:28px; border-radius:999px; background:linear-gradient(135deg,#4CC9F0,#031273); display:inline-flex; align-items:center; justify-content:center; position:relative;">
            <i class="fas fa-user-shield" style="font-size:14px; color:#fff;"></i>
            <span style="position:absolute; right:-1px; bottom:-1px; width:8px; height:8px; border-radius:999px; background:#22c55e; box-shadow:0 0 0 2px #0c2d5a;"></span>
        </div>
        <span style="font-weight:800; color:#000; letter-spacing:0.2px;">{{ $firstName }}</span>
        <i class="fas fa-chevron-down" style="font-size:10px; color:rgba(0,0,0,0.6);"></i>
        <div id="userDropdown" style="display:none; position:absolute; right:0; top:calc(100% + 12px); background:#ffffff; color:#0f172a; border-radius:10px; box-shadow:0 10px 24px rgba(0,0,0,0.2); padding:8px; min-width:160px; z-index:1100;">
            <div style="position:absolute; right:12px; top:-8px; width:0; height:0; border-left:8px solid transparent; border-right:8px solid transparent; border-bottom:8px solid #ffffff;"></div>
            @if(auth()->check())
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button id="changeAccountBtn" type="submit" style="width:100%; background:linear-gradient(135deg,#ef4444,#b91c1c); color:#ffffff; border:none; border-radius:8px; padding:6px 8px; font-weight:700; font-size:12px; display:inline-flex; align-items:center; justify-content:center; gap:6px; cursor:pointer; box-shadow:0 4px 12px rgba(239,68,68,0.28);">
                        <i class="fas fa-right-left" style="font-size:12px;"></i>
                        <span>Log Out</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="width:100%; background:linear-gradient(135deg,#2563eb,#1d4ed8); color:#ffffff; border-radius:8px; padding:6px 8px; font-weight:700; font-size:12px; display:inline-flex; align-items:center; justify-content:center; gap:6px; text-decoration:none;">
                    <i class="fas fa-sign-in-alt" style="font-size:12px;"></i>
                    <span>Login</span>
                </a>
            @endif
        </div>
    </div>
</div>

<main class="dashboard-main">
    <div class="dashboard-page-container">
        <section class="hero-card">
            <div>
                <span class="hero-badge"><i class="fas fa-bolt"></i> Operations pulse</span>
                <h1>Emergency Command Dashboard</h1>
                <p id="selected-date-label">Tracking deployments for {{ $selectedDateHuman }}</p>
                <div class="hero-actions">
                    <button id="refresh-metrics" class="btn btn-primary">
                        <i class="fas fa-rotate"></i> Refresh data
                    </button>
                    <a href="{{ route('dashboard.view') }}" class="btn btn-tonal">
                        <i class="fas fa-display"></i> Dashboard view
                    </a>
                </div>
                <div class="hero-note">
                    <i class="fas fa-lightbulb" style="color:var(--accent);"></i>
                    <span>Need printable snapshots? Go to Reports for polished exports and PDF-ready tables.</span>
                </div>
            </div>
            <div class="hero-card__panel">
                <p class="panel-heading">Focus timeline</p>
                <span class="live-pill">
                    <i class="fas fa-circle" style="color:#22c55e;"></i>
                    <span id="metrics-status">Updated {{ $lastUpdated }}</span>
                </span>
                <div>
                    <label for="metrics-date">Focus date</label>
                    <input type="date" id="metrics-date" value="{{ $selectedDate }}">
                </div>
            </div>
        </section>

        <section class="kpi-grid">
            <a href="{{ url('/admin/gps') }}" class="kpi-card">
                <span class="kpi-card__eyebrow">Dispatch</span>
                <div style="display:flex; align-items:center; gap:0.5rem;">
                    <h3 style="margin:0;">Pending cases</h3>
                    <i class="fas fa-arrow-up-right-from-square" style="font-size:0.95rem; color:var(--muted);"></i>
                </div>
                <div class="kpi-card__value" id="metricPending">{{ number_format($caseMetrics['pending']) }}</div>
                <span class="kpi-card__hint">Opens GPS tracker</span>
            </a>
            <a href="{{ url('/admin/gps') }}?view=active" class="kpi-card">
                <span class="kpi-card__eyebrow">Live runs</span>
                <div style="display:flex; align-items:center; gap:0.5rem;">
                    <h3 style="margin:0;">Active cases</h3>
                    <i class="fas fa-arrow-up-right-from-square" style="font-size:0.95rem; color:var(--muted);"></i>
                </div>
                <div class="kpi-card__value" id="metricActive">{{ number_format($caseMetrics['active']) }}</div>
                <span class="kpi-card__hint">Opens active table in GPS</span>
            </a>
            <a href="{{ route('admin.reports') }}#completed-today" class="kpi-card">
                <span class="kpi-card__eyebrow">Wrap-ups</span>
                <div style="display:flex; align-items:center; gap:0.5rem;">
                    <h3 style="margin:0;">Completed today</h3>
                    <i class="fas fa-arrow-up-right-from-square" style="font-size:0.95rem; color:var(--muted);"></i>
                </div>
                <div class="kpi-card__value" id="metricCompletedToday">{{ number_format($caseMetrics['completed']) }}</div>
                <span class="kpi-card__hint">Jump to reports</span>
            </a>
        </section>

        <section class="insight-grid">
            <a href="{{ url('/admin/drivers') }}" class="insight-card">
                <small>Online drivers</small>
                <h3 id="metricDriversOnline">{{ number_format($staffMetrics['drivers']['online']) }}</h3>
                <p style="margin:0; color:var(--muted);">of <span id="metricDriversTotal">{{ number_format($staffMetrics['drivers']['total']) }}</span> registered</p>
            </a>
            <a href="{{ url('/admin/drivers') }}" class="insight-card">
                <small>Active medics</small>
                <h3 id="metricMedicsOnline">{{ number_format($staffMetrics['medics']['active']) }}</h3>
                <p style="margin:0; color:var(--muted);">of <span id="metricMedicsTotal">{{ number_format($staffMetrics['medics']['total']) }}</span> roster</p>
            </a>
            <a href="{{ url('/admin/drivers') }}" class="insight-card">
                <small>Ambulances ready</small>
                <h3 id="metricAmbulancesAvailable">{{ number_format($systemMetrics['ambulances']['available']) }}</h3>
                <p id="metricAmbulancesSummary" style="margin:0; color:var(--muted);">{{ $ambulanceText }}</p>
            </a>
            <a href="{{ route('admin.reports') }}" class="insight-card">
                <small>Total cases</small>
                <h3 id="metricTotalCases">{{ number_format($caseMetrics['total']) }}</h3>
                <p style="margin:0; color:var(--muted);">View mission history</p>
            </a>
        </section>

        <section class="readiness-layout">
            <article class="readiness-card">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <h3 style="margin:0; font-size:1rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted);">Resource readiness</h3>
                    <span style="font-weight:800; color:var(--accent);">Live</span>
                </div>
                <div class="progress-row">
                    <span>Drivers <small id="driverPctLabel" style="color:var(--muted); margin-left:0.35rem;">{{ $driverPercent }}%</small></span>
                    <div class="progress-bar">
                        <div class="progress-fill" id="driver-readiness-bar" style="width: {{ $driverPercent }}%;"></div>
                    </div>
                </div>
                <div class="progress-row">
                    <span>Medics <small id="medicPctLabel" style="color:var(--muted); margin-left:0.35rem;">{{ $medicPercent }}%</small></span>
                    <div class="progress-bar">
                        <div class="progress-fill" id="medic-readiness-bar" style="width: {{ $medicPercent }}%; background: linear-gradient(135deg, #10b981, #059669);"></div>
                    </div>
                </div>
                <div class="progress-row">
                    <span>Response queue health</span>
                    <ul class="queue-list">
                        <li><span>Pending</span><strong id="queuePendingLabel">{{ number_format($caseMetrics['pending']) }}</strong></li>
                        <li><span>Active</span><strong id="queueActiveLabel">{{ number_format($caseMetrics['active']) }}</strong></li>
                        <li><span>Completed today</span><strong id="queueCompletedLabel">{{ number_format($caseMetrics['completed']) }}</strong></li>
                    </ul>
                </div>
            </article>
            <article class="queue-card">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <h4 style="margin:0;">Queue snapshot</h4>
                    <span style="font-size:0.82rem; text-transform:uppercase; color:var(--muted); letter-spacing:0.12em;">Live feed</span>
                </div>
                <ul class="queue-list">
                    <li><span>Dispatch ready</span><strong id="queue-pending">{{ number_format($caseMetrics['pending']) }}</strong></li>
                    <li><span>On route</span><strong id="queue-active">{{ number_format($caseMetrics['active']) }}</strong></li>
                    <li><span>Completed today</span><strong id="queue-completed">{{ number_format($caseMetrics['completed']) }}</strong></li>
                </ul>
            </article>
            <article class="quick-card">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <h4 style="margin:0;">Quick actions</h4>
                    <i class="fas fa-arrow-trend-up" style="color:var(--accent);"></i>
                </div>
                <a class="quick-link" href="{{ url('/admin/pairing') }}">
                    Pair crews fast
                    <i class="fas fa-link"></i>
                </a>
                <a class="quick-link" href="{{ url('/admin/gps') }}">
                    GPS tracker
                    <i class="fas fa-location-dot"></i>
                </a>
                <a class="quick-link" href="{{ route('admin.reports') }}">
                    Completed missions
                    <i class="fas fa-file-lines"></i>
                </a>
            </article>
        </section>

        <section class="notes-card">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <h4 style="margin:0;">Ops notes</h4>
                <i class="fas fa-info-circle" style="color:var(--warning);"></i>
            </div>
            <p>
                • Keep at least 3 ambulances on standby during peak hours.<br>
                • Export detailed logs from the Reports page for end-of-day summaries.
            </p>
        </section>
    </div>
</main>

<script>
    const dateInput = document.getElementById('metrics-date');
    const refreshBtn = document.getElementById('refresh-metrics');
    const metricsStatus = document.getElementById('metrics-status');
    const selectedDateLabel = document.getElementById('selected-date-label');
    const driverBar = document.getElementById('driver-readiness-bar');
    const medicBar = document.getElementById('medic-readiness-bar');
    const driverPctLabel = document.getElementById('driverPctLabel');
    const medicPctLabel = document.getElementById('medicPctLabel');
    const endpoint = "{{ route('dashboard.metrics') }}";

    const setNumber = (id, value) => {
        const el = document.getElementById(id);
        if (el) el.textContent = new Intl.NumberFormat('en-PH').format(value ?? 0);
    };

    const setPlain = (id, value) => {
        const el = document.getElementById(id);
        if (el) el.textContent = value ?? '';
    };

    const updateBar = (element, label, value) => {
        if (element) element.style.width = `${Math.min(100, Math.max(0, value))}%`;
        if (label) label.textContent = `${Math.round(Math.min(100, Math.max(0, value)))}%`;
    };

    async function fetchMetrics(date) {
        if (!date) return;
        metricsStatus.textContent = 'Syncing…';
        refreshBtn.disabled = true;
        try {
            const response = await fetch(`${endpoint}?date=${encodeURIComponent(date)}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            if (!response.ok) throw new Error('Unable to fetch metrics');

            const payload = await response.json();
            const caseMetrics = payload.caseMetrics || {};
            const staffMetrics = payload.staffMetrics || {};
            const systemMetrics = payload.systemMetrics || {};

            setNumber('metricPending', caseMetrics.pending);
            setNumber('metricActive', caseMetrics.active);
            setNumber('metricCompletedToday', caseMetrics.completed);
            setNumber('metricTotalCases', caseMetrics.total);

            setNumber('metricDriversOnline', staffMetrics.drivers?.online);
            setNumber('metricDriversTotal', staffMetrics.drivers?.total);
            setNumber('metricMedicsOnline', staffMetrics.medics?.active);
            setNumber('metricMedicsTotal', staffMetrics.medics?.total);

            const ambulancesAvailable = systemMetrics.ambulances?.available ?? 0;
            const ambulancesTotal = systemMetrics.ambulances?.total ?? 0;
            setNumber('metricAmbulancesAvailable', ambulancesAvailable);
            setPlain('metricAmbulancesSummary', `${new Intl.NumberFormat('en-PH').format(ambulancesAvailable)} ready / ${new Intl.NumberFormat('en-PH').format(ambulancesTotal)} fleet`);

            setPlain('metricDriversOnline', new Intl.NumberFormat('en-PH').format(staffMetrics.drivers?.online ?? 0));
            setPlain('metricDriversTotal', new Intl.NumberFormat('en-PH').format(staffMetrics.drivers?.total ?? 0));
            setPlain('metricMedicsOnline', new Intl.NumberFormat('en-PH').format(staffMetrics.medics?.active ?? 0));
            setPlain('metricMedicsTotal', new Intl.NumberFormat('en-PH').format(staffMetrics.medics?.total ?? 0));

            const driverPct = (staffMetrics.drivers?.total ?? 0) ? (staffMetrics.drivers.online / staffMetrics.drivers.total) * 100 : 0;
            const medicPct = (staffMetrics.medics?.total ?? 0) ? (staffMetrics.medics.active / staffMetrics.medics.total) * 100 : 0;
            updateBar(driverBar, driverPctLabel, driverPct);
            updateBar(medicBar, medicPctLabel, medicPct);

            setNumber('queue-pending', caseMetrics.pending);
            setNumber('queue-active', caseMetrics.active);
            setNumber('queue-completed', caseMetrics.completed);
            setNumber('queuePendingLabel', caseMetrics.pending);
            setNumber('queueActiveLabel', caseMetrics.active);
            setNumber('queueCompletedLabel', caseMetrics.completed);

            if (caseMetrics.date) {
                selectedDateLabel.textContent = `Tracking deployments for ${caseMetrics.date.human}`;
                dateInput.value = caseMetrics.date.raw;
            }

            const updateTime = payload.requested_at ? new Date(payload.requested_at).toLocaleTimeString() : new Date().toLocaleTimeString();
            metricsStatus.textContent = `Updated ${updateTime}`;
        } catch (error) {
            metricsStatus.textContent = 'Unable to refresh metrics. Please try again.';
            console.error(error);
        } finally {
            refreshBtn.disabled = false;
        }
    }

    refreshBtn?.addEventListener('click', () => fetchMetrics(dateInput.value));
    dateInput?.addEventListener('change', (event) => fetchMetrics(event.target.value));

    function toggleSidebar() {
        document.getElementById('sidenav')?.classList.toggle('active');
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
    updateSidebarDateTime();
    setInterval(updateSidebarDateTime, 1000);

    document.getElementById('userMenu')?.addEventListener('click', function(e) {
        e.stopPropagation();
        const dropdown = document.getElementById('userDropdown');
        if (!dropdown) return;
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('userDropdown');
        const menu = document.getElementById('userMenu');
        if (dropdown && menu && !menu.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });

    document.getElementById('changeAccountBtn')?.addEventListener('click', function(ev){
        ev.preventDefault();
        const form = this.closest('form');
        if (!form) return;
        const action = form.getAttribute('action');
        const token = form.querySelector('input[name="_token"]')?.value ?? '';
        fetch(action, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify({})
        }).finally(() => { window.location.href = '{{ route('login') }}'; });
    });
</script>
</body>
</html>

