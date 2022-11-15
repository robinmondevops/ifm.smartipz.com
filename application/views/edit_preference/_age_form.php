<style>
    .reg_pop .form-group{

        margin-left: 0px;
        margin-right: 0px;
    }
</style>



<div class="col-md-12 reg_pop" >

    <form role="form" id="form_age" class="form-horizontal" enctype="multipart/form-data" method="post" >

        <div class="col-md-12">

            <div class="alert alert-success err_model" style="display: none">
                <button class="close" data-close="alert"></button>
                <span class="err_msg"></span>
            </div>


            <div class="row">

                <div class="col-md-6 col-sm-6">
                    <div class="form-group <?php echo form_error('age_from')?'has-error':'';?>">
                        <label>Age From</label>
                        <select class="form-control required_field" name="age_from" id="age_from">
                            <?php for( $i=18; $i<60; $i++){ ?>
                                <option <?php echo($row_preference['age_from'] == $i)?'selected':''; ?>
                                    value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>

                        </select>
                        <span class="help-block err_required"></span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group <?php echo form_error('age_to')?'has-error':'';?>">
                        <label>Age To</label>
                        <select class="form-control required_field" name="age_to" id="age_to">
                            <?php for( $i=18; $i<60; $i++){ ?>
                                <option <?php echo($row_preference['age_to'] == $i)?'selected':''; ?>
                                    value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>

                        </select>
                        <span class="help-block err_required"></span>
                    </div>
                </div>

            </div>


            <div class="form-actions">

                <button id="save_age" class="btn btn-success btn-block uppercase pull-right">Save Changes</button>
            </div>

        </div>

    </form>

</div>



        