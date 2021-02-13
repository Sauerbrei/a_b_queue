$(document).ready(function() {
    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%H:%M:%S'));
        });
    });

    $('.claim_discount').click(function() {
        const id = $(this).data("id");
        $.ajax({
            url: 'http://localhost:8080/discount/claim/'+id
        }).done(function() {
            $('#countdown_'+id).hide();
            $('#claimed_'+id).show();
        });
    });

    $('#claim_tokens').click(function() {
        const id = $(this).data("userid");
        $.ajax({
            url: 'http://localhost:8080/discount/register/'+id
        }).done(function() {
            location.reload();
        });
    });
});


