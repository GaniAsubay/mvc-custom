<form method="post" name="Task" class="row g-3">
    <input type="hidden" class="form-control" id="inputEmail4" name="id" value="<?= $model->id?>">
    <input type="hidden" class="form-control" id="inputEmail4" name="status" value="<?= $model->status?>">
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4" name="email" value="<?= $model->email?>">
    </div>
    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description"><?= $model->description?></textarea>
    </div>
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">User Name</label>
        <input type="text" class="form-control" id="inputEmail4" name="name" value="<?= $model->name?>">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>