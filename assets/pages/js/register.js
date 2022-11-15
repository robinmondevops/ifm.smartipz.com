
$(document).ready(function(){

    $('form').submit(function(){
        $(this).find(':submit').attr('disabled','disabled');
    });

    $('#country_id,#country_code').select2({
        maximumInputLength: 20 // only allow terms up to 20 characters long
    });

});


$(document).on('change', '#profile_type', function() {

	var $this = $(this);

	var $profile_type = $this.val();

    if( $.inArray( $profile_type, ['1','6','7'] ) != -1 ){

        $('#row_gender').show();

        console.log("is in array");

    }else{

        $('#row_gender').hide();

        console.log("not in array");

    }



});






$(document).on('change', '#state', function(){

    var $this = $(this);
    var $url = $this.data('url');

    var $state_id = $this.val();
    if( $state_id ){
        $.ajax({
            type:"POST",
            url:$url,
            data:'state_id='+$state_id,
            success:function(json){
                $('#district').html(json.html);

            }
        })
    }


});


$(document).on('change', '#country_id', function(){

    var $this = $(this);

    var $country_id = $this.val();


    if( $country_id == 78 ){
        $('.location_show').show();
    }else{
        $('.location_show').hide();
    }


});







