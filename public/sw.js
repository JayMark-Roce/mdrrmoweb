const CACHE_NAME = 'mdrrmo-driver-v3'; // Version bump to force update
const CORE_ASSETS = [
  '/',
  '/driver/send-location',
  '/manifest.webmanifest',
  '/icons/icon-192.svg',
  '/icons/icon-512.svg'
];

// Flag to track if we're on localhost
let isLocalhost = false;

self.addEventListener('activate', (event) => {
  event.waitUntil(
    (async () => {
      // Check if we're on localhost by examining clients
      try {
        const clients = await self.clients.matchAll();
        if (clients.length > 0) {
          const clientUrl = new URL(clients[0].url);
          isLocalhost = clientUrl.hostname === 'localhost' || 
                       clientUrl.hostname === '127.0.0.1' || 
                       clientUrl.hostname === '::1';
          
          if (isLocalhost) {
            // Unregister this service worker for localhost
            await self.registration.unregister();
            // Clear all caches
            const cacheNames = await caches.keys();
            await Promise.all(cacheNames.map(cacheName => caches.delete(cacheName)));
            return; // Don't claim clients or continue
          }
        }
      } catch (e) {
        // If we can't determine, assume localhost to be safe
        isLocalhost = true;
        try {
          await self.registration.unregister();
          const cacheNames = await caches.keys();
          await Promise.all(cacheNames.map(cacheName => caches.delete(cacheName)));
        } catch (err) {
          // Ignore errors
        }
        return;
      }
      
      // Normal activation for non-localhost
      const keys = await caches.keys();
      await Promise.all(keys.filter(k => k !== CACHE_NAME).map(k => caches.delete(k)));
      await self.clients.claim();
    })()
  );
});

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(CORE_ASSETS)).then(() => self.skipWaiting())
  );
});

// Network-first for GET requests; ignore POSTs like /update-location
self.addEventListener('fetch', (event) => {
  const req = event.request;
  
  // If we determined we're on localhost, don't intercept anything
  if (isLocalhost) {
    return; // Let browser handle it directly
  }
  
  // Completely skip service worker for localhost/127.0.0.1 in development
  // Don't intercept these requests at all - let browser handle them directly
  try {
    const url = new URL(req.url);
    const isLocalhostRequest = url.hostname === 'localhost' || 
                              url.hostname === '127.0.0.1' || 
                              url.hostname === '::1' ||
                              (url.protocol === 'https:' && (url.hostname === 'localhost' || url.hostname === '127.0.0.1'));
    
    if (isLocalhostRequest) {
      // Don't call event.respondWith() - this lets the browser handle the request normally
      return;
    }
  } catch (e) {
    // If URL parsing fails, skip interception
    return;
  }
  
  // Only handle GET requests
  if (req.method !== 'GET') {
    return; // let network handle POST/others
  }
  
  // Don't intercept HTTPS requests to localhost (browser security trying to upgrade)
  if (req.url.startsWith('https://127.0.0.1') || req.url.startsWith('https://localhost')) {
    return;
  }
  
  event.respondWith(
    fetch(req).then((res) => {
      // Only cache successful responses
      if (res && res.status === 200) {
        const resClone = res.clone();
        caches.open(CACHE_NAME).then((cache) => cache.put(req, resClone)).catch(() => {
          // Ignore cache errors
        });
      }
      return res;
    }).catch((error) => {
      // Try to get from cache, but if that fails, return a proper error response
      return caches.match(req).then((cachedResponse) => {
        if (cachedResponse) {
          return cachedResponse;
        }
        // Return a proper Response object instead of throwing
        return new Response('Network error and no cache available', {
          status: 408,
          statusText: 'Request Timeout',
          headers: { 'Content-Type': 'text/plain' }
        });
      }).catch(() => {
        // If cache match also fails, return error response
        return new Response('Network error', {
          status: 408,
          statusText: 'Request Timeout',
          headers: { 'Content-Type': 'text/plain' }
        });
      });
    })
  );
});


