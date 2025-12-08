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
    padding-right: 2.5rem;
    font-size: 0.92rem;
    font-weight: 600;
    color: var(--heading);
    background: #f8fafc;
    transition: border 0.2s ease, box-shadow 0.2s ease;
    width: 100%;
    box-sizing: border-box;
}

.table-filter-select {
    padding-right: 0.85rem;
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
    pointer-events: none;
    z-index: 10;
}

.table-filter-field {
    position: relative;
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
                    <span>Log Out</span>
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
                                $driverName = $driver ? strtolower($driver->name) : '';
                                $driverPhone = $driver && $driver->phone ? strtolower($driver->phone) : '';
                                $medicNames = $medics->map(function($m) { return strtolower($m->name . ' ' . ($m->specialization ?? '')); })->implode(' ');
                                $notes = strtolower($firstPairing->notes ?? '');
                                $searchableText = $driverName . ' ' . $driverPhone . ' ' . $medicNames . ' ' . $notes;
                            @endphp
                            <tr data-driver-id="{{ $driver ? $driver->id : '' }}" data-medic-ids="{{ $medics->pluck('id')->implode(',') }}" data-search-text="{{ $searchableText }}">
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
                                    $driverNames = $groupDrivers->map(function($d) { return $d ? strtolower($d->name) : ''; })->filter()->implode(' ');
                                    $ambulanceName = $ambulance ? strtolower($ambulance->name) : '';
                                    $ambulancePlate = $ambulance && $ambulance->plate_number ? strtolower($ambulance->plate_number) : '';
                                    $notes = strtolower($firstPairing->notes ?? '');
                                    $searchableText = $driverNames . ' ' . $ambulanceName . ' ' . $ambulancePlate . ' ' . $notes;
                                    $driverIds = $groupDrivers->map(function($d) { return $d ? $d->id : ''; })->filter()->implode(',');
                                @endphp
                                <tr data-driver-ids="{{ $driverIds }}" data-ambulance-id="{{ $ambulance ? $ambulance->id : '' }}" data-search-text="{{ $searchableText }}">
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
                                    @php
                                        $isPaired = in_array($ambulance->id, $pairedAmbulances ?? []);
                                    @endphp
                                    <option value="{{ $ambulance->id }}" {{ $isPaired ? 'disabled' : '' }} style="{{ $isPaired ? 'color: #9ca3af;' : '' }}">
                                        {{ $ambulance->name }}@if($ambulance->plate_number) ({{ $ambulance->plate_number }})@endif@if($isPaired) - Already paired@endif
                                    </option>
                                @endforeach
                            </select>
                            <div id="daAmbulanceIdError" style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem; display: none;"></div>
                            <p class="modal-helper">Only 1 driver per ambulance allowed</p>
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
                option.disabled = ambulance.isPaired;
                if (ambulance.isPaired) {
                    option.textContent = ambulance.name + plateText + ' - Already paired';
                    option.style.color = '#9ca3af';
                } else {
                    option.textContent = ambulance.name + plateText;
                    option.style.color = '';
                }
            }
        });
        if (currentAmbulanceValue && options.ambulances.find(a => a.id == currentAmbulanceValue && a.isPaired)) {
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

// Live search and filter functionality
document.addEventListener('DOMContentLoaded', function(){
    // Driver-Medic filters
    const dmSearchInput = document.getElementById('dmSearchInput');
    const dmDriverFilter = document.getElementById('dmDriverFilter');
    const dmMedicFilter = document.getElementById('dmMedicFilter');
    const dmSearchIndicator = document.getElementById('dmSearchIndicator');
    const dmTableBody = document.querySelector('#driverMedicSection tbody');
    
    // Driver-Ambulance filters
    const daSearchInput = document.getElementById('daSearchInput');
    const daDriverFilter = document.getElementById('daDriverFilter');
    const daAmbulanceFilter = document.getElementById('daAmbulanceFilter');
    const daSearchIndicator = document.getElementById('daSearchIndicator');
    const daTableBody = document.querySelector('#driverAmbulanceSection tbody');
    
    let dmSearchTimeout;
    let daSearchTimeout;
    
    // Filter Driver-Medic table
    function filterDriverMedicTable() {
        if (!dmTableBody) return;
        
        const searchTerm = (dmSearchInput?.value || '').toLowerCase().trim();
        const driverId = dmDriverFilter?.value || '';
        const medicId = dmMedicFilter?.value || '';
        
        // Show loading indicator
        if (dmSearchIndicator) {
            dmSearchIndicator.style.display = searchTerm || driverId || medicId ? 'block' : 'none';
        }
        
        const rows = Array.from(dmTableBody.querySelectorAll('tr'));
        let visibleCount = 0;
        
        rows.forEach(row => {
            if (row.classList.contains('empty-state-row')) {
                row.style.display = 'none';
                return;
            }
            
            const searchText = (row.getAttribute('data-search-text') || '').toLowerCase();
            const rowDriverId = row.getAttribute('data-driver-id') || '';
            const rowMedicIds = (row.getAttribute('data-medic-ids') || '').split(',').filter(id => id);
            
            // Check search term
            const matchesSearch = !searchTerm || searchText.includes(searchTerm);
            
            // Check driver filter
            const matchesDriver = !driverId || rowDriverId === driverId;
            
            // Check medic filter
            const matchesMedic = !medicId || rowMedicIds.includes(medicId);
            
            if (matchesSearch && matchesDriver && matchesMedic) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show empty state if no rows visible
        let emptyRow = dmTableBody.querySelector('.empty-state-row');
        if (visibleCount === 0 && rows.length > 0) {
            if (!emptyRow) {
                emptyRow = document.createElement('tr');
                emptyRow.className = 'empty-state-row';
                emptyRow.innerHTML = '<td colspan="6" class="empty-state">No pairings match your filters.</td>';
                dmTableBody.appendChild(emptyRow);
            }
            emptyRow.style.display = '';
        } else if (emptyRow) {
            emptyRow.style.display = 'none';
        }
        
        // Hide loading indicator
        if (dmSearchIndicator) {
            setTimeout(() => {
                dmSearchIndicator.style.display = 'none';
            }, 200);
        }
        
        // Reinitialize pagination
        initializePagination('#driverMedicSection');
    }
    
    // Filter Driver-Ambulance table
    function filterDriverAmbulanceTable() {
        if (!daTableBody) return;
        
        const searchTerm = (daSearchInput?.value || '').toLowerCase().trim();
        const driverId = daDriverFilter?.value || '';
        const ambulanceId = daAmbulanceFilter?.value || '';
        
        // Show loading indicator
        if (daSearchIndicator) {
            daSearchIndicator.style.display = searchTerm || driverId || ambulanceId ? 'block' : 'none';
        }
        
        const rows = Array.from(daTableBody.querySelectorAll('tr'));
        let visibleCount = 0;
        
        rows.forEach(row => {
            if (row.classList.contains('empty-state-row')) {
                row.style.display = 'none';
                return;
            }
            
            const searchText = (row.getAttribute('data-search-text') || '').toLowerCase();
            const rowDriverIds = (row.getAttribute('data-driver-ids') || '').split(',').filter(id => id);
            const rowAmbulanceId = row.getAttribute('data-ambulance-id') || '';
            
            // Check search term
            const matchesSearch = !searchTerm || searchText.includes(searchTerm);
            
            // Check driver filter
            const matchesDriver = !driverId || rowDriverIds.includes(driverId);
            
            // Check ambulance filter
            const matchesAmbulance = !ambulanceId || rowAmbulanceId === ambulanceId;
            
            if (matchesSearch && matchesDriver && matchesAmbulance) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show empty state if no rows visible
        let emptyRow = daTableBody.querySelector('.empty-state-row');
        if (visibleCount === 0 && rows.length > 0) {
            if (!emptyRow) {
                emptyRow = document.createElement('tr');
                emptyRow.className = 'empty-state-row';
                emptyRow.innerHTML = '<td colspan="5" class="empty-state">No pairings match your filters.</td>';
                daTableBody.appendChild(emptyRow);
            }
            emptyRow.style.display = '';
        } else if (emptyRow) {
            emptyRow.style.display = 'none';
        }
        
        // Hide loading indicator
        if (daSearchIndicator) {
            setTimeout(() => {
                daSearchIndicator.style.display = 'none';
            }, 200);
        }
        
        // Reinitialize pagination
        initializePagination('#driverAmbulanceSection');
    }
    
    // Driver-Medic event listeners
    if (dmSearchInput) {
        dmSearchInput.addEventListener('input', function() {
            clearTimeout(dmSearchTimeout);
            dmSearchTimeout = setTimeout(filterDriverMedicTable, 300);
        });
    }
    
    if (dmDriverFilter) {
        dmDriverFilter.addEventListener('change', function() {
            clearTimeout(dmSearchTimeout);
            dmSearchTimeout = setTimeout(filterDriverMedicTable, 100);
        });
    }
    
    if (dmMedicFilter) {
        dmMedicFilter.addEventListener('change', function() {
            clearTimeout(dmSearchTimeout);
            dmSearchTimeout = setTimeout(filterDriverMedicTable, 100);
        });
    }
    
    // Driver-Ambulance event listeners
    if (daSearchInput) {
        daSearchInput.addEventListener('input', function() {
            clearTimeout(daSearchTimeout);
            daSearchTimeout = setTimeout(filterDriverAmbulanceTable, 300);
        });
    }
    
    if (daDriverFilter) {
        daDriverFilter.addEventListener('change', function() {
            clearTimeout(daSearchTimeout);
            daSearchTimeout = setTimeout(filterDriverAmbulanceTable, 100);
        });
    }
    
    if (daAmbulanceFilter) {
        daAmbulanceFilter.addEventListener('change', function() {
            clearTimeout(daSearchTimeout);
            daSearchTimeout = setTimeout(filterDriverAmbulanceTable, 100);
        });
    }
});

// Simple pagination helper function
function initializePagination(sectionId) {
    const section = document.querySelector(sectionId);
    if (!section) return;
    
    const tbl = section.querySelector('table[data-paginate="true"]');
    if (!tbl) return;
    
    const pageSize = parseInt(tbl.getAttribute('data-page-size') || '10', 10);
    const tbody = tbl.querySelector('tbody');
    if (!tbody) return;
    
    // Get only visible rows (not filtered out)
    const allRows = Array.from(tbody.children);
    const visibleRows = allRows.filter(row => {
        return row.style.display !== 'none' && !row.classList.contains('empty-state-row');
    });
    
    if (visibleRows.length <= pageSize) {
        // No pagination needed, show all visible rows
        visibleRows.forEach(row => row.style.display = '');
        return;
    }

    let page = 0;
    const container = section;
    
    // Create pagination controls if they don't exist
    let paginationContainer = container.querySelector('.table-pagination');
    if (!paginationContainer) {
        paginationContainer = document.createElement('div');
        paginationContainer.className = 'table-pagination';
        paginationContainer.style.cssText = 'display: flex; justify-content: center; align-items: center; gap: 0.75rem; padding: 1rem; border-top: 1px solid rgba(226, 232, 240, 0.8);';
        container.appendChild(paginationContainer);
    }
    
    let prevBtn = paginationContainer.querySelector('[data-prev]');
    let nextBtn = paginationContainer.querySelector('[data-next]');
    let pageInfo = paginationContainer.querySelector('.page-info');
    
    if (!prevBtn) {
        prevBtn = document.createElement('button');
        prevBtn.setAttribute('data-prev', '');
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i> Previous';
        prevBtn.style.cssText = 'border: none; border-radius: 10px; padding: 0.6rem 1.2rem; font-weight: 700; font-size: 0.85rem; cursor: pointer; background: #f1f5f9; color: #0f172a; transition: background 0.2s ease;';
        prevBtn.onmouseover = function() { if (!prevBtn.disabled) this.style.background = '#e2e8f0'; };
        prevBtn.onmouseout = function() { if (!prevBtn.disabled) this.style.background = '#f1f5f9'; };
        paginationContainer.insertBefore(prevBtn, paginationContainer.firstChild);
    }
    
    if (!nextBtn) {
        nextBtn = document.createElement('button');
        nextBtn.setAttribute('data-next', '');
        nextBtn.innerHTML = 'Next <i class="fas fa-chevron-right"></i>';
        nextBtn.style.cssText = 'border: none; border-radius: 10px; padding: 0.6rem 1.2rem; font-weight: 700; font-size: 0.85rem; cursor: pointer; background: #f1f5f9; color: #0f172a; transition: background 0.2s ease;';
        nextBtn.onmouseover = function() { if (!nextBtn.disabled) this.style.background = '#e2e8f0'; };
        nextBtn.onmouseout = function() { if (!nextBtn.disabled) this.style.background = '#f1f5f9'; };
        paginationContainer.appendChild(nextBtn);
    }
    
    if (!pageInfo) {
        pageInfo = document.createElement('span');
        pageInfo.className = 'page-info';
        pageInfo.style.cssText = 'font-size: 0.85rem; font-weight: 600; color: var(--muted);';
        if (nextBtn.nextSibling) {
            paginationContainer.insertBefore(pageInfo, nextBtn);
        } else {
            paginationContainer.appendChild(pageInfo);
        }
    }

    function render(){
        const start = page * pageSize;
        const end = Math.min(start + pageSize, visibleRows.length);
        
        // Hide all visible rows first
        visibleRows.forEach(row => row.style.display = 'none');
        
        // Show rows for current page
        visibleRows.slice(start, end).forEach(row => row.style.display = '');
        
        // Update button states
        if (prevBtn) {
            prevBtn.disabled = page === 0;
            prevBtn.style.opacity = page === 0 ? '0.5' : '1';
            prevBtn.style.cursor = page === 0 ? 'not-allowed' : 'pointer';
        }
        if (nextBtn) {
            nextBtn.disabled = end >= visibleRows.length;
            nextBtn.style.opacity = end >= visibleRows.length ? '0.5' : '1';
            nextBtn.style.cursor = end >= visibleRows.length ? 'not-allowed' : 'pointer';
        }
        
        // Update page info
        if (pageInfo) {
            pageInfo.textContent = `Showing ${start + 1}-${end} of ${visibleRows.length}`;
        }
    }
    
    // Remove old event listeners by cloning
    const newPrevBtn = prevBtn.cloneNode(true);
    const newNextBtn = nextBtn.cloneNode(true);
    if (prevBtn && newPrevBtn) {
        prevBtn.parentNode.replaceChild(newPrevBtn, prevBtn);
        newPrevBtn.addEventListener('click', function(){ 
            if (page > 0){ 
                page--; 
                render(); 
            } 
        });
        prevBtn = newPrevBtn;
    }
    if (nextBtn && newNextBtn) {
        nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);
        newNextBtn.addEventListener('click', function(){ 
            if ((page+1)*pageSize < visibleRows.length){ 
                page++; 
                render(); 
            } 
        });
        nextBtn = newNextBtn;
    }
    
    render();
}

// Initialize pagination on page load
document.addEventListener('DOMContentLoaded', function(){
    initializePagination('#driverMedicSection');
    initializePagination('#driverAmbulanceSection');
});
</script>

</body>
</html>