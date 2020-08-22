 <!-- Modal -->
 <div class="modal fade" id="form_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form id="update_brand_form" onsubmit="return false">
                <div class="form-group">
                    <label>Brand Name</label>
                    <input type="hidden" name="bid" id="bid" value=""/>
                    <input type="text" class="form-control" id="update_brand" name="update_brand"  placeholder="Enter Brand Name">
                    <small id="cat_error" class="form-text text-muted"></small>
                </div>
                
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </form>

            </div>
            <div class="modal-footer">
                
                
            </div>
            </div>
        </div>
    </div>