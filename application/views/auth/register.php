<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<!-- BEGIN REGISTER -->
<div class="container">        

    <div class="wrapper col-md-12">
        <?php if($this->session->flashdata('msg')){?>      
            <div class="alert alert-success" style="margin-top: 10px">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('msg');?></span>
            </div>
        <?php }?>
        <div class="col-md-7 hidden-xs">

            <div class="introduction">
                <h1><b>Welcome to Catholic Milap Matrimonials</b></h1>
                <h3>Exclusively for Catholics</h3>

                <ul class="catagory" >

                    <li> No.1 matrimony service for Catholics</li>
                    <li>Most trusted matrimony</li>

                    <li>100% verified mobile numbers</li>

                </ul>

            </div>

            <div class="business_account">
                <div class="row">
                    <h3>Create an Account for Finding Your Best  Partner</h3>
<!--                    <a href="--><?php //echo site_url('register');?><!--" type="submit" class="btn green uppercase">Register Now</a>-->
                </div>
            </div>

        </div>
        <!-- BEGIN LOGIN -->
        <div class="content1 col-md-6">
            <form  method="post">
                <h3 class="font-green"  style="color: #2b3643!important;">Sign Up</h3>

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group <?php echo form_error('profile_type')?'has-error':'';?>">
                            <select name="profile_type" class="form-control" id="profile_type">
                                <option value="">Profile For</option>
                                <?php foreach ( $arr_profile_type as $profile_type){ ?>
                                    <option <?php echo ( $row['profile_type'] == $profile_type->id)?'selected':''; ?>
                                        value="<?php echo $profile_type->id; ?>">
                                        <?php echo $profile_type->name; ?></option>
                                <?php } ?>

                            </select>
                            <?php echo form_error('profile_type');?>
                        </div>
                    </div>

                </div>


                <div class="row" id="row_gender" style="display: none">

                    <div class="col-md-12">
                        <div class="form-group <?php echo form_error('gender')?'has-error':'';?>">
                            <select name="gender" class="form-control">
                                <option value="">Gender</option>
                                <option <?php echo ( $row['gender'] == 'AF')?'selected':''; ?> value="AF">Female</option>
                                <option <?php echo ( $row['gender'] == 'AL')?'selected':''; ?> value="AL">Male</option>
                            </select>
                            <?php echo form_error('gender');?>
                        </div>
                    </div>

                </div>


                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group <?php echo form_error('first_name')?'has-error':'';?>">
                            <input class="form-control" name="first_name" placeholder="Name" type="text" value="<?php echo $row['first_name'];?>">
                            <?php echo form_error('first_name');?>
                        </div>
                    </div>
                    
                </div>



                <div class="row">
                    <div class="col-md-4 col-xs-4">
                        <div class="form-group <?php echo form_error('country_code')?'has-error':'';?>">
                            <select  name="country_code" class="form-control"
                                     id="country_code">
                                <?php foreach ( $arr_country as $country){ ?>
                                    <option <?php echo ( $row['country_code'] == $country->id)?'selected':''; ?>
                                        value="<?php echo $country->id; ?>">
                                        <?php echo $country->tel_code.'('.$country->country_code.')'; ?></option>
                                <?php } ?>

                            </select>
                            <?php echo form_error('country_code');?>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-8">
                        <div class="form-group <?php echo form_error('phone')?'has-error':'';?>">
                            <input class="form-control" name="phone" placeholder="Phone"
                                   type="number" value="<?php echo $row['phone'];?>">
                            <?php echo form_error('phone');?>
                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group <?php echo form_error('email')?'has-error':'';?>">
                            <input class="form-control" name="email" placeholder="Email" type="text" value="<?php echo $row['email'];?>">
                            <?php echo form_error('email');?>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group <?php echo form_error('country_id')?'has-error':'';?>">
                            <select  name="country_id" class="form-control"
                                    id="country_id">
                                <option value="">country</option>
                                <?php foreach ( $arr_country as $country){ ?>
                                    <option <?php echo ( $row['country_id'] == $country->id)?'selected':''; ?>
                                        value="<?php echo $country->id; ?>">
                                        <?php echo $country->country; ?></option>
                                <?php } ?>

                            </select>
                            <?php echo form_error('country_id');?>
                        </div>
                    </div>

                </div>

                <div class="location_show" style="display: <?php echo ( $row['country_id'] != 78 )?'none':''; ?>">

                    <div class="row ">

                        <div class="col-md-12">
                            <div class="form-group <?php echo form_error('state')?'has-error':'';?>">
                                <select data-url="<?php echo site_url('auth/change_district'); ?>" name="state" class="form-control" id="state">
                                    <option value="">State</option>
                                    <?php foreach ( $arr_state as $state){ ?>
                                        <option <?php echo ( $row['state'] == $state->id)?'selected':''; ?>
                                            value="<?php echo $state->id; ?>">
                                            <?php echo $state->name; ?></option>
                                    <?php } ?>

                                </select>
                                <?php echo form_error('state');?>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group <?php echo form_error('district')?'has-error':'';?>">
                                <select name="district" class="form-control" id="district">
                                    <option value="">District</option>

                                    <?php foreach ( $arr_district as $district){ ?>
                                        <option <?php echo ( $row['district'] == $district->id)?'selected':''; ?>
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
                    <div class="col-md-12">
                        <div class="form-group <?php echo form_error('city')?'has-error':'';?>">
                            <input class="form-control" name="city" placeholder="City" type="text" value="<?php echo $row['city'];?>">
                            <?php echo form_error('city');?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group <?php echo form_error('password')?'has-error':'';?>">
                            <input class="form-control" name="password" placeholder="Password" type="password" value="<?php echo $row['password'];?>">
                            <?php echo form_error('password');?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group <?php echo form_error('rpassword')?'has-error':'';?>">
                            <input class="form-control" name="rpassword" placeholder="Re-type Your Password" type="password"
                                   value="<?php echo $row['rpassword'];?>">
                            <?php echo form_error('rpassword');?>
                        </div>
                    </div>
                </div>    


                <div class="form-group margin-top-20 margin-bottom-20  <?php echo form_error('tnc')?'has-error':'';?>">
                    <label class="check">
                        <input type="checkbox" name="tnc" value="1" <?php echo $row['tnc'] == 1? 'checked' : '';?> /> I agree to the
                        <a href="javascript:;"> Terms of Service </a> &amp;
                        <a href="javascript:;"> Privacy Policy </a>
                    </label>
                    <?php echo form_error('tnc');?>
                </div>
                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                <div class="form-actions">
                    <a href="<?php echo site_url('login');?>" class="btn btn-default">Sign In</a>
                    <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                </div>
            </form>
            
        </div>

    </div>  
</div>


        