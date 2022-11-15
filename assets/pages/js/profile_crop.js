$(document).ready(function(){



});

$(document).on('click', '#change-pic', function() {

	$('#changePic').modal();
	

});

$(document).on('change', '#photoimg', function() {

	$("#preview-avatar-profile").html('');
	$("#preview-avatar-profile").html('Uploading....');

	$("#cropimage").ajaxForm({
		target: '#preview-avatar-profile',
		success:    function() {
//			$('img#photo').imgAreaSelect({
//				aspectRatio: '1:1',
//				onSelectEnd: getSizes,
//                handles : true,
//                aspectRatio : '16:9',
//                fadeSpeed : 1,
//                show : true
//			});

//            $('img#photo').load(function(){ // display initial image selection 16:9
//                var height = ( this.width / 16 ) * 9;
//                if( height <= this.height ){
//                    var diff = ( this.height - height ) / 2;
//                    var coords = { x1 : 1, y1 : diff, x2 : this.width-1, y2 : height + diff };
//                }
//                else{ // if new height out of bounds, scale width instead
//                    var width = ( this.height / 9 ) * 16;
//                    var diff = ( this.width - width ) / 2;
//                    var coords = { x1 : diff, y1 : 1, x2 : width + diff, y2: this.height-1 };
//                }
//                $( this ).imgAreaSelect( coords );
//            });


			$('#image_name').val($('#photo').attr('file-name'));
		}
	}).submit();

});

$(document).on('click', '#btn-crop', function(e) {
    e.preventDefault();
    params = {
        targetUrl: site_url+'users/crop?action=save',
        action: 'save',
        x_axis: $('#hdn-x1-axis').val(),
        y_axis : $('#hdn-y1-axis').val(),
        x2_axis: $('#hdn-x2-axis').val(),
        y2_axis : $('#hdn-y2-axis').val(),
        thumb_width : $('#hdn-thumb-width').val(),
        thumb_height:$('#hdn-thumb-height').val()
    };

    saveCropImage(params);
});


function getSizes(img, obj){

    var x_axis = obj.x1;
    var x2_axis = obj.x2;
    var y_axis = obj.y1;
    var y2_axis = obj.y2;
    var thumb_width = obj.width;
    var thumb_height = obj.height;
    if(thumb_width > 0){

        $('#hdn-x1-axis').val(x_axis);
        $('#hdn-y1-axis').val(y_axis);
        $('#hdn-x2-axis').val(x2_axis);
        $('#hdn-y2-axis').val(y2_axis);
        $('#hdn-thumb-width').val(thumb_width);
        $('#hdn-thumb-height').val(thumb_height);

    }
    else
        alert("Please select portion..!");
}

function saveCropImage(params) {
    $.ajax({
        url: params['targetUrl'],
        cache: false,
        dataType: "html",
        data: {
            action: params['action'],
            id: $('#hdn-profile-id').val(),
             t: 'ajax',
                                w1:params['thumb_width'],
                                x1:params['x_axis'],
                                h1:params['thumb_height'],
                                y1:params['y_axis'],
                                x2:params['x2_axis'],
                                y2:params['y2_axis'],
								image_name :$('#image_name').val()
        },
        type: 'Post',
       // async:false,
        success: function (response) {


//                $('#changePic').modal('hide');
                $(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
                $("#preview-avatar-profile").html('');
                $("#photoimg").val();
                $(".avatar-edit-img").attr('src', response);
                window.location.href = site_url+'dashboard_one'

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('status Code:' + xhr.status + 'Error Message :' + thrownError);
        }
    });
}