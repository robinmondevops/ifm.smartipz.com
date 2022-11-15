<style>

    .edit_profile{
        position: relative;
        top: 0px;
        left: 40%;
        background-color: Transparent !important;
        border:none;
    }
    .each-item-profile{
        margin-top: 10px;
    }
    .each-item-button-row{
        /*margin-top: 10px;*/
    }


    .requested{
        background-color: #2bb254 !important;
    }

    .friends{
        background-color: #008080 !important;
    }

    .accept{
        background-color: #3279d2 !important;
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
                    <span>Search</span>
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
                                    <div class="col-md-12"><h5><b>Search Result</b></h5></div>

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

//                                            echo "<pre>"; print_r($friend_occ_details);exit;


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

                                                        <div class="each-item-button-row">
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
                                                            <div class="col-md-9" style="margin-bottom: 15px;">
                                                                <div class="col-md-12" style="padding: 5px 0px 5px 0px"><?php echo get_user_tag($user_search->id);?></div>
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



