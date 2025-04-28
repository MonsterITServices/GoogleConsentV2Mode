// Replicate your Django admin charts
wp.apiFetch({ path: '/consent-manager/v1/analytics' }).then(data => {
  const ctx = document.getElementById('consent-analytics-chart');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Necessary', 'Analytics', 'Marketing'],
      datasets: [{
        label: 'Consents Granted',
        data: [data.necessary, data.analytics, data.marketing],
        backgroundColor: '#4CAF50'
      }]
    }
  });
});
