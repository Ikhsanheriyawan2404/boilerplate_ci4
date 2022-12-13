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
                <div>Data journals
                    <div class="page-title-subheading">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-journal"><a href="#">Home</a></li>
                                <li class="breadcrumb-journal active" aria-current="page">journals</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <button id="journal" data-placement="bottom" class="btn-shadow btn-sm mr-3 btn btn-dark">
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
                    <h3 class="card-title">Data journal</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table my-3 table-sm table-hover table-striped" id="datatables">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Faktur</th>
                                    <th>Description</th>
                                    <th>Tanggal</th>
                                    <th>File</th>
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
        ajax: '<?= base_url('journal/datatables'); ?>',
        order: [],
        columns: [
            {data: 'no', orderable: false},
            {data: 'transaction_number'},
            {data: 'date'},
            {data: 'description'},
            {data: 'file'},
            {data: 'action', orderable: false},
        ]
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

    $('#journal').click(function () {
        setTimeout(function () {
            $('#name').focus();
        }, 500);
        $('#saveBtn').removeAttr('disabled');
        $('#saveBtn').html("Simpan");
        $('#journal_id').val('');
        $('#journalForm').trigger("reset");
        $('.modal-title').html("Tambah Toko");
        $('#modal-md').modal('show');
    });

    $('body').on('click', '#journal', function () {
        var journal_id = $(this).data('id');
        $.get("<?= base_url('journal') ?>" +'/' + journal_id +'/edit', function (data) {
            $('#modal-md').modal('show');
            setTimeout(function () {
                $('#name').focus();
            }, 500);
            $('#modal-title').html("Edit Toko");
            $('#saveBtn').removeAttr('disabled');
            $('#saveBtn').html("Simpan");
            $('#journal_id').val(data.id);
            $('#name').val(data.name);
            $('#company_id').val(data.company_id);
        })
    });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#journalForm')[0]);
        $.ajax({
            data: formData,
            url: "<?= base_url('journal') ?>",
            contentType : false,
            processData : false,
            type: "POST",
            success: function (data) {
                $('#saveBtn').attr('disabled', 'disabled');
                $('#saveBtn').html('Simpan ...');
                $('#journalForm').trigger("reset");
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
            <form method="post" id="journalForm" name="journalForm">
                <input type="hidden" name="journal_id" id="journal_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="journal_code">Kode journal</label>
                        <input type="text" class="form-control form-control-sm mr-2" name="journal_code" id="journal_code" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama journal</label>
                        <input type="text" class="form-control form-control-sm mr-2" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="selling_price">Harga Jual</label>
                        <input type="number" class="form-control form-control-sm mr-2" name="selling_price" id="selling_price" required>
                    </div>
                    <div class="form-group">
                        <label for="purchase_price">Harga Beli</label>
                        <input type="number" class="form-control form-control-sm mr-2" name="purchase_price" id="purchase_price" required>
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