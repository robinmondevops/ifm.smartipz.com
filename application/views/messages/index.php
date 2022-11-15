<style>

    @media (max-width: 991px) and (min-width: 768px){

        .message_wrap_container{
            width: 100% !important;
            padding: 0px 0px;
        }
        .message_wrap_inner{
            padding: 0px 0px;
        }
    }

    @media (max-width: 767px){
        .message_wrap_container{
            width: 100% !important;
            padding: 0px 0px;
        }
        .message_wrap_inner{
            padding: 0px 0px;
        }
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
                    <span>Dashboard</span>
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
                                
                                <div class="profile-userpic">
                                    <?php if( $this->user->image && file_exists( './files/profile/'.$this->user->id.'/'.$this->user->image ) ) {?>
                                        <img src="<?php echo base_url('files/profile/'.$this->user->id.'/'.$this->user->image);?>" class="img-responsive" alt=""> 
                                    <?php } else {?>
                                        <img src="<?php echo base_url('assets/pages/media/users/User_No-Frame.png'); ?>" class="img-responsive" alt=""> 
                                    <?php }?>
                                </div>
                                <!-- END SIDEBAR USERPIC -->
                                <!-- SIDEBAR USER TITLE -->
                                <div class="profile-usertitle">
                                    <div class="profile-usertitle-name"> <?php echo $this->user->first_name.' '.$this->user->last_name; ?> </div>
                                    <!-- <div class="profile-usertitle-job"> Developer </div> -->
                                </div>

                                <?php $this->load->view('templates/left_sidebar'); ?>
                                <!-- END MENU -->
                            </div>
                            <!-- END PORTLET MAIN -->
                        </div>      

                        <div class="profile-content">

                            <div class="pull-left col-md-9 message_wrap_container">

                                <div class="col-md-12 message_wrap_inner">
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bubble font-hide hide"></i>
                                                <span class="caption-subject font-hide bold uppercase">Chats</span>
                                            </div>
                                            <div class="online_user" style="float:right">

                                            </div>
                                        </div>
                                        <div class="portlet-body" id="chats">
                                            <div class="scroller" style="height: 500px;" data-always-visible="1" data-rail-visible1="1">
                                                <ul class="chats" id="messages">

                                                    <?php

                                                    $arr_dist = [];

                                                    foreach( $messages as $model ){

                                                        $class = "in";
                                                        $class_common = 'in';
                                                        $image_message_dis = $model->image;
                                                        $user_dis = $model->user_id_from;
                                                        $user_name = $model->first_name;

                                                        if( $model->friend_id_to != $this->session->userdata('user_id') ) {
                                                            $class = "out";
                                                            $image_message_dis = $model->image_1;
                                                            $user_dis = $model->friend_id_to;
                                                            $user_name = $model->first_name1;
                                                        }

                                                        if( in_array( $user_dis, $arr_dist )){
                                                           continue;
                                                        }

                                                        $arr_dist[] = $user_dis;


                                                        ?>

                                                        <li class="<?php echo $class_common;?>">
                                                            <a href="<?php echo site_url('messages/send_message/'.encrypt($user_dis));?>">
                                                            <?php if( $model->image && file_exists( './files/profile/'.$user_dis.'/'.$image_message_dis ) ) {?>
                                                                <img class="avatar" alt="" src="<?php echo base_url('files/profile/'.$user_dis.'/'.$image_message_dis);?>" />

                                                            <?php } else { ?>
                                                                <img class="avatar" alt="" src="<?php echo base_url('assets/layouts/layout/img/avatar.png'); ?>" />
                                                            <?php }?>
                                                            </a>
                                                            <div class="message">
                                                                <span class="arrow"> </span>
                                                                <a href="<?php echo site_url('messages/send_message/'.encrypt($user_dis));?>"
                                                                   class="name"> <?php echo $user_name; ?> </a>
                                                                <span class="body"> <?php echo $model->message;?> </span>
                                                            </div>
                                                        </li>

                                                    <?php }?>

                                                </ul>

                                            </div>
<!--                                            <div class="chat-form">-->
<!--                                                <div class="input-cont">-->
<!--                                                    <input class="form-control" id="m" type="text" placeholder="Type a message here..." />-->
<!--                                                </div>-->
<!--                                                <div class="btn-cont">-->
<!--                                                    <span class="arrow"> </span>-->
<!--                                                    <a href="javascript:;" id="send_message" class="btn blue icn-only">-->
<!--                                                        <i class="fa fa-check icon-white"></i>-->
<!--                                                    </a>-->
<!--                                                </div>-->
<!--                                            </div>-->
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









