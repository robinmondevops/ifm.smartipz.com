<div class="col-md-12">
    <form role="form" id="form_album" class="form-horizontal" enctype="multipart/form-data" method="post" >



        <div class="form-group form-group-sm" id="image-box">
            <label class="col-md-3 control-label" for="image">Upload Photos:</label>
            <div class="col-md-8">
                <div id="fine-uploader"></div>         
                <!-- <input type="file" name="file_upload" id="file_upload"> -->
                 <input type="hidden" name="uploaded_files" id="uploaded_files">
            </div>
            <span class="help-block text-danger" id="image-error"></span>
        </div>

        <div class="form-group form-group-sm">
            <div class="col-md-offset-3 col-md-8">
                <button  class="btn blue-steel save_album" name="upload" type="button">Save</button>
            </div>
        </div>

    </form>
</div>


        