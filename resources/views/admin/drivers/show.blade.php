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

        @media (max-width: 980px) {
            .hero-card {
                grid-template-columns: 1fr;
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
    <div class="logo-container">
        <img src="{{ asset('image/mdrrmologo.jpg') }}" alt="Logo" class="logo-img">
    </div>
    <nav class="nav-links">
      <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <span class="nav-link-locked" style="display: block; padding: 12px 16px; color: #9ca3af; cursor: not-allowed; opacity: 0.6; position: relative;"><i class="fas fa-pen"></i> Posting <i class="fas fa-lock" style="font-size: 10px; margin-left: 8px; opacity: 0.7;"></i></span>
      <a href="{{ url('/admin/pairing') }}" class="{{ request()->is('admin/pairing') ? 'active' : '' }}"><i class="fas fa-link"></i> Pairing</a>
      <a href="{{ url('/admin/drivers') }}" class="{{ request()->is('admin/drivers*') ? 'active' : '' }}"><i class="fas fa-car"></i> Drivers</a>
      <a href="{{ url('/admin/medics') }}" class="{{ request()->is('admin/medics*') ? 'active' : '' }}"><i class="fas fa-user-md"></i> Medics</a>
      <a href="{{ url('/admin/gps') }}" class="{{ request()->is('admin/gps') ? 'active' : '' }}"><i class="fas fa-map-marker-alt mr-1"></i> GPS Tracker</a>
      <a href="{{ url('/admin/ambulances') }}" class="{{ request()->is('admin/ambulances*') ? 'active' : '' }}"><i class="fas fa-ambulance mr-1"></i> Ambulances</a>
      <a href="{{ url('/admin/reports') }}" class="{{ request()->is('admin/reports*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Reports</a>

      <div class="logout-form">
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit">
                  <i class="fas fa-sign-out-alt mr-2"></i> Logout
              </button>
          </form>
      </div>
    </nav>
</aside>

<!-- Fixed Top Header -->
<div class="mdrrmo-header" style="border: 2px solid #031273;">
    <h2 class="header-title">SILANG MDRRMO</h2>
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