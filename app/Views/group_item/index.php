<?= $this->extend('layout/default', compact('title')) ?>

<?= $this->section('content') ?>

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-users icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div>Data Group Items
                    <div class="page-title-subheading">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Group Items</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <button id="createItem" data-placement="bottom" class="btn-shadow btn-sm mr-3 btn btn-dark">
                    Tambah
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <?= $this->include('components/alerts') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <h3 class="card-title">Data Item</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table my-3 table-sm table-hover table-striped" id="datatables">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Nama</th>
                                    <th>Akun Kode</th>
                                    <th class="text-center"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>

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

<link rel="stylesheet" href="<?= base_url('template') ?>/plugins/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="<?= base_url('template') ?>/plugins/toastr/toastr.min.css">


<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>

<!-- DataTables -->
<script src="<?= base_url('template') ?>/plugins/datatables/datatables.min.js"></script>
<script src="<?= base_url('template') ?>/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('template') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('template') ?>/plugins/toastr/toastr.min.js"></script>

<script>
$(document).ready(function() {
    let table = $('#datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?= base_url('group-item/datatables'); ?>',
        order: [],
        columns: [
            {data: 'no', orderable: false},
            {data: 'name'},
            {data: 'account_code'},
            {data: 'action', orderable: false},
        ]
    });

    $('a#showDetails').on('click', function () {
        var user_id = $(this).data('id');
        $('#detailsModal').modal('show');
        $.get("<?= base_url('user') ?>" + '/' + user_id, function(data) {
            $('#name').html(data.name);
            $('#account_code').html(data.account_code);
            $('#description').html(data.description);
        });
    });

    $('#createItem').click(function () {
        setTimeout(function () {
            $('#name').focus();
        }, 500);
        $('#saveBtn').removeAttr('disabled');
        $('#saveBtn').html("Simpan");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('.modal-title').html("Tambah Group Item");
        $('#modal-md').modal('show');
    });

    $('body').on('click', '#editItem', function () {
        var item_id = $(this).data('id');
        $.get("<?= base_url('group-item') ?>" +'/' + item_id +'/edit', function (data) {
            $('#modal-md').modal('show');
            setTimeout(function () {
                $('#name').focus();
            }, 500);
            $('#modal-title').html("Edit Toko");
            $('#saveBtn').removeAttr('disabled');
            $('#saveBtn').html("Simpan");
            $('#item_id').val(data.id);
            $('#name').val(data.name);
            $('#description').val(data.description);
            // $('#account_code').val(data.account_code);
        })
    });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#itemForm')[0]);
        $.ajax({
            data: formData,
            url: "<?= base_url('group-item') ?>",
            contentType : false,
            processData : false,
            type: "POST",
            success: function (data) {
                $('#saveBtn').attr('disabled', 'disabled');
                $('#saveBtn').html('Simpan ...');
                $('#itemForm').trigger("reset");
                $('#modal-md').modal('hide');
                table.draw();
                if (data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oppss',
                        text: 'Coba isi kembali data dengan benar!',
                    });
                    $.each(data.message, function (index, value) {
                        toastr.error(value);
                    });
                }
            },
        });
    });
});
</script>

<!-- Modal -->
<div class="modal fade" id="modal-md" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">User Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="itemForm" name="itemForm">
                <input type="hidden" name="item_id" id="item_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Group <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm mr-2" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="account_code">Akun Kode <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm mr-2" name="account_code" id="account_code">
                            <option selected disabled>Pilih Akun</option>
                            <?php foreach($accounts as $account) : ?>
                                <option value="<?= $account->code ?>"><?= $account->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control form-control-sm mr-2" name="description" id="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary" id="saveBtn" value="create">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>