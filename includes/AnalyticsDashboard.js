// Replicate Django admin's analytics
wp.apiFetch({ path: '/consent-manager/v1/analytics' }).then(data => {
  wp.element.render(
    wp.element.createElement(() => (
      <div className="analytics-dash">
        <h3>Consent Analytics</h3>
        <div className="chart">
          {data.consentStats.map(stat => (
            <div key={stat.type} className="chart-bar" style={{ height: `${stat.percentage}%` }}>
              {stat.type}
            </div>
          ))}
        </div>
      </div>
    )),
    document.getElementById('consent-analytics-dash')
  );
});