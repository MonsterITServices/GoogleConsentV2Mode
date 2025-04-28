// Blocks cookies until consent is given (add to public/js/)
document.addEventListener('DOMContentLoaded', function() {
  const consentGranted = localStorage.getItem('consent_preferences');

  if (!consentGranted) {
    // Block third-party scripts
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({ 'gtm.start': Date.now(), event: 'gtm.block' });

    // Disable cookies by overriding document.cookie
    const originalCookie = document.cookie;
    Object.defineProperty(document, 'cookie', {
      get: () => originalCookie,
      set: (value) => {
        const cookieName = value.split('=')[0].trim();
        const necessaryCookies = ['wordpress_test_cookie', 'wp-settings'];
        if (!necessaryCookies.includes(cookieName)) {
          return false;
        }
        return originalCookie = value;
      }
    });
  }
});
