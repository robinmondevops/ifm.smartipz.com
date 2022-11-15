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
            <form class="forget-form" action="" method="post">
                <h3 class="font-red"  style="color: #2b3643!important;">Forget Password ?</h3>
                <?php if( $success ){?>   
                <div class="alert alert-success">
                   <button class="close" data-close="alert"></button>
                   <span><?php echo $success;?></span>
                </div>
                <?php }?>
                <?php if( $this->session->flashdata('error') ) {?> 
                 <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                   <span><?php echo $this->session->flashdata('error');?></span>
                </div>
                <?php }?>
                <?php if( $error ) {?> 
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                   <span><?php echo $error;?></span>
                </div>
                <?php }?>
                <p> To reset your password, please first identify your account. </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                <div class="form-actions">
                    <a href="<?php echo site_url('login');?>" class="btn btn-default">Sign In</a>
                    <button type="submit" class="btn red uppercase pull-right">Submit</button>
                </div>
            </form>
            
        </div>

    </div>  
</div>

        