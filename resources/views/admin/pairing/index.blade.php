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
    --modal-radius: 20px;
    --modal-shadow: 0 25px 60px rgba(15, 23, 42, 0.22);
    --overlay-bg: rgba(9, 12, 27, 0.52);
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
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: clamp(1.5rem, 3vw, 3rem);
    align-items: flex-start;
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

.hero-insights {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
}

.hero-insight-card {
    background: rgba(255, 255, 255, 0.85);
    border-radius: 18px;
    padding: 1.25rem 1.35rem;
    border: 1px solid rgba(99, 102, 241, 0.16);
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1);
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.hero-insight-head {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    margin-bottom: 1rem;
}

.hero-insight-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: #ffffff;
}

.hero-insight-icon.success {
    background: linear-gradient(135deg, #10b981, #059669);
}

.hero-insight-icon.accent {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
}

.hero-insight-title {
    display: block;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-weight: 800;
    color: var(--muted);
}

.hero-insight-subtitle {
    margin: 0.2rem 0 0;
    font-size: 1rem;
    font-weight: 800;
    color: var(--heading);
}

.hero-stat-split {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0.85rem;
}

.hero-stat-split.single {
    display: flex;
    justify-content: center;
    gap: 0.85rem;
}

.hero-stat {
    background: rgba(248, 250, 252, 0.85);
    border-radius: 14px;
    padding: 0.85rem;
    display: flex;
    flex-direction: column;
    gap: 0.1rem;
    border: 1px solid rgba(226, 232, 240, 0.6);
    align-items: center;
    text-align: center;
}

.hero-stat-value {
    font-size: 1.75rem;
    font-weight: 900;
    color: var(--heading);
    line-height: 1;
}

.hero-stat-label {
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

@media (max-width: 640px) {
    .hero-stat-split {
        grid-template-columns: 1fr;
    }
}

.table-section {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.table-filter-card {
    background: var(--card-bg);
    border-radius: 22px;
    padding: 1.35rem;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
    border: 1px solid rgba(15, 23, 42, 0.08);
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.table-filter-title {
    margin: 0;
    font-size: 1rem;
    font-weight: 800;
    color: var(--heading);
}

.table-filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
}

.table-filter-field {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
    position: relative;
}

.table-filter-field span {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    font-weight: 800;
    color: var(--muted);
}

.table-filter-input,
.table-filter-select {
    border-radius: 14px;
    border: 1.5px solid rgba(148, 163, 184, 0.5);
    padding: 0.65rem 0.85rem;
    font-size: 0.92rem;
    font-weight: 600;
    color: var(--heading);
    background: #f8fafc;
    transition: border 0.2s ease, box-shadow 0.2s ease;
}

.table-filter-input:focus,
.table-filter-select:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    background: #ffffff;
}

.filter-indicator {
    position: absolute;
    right: 0.85rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--accent);
    display: none;
}

.table-card {
    background: var(--card-bg);
    border-radius: 26px;
    border: 1px solid rgba(15, 23, 42, 0.08);
    box-shadow: 0 25px 60px rgba(15, 23, 42, 0.12);
    overflow: hidden;
    display: flex;
    flex-direction: column;
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
    flex-wrap: wrap;
    gap: 0.5rem;
}

.action-btn {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.55rem 1rem;
    font-size: 0.8rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-weight: 800;
    letter-spacing: 0.01em;
    background: #ffffff;
    color: #0f172a;
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
    transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
    height: 50px;
    width: 120px;
}

.action-btn .btn-icon {
    width: 24px;
    height: 24px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    background: rgba(148, 163, 184, 0.2);
    color: inherit;
}

.action-btn.complete {
    border-color: rgba(16, 185, 129, 0.5);
    background: linear-gradient(135deg, #059669, #10b981);
    color: #ffffff;
    box-shadow: 0 12px 26px rgba(16, 185, 129, 0.3);
}

.action-btn.complete .btn-icon {
    background: rgba(255, 255, 255, 0.2);
}

.action-btn.cancel {
    border-color: rgba(239, 68, 68, 0.45);
    background: #ffffff;
    color: #b42318;
}

.action-btn.cancel .btn-icon {
    background: rgba(239, 68, 68, 0.15);
}

.action-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.15);
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

/* Layout helpers */
@media (max-width: 768px) {
    .table-filter-grid {
        grid-template-columns: 1fr;
    }
}

/* Panel & Modal Styles */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    padding: clamp(1.25rem, 4vw, 2.75rem);
    background: rgba(4, 7, 29, 0.65);
    backdrop-filter: blur(18px) saturate(160%);
    z-index: 3000;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.25s ease;
}

