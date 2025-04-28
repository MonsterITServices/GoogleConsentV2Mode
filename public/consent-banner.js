jQuery(document).ready(function($) {
  // Check if consent already given
  if (!localStorage.getItem('consent_given')) {
    $('#consent-banner').show();
  }

  // Handle consent acceptance
  $('#consent-accept').on('click', function() {
    localStorage.setItem('consent_given', 'true');
    $('#consent-banner').hide();

    // Log consent to DB via AJAX
    $.ajax({
      url: ajaxurl,
      type: 'POST',
      data: {
        action: 'log_consent',
        consent_type: 'full'
      }
    });
  });
});
