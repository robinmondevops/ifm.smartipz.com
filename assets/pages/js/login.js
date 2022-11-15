$(document).ready(function(){

    $(".btn_otp_login").click(function(e) {

        $('#reg_mob_model').modal();

        $('#phone').focus();

        $('.otp_row').removeClass('has-error');
        $('.otp_error').html('');

    });


    $("#submit_phone").click(function(e) {

        $('#submit_phone').attr('disabled', true);

        var phone = $('#phone').val();

        if( phone != '' ){

            $.ajax({
                url: site_url+'auth/send_otp_to_phone/'+phone,
                type: 'POST',
                data: {phone:phone},
                dataType:'json',
                success: function (data) {

                    if( data.status == 'fail' ){

                        $('#submit_phone').attr('disabled', false);

                        $('.otp_row').addClass('has-error');
                        $('.otp_error').html('Mobile number is not Registered or Activated');

                    }else{

                        $('#reg_mob_model').modal('hide');
                        $('#view_model').modal();
                        $('#confirm_otp').focus();
                    }

                    $('#phone').val('');


                },
                cache: false,
                contentType: false,
                processData: false

            });


        }else{

            $('#submit_phone').attr('disabled', false);
            $('.otp_row').addClass('has-error');
        }


    });

    $("#confirm_ypur_otp").click(function(e) {

        $('#confirm_ypur_otp').attr('disabled', true);

        var confirm_otp = $('#confirm_otp').val();

        if( confirm_otp != '' ){

            $.ajax({
                url: site_url+'auth/otp_login/'+confirm_otp,
                type: 'POST',
                data: {otp:confirm_otp},
                dataType:'json',
                success: function (data) {

                    if( data.status == 'success' ){
                        window.location.replace(data.url);
                    }else{
                        $('.otp_row').addClass('has-error');
                        $('.otp_error').html('OTP is Incorrect');

                        $('#confirm_ypur_otp').attr('disabled', false);

                        setTimeout(function(){
                            $('#view_model').modal('hide');
                        }, 1000);



                    }


                },
                cache: false,
                contentType: false,
                processData: false
            });


        }else{

            $('.otp_row').addClass('has-error');

            $('#confirm_ypur_otp').attr('disabled', false);
        }

    });

});