.modal-shell {
    width: min(720px, 94vw);
    background: rgba(255, 255, 255, 0.97);
    border-radius: var(--modal-radius);
    border: 1px solid rgba(99, 102, 241, 0.18);
    box-shadow: 0 50px 120px rgba(15, 23, 42, 0.45);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    animation: modalPop 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.modal-shell.compact {
    width: min(520px, 94vw);
}

.modal-shell.wide {
    width: min(820px, 94vw);
}

.modal-header {
    padding: 2rem clamp(1.5rem, 4vw, 2.5rem);
    color: #ffffff;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.modal-header::after {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.25), transparent 60%);
    opacity: 0.6;
}

.modal-header > * {
    position: relative;
    z-index: 1;
}

.modal-header h3 {
    margin: 0;
    font-size: clamp(1.3rem, 2.4vw, 1.65rem);
    font-weight: 900;
    letter-spacing: 0.01em;
}

.modal-header p {
    margin: 0.65rem auto 0;
    max-width: 420px;
    font-size: 0.98rem;
    opacity: 0.92;
    line-height: 1.5;
}

.modal-header .modal-icon {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    margin: 0 auto 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    background: rgba(255, 255, 255, 0.2);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.18);
}

.modal-header.green {
    background: linear-gradient(135deg, #0ea96f, #0f766e);
}

.modal-header.blue {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
}

.modal-header.purple {
    background: linear-gradient(135deg, #7c3aed, #4c1d95);
}

.modal-header.neutral {
    background: linear-gradient(135deg, #0f172a, #1f2937);
}

.modal-close {
    position: absolute;
    top: 16px;
    right: 16px;
    border: none;
    background: rgba(255, 255, 255, 0.92);
    width: 38px;
    height: 38px;
    border-radius: 12px;
    cursor: pointer;
    color: #0f172a;
    font-size: 1rem;
    box-shadow: 0 15px 30px rgba(15, 23, 42, 0.2);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    z-index: 2;
}

.modal-close:hover {
    transform: translateY(-1px) scale(1.02);
    box-shadow: 0 18px 36px rgba(15, 23, 42, 0.28);
}

.modal-body {
    padding: clamp(1.5rem, 4vw, 2.5rem);
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    background: var(--card-bg);
}

.modal-body.compact {
    padding: clamp(1.5rem, 4vw, 2.25rem);
}

.modal-grid {
    display: grid;
    gap: 1.25rem;
}

.modal-grid.two-col {
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
}

.modal-grid.three-col {
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
}

.modal-field label {
    display: block;
    font-size: 0.78rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 0.45rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.modal-field input,
.modal-field select,
.modal-field textarea {
    width: 100%;
    padding: 0.9rem;
    border-radius: 14px;
    border: 1.5px solid rgba(15, 23, 42, 0.08);
    font-size: 0.95rem;
    font-weight: 600;
    background: #f8fafc;
    transition: all 0.2s;
}

.modal-field textarea {
    resize: vertical;
    min-height: 110px;
}

.modal-helper {
    font-size: 0.78rem;
    color: #6b7280;
    margin-top: 0.35rem;
}

.modal-field input:focus,
.modal-field select:focus,
.modal-field textarea:focus {
    outline: none;
    border-color: var(--accent) !important;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.15) !important;
    background: #ffffff !important;
}

.modal-actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    gap: 0.85rem;
}

.modal-actions button {
    border-radius: 14px;
    padding: 0.9rem 1.9rem;
    font-weight: 800;
    cursor: pointer;
    border: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.modal-actions .secondary {
    background: #f8fafc;
    color: #0f172a;
    border: 1px solid rgba(15, 23, 42, 0.08);
}

.modal-actions .primary {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #ffffff;
    box-shadow: 0 20px 40px rgba(37, 99, 235, 0.35);
}

.modal-actions button:hover {
    transform: translateY(-1px);
}

.modal-choice-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.choice-card {
    border: none;
    width: 100%;
    border-radius: 18px;
    padding: 1.25rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    color: #ffffff;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.25);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.choice-card .choice-icon {
    width: 58px;
    height: 58px;
    border-radius: 14px;
    background: rgba(255, 255, 255, 0.22);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.choice-card.green {
    background: linear-gradient(135deg, #0ea5e9, #10b981);
}

.choice-card.blue {
    background: linear-gradient(135deg, #6366f1, #2563eb);
}

.choice-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 25px 50px rgba(15, 23, 42, 0.35);
}

.choice-card span {
    display: block;
}

.confirm-modal-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: center;
}

.confirm-modal-actions button {
    flex: 1;
}

.modal-confirm-message {
    text-align: center;
    font-size: 1rem;
    color: var(--heading);
    font-weight: 600;
    line-height: 1.5;
}

@keyframes modalPop {
    from {
        opacity: 0;
        transform: translateY(25px) scale(0.96);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
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
        <img src="{{ asset('image/LOGOMDRRMO.png') }}" alt="Logo" class="logo-img" style="display: block; margin: 0 auto;">
        <div style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 800; color: #ffffff; letter-spacing: .5px;">SILANG MDRRMO</div>
        <div id="sidebarDateTime" style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 600; color: rgba(255, 255, 255, 0.85); font-size: 0.75rem; letter-spacing: 0.3px; padding: 0 12px;">
            <div id="sidebarDate" style="margin-bottom: 4px;"></div>
            <div id="sidebarTime" style="font-weight: 700; font-size: 0.8rem;"></div>
        </div>
    </div>
    <nav class="nav-links">
        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
        @if(auth()->check())
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
                    <button type="button" class="secondary" onclick="window.location.href='{{ route('admin.pairing.log') }}'"><i class="fas fa-clock"></i> View Log</button>
                </div>
            </div>
            @php
                $activeDriverMedic = 0;
                foreach($groupedDriverMedicPairings as $pairings) {
                    if($pairings->pluck('status')->contains('active')) {
                        $activeDriverMedic++;
                    }
                }
                $activeDriverAmbulance = 0;
                foreach($groupedDriverAmbulancePairings as $pairings) {
                    if($pairings->pluck('status')->contains('active')) {
                        $activeDriverAmbulance++;
                    }
                }
            @endphp
            <div class="hero-insights">
                <article class="hero-insight-card">
                    <div class="hero-insight-head">
                        <div class="hero-insight-icon success">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div>
                            <span class="hero-insight-title">Driver-Medic Teams</span>
                            <p class="hero-insight-subtitle">Coordinated crews</p>
                        </div>
                    </div>
                    <div class="hero-stat-split single">
                        <div class="hero-stat">
                            <span class="hero-stat-value">{{ $activeDriverMedic }}</span>
                            <span class="hero-stat-label">Active</span>
                        </div>
                    </div>
                </article>
                <article class="hero-insight-card">
                    <div class="hero-insight-head">
                        <div class="hero-insight-icon accent">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <div>
                            <span class="hero-insight-title">Driver-Ambulance</span>
                            <p class="hero-insight-subtitle">Fleet readiness</p>
                        </div>
                    </div>
                    <div class="hero-stat-split single">
                        <div class="hero-stat">
                            <span class="hero-stat-value">{{ $activeDriverAmbulance }}</span>
                            <span class="hero-stat-label">Active</span>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- Driver-Medic Filters + Table -->
        <section class="table-section" id="driverMedicSectionWrapper">
            <div class="table-filter-card">
                <h5 class="table-filter-title">Driver-Medic Filters</h5>
                <form id="driverMedicFilters" onsubmit="event.preventDefault(); return false;">
                    <div class="table-filter-grid">
                        <label class="table-filter-field">
                            <span>Search</span>
                            <input type="text" class="table-filter-input" id="dmSearchInput" placeholder="Search driver, medic or notes...">
                            <div class="filter-indicator" id="dmSearchIndicator">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </label>
                        <label class="table-filter-field">
                            <span>Driver</span>
                            <select class="table-filter-select" id="dmDriverFilter">
                                <option value="">All Drivers</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="table-filter-field">
                            <span>Medic</span>
                            <select class="table-filter-select" id="dmMedicFilter">
                                <option value="">All Medics</option>
                                @foreach($medics as $medic)
                                    <option value="{{ $medic->id }}">{{ $medic->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </form>
            </div>
            <section class="table-card" id="driverMedicSection">
            <div class="table-card-header">
                <div>
                    <h4>Driver-Medic Pairings</h4>
                </div>
                <div class="table-actions">
                    <button type="button" class="primary" onclick="openDriverMedicModal()"><i class="fas fa-plus"></i> Create Pairing</button>
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
                                            <button type="button" onclick="bulkActionGroup('driver_medic', '{{ $groupKey }}', 'complete')" class="action-btn complete">
                                                <span class="btn-icon"><i class="fas fa-check"></i></span>
                                                <span>Mark Complete</span>
                                            </button>
                                            <button type="button" onclick="bulkActionGroup('driver_medic', '{{ $groupKey }}', 'cancel')" class="action-btn cancel">
                                                <span class="btn-icon"><i class="fas fa-ban"></i></span>
                                                <span>Cancel Pairing</span>
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
            </section>
        </section>

        <!-- Driver-Ambulance Filters + Table -->
        <section class="table-section" id="driverAmbulanceSectionWrapper">
            <div class="table-filter-card">
                <h5 class="table-filter-title">Driver-Ambulance Filters</h5>
                <form id="driverAmbulanceFilters" onsubmit="event.preventDefault(); return false;">
                    <div class="table-filter-grid">
                        <label class="table-filter-field">
                            <span>Search</span>
                            <input type="text" class="table-filter-input" id="daSearchInput" placeholder="Search driver, ambulance or notes...">
                            <div class="filter-indicator" id="daSearchIndicator">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </label>
                        <label class="table-filter-field">
                            <span>Driver</span>
                            <select class="table-filter-select" id="daDriverFilter">
                                <option value="">All Drivers</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="table-filter-field">
                            <span>Ambulance</span>
                            <select class="table-filter-select" id="daAmbulanceFilter">
                                <option value="">All Ambulances</option>
                                @foreach($ambulances as $ambulance)
                                    <option value="{{ $ambulance->id }}">{{ $ambulance->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </form>
            </div>
            <section class="table-card" id="driverAmbulanceSection">
                <div class="table-card-header">
                    <div>
                        <h4>Driver-Ambulance Pairings</h4>
                    </div>
                    <div class="table-actions">
                        <button type="button" class="primary" onclick="openDriverAmbulanceModal()"><i class="fas fa-plus"></i> Create Pairing</button>
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
                                                <button type="button" onclick="bulkActionGroup('driver_ambulance', '{{ $groupKey }}', 'complete')" class="action-btn complete">
                                                    <span class="btn-icon"><i class="fas fa-check"></i></span>
                                                    <span>Mark Complete</span>
                                                </button>
                                                <button type="button" onclick="bulkActionGroup('driver_ambulance', '{{ $groupKey }}', 'cancel')" class="action-btn cancel">
                                                    <span class="btn-icon"><i class="fas fa-ban"></i></span>
                                                    <span>Cancel Pairing</span>
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
            </section>
        </section>
    </div>
</main>

<!-- Pairing Type Selection Modal -->
<div id="pairingTypeModal" class="modal-overlay" style="display:none;">
    <div class="modal-shell compact">
        <button type="button" class="modal-close" onclick="closePairingTypeModal()">
            <i class="fas fa-times"></i>
        </button>
        <div class="modal-header blue">
            <div class="modal-icon">
                <i class="fas fa-link"></i>
            </div>
            <h3>Create New Pairing</h3>
            <p>Choose the type of pairing you want to create</p>
        </div>
        <div class="modal-body compact">
            <div class="modal-choice-grid">
                <button type="button" onclick="openDriverMedicModal()" class="choice-card green pairing-type-btn">
                    <div class="choice-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div style="flex:1; text-align:left;">
                        <span style="font-weight:800; font-size:1.15rem; margin-bottom:0.1rem;">Driver-Medic Pairing</span>
                        <span style="font-size:0.95rem; opacity:0.9;">Pair a driver with medical personnel</span>
                    </div>
                    <i class="fas fa-chevron-right" style="font-size:1.1rem;"></i>
                </button>
                <button type="button" onclick="openDriverAmbulanceModal()" class="choice-card blue pairing-type-btn">
                    <div class="choice-icon">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <div style="flex:1; text-align:left;">
                        <span style="font-weight:800; font-size:1.15rem; margin-bottom:0.1rem;">Driver-Ambulance Pairing</span>
                        <span style="font-size:0.95rem; opacity:0.9;">Assign a driver to an ambulance vehicle</span>
                    </div>
                    <i class="fas fa-chevron-right" style="font-size:1.1rem;"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Driver-Medic Pairing Modal -->
<div id="driverMedicModal" class="modal-overlay" style="display:none;">
    <div class="modal-shell wide">
        <button type="button" class="modal-close" onclick="closeDriverMedicModal()">
            <i class="fas fa-times"></i>
        </button>
        <div class="modal-header green">
            <div class="modal-icon">
                <i class="fas fa-user-md"></i>
            </div>
            <h3>Driver-Medic Pairing</h3>
            <p>Pair a driver with medical personnel</p>
        </div>
        <div class="modal-body">
            <form id="driverMedicForm" onsubmit="submitDriverMedicForm(event)">
                @csrf
                <div class="modal-grid">
                    <div class="modal-grid two-col">
                        <div class="modal-field">
                            <label>Driver *</label>
                            <select name="driver_id" id="dmDriverSelect" required>
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            <div id="dmDriverIdError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                        </div>
                        <div class="modal-field">
                            <label>Medic *</label>
                            <select name="medic_id" id="dmMedicSelect" required>
                                <option value="">Select Medic</option>
                                @foreach($medics as $medic)
                                    <option value="{{ $medic->id }}" data-specialization="{{ $medic->specialization ?? '' }}">{{ $medic->name }}@if($medic->specialization) ({{ $medic->specialization }})@endif</option>
                                @endforeach
                            </select>
                            <div id="dmMedicIdError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                            <p class="modal-helper">Each medic can only be paired with one driver per date</p>
                        </div>
                    </div>
                    <div class="modal-grid three-col">
                        <div class="modal-field">
                            <label>Pairing Date *</label>
                            <input type="date" name="pairing_date" id="dmPairingDate" value="{{ $selectedDate }}" required onchange="updateDriverMedicOptions()">
                            <div id="dmPairingDateError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                        </div>
                        <div class="modal-field">
                            <label>Start Time *</label>
                            <input type="time" name="start_time" id="dmStartTime" required>
                            <div id="dmStartTimeError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                        </div>
                        <div class="modal-field">
                            <label>End Time *</label>
                            <input type="time" name="end_time" id="dmEndTime" required>
                            <div id="dmEndTimeError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                        </div>
                    </div>
                    <div class="modal-field">
                        <label>Notes</label>
                        <textarea name="notes" id="dmNotes" rows="3" placeholder="Any additional notes about this pairing..."></textarea>
                    </div>
                    <div class="modal-actions">
                        <button type="button" class="secondary" onclick="closeDriverMedicModal()">Cancel</button>
                        <button type="submit" class="primary" id="dmSubmitBtn">
                            <i class="fas fa-check"></i> Create Pairing
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Driver-Ambulance Pairing Modal -->
<div id="driverAmbulanceModal" class="modal-overlay" style="display:none;">
    <div class="modal-shell wide">
        <button type="button" class="modal-close" onclick="closeDriverAmbulanceModal()">
            <i class="fas fa-times"></i>
        </button>
        <div class="modal-header blue">
            <div class="modal-icon">
                <i class="fas fa-ambulance"></i>
            </div>
            <h3>Driver-Ambulance Pairing</h3>
            <p>Assign a driver to an ambulance vehicle</p>
        </div>
        <div class="modal-body">
            <form id="driverAmbulanceForm" onsubmit="submitDriverAmbulanceForm(event)">
                @csrf
                <div class="modal-grid">
                    <div class="modal-grid two-col">
                        <div class="modal-field">
                            <label>Driver *</label>
                            <select name="driver_id" id="daDriverSelect" required>
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            <div id="daDriverIdError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                            <p class="modal-helper">Drivers paired with medics can still be paired with ambulances</p>
                        </div>
                        <div class="modal-field">
                            <label>Ambulance *</label>
                            <select name="ambulance_id" id="daAmbulanceSelect" required>
                                <option value="">Select Ambulance</option>
                                @foreach($ambulances as $ambulance)
                                    <option value="{{ $ambulance->id }}">{{ $ambulance->name }}@if($ambulance->plate_number) ({{ $ambulance->plate_number }})@endif</option>
                                @endforeach
                            </select>
                            <div id="daAmbulanceIdError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                            <p class="modal-helper">Maximum 2 drivers per ambulance</p>
                        </div>
                    </div>
                    <div class="modal-field">
                        <label>Pairing Date *</label>
                        <input type="date" name="pairing_date" id="daPairingDate" value="{{ $selectedDate }}" required onchange="updateDriverAmbulanceOptions()">
                        <div id="daPairingDateError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                    </div>
                    <div class="modal-field">
                        <label>Notes</label>
                        <textarea name="notes" id="daNotes" rows="3" placeholder="Any additional notes about this pairing..."></textarea>
                    </div>
                    <div class="modal-actions">
                        <button type="button" class="secondary" onclick="closeDriverAmbulanceModal()">Cancel</button>
                        <button type="submit" class="primary" id="daSubmitBtn">
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
                    <button type="button" onclick="bulkActionGroup('driver_medic', '${pairing.groupKey}', 'complete')" class="action-btn complete" title="Mark Complete">
                        <span class="btn-icon"><i class="fas fa-check"></i></span>
                        <span>Mark Complete</span>
                    </button>
                    <button type="button" onclick="bulkActionGroup('driver_medic', '${pairing.groupKey}', 'cancel')" class="action-btn cancel" title="Cancel Pairing">
                        <span class="btn-icon"><i class="fas fa-ban"></i></span>
                        <span>Cancel Pairing</span>
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
                    <button type="button" onclick="bulkActionGroup('driver_ambulance', '${pairing.groupKey}', 'complete')" class="action-btn complete" title="Mark Complete">
                        <span class="btn-icon"><i class="fas fa-check"></i></span>
                        <span>Mark Complete</span>
                    </button>
                    <button type="button" onclick="bulkActionGroup('driver_ambulance', '${pairing.groupKey}', 'cancel')" class="action-btn cancel" title="Cancel Pairing">
                        <span class="btn-icon"><i class="fas fa-ban"></i></span>
                        <span>Cancel Pairing</span>
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