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
                <div>Pembelian
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
                <button id="journal" data-placement="bottom" class="btn-shadow btn-sm mr-3 btn btn-dark">
                    Kembali
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">

                    <form class="">

                        <div class="row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="vendor">Vendor <span class="text-danger">*</span></label>
                                        <select name="vendor" id="vendor" placeholder="Vendor/Supplier" class="form-control form-control-sm">
                                            <option selected disabled>Pilih Vendor</option>
                                            <?php foreach($vendors as $vendor) : ?>
                                            <option value="<?= $vendor->id ?>"><?= $vendor->name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="position-relative form-group">
                                        <label for="vendor" class="">Metode Pembayaran <span class="text-danger">*</span></label>
                                        <select name="vendor" id="vendor" placeholder="Vendor/Supplier" class="form-control form-control-sm">
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
                            </form>
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
                                        <button class="btn btn-primary btn-sm">SIMPAN</button>
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
    $(function () {
        // table1 = $('#table-order').DataTable()
        table2 = $('#table-item').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url('purchase/item_datatable'); ?>',
            order: [],
            columns: [
                {data: 'no', orderable: false},
                {data: 'item_code'},
                {data: 'name'},
                {data: 'purchase_price'},
                {data: 'action', orderable: false},
            ]
        });
    });

    function showItem() {
        $('#modalItem').modal('show');
    }

    function hideItem() {
        $('#modalItem').modal('hide');
    }

    function chooseItem(id, kode) {
        hideItem();
        $.get("<?= base_url('purchase') ?>" + "/" + id + '/item', function(data) {
            console.log(data)
            console.log(data.aksi)

            var tr = document.createElement("tr");
            for (var i = 0; i < 7; i++) {
                console.log(data)
                var td = document.createElement("td");
                td.innerHTML = data[i];
                tr.appendChild(td);
            }

            document.getElementById("table-order").appendChild(tr);
        });
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