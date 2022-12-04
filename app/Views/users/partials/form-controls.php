<?php $validation = \Config\Services::validation() ?>

<div class="row">
    <div class="col-md-6">
        <div class="position-relative mb-3">
            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
            <input name="username" id="username" placeholder="Masukkan username" type="text" class="form-control form-control-xs <?= $validation->hasError('username') ?  'is-invalid' : '' ?>" value="<?= $user->username ?? old('username') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('username') ?>
            </div>
        </div>
        <div class="position-relative mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input name="email" id="email" placeholder="Masukkan email" type="text" class="form-control form-control-xs <?= $validation->hasError('email') ?  'is-invalid' : '' ?>" value="<?= $user->email ?? old('email') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('email') ?>
            </div>
        </div>
        <div class="position-relative mb-3">
            <label for="email" class="form-label">Group/Role <span class="text-danger">*</span></label>
            <select name="group" id="group" class="form-control form-control-xs <?= $validation->hasError('group') ? 'is-invalid' : '' ?>">
                <option selected disabled>Pilih Group</option>
                <?php 
                if (isset($userGroup)) {
                    $groupUser = $userGroup;
                } else {
                    $groupUser = 0;
                }
                foreach ($groups as $group) : ?>
                    <option value="<?= $group->id ?>" <?= $groupUser == $group->id ? 'selected' : '' ?>><?= $group->name ?></option>
                <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('group') ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="position-relative mb-3">
            <label for="password_hash" class="form-label">Password <span class="text-danger">*</span></label>
            <input name="password_hash" id="password_hash" placeholder="Masukkan password" type="password" class="form-control form-control-xs <?= $validation->hasError('password_hash') ?  'is-invalid' : '' ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('password_hash') ?>
            </div>
        </div>
        <div class="position-relative mb-3">
            <label for="pass_confirm" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
            <input name="pass_confirm" id="pass_confirm" placeholder="Masukkan konfirmasi password" type="password" class="form-control form-control-xs <?= $validation->hasError('pass_confirm') ?  'is-invalid' : '' ?>" value="<?= $user->pass_confirm ?? old('pass_confirm') ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('pass_confirm') ?>
            </div>
        </div>
    </div>
</div>
<button class="mt-1 btn btn-primary">Submit</button>