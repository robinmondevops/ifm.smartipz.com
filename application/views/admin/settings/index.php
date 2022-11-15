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
                    <span>Settings</span>
                </li>    
            </ul>
            <!-- END PAGE BREADCRUMBS -->
            
             <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">General Settings</span>
                    </div>
                </div>
                <div class="portlet-body form">
					<form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                                
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="site_name">Site Name <span class="text-danger">*</span></label>
                                        <div class="col-md-5">
                                            <input type="text" name="site_name" placeholder="Site Name" id="site_name" class="form-control" value="<?php echo $settings->site_name;?>"> 
                                            
                                        </div>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label class="col-md-3 control-label" for="email">Email <span class="text-danger">*</span></label>
                                        <div class="col-md-5">
                                            <input type="text" name="email" placeholder="Email" id="email" class="form-control" value="<?php echo $settings->email;?>"> 
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="logo">Logo <span class="text-danger">*</span></label>
                                        <div class="col-md-5">
                                        	<?php if( $settings->logo && file_exists( getcwd().'/files/media/'.$settings->logo ) ){?>
                                            	<diV><img src="<?php echo base_url( 'files/media/'.$settings->logo );?>" width="100" /><br /><br /></diV>
                                            <?php }?>
                                            <input type="file" name="logo" id="logo"> 
                                            <span class="help-inline">(400x110)</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="header_logo">Header Logo <span class="text-danger">*</span></label>
                                        <div class="col-md-5">
                                        	<?php if( $settings->logo && file_exists( getcwd().'/files/media/'.$settings->header_logo ) ){?>
                                            	<diV><img src="<?php echo base_url( 'files/media/'.$settings->header_logo );?>" width="100" /><br /><br /></diV>
                                            <?php }?>
                                            <input type="file" name="header_logo" id="header_logo"> 
                                            <span class="help-inline">(160x44)</span>
                                        </div>
                                    </div>
                                    
                                   <hr />



                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <h4 class="pull-left"><strong>SMS Settings</strong></h4>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="sms_user">SMS User Name</label>
                                        <div class="col-md-5">
                                            <input type="text" name="sms_user" placeholder="SMS User" id="sms_user" class="form-control" value="<?php echo $settings->sms_user;?>">

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="sms_password">SMS Password</label>
                                        <div class="col-md-5">
                                            <input type="text" name="sms_password" placeholder="SMS Password" id="sms_password" class="form-control" value="<?php echo $settings->sms_password;?>">

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="sms_sender_id">SMS Sender ID</label>
                                        <div class="col-md-5">
                                            <input type="text" name="sms_sender_id" placeholder="SMS Sender ID" id="sms_sender_id" class="form-control" value="<?php echo $settings->sms_sender_id;?>">

                                        </div>
                                    </div>

                                    <hr />
                                    
                                    <div class="form-group">
                                    	<div class="col-md-4">
                                        	<h4 class="pull-left"><strong>Email Settings</strong></h4>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="is_smtp">Use SMTP</label>
                                        <div class="col-md-5">
                                            <div class="checkbox-list">
                                            	<label class="checkbox-inline" style="margin-left:5%">
                                                	<input  type="checkbox" name="is_smtp" id="is_smtp" value="1" <?php echo $settings->is_smtp == 1?'checked':'';?> />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="connection_prefix">Connection Prefix</label>
                                        <div class="col-md-5">
                                            <input type="text" name="connection_prefix" placeholder="Connection Prefix" id="connection_prefix" class="form-control" value="<?php echo $settings->connection_prefix;?>"> 
                                            <span class="help-inline">Options are "", "ssl" or "tls"</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="smtp_host">SMTP Host</label>
                                        <div class="col-md-5">
                                            <input type="text" name="smtp_host" placeholder="SMTP Host" id="smtp_host" class="form-control" value="<?php echo $settings->smtp_host;?>"> 
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="smtp_port">SMTP Port</label>
                                        <div class="col-md-5">
                                            <input type="text" name="smtp_port" placeholder="SMTP Port" id="smtp_port" class="form-control" value="<?php echo $settings->smtp_port;?>"> 
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="smtp_username">SMTP Username</label>
                                        <div class="col-md-5">
                                            <input type="text" name="smtp_username" placeholder="SMTP Username" id="smtp_username" class="form-control" value="<?php echo $settings->smtp_username;?>"> 
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="smtp_password">SMTP Password</label>
                                        <div class="col-md-5">
                                            <input type="password" name="smtp_password" placeholder="SMTP Password" id="smtp_password" class="form-control" value="<?php echo $settings->smtp_password;?>"> 
                                            
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-8">
                                            <button class="btn red" type="submit">Save</button>
                                             <a href="javascript:;" data-url="<?php echo site_url('admin/settings/testemail');?>" class="btn red email-test">Test Email</a>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                </div>
           </div>                     
            
            <div class="clearfix"></div>


            
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>


<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Test email settings</h4>
            </div>
            <div class="modal-body"> 
                <div class="row"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
