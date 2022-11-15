<!-- BEGIN LOGIN -->
<div class="content" style="margin-top:0">
    <!-- BEGIN LOGIN FORM -->
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
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="username" value="<?php if (get_cookie('booup_admin_username')){ echo get_cookie('booup_admin_username');}?>" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
        <div class="form-actions">
            <button type="submit" class="btn red uppercase">Login</button>
            <label class="rememberme check">  
                <input type="checkbox" name="remember" value="1" <?php if (get_cookie('booup_admin_username')) { ?>checked="checked"<?php } ?> />Remember </label>
            <a href="<?php echo site_url('admin/forgot_password');?>"  class="forget-password">Forgot Password?</a>
        </div>
        <?php /*?><div class="create-account">
            <p>
                <a href="<?php echo site_url('register');?>"  class="uppercase">Create an account</a>
            </p>
        </div><?php */?>
    </form>
    <!-- END LOGIN FORM -->
</div>

        