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
                    <a href="<?php echo site_url('admin/settings');?>">Settings</a>
                    <i class="fa fa-circle"></i>
                </li>   
                <li>
                    <span>Email Templates</span>
                </li>     
              
            </ul>
            <!-- END PAGE BREADCRUMBS -->
            
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Edit Template</span>
                    </div>
                </div>
                <div class="portlet-body form">
                	<div class="form-body">
                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                
                                    <div class="form-group <?php echo form_error('subject')?'has-error':'';?>">
                                        <label class="col-md-2 control-label" for="subject">Subject<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="subject" placeholder="Subject" id="subject" class="form-control" value="<?php echo $row['subject'];?>"> 
                                            <?php echo form_error('subject');?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group <?php echo form_error('body')?'has-error':'';?>">
                                        <label class="col-md-2 control-label" for="body">Body<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-10">
                                           <textarea name="body" class="ckeditor"><?php echo $row['body'];?></textarea>
                                           <?php echo form_error('body');?>
                                           <?php 
                						   		$variables_str = $row['variables'];
                								$var_arr = explode(',', $variables_str);
                								if( count($var_arr) > 0 ){
                						   ?>
                                           <span class="hel-block"><a href="#basic" data-toggle="modal">Show Variables</a></span>
                                           <?php }?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-10">
                                            <button class="btn red" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>
					</div>
                </div>
           </div>

            
            <div class="clearfix"></div>


            
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>

<!-- END CONTENT -->
<?php if( count($var_arr) > 0 ){?>

<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Available Variables</h4>
            </div>
            <div class="modal-body"> 
            	<div class="row">
                	<div class="col-md-12">
                    	<form class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-5 col-md-offset-1">
                                        <input type="text" name="site_name" id="site_name" class="form-control" value="[*site_name*]" readonly="readonly"> 
                                    </div>
                                    <label class="col-md-5 control-label pull-left" for="site_name" style="text-align:left">Site Name</label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-5 col-md-offset-1">
                                        <input type="text" name="site_email" id="site_email" class="form-control" value="[*site_email*]" readonly="readonly"> 
                                    </div>
                                    <label class="col-md-5 control-label pull-left" for="site_email" style="text-align:left">Site Email</label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-5 col-md-offset-1">
                                        <input type="text" name="email" id="email" class="form-control" value="[*email*]" readonly="readonly"> 
                                    </div>
                                    <label class="col-md-5 control-label pull-left" for="email" style="text-align:left">User Email</label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-5 col-md-offset-1">
                                        <input type="text" name="first_name" id="first_name" class="form-control" value="[*first_name*]" readonly="readonly"> 
                                    </div>
                                    <label class="col-md-5 control-label pull-left" for="first_name" style="text-align:left">User Firstname</label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-5 col-md-offset-1">
                                        <input type="text" name="last_name" id="last_name" class="form-control" value="[*last_name*]" readonly="readonly"> 
                                    </div>
                                    <label class="col-md-5 control-label pull-left" for="last_name" style="text-align:left">User Lastname</label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-5 col-md-offset-1">
                                        <input type="text" name="login-url" id="login-url" class="form-control" value="[*login-url*]" readonly="readonly"> 
                                    </div>
                                    <label class="col-md-5 control-label pull-left" for="login-url" style="text-align:left">Login Url</label>
                                </div>
                                
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php }?>