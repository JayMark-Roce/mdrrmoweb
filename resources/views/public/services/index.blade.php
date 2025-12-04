<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services | MDRRMO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/stylie.css') }}?v={{ filemtime(public_path('css/style.css')) }}">



</head>
<body class="bg-gray-100 text-gray-800" style="margin-left: 260px;">

  <section class="showcase fade-in">
    <div class="logo">
<img src="{{ asset('image/mdrrmologo2.png') }}" alt="MDRRMO Logo">
    </div>
    <div class="text-content">
      <p>THE OFFICIAL WEBSITE OF THE</p>
      <h1>SILANG DISASTER RISK REDUCTION MANAGEMENT OFFICE</h1>
    </div>
  </section>

  <div class="emptybox"></div>

<!-- Toggle Button for Mobile -->
<button class="toggle-btn" onclick="toggleSidebar()" style="display: none; position: fixed; top: 1rem; left: 1rem; z-index: 1001; background: #031273; color: #ffffff; border: none; padding: 0.55rem 0.85rem; border-radius: 10px; cursor: pointer; font-size: 1.1rem; box-shadow: 0 12px 35px rgba(3, 18, 115, 0.35);">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidenav -->
<aside class="sidenav" id="sidenav" style="position: fixed; left: 0; top: 0; width: 260px; height: 100vh; background: linear-gradient(180deg, #031273 0%, #1e3a8a 100%); z-index: 1000; overflow-y: auto; transition: transform 0.3s ease; box-shadow: 15px 0 35px rgba(15, 23, 42, 0.35);">
    <div class="logo-container" style="display: flex; flex-direction: column; align-items: center; padding: 1.5rem 1rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
        <img src="{{ asset('image/LOGOMDRRMO.png') }}" alt="Logo" class="logo-img" style="display: block; margin: 0 auto; width: 80px; height: 80px; object-fit: contain;">
        <div style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 800; color: #ffffff; letter-spacing: .5px;">SILANG MDRRMO</div>
        <div id="sidebarDateTime" style="margin-top: 8px; display: block; width: 100%; text-align: center; font-weight: 600; color: rgba(255, 255, 255, 0.85); font-size: 0.75rem; letter-spacing: 0.3px; padding: 0 12px;">
            <div id="sidebarDate" style="margin-bottom: 4px;"></div>
            <div id="sidebarTime" style="font-weight: 700; font-size: 0.8rem;"></div>
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



  <h2 class="text-3xl font-bold text-center mb-8 mt-4 fade-in">Our Services</h2>
  
<div class="container-fluid fade-in">

   @php
    $grouped = $services->groupBy('category');
    $colors = ['#EAF4FB', '#EAF4FB', '#EAF4FB', '#EAF4FB', '#EAF4FB'];
 // pastel background choices
    $i = 0;
@endphp

@foreach($grouped as $category => $items)
    <!-- Full width block with background -->
    <div class="w-100 py-6 fade-in" style="background-color: {{ $colors[$i % count($colors)] }};">
        
        <!-- Inner container to center content -->
        <div class="max-w-7xl mx-auto px-4">
    <h3 class="category-divider fade-in mb-4 text-xl font-bold text-center">
        {{ $category ?? 'Uncategorized' }}
    </h3>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 services-wrapper pb-12">
        @foreach($items as $service)
            <a href="{{ route('services.show', $service->id) }}"
               class="service-card bg-white rounded-lg shadow-sm hover:shadow-md transition-transform hover:-translate-y-1 duration-200 overflow-hidden border border-gray-200 fade-in">

                @if($service->image)
                    <img src="{{ asset('image/' . $service->image) }}"
                         class="w-full h-36 object-cover"
                         alt="{{ $service->title }}">
                @endif

                <div class="p-3 space-y-2">
                    <h3 class="text-lg font-semibold text-gray-800 leading-tight">
                        {{ $service->title }}
                    </h3>
                    <p class="text-sm text-gray-600 leading-snug">
                        {{ Str::limit($service->description, 60) }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</div>

    </div>

    @php $i++; @endphp
@endforeach

</div>

  <footer class="bg-blue-600 text-white text-center py-4 mt-8">
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

  {{-- Simple JS for search --}}
  <script>
      const searchInput = document.getElementById('searchInput');
      const cards = document.querySelectorAll('.service-card');

      searchInput.addEventListener('keyup', function () {
          let value = this.value.toLowerCase();
          cards.forEach(card => {
              const text = card.textContent.toLowerCase();
              card.style.display = text.includes(value) ? 'block' : 'none';
          });
      });
  </script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
  const faders = document.querySelectorAll('.fade-in');

  const options = {
    root: null,           // viewport
    rootMargin: '0px 0px -100px 0px', // trigger slightly before element fully visible
    threshold: 0          // trigger even if tiny bit visible
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      } else {
        entry.target.classList.remove('visible');
      }
    });
  }, options);

  faders.forEach(el => observer.observe(el));
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
