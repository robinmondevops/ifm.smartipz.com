<div class="col-md-12">
    <form role="form" id="form_album" class="form-horizontal" enctype="multipart/form-data" method="post" >

        <div class="form-group form-group-sm" id="name-box">
            <label class="col-md-3 control-label" for="name">Name:</label>
            <div class="col-md-5">
                <input type="text"  name="name" placeholder="Name" id="name" class="form-control">
                <span class="help-block text-danger" id="name-error"></span>
            </div> 
        </div>

        <div class="form-group form-group-sm" id="description-box">
            <label class="col-md-3 control-label" for="description">Description:</label>
            <div class="col-md-5">
                <textarea placeholder="Description" id="description" class="form-control" name="description"></textarea>   
                <span class="help-block text-danger" id="description-error"></span>
            </div>
        </div>  

        <div class="form-group form-group-sm" id="image-box">
            <label class="col-md-3 control-label" for="image">Upload Photos:</label>
            <div class="col-md-5">
                 <input type="file" name="file_upload" id="file_upload">
                 <input type="hidden" name="uploaded_files" id="uploaded_files">
            </div>
        </div>

        <div class="form-group form-group-sm">
            <div class="col-md-offset-3 col-md-5">
                <button  class="btn blue-steel save_album" name="upload" type="button">Save</button>
            </div>
        </div>

    </form>
</div>
        