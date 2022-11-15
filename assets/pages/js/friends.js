

$(document).on('click', '.add_friend', function() {

	var $this = $(this);

	var $user_id = $this.data('id');
	var $friend_id = $this.data('friend');
	
	var $url = site_url+'friends/friend_request';

	$.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
	$.ajax({
		url: $url,
		type: 'post',
		data: { user_id:$user_id,friend_id:$friend_id },
		success: function(data) {

			if(data.status == 'success'){
				$('#msg_box').html('<div class="alert alert-success alert-dismissable"><button class="close" type="button" data-dismiss="alert" aria-hidden="true"></button>Request Send Successfully</div>');
				$('#'+$friend_id).html('Requested');
				$('#'+$friend_id).removeClass('add_friend');
				$('#'+$friend_id).addClass('requested');
				$('#'+$friend_id).attr('data-action', 'requested');   
			} else {
				$('#msg_box').html('<div class="alert alert-danger alert-dismissable"><button class="close" type="button" data-dismiss="alert" aria-hidden="true"></button>Request Cannot be send sice you don\'t have common interests </div>');
			}
			
			
			$.unblockUI();
			
		},
	});

});


$(document).on('click', '.accept', function() {

	var $this = $(this);

	var $user_id = $this.data('id');
	var $friend_id = $this.data('friend');
	
	var $url = site_url+'friends/accept_request';

	$.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });  
	$.ajax({
		url: $url,   
		type: 'post',
		data: { user_id:$user_id,friend_id:$friend_id },
		success: function(data) {

			if(data.status == 'success'){
				$('#msg_box').html('<div class="alert alert-success alert-dismissable"><button class="close" type="button" data-dismiss="alert" aria-hidden="true"></button>Request Accepted Successfully</div>');
				$('#'+$friend_id).html('Send Mail');
				$('#'+$friend_id).removeClass('accept');
				$('#'+$friend_id).addClass('friends');
				$('#'+$friend_id).attr('data-action', 'friends'); 
				$('#notify_'+$friend_id).remove();  
			}
			
			$.unblockUI();
			
		},
	});

});


$(document).on('click', '.unfriend', function() {

    var $this = $(this);


    var $user_id = $this.data('unid');
    var $friend_id = $this.data('unfriend');

    var $url = site_url+'friends/unfriend';


    $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
    $.ajax({
        url: $url,
        type: 'post',
        data: { user_id:$user_id,friend_id:$friend_id },
        success: function(data) {

            if(data.status == 'success'){

                $('#main_btn_'+$friend_id).html('Add Friend');
                $('#main_btn_'+$friend_id).removeClass('friends');
                $('#main_btn_'+$friend_id).addClass('add_friend');
                $('#main_btn_'+$friend_id).attr('data-action', 'add_friend');
                $('#notify_'+$friend_id).remove();
                $('#unfriend_'+$friend_id).remove();
            }

            $.unblockUI();

        },
    });

});





