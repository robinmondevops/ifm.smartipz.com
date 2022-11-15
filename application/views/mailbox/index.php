
<style>
    .each-item-profile{
        margin-top: 10px;
    }
    .each-item-button-row{
        /*margin-top: 10px;*/
    }
    .item_content_row{
        margin-bottom: 15px;
    }

    .each-item-profile:nth-of-type(2n+1) {
        clear: left
    }
    .profile_link{
        color: #071106c9 !important;
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
                    <span>Mailbox</span>
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

                                <div class="portlet light portlet-fit col-md-12">
                                    <div class="portlet-body">



                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="profile-content">
                                                    <div class="row">
                                                        <div class="row">

                                                            <?php if($this->session->flashdata('msg')){?>
                                                                <div class="alert alert-success">
                                                                    <button class="close" data-close="alert"></button>
                                                                    <span><?php echo $this->session->flashdata('msg');?></span>
                                                                </div>
                                                            <?php }?>

                                                            <?php if($this->session->flashdata('error_msg')){?>
                                                                <div class="alert alert-danger">
                                                                    <button class="close" data-close="alert"></button>
                                                                    <span><?php echo strip_tags($this->session->flashdata('error_msg'));?></span>
                                                                </div>
                                                            <?php }?>

                                                            <div class="portlet light ">
                                                                <div class="portlet-title tabbable-line">
                                                                    <div class="caption caption-md">
                                                                        <i class="icon-globe theme-font hide"></i>
                                                                        <span class="caption-subject font-blue-madison bold uppercase col-md-12">Mailbox </span>
                                                                    </div>
                                                                    <ul class="nav nav-tabs">
                                                                        <li id="personal_info" <?php echo $tab ==  'pending'? 'class="active"': '';?> >
                                                                            <a href="#tab_1_1" data-toggle="tab">Pending</a>
                                                                        </li>
                                                                        <li id="profile_pic" <?php echo $tab ==  'accepted'? 'class="active"': '';?> >
                                                                            <a href="#tab_1_2" data-toggle="tab">Accepted</a>
                                                                        </li>
                                                                        <li id="user_password"  <?php echo $tab ==  'declined'? 'class="active"': '';?>>
                                                                            <a href="#tab_1_3" data-toggle="tab">Declined</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="portlet-body">
                                                                    <div class="tab-content reg_edit">
                                                                        <!-- PERSONAL INFO TAB -->

                                                                        <div class="tab-pane <?php echo $tab ==  'pending'? 'active': '';?>" id="tab_1_1">
                                                                            <div class="row row_pending" style="padding-bottom: 25px;">

                                                                                <!--Each User-->

                                                                                <?php
                                                                                //echo "<pre>"; print_r($result);exit;
                                                                                if( is_array($pending_result) and count($pending_result)>0 ){
                                                                                    foreach ($pending_result as $user_search) {



                                                                                        $user_id = $this->user->id;
                                                                                        $friend_id = $user_search->id;

                                                                                        $friend_status = get_friend_status( $user_id, $friend_id );

                                                                                        $friend_basic_details = $this->common->get('basic_details',['user_id'=>$friend_id]);
                                                                                        if( !$friend_basic_details ){
                                                                                            continue;
                                                                                        }
                                                                                        $left_join = array(
                                                                                            'edu_category_list cl' => 'pd.edu_item=cl.id',
                                                                                        );

                                                                                        $friend_occ_details = $this->common->get('profectional_details pd',
                                                                                            ['user_id'=>$friend_id],'','', $left_join);

                                                                                        //     echo "<pre>"; print_r($friend_occ_details);exit;


                                                                                        $action = $friend_status['action'];
                                                                                        $label = $friend_status['label'];

                                                                                        $arr_details = [];
                                                                                        $arr_details[] = $friend_basic_details->age.' Yrs';
                                                                                        $arr_details[] = $friend_occ_details['name'];
                                                                                        $arr_details[] = $user_search->city;
                                                                                        $arr_details[] = $user_search->district_name;
                                                                                        $arr_details[] = $user_search->state_name;
                                                                                        $arr_details[] = $user_search->country_name;

                                                                                        $str_details = implode(' , ', array_filter($arr_details));

                                                                                        ?>


                                                                                        <div class="col-md-6 each-item-profile" id="friend_<?php echo $friend_id; ?>">
                                                                                            <div class="user_box">
                                                                                                <div class="row">

                                                                                                    <div class="col-md-12 each-item-button-row">

                                                                                                        <a class="profile_link" href="<?php echo site_url('photos_single/user_categories/'.$user_search->id); ?>">
                                                                                                            <div class="col-md-3">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="row">

                                                                                                                            <?php if( $user_search->image && file_exists( './files/profile/'.$user_search->id.'/'.$user_search->image ) ) {?>
                                                                                                                                <img src="<?php echo base_url('files/profile/'.$user_search->id.'/'.$user_search->image);?>" class="img-responsive" alt="">
                                                                                                                            <?php } else {?>
                                                                                                                                <img src="<?php echo base_url('assets/pages/media/users/User_No-Frame.png'); ?>" class="img-responsive" alt="">
                                                                                                                            <?php }?>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-9 item_content_row">
                                                                                                                <h5><b><?php echo $user_search->first_name.' '.$user_search->last_name; ?></b> (<?php echo 'KNA'.$user_search->kna_id;?>)</h5>
                                                                                                                <div>
                                                                                                                    <?php echo $str_details; ?>
                                                                                                                </div>

                                                                                                            </div>
                                                                                                        </a>




                                                                                                        <button id="<?php echo $user_search->id; ?>" data-action="<?php echo $action; ?>"
                                                                                                                data-friend="<?php echo $user_search->id; ?>" <?php echo ($action == '' || $action == '' )?'disabled':''; ?>
                                                                                                                data-id="<?php echo $this->user->id; ?>" class="btn btn-block green btn-sm <?php echo $action; ?>" type="button">
                                                                                                            <?php echo $label; ?></button>

                                                                                                        <a id="btn_reject_<?php echo $user_search->id; ?>" href="javascript:;" class="unfriend btn btn-block red btn-sm" data-unid="<?php echo $this->user->id; ?>"
                                                                                                           data-unfriend="<?php echo $user_search->id; ?>">
                                                                                                            Reject</a>

                                                                                                        <a href="<?php echo site_url('photos_single/user_categories/'.$user_search->id); ?>" class=" btn btn-block red btn-sm"  >
                                                                                                            View Profile</a>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--Each User End-->
                                                                                        </div>

                                                                                    <?php } }?>



                                                                            </div>
                                                                        </div>

                                                                        <!-- END PERSONAL INFO TAB -->
                                                                        <!-- CHANGE AVATAR TAB -->

                                                                        <div class="tab-pane <?php echo $tab == 'accepted'? 'active': '';?>" id="tab_1_2">

                                                                            <div class="row row_accepted" style="padding-bottom: 25px;">

                                                                                <!--Each User-->

                                                                                <?php
                                                                                //echo "<pre>"; print_r($result);exit;
                                                                                if( is_array($result) and count($result)>0 ){
                                                                                    foreach ($result as $user_search) {



                                                                                        $user_id = $this->user->id;
                                                                                        $friend_id = $user_search->id;

                                                                                        $friend_status = get_friend_status( $user_id, $friend_id );

                                                                                        $friend_basic_details = $this->common->get('basic_details',['user_id'=>$friend_id]);
                                                                                        if( !$friend_basic_details ){
                                                                                            continue;
                                                                                        }
                                                                                        $left_join = array(
                                                                                            'edu_category_list cl' => 'pd.edu_item=cl.id',
                                                                                        );

                                                                                        $friend_occ_details = $this->common->get('profectional_details pd',
                                                                                            ['user_id'=>$friend_id],'','', $left_join);

                                                                                        //     echo "<pre>"; print_r($friend_occ_details);exit;


                                                                                        $action = $friend_status['action'];
                                                                                        $label = $friend_status['label'];

                                                                                        $arr_details = [];
                                                                                        $arr_details[] = $friend_basic_details->age.' Yrs';
                                                                                        $arr_details[] = $friend_occ_details['name'];
                                                                                        $arr_details[] = $user_search->city;
                                                                                        $arr_details[] = $user_search->district_name;
                                                                                        $arr_details[] = $user_search->state_name;
                                                                                        $arr_details[] = $user_search->country_name;

                                                                                        $str_details = implode(' , ', array_filter($arr_details));

                                                                                        ?>


                                                                                        <div class="col-md-6 each-item-profile">
                                                                                            <div class="user_box">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 each-item-button-row">

                                                                                                        <div class="col-md-3">
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12">
                                                                                                                    <div class="row">

                                                                                                                        <?php if( $user_search->image && file_exists( './files/profile/'.$user_search->id.'/'.$user_search->image ) ) {?>
                                                                                                                            <img src="<?php echo base_url('files/profile/'.$user_search->id.'/'.$user_search->image);?>" class="img-responsive" alt="">
                                                                                                                        <?php } else {?>
                                                                                                                            <img src="<?php echo base_url('assets/pages/media/users/User_No-Frame.png'); ?>" class="img-responsive" alt="">
                                                                                                                        <?php }?>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-9 item_content_row" >
                                                                                                            <h5><b><?php echo $user_search->first_name.' '.$user_search->last_name; ?></b> (<?php echo 'KNA'.$user_search->kna_id;?>)</h5>
                                                                                                            <div>
                                                                                                                <?php echo $str_details; ?>
                                                                                                            </div>

                                                                                                        </div>

                                                                                                        <button id="<?php echo $user_search->id; ?>" data-action="<?php echo $action; ?>"
                                                                                                                data-friend="<?php echo $user_search->id; ?>" <?php echo ($action == '' || $action == '' )?'disabled':''; ?>
                                                                                                                data-id="<?php echo $this->user->id; ?>" class="btn btn-block green btn-sm <?php echo $action; ?>" type="button">
                                                                                                            <?php echo $label; ?></button>
                                                                                                        <a href="<?php echo site_url('photos_single/user_categories/'.$user_search->id); ?>"
                                                                                                           class="btn btn-block red btn-sm" type="button">View Profile</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--Each User End-->
                                                                                        </div>

                                                                                    <?php } }?>



                                                                            </div>

                                                                        </div>

                                                                        <!-- END CHANGE AVATAR TAB -->
                                                                        <!-- CHANGE PASSWORD TAB -->

                                                                        <div class="tab-pane <?php echo $tab ==  'declined'? 'active': '';?>" id="tab_1_3">

                                                                            <div class="row row_declined" style="padding-bottom: 25px;">

                                                                                <!--Each User-->

                                                                                <?php
                                                                                //echo "<pre>"; print_r($result);exit;
                                                                                if( is_array($rejected_result) and count($rejected_result)>0 ){
                                                                                    foreach ($rejected_result as $user_search) {



                                                                                        $user_id = $this->user->id;
                                                                                        $friend_id = $user_search->id;

                                                                                        $friend_status = get_friend_status( $user_id, $friend_id );

                                                                                        $friend_basic_details = $this->common->get('basic_details',['user_id'=>$friend_id]);
                                                                                        if( !$friend_basic_details ){
                                                                                            continue;
                                                                                        }
                                                                                        $left_join = array(
                                                                                            'edu_category_list cl' => 'pd.edu_item=cl.id',
                                                                                        );

                                                                                        $friend_occ_details = $this->common->get('profectional_details pd',
                                                                                            ['user_id'=>$friend_id],'','', $left_join);

                                                                                        //     echo "<pre>"; print_r($friend_occ_details);exit;


                                                                                        $action = $friend_status['action'];
                                                                                        $label = $friend_status['label'];

                                                                                        $arr_details = [];
                                                                                        $arr_details[] = $friend_basic_details->age.' Yrs';
                                                                                        $arr_details[] = $friend_occ_details['name'];
                                                                                        $arr_details[] = $user_search->city;
                                                                                        $arr_details[] = $user_search->district_name;
                                                                                        $arr_details[] = $user_search->state_name;
                                                                                        $arr_details[] = $user_search->country_name;

                                                                                        $str_details = implode(' , ', array_filter($arr_details));

                                                                                        ?>


                                                                                        <div class="col-md-6 each-item-profile">
                                                                                            <div class="user_box">
                                                                                                <div class="row">

                                                                                                    <div class="col-md-12 each-item-button-row">

                                                                                                        <a  href="<?php echo site_url('photos_single/user_categories/'.$user_search->id); ?>"
                                                                                                           class="profile_link" type="">

                                                                                                            <div class="col-md-3">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="row">

                                                                                                                            <?php if( $user_search->image && file_exists( './files/profile/'.$user_search->id.'/'.$user_search->image ) ) {?>
                                                                                                                                <img src="<?php echo base_url('files/profile/'.$user_search->id.'/'.$user_search->image);?>" class="img-responsive" alt="">
                                                                                                                            <?php } else {?>
                                                                                                                                <img src="<?php echo base_url('assets/pages/media/users/User_No-Frame.png'); ?>" class="img-responsive" alt="">
                                                                                                                            <?php }?>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-9">
                                                                                                                <h5><b><?php echo $user_search->first_name.' '.$user_search->last_name; ?></b> (<?php echo 'KNA'.$user_search->kna_id;?>)</h5>
                                                                                                                <div>
                                                                                                                    <?php echo $str_details; ?>
                                                                                                                </div>

                                                                                                            </div>

                                                                                                        </a>

                                                                                                        <div class="col-md-12 each-item-button-row">


                                                                                                            <a href="javascript:;" class=" btn red btn-sm btn-block" >
                                                                                                                Declined Your Interest</a>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--Each User End-->
                                                                                        </div>

                                                                                    <?php } }?>



                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END PROFILE CONTENT -->
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


<script>


    $(document).ready(function(){

        $('#dob').datetimepicker({
            format: 'DD-MM-YYYY',
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'glyphicon glyphicon-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });


        $(document).on('change','#employed_in', function(){

            var $this = $(this);
            var $employed_in = $this.val();
            if( $employed_in == 6 || $employed_in == '' ){
                $('.emp_details').hide();
            }else{
                $('.emp_details').show();
            }

        });

        $(document).on('change', '#country_id', function(){

            var $this = $(this);

            var $country_id = $this.val();


            if( $country_id == 78 ){
                $('.location_show').show();
            }else{
                $('.location_show').hide();
            }


        });

        $(document).on('change', '#state', function(){

            var $this = $(this);
            var $url = $this.data('url');

            var $state_id = $this.val();
            if( $state_id ){
                $.ajax({
                    type:"POST",
                    url:$url,
                    data:'state_id='+$state_id,
                    success:function(json){
                        $('#district').html(json.html);

                    }
                })
            }


        });

    });

</script>



