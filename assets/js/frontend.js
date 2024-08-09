jQuery(document).ready(function($) {
    $('.copy-token').on('click', function() {
        var tokenString = $(this).data('token');
        var $temp = $('<input>');
        $('body').append($temp);
        $temp.val(tokenString).select();
        document.execCommand('copy');
        $temp.remove();
        alert('Token copied: ' + tokenString);
    });
});
