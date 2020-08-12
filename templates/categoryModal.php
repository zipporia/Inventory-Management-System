 <!-- Modal -->
 <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form id="category_form" onsubmit="return false">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="emailHelp">
                    <small id="cat_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="parent_cat">Parent Category</label>
                    <select class="form-control" name="parent_cat" id="parent_cat">
                        
                    </select>
                </div>
                
            </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>