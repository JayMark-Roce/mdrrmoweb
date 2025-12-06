<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Services & Bookings | Admin</title>
    <link rel="stylesheet" href="{{ asset('css/stylish.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
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
<div class="mdrrmo-header" style="border: 2px solid #031273;">
    <h2 class="header-title">SILANG MDRRMO</h2>
</div>
<!-- Main content -->
<main class="main-content pt-24">
    <div class="grid mb-10">
        <div class="border p-4 rounded">
            <h2 class="section-title"><i class="fas fa-plus-circle"></i> Add New Service</h2>
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded shadow mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded shadow mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded shadow mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-semibold">Title:</label>
                    <input type="text" name="title" class="border p-2 w-full" required>
                </div>
                <div>
                    <label class="block font-semibold">Description:</label>
                    <textarea name="description" class="border p-2 w-full"></textarea>
                </div>
                <div>
                    <label class="block font-semibold">Category:</label>
                    <input type="text" name="category" class="border p-2 w-full" placeholder="e.g. First Aid, Training, etc.">
                </div>
                <div>
                    <label class="block font-semibold">Status:</label>
                    <input type="text" name="status" class="border p-2 w-full" placeholder="Available, Coming Soon, etc.">
                </div>
                <div>
                    <label class="block font-semibold">Image:</label>
                    <input type="file" name="image" class="border p-2 w-full">
                </div>
                <div class="text-center">
                    <button type="submit" class="text-white px-4 py-2 rounded" style="width: 170px; background-color: #4338ca;">
                        <i class="fas fa-save mr-2"></i> Save Service
                    </button>
                </div>
            </form>
        </div>
    </div>
    <hr class="my-divider" style="border: none; height: 4px; background: linear-gradient(to right, #031273, #4CC9F0); width: 80%; margin-top:175px; border-radius: 2px; box-shadow: 0 2px 5px rgba(0,0,0,0.12); ">
    
    @if(isset($pendingBookings) || isset($approvedBookings) || isset($rejectedBookings))
    <div class="grid mb-10">
        <div class="border p-4 rounded">
            <h2 class="section-title"><i class="fas fa-calendar-alt"></i> Service Bookings</h2>
            {{-- ✅ Flash Message --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded shadow mb-4">
                    {{ session('success') }}
                </div>
            @endif
            {{-- 🔶 Pending --}}
            @if(isset($pendingBookings))
            <div class="mb-4">
                <h3 class="text-base font-semibold text-yellow-700 mb-2"><i class="fas fa-clock"></i> Pending Bookings</h3>
                @if($pendingBookings->isEmpty())
                    <p class="text-gray-500 italic text-sm">No pending bookings.</p>
                @else
                    <table class="w-full bg-white border rounded shadow text-xs overflow-hidden">
                        <thead class="bg-yellow-400 text-white">
                            <tr>
                                <th class="p-2 text-left">Name</th>
                                <th class="p-2 text-left">Contact</th>
                                <th class="p-2 text-left">Service</th>
                                <th class="p-2 text-left">Date</th>
                                <th class="p-2 text-left">Time</th>
                                <th class="p-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingBookings as $booking)
                                <tr class="border-t">
                                    <td class="p-2">{{ $booking->name }}</td>
                                    <td class="p-2 text-xs">{{ Str::limit($booking->contact_info, 20) }}</td>
                                    <td class="p-2">{{ Str::limit($booking->service->title, 15) }}</td>
                                    <td class="p-2">{{ $booking->preferred_date }}</td>
                                    <td class="p-2">{{ \Carbon\Carbon::parse($booking->preferred_time)->format('g:i A') }}</td>
                                    <td class="p-2 flex gap-1">
                                        <form method="POST" action="{{ route('admin.bookings.approve', $booking->id) }}">
                                            @csrf
                                            <button type="submit" class="flex items-center justify-center text-white rounded shadow text-xs p-0 m-0" style="width: 36px; height: 36px; background-color: #059669;">
                                                <i class="fas fa-check" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; font-size: 1.2rem; line-height: 1; margin: 0; padding: 0;"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.bookings.reject', $booking->id) }}">
                                            @csrf
                                            <button type="submit" class="flex items-center justify-center text-white rounded shadow text-xs p-0 m-0" style="width: 36px; height: 36px; background-color: #dc2626;">
                                                <i class="fas fa-times" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; font-size: 1.2rem; line-height: 1; margin: 0; padding: 0;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <hr class="my-divider" style="border: none; height: 4px; background: linear-gradient(to right, #031273, #4CC9F0); width: 100%; margin: 2rem auto; border-radius: 2px; box-shadow: 0 2px 5px rgba(0,0,0,0.12);">
            @endif
            {{-- ✅ Approved --}}
            @if(isset($approvedBookings))
            <div class="mb-4">
                <h3 class="text-base font-semibold text-green-700 mb-2"><i class="fas fa-check-circle"></i> Approved Bookings</h3>
                @if($approvedBookings->isEmpty())
                    <p class="text-gray-500 italic text-sm">No approved bookings.</p>
                @else
                    <table class="w-full bg-white border rounded shadow text-xs overflow-hidden">
                        <thead class="bg-green-500 text-white">
                            <tr>
                                <th class="p-2 text-left">Name</th>
                                <th class="p-2 text-left">Contact</th>
                                <th class="p-2 text-left">Service</th>
                                <th class="p-2 text-left">Date</th>
                                <th class="p-2 text-left">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approvedBookings as $booking)
                                <tr class="border-t">
                                    <td class="p-2">{{ $booking->name }}</td>
                                    <td class="p-2 text-xs">{{ Str::limit($booking->contact_info, 20) }}</td>
                                    <td class="p-2">{{ Str::limit($booking->service->title, 15) }}</td>
                                    <td class="p-2">{{ $booking->preferred_date }}</td>
                                    <td class="p-2">{{ \Carbon\Carbon::parse($booking->preferred_time)->format('g:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <hr class="my-divider" style="border: none; height: 4px; background: linear-gradient(to right, #031273, #4CC9F0); width: 100%; margin: 2rem auto; border-radius: 2px; box-shadow: 0 2px 5px rgba(0,0,0,0.12);">
            @endif
            {{-- ❌ Rejected --}}
            @if(isset($rejectedBookings))
            <div class="mb-4">
                <h3 class="text-base font-semibold text-red-700 mb-2"><i class="fas fa-times-circle"></i> Rejected Bookings</h3>
                @if($rejectedBookings->isEmpty())
                    <p class="text-gray-500 italic text-sm">No rejected bookings.</p>
                @else
                    <table class="w-full bg-white border rounded shadow text-xs overflow-hidden">
                        <thead class="bg-red-500 text-white">
                            <tr>
                                <th class="p-2 text-left">Name</th>
                                <th class="p-2 text-left">Contact</th>
                                <th class="p-2 text-left">Service</th>
                                <th class="p-2 text-left">Date</th>
                                <th class="p-2 text-left">Time</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($rejectedBookings as $booking)
                                <tr class="border-t">
                                    <td class="p-2">{{ $booking->name }}</td>
                                    <td class="p-2 text-xs">{{ Str::limit($booking->contact_info, 20) }}</td>
                                    <td class="p-2">{{ Str::limit($booking->service->title, 15) }}</td>
                                    <td class="p-2">{{ $booking->preferred_date }}</td>
                                    <td class="p-2">{{ \Carbon\Carbon::parse($booking->preferred_time)->format('g:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <hr class="my-divider" style="border: none; height: 4px; background: linear-gradient(to right, #031273, #4CC9F0); width: 100%; margin: 2rem auto; border-radius: 2px; box-shadow: 0 2px 5px rgba(0,0,0,0.12);">
            @endif
        </div>
        
    </div>
    @endif
</main>
<hr class="my-divider" style="border: none; height: 4px; background: linear-gradient(to right, #031273, #4CC9F0); width: 100%; margin: 2rem auto; border-radius: 2px; box-shadow: 0 2px 5px rgba(0,0,0,0.12);">
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
    
    // Auto-refresh after adding service if success message is shown
    @if(session('success'))
        setTimeout(function() {
            location.reload();
        }, 1500); // Refresh after 1.5 seconds
    @endif
</script>
</body>
</html>