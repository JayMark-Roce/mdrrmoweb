<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Driver - {{ $driver->name }} - MDRRMO</title>
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
            max-width: 1200px;
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
            grid-template-columns: 1.15fr 0.85fr;
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
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.1), transparent 55%);
            z-index: -1;
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
            margin-top: 1.25rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .hero-actions .primary,
        .hero-actions .secondary {
            border: none;
            border-radius: 14px;
            padding: 0.85rem 1.35rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hero-actions .primary {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: #ffffff;
            box-shadow: 0 15px 35px rgba(124, 58, 237, 0.35);
        }

        .hero-actions .secondary {
            background: rgba(15, 23, 42, 0.04);
            color: var(--heading);
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .hero-profile {
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            align-items: flex-start;
            padding: 1.25rem;
            border-radius: 20px;
            background: rgba(37,99,235,0.05);
            border: 1px solid rgba(37,99,235,0.15);
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .form-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 1.75rem;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-card.full-span {
            grid-column: 1 / -1;
        }

        .form-card h5 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--heading);
        }

        .form-fields {
            display: grid;
            gap: 1rem;
        }

        .form-fields.two-col {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        .form-field {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .form-field label {
            font-size: 0.78rem;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 0.06em;
            color: var(--muted);
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
            border-radius: 12px;
            border: 1.5px solid rgba(148, 163, 184, 0.5);
            padding: 0.7rem 0.85rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--heading);
            background: #f8fafc;
            transition: border 0.2s ease, box-shadow 0.2s ease;
            width: 100%;
        }

        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
            background: #ffffff;
        }

        .full-span {
            grid-column: 1 / -1;
        }

        .actions-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        .actions-row button,
        .actions-row a {
            border: none;
            border-radius: 14px;
            padding: 0.85rem 1.4rem;
            font-weight: 800;
            letter-spacing: 0.04em;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }

        .actions-row .primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.35);
        }

        .actions-row .secondary {
            background: rgba(15, 23, 42, 0.04);
            color: var(--heading);
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .actions-row .danger {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            color: #ffffff;
            box-shadow: 0 12px 28px rgba(239, 68, 68, 0.35);
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
    <div class="logo-container" style="display: flex; flex-direction: column; align-items: center;">
        <img src="{{ asset('image/mdrrmologo.jpg') }}" alt="Logo" class="logo-img" style="display:block; margin:0 auto;">
        <div style="margin-top: 8px; display:block; width:100%; text-align:center; font-weight:800; color:#ffffff; letter-spacing:.5px;">SILANG MDRRMO</div>
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
                    <span>Change account</span>
                </button>
            </form>
        </div>
    </div>
</div>

<main class="main-content pt-8" style="padding-top: calc(var(--header-height) + 8px);">
    <div class="driver-layout">
        @if($errors->any())
            <div style="background:#fee2e2;border:1px solid #fecaca;color:#991b1b;padding:1rem 1.25rem;border-radius:16px;">
                <strong>There were some problems with your input:</strong>
                <ul style="margin:0.5rem 0 0 1rem; font-size:0.95rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="hero-card">
            <div>
                <span class="hero-badge"><i class="fas fa-user-edit"></i> Edit driver</span>
                <h3>Refine {{ $driver->name }}’s profile.</h3>
                <p>Update contact details, assignments, and emergency contacts to keep driver records spotless.</p>
                <div class="hero-actions">
                    <a href="{{ route('admin.drivers.show', $driver) }}" class="secondary"><i class="fas fa-arrow-left"></i> Back to profile</a>
                    <a href="{{ route('admin.drivers.index') }}" class="secondary"><i class="fas fa-list"></i> Driver list</a>
                </div>
            </div>
            <div class="hero-profile">
                <span class="status-pill" style="background: rgba(16,185,129,0.12); color:#047857;">
                    <i class="fas fa-user-check"></i> {{ ucfirst($driver->status) }}
                </span>
                <span class="status-pill" style="background: rgba(37,99,235,0.12); color:#1d4ed8;">
                    <i class="fas fa-signal"></i> {{ ucfirst(str_replace('_', ' ', $driver->availability_status)) }}
                </span>
                <span class="status-pill" style="background: rgba(15,23,42,0.08); color:#0f172a;">
                    <i class="fas fa-clock"></i> {{ $driver->last_seen_at ? $driver->last_seen_at->diffForHumans() : 'Never seen' }}
                </span>
            </div>
        </section>

        <form action="{{ route('admin.drivers.update', $driver) }}" method="POST" enctype="multipart/form-data" class="form-grid" data-driver-edit="true">
            @csrf
            @method('PUT')

            <section class="form-card">
                <h5>Driver details</h5>
                <div class="form-fields two-col">
                    <div class="form-field">
                        <label>Full name</label>
                        <input type="text" name="name" value="{{ old('name', $driver->name) }}" required>
                    </div>
                    <div class="form-field">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $driver->email) }}" required>
                    </div>
                    <div class="form-field">
                        <label>Employee ID</label>
                        <input type="text" name="employee_id" value="{{ old('employee_id', $driver->employee_id) }}">
                    </div>
                    <div class="form-field">
                        <label>Status</label>
                        <select name="status" required>
                            <option value="active" {{ old('status', $driver->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $driver->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="suspended" {{ old('status', $driver->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
                            <option value="on_leave" {{ old('status', $driver->status) == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                        </select>
                    </div>
                </div>
            </section>

            <section class="form-card">
                <h5>Personal information</h5>
                <div class="form-fields two-col">
                    <div class="form-field">
                        <label>Phone number</label>
                        <input type="text" name="phone" value="{{ old('phone', $driver->phone) }}">
                    </div>
                    <div class="form-field">
                        <label>Gender</label>
                        <select name="gender">
                            <option value="">Select gender</option>
                            <option value="male" {{ old('gender', $driver->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $driver->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $driver->gender) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label>Date of birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $driver->date_of_birth ? $driver->date_of_birth->format('Y-m-d') : '') }}">
                    </div>
                    <div class="form-field full-span">
                        <label>Address</label>
                        <textarea name="address" rows="2">{{ old('address', $driver->address) }}</textarea>
                    </div>
                    <div class="form-field">
                        <label>New password</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current">
                    </div>
                    <div class="form-field">
                        <label>Confirm password</label>
                        <input type="password" name="password_confirmation" placeholder="Leave blank to keep current">
                    </div>
                </div>
            </section>

            <section class="form-card">
                <h5>Professional information</h5>
                <div class="form-fields two-col">
                    <div class="form-field">
                        <label>Availability status</label>
                        <select name="availability_status" required>
                            <option value="offline" {{ old('availability_status', $driver->availability_status) == 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="busy" {{ old('availability_status', $driver->availability_status) == 'busy' ? 'selected' : '' }}>Busy</option>
                            <option value="on_break" {{ old('availability_status', $driver->availability_status) == 'on_break' ? 'selected' : '' }}>On Break</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label>Assigned ambulance</label>
                        <select name="ambulance_id">
                            <option value="">Not assigned</option>
                            @foreach($ambulances as $ambulance)
                                <option value="{{ $ambulance->id }}" {{ old('ambulance_id', $driver->ambulance_id) == $ambulance->id ? 'selected' : '' }}>{{ $ambulance->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </section>

            <section class="form-card">
                <h5>Emergency contact</h5>
                <div class="form-fields two-col">
                    <div class="form-field">
                        <label>Contact name</label>
                        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $driver->emergency_contact_name) }}">
                    </div>
                    <div class="form-field">
                        <label>Contact phone</label>
                        <input type="text" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $driver->emergency_contact_phone) }}">
                    </div>
                </div>
            </section>

            <section class="form-card full-span">
                <h5>Skills, certifications & notes</h5>
                <div class="form-fields two-col">
                    <div class="form-field">
                        <label>Certifications (one per line)</label>
                        <textarea name="certifications_text" rows="4" placeholder="e.g., First Aid Certification&#10;CPR Certification&#10;Emergency Response Training">{{ old('certifications_text', $driver->certifications && is_array($driver->certifications) ? implode("\n", $driver->certifications) : '') }}</textarea>
                    </div>
                    <div class="form-field">
                        <label>Skills (one per line)</label>
                        <textarea name="skills_text" rows="4" placeholder="e.g., Defensive Driving&#10;Emergency Response&#10;Vehicle Maintenance">{{ old('skills_text', $driver->skills && is_array($driver->skills) ? implode("\n", $driver->skills) : '') }}</textarea>
                    </div>
                    <div class="form-field full-span">
                        <label>Notes</label>
                        <textarea name="notes" rows="3" placeholder="Additional notes about the driver...">{{ old('notes', $driver->notes) }}</textarea>
                    </div>
                </div>
                <div class="actions-row" style="margin-top:0.5rem;">
                    <a href="{{ route('admin.drivers.show', $driver) }}" class="secondary"><i class="fas fa-times"></i> Cancel</a>
                    <button type="submit" class="primary"><i class="fas fa-save"></i> Update driver</button>
                </div>
            </section>
        </form>
    </div>
</main>

<script>
function toggleSidebar() {
  const sidenav = document.getElementById('sidenav');
  if (!sidenav) return;
  sidenav.classList.toggle('active');
}

// User menu + logout redirect (AJAX) like dashboard
document.addEventListener('DOMContentLoaded', function(){
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
});
let currentSection = 1;

function showSection(index) {
    for (let i = 1; i <= 3; i++) {
        const el = document.getElementById(`section-${i}`);
        if (!el) continue;
        el.style.display = i === index ? 'block' : 'none';
    }
    currentSection = index;
}

function nextStep() {
    if (currentSection < 3) {
        showSection(currentSection + 1);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

function prevStep() {
    if (currentSection > 1) {
        showSection(currentSection - 1);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    showSection(1);
});
function toggleSidebar() {
    const sidenav = document.getElementById('sidenav');
    if (!sidenav) return;
    sidenav.classList.toggle('active');
}

// Convert textarea inputs to arrays for form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[data-driver-edit="true"]');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        // Convert certifications text to array
        const certificationsText = document.querySelector('textarea[name="certifications_text"]');
        if (certificationsText) {
            const certifications = certificationsText.value.split('\n').filter(item => item.trim() !== '');
            
            // Create hidden input for certifications array
            const certificationsInput = document.createElement('input');
            certificationsInput.type = 'hidden';
            certificationsInput.name = 'certifications[]';
            certificationsInput.value = JSON.stringify(certifications);
            form.appendChild(certificationsInput);
        }
        
        // Convert skills text to array
        const skillsText = document.querySelector('textarea[name="skills_text"]');
        if (skillsText) {
            const skills = skillsText.value.split('\n').filter(item => item.trim() !== '');
            
            // Create hidden input for skills array
            const skillsInput = document.createElement('input');
            skillsInput.type = 'hidden';
            skillsInput.name = 'skills[]';
            skillsInput.value = JSON.stringify(skills);
            form.appendChild(skillsInput);
        }
    });
});
</script>
</body>
</html>

