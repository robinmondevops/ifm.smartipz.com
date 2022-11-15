<style>
    .reg_pop .form-group{

        margin-left: 0px;
        margin-right: 0px;
    }
</style>



<div class="col-md-12 reg_pop" >

    <form role="form" id="form_1" class="form-horizontal" enctype="multipart/form-data" method="post" >

        <div class="col-md-12">

            <p class="hint"> Enter your basic details below: </p>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('weight')?'has-error':'';?>">
                        <label>Weight<span class="required" aria-required="true">*</span></label>
                        <select class="form-control required_field" name="weight">
                            <option value="">Select</option>
                            <?php for( $i=40; $i<140; $i++){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i.' Kgs'; ?></option>
                            <?php } ?>

                        </select>
                        <span class="help-block err_required"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('height')?'has-error':'';?>">
                        <label>Height<span class="required" aria-required="true">*</span></label>
                        <select class="form-control required_field" name="height" id="">
                            <?php echo  personHeightOptions(); ?>
                        </select>
                        <span class="help-block err_required"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('parish_name')?'has-error':'';?>">
                        <label>Parish Name<span class="required" aria-required="true">*</span></label>
                        <input class="form-control required_field" name="parish_name" placeholder="Parish Name" type="text" value="">
                        <span class="help-block err_required"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('parish_place')?'has-error':'';?>">
                        <label>Parish Place<span class="required" aria-required="true">*</span></label>
                        <input class="form-control required_field" name="parish_place" placeholder="Parish Place" type="text" value="">
                        <span class="help-block err_required"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group <?php echo form_error('marital_status')?'has-error':'';?>">
                        <label>Marital Status<span class="required" aria-required="true">*</span></label>
                        <select class="form-control" name="marital_status" id="">
                            <?php foreach($arr_marital_status as $key => $merital_status) { ?>
                                <option value="<?php echo $key; ?>"><?php echo $merital_status; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('marital_status');?>
                    </div>


                </div>

                <div class="col-md-6">

                    <div class="form-group <?php echo form_error('dob')?'has-error':'';?>">
                        <label>Date Of Birth<span class="required" aria-required="true">*</span></label>
                        <input  class="form-control required_field" id="dob_test" name="dob" placeholder="Date Of Birth"
                                type="date" value="">
                        <span class="help-block err_required"></span>
                    </div>


                </div>

            </div>


            <div class="row">
                <div class="col-md-6">

                    <div class="form-group <?php echo form_error('family_status')?'has-error':'';?>">
                        <label>Family Status<span class="required" aria-required="true">*</span></label>
                        <select class="form-control required_field" name="family_status" id="">
                            <?php foreach($arr_family_status as $key => $family_status) { ?>
                                <option value="<?php echo $key; ?>"><?php echo $family_status; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('family_status');?>
                    </div>


                </div>

            </div>



            <p class="hint"> Enter your profetional details below: </p>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group <?php echo form_error('edu_item')?'has-error':'';?>">

                        <label>Education<span class="required" aria-required="true">*</span></label>

                        <select class="form-control required_field" name="edu_item" id="">
                            <option value="">Select</option>
                            <?php foreach($arr_edu as $key => $arr_item) { ?>

                                <optgroup label="<?php echo $key; ?>">
                                    <?php foreach($arr_item as $key => $item) { ?>
                                        <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                                    <?php } ?>
                                </optgroup>


                            <?php } ?>
                            <option value="0">Other</option>
                        </select>
                        <span class="help-block err_required"></span>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('employed_in')?'has-error':'';?>">
                        <label>Employed In<span class="required" aria-required="true">*</span></label>
                        <select class="form-control required_field" name="employed_in" id="employed_in">
                            <option value="">Select</option>
                            <?php foreach($arr_employed_in as $key => $employed_in) { ?>
                                <option value="<?php echo $key; ?>"><?php echo $employed_in; ?></option>
                            <?php } ?>
                        </select>
                        <span class="help-block err_required"></span>
                    </div>
                </div>
            </div>

            <div class="row emp_details" style="display: none">
                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('occ_item')?'has-error':'';?>">
                        <label>Profession<span class="required" aria-required="true">*</span></label>

                        <select class="form-control required_field_emp" name="occ_item" id="">

                            <option value="">Select</option>

                            <?php foreach($arr_occ as $key => $arr_item) { ?>

                                <optgroup label="<?php echo $key; ?>">
                                    <?php foreach($arr_item as $key => $item) { ?>
                                        <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                                    <?php } ?>
                                </optgroup>


                            <?php } ?>

                            <option value="0">Other</option>

                        </select>
                        <span class="help-block err_required_emp"></span>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('annual_income')?'has-error':'';?>">
                        <label>Annual Income<span class="required" aria-required="true">*</span></label>

                        <select class="form-control required_field_emp" name="annual_income">
                            <option value="">Select</option>
                            <?php for( $i=0; $i<=90; $i = $i+$inc ){
                                if($i < 10 ){
                                    $inc = 1;
                                }else{
                                    $inc = 10;
                                }

                                $to = $i+$inc;
                                $to = $to.' Lacks';
                                if($i == 90 ){
                                    $to = '1 Crore';
                                }
                                ?>
                                <option value="<?php echo $i.' - '.$to; ?>"><?php echo 'RS '. $i.' - '.$to; ?></option>
                            <?php } ?>

                        </select>

                        <span class="help-block err_required_emp"></span>
                    </div>
                </div>

            </div>

            <div class="row emp_details" style="display: none">

                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('working_country')?'has-error':'';?>">
                        <label>Working Country<span class="required" aria-required="true">*</span></label>
                        <select class="form-control required_field_emp" name="working_country" id="working_country">
                            <option value="">Select</option>
                            <?php foreach($arr_country as $key => $country) { ?>
                                <option value="<?php echo $country->id; ?>"><?php echo $country->country; ?></option>
                            <?php } ?>
                        </select>
                        <span class="help-block err_required_emp"></span>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group <?php echo form_error('working_city')?'has-error':'';?>">
                        <label>Working City<span class="required" aria-required="true">*</span></label>
                        <input  class="form-control required_field_emp" id="working_city" name="working_city"
                                placeholder="Working City" type="text" value="">
                        <span class="help-block err_required_emp"></span>
                    </div>


                </div>

            </div>


            <p class="hint"> Enter your family details below: </p>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('no_brother_unmarried')?'has-error':'';?>">
                        <label>Number of Brothers Unmarried<span class="required" aria-required="true">*</span></label>
                        <select class="form-control required_field" name="no_brother_unmarried">
                            <?php for( $i=0; $i<10; $i++){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>

                        </select>
                        <span class="help-block err_required"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('no_brother_married')?'has-error':'';?>">
                        <label>Number of Brothers Married<span class="required" aria-required="true">*</span></label>
                        <select class="form-control required_field" name="no_brother_married">
                            <?php for( $i=0; $i<10; $i++){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>

                        </select>
                        <span class="help-block err_required"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('no_sister_unmarried')?'has-error':'';?>">
                        <label>Number of Sisters Unmarried<span class="required" aria-required="true">*</span></label>
                        <select class="form-control required_field" name="no_sister_unmarried">
                            <?php for( $i=0; $i<10; $i++){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>

                        </select>
                        <span class="help-block err_required"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo form_error('no_sister_married')?'has-error':'';?>">
                        <label>Number of Sisters Married<span class="required" aria-required="true">*</span></label>
                        <select class="form-control required_field" name="no_sister_married">
                            <?php for( $i=0; $i<10; $i++){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>

                        </select>
                        <span class="help-block err_required"></span>
                    </div>
                </div>
            </div>


            <div class="form-actions">

                <button id="save_details" class="btn btn-success btn-block uppercase pull-right">Submit</button>
            </div>

        </div>

    </form>

</div>

<script>

    $('#dob').datetimepicker({
        format: 'DD-MM-YYYY',
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'glyphicon glyphicon-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        }
    });

</script>


        