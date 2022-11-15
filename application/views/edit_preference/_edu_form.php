
<style>


    h4 {
        margin: 2rem 0rem 1rem;
    }

    .table-image {
        td, th {
            vertical-align: middle;
        }
    }
    .item_column{
        padding-left: 15px;
    }

</style>



<div class="col-md-12 reg_pop" >

    <form role="form" id="form_edu" class="form-horizontal" enctype="multipart/form-data" method="post" >

        <div class="col-md-12">

            <div class="alert alert-success err_model" style="display: none">
                <button class="close" data-close="alert"></button>
                <span class="err_msg"></span>
            </div>


            <div class="row">


                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col"></th>

                                <th scope="col">
                                    <div class="custom-control custom-checkbox">

                                        <input value="0" type="checkbox" class="custom-control-input chk_common" id="chk_all" name="chk_all" >

                                    </div>
                                </th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach($arr_edu as $category_name =>$arr_list ){ ?>

                                <tr>
                                    <td class="header_column" colspan="2">
                                        <b><?php echo $category_name; ?></b>
                                    </td>

                                </tr>

                                <?php foreach($arr_list as $key =>$list ){ ?>

                                    <tr>

                                        <td class="item_column">
                                            <?php echo $list->name; ?>
                                        </td>

                                        <td>
                                            <div class="custom-control custom-checkbox">

                                                <input <?php echo in_array($list->id, $arr_per_edu_id )?'checked':''; ?>
                                                    value="<?php echo $list->id; ?>" type="checkbox" class="custom-control-input chk_common chk_list"
                                                    name="arr_edu[]" >

                                            </div>
                                        </td>

                                    </tr>

                            <?php  } } ?>


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>


            <div class="form-actions">

                <button id="save_edu" class="btn btn-success btn-block uppercase pull-right">Save Changes</button>

            </div>

        </div>

    </form>

</div>


<script>




</script>



        