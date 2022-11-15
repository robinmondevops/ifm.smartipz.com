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

                            <div class="pull-left  col-md-9 message_wrap_container">

                                <div class="col-md-12 message_wrap_inner">
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bubble font-hide hide"></i>
                                                <span class="caption-subject font-hide bold uppercase">Message -
                                                    <a href="<?php echo site_url('photos_single/user_categories/'.$row['id']); ?>">
                                                        <?php echo $row['first_name'].' '.$row['last_name']; ?>
                                                    </a>

                                                </span>
                                            </div>

                                        </div>
                                        <div class="portlet-body" id="chats">

                                            <div id="notes-html-success"  style="display: none">

                                            </div>

                                            <div class="scroller" style="height: 500px;" data-always-visible="1" data-rail-visible1="1">
                                                <ul class="chats" id="messages">

                                                    <?php foreach( $messages as $model ){
                                                        $class = "in";
                                                        if( $model->friend_id_to != $this->session->userdata('user_id') ) {
                                                            $class = "out";
                                                        }
                                                        ?>

                                                        <li class="<?php echo $class;?>">
                                                            <?php if( $model->image && file_exists( './files/profile/'.$model->user_id_from.'/'.$model->image ) ) {?>
                                                                <img class="avatar" alt="" src="<?php echo base_url('files/profile/'.$model->user_id_from.'/'.$model->image);?>" />

                                                            <?php } else { ?>
                                                                <img class="avatar" alt="" src="<?php echo base_url('assets/layouts/layout/img/avatar.png'); ?>" />
                                                            <?php }?>
                                                            <div class="message">
                                                                <span class="arrow"> </span>
                                                                <a href="<?php echo site_url('photos_single/user_categories/'.$model->user_id_from); ?>"

                                                                   class="name"> <?php echo $model->first_name; ?> </a>
                                                                <span class="body"> <?php echo $model->message;?> </span>
                                                            </div>
                                                        </li>

                                                    <?php }?>


                                                </ul>

                                            </div>

                                            <input type="hidden" name="friend_id_to" id="friend_id_to" value="<?php echo $user_id; ?>" />

                                            <div class="chat-form">
                                                <div class="input-cont">
                                                    <input class="form-control" id="m" type="text" placeholder="Type a message here..." />
                                                </div>
                                                <div class="btn-cont">
                                                    <span class="arrow"> </span>
                                                    <a href="javascript:;" data-url="<?php echo site_url('messages/insert_message');?>" id="send_message" class="btn blue icn-only">
                                                        <i class="fa fa-check icon-white"></i>
                                                    </a>
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

<div id="message_template" style="display: none">

    <li class="out">
        <?php if( $this->user->image && file_exists( './files/profile/'.$this->user->id.'/'.$this->user->image ) ) {?>
            <img class="avatar" alt="" src="<?php echo base_url('files/profile/'.$this->user->id.'/'.$this->user->image);?>" />

        <?php } else { ?>
            <img class="avatar" alt="" src="<?php echo base_url('assets/layouts/layout/img/avatar.png'); ?>" />
        <?php }?>
        <div class="message">
            <span class="arrow"> </span>
            <a href="javascript:;" class="name"> <?php echo $this->user->first_name; ?> </a>
            <span id="tem_message" class="body">tem_message_content </span>
        </div>
    </li>
</div>









