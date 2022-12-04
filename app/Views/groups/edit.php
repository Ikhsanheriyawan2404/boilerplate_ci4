<?= $this->extend('layout/default', ['title' => 'title']) ?>

<?= $this->section('content') ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Edit Groups
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="<?= base_url('group') ?>" data-bs-toggle="tooltip" title="Kembali ke halaman sebelumnya" data-bs-placement="bottom" class="btn-shadow me-3 btn btn-sm btn-dark">
                    Kembali <i class="fa fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <h5 class="card-title">Edit Groups</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('group/' . $group->id) ?>" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    <?= csrf_field() ?>
                        
                    <?= $this->include('groups/partials/form-controls') ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('custom-scripts') ?>

<script>
    function toggle(source) {
        checkboxes = document.getElementsByName('permission[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>

<?= $this->endSection() ?>