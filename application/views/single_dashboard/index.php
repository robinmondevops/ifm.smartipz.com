<style>
    .borderless td, .borderless th {
        border: none;
    }
    .tbl_profile > tbody> tr > td, th{
        padding-left: 25px !important;
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
                                <a href="<?php echo site_url('photos_single/view/'.$user->id); ?>">

                                    <div class="profile-userpic image_box">
                                        <?php if( $user->image && file_exists( './files/profile/'.$user->id.'/'.$user->image ) ) {?>
                                            <img src="<?php echo base_url('files/profile/'.$user->id.'/'.$user->image);?>" class="img-responsive" alt="">
                                        <?php } else {?>
                                            <img src="<?php echo base_url('assets/pages/media/users/User_No-Frame.png'); ?>" class="img-responsive" alt="">
                                        <?php }?>
                                    </div>

                                </a>

                                <!-- END SIDEBAR USERPIC -->
                                <!-- SIDEBAR USER TITLE -->
                                <div class="profile-usertitle">
                                    <div class="profile-usertitle-name"> <?php echo $user->first_name.' '.$user->last_name; ?> </div>
                                     <div class="" style="padding: 0px 40px;"> <?php echo $str_details; ?> </div>
                                </div>
                                <!-- END SIDEBAR USER TITLE -->

                                <div class="profile-userbuttons">
                                    <div id="msg_box"></div>
                                    <button id="main_btn_<?php echo $user->id; ?>" class="btn btn-circle red btn-sm <?php echo $action; ?>"
                                            data-id="<?php echo $this->user->id; ?>" data-friend="<?php echo $user->id; ?>"
                                            data-action="<?php echo $action; ?>" type="button"><?php echo $label; ?></button>
                                </div>   


                                
                                <div class="profile-usermenu" style="margin-top: 10px">
                                    <ul class="nav">

                                        <li class="<?php echo $menu == 'single_dashboard'?'active':''; ?>">
                                            <a href="<?php echo site_url('photos_single/user_categories/'.$user->id); ?>">
                                                <i class="icon-list"></i> View Profile </a>
                                        </li>

                                        <li class="<?php echo $menu == 'single_photos'?'active':''; ?>">
                                            <a href="<?php echo site_url('photos_single/view/'.$user->id); ?>">
                                                <i class="icon-picture"></i> Photos </a>
                                        </li>



                                        <?php /*

                                        <li class="<?php echo $menu == 'single_friends'?'active':''; ?>">
                                            <a href="<?php echo site_url('photos_single/friends/'.$user->id); ?>">
                                                <i class="icon-user"></i> Friends </a>
                                        </li> */?>


                                        <?php if( $action == 'friends') { ?>  

                                            <li id="unfriend_<?php echo $user->id; ?>" >
                                            <?php /*
                                            <a href="javascript:;" class="unfriend" data-unid="<?php echo $this->user->id; ?>" data-unfriend="<?php echo $user->id; ?>">
                                                <i class="icon-unlink"></i> Unfriend </a> */?>

                                            <a href="<?php echo site_url('messages/send_message/'.encrypt($user->id));?>"
                                               class="" >
                                                    <i class="icon-unlink"></i> Send  Message </a>


                                        </li>

                                        <?php } ?>
                                    </ul>
                                </div> 
                            </div>
                            <!-- END PORTLET MAIN -->
                            
                        </div>       

                        <div class="profile-content">



                            <div class="user_post_wrapper col-md-9 col-xs-12">

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="profile-content">

                                            <div class="row">

                                                <table class='table borderless tbl_profile'>
                                                    <tr>
                                                        <th colspan="3">
                                                            <i class="fa fa-pencil" ></i>
                                                            A Few Words About <?php echo $user->first_name; ?>

                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <?php echo $friend_basic_details->about; ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th colspan="3">
                                                            <i class="icon icon-file-alt" ></i>
                                                            Basic Details

                                                        </th>
                                                    </tr>

                                                    <tr>
                                                        <td >Name </td>
                                                        <td>:</td>
                                                        <td><?php echo $user->first_name; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td >Gender </td>
                                                        <td>:</td>
                                                        <td><?php echo ($user->gender == 'AL')?'Male':'Female' ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td >Age </td>
                                                        <td>:</td>
                                                        <td>
                                                            <?php echo $friend_basic_details->age.' Yrs '.$friend_basic_details->months.' Months'; ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td >Marital Status </td>
                                                        <td>:</td>
                                                        <td><?php echo get_marital_status($friend_basic_details->marital_status); ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td >Profile Created By </td>
                                                        <td>:</td>
                                                        <td><?php echo $user->profile_created; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th colspan="3">
                                                            <i class="icon icon-file-alt" ></i>
                                                            Contact Details

                                                        </th>
                                                    </tr>

                                                    <tr>
                                                        <td >Phone Number </td>
                                                        <td>:</td>

                                                        <?php if( $is_open_contact == 0 ) {?>

                                                            <td>
                                                                <a title="Open Contact Number" class="view_phone" href="javascript:;"
                                                                   data-id="<?php echo $this->user->id; ?>" data-friend="<?php echo $user->id; ?>" >
                                                                    <?php echo substr($user->phone,0,4).'XXXXXX | '; ?>
                                                                    <i class="glyphicon glyphicon-lock" ></i>
                                                                </a>
                                                            </td>

                                                        <?php } else {  ?>
                                                            <td>
                                                                <a href="tel:<?php echo $user->phone; ?>">
                                                                    <?php echo $user->phone; ?>
                                                                </a>

                                                            </td>
                                                        <?php } ?>

                                                    </tr>

                                                    <tr>
                                                        <td >Chat Status </td>
                                                        <td>:</td>
                                                        <td>Online</td>
                                                    </tr>

                                                    <tr>
                                                        <td >Send Mail </td>
                                                        <td>:</td>

                                                        <?php if( $is_open_contact == 0 ) {?>

                                                            <td>
                                                                <?php echo 'Locked | '; ?><i class="glyphicon glyphicon-lock" ></i>
                                                            </td>

                                                        <?php } else {  ?>
                                                            <td >
                                                                <a href="mailto:<?php echo $user->email; ?>" target="_top">
                                                                <?php echo $user->email; ?></a>
                                                            </td>
                                                        <?php } ?>

                                                    </tr>

                                                    <tr>
                                                        <th colspan="3">
                                                            <i class="icon icon-file-alt" ></i>
                                                            professional Information

                                                        </th>
                                                    </tr>

                                                    <tr>
                                                        <td >Education Category </td>
                                                        <td>:</td>
                                                        <td><?php echo $row_prof['edu_stream'].' ('.$row_prof['edu_category_name'].') '; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td >Occupation </td>
                                                        <td>:</td>
                                                        <td>
                                                            <?php echo get_employed_in($row_prof['employed_in']); ?>
                                                            <?php echo ($row_prof['employed_in'] != 6)? ' - '.$row_prof['occ_name'].' ('.$row_prof['occ_cat'].') ':''; ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td >Annual Income </td>
                                                        <td>:</td>
                                                        <td><?php echo ($row_prof['employed_in'] != 6)? $row_prof['annual_income']:'Not Provided'; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th colspan="3">
                                                            <i class="icon icon-file-alt" ></i>
                                                            Location

                                                        </th>
                                                    </tr>

                                                    <tr>
                                                        <td >Country </td>
                                                        <td>:</td>
                                                        <td><?php echo $user->country_name; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td >State </td>
                                                        <td>:</td>
                                                        <td><?php echo $user->state_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td >City </td>
                                                        <td>:</td>
                                                        <td><?php echo $user->city; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th colspan="3">
                                                            <i class="icon icon-file-alt" ></i>
                                                            Family Details

                                                        </th>
                                                    </tr>


                                                    <tr>
                                                        <td >Family Status </td>
                                                        <td>:</td>
                                                        <td><?php echo get_family_status($friend_basic_details->family_status); ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td >Number of Brother(s)  </td>
                                                        <td>:</td>
                                                        <td><?php echo $total_brother; ?></td>
                                                    </tr>

                                                    <?php if( $total_brother > 0 ){ ?>
                                                        <tr>
                                                            <td >Brother(s) Married </td>
                                                            <td>:</td>
                                                            <td><?php echo $row_family['no_brother_married']; ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                    <tr>
                                                        <td >Number of Sister(s)  </td>
                                                        <td>:</td>
                                                        <td><?php echo $total_sister; ?></td>
                                                    </tr>

                                                    <?php if( $total_sister > 0 ){ ?>
                                                        <tr>
                                                            <td >Sister(s) Married </td>
                                                            <td>:</td>
                                                            <td><?php echo $row_family['no_sister_married']; ?></td>
                                                        </tr>
                                                    <?php } ?>



                                                </table>

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


<div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-hidden="true">
    
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="album_modal_title">Comments</h4>
                </div>
                <div class="modal-body"> 
                    
                    <div class="row"></div>
                     
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
</div>



