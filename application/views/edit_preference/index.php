<style>
    .long_string_column{
        padding-left: 30px !important;
    }
</style>

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
                    <span>Edit Preference</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMBS -->

            <div class="page-content-inner">

                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN PROFILE SIDEBAR -->
                        <div class="profile-sidebar">
                            <!-- PORTLET MAIN -->
                            <div class="portlet light profile-sidebar-portlet ">
                                <!-- SIDEBAR USERPIC -->
                                
                                
                                <?php $this->load->view('templates/left_sidebar'); ?>
                                <!-- END MENU -->
                            </div>
                            <!-- END PORTLET MAIN -->
                            
                        </div>    

                        <div class="profile-content">

                            <div class="right_side_wrapper col-md-9">

                                <div class="portlet light portlet-fit col-md-12">
                                    <div class="portlet-body">



                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="profile-content">

                                                    <div class="row">

                                                        <div class="card">

                                                            <div class="card-body">
                                                                <div id="table" class="table-editable">

                                                                    <table class="table table-bordered table-responsive-md table-striped text-center">

                                                                        <tbody>
                                                                        <tr>
                                                                            <th class="long_string_column" >Age</th>
                                                                            <td id="column_age" class="long_string_column" style="width: 70%; text-align: left">
                                                                                <?php echo $row_preference['age_from'].' - '.$row_preference['age_to'].' Yrs'; ?>
                                                                            </td>

                                                                            <td class="" style="width: 15%; text-align: center">
                                                                                <a  data-type="age" class="load_edit_form" data-title="Edit Age Preference"
                                                                                   href="javascript:;" title="Edit" >
                                                                                    <i class="fa fa-edit font-blue-ebonyclay"></i></a>
                                                                            </td>

                                                                        </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>



                                                    <div class="row">

                                                        <?php foreach ($arr_marital_status as $key => $marital_status) { ?>

                                                            <div class="col-md-3" id="<?php echo $key; ?>">
                                                                <div class="catagories_each">
                                                                    <h4><?php echo $marital_status; ?></h4>

                                                                    <button id="add_<?php echo $key; ?>" class="btn btn-circle green btn-sm add_group
                                                                    <?php echo in_array($key, $arr_per_merital_status)?'hidden':'';?>"
                                                                            data-id="<?php echo $key; ?>" data-url="<?php echo site_url('edit_preference/add_group'); ?>"
                                                                            type="button">Add</button>

                                                                    <button id="remove_<?php echo $key; ?>" class="btn btn-circle red btn-sm remove_group
                                                                    <?php echo in_array($key, $arr_per_merital_status)?'':'hidden';?>" data-id="<?php echo $key; ?>"
                                                                            data-url="<?php echo site_url('edit_preference/remove_group'); ?>" type="button">Remove</button>

                                                                </div>
                                                            </div>

                                                        <?php } ?>

                                                    </div>

                                                    <div class="row">

                                                        <div class="card">

                                                            <div class="card-body">
                                                                <div id="table" class="table-editable">

                                                                    <table class="table table-bordered table-responsive-md table-striped text-center">

                                                                        <tbody>
                                                                            <tr>
                                                                                <th class="long_string_column" >Education</th>
                                                                                <td id="column_edu" class="long_string_column" style="width: 70%; text-align: left">
                                                                                    <?php echo $str_per_edu; ?>
                                                                                </td>

                                                                                <td class="" style="width: 15%; text-align: center">
                                                                                    <a data-type="edu" class="load_edit_form" data-title="Edit Education Preference"
                                                                                       href="javascript:;" title="Edit">
                                                                                        <i class="fa fa-edit font-blue-ebonyclay"></i>
                                                                                    </a>
                                                                                </td>

                                                                            </tr>

                                                                            <tr >
                                                                                <th class="long_string_column"  >Occupation</th>
                                                                                <td id="column_occ" class="long_string_column"
                                                                                    style="width: 70%; text-align: left">
                                                                                    <?php echo $str_per_occ; ?>
                                                                                </td>

                                                                                <td class="" style="width: 15%; text-align: center">
                                                                                    <a data-type="occ" class="load_edit_form" data-title="Edit Occupation Preference"
                                                                                       href="javascript:;"
                                                                                       title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>
                                                                                </td>

                                                                            </tr>

                                                                            <tr >
                                                                                <th class="long_string_column"  >Country</th>
                                                                                <td id="column_country" class="long_string_column" style="width: 70%; text-align: left">
                                                                                    <?php echo $str_per_country; ?>
                                                                                </td>

                                                                                <td class="" style="width: 15%; text-align: center">
                                                                                    <a  data-type="country" class="load_edit_form" data-title="Edit Country Preference"
                                                                                        href="javascript:;"
                                                                                        title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>
                                                                                </td>

                                                                            </tr>

                                                                            <tr >
                                                                                <th class="long_string_column"  >District</th>
                                                                                <td id="column_district"
                                                                                    class="long_string_column" style="width: 70%; text-align: left">
                                                                                    <?php echo $str_per_district; ?>
                                                                                </td>

                                                                                <td class="" style="width: 15%; text-align: center">
                                                                                    <a data-type="district" class="load_edit_form" data-title="Edit District Preference"
                                                                                       href="javascript:;"
                                                                                       title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>
                                                                                </td>

                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>



                                                </div>

                                            </div>

                                        </div>


                                    </div>
                                </div>


                            </div>


                            <?php $this->load->view('templates/right_sidebar'); ?>  

                        </div>

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>


            
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>

