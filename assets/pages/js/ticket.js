


$(document).ready(function() {

    $("html, body").animate({ scrollTop: $(document).height() }, 1000);


    $('.scroller').slimscroll({
        start: 'bottom',
    });

    var bottomCoord = $('.scroller')[0].scrollHeight;
    $('.scroller').slimScroll({scrollTo: bottomCoord});


    $(document).keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            $('a[id = send_message]').click();
            return false;
        }
    });


    $(document).on("click", '#send_message', function (e) {


        var contet = $('#m').val();

        if(contet != ''){

            var friend_id_to = $('#friend_id_to').val();

            var html = $('#message_template').html();
            html = html.replace('tem_message_content', contet);
            $('#m').val('');
            $('#notes-html-success').html('');
            $.ajax({
                type: "POST",
                url: $(this).data('url'),
                data: {notes: contet,friend_id_to:friend_id_to },
                dataType:'json',
                success: function(data){

                    console.log(data);

                    if( data.status=='success'){

                        $('#messages').append(html);
//                $('#notes-html-success').html('<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Success!</strong> message send successfully. </div>');
//                $('#notes-html-success').show();

                        var height = $('#chats')[0].scrollHeight;

//                    $('#chats').scrollTop(height);
//
//                    $('#chats').animate({
//                        scrollTop: $('.test4').offset().bottom
//                    }, 200);

                        $('.scroller').slimscroll({
                            start: 'bottom',
                        });
                        // append your html
                        // then calculate the new scroll height
                        var bottomCoord = $('.scroller')[0].scrollHeight;
                        $('.scroller').slimScroll({scrollTo: bottomCoord});

                    }else{
                        $('#popup_model').modal();
                    }


                }
            });

        }




        return false;
    });


});
