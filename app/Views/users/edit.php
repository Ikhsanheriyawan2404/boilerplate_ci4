<?= $this->extend('layout/default', ['title' => 'title']) ?>

<?= $this->section('content') ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-users icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div><?= $title ?>
                    <div class="page-title-subheading">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="<?= base_url('user') ?>" data-placement="bottom" class="btn-shadow btn-sm mr-3 btn btn-dark">
                    Kembali
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <h5 class="card-title">Edit User</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/' . $user->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <?= $this->include('users/partials/form-controls') ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom-styles') ?>

<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/select2/dist/select2.min.css">

<?= $this->endSection() ?>