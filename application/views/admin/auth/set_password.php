<!-- BEGIN LOGIN -->
<div class="content" style="margin-top:0;">
   <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="reset-form" action="" method="post">
        <h3 class="form-title"  style="color: #2b3643!important;">Set Password</h3>
        <div class="form-group <?php if (form_error('password')) {?>has-error<?php } ?>">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="password" value="<?php echo $row['password'];?>" /> 
            <?php echo form_error('password');?>
            </div>
        <div class="form-group <?php if (form_error('password')) {?>has-error<?php } ?>">
            <label class="control-label visible-ie8 visible-ie9">Retype Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" name="cpassword" value="<?php echo $row['cpassword'];?>" /> 
            <?php echo form_error('cpassword');?>
        </div>

        <div class="form-actions">
            <a href="<?php echo site_url('admin/login');?>" class="btn btn-default">Sign In</a>
            <button type="submit" class="btn red uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
</div>

        