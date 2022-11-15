

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
				$('#main_btn_'+$friend_id).html('Requested');
				$('#main_btn_'+$friend_id).removeClass('add_friend');
				$('#main_btn_'+$friend_id).addClass('requested');
				$('#main_btn_'+$friend_id).attr('data-action', 'requested');   
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
				$('#main_btn_'+$friend_id).html('Friends');
				$('#main_btn_'+$friend_id).removeClass('accept');
				$('#main_btn_'+$friend_id).addClass('friends');
				$('#main_btn_'+$friend_id).attr('data-action', 'friends'); 
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



$(document).on('click', '.toggle_like', function() {
	var $this = $(this);											  
	var $user_id =  $this.data('user');
	var $post_id =  $this.data('post'); 

	var $like_count = $('#like_count_'+$post_id).data('count');


   	$.ajax({
		type: 'POST',   
		url: site_url+'dashboard/like_post',  
		data:{ 'user_id': $user_id, 'post_id': $post_id },  
		success: function(data){
			$('#like_'+$post_id).addClass('liked');
			$('#like_'+$post_id).removeClass('toggle_like');
			$('#like_'+$post_id).addClass('toggle_unlike');

			$like_count = $like_count+1;

			//$('#like_count_'+$post_id).attr('data-count', $like_count); 
			$('#like_count_'+$post_id).data('count', $like_count);
			$('#like_count_'+$post_id).html($like_count);
		}
	});
		
	return false;
});


$(document).on('click', '.toggle_unlike', function() {
	var $this = $(this);											  
	var $user_id =  $this.data('user');
	var $post_id =  $this.data('post');

	var $like_count = $('#like_count_'+$post_id).data('count');


   	$.ajax({
		type: 'POST',   
		url: site_url+'dashboard/unlike_post',  
		data:{ 'user_id': $user_id, 'post_id': $post_id },     
		success: function(data){
			$('#like_'+$post_id).removeClass('liked');   
			$('#like_'+$post_id).removeClass('toggle_unlike');
			$('#like_'+$post_id).addClass('toggle_like');

			$like_count = $like_count-1;


			//$('#like_count_'+$post_id).attr('data-count', $like_count); 
			$('#like_count_'+$post_id).data('count', $like_count);
			$('#like_count_'+$post_id).html($like_count);
		}
	});
		
	return false;
});


$(document).on('click', '.comment_btn', function() {
	var $this = $(this);											  
	var $post_id =  $this.data('cmtid');
	var $comment =  $('#comment_'+$post_id).val();

	var $comment_count = $('#comment_count_'+$post_id).data('count');


   	$.ajax({
		type: 'POST',   
		url: site_url+'dashboard/save_comment',  
		data:{ 'post_id': $post_id, 'comment': $comment },     
		success: function(data){

			$comment_count = $comment_count+1;
			 
			$('#comment_count_'+$post_id).data('count', $comment_count);
			$('#comment_count_'+$post_id).html($comment_count);
			$('#comment_'+$post_id).val('');
		}
	});
		
	return false;
});


$(document).on('click', '.view_comment', function() {
	var $this = $(this);											  
	var $post_id =  $this.data('post');
	var $post_count =  $this.data('count');

	$('#comment_modal .modal-body .row').html('<div class="text-center"><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif"></div>');
	$('#comment_modal').modal();
	$('#album_modal_title').html('Comments');

   	$.ajax({
		type: 'POST',   
		url: site_url+'dashboard/view_comment',  
		data:{ 'post_id': $post_id},     
		success: function(data){
			$('#comment_modal .modal-body .row').html(data.html);
			
		}
	});
		
	return false;
});

$(document).on('click', '.toggle_share', function() {
	var $this = $(this);											  
	var $user_id =  $this.data('user');
	var $post_id =  $this.data('post'); 

	var $share_count = $('#share_count_'+$post_id).data('count');


   	$.ajax({
		type: 'POST',   
		url: site_url+'dashboard/share_post',  
		data:{ 'user_id': $user_id, 'post_id': $post_id },  
		success: function(data){
			$('#share_'+$post_id).addClass('liked');
			$('#share_'+$post_id).removeClass('toggle_share');
			$('#share_'+$post_id).addClass('toggle_unshare');   

			$share_count = $share_count+1;

			//$('#like_count_'+$post_id).attr('data-count', $like_count); 
			$('#share_count_'+$post_id).data('count', $share_count);
			$('#share_count_'+$post_id).html($share_count);
		}
	});
		
	return false;
});


$(document).on('click', '.view_like', function() {
	var $this = $(this);											  
	var $post_id =  $this.data('post');

	var $like_count =  $this.data('count');

	$('#comment_modal .modal-body .row').html('<div class="text-center"><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif"></div>');
	$('#comment_modal').modal();
	$('#album_modal_title').html('Likes');

   	$.ajax({
		type: 'POST',   
		url: site_url+'dashboard/view_likes',  
		data:{ 'post_id': $post_id},     
		success: function(data){
			$('#comment_modal .modal-body .row').html(data.html);
			
		}
	});
		
	return false;
});

$(document).on('click', '.view_share', function() {
	var $this = $(this);											  
	var $post_id =  $this.data('post');

	var $share_count =  $this.data('count');

	$('#comment_modal .modal-body .row').html('<div class="text-center"><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif"></div>');
	$('#comment_modal').modal();
	$('#album_modal_title').html('Shares');

   	$.ajax({
		type: 'POST',   
		url: site_url+'dashboard/view_share',  
		data:{ 'post_id': $post_id},      
		success: function(data){
			$('#comment_modal .modal-body .row').html(data.html);
			
		}
	});
		
	return false;
});

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



