jQuery(document).ready(function($) {
    $(document).on('click','.tabs-import-json',function(){
        json_file = $('.json_file').val();



        if(json_file){
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax(
                {
                    type: 'POST',
                    context: this,
                    url:tabs_ajax.tabs_ajaxurl,
                    data: {
                        "action" 	: "tabs_ajax_import_json",
                        "json_file" : json_file,
                        "nonce" : tabs_ajax.nonce,
                    },
                    success: function( response ) {
                        var data = JSON.parse( response );
                        console.log(data);
                        $(this).html('Import done');
                        $('.json_file').val('');
                    } });
        }
        else{
            alert('Please put file url');
        }
    })
});