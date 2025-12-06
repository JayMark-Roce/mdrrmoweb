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

        @media (max-width: 1024px) {
            .analytics-containers {
                width: 98%;
                padding: 24px;
            }
        }

        @media (max-width: 768px) {
            .analytics-containers {
                width: 100%;
                padding: 20px;
                border-radius: 16px;
                margin-bottom: 20px;
            }
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
            max-width: 100%;
            font-size: 14px;
            color: #333;
            outline: none;
            margin-top: -3px;
        }

        @media (max-width: 768px) {
            .analytics-search input {
                width: 100%;
            }
            .analytics-controls {
                flex-direction: column;
                gap: 15px;
            }
            .analytics-filter-controls {
                width: 100%;
            }
            .analytics-buttons {
                flex-wrap: wrap;
                width: 100%;
            }
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
            .hero-metrics {
                grid-template-columns: 1fr !important;
            }
            .hero-metric-card strong {
                font-size: 1.2rem !important;
            }
            .directory-panel {
                border-radius: 16px !important;
            }
            .directory-panel__header {
                padding: 1rem 1.25rem 0.75rem !important;
            }
            .directory-panel__search {
                padding: 0 1.25rem 0.75rem !important;
            }
            .directory-panel__body {
                padding: 0 1.25rem 1.25rem !important;
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

        @media (max-width: 1024px) {
            .directory-container {
                width: 98%;
                padding: 24px;
            }
        }

        @media (max-width: 768px) {
            .directory-container {
                width: 100%;
                padding: 20px;
                border-radius: 16px;
                margin-bottom: 20px;
            }
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

        @media (max-width: 768px) {
            .directory-table-container {
                border-radius: 12px;
            }
            .directory-table thead th,
            .directory-table td {
                padding: 10px 8px;
                font-size: 12px;
            }
            .directory-table thead th:nth-child(1), .directory-table tbody td:nth-child(1) { width: 20%; }
            .directory-table thead th:nth-child(2), .directory-table tbody td:nth-child(2) { width: 22%; }
            .directory-table thead th:nth-child(3), .directory-table tbody td:nth-child(3) { width: 18%; }
            .directory-table thead th:nth-child(4), .directory-table tbody td:nth-child(4) { width: 18%; }
            .directory-table thead th:nth-child(5), .directory-table tbody td:nth-child(5) { width: 14%; }
            .directory-table thead th:nth-child(6), .directory-table tbody td:nth-child(6) { width: 8%; }
            .driver-profile {
                gap: 4px;
            }
            .driver-avatar {
                width: 45px;
                height: 45px;
            }
            .driver-avatar i {
                font-size: 20px;
            }
            .driver-name {
                font-size: 12px;
            }
            .action-buttons {
                gap: 4px;
            }
            .action-btn {
                width: 30px;
                height: 22px;
                font-size: 10px;
            }
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

        .sidenav {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width, 17.2%);
            min-width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #031273 0%, #1e3a8a 100%);
            z-index: 1100;
            overflow-y: auto;
            transition: transform 0.3s ease;
            box-shadow: 15px 0 35px rgba(15, 23, 42, 0.35);
        }

        @media (max-width: 1024px) {
            .sidenav {
                width: 280px;
                transform: translateX(-100%);
            }
            .sidenav.active {
                transform: translateX(0);
            }
            .mdrrmo-header {
                left: 0 !important;
                width: 100% !important;
            }
        }

        @media (max-width: 768px) {
            .sidenav {
                width: 100%;
                max-width: 320px;
            }
        }

        .toggle-btn {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 1101;
            background: linear-gradient(135deg, #031273 0%, #1e3a8a 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            width: 48px;
            height: 48px;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 1024px) {
            .toggle-btn {
                display: flex;
            }
        }

        .sidenav-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1099;
            backdrop-filter: blur(2px);
        }

        @media (max-width: 1024px) {
            .sidenav.active + .sidenav-overlay,
            .sidenav-overlay.active {
                display: block;
            }
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

        @media (max-width: 768px) {
            .nav-links {
                padding: 1rem 0.75rem 1.5rem;
            }
            .nav-links a,
            .nav-links span {
                font-size: 0.9rem;
                padding: 0.65rem 0.85rem;
            }
            .logo-container {
                padding: 1rem 0.75rem !important;
            }
            .logo-container img {
                max-width: 80px !important;
            }
            #sidebarDateTime {
                font-size: 0.75rem !important;
            }
        }

        /* Modal Responsiveness */
        @media (max-width: 768px) {
            #forceLogoutModal > div,
            #archiveDriverModal > div,
            #restoreDriverModal > div,
            #editAmbulanceDashboardModal > div,
            #editMedicDashboardModal > div,
            #archiveMedicDashboardModal > div {
                width: 95vw !important;
                margin: 1rem !important;
            }
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
    --header-height: 70px;
    --sidebar-width: 17.2%;
}
html, body {
    min-height: 100vh;
    font-family: 'Nunito', 'Segoe UI', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    background: var(--drivers-bg);
    color: #0f172a;
    overflow-x: hidden;
    width: 100%;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

* {
    box-sizing: border-box;
}
.maincontentt {
    margin-left: var(--sidebar-width, 17.2%);
    width: calc(100% - var(--sidebar-width, 17.2%));
    padding: 2.5rem clamp(1.25rem, 3vw, 3rem) 3.5rem;
    padding-top: calc(var(--header-height, 70px) + 2.5rem);
    box-sizing: border-box;
    transition: margin-left 0.3s ease, width 0.3s ease;
    min-width: 0;
    overflow-x: hidden;
}

@media (max-width: 1024px) {
    .maincontentt {
        margin-left: 0;
        width: 100%;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: calc(var(--header-height, 70px) + 1.5rem);
    }
}
.drivers-page-container {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 1.75rem;
    width: 100%;
    box-sizing: border-box;
    padding: 0;
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
    width: 100%;
    box-sizing: border-box;
    overflow: hidden;
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
    width: 100%;
    box-sizing: border-box;
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
    width: 100%;
    box-sizing: border-box;
    overflow: hidden;
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
    -webkit-overflow-scrolling: touch;
}

@media (max-width: 768px) {
    .drivers-table-wrapper {
        margin: 0 -1rem;
        padding: 0 1rem;
    }
    .drivers-table {
        min-width: 600px;
    }
    .drivers-table th,
    .drivers-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.85rem;
    }
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
.operations-grid {
    background: transparent;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
    gap: 1.5rem;
    width: 100%;
    box-sizing: border-box;
}
.directory-panel {
    background: var(--drivers-card);
    border-radius: 26px;
    border: 1px solid rgba(226,232,240,0.8);
    box-shadow: 0 25px 60px rgba(15,23,42,0.08);
    display: flex;
    flex-direction: column;
    min-height: 420px;
    position: relative;
    overflow: hidden;
    width: 100%;
    box-sizing: border-box;
}
.directory-panel::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(37,99,235,0.12), transparent 50%);
    pointer-events: none;
}
.directory-panel__header {
    padding: 1.5rem 1.75rem 1rem;
    position: relative;
    z-index: 1;
}
.directory-panel__title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.directory-panel__title h4 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 900;
}
.directory-panel__meta {
    margin-top: 0.4rem;
    color: var(--drivers-muted);
    font-size: 0.9rem;
}
.directory-panel__actions {
    margin-top: 1rem;
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem;
}
.directory-panel__actions a {
    border-radius: 999px;
    background: rgba(15,23,42,0.06);
    padding: 0.45rem 0.95rem;
    font-weight: 700;
    font-size: 0.8rem;
    text-decoration: none;
    color: #0f172a;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    transition: background 0.2s ease;
}
.directory-panel__actions a:hover {
    background: rgba(37,99,235,0.12);
    color: var(--drivers-primary);
}
.directory-panel__stats {
    margin-top: 1rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));
    gap: 0.5rem;
}
.mini-stat {
    background: rgba(15,23,42,0.04);
    border: 1px solid rgba(148,163,184,0.25);
    border-radius: 16px;
    padding: 0.65rem 0.75rem;
}
.mini-stat span {
    display: block;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--drivers-muted);
    margin-bottom: 0.25rem;
}
.mini-stat strong {
    font-size: 1.15rem;
    font-weight: 900;
    color: #0f172a;
}
.directory-panel__search {
    padding: 0 1.75rem 1rem;
    position: relative;
    z-index: 1;
}
.directory-panel__search input {
    width: 100%;
    border-radius: 16px;
    border: 1.5px solid rgba(148,163,184,0.5);
    padding: 0.7rem 1rem;
    font-weight: 600;
    background: #f8fafc;
    transition: border 0.2s ease, box-shadow 0.2s ease;
}
.directory-panel__search input:focus {
    outline: none;
    border-color: var(--drivers-primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
    background: #fff;
}
.directory-panel__body {
    padding: 0 1.75rem 1.75rem;
    position: relative;
    z-index: 1;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.directory-list {
    flex: 1;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 0.9rem;
    padding-right: 0.3rem;
}
.directory-item {
    display: flex;
    align-items: center;
    gap: 0.9rem;
    padding: 0.65rem 0.85rem;
    border-radius: 18px;
    border: 1px solid rgba(226,232,240,0.9);
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(6px);
    box-shadow: 0 12px 22px rgba(15,23,42,0.05);
    transition: transform 0.15s ease, border-color 0.15s ease;
}
.directory-item:hover {
    transform: translateY(-2px);
    border-color: rgba(99,102,241,0.35);
}
.directory-avatar {
    width: 42px;
    height: 42px;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--drivers-primary), var(--drivers-accent));
    color: #fff;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
}
.directory-body {
    flex: 1;
}
.directory-title {
    font-weight: 800;
    font-size: 0.95rem;
}
.directory-meta {
    font-size: 0.8rem;
    color: var(--drivers-muted);
    margin-top: 0.1rem;
}
.directory-status,
.badge-pill {
    border-radius: 999px;
    padding: 0.35rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.badge-pill.med-active { background: #ecfdf5; color: #047857; }
.badge-pill.med-inactive { background: #fef2f2; color: #b91c1c; }
.badge-pill.amb-available { background: rgba(16,185,129,0.16); color: #047857; }
.badge-pill.amb-out { background: rgba(245,158,11,0.2); color: #92400e; }
.badge-pill.amb-unavailable { background: rgba(148,163,184,0.24); color: #475569; }
.directory-empty {
    margin-top: 1rem;
    padding: 1.25rem;
    border: 1px dashed rgba(148,163,184,0.5);
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.35rem;
    color: var(--drivers-muted);
    text-align: center;
    font-weight: 600;
}
@media (max-width: 1100px) {
    .hero-card { grid-template-columns: 1fr; }
}

@media (max-width: 768px) {
    .hero-card {
        padding: 1.5rem !important;
        border-radius: 20px !important;
    }
    .hero-metrics {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 0.6rem !important;
    }
    .hero-metric-card {
        padding: 0.75rem !important;
    }
    .hero-metric-card strong {
        font-size: 1.4rem !important;
    }
    .filters-card {
        padding: 1.25rem !important;
        border-radius: 20px !important;
    }
    .filters-grid {
        grid-template-columns: 1fr !important;
    }
    .table-card {
        border-radius: 20px !important;
    }
    .operations-grid {
        grid-template-columns: 1fr !important;
    }
}
        @media (max-width: 1024px) {
            #userMenu {
                right: 70px !important;
            }
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
            #userMenu {
                right: 12px !important;
                padding: 4px 8px !important;
                font-size: 0.85rem !important;
            }
            #userMenu span:not(.fa) {
                display: none;
            }
            .mdrrmo-header {
                padding: 0.75rem 1rem !important;
            }
        }

        @media (max-width: 480px) {
            #userMenu {
                right: 8px !important;
                top: 12px !important;
            }
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

<!-- Sidenav Overlay -->
<div class="sidenav-overlay" id="sidenavOverlay" onclick="closeSidebar()"></div>

<!-- Sidenav -->
<aside class="sidenav" id="sidenav">
    <div class="logo-container" style="display: flex; flex-direction: column; align-items: center;">
        <img src="{{ asset('image/LOGOMDRRMO.png') }}" alt="Logo" class="logo-img" style="display: block; margin: 0 auto;">
        <div style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 800; color: #ffffff; letter-spacing: .5px;">SILANG MDRRMO</div>
        <div id="sidebarDateTime" style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 600; color: #ffffff; font-size: 0.9rem; letter-spacing: 0.3px; padding: 0 12px;">
            <div id="sidebarDate" style="margin-bottom: 4px; font-weight: 600; font-size: 0.85rem;"></div>
            <div id="sidebarTime" style="font-weight: 800; font-size: 1rem;"></div>
        </div>
    </div>
    <nav class="nav-links">
     <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a href="{{ url('/admin/pairing') }}" class="{{ request()->is('admin/pairing') ? 'active' : '' }}"><i class="fas fa-link"></i> Pairing</a>
      <a href="{{ url('/admin/drivers') }}" class="{{ request()->is('admin/drivers*') ? 'active' : '' }}"><i class="fas fa-car"></i> Personels</a>
      <a href="{{ url('/admin/medics') }}" class="{{ request()->is('admin/medics*') ? 'active' : '' }}"><i class="fas fa-plus"></i> Create</a>
      <a href="{{ url('/admin/gps') }}" class="{{ request()->is('admin/gps') ? 'active' : '' }}"><i class="fas fa-map-marker-alt mr-1"></i> GPS Tracker</a>
      <a href="{{ url('/admin/reports') }}" class="{{ request()->is('admin/reports*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Reports</a>
      <a href="{{ route('reported-cases') }}" class="{{ request()->routeIs('reported-cases') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Reported Cases</a>
    </nav>
</aside>

<!-- Fixed Top Header -->
<div class="mdrrmo-header" style="position: fixed; top: 0; right: 0; width: 100%; background:#F7F7F7; box-shadow: 0 2px 8px rgba(0,0,0,0.12); border: none; min-height: var(--header-height, 70px); padding: 1rem 2rem; display: flex; align-items: center; justify-content: center; z-index: 1000; box-sizing: border-box;">
    <h2 class="header-title" style="display:none;"></h2>
    @php $firstName = explode(' ', auth()->user()->name ?? 'Admin')[0]; @endphp
    <div id="userMenu" style="position: fixed; right: 16px; top: 16px; display: inline-flex; align-items: center; gap: 10px; cursor: pointer; color: #e5e7eb; z-index: 1000; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); padding: 6px 10px; border-radius: 9999px; box-shadow: 0 6px 18px rgba(0,0,0,0.18); backdrop-filter: saturate(140%); transition: right 0.3s ease;">
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

@php
    $totalDrivers = $drivers->count();
    $onlineDrivers = $drivers->where('availability_status', 'online')->count();
    $totalMedics = isset($medics) ? $medics->count() : 0;
    $totalAmbulances = isset($ambulances) ? $ambulances->count() : 0;
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
                        <i class="fas fa-car-side"></i> Driver command 123
                    @endif
                </span>
                <h3>{{ $isArchivedView ? 'The archive never forgets.' : 'Every operator ready for the next dispatch.' }}</h3>
                <p>
                    @if($isArchivedView)
                        Browse preserved driver records, revisit driver details, and keep institutional memory within reach.
                    @else
                        Monitor drivers, medics, and ambulance units from a single command surface.
                    @endif
                </p>
                <div class="hero-actions">
                    <button type="button" class="ghost" id="refreshDriversBtn"><i class="fas fa-sync"></i> Refresh data</button>
                    @if($isArchivedView)
                        <button type="button" class="ghost" onclick="window.location.href='{{ route('admin.drivers.index') }}'"><i class="fas fa-arrow-left"></i> Back to active</button>
                    @else
                       
                    @endif
                </div>
            </div>
            <div class="hero-metrics">
                @if($isArchivedView)
                    <div class="hero-metric-card">
                        <span>Total archived drivers</span>
                        <strong>{{ $totalDrivers }}</strong>
                    </div>
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
                        <span>Drivers</span>
                        <strong>{{ $totalDrivers }}</strong>
                    </div>
                    <div class="hero-metric-card">
                        <span>Drivers online</span>
                        <strong>{{ $onlineDrivers }}</strong>
                    </div>
                    <div class="hero-metric-card">
                        <span>Medics</span>
                        <strong>{{ $totalMedics }}</strong>
                    </div>
                    <div class="hero-metric-card">
                        <span>Ambulances</span>
                        <strong>{{ $totalAmbulances }}</strong>
                    </div>
                @endif
            </div>
        </section>

        <section class="filters-card">
            <div class="filters-header">
                <div>
                    <h5 style="margin:0; font-size:1.1rem; font-weight:900;">Search &amp; Filter</h5>
                    <p style="margin:0; color:var(--drivers-muted); font-size:0.9rem;">Live search drivers by name, contact, ID, availability or status.</p>
                </div>
                <span class="filters-chip" id="filtersStatus">No filters applied</span>
            </div>
            <form id="driversFiltersForm">
                <div class="filters-grid">
                    <label class="filter-field">
                        <span>Search &amp; Filter</span>
                        <input type="text" name="q" id="driverSearchInput" value="{{ request('q') }}" class="filter-input" placeholder="Type to search across this list...">
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
                    <button type="button" id="exportDriversBtn"><i class="fas fa-file-export"></i> Export CSV</button>
                    @if($isArchivedView)
                        <a href="{{ route('admin.drivers.index') }}" class="primary"><i class="fas fa-arrow-left"></i> Back to active</a>
                    @else
                        <a href="{{ route('admin.drivers.archived') }}" class="primary"><i class="fas fa-box-archive"></i> View archives</a>
                    @endif
                </div>
            </div>

            <div class="drivers-table-wrapper">
                <table class="drivers-table">
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Contact</th>
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
                                <td colspan="5" style="padding: 2.5rem; text-align: center; color: var(--drivers-muted);">
                                    <div style="display:flex; flex-direction:column; gap:0.75rem; align-items:center;">
                                        <i class="fas {{ $isArchivedView ? 'fa-box-archive' : 'fa-users' }}" style="font-size: 2.5rem;"></i>
                                        <strong style="font-size: 1.1rem;">{{ $isArchivedView ? 'No archived drivers found' : 'No drivers found' }}</strong>
                                        <p style="margin:0;">{{ $isArchivedView ? 'No drivers have been archived yet.' : 'No driver records match the current filters.' }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        @if(!$isArchivedView && (isset($medics) || isset($ambulances)))
        <section class="operations-grid">
            @isset($medics)
                @php
                    $medicTotal = $medics->count();
                    $medicActive = $medics->where('status', 'active')->count();
                    $medicInactive = $medics->where('status', 'inactive')->count();
                @endphp
                <div class="directory-panel">
                    <div class="directory-panel__header">
                        <div class="directory-panel__title">
                            <span class="badge-pill med-active" style="margin:0;">Medics</span>
                            <h4><i class="fas fa-user-md"></i> Care team directory</h4>
                        </div>
                        <div class="directory-panel__meta">
                            Keep an eye on every medic’s availability and specialization without leaving dispatch.
                        </div>
                        <div class="directory-panel__actions">
                            <a href="{{ route('admin.medics.index') }}"><i class="fas fa-user-plus"></i> Manage medics</a>
                            <a href="{{ route('admin.medics.archived') }}"><i class="fas fa-box-archive"></i> View archived</a>
                        </div>
                        <div class="directory-panel__stats">
                            <div class="mini-stat">
                                <span>Total</span>
                                <strong>{{ $medicTotal }}</strong>
                            </div>
                            <div class="mini-stat">
                                <span>Active</span>
                                <strong>{{ $medicActive }}</strong>
                            </div>
                            <div class="mini-stat">
                                <span>Inactive</span>
                                <strong>{{ $medicInactive }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="directory-panel__search">
                        <input type="text" id="medicsSearchInput" placeholder="Search medics by name, phone or specialization...">
                    </div>
                    <div class="directory-panel__body">
                        <div class="directory-list" id="medicsDirectoryList">
                            @foreach($medics as $medic)
                                @php $mStatus = strtolower($medic->status); @endphp
                                <div class="directory-item" data-search="{{ strtolower($medic->name . ' ' . ($medic->phone ?? '') . ' ' . ($medic->specialization ?? '') . ' ' . $medic->status) }}">
                                    <div class="directory-avatar">{{ strtoupper(substr($medic->name, 0, 1)) }}</div>
                                    <div class="directory-body">
                                        <div class="directory-title">{{ $medic->name }}</div>
                                        <div class="directory-meta">
                                            {{ $medic->phone ?? 'No phone' }} &middot; {{ $medic->specialization ?? 'No specialization' }}
                                        </div>
                                    </div>
                                    <div class="directory-status badge-pill {{ $mStatus === 'active' ? 'med-active' : 'med-inactive' }}">
                                        {{ ucfirst($medic->status) }}
                                    </div>
                                    <div class="action-chip-group" style="margin-left:0.5rem;">
                                        <button type="button"
                                                class="action-chip edit"
                                                title="Edit medic"
                                                onclick="openEditMedicFromDashboard({{ $medic->id }}, '{{ addslashes($medic->name) }}', '{{ addslashes($medic->phone ?? '') }}', '{{ addslashes($medic->specialization ?? '') }}', '{{ $medic->status }}')">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button"
                                                class="action-chip archive"
                                                title="Archive medic"
                                                onclick="openArchiveMedicFromDashboard({{ $medic->id }}, '{{ addslashes($medic->name) }}')">
                                            <i class="fas fa-box-archive"></i> Archive
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="directory-empty" id="medicsDirectoryEmpty" data-empty-state style="display: {{ $medicTotal ? 'none' : 'flex' }};">
                                <i class="fas fa-user-md" style="font-size:1.6rem;"></i>
                                <span>No medics yet. Add one from the manage medics screen.</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset

            @isset($ambulances)
                @php
                    $ambTotal = $ambulances->count();
                    $ambAvailable = $ambulances->where('status', 'Available')->count();
                    $ambOut = $ambulances->where('status', 'Out')->count();
                    $ambUnavailable = $ambulances->where('status', 'Unavailable')->count();
                @endphp
                <div class="directory-panel">
                    <div class="directory-panel__header">
                        <div class="directory-panel__title">
                            <span class="badge-pill amb-available" style="margin:0;">Units</span>
                            <h4><i class="fas fa-ambulance"></i> Ambulance readiness</h4>
                        </div>
                        <div class="directory-panel__meta">
                            Track which ambulances are ready for dispatch, currently out, or unavailable.
                        </div>
                        <div class="directory-panel__actions">
                            <a href="{{ route('admin.medics.index') }}#ambulance-panel"><i class="fas fa-wrench"></i> Manage ambulances</a>
                        </div>
                        <div class="directory-panel__stats">
                            <div class="mini-stat">
                                <span>Total</span>
                                <strong>{{ $ambTotal }}</strong>
                            </div>
                            <div class="mini-stat">
                                <span>Available</span>
                                <strong>{{ $ambAvailable }}</strong>
                            </div>
                            <div class="mini-stat">
                                <span>Unavailable</span>
                                <strong>{{ $ambUnavailable }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="directory-panel__search">
                        <input type="text" id="ambulancesSearchInput" placeholder="Search ambulances by name or status...">
                    </div>
                    <div class="directory-panel__body">
                        <div class="directory-list" id="ambulancesDirectoryList">
                            @foreach($ambulances as $amb)
                                @php $aStatus = strtolower($amb->status); @endphp
                                <div class="directory-item" data-search="{{ strtolower($amb->name . ' ' . $amb->status) }}">
                                    <div class="directory-avatar"><i class="fas fa-ambulance"></i></div>
                                    <div class="directory-body">
                                        <div class="directory-title">{{ $amb->name }}</div>
                                        <div class="directory-meta">Status updated {{ optional($amb->updated_at)->diffForHumans() ?? 'recently' }}</div>
                                    </div>
                                    <div class="directory-status badge-pill
                                        {{ $aStatus === 'available' ? 'amb-available' : '' }}
                                        {{ $aStatus === 'out' ? 'amb-out' : '' }}
                                        {{ $aStatus === 'unavailable' ? 'amb-unavailable' : '' }}">
                                        {{ $amb->status }}
                                    </div>
                                    <div class="action-chip-group" style="margin-left:0.5rem;">
                                        <button type="button"
                                                class="action-chip edit"
                                                title="Edit ambulance"
                                                onclick="openEditAmbulanceFromDashboard({{ $amb->id }}, '{{ addslashes($amb->name) }}', '{{ $amb->status }}')">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="directory-empty" id="ambulancesDirectoryEmpty" data-empty-state style="display: {{ $ambTotal ? 'none' : 'flex' }};">
                                <i class="fas fa-ambulance" style="font-size:1.6rem;"></i>
                                <span>No ambulances registered yet.</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </section>
        @endif
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

// Edit Ambulance (from dashboard) Modal
const editAmbulanceModalHtml = `
  <div id="editAmbulanceDashboardModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); backdrop-filter:blur(4px); -webkit-backdrop-filter:blur(4px); z-index:2000; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:24px; border:1px solid #e5e7eb; box-shadow:0 10px 25px rgba(0,0,0,0.12); width:min(440px, 92vw); position:relative; overflow:hidden;">
      <div style="position:absolute; top:0; left:0; width:100%; height:4px; background:linear-gradient(90deg, #2563eb 0%, #7c3aed 100%); border-radius:24px 24px 0 0;"></div>
      <div style="padding:18px 20px; border-bottom:1px solid #f3f4f6; display:flex; align-items:center; justify-content:space-between; margin-top:4px;">
        <div style="font-weight:700; color:#111827; display:flex; align-items:center; gap:8px;">
          <span style="width:28px; height:28px; border-radius:999px; background:rgba(37,99,235,0.1); display:inline-flex; align-items:center; justify-content:center; color:#2563eb;">
            <i class="fas fa-ambulance"></i>
          </span>
          Edit ambulance
        </div>
        <button onclick="closeEditAmbulanceFromDashboard()" style="border:none; background:transparent; font-size:18px; cursor:pointer; color:#6b7280; transition:color 0.2s ease;">✕</button>
      </div>
      <form id="editAmbulanceDashboardForm">
        <div style="padding:18px 20px; color:#374151;">
          <div style="display:flex; flex-direction:column; gap:12px;">
            <div style="display:flex; flex-direction:column; gap:6px;">
              <label for="editAmbulanceName" style="font-size:13px; font-weight:600; color:#374151;">Ambulance name</label>
              <input id="editAmbulanceName" name="name" type="text" required style="border-radius:10px; border:1px solid #d1d5db; padding:8px 10px; font-size:14px;">
            </div>
            <div style="display:flex; flex-direction:column; gap:6px;">
              <label for="editAmbulanceStatus" style="font-size:13px; font-weight:600; color:#374151;">Status</label>
              <select id="editAmbulanceStatus" name="status" required style="border-radius:10px; border:1px solid #d1d5db; padding:8px 10px; font-size:14px;">
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
              </select>
            </div>
          </div>
        </div>
        <div style="padding:16px 20px; border-top:1px solid #f3f4f6; display:flex; gap:10px; justify-content:flex-end;">
          <button type="button" onclick="closeEditAmbulanceFromDashboard()" class="modal-cancel-btn" style="padding:10px 16px; border-radius:10px; border:1px solid #e5e7eb; background:#000000; color:#ffffff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Cancel</button>
          <button type="submit" id="editAmbulanceDashboardConfirm" class="modal-logout-btn" style="padding:10px 16px; border-radius:10px; border:none; background:linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); color:#fff; font-weight:600; cursor:pointer; transition:all 0.2s ease;">Save changes</button>
        </div>
      </form>
    </div>
  </div>`;

// Edit Medic (from dashboard) Modal
const editMedicModalHtml = `
  <div id="editMedicDashboardModal" style="display:none; position:fixed; inset:0; background:rgba(15,23,42,0.55); backdrop-filter:blur(6px); -webkit-backdrop-filter:blur(6px); z-index:2100; align-items:center; justify-content:center; padding:1.5rem;">
    <div style="background:#fff; border-radius:24px; border:1px solid #e5e7eb; box-shadow:0 35px 80px rgba(15,23,42,0.25); width:min(520px, 100%); position:relative; overflow:hidden;">
      <div style="padding:1.35rem 1.75rem; display:flex; align-items:center; justify-content:space-between; gap:1rem; background:linear-gradient(135deg, #2563eb, #7c3aed); color:#ffffff;">
        <div style="display:flex; align-items:center; gap:0.85rem;">
          <span style="width:44px; height:44px; border-radius:16px; background:rgba(255,255,255,0.2); display:inline-flex; align-items:center; justify-content:center; font-size:1.15rem;">
            <i class="fas fa-user-md"></i>
          </span>
          <div>
            <h3 style="margin:0; font-size:1.15rem; font-weight:800; letter-spacing:0.01em;">Edit medic</h3>
            <p style="margin:0.2rem 0 0; font-size:0.85rem; opacity:0.9;">Keep medic contact and specialization up to date.</p>
          </div>
        </div>
        <button type="button" onclick="closeEditMedicFromDashboard()" style="background:rgba(255,255,255,0.18); border:none; color:#ffffff; width:36px; height:36px; border-radius:12px; cursor:pointer; display:inline-flex; align-items:center; justify-content:center;">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <form id="editMedicDashboardForm">
        <div style="padding:1.5rem 1.75rem 1.25rem;">
          <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1rem;">
            <div style="display:flex; flex-direction:column; gap:0.4rem;">
              <label for="editMedicName" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.06em; font-weight:800; color:#6b7280;">
                <i class="fas fa-user" style="margin-right:4px;"></i> Name
              </label>
              <input id="editMedicName" name="name" type="text" required
                     style="border-radius:14px; border:1.5px solid rgba(148,163,184,0.5); padding:0.7rem 0.85rem; font-size:0.95rem; font-weight:600; background:#f8fafc;">
            </div>
            <div style="display:flex; flex-direction:column; gap:0.4rem;">
              <label for="editMedicPhone" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.06em; font-weight:800; color:#6b7280;">
                <i class="fas fa-phone" style="margin-right:4px;"></i> Phone
              </label>
              <input id="editMedicPhone" name="phone" type="text"
                     style="border-radius:14px; border:1.5px solid rgba(148,163,184,0.5); padding:0.7rem 0.85rem; font-size:0.95rem; font-weight:600; background:#f8fafc;">
            </div>
            <div style="display:flex; flex-direction:column; gap:0.4rem;">
              <label for="editMedicSpecialization" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.06em; font-weight:800; color:#6b7280;">
                <i class="fas fa-stethoscope" style="margin-right:4px;"></i> Specialization
              </label>
              <input id="editMedicSpecialization" name="specialization" type="text"
                     style="border-radius:14px; border:1.5px solid rgba(148,163,184,0.5); padding:0.7rem 0.85rem; font-size:0.95rem; font-weight:600; background:#f8fafc;">
            </div>
            <div style="display:flex; flex-direction:column; gap:0.4rem;">
              <label for="editMedicStatus" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.06em; font-weight:800; color:#6b7280;">
                <i class="fas fa-toggle-on" style="margin-right:4px;"></i> Status
              </label>
              <select id="editMedicStatus" name="status" required
                      style="border-radius:14px; border:1.5px solid rgba(148,163,184,0.5); padding:0.7rem 0.85rem; font-size:0.95rem; font-weight:600; background:#f8fafc;">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
          </div>
        </div>
        <div style="padding:0 1.75rem 1.5rem; display:flex; justify-content:flex-end; gap:0.75rem;">
          <button type="button" onclick="closeEditMedicFromDashboard()" class="modal-cancel-btn"
                  style="border-radius:12px; border:1px solid #e5e7eb; padding:0.85rem 1.35rem; font-weight:800; font-size:0.95rem; background:rgba(15,23,42,0.06); color:#0f172a;">
            <i class="fas fa-times"></i> Cancel
          </button>
          <button type="submit" id="editMedicDashboardConfirm" class="modal-logout-btn"
                  style="border-radius:12px; border:none; padding:0.85rem 1.35rem; font-weight:800; font-size:0.95rem; background:linear-gradient(135deg,#f59e0b,#f97316); color:#fff; box-shadow:0 15px 35px rgba(245,158,11,0.35);">
            <i class="fas fa-save"></i> Save changes
          </button>
        </div>
      </form>
    </div>
  </div>`;

// Archive Medic (from dashboard) Modal
const archiveMedicModalHtml = `
  <div id="archiveMedicDashboardModal" style="display:none; position:fixed; inset:0; background:rgba(15,23,42,0.55); backdrop-filter:blur(6px); -webkit-backdrop-filter:blur(6px); z-index:2100; align-items:center; justify-content:center; padding:1.5rem;">
    <div style="background:#fff; border-radius:22px; border:1px solid rgba(148,163,184,0.35); box-shadow:0 35px 80px rgba(15,23,42,0.25); width:min(480px, 100%); overflow:hidden;">
      <div style="padding:1.35rem 1.75rem; display:flex; align-items:center; justify-content:space-between; gap:1rem; background:linear-gradient(135deg,#f97316,#ea580c); color:#ffffff;">
        <div style="display:flex; align-items:center; gap:0.85rem;">
          <span style="width:44px; height:44px; border-radius:16px; background:rgba(255,255,255,0.2); display:inline-flex; align-items:center; justify-content:center; font-size:1.15rem;">
            <i class="fas fa-box-archive"></i>
          </span>
          <div>
            <h3 style="margin:0; font-size:1.15rem; font-weight:800;">Archive medic</h3>
            <p style="margin:0.2rem 0 0; font-size:0.85rem; opacity:0.9;">Move this medic out of the active directory. You can restore them later.</p>
          </div>
        </div>
        <button type="button" onclick="closeArchiveMedicFromDashboard()" style="background:rgba(255,255,255,0.18); border:none; color:#ffffff; width:36px; height:36px; border-radius:12px; cursor:pointer; display:inline-flex; align-items:center; justify-content:center;">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div style="padding:1.5rem 1.75rem 1.25rem;">
        <p id="archiveMedicDashboardText" style="margin:0; font-size:0.95rem; color:#4b5563;">
          Are you sure you want to archive this medic?
        </p>
      </div>
      <div style="padding:0 1.75rem 1.5rem; display:flex; justify-content:flex-end; gap:0.75rem;">
        <button type="button" onclick="closeArchiveMedicFromDashboard()"
                style="border-radius:12px; padding:0.85rem 1.35rem; border:1px solid #e5e7eb; background:#000000; color:#ffffff; font-weight:800; font-size:0.95rem;">
          <i class="fas fa-times"></i> Cancel
        </button>
        <button type="button" id="archiveMedicDashboardConfirm"
                style="border-radius:12px; padding:0.85rem 1.35rem; background:linear-gradient(135deg,#f59e0b,#d97706); color:#fff; border:none; font-weight:800; font-size:0.95rem;">
          <i class="fas fa-box-archive"></i> Archive
        </button>
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
  if (!document.getElementById('editAmbulanceDashboardModal')) {
    const wrap = document.createElement('div');
    wrap.innerHTML = editAmbulanceModalHtml;
    document.body.appendChild(wrap.firstElementChild);
  }
  if (!document.getElementById('editMedicDashboardModal')) {
    const wrap = document.createElement('div');
    wrap.innerHTML = editMedicModalHtml;
    document.body.appendChild(wrap.firstElementChild);
  }
  if (!document.getElementById('archiveMedicDashboardModal')) {
    const wrap = document.createElement('div');
    wrap.innerHTML = archiveMedicModalHtml;
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
  if (!selectedDriverId) {
    alert('No driver selected.');
    return;
  }
  
  const confirmBtn = document.getElementById('forceLogoutConfirm');
  if (confirmBtn) {
    confirmBtn.disabled = true;
    confirmBtn.textContent = 'Logging out...';
  }
  
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
      throw new Error('CSRF token not found');
    }
    
    const res = await fetch(`/admin/drivers/${selectedDriverId}/force-logout`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      }
    });
    
    if (!res.ok) {
      const errorText = await res.text();
      throw new Error(`HTTP ${res.status}: ${errorText}`);
    }
    
    const data = await res.json();
    console.log('Force logout response:', data);
    
    if (data && data.success){
      closeForceLogoutModal();
      alert(`Driver has been logged out successfully.\n\nDriver ID: ${data.driver_id || selectedDriverId}\nCache Key: ${data.cache_key || 'N/A'}\nCache Set: ${data.cache_set ? 'Yes' : 'No'}`);
      location.reload();
    } else {
      alert('Failed to log out driver. Server did not return success.');
      console.error('Force logout failed:', data);
    }
  } catch (e) {
    console.error('Force logout error:', e);
    alert(`Failed to log out driver: ${e.message}`);
  } finally {
    const confirmBtn = document.getElementById('forceLogoutConfirm');
    if (confirmBtn) {
      confirmBtn.disabled = false;
      confirmBtn.textContent = 'Log out';
    }
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

// Edit ambulance from dashboard functions
let selectedAmbulanceId = null;
function openEditAmbulanceFromDashboard(id, name, status){
  selectedAmbulanceId = id;
  const modal = document.getElementById('editAmbulanceDashboardModal');
  const nameInput = document.getElementById('editAmbulanceName');
  const statusSelect = document.getElementById('editAmbulanceStatus');
  if (nameInput) nameInput.value = name || '';
  if (statusSelect) statusSelect.value = status || 'Available';
  if (modal) modal.style.display = 'flex';
}
function closeEditAmbulanceFromDashboard(){
  const modal = document.getElementById('editAmbulanceDashboardModal');
  if (modal) modal.style.display = 'none';
  selectedAmbulanceId = null;
}
document.addEventListener('DOMContentLoaded', function(){
  const form = document.getElementById('editAmbulanceDashboardForm');
  if (form) {
    form.addEventListener('submit', async function(e){
      e.preventDefault();
      if (!selectedAmbulanceId) return;
      const nameInput = document.getElementById('editAmbulanceName');
      const statusSelect = document.getElementById('editAmbulanceStatus');
      const payload = {
        name: nameInput ? nameInput.value : '',
        status: statusSelect ? statusSelect.value : 'Available',
        _method: 'PUT'
      };
      try {
        const res = await fetch(`/admin/ambulances/${selectedAmbulanceId}`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify(payload)
        });
        if (res.ok) {
          closeEditAmbulanceFromDashboard();
          alert('Ambulance updated successfully.');
          location.reload();
        } else {
          alert('Failed to update ambulance.');
        }
      } catch (err) {
        console.error('Ambulance update error:', err);
        alert('Failed to update ambulance.');
      }
    });
  }
});

// Edit & archive medic from dashboard functions
let selectedMedicId = null;
function openEditMedicFromDashboard(id, name, phone, specialization, status){
  selectedMedicId = id;
  const modal = document.getElementById('editMedicDashboardModal');
  const nameInput = document.getElementById('editMedicName');
  const phoneInput = document.getElementById('editMedicPhone');
  const specInput = document.getElementById('editMedicSpecialization');
  const statusSelect = document.getElementById('editMedicStatus');
  if (nameInput) nameInput.value = name || '';
  if (phoneInput) phoneInput.value = phone || '';
  if (specInput) specInput.value = specialization || '';
  if (statusSelect) statusSelect.value = status || 'active';
  if (modal) modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeEditMedicFromDashboard(){
  const modal = document.getElementById('editMedicDashboardModal');
  if (modal) modal.style.display = 'none';
  selectedMedicId = null;
  document.body.style.overflow = 'auto';
}

let selectedArchiveMedicId = null;
function openArchiveMedicFromDashboard(id, name){
  selectedArchiveMedicId = id;
  const modal = document.getElementById('archiveMedicDashboardModal');
  const text = document.getElementById('archiveMedicDashboardText');
  if (text) {
    text.innerHTML = `Are you sure you want to archive <strong>${name}</strong>? This medic will move out of the active directory but can be restored later.`;
  }
  if (modal) modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeArchiveMedicFromDashboard(){
  const modal = document.getElementById('archiveMedicDashboardModal');
  if (modal) modal.style.display = 'none';
  selectedArchiveMedicId = null;
  document.body.style.overflow = 'auto';
}

document.addEventListener('DOMContentLoaded', function(){
  const medicForm = document.getElementById('editMedicDashboardForm');
  if (medicForm) {
    medicForm.addEventListener('submit', async function(e){
      e.preventDefault();
      if (!selectedMedicId) return;
      const nameInput = document.getElementById('editMedicName');
      const phoneInput = document.getElementById('editMedicPhone');
      const specInput = document.getElementById('editMedicSpecialization');
      const statusSelect = document.getElementById('editMedicStatus');
      const payload = {
        name: nameInput ? nameInput.value : '',
        phone: phoneInput ? phoneInput.value : '',
        specialization: specInput ? specInput.value : '',
        status: statusSelect ? statusSelect.value : 'active',
        _method: 'PUT'
      };
      try {
        const res = await fetch(`/admin/medics/${selectedMedicId}`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify(payload)
        });
        if (res.ok) {
          closeEditMedicFromDashboard();
          alert('Medic updated successfully.');
          location.reload();
        } else {
          alert('Failed to update medic.');
        }
      } catch (err) {
        console.error('Medic update error:', err);
        alert('Failed to update medic.');
      }
    });
  }

  const archiveBtn = document.getElementById('archiveMedicDashboardConfirm');
  if (archiveBtn) {
    archiveBtn.addEventListener('click', async function(){
      if (!selectedArchiveMedicId) return;
      try {
        const res = await fetch(`/admin/medics/${selectedArchiveMedicId}/archive`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({})
        });
        if (res.ok) {
          closeArchiveMedicFromDashboard();
          alert('Medic archived successfully.');
          location.reload();
        } else {
          alert('Failed to archive medic.');
        }
      } catch (err) {
        console.error('Medic archive error:', err);
        alert('Failed to archive medic.');
      }
    });
  }
});
function toggleSidebar() {
    const sidenav = document.getElementById('sidenav');
    const overlay = document.getElementById('sidenavOverlay');
    if (!sidenav) return;
    sidenav.classList.toggle('active');
    if (overlay) {
        overlay.classList.toggle('active');
    }
    document.body.style.overflow = sidenav.classList.contains('active') ? 'hidden' : '';
}

function closeSidebar() {
    const sidenav = document.getElementById('sidenav');
    const overlay = document.getElementById('sidenavOverlay');
    if (sidenav) {
        sidenav.classList.remove('active');
    }
    if (overlay) {
        overlay.classList.remove('active');
    }
    document.body.style.overflow = '';
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

    // Close sidebar when clicking outside on mobile
    const overlay = document.getElementById('sidenavOverlay');
    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Close sidebar on window resize if it's larger than 1024px
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1024) {
            closeSidebar();
        }
    });
});

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
    const headers = ['Driver','Contact','Status','Availability'];
    const csvRows = rows.map(row => {
      const cells = row.querySelectorAll('td');
      return [
        cells[0]?.innerText.trim() || '',
        cells[1]?.innerText.trim() || '',
        cells[2]?.innerText.trim() || '',
        cells[3]?.innerText.trim() || '',
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

// Medics & ambulances live search (card view)
(function(){
  const normalize = text => String(text || '').toLowerCase().trim();

  function setupDirectorySearch(inputId, itemsSelector, emptySelector){
    const input = document.getElementById(inputId);
    if (!input) return;
    const items = document.querySelectorAll(itemsSelector);
    const emptyState = emptySelector ? document.querySelector(emptySelector) : null;

    input.addEventListener('input', () => {
      const q = normalize(input.value);
      let visible = 0;
      items.forEach(item => {
        const text = item.getAttribute('data-search') || '';
        const show = !q || text.includes(q);
        item.style.display = show ? 'flex' : 'none';
        if (show) visible++;
      });
      if (emptyState) {
        emptyState.style.display = visible ? 'none' : 'flex';
      }
    });
  }

  setupDirectorySearch('medicsSearchInput', '#medicsDirectoryList .directory-item[data-search]', '#medicsDirectoryEmpty');
  setupDirectorySearch('ambulancesSearchInput', '#ambulancesDirectoryList .directory-item[data-search]', '#ambulancesDirectoryEmpty');
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
</script>
</body>
</html>