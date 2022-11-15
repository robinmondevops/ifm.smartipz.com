<style>

    .benifits_list {
        list-style: none;
        padding-left: 0px;
    }

    .benifits_list li:before {
        content: '✓';
        padding-right: 10px;
        color: green;
    }

    .benifits_list li{
        .padding: 10px 0px;
    }


</style>

<div class="modal fade" id="popup_model" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="text-align: center"><b style="text-decoration: underline">
                                Benefits of Upgrading
                            </b>
                        </h4>
                        <ul class="benifits_list">
                            <li>View contact numbers of matches</li>
                            <li>Chat with matches online</li>
                            <li>Unlimited personalised messages </li>
                        </ul>

                    </div>

                    <div class="col-md-12">

                        <a href="<?php echo site_url('upgrade/general'); ?>" style="width: 100%"  class="btn btn-danger col-md-12" >Upgrage Now</a>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="popup_model_contact" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div class="row pop_contact_content">

                </div>

            </div>
        </div>

    </div>
</div>