<div class="modal fade" id="edit_details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="edit_details_title"></h4>
            </div>
            <div class="modal-body">
                <div class="row"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script>


    $(document).ready(function(){



        $(document).on('click','.load_edit_form', function(){

            var $this = $(this);

            var $type = $this.data('type');
            var $title = $this.data('title');

            var $load_form_url = site_url+'edit_preference/load_edit_form/'+$type;

            $('#reg_details .modal-body .row').html('<div class="text-center">' +
                '<img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif"></div>');

            $('#edit_details').modal();

            $('#edit_details_title').html($title);

            $.ajax({
                url: $load_form_url,
                type: 'post',
                success: function(data) {

                    $('#edit_details .modal-body .row').html(data.html);

                    if( $type== 'edu' || $type== 'occ' || $type== 'country' || $type== 'district' ){
                        chk_edu_checkbox(data.count_type);
                    }

                }
            });

        });

        $(document).on('click','#save_age', function(e){

            e.preventDefault();


            var $age_from = $('#age_from').val();
            var $age_to = $('#age_to').val();


            if( $age_from >= $age_to ){

                $('.err_model').show();
                $('.err_msg').html('Age To Should Be Greater Than Age From');

            }else{

                $('.err_msg').html('');
                $('.err_model').hide();

                var formData = $('#form_age').serialize();

                var $url = site_url+'edit_preference/save_age';

                $('#save_details').attr('disabled', true);
                $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
                $.ajax({
                    url: $url,
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        $('#column_age').html(data.column_html);
                        $('#save_age').attr('disabled', false);
                        $('#edit_details').modal('hide');
                        $.unblockUI();

                    }
                });

                $('#save_age').attr('disabled', false);

            }




        });



        $(document).on('click', '.add_group', function() {
            var $this = $(this);
            var $category_id =  $this.data('id');

            $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
            $.ajax({
                type: 'POST',
                url: $this.data('url'),
                data:{ 'category_id': $category_id },
                success: function(data){
                    //$('#'+$category_id).remove();
                    $('#add_'+$category_id).addClass('hidden');
                    $('#remove_'+$category_id).removeClass('hidden');
                    $.unblockUI();
                }
            });


            return false;
        });



        $(document).on('click', '.remove_group', function() {

            var $this = $(this);

            var $showing_count = $('.remove_group:visible').length;

            if( $showing_count > 1 ){

                var $category_id =  $this.data('id');

                $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
                $.ajax({
                    type: 'POST',
                    url: $this.data('url'),
                    data:{ 'category_id': $category_id },
                    success: function(data){
                        //$('#'+$category_id).remove();
                        $('#add_'+$category_id).removeClass('hidden');
                        $('#remove_'+$category_id).addClass('hidden');
                        $.unblockUI();
                    }
                });

            }else{

                $('#edit_details').modal();

                $('#edit_details_title').html('Error');
                $('#edit_details .modal-body .row').html("<div class='alert alert-danger'>" +
                    "</button><span>You can't delete all the items in the list. " +
                    "Atleast one should be selected to get your matches</span></div>");

            }




            return false;
        });


        $(document).on('click','#save_edu', function(e){

            e.preventDefault();

            $('.err_msg').html('');
            $('.err_model').hide();

            var formData = $('#form_edu').serialize();

            var $url = site_url+'edit_preference/save_edu';

            $('#save_details').attr('disabled', true);
            $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
            $.ajax({
                url: $url,
                type: 'POST',
                data: formData,
                success: function (data) {
                    $('#column_edu').html(data.column_html);
                    $('#save_edu').attr('disabled', false);
                    $('#edit_details').modal('hide');
                    $.unblockUI();


                }
            });

            $('#save_edu').attr('disabled', false);

        });

        $(document).on('click','#save_occ', function(e){

            e.preventDefault();

            $('.err_msg').html('');
            $('.err_model').hide();

            var formData = $('#form_occ').serialize();

            var $url = site_url+'edit_preference/save_occ';

            $('#save_details').attr('disabled', true);
            $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
            $.ajax({
                url: $url,
                type: 'POST',
                data: formData,
                success: function (data) {
                    $('#column_occ').html(data.column_html);
                    $('#save_occ').attr('disabled', false);
                    $('#edit_details').modal('hide');
                    $.unblockUI();


                }
            });

            $('#save_occ').attr('disabled', false);

        });

        $(document).on('click','#save_country', function(e){

            e.preventDefault();

            $('.err_msg').html('');
            $('.err_model').hide();

            var formData = $('#form_country').serialize();

            var $url = site_url+'edit_preference/save_country';

            $('#save_details').attr('disabled', true);
            $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
            $.ajax({
                url: $url,
                type: 'POST',
                data: formData,
                success: function (data) {
                    $('#column_country').html(data.column_html);
                    $('#save_country').attr('disabled', false);
                    $('#edit_details').modal('hide');
                    $.unblockUI();


                }
            });

            $('#save_country').attr('disabled', false);

        });

        $(document).on('click','#save_district', function(e){

            e.preventDefault();

            $('.err_msg').html('');
            $('.err_model').hide();

            var formData = $('#form_district').serialize();

            var $url = site_url+'edit_preference/save_district';

            $('#save_details').attr('disabled', true);
            $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
            $.ajax({
                url: $url,
                type: 'POST',
                data: formData,
                success: function (data) {
                    $('#column_district').html(data.column_html);
                    $('#save_district').attr('disabled', false);
                    $('#edit_details').modal('hide');
                    $.unblockUI();


                }
            });

            $('#save_district').attr('disabled', false);

        });

        function chk_edu_checkbox(count_type){

            if( count_type == 0 ){

                $( ".chk_common" ).prop( "checked", true );
            }

        }


        $(document).on('click', '#chk_all', function(){


            if ( $('#chk_all').is(':checked') == true ) {

                $(".chk_common").prop('checked', true);

            }else{
                $(".chk_common").prop('checked', false);
            }


        });

        $(document).on('click', '.chk_list', function(){

            var n = $( ".chk_list:checked" ).length;
            var total_check_box = $( ".chk_list" ).length;

            if( n==total_check_box){
                $("#chk_all").prop('checked', true);
            }else{
                $("#chk_all").prop('checked', false);
            }

        });


    });



</script>



