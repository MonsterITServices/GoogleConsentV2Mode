// Replicate your React frontend's modal
wp.element.render(
  wp.element.createElement(() => (
    <div className="cookie-preferences">
      <h3>Cookie Settings</h3>
      {window.consentCategories.map(cat => (
        <div key={cat.id} className="cookie-category">
          <input
            type="checkbox"
            id={`cat-${cat.id}`}
            defaultChecked={cat.required}
            disabled={cat.required}
          />
          <label htmlFor={`cat-${cat.id}`}>{cat.name}</label>
        </div>
      ))}
    </div>
  )),
  document.getElementById('consent-preferences-modal')
);
