<!-- BEGIN REGISTER -->
<div class="container">        

    <div class="wrapper col-md-12">
        <div class="col-md-7 hidden-xs">
            <div class="introduction">
                <h1><b>Welcome to Brooup</b></h1>
                <h3>Find Friends having same Interests</h3>
                <h4>Choose your catagories</h4>
                <ul class="catagory">
                    <li>Movies &amp; Music</li>
                    <li>Art &amp; Culture</li>
                    <li>Travel &amp; Tourism</li>
                </ul>
            </div>

            <div class="business_account">
                <h3>Create an Account for your Business</h3>
                <button type="submit" class="btn green uppercase">Register</button>
            </div>
        </div>
        <!-- BEGIN LOGIN -->
        <div class="content col-md-6">
            <form class="reset-form" action="" method="post">
                <h3 class="form-title"  style="color: #2b3643!important;">Reset Password</h3>
                <p>To reset your password, please enter your new password.</p>
                <div class="form-group <?php if (form_error('password')) {?>has-error<?php } ?>">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">New Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="password" value="<?php echo $row['password'];?>" /> 
                    <?php echo form_error('password');?>
                </div>
                <div class="form-group <?php if (form_error('password')) {?>has-error<?php } ?>">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" name="cpassword" value="<?php echo $row['cpassword'];?>" /> 
                    <?php echo form_error('cpassword');?>
                </div>
                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                <div class="form-actions">
                    <a href="<?php echo site_url('admin/login');?>" class="btn btn-default">Sign In</a>
                    <button type="submit" class="btn red uppercase pull-right">Submit</button>
                </div>
            </form>
            
        </div>

    </div>  
</div>


