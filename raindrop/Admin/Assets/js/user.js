var user = {
    ajaxMethod: 'POST',

    update: function() {
        var formData = $('#userForm').serialize();

        $.ajax({
            url: '/admin/user/update/',
            type: this.ajaxMethod,
            data: formData,
            beforeSend: function(){

            },
            success: function(result){
                window.location.reload();
            }
        });
    },
    ban: function() {
        var userId = $('input#id').val();

        $.ajax({
            url: '/admin/user/ban/',
            type: this.ajaxMethod,
            data: userId,
            beforeSend: function(){

            },
            success: function(result){
                window.location.reload();
                //console.log(result);
            }
        });
    }
};
