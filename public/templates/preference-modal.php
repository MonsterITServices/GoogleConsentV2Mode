<?php /* Template for consent preferences modal */ ?>
<div id="consent-preferences" style="display:none;">
  <div class="consent-modal-content">
    <h3><?php esc_html_e('Cookie Preferences', 'consent-manager-pro'); ?></h3>
    
    <div class="cookie-category">
      <label>
        <input type="checkbox" checked disabled>
        <?php esc_html_e('Necessary Cookies', 'consent-manager-pro'); ?>
      </label>
      <p><?php esc_html_e('Required for basic site functionality.', 'consent-manager-pro'); ?></p>
    </div>

    <div class="cookie-category">
      <label>
        <input type="checkbox" id="consent-analytics">
        <?php esc_html_e('Analytics Cookies', 'consent-manager-pro'); ?>
      </label>
      <p><?php esc_html_e('Help us improve by collecting anonymous usage data.', 'consent-manager-pro'); ?></p>
    </div>

    <button id="save-preferences"><?php esc_html_e('Save Preferences', 'consent-manager-pro'); ?></button>
  </div>
</div>
