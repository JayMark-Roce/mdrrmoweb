<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $driver->name }} - Driver Details - MDRRMO</title>
    <link rel="stylesheet" href="{{ asset('css/stylish.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
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
        :root {
            --bg-gradient: radial-gradient(circle at top, #fdf2ff 0%, #eef2ff 45%, #f5f7fb 100%);
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --heading: #0f172a;
            --muted: #6b7280;
            --accent: #2563eb;
            --accent-alt: #6366f1;
            --warning: #f59e0b;
            --success: #10b981;
            --danger: #ef4444;
            --shadow-lg: 0 30px 60px rgba(15, 23, 42, 0.12);
            --rounded-xl: 28px;
            --nav-width: 260px;
        }

        html, body {
            min-height: 100vh;
            background: var(--bg-gradient);
            font-family: 'Nunito', 'Segoe UI', system-ui, sans-serif;
            color: var(--heading);
            overflow-x: hidden;
        }

        .driver-layout {
            max-width: 1350px;
            margin: 0 auto;
            padding: 2.5rem clamp(1rem, 4vw, 3rem);
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .hero-card {
            background: var(--card-bg);
            border-radius: var(--rounded-xl);
            padding: clamp(1.75rem, 4vw, 3rem);
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(99, 102, 241, 0.12);
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: clamp(1.5rem, 3vw, 2.5rem);
            align-items: center;
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .hero-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.1), transparent 50%);
            z-index: -1;
        }

        .hero-profile {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            align-items: flex-start;
            padding: 1.25rem;
            border-radius: 20px;
            background: rgba(37,99,235,0.05);
            border: 1px solid rgba(37,99,235,0.15);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.08);
            color: #1d4ed8;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .hero-actions {
            margin-top: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
        }

        .hero-actions .primary {
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

        .hero-actions .secondary {
            border-radius: 14px;
            padding: 0.85rem 1.35rem;
            font-weight: 700;
            border: 1px solid rgba(15, 23, 42, 0.08);
            background: rgba(15, 23, 42, 0.04);
            color: var(--heading);
            cursor: pointer;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
        }

        .summary-card {
            background: var(--card-bg);
            border-radius: 22px;
            padding: 1.35rem;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 25px 50px rgba(15, 23, 42, 0.08);
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .summary-card small {
            font-weight: 800;
            text-transform: uppercase;
            color: var(--muted);
            letter-spacing: 0.12em;
        }

        .summary-card h4 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 900;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .info-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 1.5rem;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-card h5 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--heading);
        }

        .info-field {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .info-field span {
            font-size: 0.72rem;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 0.06em;
            color: var(--muted);
        }

        .info-field strong {
            font-size: 0.98rem;
            color: var(--heading);
        }

        .info-value-white {
            color: var(--muted);
            font-size: 0.9rem;
        }

        .status-pill {
            border-radius: 999px;
            padding: 0.35rem 0.9rem;
            font-size: 0.78rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .status-pill--active { background: rgba(16, 185, 129, 0.15); color: #047857; }
        .status-pill--inactive { background: rgba(107, 114, 128, 0.15); color: #374151; }
        .status-pill--busy { background: rgba(239, 68, 68, 0.15); color: #b91c1c; }

        .actions-panel {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .action-btn {
            border: none;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            font-weight: 700;
            font-size: 0.92rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            cursor: pointer;
            background: #f1f5f9;
            color: #0f172a;
            transition: background 0.2s ease, transform 0.2s ease;
            width: auto;
        }

        .action-btn.primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.35);
        }

        .action-btn.danger {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            color: #ffffff;
            box-shadow: 0 12px 28px rgba(239, 68, 68, 0.35);
        }

        .timeline {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .timeline-item {
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
        }

        .timeline-item i {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(37, 99, 235, 0.1);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .actions-panel .action-btn,
        .actions-panel form .action-btn {
            width: 100%;
            justify-content: center;
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

        @media (max-width: 980px) {
            .hero-card {
                grid-template-columns: 1fr;
            }
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
<!-- Fixed Top Header with user menu -->
<div class="mdrrmo-header" style="background:#F7F7F7; box-shadow: 0 2px 8px rgba(0,0,0,0.12); border: none; min-height: var(--header-height); padding: 1rem 2rem; display: flex; align-items: center; justify-content: center; position: fixed; top: 0; margin-left: 260px; width: calc(100% - 260px); z-index: 1200;">
    <h2 class="header-title" style="display:none;"></h2>
    @php $firstName = explode(' ', auth()->user()->name ?? 'Admin')[0]; @endphp
    <div id="userMenu" style="position: fixed; right: 16px; top: 16px; display: inline-flex; align-items: center; gap: 10px; cursor: pointer; color: #e5e7eb; z-index: 1300; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); padding: 6px 10px; border-radius: 9999px; box-shadow: 0 6px 18px rgba(0,0,0,0.18); backdrop-filter: saturate(140%);">
        <div style="width: 28px; height: 28px; border-radius: 9999px; background: linear-gradient(135deg,#4CC9F0,#031273); display: inline-flex; align-items: center; justify-content: center; position: relative;">
            <i class="fas fa-user-shield" style="font-size: 14px; color: #ffffff;"></i>
            <span style="position: absolute; right: -1px; bottom: -1px; width: 8px; height: 8px; border-radius: 9999px; background: #22c55e; box-shadow: 0 0 0 2px #0c2d5a;"></span>
        </div>
        <span style="font-weight: 800; color: #000000; letter-spacing: .2px;">{{ $firstName }}</span>
        <i class="fas fa-chevron-down" style="font-size: 10px; color: rgba(255,255,255,0.85);"></i>
        <div id="userDropdown" style="display: none; position: absolute; right: 0; top: calc(100% + 12px); background: #ffffff; color: #0f172a; border-radius: 10px; box-shadow: 0 10px 24px rgba(0,0,0,0.2); padding: 8px; min-width: 160px; z-index: 1301;">
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

<main class="main-content pt-8">
    <div class="driver-layout">
        <section class="hero-card">
            <div>
                <span class="hero-badge"><i class="fas fa-id-card"></i> Driver profile</span>
                <h3>{{ $driver->name }}</h3>
                <p>Monitor {{ $driver->name }}’s readiness, assignments, and recent activity from a single beautiful dashboard.</p>
                <div class="hero-actions">
                    <a href="{{ route('admin.drivers.index') }}" class="secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <a href="{{ route('admin.drivers.edit', $driver) }}" class="secondary"><i class="fas fa-pen"></i> Edit</a>
                </div>
            </div>
            <div class="hero-profile">
                <span class="status-pill status-pill--{{ $driver->status === 'active' ? 'active' : 'inactive' }}">
                    <i class="fas fa-user-check"></i> {{ ucfirst($driver->status) }}
                </span>
                <span class="status-pill status-pill--{{ $driver->availability_status === 'online' ? 'active' : ($driver->availability_status === 'busy' ? 'busy' : 'inactive') }}">
                    <i class="fas fa-signal"></i> {{ ucfirst(str_replace('_', ' ', $driver->availability_status)) }}
                </span>
                <span class="status-pill" style="background: rgba(15,23,42,0.08); color:#0f172a;">
                    <i class="fas fa-clock"></i> {{ $driver->last_seen_at ? $driver->last_seen_at->diffForHumans() : 'Never seen' }}
                </span>
            </div>
        </section>

        <section class="summary-grid">
            <article class="summary-card">
                <small>Assigned unit</small>
                <h4>{{ $driver->ambulance->name ?? 'No ambulance' }}</h4>
                <span class="insight-trend"><i class="fas fa-ambulance" style="color: var(--accent);"></i>{{ $driver->ambulance ? 'Active pairing' : 'Awaiting assignment' }}</span>
            </article>
            <article class="summary-card">
                <small>Last seen</small>
                <h4>{{ $driver->last_seen_at ? $driver->last_seen_at->diffForHumans() : 'Never' }}</h4>
                <span class="insight-trend"><i class="fas fa-clock" style="color: var(--warning);"></i>Presence status</span>
            </article>
            <article class="summary-card">
                <small>Employee ID</small>
                <h4>{{ $driver->employee_id ?? 'N/A' }}</h4>
                <span class="insight-trend"><i class="fas fa-id-card-clip" style="color: var(--muted);"></i>Records updated</span>
            </article>
        </section>

        <section class="info-grid">
            <article class="info-card">
                <h5>Contact information</h5>
                <div class="info-field">
                    <span>Email</span>
                    <strong>{{ $driver->email ?? 'Not provided' }}</strong>
                </div>
                <div class="info-field">
                    <span>Phone</span>
                    <strong>{{ $driver->phone ?? 'Not provided' }}</strong>
                </div>
                <div class="info-field">
                    <span>Address</span>
                    <strong>{{ $driver->address ?? 'Not provided' }}</strong>
                </div>
            </article>

            <article class="info-card">
                <h5>Personal details</h5>
                <div class="info-field">
                    <span>Gender</span>
                    <strong>{{ $driver->gender ? ucfirst($driver->gender) : 'Not specified' }}</strong>
                </div>
                <div class="info-field">
                    <span>Date of birth</span>
                    <strong>
                        @if($driver->date_of_birth)
                            {{ $driver->date_of_birth->format('M d, Y') }}
                            @if($driver->age)
                                <span style="color: var(--muted);">({{ $driver->age }} yrs)</span>
                            @endif
                        @else
                            Not provided
                        @endif
                    </strong>
                </div>
                <div class="info-field">
                    <span>Emergency contact</span>
                    <strong>{{ $driver->emergency_contact_name ?? 'Not provided' }} {{ $driver->emergency_contact_phone ? '• '.$driver->emergency_contact_phone : '' }}</strong>
                </div>
            </article>

            <article class="info-card">
                <h5>Status & resource management</h5>
                <div class="timeline">
                    <div class="timeline-item">
                        <i class="fas fa-calendar-plus"></i>
                        <div>
                            <strong>Profile created</strong>
                            <div class="info-value-white">{{ $driver->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <i class="fas fa-history"></i>
                        <div>
                            <strong>Last updated</strong>
                            <div class="info-value-white">{{ $driver->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <i class="fas fa-eye"></i>
                        <div>
                            <strong>Last seen</strong>
                            <div class="info-value-white">{{ $driver->last_seen_at ? $driver->last_seen_at->diffForHumans() : 'Never' }}</div>
                        </div>
                    </div>
                </div>
            </article>

        
        </section>
    </div>
</main>

<script>
function toggleSidebar() {
    const sidenav = document.getElementById('sidenav');
    if (!sidenav) return;
    sidenav.classList.toggle('active');
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

function changeStatus(status) {
    if (confirm(`Are you sure you want to set this driver's status to ${status}?`)) {
        fetch(`/admin/drivers/{{ $driver->id }}/change-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                availability_status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating status');
        });
    }
}
</script>
</body>
</html>