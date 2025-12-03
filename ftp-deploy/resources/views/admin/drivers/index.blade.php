<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Driver Management - MDRRMO</title>
    <link rel="stylesheet" href="{{ asset('css/stylish.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .card { background:#fff; border-radius:16px; box-shadow:0 10px 30px rgba(3,18,115,.08); border:1px solid #eef2f7; overflow:hidden; }
        .card-header { display:flex; align-items:center; justify-content:space-between; padding:16px 20px; background:linear-gradient(180deg,#f9fafb 0%, #f3f4f6 100%); border-bottom:1px solid #eef2f7; }
        .table-elegant { width:100%; border-collapse:separate; border-spacing:0; }
        /* .table-elegant thead th { position:sticky; top:0; z-index:5; background:#f9fafb; font-size:12px; letter-spacing:.06em; text-transform:uppercase; color:#6b7280; padding:14px 20px; border-bottom:1px solid #eef2f7; } */
        .table-elegant tbody tr { transition: background .15s ease; }
        .table-elegant tbody tr:hover { background:#f9fafb; }
        .table-elegant tbody tr:nth-child(even) { background:#fcfdff; }
        .row-online { box-shadow: inset 4px 0 0 0 #10b981; }
        .table-elegant td { padding:14px 20px; border-bottom:1px solid #e6ecf5; vertical-align:middle; }
        .table-elegant tbody tr:last-child td { border-bottom: 0; }
        .table-elegant tbody tr:hover td { border-bottom-color:#dfe7f3; }
        .chip { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; font-size:12px; font-weight:600; border-radius:999px; border:1px solid transparent; }
        .chip-blue { background:#eff6ff; color:#1d4ed8; border-color:#bfdbfe; }
        .chip-green { background:#ecfdf5; color:#047857; border-color:#a7f3d0; }
        .chip-gray { background:#f3f4f6; color:#374151; border-color:#e5e7eb; }
        .chip-yellow { background:#fffbeb; color:#92400e; border-color:#fde68a; }
        .chip-red { background:#fef2f2; color:#991b1b; border-color:#fecaca; }
        .avatar { width:44px; height:44px; border-radius:999px; object-fit:cover; box-shadow:0 2px 8px rgba(0,0,0,.08); }
        .avatar-fallback { width:44px; height:44px; border-radius:999px; display:grid; place-items:center; background:linear-gradient(135deg,#3b82f6 0%, #6366f1 100%); color:#fff; font-weight:800; box-shadow:0 2px 8px rgba(0,0,0,.08); }
        .table-wrap { max-height:70vh; overflow:auto; }
        .sticky-shadow { box-shadow: 0 2px 0 rgba(0,0,0,0.03); }

        /* Action buttons visible by default */
        .actions .btn-icon { display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:10px; border:1px solid #e5e7eb; background:#f8fafc; transition: all .15s ease; }
        .actions .btn-icon i { font-size:14px; }
        .actions .btn-icon:hover { background:#eef2f7; box-shadow:0 2px 8px rgba(0,0,0,.06); transform: translateY(-1px); }
        .actions .btn-blue { color:#1d4ed8; border-color:#c7d2fe; background:#eef2ff; }
        .actions .btn-indigo { color:#4f46e5; border-color:#c7d2fe; background:#eef2ff; }
        .actions .btn-green { color:#047857; border-color:#a7f3d0; background:#ecfdf5; }
        .actions .btn-red { color:#b91c1c; border-color:#fecaca; background:#fef2f2; }
        .driver-card {
            transition: all 0.3s ease;
            border-left: 4px solid #3b82f6;
        }
        .driver-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        .status-online { background-color: #10b981; }
        .status-offline { background-color: #6b7280; }
        .status-busy { background-color: #ef4444; }
        .status-on-break { background-color: #f59e0b; }
        .photo-placeholder {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }
        .license-expired {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
        }
        .license-expiring {
            background-color: #fffbeb;
            border-color: #fed7aa;
            color: #d97706;
        }

        /* New Analytics Design */
        .analytics-containers {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 30px;
            position: relative;
            min-height: 300px;
            max-width: 1200px;
            width: 93%;
            margin-left: auto;
            margin-right: auto;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        }
        .analytics-containers::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #f59e0b 0%, #f97316 100%);
            border-radius: 24px 24px 0 0;
        }

        .analytics-header {
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            border: none;
            border-radius: 16px;
            padding: 16px 24px;
            margin-bottom: 24px;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.3);
        }

        .analytics-header h3 {
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.3px;
            margin: 0;
        }

        .analytics-controls {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .analytics-filter-controls {
            display: flex;
            justify-content: flex-end;
        }

        .analytics-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .analytics-search {
            position: relative;
        }

        .analytics-search input {
            background: #fff;
            border: 2px solid #000;
            border-radius: 25px;
            padding: 12px 20px;
            width: 500px;
            font-size: 14px;
            color: #333;
            outline: none;
            margin-top: -3px;
        }

        .analytics-search input::placeholder {
            color: #666;
            font-weight: 500;
        }

        .btn-analytics {
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            border: none;
            color: #fff;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.3);
        }

        .btn-analytics:hover {
            filter: brightness(1.02);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.4);
        }
        /* Make select (ALL) same orange style with custom arrow */
        select.btn-analytics {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: linear-gradient(120deg, #f6ad2e 0%, #d97706 100%) !important;
            color: #ffffff !important;
            padding-right: 38px; /* room for arrow */
            position: relative;
            box-shadow: inset 0 -2px 0 rgba(0,0,0,0.18);
        }
        /* white arrow on the right */
        select.btn-analytics:not(.oval) {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23ffffff' d='M1.41.59L6 5.17 10.59.59 12 2 6 8 0 2z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px 8px;
        }
        select.btn-analytics.oval {
            background-image: none;
        }
        .btn-analytics option { background:#f59e0b; color:#000; }

        .btn-analytics.oval {
            border-radius: 20px;
            padding: 10px 45px 10px 25px;
            margin-bottom: 20px;
            line-height: 1.5;
            vertical-align: middle;
        }

        .analytics-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-top: 16px;
        }

        .analytics-stat-card {
            position: relative;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 18px;
            text-align: center;
            color: #1f2937;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            min-height: 110px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: box-shadow .2s ease, transform .2s ease;
        }
        .analytics-stat-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #f59e0b 0%, #f97316 100%);
            border-radius: 16px 16px 0 0;
        }
        .analytics-stat-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }

        .analytics-stat-title {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .03em;
            margin-bottom: 6px;
            color: #6b7280;
            text-transform: uppercase;
        }

        .analytics-stat-value {
            font-size: 28px;
            font-weight: 700;
            line-height: 1;
            color: #111827;
        }

        @media (max-width: 768px) {
            .analytics-controls {
                flex-direction: column;
                gap: 20px;
            }
            
            .analytics-search input {
                width: 100%;
            }

            .analytics-filter-controls {
                justify-content: center;
            }
            
            .analytics-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .analytics-stats {
                grid-template-columns: 1fr;
            }
        }

        /* Driver Directory Design */
        .directory-container {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 30px;
            position: relative;
            max-width: 1200px;
            width: 93%;
            margin-left: auto;
            margin-right: auto;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        }
        .directory-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #f59e0b 0%, #f97316 100%);
            border-radius: 24px 24px 0 0;
        }

        .directory-header {
            font-size: 20px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .directory-table-container {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            overflow: hidden;
            /* Let tbody handle scrolling so scrollbar starts below header */
            max-height: none;
            padding-right: 0;
            scrollbar-gutter: stable;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        .directory-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            table-layout: fixed; /* fixed columns for block header/body */
        }

        /* Keep columns aligned when body scrolls */
        .directory-table thead, .directory-table tbody { display: block; }
        .directory-table thead {
            padding-right: 0; /* match container width; no extra header overhang */
            border: none; /* remove orange border */
            border-bottom: 3px solid #f59e0b; /* keep only bottom line */
            background: #ffffff;
        }
        .directory-table tbody {
            max-height: 62vh; /* scrolling area height */
            overflow-y: auto;
            scrollbar-gutter: stable; /* keep header and body columns aligned without header padding */
            border-top: none; /* remove extra top orange line over data */
        }
        .directory-table tbody tr:first-child { border-top: none; }
        /* Column widths for clean alignment */
        .directory-table thead th:nth-child(1), .directory-table tbody td:nth-child(1) { width: 18%; }
        .directory-table thead th:nth-child(2), .directory-table tbody td:nth-child(2) { width: 24%; }
        .directory-table thead th:nth-child(3), .directory-table tbody td:nth-child(3) { width: 18%; }
        .directory-table thead th:nth-child(4), .directory-table tbody td:nth-child(4) { width: 16%; }
        .directory-table thead th:nth-child(5), .directory-table tbody td:nth-child(5) { width: 16%; }
        .directory-table thead th:nth-child(6), .directory-table tbody td:nth-child(6) { width: 8%; }

        .directory-table thead th {
            background: #ffffff;
            border-bottom: 2px solid #f3f4f6;
            padding: 15px 12px;
            text-align: center;
            font-weight: 700;
            font-size: 13px;
            color: #1f2937;
            letter-spacing: 0.3px;
            position: relative;
            z-index: 5;
        }

        .directory-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
        }

        .directory-table tbody tr:last-child {
            border-bottom: none;
        }

        .directory-table td {
            padding: 15px 12px;
            vertical-align: middle;
            text-align: center;
        }

        .driver-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .driver-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #f59e0b;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
        }

        .driver-avatar i {
            font-size: 26px;
            color: #1f2937;
        }

        .driver-name {
            font-weight: 600;
            color: #000;
            font-size: 14px;
        }

        .driver-badge {
            background: linear-gradient(135deg, #2563eb 0%, #1e3a8a 100%);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }

        .contact-info {
            color: #000;
            font-weight: 500;
            font-size: 14px;
        }

        .license-info {
            color: #000;
            font-weight: 500;
            font-size: 14px;
        }

        .status-badge {
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.3px;
            color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }

        .status-active {
            background: #1e3a8a;
        }

        .status-online {
            background: #10b981;
        }

        .status-offline {
            background: #6b7280;
        }

        .status-busy {
            background: #ef4444;
        }

        .status-on-break {
            background: #f59e0b;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 6px;
            align-items: center;
        }

        .action-btn {
            width: 35px;
            height: 25px;
            border: 1px solid #000;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .action-btn-blue {
            background: #1e3a8a;
            color: #fff;
        }

        .action-btn-green {
            background: #10b981;
            color: #fff;
        }

        .action-btn-red {
            background: #ef4444;
            color: #fff;
        }

        /* Scrollbar styling */
        .directory-table-container::-webkit-scrollbar {
            width: 8px;
        }

        .directory-table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .directory-table-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .directory-table-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Modal Button Hover Effects */
        .modal-cancel-btn:hover {
            transform: scale(1.05);
            border-color: #d1d5db;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            color: #ffffff !important;
        }

        .modal-logout-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(239,68,68,0.4);
        }
    </style>
    <style>
:root {
    --drivers-bg: radial-gradient(circle at top, #f8f1ff 0%, #eef2ff 45%, #f5f7fb 100%);
    --drivers-card: #ffffff;
    --drivers-border: #e2e8f0;
    --drivers-muted: #6b7280;
    --drivers-primary: #2563eb;
    --drivers-accent: #7c3aed;
    --drivers-danger: #dc2626;
}
html, body {
    min-height: 100vh;
    font-family: 'Nunito', 'Segoe UI', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    background: var(--drivers-bg);
    color: #0f172a;
}
.maincontentt {
    margin-left: 260px;
    width: calc(100% - 260px);
    padding: 2.5rem clamp(1.25rem, 3vw, 3rem) 3.5rem;
    padding-top: calc(var(--header-height) + 2.5rem);
    box-sizing: border-box;
}
.drivers-page-container {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 1.75rem;
}
.hero-card {
    background: var(--drivers-card);
    border-radius: 28px;
    padding: clamp(1.75rem, 3vw, 2.75rem);
    border: 1px solid rgba(124, 58, 237, 0.12);
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: clamp(1rem, 3vw, 2.5rem);
    box-shadow: 0 30px 60px rgba(15,23,42,0.12);
}
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.35rem 0.85rem;
    border-radius: 999px;
    background: rgba(37,99,235,0.1);
    color: var(--drivers-primary);
    font-size: 0.8rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}
.hero-card h3 {
    margin: 0.4rem 0 0;
    font-size: clamp(1.6rem, 4vw, 2.35rem);
    font-weight: 900;
}
.hero-card p {
    margin-top: 0.4rem;
    color: var(--drivers-muted);
    line-height: 1.5;
}
.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.7rem;
    margin-top: 1rem;
}
.hero-actions a,
.hero-actions button {
    border: none;
    border-radius: 12px;
    padding: 0.8rem 1.3rem;
    font-weight: 800;
    font-size: 0.9rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    text-decoration: none;
}
.hero-actions .primary {
    background: linear-gradient(135deg, var(--drivers-primary), var(--drivers-accent));
    color: #fff;
    box-shadow: 0 15px 35px rgba(124,58,237,0.35);
}
.hero-actions .ghost {
    background: rgba(15,23,42,0.05);
    color: #0f172a;
}
.hero-actions .primary:hover,
.hero-actions .ghost:hover {
    transform: translateY(-2px);
}
.hero-metrics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 0.8rem;
}
.hero-metric-card {
    background: rgba(124, 58, 237, 0.08);
    border-radius: 18px;
    padding: 1rem;
    border: 1px solid rgba(124, 58, 237, 0.2);
}
.hero-metric-card span {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-weight: 700;
    color: #4338ca;
}
.hero-metric-card strong {
    display: block;
    margin-top: 0.3rem;
    font-size: 1.7rem;
    font-weight: 900;
    color: #1e1b4b;
}
.filters-card {
    background: var(--drivers-card);
    border-radius: 24px;
    padding: 1.75rem;
    border: 1px solid var(--drivers-border);
    box-shadow: 0 20px 50px rgba(15,23,42,0.08);
}
.filters-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
    flex-wrap: wrap;
}
.filters-chip {
    padding: 0.35rem 0.9rem;
    border-radius: 999px;
    background: rgba(37,99,235,0.1);
    color: var(--drivers-primary);
    font-weight: 700;
    font-size: 0.8rem;
}
.filters-grid {
    margin-top: 1.25rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
}
.filter-field {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}
.filter-field span {
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    font-weight: 800;
    color: var(--drivers-muted);
}
.filter-input,
.filter-select {
    border-radius: 14px;
    border: 1.5px solid rgba(148,163,184,0.5);
    padding: 0.65rem 0.85rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: #0f172a;
    background: #f8fafc;
    transition: border 0.2s ease, box-shadow 0.2s ease;
}
.filter-input:focus,
.filter-select:focus {
    outline: none;
    border-color: var(--drivers-primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
    background: #fff;
}
.table-card {
    background: var(--drivers-card);
    border-radius: 26px;
    border: 1px solid var(--drivers-border);
    box-shadow: 0 25px 60px rgba(15,23,42,0.12);
}
.table-card-header {
    padding: 1.5rem 1.75rem;
    border-bottom: 1px solid rgba(226,232,240,0.8);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
    flex-wrap: wrap;
}
.table-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem;
}
.table-actions button,
.table-actions a {
    border: none;
    border-radius: 12px;
    padding: 0.55rem 1rem;
    font-weight: 700;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    cursor: pointer;
    background: #f1f5f9;
    color: #0f172a;
    text-decoration: none;
    transition: transform 0.2s ease;
}
.table-actions .primary {
    background: linear-gradient(135deg, var(--drivers-primary), var(--drivers-accent));
    color: #fff;
    box-shadow: 0 15px 35px rgba(37,99,235,0.35);
}
.table-actions button:hover,
.table-actions a:hover {
    transform: translateY(-2px);
}
.drivers-table-wrapper {
    overflow-x: auto;
}
.drivers-table {
    width: 100%;
    border-collapse: collapse;
}
.drivers-table thead {
    background: #f8fafc;
}
.drivers-table th {
    text-align: left;
    padding: 0.95rem 1rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--drivers-muted);
    font-weight: 800;
    border-bottom: 1px solid var(--drivers-border);
}
.drivers-table td {
    padding: 1rem;
    border-bottom: 1px solid rgba(226,232,240,0.8);
    vertical-align: top;
}
.drivers-table tbody tr:hover td {
    background: rgba(248,250,252,0.7);
}
.driver-info {
    display: flex;
    gap: 0.75rem;
    align-items: center;
}
.driver-avatar {
    width: 54px;
    height: 54px;
    border-radius: 16px;
    background: linear-gradient(135deg, var(--drivers-primary), var(--drivers-accent));
    color: #fff;
    font-weight: 900;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}
.driver-name {
    font-weight: 800;
    font-size: 1rem;
}
.driver-meta {
    font-size: 0.82rem;
    color: var(--drivers-muted);
}
.status-chip,
.availability-chip {
    border-radius: 999px;
    padding: 0.35rem 0.85rem;
    font-size: 0.8rem;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}
.status-chip.active { background: #ecfdf5; color: #047857; }
.status-chip.inactive { background: #f3f4f6; color: #475569; }
.status-chip.suspended { background: #fef2f2; color: #b91c1c; }
.availability-chip.online { background: rgba(16,185,129,0.15); color: #047857; }
.availability-chip.offline { background: rgba(148,163,184,0.25); color: #475569; }
.availability-chip.busy { background: rgba(239,68,68,0.15); color: #b91c1c; }
.availability-chip.on-break { background: rgba(245,158,11,0.18); color: #92400e; }
.action-chip-group {
    display: flex;
    flex-wrap: wrap;
    gap: 0.35rem;
}
.action-chip {
    border: none;
    border-radius: 999px;
    padding: 0.45rem 0.8rem;
    font-size: 0.78rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    cursor: pointer;
    background: #f1f5f9;
    color: #0f172a;
    text-decoration: none;
    transition: transform 0.15s ease;
}
.action-chip:hover { transform: translateY(-1px); }
.action-chip.view { background: rgba(59,130,246,0.15); color: #1d4ed8; }
.action-chip.edit { background: rgba(124,58,237,0.15); color: #7c3aed; }
.action-chip.logout { background: rgba(16,185,129,0.15); color: #047857; }
.action-chip.delete { background: rgba(239,68,68,0.15); color: #b91c1c; border: 1px dashed rgba(239,68,68,0.4); }
.action-chip.archive { background: rgba(245,158,11,0.15); color: #92400e; border: 1px dashed rgba(245,158,11,0.4); }
.action-chip.restore { background: rgba(16,185,129,0.15); color: #047857; border: 1px dashed rgba(16,185,129,0.4); }
.action-chip button { background: transparent; border: none; }
.archive-meta {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    padding: 0.4rem 0.55rem;
    border-radius: 10px;
    background: rgba(15, 23, 42, 0.04);
    border: 1px solid rgba(148, 163, 184, 0.4);
    font-size: 0.8rem;
    margin-top: 8px;
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
@media (max-width: 1100px) {
    .hero-card { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
    .maincontentt {
        margin-left: 0;
        width: 100%;
        padding: 1.25rem;
        padding-top: calc(var(--header-height) + 1.25rem);
    }
    .table-card-header { flex-direction: column; }
    .hero-actions { flex-direction: column; }
}
    </style>
</head>
@php
    $viewMode = $viewMode ?? 'active';
    $isArchivedView = $viewMode === 'archived';
@endphp
<body data-view-mode="{{ $isArchivedView ? 'archived' : 'active' }}">
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
<div class="mdrrmo-header" style="background:#F7F7F7; box-shadow: 0 2px 8px rgba(0,0,0,0.12); border: none; min-height: var(--header-height); padding: 1rem 2rem; display: flex; align-items: center; justify-content: center;">
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

@php
    $totalDrivers = $drivers->count();
    $onlineDrivers = $drivers->where('availability_status', 'online')->count();
    $expiringDrivers = $drivers->filter(fn($driver) => $driver->isLicenseExpiringSoon())->count();
    $expiredDrivers = $drivers->filter(fn($driver) => $driver->isLicenseExpired())->count();
@endphp

<main class="maincontentt pt-24">
    <div class="drivers-page-container">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <section class="hero-card">
            <div>
                <span class="hero-badge">
                    @if($isArchivedView)
                        <i class="fas fa-box-archive"></i> Archived Drivers
                    @else
                        <i class="fas fa-car-side"></i> Driver command
                    @endif
                </span>
                <h3>{{ $isArchivedView ? 'The archive never forgets.' : 'Every operator ready for the next dispatch. 45454trtrt8743748347SISAdsfsffdfdfdfHS hdsihdsidfdfdf' }}</h3>
                <p>
                    @if($isArchivedView)
                        Browse preserved driver records, revisit driver details, and keep institutional memory within reach.
                    @else
                        Monitor availability, track expiring licenses, and keep your driver roster in top shape from a single dashboard.
                    @endif
                </p>
                <div class="hero-actions">
                    @if(!$isArchivedView)
                        <a href="{{ route('admin.drivers.create') }}" class="primary"><i class="fas fa-user-plus"></i> Add driver</a>
                    @endif
                    <button type="button" class="ghost" id="refreshDriversBtn"><i class="fas fa-sync"></i> Refresh data</button>
                    @if($isArchivedView)
                        <button type="button" class="ghost" onclick="window.location.href='{{ route('admin.drivers.index') }}'"><i class="fas fa-arrow-left"></i> Back to active</button>
                    @else
                        <button type="button" class="ghost" onclick="window.location.href='{{ route('admin.drivers.archived') }}'"><i class="fas fa-box-archive"></i> View archives</button>
                    @endif
                </div>
            </div>
            <div class="hero-metrics">
                <div class="hero-metric-card">
                    <span>{{ $isArchivedView ? 'Total archived' : 'Total drivers' }}</span>
                    <strong>{{ $totalDrivers }}</strong>
                </div>
                @if($isArchivedView)
                    <div class="hero-metric-card">
                        <span>Archived this month</span>
                        <strong>{{ $archivedThisMonth ?? 0 }}</strong>
                    </div>
                    <div class="hero-metric-card">
                        <span>Archived this year</span>
                        <strong>{{ $archivedThisYear ?? 0 }}</strong>
                    </div>
                    <div class="hero-metric-card">
                        <span>Last archived</span>
                        <strong>{{ $lastArchivedDate ?? '—' }}</strong>
                    </div>
                @else
                    <div class="hero-metric-card">
                        <span>Online now</span>
                        <strong>{{ $onlineDrivers }}</strong>
                    </div>
                    <div class="hero-metric-card">
                        <span>License expiring</span>
                        <strong>{{ $expiringDrivers }}</strong>
                    </div>
                    <div class="hero-metric-card">
                        <span>License expired</span>
                        <strong>{{ $expiredDrivers }}</strong>
                    </div>
                @endif
            </div>
        </section>

        <section class="filters-card">
            <div class="filters-header">
                <div>
                    <h5 style="margin:0; font-size:1.1rem; font-weight:900;">Smart filters</h5>
                    <p style="margin:0; color:var(--drivers-muted); font-size:0.9rem;">Find drivers instantly by keyword, availability or status.</p>
                </div>
                <span class="filters-chip" id="filtersStatus">No filters applied</span>
            </div>
            <form id="driversFiltersForm">
                <div class="filters-grid">
                    <label class="filter-field">
                        <span>Search</span>
                        <input type="text" name="q" id="driverSearchInput" value="{{ request('q') }}" class="filter-input" placeholder="Search name, email or ID">
                    </label>
                    <label class="filter-field">
                        <span>Availability</span>
                        <select name="availability" id="availabilitySelect" class="filter-select">
                            <option value="">All</option>
                            <option value="online" {{ request('availability') === 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ request('availability') === 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="busy" {{ request('availability') === 'busy' ? 'selected' : '' }}>Busy</option>
                            <option value="on_break" {{ request('availability') === 'on_break' ? 'selected' : '' }}>On break</option>
                        </select>
                    </label>
                    <label class="filter-field">
                        <span>Status</span>
                        <select name="status" id="statusSelect" class="filter-select">
                            <option value="">All</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                    </label>
                </div>
            </form>
        </section>

        <section class="table-card">
            <div class="table-card-header">
                <div>
                    <h4 style="margin:0; font-size:1.35rem; font-weight:900;">{{ $isArchivedView ? 'Archived drivers directory' : 'Driver directory' }}</h4>
                    <div class="table-meta" style="color:var(--drivers-muted); font-size:0.9rem;">{{ $isArchivedView ? 'Preserved driver records from the archive.' : 'Live roster synced every few seconds.' }}</div>
                </div>
                <div class="table-actions">
                    @if(!$isArchivedView)
                        <a href="{{ route('admin.drivers.create') }}" class="primary"><i class="fas fa-user-plus"></i> Add driver</a>
                    @endif
                    <button type="button" id="exportDriversBtn"><i class="fas fa-file-export"></i> Export CSV</button>
                    @if($isArchivedView)
                        <button type="button" onclick="window.location.href='{{ route('admin.drivers.index') }}'"><i class="fas fa-arrow-left"></i> Back to active</button>
                    @else
                        <button type="button" onclick="window.location.href='{{ route('admin.drivers.archived') }}'"><i class="fas fa-box-archive"></i> View archives</button>
                    @endif
                </div>
            </div>

            <div class="drivers-table-wrapper">
                <table class="drivers-table">
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Contact</th>
                            <th>License</th>
                            <th>Status</th>
                            <th>Availability</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="driversTableBody">
                        @forelse($drivers as $driver)
                            @php
                                $pairedAmbulanceName = $driver->ambulance->name ?? null;
                                if (!$pairedAmbulanceName) {
                                    $activePair = \App\Models\DriverAmbulancePairing::where('driver_id', $driver->id)
                                        ->where('status','active')->orderByDesc('pairing_date')->first();
                                    if ($activePair) {
                                        $pairedAmbulanceName = optional($activePair->ambulance)->name;
                                    }
                                }
                            @endphp
                            <tr data-availability="{{ $driver->availability_status }}" data-status="{{ $driver->status }}">
                                <td>
                                    <div class="driver-info">
                                        <div class="driver-avatar">{{ strtoupper(substr($driver->name, 0, 1)) }}</div>
                                        <div>
                                            <div class="driver-name">{{ $driver->name }}</div>
                                            <div class="driver-meta">
                                                {{ $driver->employee_id ? 'ID: '.$driver->employee_id : 'No ID' }} ·
                                                {{ $pairedAmbulanceName ?? 'Unassigned' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $driver->email }}</div>
                                    @if($driver->phone)
                                        <div class="driver-meta">{{ $driver->phone }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($driver->license_number)
                                        <div>{{ $driver->license_number }}</div>
                                        @if($driver->license_expiry)
                                            <div class="driver-meta">{{ $driver->license_expiry->format('M d, Y') }}</div>
                                        @endif
                                    @else
                                        <div class="driver-meta">No license</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-chip {{ strtolower($driver->status) }}">
                                        {{ ucfirst($driver->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="availability-chip {{ str_replace('_', '-', strtolower($driver->availability_status)) }}">
                                        {{ ucfirst(str_replace('_', ' ', $driver->availability_status)) }}
                                    </span>
                                </td>
                                <td>
                                    @if($isArchivedView)
                                        <div class="action-chip-group">
                                            <a href="{{ route('admin.drivers.show', $driver) }}" class="action-chip view" title="View details">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <button type="button" class="action-chip restore" title="Restore driver" onclick="openRestoreDriverModal({{ $driver->id }}, '{{ addslashes($driver->name) }}')">
                                                <i class="fas fa-undo"></i> Restore
                                            </button>
                                        </div>
                                        @if($driver->archived_at)
                                            <div class="archive-meta">
                                                <span><i class="fas fa-box-archive"></i> Archived {{ $driver->archived_at->format('M d, Y') }}</span>
                                                @if($driver->archiver)
                                                    <span><i class="fas fa-user-shield"></i> {{ $driver->archiver->name }}</span>
                                                @endif
                                                @if($driver->archived_reason)
                                                    <small>Note: {{ $driver->archived_reason }}</small>
                                                @endif
                                            </div>
                                        @endif
                                    @else
                                        <div class="action-chip-group">
                                            <a href="{{ route('admin.drivers.show', $driver) }}" class="action-chip view" title="View details">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('admin.drivers.edit', $driver) }}" class="action-chip edit" title="Edit driver">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button type="button" class="action-chip logout" title="Log out driver" onclick="openForceLogoutModal({{ $driver->id }}, '{{ addslashes($driver->name) }}')">
                                                <i class="fas fa-power-off"></i> Log out
                                            </button>
                                            <button type="button" class="action-chip archive" title="Archive driver" onclick="openArchiveDriverModal({{ $driver->id }}, '{{ addslashes($driver->name) }}')">
                                                <i class="fas fa-box-archive"></i> Archive
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 2.5rem; text-align: center; color: var(--drivers-muted);">
                                    <div style="display:flex; flex-direction:column; gap:0.75rem; align-items:center;">
                                        <i class="fas {{ $isArchivedView ? 'fa-box-archive' : 'fa-users' }}" style="font-size: 2.5rem;"></i>
                                        <strong style="font-size: 1.1rem;">{{ $isArchivedView ? 'No archived drivers found' : 'No drivers found' }}</strong>
                                        <p style="margin:0;">{{ $isArchivedView ? 'No drivers have been archived yet.' : 'Get started by adding your first driver.' }}</p>
                                        @if(!$isArchivedView)
                                            <a href="{{ route('admin.drivers.create') }}" class="hero-actions primary" style="text-decoration:none; padding:0.6rem 1.2rem; font-size:0.9rem;">
                                                <i class="fas fa-plus"></i> Add driver
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<script>
// Force Logout Modal
const modalHtml = `
  <div id="forceLogoutModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); backdrop-filter:blur(4px); -webkit-backdrop-filter:blur(4px); z-index:2000; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:24px; border:1px solid #e5e7eb; box-shadow:0 10px 25px rgba(0,0,0,0.12); width:min(440px, 92vw); position:relative; overflow:hidden;">
      <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(90deg, #f59e0b 0%, #f97316 100%); border-radius:24px 24px 0 0;"></div>
      <div style="padding:18px 20px; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between; margin-top:4px;">
        <div style="font-weight:700; color:#111827;">Log out driver</div>
        <button onclick="closeForceLogoutModal()" style="border:none; background:transparent; font-size:18px; cursor:pointer; color:#6b7280; transition:color 0.2s ease;">✕</button>
      </div>
      <div style="padding:18px 20px; color:#374151;">
        <p id="forceLogoutText" style="margin:0;">Are you sure you want to log out this driver?</p>
      </div>
      <div style="padding:16px 20px; border-top:1px solid #f3f4f6; display:flex; gap:10px; justify-content:flex-end;">
        <button onclick="closeForceLogoutModal()" class="modal-cancel-btn" style="padding:10px 16px; border-radius:10px; border:1px solid #e5e7eb; background:#000000; color:#ffffff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Cancel</button>
        <button id="forceLogoutConfirm" class="modal-logout-btn" style="padding:10px 16px; border-radius:10px; border:none; background:linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color:#fff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Log out</button>
      </div>
    </div>
  </div>`;

// Archive Driver Modal
const archiveModalHtml = `
  <div id="archiveDriverModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); backdrop-filter:blur(4px); -webkit-backdrop-filter:blur(4px); z-index:2000; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:24px; border:1px solid #e5e7eb; box-shadow:0 10px 25px rgba(0,0,0,0.12); width:min(440px, 92vw); position:relative; overflow:hidden;">
      <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(90deg, #f59e0b 0%, #f97316 100%); border-radius:24px 24px 0 0;"></div>
      <div style="padding:18px 20px; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between; margin-top:4px;">
        <div style="font-weight:700; color:#111827;">Archive driver</div>
        <button onclick="closeArchiveDriverModal()" style="border:none; background:transparent; font-size:18px; cursor:pointer; color:#6b7280; transition:color 0.2s ease;">✕</button>
      </div>
      <div style="padding:18px 20px; color:#374151;">
        <p id="archiveDriverText" style="margin:0 0 12px 0;">Are you sure you want to archive this driver?</p>
        <label style="display:block; margin-bottom:8px; font-size:13px; font-weight:600; color:#374151;">Optional note (leave blank to skip):</label>
        <textarea id="archiveDriverReason" placeholder="e.g., Resigned, Contract ended, etc." style="width:100%; min-height:80px; padding:10px; border:1.5px solid #d1d5db; border-radius:8px; font-size:14px; font-family:inherit; resize:vertical; outline:none; transition:border 0.2s ease;" onfocus="this.style.borderColor='#2563eb';" onblur="this.style.borderColor='#d1d5db';"></textarea>
      </div>
      <div style="padding:16px 20px; border-top:1px solid #f3f4f6; display:flex; gap:10px; justify-content:flex-end;">
        <button onclick="closeArchiveDriverModal()" class="modal-cancel-btn" style="padding:10px 16px; border-radius:10px; border:1px solid #e5e7eb; background:#000000; color:#ffffff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Cancel</button>
        <button id="archiveDriverConfirm" class="modal-logout-btn" style="padding:10px 16px; border-radius:10px; border:none; background:linear-gradient(135deg, #f59e0b 0%, #f97316 100%); color:#fff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Archive</button>
      </div>
    </div>
  </div>`;

// Restore Driver Modal
const restoreModalHtml = `
  <div id="restoreDriverModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); backdrop-filter:blur(4px); -webkit-backdrop-filter:blur(4px); z-index:2000; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:24px; border:1px solid #e5e7eb; box-shadow:0 10px 25px rgba(0,0,0,0.12); width:min(440px, 92vw); position:relative; overflow:hidden;">
      <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(90deg, #10b981 0%, #059669 100%); border-radius:24px 24px 0 0;"></div>
      <div style="padding:18px 20px; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between; margin-top:4px;">
        <div style="font-weight:700; color:#111827;">Restore driver</div>
        <button onclick="closeRestoreDriverModal()" style="border:none; background:transparent; font-size:18px; cursor:pointer; color:#6b7280; transition:color 0.2s ease;">✕</button>
      </div>
      <div style="padding:18px 20px; color:#374151;">
        <p id="restoreDriverText" style="margin:0;">Are you sure you want to restore this driver?</p>
      </div>
      <div style="padding:16px 20px; border-top:1px solid #f3f4f6; display:flex; gap:10px; justify-content:flex-end;">
        <button onclick="closeRestoreDriverModal()" class="modal-cancel-btn" style="padding:10px 16px; border-radius:10px; border:1px solid #e5e7eb; background:#000000; color:#ffffff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Cancel</button>
        <button id="restoreDriverConfirm" class="modal-logout-btn" style="padding:10px 16px; border-radius:10px; border:none; background:linear-gradient(135deg, #10b981 0%, #059669 100%); color:#fff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Restore</button>
      </div>
    </div>
  </div>`;

document.addEventListener('DOMContentLoaded', function(){
  if (!document.getElementById('forceLogoutModal')) {
    const wrap = document.createElement('div');
    wrap.innerHTML = modalHtml;
    document.body.appendChild(wrap.firstElementChild);
  }
  if (!document.getElementById('archiveDriverModal')) {
    const wrap = document.createElement('div');
    wrap.innerHTML = archiveModalHtml;
    document.body.appendChild(wrap.firstElementChild);
  }
  if (!document.getElementById('restoreDriverModal')) {
    const wrap = document.createElement('div');
    wrap.innerHTML = restoreModalHtml;
    document.body.appendChild(wrap.firstElementChild);
  }
});

let selectedDriverId = null;
function openForceLogoutModal(driverId, name){
  selectedDriverId = driverId;
  const modal = document.getElementById('forceLogoutModal');
  const text = document.getElementById('forceLogoutText');
  if (text) text.textContent = `Are you sure you want to log out ${name}?`;
  modal.style.display = 'flex';
  const btn = document.getElementById('forceLogoutConfirm');
  if (btn) {
    btn.onclick = submitForceLogout;
  }
}
function closeForceLogoutModal(){
  const modal = document.getElementById('forceLogoutModal');
  if (modal) modal.style.display = 'none';
}
async function submitForceLogout(){
  if (!selectedDriverId) return;
  try {
    const res = await fetch(`/admin/drivers/${selectedDriverId}/force-logout`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Content-Type': 'application/json'
      }
    });
    const data = await res.json();
    if (data && data.success){
      closeForceLogoutModal();
      alert('Driver has been logged out successfully.');
      location.reload();
    } else {
      alert('Failed to log out driver.');
    }
  } catch (e) {
    alert('Failed to log out driver.');
  }
}

// Archive Driver Modal Functions
let selectedArchiveDriverId = null;
function openArchiveDriverModal(driverId, name){
  selectedArchiveDriverId = driverId;
  const modal = document.getElementById('archiveDriverModal');
  const text = document.getElementById('archiveDriverText');
  const reasonInput = document.getElementById('archiveDriverReason');
  if (text) text.textContent = `Are you sure you want to archive ${name}? This will remove them from the active drivers list but keep their record in the archives.`;
  if (reasonInput) reasonInput.value = '';
  if (modal) modal.style.display = 'flex';
  const btn = document.getElementById('archiveDriverConfirm');
  if (btn) {
    btn.onclick = submitArchiveDriver;
  }
}
function closeArchiveDriverModal(){
  const modal = document.getElementById('archiveDriverModal');
  if (modal) modal.style.display = 'none';
  selectedArchiveDriverId = null;
  const reasonInput = document.getElementById('archiveDriverReason');
  if (reasonInput) reasonInput.value = '';
}
async function submitArchiveDriver(){
  if (!selectedArchiveDriverId) return;
  const reasonInput = document.getElementById('archiveDriverReason');
  const reason = reasonInput ? reasonInput.value.trim() : '';
  
  try {
    const res = await fetch(`/admin/drivers/${selectedArchiveDriverId}/archive`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        reason: reason || null
      })
    });
    const data = await res.json();
    if (data && data.success){
      closeArchiveDriverModal();
      alert('Driver has been archived successfully.');
      location.reload();
    } else {
      alert(data.message || 'Failed to archive driver.');
    }
  } catch (e) {
    console.error('Archive error:', e);
    alert('Failed to archive driver.');
  }
}

// Restore Driver Modal Functions
let selectedRestoreDriverId = null;
function openRestoreDriverModal(driverId, name){
  selectedRestoreDriverId = driverId;
  const modal = document.getElementById('restoreDriverModal');
  const text = document.getElementById('restoreDriverText');
  if (text) text.textContent = `Are you sure you want to restore ${name}? This will move them back to the active drivers list.`;
  if (modal) modal.style.display = 'flex';
  const btn = document.getElementById('restoreDriverConfirm');
  if (btn) {
    btn.onclick = submitRestoreDriver;
  }
}
function closeRestoreDriverModal(){
  const modal = document.getElementById('restoreDriverModal');
  if (modal) modal.style.display = 'none';
  selectedRestoreDriverId = null;
}
async function submitRestoreDriver(){
  if (!selectedRestoreDriverId) return;
  
  try {
    const res = await fetch(`/admin/drivers/${selectedRestoreDriverId}/restore`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      }
    });
    const data = await res.json();
    if (data && data.success){
      closeRestoreDriverModal();
      alert('Driver has been restored successfully.');
      location.reload();
    } else {
      alert(data.message || 'Failed to restore driver.');
    }
  } catch (e) {
    console.error('Restore error:', e);
    alert('Failed to restore driver.');
  }
}
function toggleSidebar() {
    const sidenav = document.getElementById('sidenav');
    if (!sidenav) return;
    sidenav.classList.toggle('active');
}

// User menu toggle + AJAX logout redirect to login
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

// Smart filters + export
(function(){
  const availabilitySelect = document.getElementById('availabilitySelect');
  const statusSelect = document.getElementById('statusSelect');
  const searchInput = document.getElementById('driverSearchInput');
  const filtersStatus = document.getElementById('filtersStatus');

  const normalize = text => String(text || '').toLowerCase().trim();

  function updateFiltersChip(activeCount){
    if (!filtersStatus) return;
    filtersStatus.textContent = activeCount ? `${activeCount} filter${activeCount > 1 ? 's' : ''} active` : 'No filters applied';
  }

  function filterRows(){
    const rows = document.querySelectorAll('#driversTableBody tr');
    if (!rows.length) return;
    const availability = normalize(availabilitySelect?.value);
    const status = normalize(statusSelect?.value);
    const query = normalize(searchInput?.value);
    let activeFilters = 0;
    if (availability) activeFilters++;
    if (status) activeFilters++;
    if (query) activeFilters++;
    updateFiltersChip(activeFilters);

    rows.forEach(row => {
      let visible = true;
      const rowAvail = normalize(row.dataset.availability);
      const rowStatus = normalize(row.dataset.status);
      if (availability && rowAvail !== availability) visible = false;
      if (visible && status && rowStatus !== status) visible = false;
      if (visible && query && !normalize(row.textContent).includes(query)) visible = false;
      row.style.display = visible ? '' : 'none';
    });
  }

  [availabilitySelect, statusSelect].forEach(select => {
    if (select) select.addEventListener('change', filterRows);
  });

  if (searchInput) {
    let t;
    searchInput.addEventListener('input', () => {
      clearTimeout(t);
      t = setTimeout(filterRows, 140);
    });
  }

  document.getElementById('driversFiltersForm')?.addEventListener('submit', e => e.preventDefault());
  filterRows();

  document.getElementById('refreshDriversBtn')?.addEventListener('click', () => window.location.reload());

  document.getElementById('exportDriversBtn')?.addEventListener('click', () => {
    const rows = Array.from(document.querySelectorAll('#driversTableBody tr')).filter(row => row.style.display !== 'none');
    if (!rows.length) {
      alert('No drivers to export with the current filters.');
      return;
    }
    const headers = ['Driver','Contact','License','Status','Availability'];
    const csvRows = rows.map(row => {
      const cells = row.querySelectorAll('td');
      return [
        cells[0]?.innerText.trim() || '',
        cells[1]?.innerText.trim() || '',
        cells[2]?.innerText.trim() || '',
        cells[3]?.innerText.trim() || '',
        cells[4]?.innerText.trim() || '',
      ];
    });
    const csv = [headers, ...csvRows].map(r => r.map(val => `"${val.replace(/"/g, '""')}"`).join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = `drivers-${new Date().toISOString().slice(0,10)}.csv`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    setTimeout(() => URL.revokeObjectURL(url), 400);
  });
})();

function toggleAvailability(driverId) {
    if (confirm('Are you sure you want to toggle this driver\'s availability?')) {
        fetch(`/admin/drivers/${driverId}/toggle-availability`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating availability');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating availability');
        });
    }
}

// Auto-refresh the page every 10 seconds to reflect live statuses
setInterval(function(){
  try { 
    // Avoid interrupting form interactions
    const anyModalOpen = document.getElementById('forceLogoutModal') && document.getElementById('forceLogoutModal').style.display === 'flex';
    if (!anyModalOpen) {
      location.reload();
    }
  } catch(e) { location.reload(); }
}, 10000);
</script>
</body>
</html>