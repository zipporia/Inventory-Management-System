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
            <form class="form_category" onsubmit="return false">
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="emailHelp">
                    <small id="cat_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="paretn_cat">Parent Category</label>
                    <select class="form-control" name="paretn_cat" id="paretn_cat">
                        <option value="0">Root</option>
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