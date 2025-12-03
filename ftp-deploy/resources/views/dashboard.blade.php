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
            --bg-gradient: radial-gradient(circle at top, #fdf2ff 0%, #eef2ff 45%, #f5f7fb 100%);
            --panel: #ffffff;
            --glass: rgba(255, 255, 255, 0.7);
            --border: rgba(148, 163, 184, 0.3);
            --heading: #0f172a;
            --muted: #6b7280;
            --accent: #2563eb;
            --accent-alt: #7c3aed;
            --success: #16a34a;
            --warning: #f97316;
            --danger: #ef4444;
            --shadow: 0 25px 60px rgba(15, 23, 42, 0.12);
            --header-height: 70px;
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

        .dashboard-shell {
            margin-left: 260px;
            padding: 2.5rem clamp(1rem, 3vw, 3rem);
        }

        @media (max-width: 992px) {
            .dashboard-shell {
                margin-left: 0;
                padding-top: calc(var(--header-height) + 2rem);
            }
        }

        .dashboard-container {
            max-width: 1500px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
        }

        .hero-panel {
            background: var(--panel);
            border-radius: 28px;
            border: 1px solid rgba(99, 102, 241, 0.12);
            box-shadow: var(--shadow);
            padding: clamp(1.75rem, 4vw, 3rem);
            display: grid;
            gap: 2rem;
            grid-template-columns: minmax(0, 1.3fr) minmax(0, 0.9fr);
            position: relative;
            overflow: hidden;
        }

        .hero-panel::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(124,58,237,0.18), transparent 65%);
            z-index: 0;
        }

        .hero-panel > * {
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.12);
            color: #1d4ed8;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .hero-panel h1 {
            margin: 0.75rem 0 0;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
        }

        .hero-panel p {
            margin: 0.75rem 0 1.25rem;
            color: var(--muted);
            font-size: 1rem;
            max-width: 520px;
        }

        .hero-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0.85rem;
        }

        .hero-metric {
            background: rgba(37, 99, 235, 0.08);
            border: 1px solid rgba(37, 99, 235, 0.15);
            border-radius: 18px;
            padding: 0.9rem 1rem;
        }

        .hero-metric span {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #4338ca;
            font-weight: 700;
        }

        .hero-metric strong {
            display: block;
            margin-top: 0.35rem;
            font-size: 1.8rem;
            font-weight: 900;
            color: #1e1b4b;
        }

        .control-panel {
            background: linear-gradient(145deg, rgba(37,99,235,0.08), rgba(124,58,237,0.08)), var(--panel);
            border: 1px solid rgba(99, 102, 241, 0.18);
            border-radius: 24px;
            padding: 1.75rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .control-panel__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .control-panel__eyebrow {
            margin: 0;
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.25em;
            color: var(--muted);
            font-weight: 800;
        }

        .control-panel__header h4 {
            margin: 0.2rem 0 0;
            font-size: 1.35rem;
            font-weight: 900;
            color: var(--heading);
        }

        .control-panel__status {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.5rem 0.9rem;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.06);
            border: 1px solid rgba(15, 23, 42, 0.08);
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--heading);
        }

        .control-panel__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: end;
        }

        .control-field {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .control-field span {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--muted);
            font-weight: 800;
        }

        .control-panel input[type="date"] {
            border-radius: 16px;
            border: 1.6px solid rgba(148, 163, 184, 0.6);
            padding: 0.9rem 1rem;
            font-weight: 700;
            color: var(--heading);
            background: #ffffff;
            box-shadow: inset 0 1px 2px rgba(15,23,42,0.05);
        }

        .control-panel__buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .control-panel__note {
            font-size: 0.85rem;
            color: var(--muted);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn {
            border: none;
            border-radius: 14px;
            padding: 0.85rem 1.25rem;
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

        .btn-secondary {
            background: rgba(15, 23, 42, 0.05);
            color: var(--heading);
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .sync-meta {
            font-size: 0.9rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            background: var(--panel);
            border-radius: 22px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            padding: 1.25rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .stat-card__label {
            text-transform: uppercase;
            font-size: 0.74rem;
            letter-spacing: 0.1em;
            color: var(--muted);
            font-weight: 800;
        }

        .stat-card__value {
            font-size: 2rem;
            font-weight: 900;
        }

        .stat-card__sub {
            color: var(--muted);
            font-weight: 600;
        }

        .readiness-card {
            background: var(--panel);
            border-radius: 28px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: var(--shadow);
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .progress-row {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .progress-row span {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--heading);
        }

        .progress-bar {
            height: 10px;
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

        .mini-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
        }

        .mini-panel {
            background: var(--panel);
            border-radius: 24px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            padding: 1.5rem;
            box-shadow: 0 15px 30px rgba(15, 23, 42, 0.08);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .list li {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            color: var(--heading);
        }

        .list li span {
            font-size: 0.85rem;
            color: var(--muted);
            font-weight: 600;
        }

        .quick-link {
            border: 1px solid rgba(148, 163, 184, 0.4);
            border-radius: 14px;
            padding: 0.8rem 1rem;
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
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.15);
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
            .dashboard-shell {
                padding: 1.5rem;
                padding-top: calc(var(--header-height) + 1.5rem);
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
            width: 260px;
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
            gap: 0.35rem;
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
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .nav-links a.active {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
            font-weight: 800;
        }
    </style>
</head>
<body>
@php
    $firstName = auth()->check() ? explode(' ', auth()->user()->name ?? 'Admin')[0] : 'Guest';
@endphp

<button class="toggle-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<aside class="sidenav" id="sidenav">
    <div class="logo-container" style="display:flex; flex-direction:column; align-items:center;">
        <img src="{{ asset('image/mdrrmologo.jpg') }}" alt="Logo" class="logo-img" style="display:block; margin:0 auto;">
        <div style="margin-top:8px; width:100%; text-align:center; font-weight:800; color:#fff; letter-spacing:0.5px;">SILANG MDRRMO</div>
    </div>
    <nav class="nav-links">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
        @if(auth()->check())
            <span class="nav-link-locked" style="display:block; text-decoration:none; color:#9ca3af; font-weight:600; padding:0.75rem 1rem; border-radius:8px; cursor:not-allowed; opacity:0.6;">
                <i class="fas fa-pen"></i> Posting <i class="fas fa-lock" style="font-size:10px; margin-left:6px;"></i>
            </span>
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

<div class="mdrrmo-header" style="background:#F7F7F7; box-shadow:0 2px 8px rgba(0,0,0,0.12); border:none; min-height:var(--header-height); padding:1rem 2rem; display:flex; align-items:center; justify-content:center; position:fixed; top:0; left:0; right:0; z-index:1000;">
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
                        <span>Change account</span>
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

<main class="dashboard-shell">
    <div class="dashboard-container">
        <section class="hero-panel">
            <div>
                <span class="hero-badge"><i class="fas fa-bolt"></i> Operations pulse</span>
                <h1>Emergency Command Dashboard</h1>
                <p id="selected-date-label">Tracking deployments for {{ $selectedDateHuman }}</p>
                <div class="hero-metrics">
                    <div class="hero-metric">
                        <span>Pending cases</span>
                        <strong id="metricPending">{{ number_format($caseMetrics['pending']) }}</strong>
                    </div>
                    <div class="hero-metric">
                        <span>Active cases</span>
                        <strong id="metricActive">{{ number_format($caseMetrics['active']) }}</strong>
                    </div>
                    <div class="hero-metric">
                        <span>Completed today</span>
                        <strong id="metricCompletedToday">{{ number_format($caseMetrics['completed']) }}</strong>
                    </div>
                </div>
            </div>
            <div class="control-panel">
                <div class="control-panel__header">
                    <div>
                        <p class="control-panel__eyebrow">Live controls</p>
                        <h4>Focus timeline</h4>
                    </div>
                    <span class="control-panel__status">
                        <i class="fas fa-circle" style="color:#22c55e;"></i>
                        <span id="metrics-status">Updated {{ $lastUpdated }}</span>
                    </span>
                </div>
                <div class="control-panel__grid">
                    <label class="control-field">
                        <span>Focus date</span>
                        <input type="date" id="metrics-date" value="{{ $selectedDate }}">
                    </label>
                    <div class="control-panel__buttons">
                        <button id="refresh-metrics" class="btn btn-primary">
                            <i class="fas fa-rotate"></i> Refresh data
                        </button>
                        <a href="{{ route('dashboard.view') }}" class="btn btn-secondary" style="text-decoration:none;">
                            <i class="fas fa-display"></i> Dashboard view
                        </a>
                    </div>
                </div>
                <div class="control-panel__note">
                    <i class="fas fa-lightbulb"></i>
                    <span>Need printable snapshots? Visit Reports for polished exports.</span>
                </div>
            </div>
        </section>

        @php
            $driverPercent = $staffMetrics['drivers']['total'] ? round(($staffMetrics['drivers']['online'] / max(1, $staffMetrics['drivers']['total'])) * 100) : 0;
            $medicPercent = $staffMetrics['medics']['total'] ? round(($staffMetrics['medics']['active'] / max(1, $staffMetrics['medics']['total'])) * 100) : 0;
            $ambulanceText = number_format($systemMetrics['ambulances']['available']).' ready / '.number_format($systemMetrics['ambulances']['total']).' fleet';
        @endphp

        <section class="stat-grid">
            <article class="stat-card">
                <div class="stat-card__label">Online drivers</div>
                <div class="stat-card__value" id="metricDriversOnline">{{ number_format($staffMetrics['drivers']['online']) }}</div>
                <div class="stat-card__sub">of <span id="metricDriversTotal">{{ number_format($staffMetrics['drivers']['total']) }}</span> registered</div>
            </article>
            <article class="stat-card">
                <div class="stat-card__label">Active medics</div>
                <div class="stat-card__value" id="metricMedicsOnline">{{ number_format($staffMetrics['medics']['active']) }}</div>
                <div class="stat-card__sub">of <span id="metricMedicsTotal">{{ number_format($staffMetrics['medics']['total']) }}</span> roster</div>
            </article>
            <article class="stat-card">
                <div class="stat-card__label">Ambulances</div>
                <div class="stat-card__value" id="metricAmbulancesAvailable">{{ number_format($systemMetrics['ambulances']['available']) }}</div>
                <div class="stat-card__sub" id="metricAmbulancesSummary">{{ $ambulanceText }}</div>
            </article>
            <article class="stat-card">
                <div class="stat-card__label">Total cases since launch</div>
                <div class="stat-card__value" id="metricTotalCases">{{ number_format($caseMetrics['total']) }}</div>
                <div class="stat-card__sub">Cumulative deployments</div>
            </article>
        </section>
        <section class="mini-grid">
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
                    <ul class="list">
                        <li>Pending <span id="queuePendingLabel">{{ number_format($caseMetrics['pending']) }}</span></li>
                        <li>Active <span id="queueActiveLabel">{{ number_format($caseMetrics['active']) }}</span></li>
                        <li>Completed today <span id="queueCompletedLabel">{{ number_format($caseMetrics['completed']) }}</span></li>
                    </ul>
                </div>
            </article>
            <article class="mini-panel">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <h4 style="margin:0;">Queue snapshot</h4>
                    <span style="font-size:0.8rem; text-transform:uppercase; color:var(--muted);">Live</span>
                </div>
                <ul class="list">
                    <li>Dispatch ready <span id="queue-pending">{{ number_format($caseMetrics['pending']) }}</span></li>
                    <li>On route <span id="queue-active">{{ number_format($caseMetrics['active']) }}</span></li>
                </ul>
            </article>
            <article class="mini-panel">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <h4 style="margin:0;">Quick actions</h4>
                    <i class="fas fa-arrow-trend-up" style="color:var(--accent);"></i>
                </div>
                <a class="quick-link" href="{{ route('dashboard.view') }}">
                    Dashboard display
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a class="quick-link" href="{{ route('admin.reports') }}">
                    Completed missions
                    <i class="fas fa-file-lines"></i>
                </a>
                <a class="quick-link" href="{{ url('/admin/pairing') }}">
                    Pair crews fast
                    <i class="fas fa-link"></i>
                </a>
            </article>
            <article class="mini-panel">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <h4 style="margin:0;">Ops notes</h4>
                    <i class="fas fa-info-circle" style="color:var(--warning);"></i>
                </div>
                <p style="margin:0; color:var(--muted); font-weight:600; line-height:1.5;">
                    • Keep at least 3 ambulances on standby during peak hours.<br>
                    • Encourage medics to update statuses via the mobile app.<br>
                    • Export detailed logs from the Reports page for end-of-day summaries.
                </p>
            </article>
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

