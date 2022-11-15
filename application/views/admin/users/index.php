<div class="page-content-wrapper">
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE BREADCRUMBS -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="<?php echo site_url();?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Users</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMBS -->
            
            <div class="portlet light ">

                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark sbold uppercase">Users</span>
                    </div>
                </div>
                <div class="portlet-body">
                
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
                    
					 <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="users-tbl" data-url="<?php echo site_url('admin/users/get_all');?>">
                            <thead>
                                <tr>
                                    <th width="5%"></th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Role </th>
                                    <th> Status </th>
                                    <th class="text-center"> Created </th>
                                    <th class="text-center"> Actions </th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td class="filter-cw-td"></td>
                                    <td class="filter-cw-td"><input type="text" name="name" placeholder="Name" id="name" class="form-control form-filter input-sm" value=""></td>
                                    <td class="filter-cw-td"><input type="text" name="email" class="form-control form-filter input-sm"></td>
                                    <td class="filter-cw-td">
                                        <select class="form-control form-filter input-sm" name="group_id">
                                            <option value="">Select</option>
                                            <option value="1">Administrator</option>
                                            <option value="2">Host</option>
                                        </select>
                                    </td>
                                    <td class="filter-cw-td">
                                        <select class="form-control form-filter input-sm" name="is_active">
                                            <option value="">Status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                            <option value="3">Deleted</option>
                                        </select>
                                    </td>
                                    <td class="filter-cw-td"><input type="text" name="created_at" class="form-control form-filter input-sm date-picker_created"></td>
                                      
                                    <td class="filter-cw-td">
                                        
                                        <button class="btn btn-xs green btn-outline filter-submit margin-bottom">
                                            <i class="fa fa-search"></i> 
                                        </button>
                                        
                                        <button class="btn btn-xs red btn-outline filter-cancel">
                                            <i class="fa fa-times"></i> 
                                        </button>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                           
                        </table>
                            	
                	</div>
                </div>
           </div>

            
            <div class="clearfix"></div>


            
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>       