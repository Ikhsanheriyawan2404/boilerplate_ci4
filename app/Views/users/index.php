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
                <div>Data Users
                    <div class="page-title-subheading">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Users</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="<?= base_url('user/new') ?>" data-placement="bottom" class="btn-shadow btn-sm mr-3 btn btn-dark">
                    Tambah
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <?= $this->include('components/alerts') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <h3 class="card-title">Data Users</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table my-3 table-sm table-hover table-striped" id="datatables">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th class="text-center">Aktif</th>
                                    <th class="text-center"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= $user->username ?></td>
                                        <td class="text-center">
                                            <?= $user->active == 1 ? '<div class="mb-2 me-2 badge bg-success">Aktif</div>' : '<div class="mb-2 me-2 badge bg-success">Non Aktif</div>' ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown d-inline-block">
                                                <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle text-white btn-primary btn-sm"></a>
                                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                                    <form action="<?= base_url('user/' . $user->id) ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <a href="javascript:void(0)" data-id="<?= $user->id ?>" id="showDetails" class="dropdown-item">Detail</a>
                                                        <a href="<?= base_url('user/' . $user->id . '/edit') ?>" class="dropdown-item">Edit</a>
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Yakin menghapus data?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('custom-styles') ?>

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('template') ?>/plugins/datatables/css/dataTables.bootstrap4.min.css">

<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>

<!-- DataTables -->
<script src="<?= base_url('template') ?>/plugins/datatables/datatables.min.js"></script>
<script src="<?= base_url('template') ?>/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#datatables').DataTable({
        responsive: true,
    });

    $('a#showDetails').on('click', function () {
        var user_id = $(this).data('id');
        $('#detailsModal').modal('show');
        $.get("<?= base_url('user') ?>" + '/' + user_id, function(data) {
            $('#email').html(data.email);
            $('#username').html(data.username);
            $('#createdAt').html(data.created_at);
            $('#group').html(data.name);
        });
    });
});
</script>

<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">User Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <button class="list-group-item-action list-group-item">Email : <i id="email"></i></button>
                    <button class="list-group-item-action list-group-item">Username : <i id="username"></i></button>
                    <button class="list-group-item-action list-group-item">Dibuat : <i id="createdAt"></i></button>
                    <button class="list-group-item-action list-group-item">Group : <i id="group"></i></button>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>