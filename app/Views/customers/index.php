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
                <div>Data Pelanggan
                    <div class="page-title-subheading">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
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
                    <h3 class="card-title">Data Pelanggan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table my-3 table-sm table-hover table-striped" id="datatables">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor HP</th>
                                    <th>Group</th>
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

<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('template') ?>/plugins/select2/dist/css/select2.min.css">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('template') ?>/plugins/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="<?= base_url('template') ?>/plugins/toastr/toastr.min.css">


<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>

<!-- DataTables -->
<script src="<?= base_url('template') ?>/plugins/datatables/datatables.min.js"></script>
<script src="<?= base_url('template') ?>/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>

<!-- Select2 -->
<script src="<?= base_url('template') ?>/plugins/select2/dist/js/select2.full.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url('template') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('template') ?>/plugins/toastr/toastr.min.js"></script>

<script>
$(document).ready(function() {
    let table = $('#datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?= base_url('customer/datatables'); ?>',
        order: [],
        columns: [
            {data: 'no', orderable: false},
            {data: 'name'},
            {data: 'email'},
            {data: 'phone_number'},
            {data: 'group_name'},
            {data: 'action', orderable: false, className: 'text-center'},
        ]
    });

    // Initialize select2
    $('.select2').select2({
        width: '100%'
    });

    $('body').on('click', '#showDetails', function() {
        var customer_id = $(this).data('id');
        $('#modalDetail').modal('show');
        $.get("<?= base_url('customer') ?>" + '/' + customer_id, function(data) {
            $('#customer_id').val(data.id);
            $('#detailName').html(data.name);
            $('#detailEmail').html(data.email);
            $('#detailPhoneNumber').html(data.phone_number);
            $('#detailAddress').html(data.address);
            $('#detailGroup').html(data.group_name);
        })
    });

    $('#createItem').click(function () {
        setTimeout(function () {
            $('#name').focus();
        }, 500);
        $('#saveBtn').removeAttr('disabled');
        $('#saveBtn').html("Simpan");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('#modal-title').html("Tambah Pelanggan");
        $('#group_business_partner_id').trigger('change').select2('close');
        $('#modal-md').modal('show');
    });

    $('body').on('click', '#editItem', function () {
        var item_id = $(this).data('id');
        $.get("<?= base_url('customer') ?>" +'/' + item_id +'/edit', function (data) {
            $('#modal-md').modal('show');
            setTimeout(function () {
                $('#name').focus();
            }, 500);
            $('#modal-title').html("Edit Pelanggan");
            $('#saveBtn').removeAttr('disabled');
            $('#saveBtn').html("Simpan");
            $('#item_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#phone_number').val(data.phone_number);
            $('#address').val(data.address);
            $('#group_business_partner_id').val(data.group_business_partner_id).trigger('change').select2('open');
        })
    });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $('#saveBtn').attr('disabled', 'disabled');
        $('#saveBtn').html('Simpan ...');
        var formData = new FormData($('#itemForm')[0]);
        $.ajax({
            data: formData,
            url: "<?= base_url('customer') ?>",
            contentType : false,
            processData : false,
            type: "POST",
            success: function (data) {
                
                $('#itemForm').trigger("reset");
                $('#modal-md').modal('hide');
                table.draw();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                });
            },
            error: function (response) {  
                $('#saveBtn').removeAttr('disabled');
                $('#saveBtn').html("Simpan");
                              
                const data = response.responseJSON;
                Swal.fire({
                    icon: 'error',
                    title: 'Oppss',
                    text: 'Coba isi kembali data dengan benar!',
                });
                $.each(data.message, function (index, value) {
                    toastr.error(value);
                });
            }
        });
    });
});
</script>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nama : <i id="detailName"></i></li>
                            <li class="list-group-item">Email : <i id="detailEmail"></i></li>
                            <li class="list-group-item">Group : <i id="detailGroup"></i></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">No HP : <i id="detailPhoneNumber"></i></li>
                            <li class="list-group-item">Alamat : <i id="detailAddress"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-md" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="itemForm" name="itemForm">
                <input type="hidden" name="item_id" id="item_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Pelangggan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm mr-2" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-sm mr-2" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Nomor HP <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-sm mr-2" name="phone_number" id="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control form-control-sm mr-2" name="address" id="address"></textarea>
                    </div>  
                    <div class="form-group">
                        <label for="group_business_partner_id">Group</label>
                        <select name="group_business_partner_id" id="group_business_partner_id" class="form-control form-control-sm select2">
                            <option selected disabled>-- Pilih Group --</option>
                            <?php foreach ($group_business_partners as $key => $value) : ?>
                                <option value="<?= $value->id ?>"><?= $value->name ?></option>
                            <?php endforeach; ?>
                        </select>
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