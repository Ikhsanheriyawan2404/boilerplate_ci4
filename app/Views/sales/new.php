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
                <div>Penjualan
                    <div class="page-title-subheading">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="<?= base_url('sale') ?>" data-placement="bottom" class="btn-shadow btn-sm mr-3 btn btn-dark">
                    Kembali
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">

                    <form id="itemForm">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="customer">Pelanggan <span class="text-danger">*</span></label>
                                    <select name="customer" id="customer" placeholder="customer/Supplier" class="form-control form-control-sm">
                                        <option selected disabled>Pilih customer</option>
                                        <?php foreach($customers as $customer) : ?>
                                        <option value="<?= $customer->id ?>"><?= $customer->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="position-relative form-group">
                                    <label for="payment" class="">Metode Pembayaran <span class="text-danger">*</span></label>
                                    <select name="payment" id="payment"class="form-control form-control-sm">
                                        <option selected disabled>Pilih Metode Pembayaran</option>
                                        <option value="paid" id="paid">Cash</option>
                                        <option value="open" id="open">Credit</option>
                                    </select>
                                </div>
                                <div class="position-relative form-group">
                                    <label for="item">Pilih Item <span class="text-danger">*</span></label>
                                    <button type="button" class="btn btn-sm btn-primary form-control" onclick="showItem()">Pilih Item</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="transaction_date" class="">Tgl Transaksi <span class="text-danger">*</span></label>
                                    <input name="transaction_date" id="transaction_date" type="date" class="form-control form-control-sm">
                                </div>
                                <div class="position-relative form-group">
                                    <label for="overdue_date" class="">Tgl Jatuh Tempo <span class="text-danger">*</span></label>
                                    <input name="overdue_date" id="overdue_date" type="date" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="description" class="">Deskripsi</label>
                                    <textarea name="description" id="description" placeholder="Deskripsi..." class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table my-3 table-sm table-hover table-striped" id="table-order">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Kuantitas</th>
                                                <th>Harga</th>
                                                <th>Diskon</th>
                                                <th>Jumlah</th>
                                                <th class="text-center"><i class="fa fa-cog"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <div class="mr-2">
                                        <button class="btn btn-secondary btn-sm">CANCEL</button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-sm" id="createPurchase">SIMPAN</button>
                                        <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-primary btn-sm"><span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                            <button type="button" tabindex="0" class="dropdown-item">Simpan & Baru</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Simpan & Duplikat</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
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

<script text="javascript">
    window.onload = function() {
        const div = document.getElementsByClassName('app-container')[0];
        div.classList.add('closed-sidebar');
    }

    let table1, table2;
    $(document).ready(function () {
        table2 = $('#table-item').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url('item/item_datatable'); ?>',
            order: [],
            columns: [
                {data: 'no', orderable: false},
                {data: 'item_code'},
                {data: 'name'},
                {data: 'selling_price'},
                {data: 'action', orderable: false},
            ]
        });

        $('body').on('click', '#createPurchase', function(e) {
            e.preventDefault();
            $('#createPurchase').attr('disabled', 'disabled');
            $('#createPurchase').html('Simpan ...');
            var formData = new FormData($('#itemForm')[0]);
            $.ajax({
                data: formData,
                url: "<?= base_url('sale') ?>",
                contentType : false,
                processData : false,
                type: "POST",
                success: function (data) {
                    console.log(data)
                    $('#createPurchase').removeAttr('disabled');
                    $('#createPurchase').html("Simpan");
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                    });
                },
                error: function(response) {
                    const data = response.responseJSON;
                    console.log(data)
                    $('#createPurchase').removeAttr('disabled');
                    $('#createPurchase').html("Simpan");
                    Swal.fire({
                        icon: 'error',
                        title: 'Oppss',
                        text: data.message,
                    });
                    $.each(data.errors, function (index, value) {
                        toastr.error(value);
                    });
                }
            });
        })

        $('body').on('click', '.chooseItem', function(e) {
            e.preventDefault();
            hideItem();
            var id = $(this).data('id');
            $.get("<?= base_url('sale') ?>" + "/" + id + '/item', function(data) {

                var tr = $('<tr>');
                for (var i = 0; i < 7; i++) {
                    var td = $('<td>').html(data[i]);
                    tr.append(td);
                }
                $('#table-order tbody').append(tr);

            });
        })

        $('body').on('click', '.removeItem', function(e) {
            e.preventDefault();
            $(this).parents('tr').remove();
        });
    });

    function showItem() {
        $('#modalItem').modal('show');
    }

    function hideItem() {
        $('#modalItem').modal('hide');
    }

    

</script>


<!-- Modal -->
<div class="modal fade" id="modalItem" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Item Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-striped table-responsive" id="table-item" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th><i class="fa fa-cogs"></i></th>
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
<?= $this->endSection() ?>