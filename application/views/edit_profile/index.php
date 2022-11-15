
<style>
    .reg_edit .form-group{

        margin-left: 0px;
        margin-right: 0px;
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
                    <span>Edit Profile</span>
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
                                                        <div class="col-md-12">

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
                                                                        <span class="caption-subject font-blue-madison bold uppercase">Edit Profile </span>
                                                                    </div>
                                                                    <ul class="nav nav-tabs">
                                                                        <li id="personal_info" <?php echo $tab ==  'basic'? 'class="active"': '';?> >
                                                                            <a href="#tab_1_1" data-toggle="tab">Basic Info</a>
                                                                        </li>
                                                                        <li id="profile_pic" <?php echo $tab ==  'prof'? 'class="active"': '';?> >
                                                                            <a href="#tab_1_2" data-toggle="tab">Professional Info</a>
                                                                        </li>
                                                                        <li id="user_password"  <?php echo $tab ==  'family'? 'class="active"': '';?>>
                                                                            <a href="#tab_1_3" data-toggle="tab">Family Info</a>
                                                                        </li>
                                                                        <li id="contact_info"  <?php echo $tab ==  'contact'? 'class="active"': '';?>>
                                                                            <a href="#tab_1_4" data-toggle="tab">Contact & Location Info</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="portlet-body">
                                                                    <div class="tab-content reg_edit">
                                                                        <!-- PERSONAL INFO TAB -->

                                                                        <div class="tab-pane <?php echo $tab ==  'basic'? 'active': '';?>" id="tab_1_1">

                                                                            <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">


                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('weight')?'has-error':'';?>">
                                                                                            <label>Weight<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control required_field" name="weight">
                                                                                                <option value="">Select</option>
                                                                                                <?php for( $i=40; $i<140; $i++){ ?>
                                                                                                    <option <?php echo($row_basic['weight'] == $i)?'selected':'';?>  value="<?php echo $i; ?>">
                                                                                                        <?php echo $i.' Kgs'; ?></option>
                                                                                                <?php } ?>

                                                                                            </select>
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('height')?'has-error':'';?>">
                                                                                            <label>Height<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control required_field" name="height" id="">
                                                                                                <?php echo  personHeightOptions( $row_basic['height']); ?>
                                                                                            </select>
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('parish_name')?'has-error':'';?>">
                                                                                            <label>Parish Name<span class="required" aria-required="true">*</span></label>
                                                                                            <input class="form-control required_field" name="parish_name" placeholder="Parish Name"
                                                                                                   type="text" value="<?php echo $row_basic['parish_name']; ?>">
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('parish_place')?'has-error':'';?>">
                                                                                            <label>Parish Place<span class="required" aria-required="true">*</span></label>
                                                                                            <input class="form-control required_field" name="parish_place" placeholder="Parish Place"
                                                                                                   type="text" value="<?php echo $row_basic['parish_place']; ?>">
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group <?php echo form_error('marital_status')?'has-error':'';?>">
                                                                                            <label>Marital Status<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control" name="marital_status" id="">
                                                                                                <?php foreach($arr_marital_status as $key => $merital_status) { ?>
                                                                                                    <option <?php echo ($row_basic['marital_status'] == $key)?'selected':''; ?>
                                                                                                        value="<?php echo $key; ?>"><?php echo $merital_status; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                            <?php echo form_error('marital_status');?>
                                                                                        </div>


                                                                                    </div>

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group <?php echo form_error('dob')?'has-error':'';?>">
                                                                                            <label>Date Of Birth<span class="required" aria-required="true">*</span></label>
                                                                                            <input  class="form-control required_field" id="dob" name="dob" placeholder="Date Of Birth" type="text"
                                                                                                    value="<?php echo date('d-m-Y',strtotime($row_basic['dob'])); ?>">
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>


                                                                                    </div>

                                                                                </div>


                                                                                <div class="row">
                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group <?php echo form_error('family_status')?'has-error':'';?>">
                                                                                            <label>Family Status<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control required_field" name="family_status" id="">
                                                                                                <?php foreach($arr_family_status as $key => $family_status) { ?>
                                                                                                    <option <?php echo ($row_basic['family_status'] == $key)?'selected':''; ?>
                                                                                                        value="<?php echo $key; ?>"><?php echo $family_status; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                            <?php echo form_error('family_status');?>
                                                                                        </div>


                                                                                    </div>

                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group <?php echo form_error('about')?'has-error':'';?>">
                                                                                            <label>Description</label>
                                                                                            <textarea rows="3" style="width: 100%" name="about" class="form-control"><?php echo $row_basic['about']; ?></textarea>
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>



                                                                                <div class="margiv-top-10">
                                                                                    <button class="btn red btn-block" name="basic" type="submit">Save Changes</button>

                                                                                </div>
                                                                            </form>
                                                                        </div>

                                                                        <!-- END PERSONAL INFO TAB -->
                                                                        <!-- CHANGE AVATAR TAB -->

                                                                        <div class="tab-pane <?php echo $tab ==  'prof'? 'active': '';?>" id="tab_1_2">

                                                                            <form role="form" class="" method="post" enctype="multipart/form-data">


                                                                                <div class="row">
                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group <?php echo form_error('edu_item')?'has-error':'';?>">

                                                                                            <label>Education<span class="required" aria-required="true">*</span></label>

                                                                                            <select class="form-control required_field" name="edu_item" id="">

                                                                                                <option value="">Select</option>

                                                                                                <?php foreach($arr_edu as $key => $arr_item) { ?>

                                                                                                    <optgroup label="<?php echo $key; ?>">
                                                                                                        <?php foreach($arr_item as $key => $item) { ?>
                                                                                                            <option <?php echo ($row_prof['edu_item'] == $item->id )?'selected':''; ?>
                                                                                                                value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                                                                                                        <?php } ?>
                                                                                                    </optgroup>


                                                                                                <?php } ?>
                                                                                                <option <?php echo ($row_prof['edu_item'] == 0 )?'selected':''; ?> value="0">Other</option>
                                                                                            </select>
                                                                                            <span class="help-block err_required"></span>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('employed_in')?'has-error':'';?>">
                                                                                            <label>Employed In<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control required_field" name="employed_in" id="employed_in">
                                                                                                <option value="">Select</option>
                                                                                                <?php foreach($arr_employed_in as $key => $employed_in) { ?>
                                                                                                    <option <?php echo ($row_prof['employed_in'] == $key )?'selected':''; ?>
                                                                                                        value="<?php echo $key; ?>"><?php echo $employed_in; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row emp_details" style="display: <?php echo ($row_prof['employed_in'] == 6)?'none':''; ?>">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('occ_item')?'has-error':'';?>">
                                                                                            <label>Profession<span class="required" aria-required="true">*</span></label>

                                                                                            <select class="form-control required_field_emp" name="occ_item" id="">

                                                                                                <option value="">Select</option>

                                                                                                <?php foreach($arr_occ as $key => $arr_item) { ?>

                                                                                                    <optgroup label="<?php echo $key; ?>">
                                                                                                        <?php foreach($arr_item as $key => $item) { ?>
                                                                                                            <option <?php echo ($row_prof['occ_item'] == $item->id )?'selected':''; ?>
                                                                                                                value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                                                                                                        <?php } ?>
                                                                                                    </optgroup>


                                                                                                <?php } ?>

                                                                                                <option <?php echo ($row_prof['occ_item'] == 0 )?'selected':''; ?> value="0">Other</option>

                                                                                            </select>
                                                                                            <span class="help-block err_required_emp"></span>

                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('annual_income')?'has-error':'';?>">
                                                                                            <label>Annual Income<span class="required" aria-required="true">*</span></label>

                                                                                            <select class="form-control required_field_emp" name="annual_income">
                                                                                                <option value="">Select</option>
                                                                                                <?php for( $i=0; $i<=90; $i = $i+$inc ){
                                                                                                    if($i < 10 ){
                                                                                                        $inc = 1;
                                                                                                    }else{
                                                                                                        $inc = 10;
                                                                                                    }

                                                                                                    $to = $i+$inc;
                                                                                                    $to = $to.' Lacks';
                                                                                                    if($i == 90 ){
                                                                                                        $to = '1 Crore';
                                                                                                    }
                                                                                                    ?>
                                                                                                    <option <?php echo ($row_prof['annual_income'] == $i.' - '.$to )?'selected':''; ?>
                                                                                                        value="<?php echo $i.' - '.$to; ?>"><?php echo 'RS '. $i.' - '.$to; ?></option>
                                                                                                <?php } ?>

                                                                                            </select>

                                                                                            <span class="help-block err_required_emp"></span>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                                <div class="row emp_details" style="display: <?php echo ($row_prof['employed_in'] == 6)?'none':''; ?>">

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('working_country')?'has-error':'';?>">
                                                                                            <label>Working Country<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control required_field_emp" name="working_country" id="working_country">
                                                                                                <option value="">Select</option>
                                                                                                <?php foreach($arr_country as $key => $country) { ?>
                                                                                                    <option <?php echo ($row_prof['working_country'] == $country->id )?'selected':''; ?>
                                                                                                        value="<?php echo $country->id; ?>"><?php echo $country->country; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                            <span class="help-block err_required_emp"></span>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group <?php echo form_error('working_city')?'has-error':'';?>">
                                                                                            <label>Working City<span class="required" aria-required="true">*</span></label>
                                                                                            <input  class="form-control required_field_emp" id="working_city" name="working_city"
                                                                                                    placeholder="Working City" type="text" value="<?php echo $row_prof['working_city'];?>">
                                                                                            <span class="help-block err_required_emp"></span>
                                                                                        </div>


                                                                                    </div>

                                                                                </div>



                                                                                <div class="margiv-top-10">
                                                                                    <button class="btn red btn-block" name="prof" type="submit">Save Changes</button>

                                                                                </div>
                                                                            </form>
                                                                        </div>

                                                                        <!-- END CHANGE AVATAR TAB -->
                                                                        <!-- CHANGE PASSWORD TAB -->

                                                                        <div class="tab-pane <?php echo $tab ==  'family'? 'active': '';?>" id="tab_1_3">
                                                                            <form role="form" class="" method="post" enctype="multipart/form-data">

                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('no_brother_unmarried')?'has-error':'';?>">
                                                                                            <label>Number of Brothers Unmarried<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control required_field" name="no_brother_unmarried">
                                                                                                <?php for( $i=0; $i<10; $i++){ ?>
                                                                                                    <option <?php echo($row_family['no_brother_unmarried'] == $i)?'selected':''; ?>
                                                                                                        value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                                <?php } ?>

                                                                                            </select>
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('no_brother_married')?'has-error':'';?>">
                                                                                            <label>Number of Brothers Married<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control required_field" name="no_brother_married">
                                                                                                <?php for( $i=0; $i<10; $i++){ ?>
                                                                                                    <option <?php echo($row_family['no_brother_married'] == $i)?'selected':''; ?>
                                                                                                        value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                                <?php } ?>

                                                                                            </select>
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('no_sister_unmarried')?'has-error':'';?>">
                                                                                            <label>Number of Sisters Unmarried<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control required_field" name="no_sister_unmarried">
                                                                                                <?php for( $i=0; $i<10; $i++){ ?>
                                                                                                    <option <?php echo($row_family['no_sister_unmarried'] == $i)?'selected':''; ?>
                                                                                                        value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                                <?php } ?>

                                                                                            </select>
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('no_sister_married')?'has-error':'';?>">
                                                                                            <label>Number of Sisters Married<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control required_field" name="no_sister_married">
                                                                                                <?php for( $i=0; $i<10; $i++){ ?>
                                                                                                    <option <?php echo($row_family['no_sister_married'] == $i)?'selected':''; ?>
                                                                                                        value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                                <?php } ?>

                                                                                            </select>
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group <?php echo form_error('description')?'has-error':'';?>">
                                                                                            <label>About My Family</label>
                                                                                            <textarea rows="3" style="width: 100%" name="description" class="form-control"><?php echo $row_family['description']; ?></textarea>
                                                                                            <span class="help-block err_required"></span>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>


                                                                                <div class="margin-top-10">
                                                                                    <button class="btn red btn-block" name="family" type="submit">Save Changes</button>

                                                                                </div>
                                                                            </form>
                                                                        </div>

                                                                        <div class="tab-pane <?php echo $tab ==  'contact'? 'active': '';?>" id="tab_1_4">

                                                                            <form role="form" class="" method="post" enctype="multipart/form-data">

                                                                                <div class="row">
                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group <?php echo form_error('phone')?'has-error':'';?>">

                                                                                            <label>Phone<span class="required" aria-required="true">*</span></label>

                                                                                            <input  class="form-control required_field_emp" id="phone" name="phone"
                                                                                                    placeholder="Working City" type="text" value="<?php echo $row_users['phone'];?>">
                                                                                            <?php echo form_error('phone');?>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('email')?'has-error':'';?>">

                                                                                            <label>Email<span class="required" aria-required="true">*</span></label>

                                                                                            <input  class="form-control required_field_emp" id="email" name="email"
                                                                                                    placeholder="Working City" type="text" value="<?php echo $row_users['email'];?>">
                                                                                            <?php echo form_error('email');?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('first_name')?'has-error':'';?>">
                                                                                            <label>Name</label>
                                                                                            <input class="form-control" name="first_name" placeholder="Name" type="text"
                                                                                                   value="<?php echo $row_users['first_name'];?>">
                                                                                            <?php echo form_error('first_name');?>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('country_id')?'has-error':'';?>">
                                                                                            <label>Country<span class="required" aria-required="true">*</span></label>
                                                                                            <select class="form-control required_field_emp" name="country_id" id="country_id">
                                                                                                <option value="">Select</option>
                                                                                                <?php foreach($arr_country as $key => $country) { ?>
                                                                                                    <option <?php echo ($row_users['country_id'] == $country->id )?'selected':''; ?>
                                                                                                        value="<?php echo $country->id; ?>"><?php echo $country->country; ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                            <?php echo form_error('country_id');?>
                                                                                        </div>
                                                                                    </div>



                                                                                </div>

                                                                                <div class="location_show" style="display: <?php echo ($row_users['country_id'] != 78 )?'none':'';?>">

                                                                                    <div class="row">

                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group <?php echo form_error('state')?'has-error':'';?>">
                                                                                            <label>State<span class="required" aria-required="true">*</span></label>
                                                                                            <select data-url="<?php echo site_url('auth/change_district'); ?>" name="state" class="form-control" id="state">
                                                                                                <option value="">State</option>
                                                                                                <?php foreach ( $arr_state as $state){ ?>
                                                                                                    <option <?php echo ( $row_users['state'] == $state->id)?'selected':''; ?>
                                                                                                        value="<?php echo $state->id; ?>">
                                                                                                        <?php echo $state->name; ?></option>
                                                                                                <?php } ?>

                                                                                            </select>
                                                                                            <?php echo form_error('state');?>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div class="col-md-6">

                                                                                        <div class="form-group <?php echo form_error('district')?'has-error':'';?>">
                                                                                            <label>District<span class="required" aria-required="true">*</span></label>
                                                                                            <select name="district" class="form-control" id="district">
                                                                                                <option value="">District</option>
                                                                                                <?php foreach ( $arr_district as $district){ ?>
                                                                                                    <option <?php echo ( $row_users['district'] == $district->id)?'selected':''; ?>
                                                                                                        value="<?php echo $district->id; ?>">
                                                                                                        <?php echo $district->name; ?></option>
                                                                                                <?php } ?>


                                                                                            </select>
                                                                                            <?php echo form_error('district');?>
                                                                                        </div>
                                                                                    </div>


                                                                                </div>

                                                                                </div>

                                                                                <div class="row">


                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group <?php echo form_error('city')?'has-error':'';?>">
                                                                                            <label>City</label>
                                                                                            <input class="form-control" name="city" placeholder="City" type="text"
                                                                                                   value="<?php echo $row_users['city'];?>">
                                                                                            <?php echo form_error('city');?>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>


                                                                                <div class="margin-top-10">
                                                                                    <button class="btn red btn-block" name="contact" type="submit">Save Changes</button>

                                                                                </div>
                                                                            </form>
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



