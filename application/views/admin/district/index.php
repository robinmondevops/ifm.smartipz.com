<!-- BEGIN CONTENT -->
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

                <!-- BEGIN PAGE TITLE-->
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark sbold uppercase">District</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <a class="btn btn-default pull-right" href="<?php echo site_url('admin/district/create');?>">Add New</a>
                </div>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <!-- BEGIN DASHBOARD STATS 1-->
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


                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th> District </th>
                                    <th> State </th>

                                    <th class="text-center"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if( count($result) > 0 ){

                                    foreach ($result as $key => $row) {

                                ?>

                                    <tr>
                                        <td> <?php echo $row->name;?> </td>
                                        <td> <?php echo $row->state_name;?> </td>


                                        <td class="text-center">
                                            <a class="btn btn-outline btn-circle btn-sm blue" href="<?php echo site_url('admin/district/edit/'.encrypt($row->id));?>">
                                            <i class="fa fa-edit"></i> Edit </a>

                                            <a class="btn btn-outline btn-circle btn-sm red" href="<?php echo site_url('admin/district/delete/'.encrypt($row->id));?>" onclick="if(!confirm('Are you sure you want to delete this forever?')) return false;" >
                                            <i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>
                                <?php }  } else { ?>
                                    <tr>
                                        <td colspan="6">No district found!</td>
                                    </tr>
                                <?php } ?>

                            </tbody>

                        </table>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->       