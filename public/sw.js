importScripts('/workbox/workbox-sw.js');
workbox.setConfig({modulePathPrefix: '/workbox'});

console.log('This log comes from sw.js, which is created by pwa()')
// *** Workbox Bundle rules ***
//WORKBOX_IMPORT_PLACEHOLDER
//STANDARD_RULES_PLACEHOLDER
//OFFLINE_FALLBACK_PLACEHOLDER
//WIDGETS_PLACEHOLDER


self.addEventListener("install", function (event) {
    event.waitUntil(caches.keys().then(function (cacheNames) {
            return Promise.all(
                cacheNames.map(function (cacheName) {
                    return caches.delete(cacheName);
                })
            );
        })
    );
});

const assetCacheStrategy = new workbox.strategies.CacheFirst({
  cacheName: 'assets',
  plugins: [
    new workbox.cacheableResponse.CacheableResponsePlugin({statuses: [0, 200]}),
    new workbox.expiration.ExpirationPlugin({
      maxEntries: 78,
      maxAgeSeconds: 365 * 24 * 60 * 60,
    }),
  ],
});
workbox.routing.registerRoute(
  ({url}) => url.pathname.startsWith('/assets'),
  assetCacheStrategy
);
self.addEventListener('install', event => {
  const done = [
    "/assets/@spomky-labs/pwa-bundle/connection-status_controller-b9dfc09997ca353fa3af5080ebd5ad2e.js",
    "/assets/@spomky-labs/pwa-bundle/backgroundsync-form_controller-60ffb8e0f45a17a5d3866e6624cf35de.js",
    "/assets/@survos/pwa-extra/src/controllers/toggle_online_controller-c19d0db0c84516136cdccafb2207bbd2.js",
    "/assets/@survos/pwa-extra/src/controllers/detector_controller-547ddf87e7aecfe1ae5068cc81d91dab.js",
    "/assets/@survos/pwa-extra/src/controllers/install_controller-deddd9a38a19a9feb22fdc9d3d3a72c6.js",
    "/assets/@survos/pwa-extra/package-b626e18fbcfa50ef063f51c2096e9d8f.json",
    "/assets/@symfony/ux-live-component/live_controller-dfce6187f466b497d4ea25b30b9385d9.js",
    "/assets/@symfony/ux-live-component/live.min-5108f988fb2a3dbb292d6feebc9db7e8.css",
    "/assets/@symfony/ux-turbo/turbo_stream_controller-a9d0d06c48318d35cc0e0aa27ef6b2dc.js",
    "/assets/@symfony/ux-turbo/turbo_controller-ce5e32dafdec0b7752f02e3e2cb25751.js",
    "/assets/@symfony/ux-autocomplete/controller-d18de807e29352151ef094b16fb98bb5.js",
    "/assets/@symfony/stimulus-bundle/loader-e1ee9ace0562f2e6a52301e4ccc8627d.js",
    "/assets/@symfony/stimulus-bundle/controllers-2913ebfbc59553ea8b6ee6e4a089a8b7.js",
    "/assets/vendor/@popperjs/core/core.index-ceb5b6c0f9e1d3f6c78ef733facfdcda.js",
    "/assets/vendor/stimulus-popover/stimulus-popover.index-887382876045b151d9c63d14cedd9828.js",
    "/assets/vendor/debounce/debounce.index-31accf59697c2cb4f0058fad656eafc8.js",
    "/assets/vendor/flowbite-datepicker/flowbite-datepicker.index-dc4800473b49c4111b36f84d34daddce.js",
    "/assets/vendor/stimulus-use/stimulus-use.index-f4da7684e0e467c91c814b53607b8713.js",
    "/assets/vendor/tom-select/tom-select.index-c0036889cf3e94dade1e56c11996b014.js",
    "/assets/vendor/tom-select/dist/css/tom-select.default-92c31c033a23be0cfebdda3d089d8b11.css",
    "/assets/vendor/flowbite/flowbite.index-d741c4d5a61d65b119c84d13de93e5bf.js",
    "/assets/vendor/js-confetti/js-confetti.index-12414c07bc803dca4983749f7e41a13c.js",
    "/assets/vendor/@hotwired/turbo/turbo.index-810f44ef1a202a441e4866b7a4c72d11.js",
    "/assets/vendor/@hotwired/stimulus/stimulus.index-b5b1d00e42695b8959b4a1e94e3bc92a.js",
    "/assets/vendor/turbo-view-transitions/turbo-view-transitions.index-5965fffbf4b6b6a914d58ef72a73a148.js",
    "/assets/sw-4c1d0f64fbf1f85836f8c875ea38e9f0.js",
    "/assets/lib/alien-greeting-d4d83097fecbd8973a86413f10a8fa0e.js",
    "/assets/styles/app-3a90297d354683c180fea9ad2f3a158a.css",
    "/assets/styles/alien-greeting-d5687d75bdadb57d849c403c47c4c822.css",
    "/assets/bootstrap-83ad7675f044e1dcc050d5e5bfa276fd.js",
    "/assets/app-4bfa743b35817886b63e658bcfc7d924.js",
    "/assets/controllers/celebrate_controller-51d0f43461a0a5226fc256709c74294f.js",
    "/assets/controllers/closeable_controller-d38639da5371354ff5818dd39c56bc9c.js",
    "/assets/controllers/datepicker_controller-9426e1436f553ab06eff37218ebc0589.js",
    "/assets/controllers/autosubmit_controller-30e614add6300646a8c9d8e416574e61.js",
    "/assets/controllers/modal_controller-ccf28b797eaba04a7659ee5da968d1f5.js",
    "/assets/controllers/popover_controller-919199e53855859aca38966f60c0780f.js",
    "/assets/controllers/hello_controller-55882fcad241d2bea50276ea485583bc.js",
    "/assets/bundles/babdevpagerfanta/css/pagerfanta-ea64fc9c55f8394e696554f8aeb81a8e.css"
].map(
    path =>
      assetCacheStrategy.handleAll({
        event,
        request: new Request(path),
      })[1]
  );

  event.waitUntil(Promise.all(done));
});

