jQuery(document).ready(function($){
    $('form.ajax').on('submit', function(e){
        e.preventDefault();
        var that = $(this),
        url = that.attr('action'),
        type = that.attr('method');
        var email = $('.email').val();
        var password = $('.password').val();
        $.ajax({
            url: cpm_object.ajax_url,
            type:"POST",
            dataType:'type',
            data: {
                action:'set_form',
                email:email,
                password:password,
                }, success: function(response) {
                    $(".success_msg").css("display","block");
                }, error: function(data) {
                    $(".error_msg").css("display","block");
                }
        });
        $(".form-popup").css("display","none");
        $('.ajax')[0].reset();
    });
});
    