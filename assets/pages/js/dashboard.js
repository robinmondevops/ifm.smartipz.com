
$(document).ready(function(){


	var uploader = new qq.FineUploader({
        debug: true,
        element: document.getElementById('fine-uploader'),
        request: {
            endpoint: site_url+'dashboard/upload'
        },
        deleteFile: {
            enabled: true,
            endpoint: base_url+'dashboard/upload'
        },
        retry: {
           enableAuto: true
        }
    });

    $(document).on('click', '.qq-upload-delete', function(){
        var $names = $('#uploaded_files').val();
        var $this = $(this);
        $title = $this.siblings('.qq-upload-file').attr( "title" );
        $new_string = $names.replace('||'+$title, '' );  
        $('#uploaded_files').val($new_string);   
    });

	// $('#file_upload').uploadifive({

		
	// 	'uploadScript' : base_url+'uploadifive/uploadifive.php',
	// 	'cancelImage' : base_url+'uploadifive/uploadifive-cancel.png',
		 
	// });

});

$(document).on('click', '.remove_group', function() {
	var $this = $(this);											  
	var $category_id =  $this.data('id');
	
   	$.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });     
   	$.ajax({
		type: 'POST',   
		url: $this.data('url'),  
		data:{ 'category_id': $category_id },  
		success: function(data){
			$('#'+$category_id).remove();
			$.unblockUI();
		}
	});
		
	return false;
});

// $(document).on('click', '.btn_post', function(){

// });

$(document).on('submit',"form#form_post", function(e){

	var formData = new FormData($(this)[0]);
	var $this = $(this);
	var $url = site_url+'dashboard/save_post';
	var error = 0;
	e.preventDefault();
	
	if( error == 0) {
		
		var formData = new FormData($(this)[0]);
		
		$.ajax({
			url: $url,  
			type: 'POST',   
			data: formData,
			processData: false,  
    		contentType: false,
			success: function (data) {
				$('#content').val('');
				$('#uploaded_files').val('');
				$('.qq-upload-list').html('');
				$('#post_head').after(data.html); 
				$('#each_gallery_'+data.galery_id).imagesGrid({  
                    images: data.post_img_array,
                    align: true,
                    getViewAllText: function(imgsCount) { return 'View all' }
                });
			},
		});
		return false;
	} 
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
			$('#view_like_id_'+$post_id).data('count', $like_count);
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
			$('#view_like_id_'+$post_id).data('count', $like_count);
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
			$('#view_comment_id_'+$post_id).data('count', $comment_count);
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

	if( $post_count > 0 ){

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

	}
		
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
			$('#view_share_id_'+$post_id).data('count', $share_count);
			$('#share_count_'+$post_id).html($share_count);

			$('#post_head').after(data.html); 
			$('#each_gallery_'+data.galery_id).imagesGrid({  
                images: data.post_img_array,
                align: true,
                getViewAllText: function(imgsCount) { return 'View all' }
            });
                
		}
	});
		
	return false;
});


$(document).on('click', '.view_like', function() {
	var $this = $(this);											  
	var $post_id =  $this.data('post');

	var $like_count =  $this.data('count');

	if( $like_count > 0 ){

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
	}
		
	return false;
});

$(document).on('click', '.view_share', function() {
	var $this = $(this);											  
	var $post_id =  $this.data('post');

	var $share_count =  $this.data('count');

	if( $share_count > 0 ){

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
    }
		
	return false;
});


$(document).on('click', '.delete_post', function() {
	var $this = $(this);											  
	var $post_id =  $this.data('post');

	$.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });

	$.ajax({
		type: 'POST',   
		url: site_url+'dashboard/delete_post',  
		data:{ 'post_id': $post_id},      
		success: function(data){     
			$('#post_'+$post_id).remove();         
			$.unblockUI();  
		}
	});
		
	return false;
});


