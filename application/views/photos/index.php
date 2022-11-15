<style>
    .pic_col{
        margin: 10px 0px;
    }
    .pic_col_profile{
        min-height: 200px;
    }
</style>


<div class="page-content-wrapper">
    
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
    <input type="hidden" id="pic_balance" name="pic_balance" value="<?php echo $pics_balance; ?>">
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE BREADCRUMBS -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="<?php echo site_url();?>">Home</a>  
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Photos</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMBS -->

            <div class="page-content-inner">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN PROFILE SIDEBAR -->
                        <div class="profile-sidebar">
                            <!-- PORTLET MAIN -->
                            <div class="portlet light profile-sidebar-portlet ">
                                
                                <?php $this->load->view('templates/left_sidebar'); ?>
                                <!-- END MENU -->
                            </div>

                            
                        </div>    

                        <div class="profile-content">

                            <div class="right_side_wrapper col-md-9">

                                <div class="profile_pics col-md-12">

                                    <div class="row col-md-12">
                                        <div class="col-md-12">
                                            <div class="dropzone"></div>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 30px;">
                                            <button class="btn btn-danger btn-block  float-right " type="submit" id="update_form">Update</button>

                                        </div>


                                    </div>

                                    <div class="col-md-12" style="margin: 10px 0px">

<!--                                        <button style="display: --><?php //echo ($pics_balance > 0)?'':'none';?><!--"-->
<!--                                                class="btn btn-block create_album">Upload Images</button>-->

                                        <div style="text-align: center; display: <?php echo ($pics_balance > 0)?'none':'';?>"
                                             class="alert alert-success max_limit_alert">
                                            <strong>Warning!</strong> Maximum limit exceeded, delete some pics to upload new pics.
                                        </div>

                                    </div>

                                    <div class="col-md-12"><h5><b>My Images</b></h5></div>

                                    <div id="album_list">

                                        <?php if(is_array($arr_album_pic) && count($arr_album_pic)>0 ) { ?>

                                            <?php foreach ($arr_album_pic as  $pic) {
                                                ?>

                                                <div class="col-md-4 pic_col" id="<?php echo $pic->id; ?>">
                                                    <!-- SIDEBAR USERPIC -->
                                                    <div class="profile-pic profile_box">
                                                        <a href="<?php echo site_url('images/client_images/'.$this->user->id.'/'.$pic->image);?>"
                                                           rel="prettyPhoto[pp_gal4]">
                                                            <img  src="<?php echo base_url('images/client_images/'.$this->user->id.'/'.$pic->thumb);?>"
                                                                 class="img-responsive" alt="">
                                                        </a>

                                                        <div class="btn_box col-md-12">
                                                            <div class="row">
                                                                <button data-id="<?php echo $pic->id; ?>" class="btn btn-circle red btn-sm delete" type="button">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END SIDEBAR USERPIC -->
                                                </div>

                                            <?php } ?>

                                        <?php  } else { ?>

                                            <div class="col-md-12"><h2><b>No Images uploaded</b></h2></div>

                                        <?php }  ?>

                                    </div>


                                </div>



                                <div class="profile_pics col-md-12">

                                    <?php if( count($arr_profile_pic)>0 ) { ?>

                                        <div class="col-md-12"><h5><b>Profile Pictures</b></h5></div>

                                    <?php
                                        foreach ($arr_profile_pic as  $pic) {
                                    ?>

                                    <div class="col-md-4 pic_col pic_col_profile" id="<?php echo $pic->id; ?>">
                                        <!-- SIDEBAR USERPIC -->
                                        <div class="profile-pic profile_box">

                                            <a href="<?php echo base_url('files/profile/'.$this->user->id.'/'.$pic->name);?>"
                                                   rel="prettyPhoto[pp_gal4]">
                                                <img height="190px" src="<?php echo base_url('files/profile/'.$this->user->id.'/'.$pic->name);?>"
                                                 class="img-responsive" alt="" style="height: 190px">
                                            </a>

                                            <div class="btn_box btn_box_profile col-md-12">
                                                <div class="row">
                                                    <button data-name="<?php echo $pic->name; ?>" data-id="<?php echo $pic->id; ?>" class="btn btn-circle green btn-sm set" type="button">Set Default</button>
                                                    <button data-id="<?php echo $pic->id; ?>" class="btn btn-circle red btn-sm delete" type="button">Delete</button>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- END SIDEBAR USERPIC -->
                                    </div>

                                    <?php } }?>


                                </div>


                            </div>


                            <?php $this->load->view('templates/right_sidebar'); ?>

                        </div>

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>


            
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>


<script type="text/template" id="qq-template">
    <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
        </div>
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span class="qq-upload-drop-area-text-selector"></span>
        </div>
        <div class="qq-upload-button-selector qq-upload-button">
            <div>Upload a file</div>
        </div>
        <span class="qq-drop-processing-selector qq-drop-processing">
            <span>Processing dropped files...</span>
            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
        <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
            <li>
                <div class="qq-progress-bar-container-selector">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale />
                <span class="qq-upload-file-selector qq-upload-file hidden"></span>
                <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text" />
                <span class="qq-upload-size-selector qq-upload-size hidden"></span>
                <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete ">Delete</button>
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </li>
        </ul>

        <dialog class="qq-alert-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Close</button>
            </div>
        </dialog>

        <dialog class="qq-confirm-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">No</button>
                <button type="button" class="qq-ok-button-selector">Yes</button>
            </div>
        </dialog>

        <dialog class="qq-prompt-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <input type="text">
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Cancel</button>
                <button type="button" class="qq-ok-button-selector">Ok</button>
            </div>
        </dialog>
    </div>
</script>


<div class="modal fade" id="album_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="album_modal_title"></h4>
            </div>
            <div class="modal-body"> 
                <div class="row"></div> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>

    $(document).on('click', '.save_album', function(){

        var $this = $(this);
        var formData = $('#form_album').serialize();

        var $url = site_url+'photos/save_album';

        var $error = 0;

        $('#name-box, #image-box').removeClass('has-error');
        $('#name-error, #image-error').html('');



        if( $('#uploaded_files').val() == '' ) {
            $('#image-box').addClass('has-error');
            $('#image-error').html('Image required');
            $error++;
        }


        if ( $error == 0 ) {
            $('#name-box').removeClass('has-error');
            $('#name-error').html('');
            $this.attr('disabled', true);
            $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
            $.ajax({
                url: $url,
                type: 'POST',
                data: formData,
                success: function (data) {
                    $this.attr('disabled', false);
                    $('#album_modal').modal('hide');
                    $('#album_list').html(data.html);

                    $.unblockUI();

                }
            });
        }


    });

</script>



