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
                <div>Data Perusahaan
                    <div class="page-title-subheading">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Perusahaan</li>
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
                    <h3 class="card-title">Data Users</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table my-3 table-sm table-hover table-striped" id="datatables">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Name</th>
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

<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>

<!-- DataTables -->
<script src="<?= base_url('template') ?>/plugins/datatables/datatables.min.js"></script>
<script src="<?= base_url('template') ?>/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    let table = $('#datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?= base_url('company/datatables'); ?>',
        columns: [
            {data: 'id'},
            {data: 'name'},
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

    $('#createItem').click(function () {
        setTimeout(function () {
            $('#name').focus();
        }, 500);
        $('#saveBtn').removeAttr('disabled');
        $('#saveBtn').html("Simpan");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('.modal-title').html("Tambah Perusahaan");
        $('#modal-md').modal('show');
    });

    $('body').on('click', '#editItem', function () {
        var company_id = $(this).data('id');
        $.get("<?= base_url('company') ?>" +'/' + company_id +'/edit', function (data) {
            $('#modal-md').modal('show');
            setTimeout(function () {
                $('#name').focus();
            }, 500);
            $('#modal-title').html("Edit Perusahaan");
            $('#saveBtn').removeAttr('disabled');
            $('#saveBtn').html("Simpan");
            $('#company_id').val(data.id);
            $('#name').val(data.name);
        })
    });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#itemForm')[0]);
        $.ajax({
            data: formData,
            url: "<?= base_url('company') ?>",
            contentType : false,
            processData : false,
            type: "POST",
            success: function (data) {
                $('#saveBtn').attr('disabled', 'disabled');
                $('#saveBtn').html('Simpan ...');
                $('#itemForm').trigger("reset");
                $('#modal-md').modal('hide');
                var data = table.ajax.json();

                // Modify data
                $.each(data.data, function(){
                this[0] = 'John Smith';
                });

                // Clear table
                table.clear();

                // Add updated data
                table.rows.add(data.data);

                // Redraw table
                table.draw();
            },
            error: function (data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data masih kosong!',
                });
            }
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
                <input type="hidden" name="company_id" id="company_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control form-control-sm mr-2" name="name" id="name" required>
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