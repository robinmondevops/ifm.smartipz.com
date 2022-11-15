
<style>
    .pic_col{
        margin: 10px 0px;
    }
 
</style>

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
                                
                                <div class="profile-userpic image_box">
                                    <?php if( $user->image && file_exists( './files/profile/'.$user_id.'/'.$user->image ) ) {?>

                                    <a href="<?php echo site_url('files/profile/'.$user->id.'/'.$user->image);?>"
                                       rel="prettyPhoto[pp_gal4]">

                                        <img src="<?php echo base_url('files/profile/'.$user->id.'/'.$user->image);?>" class="img-responsive" alt="">

                                    </a>
                                    <?php } else {?>
                                        <img src="<?php echo base_url('assets/pages/media/users/User_No-Frame.png'); ?>" class="img-responsive" alt=""> 
                                    <?php }?>
                                </div>
                                <!-- END SIDEBAR USERPIC -->
                                <!-- SIDEBAR USER TITLE -->
                                <div class="profile-usertitle">
                                    <div class="profile-usertitle-name"> <?php echo $user->first_name.' '.$user->last_name; ?> </div>
                                    <!-- <div class="profile-usertitle-job"> Developer </div> -->
                                </div>
                                <!-- END SIDEBAR USER TITLE -->

                                

                                
                                <div class="profile-usermenu">
                                    <ul class="nav">

                                        <li class="<?php echo $menu == 'single_dashboard'?'active':''; ?>">
                                            <a href="<?php echo site_url('photos_single/user_categories/'.$user->id); ?>">
                                                <i class="icon-list"></i> View Profile </a>
                                        </li>

                                        <li class="<?php echo $menu == 'single_photos'?'active':''; ?>">
                                            <a href="<?php echo site_url('photos_single/view/'.$user->id); ?>">
                                                <i class="icon-picture"></i> Photos </a>
                                        </li>

                                        <li class="<?php echo $menu == 'single_friends'?'active':''; ?>">
                                            <a href="<?php echo site_url('messages/send_message/'.encrypt($user->id)); ?>">
                                                <i class="icon-user"></i> Send Message </a>
                                        </li>


                                    </ul>
                                </div> 
                            </div>
                            <!-- END PORTLET MAIN -->
                            
                        </div>    

                        <div class="profile-content">

                            <div class="right_side_wrapper col-md-9">

                                <div class="profile_pics col-md-12">


                                    <?php if( is_array($arr_album_pic) && count($arr_album_pic)>0 ) {


                                        foreach ($arr_album_pic as  $pic) {
                                            ?>

                                            <div class="col-md-4 pic_col" id="<?php echo $pic->id; ?>">
                                                <!-- SIDEBAR USERPIC -->
                                                <div class="profile-pic profile_box">
                                                    <a href="<?php echo site_url('images/client_images/'.$user->id.'/'.$pic->image);?>"
                                                       rel="prettyPhoto[pp_gal4]">
                                                    <img src="<?php echo base_url('images/client_images/'.$user->id.'/'.$pic->thumb);?>" class="img-responsive" alt="">
                                                </a>
                                                </div>
                                                <!-- END SIDEBAR USERPIC -->
                                            </div>

                                        <?php } ?> <?php  }else { ?>
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



