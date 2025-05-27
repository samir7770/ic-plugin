jQuery(document).ready(function($) {
    $('#qqrc-settings-form').on('submit', function(e) {
        e.preventDefault(); 

        var $form = $(this);
        var $message = $('#qqrc-message');

       $.ajax({ url: ajaxurl,
        type: 'POST',
        data: $form.serialize() + '&action=qqrc_ajax_save_settings',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $message.html('<p style="color:green;">' + response.data + '</p>');
            } else {
                $message.html('<p style="color:red;">' + (response.data || 'An error occurred.') + '</p>');
            }
        },
        error: function(xhr, status, error) {
            $message.html('<p style="color:red;">AJAX request failed.</p>');
        }
       })
    });
})