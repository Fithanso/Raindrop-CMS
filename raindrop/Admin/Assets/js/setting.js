var setting = {
    ajaxMethod: 'POST',

    update: function() {
        var formData = $('#settingForm').serialize();

        $.ajax({
            url: '/admin/settings/update/',
            type: this.ajaxMethod,
            data: formData,
            beforeSend: function(){

            },
            success: function(result){
                window.location.reload();
                //console.log(result);
            }
        });
    },
    setActiveTheme: function(element, theme) {

        var formData = new FormData();
        var button = $(element);

        formData.append('theme', theme);

        $.ajax({
            url: '/admin/setting/activateTheme/',
            type: this.ajaxMethod,
            data: formData,
            cache:false,
            processData: false,
            contentType: false,
            beforeSend: function(){

            },
            success: function(result){
                window.location.reload();
            }
        });
    }
};
