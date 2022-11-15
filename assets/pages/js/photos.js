
window.onload = function() {
    Dropzone.autoDiscover = false;
};
$(document).ready(function(){

    $(function() {

        var url = site_url+'photos/create_image';
        //Dropzone class
        var myDropzone = new Dropzone(".dropzone", {
            url: url,
            paramName: "file",
            parallelUploads : 10,
            maxFilesize: 10,
            addRemoveLinks: true,
            maxFiles: 10,
            acceptedFiles: "image/*,application/pdf",
            autoProcessQueue: false
        });

        myDropzone.on("queuecomplete", function() {
            //Redirect URL
            location.reload();
        });

        $('#update_form').click(function(e){
            e.preventDefault();

            $('#update_form').attr('disabled', true);
            $('#update_form').html('Uploading....');

            if (myDropzone.getQueuedFiles().length > 0) {

                const acceptedFiles = myDropzone.getAcceptedFiles();
                for (let i = 0; i < acceptedFiles.length; i++) {
                    setTimeout(function () {
                        myDropzone.processFile(acceptedFiles[i])
                    }, i * 2000)
                }

//                            myDropzone.processQueue();
            }else{
                $('#update_form').attr('disabled', false);
                $('#update_form').html('Upload');
            }


        });
    });

    load_pretty();

    $(document).on('click', '.qq-upload-delete', function(){
        var $names = $('#uploaded_files').val();
        var $this = $(this);
        $title = $this.siblings('.qq-upload-file').attr( "title" );
        $new_string = $names.replace('||'+$title, '' );  
        $('#uploaded_files').val($new_string);   
    });

	$('#file_upload').uploadify({
		'sizeLimit' : '1073741824',
		'queueSizeLimit' : 1000,
		'uploader' : base_url+'uploadify/uploadify.php',
		'swf' : base_url+'uploadify/uploadify.swf',
		'cancelImage' : base_url+'uploadify/uploadify-cancel.png',
		'auto' : true,
		'multi' : true,
	});

});

$(document).on('click', '.create_album', function() {


	var $title = 'Upload Images';
	var $load_form_url = site_url+'photos/load_form';

	$('#album_modal .modal-body .row').html('<div class="text-center"><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif"></div>');
	$('#album_modal').modal();
	
	$('#album_modal_title').html($title);
	$.ajax({
		url: $load_form_url,
		type: 'post',
		success: function(data) {
			$('#album_modal .modal-body .row').html(data.html);
			modal_album();
		},
	});

});

$('#album_modal').on('hidden.bs.modal', function () {
    location.reload();
});

$(document).on('click', '.set', function() {
	var $this = $(this);											  
	var $pic_id =  $this.data('id');
	var $pic_name =  $this.data('name');
	
   	$.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });     
   	$.ajax({
		type: 'POST',   
		url: site_url+'photos/set_profile',  
		data:{ 'pic_id': $pic_id, 'pic_name': $pic_name },  
		success: function(data){
			$('.image_box').html(data.image_left);
			$.unblockUI();
		}
	});
});

$(document).on('click', '.delete', function() {
	var $this = $(this);											  
	var $pic_id =  $this.data('id');
	
   	$.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });     
   	$.ajax({
		type: 'POST',   
		url: site_url+'photos/delete_profile',  
		data:{ 'pic_id': $pic_id },  
		success: function(data){
			$('#'+$pic_id).remove();
			$.unblockUI();
		}
	});
});



function modal_album(){

    var pic_balance = $('#pic_balance').val();

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
        },
        validation: {
            itemLimit: pic_balance,
            acceptFiles: 'image/*',
        },
    });   


	// $('#file_upload').uploadify({
	// 	'sizeLimit' : '1073741824',
	// 	'queueSizeLimit' : 1000,
	// 	'uploader' : base_url+'uploadify/uploadify.php',
	// 	'swf' : base_url+'uploadify/uploadify.swf',
	// 	'cancelImage' : base_url+'uploadify/uploadify-cancel.png',
	// 	'auto' : true,
	// 	'multi' : true,
	// });

}


$(document).on('click', '.delete', function() {
    var $this = $(this);
    var $pic_id =  $this.data('id');

    $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
    $.ajax({
        type: 'POST',
        url: site_url+'photos/delete_pic',
        data:{ 'pic_id': $pic_id },
        success: function(data){
            $('#'+$pic_id).remove();
            $('.create_album').show();
            $('.max_limit_alert').hide();
            var old_pic_bal = $('#pic_balance').val();
            var new_pic_bal = parseInt(old_pic_bal) + parseInt(1);
            $('#pic_balance').val(new_pic_bal);
            $.unblockUI();
        }
    });
});

function load_pretty(){

    $("a[rel^='prettyPhoto']").prettyPhoto({
        animation_speed: 'fast', /* fast/slow/normal */
        slideshow: 5000, /* false OR interval time in ms */
        autoplay_slideshow: false, /* true/false */
        opacity: 0.80, /* Value between 0 and 1 */
        show_title: true, /* true/false */
        allow_resize: true, /* Resize the photos bigger than viewport. true/false */
        default_width: 500,
        default_height: 344,
        counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
        theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
        horizontal_padding: 20, /* The padding on each side of the picture */
        hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
        wmode: 'opaque', /* Set the flash wmode attribute */
        autoplay: true, /* Automatically start videos: True/False */
        modal: false, /* If set to true, only the close button will close the window */
        deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
        overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
        keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
        changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
        callback: function(){}, /* Called when prettyPhoto is closed */
        ie6_fallback: true,
        markup: '<div class="pp_pic_holder"> \
						<div class="ppt">&nbsp;</div> \
						<div class="pp_top"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
						<div class="pp_content_container"> \
							<div class="pp_left"> \
							<div class="pp_right"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a href="#" class="pp_expand" title="Expand the image">Expand</a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#">next</a> \
											<a class="pp_previous" href="#">previous</a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<div class="pp_nav"> \
												<a href="#" class="pp_arrow_previous">Previous</a> \
												<p class="currentTextHolder">0/0</p> \
												<a href="#" class="pp_arrow_next">Next</a> \
											</div> \
											<p class="pp_description"></p> \
											{pp_social} \
											<a class="pp_close" href="#">Close</a> \
										</div> \
									</div> \
								</div> \
							</div> \
							</div> \
						</div> \
						<div class="pp_bottom"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
					</div> \
					<div class="pp_overlay"></div>',
        gallery_markup: '<div class="pp_gallery"> \
								<a href="#" class="pp_arrow_previous">Previous</a> \
								<div> \
									<ul> \
										{gallery} \
									</ul> \
								</div> \
								<a href="#" class="pp_arrow_next">Next</a> \
							</div>',
        image_markup: '<img id="fullResImage" src="{path}" />',
        flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
        quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
        iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
        inline_markup: '<div class="pp_inline">{content}</div>',
        custom_markup: '',
        social_tools: false /* html or false to disable */
    });
}




