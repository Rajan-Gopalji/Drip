jQuery(document).ready(function($) {
    var sum = 0;
    $('#trade :checkbox').click(function() {
        sum = 0;
        $('#trade :checkbox:checked').each(function(idx, elm) {
            sum += parseFloat(elm.value);
        });

        $('#sum').html('£' + sum);

    });

});
