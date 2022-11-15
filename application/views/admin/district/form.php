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
                        <span class="caption-subject font-dark sbold uppercase">New District</span>
                    </div>
                </div>
        
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <!-- BEGIN DASHBOARD STATS 1-->
                <div class="row">

                    <div class="col-md-12">

                        <form role="form" class="form-horizontal" method="post">

                            <div class="form-group <?php echo form_error('state_id')?'has-error':'';?>">
                                <label class="col-md-2 control-label" for="state_id">State Name<span class="required" aria-required="true"> * </span></label>
                                <div class="col-md-5">
                                    <select class="form-control" name="state_id">
                                        <option value="">Select</option>
                                        <?php foreach ($arr_state as $key => $state) { ?>
                                            <option <?php echo($state->id==$row['state_id'])?'selected':''; ?> value="<?php echo $state->id;?>"><?php echo $state->name;?></option>
                                        <?php } ?>

                                    </select>
                                    <?php echo form_error('state_id');?>
                                </div>
                            </div>


                            <div class="form-group <?php echo form_error('name')?'has-error':'';?>">
                                <label class="col-md-2 control-label" for="name">District Name<span class="required" aria-required="true"> * </span></label>
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
        <!-- END DASHBOARD STATS 1-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

        