<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- ✅ Your Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/stylish.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Vite for Tailwind/JS if needed -->
    <style>
        .nav-links {
            display: flex !important;
            flex-direction: column !important;
            gap: 1rem !important;
            width: 100% !important;
        }

        .nav-links a {
            text-decoration: none !important;
            color: white !important;
            font-size: 1rem !important;
            font-weight: 600 !important;
            padding: 0.75rem 1rem !important;
            border-radius: 8px !important;
            transition: background-color 0.2s !important;
            display: block !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }

        .nav-links i {
            margin-right: 0.5rem !important;
        }

        .nav-links a:hover {
            background-color: #f28c28 !important;
            color: #0c2d5a !important;
        }

        .nav-links a.active {
            background-color: #f28c28 !important;
            color: #0c2d5a !important;
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
      <a href="{{ url('/admin/pairing') }}" class="{{ request()->is('admin/pairing') ? 'active' : '' }}"><i class="fas fa-link"></i> Pairing</a>
      <a href="{{ url('/admin/drivers') }}" class="{{ request()->is('admin/drivers*') ? 'active' : '' }}"><i class="fas fa-car"></i> Drivers</a>
      <a href="{{ url('/admin/medics') }}" class="{{ request()->is('admin/medics*') ? 'active' : '' }}"><i class="fas fa-plus"></i> Create</a>
      <a href="{{ url('/admin/gps') }}" class="{{ request()->is('admin/gps') ? 'active' : '' }}"><i class="fas fa-map-marker-alt mr-1"></i> GPS Tracker</a>
      <a href="{{ url('/admin/reports') }}" class="{{ request()->is('admin/reports*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Reports</a>
      <a href="{{ route('reported-cases') }}" class="{{ request()->routeIs('reported-cases') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Reported Cases</a>
    </nav>
</aside>

    <!-- Fixed Top Header -->
   <!-- ✅ Fixed Top Header -->
<div class="mdrrmo-header" style="border: 2px solid #031273;">
    <h2 class="header-title">SILANG MDRRMO</h2>

</div>

    <!-- Main content (with padding top to not hide under fixed header) -->
    <main class="main-content pt-24">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Add New Ambulance --}}
        <div class="grid gap-2 p-2 rounded shadow mb-8" style="max-width: 500px; width: 100%; margin: 0 auto; margin-top: 50px;">
            <div class="border p-0 rounded">
                <h3 class="section-title"><i class="fas fa-ambulance"></i> Add New Ambulance</h3>
                <form action="{{ route('admin.ambulances.store') }}" method="POST">
                    @csrf
                    <div class="mb-1">
                        <label class="block">Name</label>
                        <input type="text" name="name" class="border p-1 w-full" required>
                    </div>
                    <div class="mb-1">
                        <label class="block">Status</label>
                        <select name="status" class="border p-1 w-full" required>
                            <option value="Available">Available</option>
                            <option value="Out">Out</option>
                            <option value="Unavailable">Unavailable</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="text-white px-4 py-2 rounded" style="width: 180px; background-color: #4338ca;">
                            <i class="fas fa-plus mr-2"></i> Add Ambulance
                        </button>
                    </div>
                </form>
            </div>
        </div>
<hr class="my-divider" style="width:750px;"> 
        {{-- Existing Ambulances --}}
        <div class="grid gap-6 p-6 rounded shadow mb-8" style="margin-bottom:100px;">
            <div class="border p-4 rounded">
                <h3 class="section-title"><i class="fas fa-ambulance"></i> Existing Ambulances</h3>
                <div class="centered-table">
                    <table class="text-lg border bg-white shadow rounded" style="width:100%;">
                        <thead class="bg-gray-100 text-base uppercase text-gray-600 border-b">
                            <tr>
                                <th class="px-4 py-2" style="font-size: 32px;">Name</th>
                                <th class="px-4 py-2" style="font-size: 32px; ">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ambulances as $amb)
                                <tr class="border-t" style="text-align:center">
                                    
                                    <td class="px-4 py-2" style="font-size: 16px;">{{ $amb->name }}</td>
                                    <td class="px-4 py-2" style="font-size: 16px;">
                                        <span class="px-2 py-1 rounded text-white 
                                            @if($amb->status === 'Available') bg-green-500 
                                            @elseif($amb->status === 'Out') bg-yellow-500 
                                            @else bg-red-500 
                                            @endif">
                                            {{ $amb->status }}
                                        </span>
                                    </td>
                                
                                </tr>
                            @empty
                                <tr><td colspan="2" class="text-center py-4" style="font-size: 16px;">No ambulances yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<hr class="my-divider"> 
    </main>
<script>
    function toggleSidebar() {
        const sidenav = document.querySelector('.sidenav');
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
</script>

</body>
</html>
