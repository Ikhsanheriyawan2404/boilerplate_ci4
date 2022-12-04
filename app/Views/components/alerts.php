<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif ?>