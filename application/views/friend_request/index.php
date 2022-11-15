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
                    <span>Friend Request</span>
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

                                <div class="row" id="msg_box"></div>
                                <div class="profile_pics col-md-12">
                                    

                                    <?php if( count($arr_request) == 0 ){  ?>

                                    <div class="col-md-12"><h5><b>No Requests Found</b></h5></div>

                                    <?php } else { ?>
                                    <div class="col-md-12"><h5><b>Friend Requests</b></h5></div>
                                    <?php } ?>

                                    <!--Each User-->

                                    <?php 
                                    //echo "<pre>"; print_r($result);exit;
                                    foreach ($arr_request as $user_search) { 

                                        //echo "<pre>"; print_r($user_search);exit;

                                        $user_id = $this->user->id;
                                        $friend_id = $user_search->friend_id;
                                        
                                        //$friend_status = get_friend_status( $user_id, $friend_id );

                                        //echo "<pre>"; print_r($friend_status); exit;

                                        $action = 'accept';      
                                        $label = 'Accept';      
 

                                    ?>
                                        
                                    
                                    <div class="col-md-6" id="request_<?php echo $user_search->friend_id; ?>">  
                                        <div class="user_box">
                                        <div class="row">  
                                            <div class="col-md-3"> 
                                                <div class="row">                    
                                                    <div class="col-md-12">
                                                    <div class="row"> 

                                                        <?php if( $user_search->image && file_exists( './files/profile/'.$user_search->friend_id.'/'.$user_search->image ) ) {?>
                                                            <img src="<?php echo base_url('files/profile/'.$user_search->friend_id.'/'.$user_search->image);?>" class="img-responsive" alt=""> 
                                                        <?php } else {?>
                                                            <img src="<?php echo base_url('assets/pages/media/users/User_No-Frame.png'); ?>" class="img-responsive" alt=""> 
                                                        <?php }?>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                            <h5><b><?php echo $user_search->first_name.' '.$user_search->last_name; ?></b></h5>
                                            <button id="<?php echo $user_search->friend_id; ?>" data-action="<?php echo $action; ?>" data-friend="<?php echo $user_search->friend_id; ?>" <?php echo ($action == '' || $action == '' )?'disabled':''; ?> data-id="<?php echo $this->user->id; ?>" class="btn btn-circle green btn-sm <?php echo $action; ?>" type="button"><?php echo $label; ?></button>
                                            <a href="<?php echo site_url('photos_single/user_categories/'.$user_search->friend_id); ?>" class="btn btn-circle red btn-sm" type="button">View Profile</a>   
                                            </div>
                                        </div>
                                        </div>
                                    <!--Each User End-->
                                    </div>

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



