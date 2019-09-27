<form action="" method="POST" id="newCase">
    <input type="hidden" name="action" value="addcase">
    <div class="row">
        <div class="col-4">
            <div class="row">
                <div class="col">
                    <label for="category">Category</label>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <select name="category" id="category" class="form-control">
                                <option value=""> - </option>
                                <?php foreach($categories as $key => $category): ?>
                                <option value="<?= $key ?>"><?= $category ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="categoryname" value="">
                        </div>
                        <div class="form-group col-2">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#categoryModal"><i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="complexity">Complexity</label>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <select name="complexity" id="complexity" class="form-control">
                                <option value=""> - </option>
                                <?php foreach($complexityranges as $key => $range): ?>
                                <option value="<?= $key ?>"><?= $range ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="complexityname" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                <label for="intro">Text</label>
                <textarea class="form-control" name="intro" rows="20"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-right mt-5">
            <a href="<?= '//' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?id=' . $activity ?>"
                class="btn btn-secondary">Exit</a>
            <button class="btn btn-primary" type="submit" id="add-case">Add new case</button>
        </div>
    </div>
</form>
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert hide" role="alert"></div>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="category">Category name</label>
                        <input type="text" name="category" id="newcategory" placeholder="new category name"
                            class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="add-category" class="btn btn-primary">Add category</button>
            </div>
        </div>
    </div>
</div>