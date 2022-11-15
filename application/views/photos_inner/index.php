<div class="page-content-wrapper">
    
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
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
                                <!-- SIDEBAR USERPIC -->
                                
                                
                                
                                <?php $this->load->view('templates/left_sidebar'); ?>
                                <!-- END MENU -->
                            </div>
                            <!-- END PORTLET MAIN -->
                            
                        </div>    

                        <div class="profile-content">

                            <div class="right_side_wrapper col-md-9">

                                <div class="profile_pics col-md-12">
                                    <div class="col-md-12"><h5><b>Album Images</b></h5></div>

                                    <?php if( count($arr_album_pic)>0 ) { 

                                        foreach ($arr_album_pic as  $pic) {
                                    ?> 

                                    <div class="col-md-4 pic_col" id="<?php echo $pic->id; ?>">
                                        <!-- SIDEBAR USERPIC -->                            
                                        <div class="profile-pic profile_box">
                                            <a href="<?php echo site_url('images/client_images/'.$this->user->id.'/'.$pic->thumb);?>" rel="prettyPhoto[pp_gal4]">
                                                <img src="<?php echo base_url('images/client_images/'.$this->user->id.'/'.$pic->thumb);?>" class="img-responsive" alt=""> 
                                            </a>  

                                        <div class="btn_box col-md-12">
                                        <div class="row">
                                        <button data-id="<?php echo $pic->id; ?>" class="btn btn-circle red btn-sm delete" type="button">Delete</button>      
                                        </div>
                                        </div>
                                        </div>
                                        <!-- END SIDEBAR USERPIC -->
                                    </div>

                                    <?php } } else { ?>
                                        <div class="col-md-12"><h2><b>No data found</b></h2></div>
                                    <?php } ?>


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



