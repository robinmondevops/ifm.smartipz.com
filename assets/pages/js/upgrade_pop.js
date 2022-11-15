

$(document).on('click', '.friends', function() {

    var $this = $(this);

    var $user_id = $this.data('id');
    var $friend_id = $this.data('friend');

    var $url = site_url+'friends/has_licence';

    $.ajax({
        url: $url,
        type: 'post',
        dataType:'json',
        data: { user_id:$user_id,friend_id:$friend_id },
        success: function(data) {
            console.log(data);
            if(data.status == 'success'){

                window.location.replace(data.redirect_url);

            } else {

                $('#popup_model').modal();

            }


        },
    });

});


$(document).on('click', '.view_phone', function() {

    var $this = $(this);

    var $user_id = $this.data('id');
    var $friend_id = $this.data('friend');

    var $url = site_url+'friends/has_licence_contact';

    $.ajax({
        url: $url,
        type: 'post',
        dataType:'json',
        data: { user_id:$user_id,friend_id:$friend_id },
        success: function(data) {

            console.log(data);

            if(data.status == 'success'){

                if(data.contact_available == 1 ){

                    $('#popup_model_contact').modal();
                    $('.pop_contact_content').html(data.html_contact);

                }else{
                    $('#popup_model').modal();
                }

            } else {

                $('#popup_model').modal();

            }


        },
    });

});

$('#popup_model_contact').on('hidden.bs.modal', function () {
    location.reload();
});



