<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $service->title }} | MDRRMO</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/stylie.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
</head>
<body class="bg-gray-100 text-gray-800" style="margin-left: 260px;">

<!-- Toggle Button for Mobile -->
<button class="toggle-btn" onclick="toggleSidebar()" style="display: none; position: fixed; top: 1rem; left: 1rem; z-index: 1001; background: #031273; color: #ffffff; border: none; padding: 0.55rem 0.85rem; border-radius: 10px; cursor: pointer; font-size: 1.1rem; box-shadow: 0 12px 35px rgba(3, 18, 115, 0.35);">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidenav -->
<aside class="sidenav" id="sidenav" style="position: fixed; left: 0; top: 0; width: 260px; height: 100vh; background: linear-gradient(180deg, #031273 0%, #1e3a8a 100%); z-index: 1000; overflow-y: auto; transition: transform 0.3s ease; box-shadow: 15px 0 35px rgba(15, 23, 42, 0.35);">
    <div class="logo-container" style="display: flex; flex-direction: column; align-items: center; padding: 1.5rem 1rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
        <img src="{{ asset('image/LOGOMDRRMO.png') }}" alt="Logo" class="logo-img" style="display: block; margin: 0 auto; width: 80px; height: 80px; object-fit: contain;">
        <div style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 800; color: #ffffff; letter-spacing: .5px;">SILANG DRRMO</div>
        <div id="sidebarDateTime" style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 600; color: #ffffff; font-size: 0.9rem; letter-spacing: 0.3px; padding: 0 12px;">
            <div id="sidebarDate" style="margin-bottom: 4px; font-weight: 600; font-size: 0.85rem;"></div>
            <div id="sidebarTime" style="font-weight: 800; font-size: 1rem;"></div>
        </div>
    </div>
    <nav class="nav-links" style="display: flex; flex-direction: column; gap: 0.35rem; padding: 1.25rem 1rem 2rem;">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: #e5e7eb; font-size: 1rem; font-weight: 600; padding: 0.75rem 1rem; border-radius: 12px; transition: background 0.2s ease, color 0.2s ease;"><i class="fas fa-home"></i> Home</a>
        <a href="{{ url('/services') }}" class="{{ request()->is('services*') ? 'active' : '' }}" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: #e5e7eb; font-size: 1rem; font-weight: 600; padding: 0.75rem 1rem; border-radius: 12px; transition: background 0.2s ease, color 0.2s ease; {{ request()->is('services*') ? 'background: rgba(255, 255, 255, 0.25); color: #ffffff; font-weight: 800;' : '' }}"><i class="fas fa-concierge-bell"></i> Services</a>
        <a href="{{ url('/contact') }}" class="{{ request()->is('contact*') ? 'active' : '' }}" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: #e5e7eb; font-size: 1rem; font-weight: 600; padding: 0.75rem 1rem; border-radius: 12px; transition: background 0.2s ease, color 0.2s ease;"><i class="fas fa-envelope"></i> Contact</a>
    </nav>
</aside>

<style>
.nav-links a:hover {
    background: rgba(255, 255, 255, 0.12);
    color: #ffffff;
}
@media (max-width: 768px) {
    .toggle-btn { display: flex !important; }
    .sidenav { transform: translateX(-100%); }
    .sidenav.active { transform: translateX(0); }
    body { margin-left: 0 !important; }
}
</style>
    {{-- 🔹 Service Info --}}
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white p-6 rounded shadow-sm border border-gray-300">
            <h2 class="text-3xl font-bold mb-4 text-blue-900">{{ $service->title }}</h2>

            @if($service->image)
                <img src="{{ asset('image/' . $service->image) }}"
                     style="display: block; max-width: 100%; max-height: 250px; margin: 0 auto 1rem; border-radius: 8px; object-fit: cover; border: 1px solid #ccc;"
                     alt="{{ $service->title }}">
            @endif

            @if($service->status)
                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded mb-4">
                    {{ $service->status }}
                </span>
            @endif

            <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                {!! nl2br(e($service->description)) !!}
            </p>
        </div>
    </div>

    {{-- 🔹 Interactions --}}
    <div class="container mx-auto px-4 py-12 max-w-4xl space-y-12">

        {{-- ⭐ Leave a Review --}}
        <div style="background: white; padding: 1.5rem; border-radius: 10px; border: 1px solid #ddd; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 1rem; color: #eab308;">⭐ Leave a Review</h3>
            <form method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">

                <div style="margin-bottom: 1rem;">
                    <label style="display:block; font-weight:500; margin-bottom: 0.25rem;">Your Name</label>
                    <input type="text" name="name" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:5px;" required>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display:block; font-weight:500; margin-bottom: 0.25rem;">Rating</label>
                    <div style="display: flex; gap: 0.5rem;">
                        @for ($i = 1; $i <= 5; $i++)
                            <label style="cursor:pointer;">
                                <input type="radio" name="rating" value="{{ $i }}" style="display:none;">
                                <span style="font-size: 1.5rem; color: #facc15;">&#9733;</span>
                            </label>
                        @endfor
                    </div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display:block; font-weight:500; margin-bottom: 0.25rem;">Comment</label>
                    <textarea name="comment" rows="4" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:5px;" required></textarea>
                </div>

                <button type="submit" style="background:#facc15; color:#000; font-weight:500; padding:0.5rem 1rem; border-radius:6px;">
                    Submit Review
                </button>
            </form>
        </div>

        {{-- 📅 Request This Service --}}
        <div style="background: white; padding: 1.5rem; border-radius: 10px; border: 1px solid #ddd; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 1rem; color: #16a34a;">📅 Request This Service</h3>
            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">

                <div style="margin-bottom: 1rem;">
                    <label style="display:block; font-weight:500; margin-bottom: 0.25rem;">Full Name</label>
                    <input type="text" name="name" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:5px;" required>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display:block; font-weight:500; margin-bottom: 0.25rem;">Contact Info (Phone/Email)</label>
                    <input type="text" name="contact_info" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:5px;" required>
                </div>

                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                    <div style="flex:1;">
                        <label style="display:block; font-weight:500; margin-bottom: 0.25rem;">Preferred Date</label>
                        <input type="date" name="preferred_date" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:5px;" required>
                    </div>
                    <div style="flex:1;">
                        <label style="display:block; font-weight:500; margin-bottom: 0.25rem;">Preferred Time</label>
                        <input type="time" name="preferred_time" style="width:100%; padding:0.5rem; border:1px solid #ccc; border-radius:5px;" required>
                    </div>
                </div>

                <button type="submit" style="background:#16a34a; color:white; font-weight:500; padding:0.5rem 1rem; border-radius:6px;">
                    Send Booking Request
                </button>
            </form>
        </div>
    </div>

    {{-- 🔹 Footer --}}
    <footer class="bg-blue-600 text-white text-center py-4 mt-12">
        <p>&copy; {{ date('Y') }} MDRRMO. All rights reserved.</p>
    </footer>
    <script>
  const navbar = document.querySelector('.navbar');
const navbarOffsetTop = navbar.offsetTop;
let lastScrollTop = 0;

window.addEventListener('scroll', () => {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  if (scrollTop > lastScrollTop && scrollTop > navbarOffsetTop) {
    // Scrolling down → stick navbar
    navbar.classList.add('fixed');
  } else if (scrollTop < lastScrollTop) {
    // Scrolling up
    if (scrollTop > navbarOffsetTop) {
      navbar.classList.add('fixed');
    } else {
      // back to default position
      navbar.classList.remove('fixed');
    }
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
});

  </script>
  
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
</script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
