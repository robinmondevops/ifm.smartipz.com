


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
				$('#'+$friend_id).html('Friends');
				$('#'+$friend_id).removeClass('accept');
				$('#'+$friend_id).addClass('friends');
				$('#'+$friend_id).attr('data-action', 'friends'); 
				$('#notify_'+$friend_id).remove();  
				$('#request_'+$friend_id).remove();  
			}
			
			$.unblockUI();
			
		},
	});

});



