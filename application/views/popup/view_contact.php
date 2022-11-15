<div class="col-md-12 each-item-profile">
    <div class="user_box">
        <div class="row">
            <div class="col-md-12 each-item-button-row">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">

                                <?php if( $row_friend->image && file_exists( './files/profile/'.$row_friend->id.'/'.$row_friend->image ) ) {?>
                                    <img src="<?php echo base_url('files/profile/'.$row_friend->id.'/'.$row_friend->image);?>" class="img-responsive" alt="">
                                <?php } else {?>
                                    <img src="<?php echo base_url('assets/pages/media/users/User_No-Frame.png'); ?>" class="img-responsive" alt="">
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 item_content_row" >
                    <h5><b><?php echo $row_friend->first_name.' '.$row_friend->last_name; ?></b> (<?php echo 'KNA'.$row_friend->kna_id;?>)</h5>
                    <div class="row">
                        <table class="table table-strpied">
                            <tr>
                                <th style="padding-left: 0px !important">Phone  </th>
                                <td><b><?php echo $row_friend->phone;?></b></td>
                            </tr>
                            <tr>
                                <th style="padding-left: 0px !important">Email </th>
                                <td style="word-break: break-all;">
                                    <?php echo $row_friend->email;?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="tel:<?php echo $row_friend->phone; ?>" class="btn btn-success btn-block">
                                        Call Now
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--Each User End-->
</div>