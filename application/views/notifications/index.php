<style>
    .general-item-list > a > .item > .item-head > .item-details > .item-pic {
        height: 35px;
        margin-right: 10px;
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        -ms-border-radius: 100%;
        -o-border-radius: 100%;
        border-radius: 100%; }


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
                    <span>Notifications</span>
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

                                <div class="row"> 

                                    <div class=" ">
                                        <div class="portlet light ">
                                            <div class="portlet-body">
                                                <div class="scroller" style="height: 338px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                    <div class="general-item-list">

                                                    <?php foreach ($n_arr_request_list as $key => $request_list) {

                                                        if( $request_list->notify_type == 2 ){
                                                            $href = site_url('mailbox/index/pending');
                                                        }elseif($request_list->notify_type == 3){
                                                            $href = site_url('mailbox/index/accepted');
                                                        }elseif($request_list->notify_type == 1){
                                                            $href = site_url('photos_single/user_categories/'.$request_list->friend_id);
                                                        }

                                                        ?>


                                                        <a href="<?php echo $href; ?>">

                                                            <div class="item row" style="background-color: beige; padding: 10px;margin-bottom: 5px">

                                                            <div class="item-head">

                                                                <div class="item-details col-md-2" style="padding-right: 0px; float: left; width: 15%">
                                                                    <?php if( $request_list->image && file_exists( './files/profile/'.$request_list->friend_id.'/'.$request_list->image ) ) {?>
                                                                        <img class="item-pic rounded" src="<?php echo base_url('files/profile/'.$request_list->friend_id.'/'.$request_list->image);?>" class="img-responsive" alt="">
                                                                    <?php } else {?>
                                                                        <img class="item-pic rounded" src="<?php echo base_url('assets/pages/media/users/User_No-Frame.png'); ?>"
                                                                             class="img-responsive" alt="">
                                                                    <?php }?>
                                                                </div>



                                                                <div class="col-md-10" style=" float: left; width: 85%">
                                                                    <span class="item-name primary-link">
                                                                        <?php echo $request_list->first_name.' '.$request_list->last_name; ?></span>
                                                                    <?php echo get_notify_type($request_list->notify_type); ?>

                                                                </div>



                                                            </div>

<!--                                                            <div class="item-body col-md-10">-->
<!--                                                            </div>-->

                                                        </div>

                                                        </a>



                                                    <?php } ?> 



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
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



