<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Logs - MDRRMO</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/stylish.css') }}">
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

.logs-page-container {
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

.hero-actions button,
.hero-actions a {
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
    text-decoration: none;
}

.hero-actions button.secondary,
.hero-actions a.secondary {
    background: rgba(15, 23, 42, 0.08);
    color: var(--heading);
    border: 1px solid rgba(15, 23, 42, 0.08);
    box-shadow: none;
}

.hero-actions button:hover,
.hero-actions a:hover {
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
    vertical-align: top;
    background: #ffffff;
}

.logs-table tbody tr:hover td {
    background: rgba(248, 250, 252, 0.7);
}

.badge-success {
    background: #ecfdf5;
    color: #047857;
    padding: 0.35rem 0.85rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}

.badge-failure {
    background: #fef2f2;
    color: #b91c1c;
    padding: 0.35rem 0.85rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}

.logs-empty {
    padding: 2rem;
    text-align: center;
    color: var(--muted);
    display: flex;
    flex-direction: column;
    gap: 0.65rem;
    align-items: center;
}

.logs-empty i {
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

.pagination {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.pagination a,
.pagination span {
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
}

.pagination a {
    background: #ffffff;
    color: #0f172a;
    border: 1px solid rgba(148, 163, 184, 0.5);
}

.pagination a:hover {
    background: rgba(37, 99, 235, 0.08);
}

.pagination span {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #ffffff;
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
    <div class="logs-page-container">

        <section class="hero-card">
            <div>
                <span class="hero-badge">
                    <i class="fas fa-list-alt"></i> Login Activity
                </span>
                <h3>Track every login attempt across the system.</h3>
                <p>
                    Monitor authentication activity for both admin users and drivers. View login times, IP addresses, and success/failure status for security auditing.
                </p>
                <div class="hero-actions">
                    <button type="button" class="primary" id="refreshLogsBtn"><i class="fas fa-rotate"></i> Refresh data</button>
                    <a href="{{ route('admin.drivers.index') }}" class="secondary"><i class="fas fa-arrow-left"></i> Back to Drivers</a>
                </div>
            </div>
            <div class="hero-kpis">
                <div class="hero-kpi-card">
                    <span>Total Admin Logins</span>
                    <strong>{{ $adminLogs->total() }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Total Driver Logins</span>
                    <strong>{{ $driverLogs->total() }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Successful Logins</span>
                    <strong>{{ $adminLogs->where('success', true)->count() + $driverLogs->where('success', true)->count() }}</strong>
                </div>
                <div class="hero-kpi-card">
                    <span>Failed Attempts</span>
                    <strong>{{ $adminLogs->where('success', false)->count() + $driverLogs->where('success', false)->count() }}</strong>
                </div>
            </div>
        </section>

        <!-- Admin Logs Table -->
        <section class="table-card">
            <div class="table-card-header">
                <div>
                    <h4><i class="fas fa-user-shield"></i> Admin Login Logs</h4>
                    <div class="table-meta">
                        <span>Showing {{ $adminLogs->firstItem() ?? 0 }} to {{ $adminLogs->lastItem() ?? 0 }} of {{ $adminLogs->total() }} entries</span>
                    </div>
                </div>
                <div class="table-actions">
                    <button type="button" class="primary" id="refreshAdminLogsBtn"><i class="fas fa-rotate"></i> Refresh</button>
                </div>
            </div>

            <div class="logs-table-wrapper">
                <table class="logs-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Login Time</th>
                            <th>IP Address</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($adminLogs as $log)
                            <tr>
                                <td>{{ $log->name ?? 'N/A' }}</td>
                                <td>{{ $log->email }}</td>
                                <td>{{ $log->login_at->format('M d, Y h:i A') }}</td>
                                <td>{{ $log->ip_address ?? 'N/A' }}</td>
                                <td>
                                    @if($log->success)
                                        <span class="badge-success">
                                            <i class="fas fa-check-circle"></i> Success
                                        </span>
                                    @else
                                        <span class="badge-failure">
                                            <i class="fas fa-times-circle"></i> Failed
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="logs-empty">
                                        <i class="fas fa-inbox"></i>
                                        <p>No admin login logs found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($adminLogs->hasPages())
                <div class="pagination-bar">
                    <div></div>
                    <div class="pagination">
                        {{ $adminLogs->appends(request()->except('admin_page'))->links() }}
                    </div>
                </div>
            @endif
        </section>

        <!-- Driver Logs Table -->
        <section class="table-card">
            <div class="table-card-header">
                <div>
                    <h4><i class="fas fa-car"></i> Driver Login Logs</h4>
                    <div class="table-meta">
                        <span>Showing {{ $driverLogs->firstItem() ?? 0 }} to {{ $driverLogs->lastItem() ?? 0 }} of {{ $driverLogs->total() }} entries</span>
                    </div>
                </div>
                <div class="table-actions">
                    <button type="button" class="primary" id="refreshDriverLogsBtn"><i class="fas fa-rotate"></i> Refresh</button>
                </div>
            </div>

            <div class="logs-table-wrapper">
                <table class="logs-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Login Time</th>
                            <th>IP Address</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($driverLogs as $log)
                            <tr>
                                <td>{{ $log->name ?? 'N/A' }}</td>
                                <td>{{ $log->email }}</td>
                                <td>{{ $log->login_at->format('M d, Y h:i A') }}</td>
                                <td>{{ $log->ip_address ?? 'N/A' }}</td>
                                <td>
                                    @if($log->success)
                                        <span class="badge-success">
                                            <i class="fas fa-check-circle"></i> Success
                                        </span>
                                    @else
                                        <span class="badge-failure">
                                            <i class="fas fa-times-circle"></i> Failed
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="logs-empty">
                                        <i class="fas fa-inbox"></i>
                                        <p>No driver login logs found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($driverLogs->hasPages())
                <div class="pagination-bar">
                    <div></div>
                    <div class="pagination">
                        {{ $driverLogs->appends(request()->except('driver_page'))->links() }}
                    </div>
                </div>
            @endif
        </section>

    </div>
</main>

<script>
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

    // Refresh buttons
    document.getElementById('refreshLogsBtn')?.addEventListener('click', () => window.location.reload());
    document.getElementById('refreshAdminLogsBtn')?.addEventListener('click', () => window.location.reload());
    document.getElementById('refreshDriverLogsBtn')?.addEventListener('click', () => window.location.reload());

    // User menu toggle
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
        
        document.addEventListener('click', function(e){
            if (userMenu && userDropdown && !userMenu.contains(e.target)) {
                userDropdown.style.display = 'none';
            }
        });
    }
});
</script>

</body>
</html>
