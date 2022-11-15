<?php foreach ($arr_album_pic as $pic) { ?>

    <div class="col-md-4 pic_col" id="<?php echo $pic->id; ?>">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-pic profile_box">
            <a href="<?php echo site_url('images/client_images/'.$this->user->id.'/'.$pic->thumb);?>" rel="prettyPhoto[pp_gal4]">
                <img src="<?php echo base_url('images/client_images/'.$this->user->id.'/'.$pic->thumb);?>" class="img-responsive" alt="">
            </a>

            <div class="btn_box col-md-12">
                <div class="row">
                    <button data-id="<?php echo $pic->id; ?>" class="btn btn-circle red btn-sm delete" type="button">Delete</button>
                </div>
            </div>
        </div>
        <!-- END SIDEBAR USERPIC -->
    </div>
    <!--Each Album End-->
<?php } ?>