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
// Replicate your React component logic
function showPreferences() {
  fetch(consentData.ajaxUrl + '?action=get_purposes')
    .then(response => response.json())
    .then(purposes => {
      const modal = document.createElement('div');
      modal.id = 'cookie-preferences';
      modal.innerHTML = `
        <h3>Cookie Settings</h3>
        ${purposes.map(purpose => `
          <div class="purpose ${purpose.is_required ? 'required' : ''}">
            <input
              type="checkbox"
              id="purpose-${purpose.purpose_id}"
              ${purpose.is_required ? 'checked disabled' : ''}
            >
            <label for="purpose-${purpose.purpose_id}">
              ${purpose.name} (Cookies: ${JSON.parse(purpose.cookies).join(', ')})
            </label>
          </div>
        `).join('')}
        <button id="save-preferences">Save</button>
      `;
      document.body.appendChild(modal);
    });
}
