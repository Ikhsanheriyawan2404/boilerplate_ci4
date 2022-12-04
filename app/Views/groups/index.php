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
                <div>
                    Groups
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="<?= base_url('group/new') ?>" data-bs-toggle="tooltip" title="Tambah Data Groups" data-bs-placement="bottom" class="btn-shadow me-3 btn btn-sm btn-primary">
                    Tambah <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <?= $this->include('components/alerts') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <h3 class="card-title">Data Groups</h3>
                </div>
                <div class="card-body">
                    <!-- <div class="table-responsive"> -->
                        <table class="table my-3 table-sm table-bordered table-hover table-striped" id="datatables">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center" width="15%"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach($groups as $group) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $group->name ?></td>
                                    <td><?= $group->description ?></td>
                                    <td class="text-center">
                                        <form action="<?= base_url('group/' . $group->id) ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                            <a href="javascript:void(0)" data-id="<?= $group->id ?>" id="showDetails" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="<?= base_url('group/' . $group->id . '/edit') ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil-alt"></i></a>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus ini?')"><i class="fa fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    <!-- </div> -->
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
$(document).ready(function () {
    $('#datatables').DataTable({
        "responsive": true,
        // "aoColumnDefs": [{ 
        //     "bSortable": false,
        //     "aTargets": [ 0,1,2 ] 
        // }],
        "order":[],
    });

    $('body').on('click', '#showDetails', function () {
        var group_id = $(this).data('id');
        $('#detailsModal').modal('show');
        $.get("<?= base_url('group') ?>" + '/' + group_id, function(data) {
            $.each(data, function (key, value) {
                $('#group').append(`<button class="btn btn-sm btn-primary group mr-1 my-1">${value.name}</button>`)
            });
        });
        $('button.group').remove();
    });
});
</script>

<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Group Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
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