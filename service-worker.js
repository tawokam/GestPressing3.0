self.addEventListener('install', (event) => {  
    event.waitUntil(  
      caches.open('v1').then((cache) => {  
        return cache.addAll([  
          '/',/*  
          'style.css',  
          'script.js',
          'img/logo.jpg',
          'img/Icon.png'*/
        ]);  
      })  
    );  
  });  
  
  self.addEventListener('fetch', (event) => {  
    event.respondWith(  
      caches.match(event.request).then((response) => {  
        return response || fetch(event.request);  
      })  
    );  
  });
