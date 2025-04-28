// Show preferences modal
document.getElementById('consent-settings').addEventListener('click', () => {
  document.getElementById('consent-preferences').style.display = 'block';
});

// Save preferences
document.getElementById('save-preferences').addEventListener('click', () => {
  const analyticsConsent = document.getElementById('consent-analytics').checked;
  
  localStorage.setItem('consent_preferences', JSON.stringify({
    analytics: analyticsConsent
  }));

  // Send to backend
  fetch(consentData.ajaxUrl, {
    method: 'POST',
    body: new URLSearchParams({
      action: 'save_consent',
      security: consentData.nonce,
      consent_type: analyticsConsent ? 'analytics' : 'minimal'
    })
  });

  document.getElementById('consent-preferences').style.display = 'none';
});
