<?php $validation = \Config\Services::validation() ?>

<div class="row">
    <div class="col-md-6">
        <div class="position-relative mb-3">
            <label for="name" class="form-label">Nama Group <span class="text-danger">*</span></label>
            <input name="name" id="name" placeholder="Masukkan nama group" type="text" class="form-control form-control-xs <?= $validation->hasError('name') ?  'is-invalid' : '' ?>" value="<?= $group->name ?? old('name') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('name') ?>
            </div>
        </div>
        <div class="position-relative mb-3">
            <label for="description" class="form-label">Deskripsi Group <span class="text-danger">*</span></label>
            <input name="description" id="description" placeholder="Masukkan deskripsi group" type="text" class="form-control form-control-xs <?= $validation->hasError('description') ?  'is-invalid' : '' ?>" value="<?= $group->description ?? old('description') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('description') ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="position-relative mb-3">
            <label class="col-sm-2 control-label" for="customCheckbox1">Izin <span class="text-danger">*</span></label>
            <div class="col-sm-12">
                <small class="text-danger"><?= $validation->hasError('permission') ? $validation->getError('permission') : '' ?></small>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="check_all" type="checkbox" onClick="toggle(this)">
                    <label for="check_all" class="custom-control-label">check semua</label>
                </div>
                <?php foreach ($permissions as $permission) : ?>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" id="<?= $permission->name ?>" name="permission[]" type="checkbox" value="<?= $permission->id ?>" <?= $permission->id == isset($permissionGroup[$permission->id]) ? 'checked' : '' ?>>
                        <label for="<?= $permission->name ?>" class="custom-control-label"><?= $permission->name ?></label>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<button class="mt-1 btn btn-primary">Submit</button>