const fontCacheStrategy = new workbox.strategies.CacheFirst({
  cacheName: 'fonts',
  plugins: [
    new workbox.cacheableResponse.CacheableResponsePlugin({
      statuses: [0, 200],
    }),
    new workbox.expiration.ExpirationPlugin({
      maxAgeSeconds: 31536000,
      maxEntries: 60,
    }),
  ],
});
workbox.routing.registerRoute(
  ({request}) => request.destination === 'font',
  fontCacheStrategy
);
self.addEventListener('install', event => {
  const done = [].map(
    path =>
      fontCacheStrategy.handleAll({
        event,
        request: new Request(path),
      })[1]
  );

  event.waitUntil(Promise.all(done));
});

workbox.recipes.pageCache({
    cacheName: 'pages',
    networkTimeoutSeconds: 3,
    warmCache: [
    "/",
    "/voyage/",
    "/planet/"
]
});

workbox.routing.registerRoute(
  ({request, url}) => (request.destination === 'image' && !url.pathname.startsWith('/assets')),
  new workbox.strategies.CacheFirst({
    cacheName: 'images',
    plugins: [
      new workbox.cacheableResponse.CacheableResponsePlugin({statuses: [0, 200]}),
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 60,
        maxAgeSeconds: 31536000,
      }),
    ],
  })
);

workbox.routing.registerRoute(
  ({url}) => '/site.webmanifest' === url.pathname,
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: 'manifest'
  })
);

workbox.recipes.googleFontsCache();

workbox.routing.setDefaultHandler(new workbox.strategies.NetworkOnly());
workbox.recipes.offlineFallback({
    "pageFallback": "/"
});

self.addEventListener("install", function (event) {
  event.waitUntil(self.skipWaiting());
});
self.addEventListener("activate", function (event) {
  event.waitUntil(self.clients.claim());
});