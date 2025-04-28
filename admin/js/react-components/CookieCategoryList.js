// Dynamic cookie category management
document.addEventListener('DOMContentLoaded', () => {
  const categoryManager = document.getElementById('consent-cookie-manager');
  
  if (categoryManager) {
    wp.apiFetch({
      path: '/wp/v2/consent_categories'
    }).then(categories => {
      categoryManager.innerHTML = `
        <div class="consent-category-list">
          ${categories.map(cat => `
            <div class="consent-category-card">
              <h3>${cat.name}</h3>
              <p>${cat.description}</p>
              <input type="checkbox" ${cat.active ? 'checked' : ''}>
            </div>
          `).join('')}
        </div>
      `;
    });
  }
});
