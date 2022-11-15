<style>
    .login_section{
        margin-top: 100px !important;
    }

</style>

<!-- BEGIN LOGIN -->
<div class="container">        

    <div class="wrapper col-md-12">
    
        <?php if($this->session->flashdata('msg')){?>      
            <div class="alert alert-success" style="margin-top: 10px">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('msg');?></span>
            </div>
        <?php }?>

        <div class="col-md-7">
            <div class="row">
                <div class="introduction">

                    <?php if(!is_mobile()){ ?>


                        <h1><b>Welcome to Catholic Milap Matrimonials</b></h1>


                        <h3>Exclusively for <b> Catholics</b></h3>

                        <ul class="catagory" >

                            <li> No.1 matrimony service for Catholics</li>
                            <li>Most trusted matrimony</li>

                            <li>100% verified mobile numbers</li>

                        </ul>

                    <?php } ?>

                </div>
            </div>

            <div class="business_account">
                <div class="row">

                    <?php if(!is_mobile()){ ?>

                        <h3>Create an Account for Finding Your Best  Partner</h3>

                    <?php } else {  ?>

                        <h3>Matrimony Exclusively for <b>Catholics</b> </h3>

                    <?php } ?>

                    <a href="<?php echo site_url('register');?>" type="submit" class="btn green uppercase">Register Now</a>
                </div>
            </div>
        </div>
        <!-- BEGIN LOGIN -->
        <div class="content col-md-6 login_section">
            <form class="login-form" action="" method="post">
                <h3 class="form-title" style="color: #2b3643!important;">Sign In</h3>
                <?php if($this->session->flashdata('success')){?>   
                    <div class="alert alert-success">
                       <button class="close" data-close="alert"></button>
                       <span><?php echo $this->session->flashdata('success');?></span>
                    </div>
                <?php }?>

                <?php if($error != '') {?> 
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                       <span><?php echo $error;?> </span>
                    </div>
                <?php }?>

                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any email and password. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email, Phone ,  ID</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off"
                           placeholder="Email, Phone ,  ID" name="username" value="<?php if (get_cookie('booup_username')){ echo get_cookie('booup_username');}?>" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions">
                    

                    <label class="rememberme check">  
                        <input type="checkbox" name="remember" value="1" <?php if (get_cookie('booup_username')) { ?>checked="checked"<?php } ?> />Remember </label>
                    <a href="<?php echo site_url('forgot_password');?>"  class="forget-password">Forgot Password?</a>
                </div>
                <button type="submit" class="btn green  btn-block  uppercase">Login</button>

<!--                <a href="javascript:;"   class="btn red btn-block  uppercase btn_otp_login">Login Using OTP</a>-->

                
                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                <div class="create-account">

                    <p>
                        <a href="<?php echo site_url('register');?>"  class="uppercase">Create an account</a>
                    </p>



                </div>
            </form>
            
        </div>

    </div>  
</div>


<div class="modal fade" id="reg_mob_model" tabindex="-1" role="basic" aria-hidden="true">

    <div class="modal-dialog modal-sm">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <form method="post" name="confirm_otp">

                        <div class="col-md-12">

                            <div class="form-group otp_row">
                                <h4 style="text-align: center !important;" class="control-label">Enter Your Mobile Number</h4>
                                <p style="text-align: center">You'll receive an OTP to the mobile number registered with your account</p>
                                <input placeholder="Mobile Number"   type="text" class="form-control"
                                       name="phone" id="phone" autocomplete="off">
                                <span class="help-block otp_error"></span>
                            </div>

                        </div>

                        <div class="col-md-12">

                            <button id="submit_phone" type="button" class="btn btn-danger btn-block col-md-12" >Submit</button>

                        </div>

                    </form>

                </div>



            </div>

        </div>

    </div>
</div>





<div class="modal fade" id="view_model" tabindex="-1" role="basic" aria-hidden="true" >

    <div class="modal-dialog modal-sm">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <form method="post" name="confirm_otp">

                        <div class="col-md-12">
                            <div class="form-group otp_row">
                                <h4 style="text-align: center" class="control-label">Enter OTP</h4>
                                <p style="text-align: center">We have send the otp to your registered mobile number</p>
                                <input placeholder="Enter OTP"   type="text" class="form-control"
                                       name="confirm_otp" id="confirm_otp" autocomplete="off">
                                <span class="help-block otp_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">

                            <button id="confirm_ypur_otp" type="button" class="btn btn-danger btn-block col-md-12" >Submit</button>

                        </div>

                    </form>

                </div>



            </div>

        </div>

    </div>
</div>

        