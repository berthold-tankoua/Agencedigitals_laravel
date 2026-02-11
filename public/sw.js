
// PWA start
const staticCacheName = "AgenceDigitals-v0";
const preLoad = function () {
    return caches.open(staticCacheName).then(function (cache) {
        // caching index and important routes
        return cache.addAll(filesToCache);
    });
};

self.addEventListener("install", function (event) {
    event.waitUntil(preLoad());
});

const filesToCache = [
    '/',
    '/offline',

    'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js',

];

self.addEventListener("activate", evt => {
    evt.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(keys
                .filter(key => key !== staticCacheName)
                .map(key => caches.delete(key))
            )
        })
    );
});

// State while revalidate strategy

// self.addEventListener('fetch', event => {
//     event.respondWith(
//         caches.match(event.request)
//             .then( cachedResponse => {
//                 const fetchPromise = fetch(event.request).then(
//                      networkResponse => {
//                         caches.open(staticCacheName).then( cache => {
//                             cache.put(event.request, networkResponse.clone());
//                             return networkResponse;
//                         });
//                 });

//              return cachedResponse || fetchPromise;
//         })
//     );
// });

const checkResponse = function (request) {
    return new Promise(function (fulfill, reject) {
        fetch(request).then(function (response) {
            if (response.status !== 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};

const addToCache = function (request) {
    return caches.open(staticCacheName).then(function (cache) {
        return fetch(request).then(function (response) {
            return cache.put(request, response);
        });
    });
};

const returnFromCache = function (request) {
    return caches.open(staticCacheName).then(function (cache) {
        return cache.match(request).then(function (matching) {
            if (!matching || matching.status === 404) {
                return cache.match("/offline");
            } else {
                return matching;
            }
        });
    });
};

self.addEventListener("fetch", function (event) {
    event.respondWith(checkResponse(event.request).catch(function () {
        return returnFromCache(event.request);
    }));
    if (!event.request.url.startsWith('http')) {
        event.waitUntil(addToCache(event.request));
    }
});

// PWA end

// Push Notification start

// {"title":"hi","title":"push notification","url":"AgenceDigitals.com"}

self.addEventListener("push", (event) => {
    notification = event.data.json();
    event.waitUntil(self.registration.showNotification(notification.title, {
        body: notification.body,
        icon: "logo.png",
        data: {
            notifURL: notification.url
        }
    }));
});

self.addEventListener("notificationclick", (event) => {
    event.waitUntil(clients.openWindow(event.notification.data.notifURL));
});
// Push Notification End
