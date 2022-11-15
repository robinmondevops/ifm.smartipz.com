<?php foreach ($arr_albm as $album) { ?>
    <a href="<?php echo site_url('album_inner/view/'.$album->id); ?>">                                        
    <!--Each Album-->
    <div class="col-md-4 col-xs-4">
        <div class="col-md-12">
            <div class="row"> 
                <div class="col-md-12 col-xs-12"><div class="row"> <img class="img-responsive" src="<?php echo base_url('images/client_images/'.$this->user->id.'/'.$album->thumb);?>"></div></div>     
            </div>    
            <div class="row"> <h5><?php echo $album->title; ?></h5></div>
        </div>
    </div>
    </a>
    <!--Each Album End-->
<?php } ?>