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
                        <span class="caption-subject font-dark sbold uppercase">New State</span>
                    </div>
                </div>

                <div class="portlet-body">

                    <div class="col-md-12">

                        <form role="form" class="form-horizontal" method="post">


                            <div class="form-group <?php echo form_error('name')?'has-error':'';?>">
                                <label class="col-md-2 control-label" for="name">Name<span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-5">
                                    <input type="text" name="name" placeholder="Name" id="name" class="form-control" value="<?php echo $row['name'];?>">
                                    <?php echo form_error('name');?>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <button class="btn green-meadow" type="submit">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        <!-- END DASHBOARD STATS 1-->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

        