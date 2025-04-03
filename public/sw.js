const CACHE_NAME = "laravel-pwa-cache-v1";
const STATIC_ASSETS = [
    "/",
    "/css/app.css",
    "/js/app.js",
    "/images/icons/icon-192x192.png",
    "/images/icons/icon-512x512.png"
];

// Install service worker and cache assets
self.addEventListener("install", event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            return cache.addAll(STATIC_ASSETS);
        })
    );
});

// Fetch from cache or network
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request).then(response => {
            return response || fetch(event.request);
        })
    );
});

// Activate and remove old caches
self.addEventListener("activate", event => {
    event.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(
                keys.filter(key => key !== CACHE_NAME).map(key => caches.delete(key))
            );
        })
    );
});
