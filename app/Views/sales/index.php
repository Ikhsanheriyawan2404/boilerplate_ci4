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
                <div>Data Sales/Penjualan
                    <div class="page-title-subheading">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
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
                    <h3 class="card-title">Data Penjualan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table my-3 table-sm table-hover table-striped" id="datatables">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="3%">No</th>
                                    <th>Tanggal</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Customer</th>
                                    <th>Status</th>
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
        ajax: '<?= base_url('sale/datatables'); ?>',
        order: [],
        columns: [
            {data: 'no', orderable: false},
            {data: 'date'},
            {data: 'description'},
            {data: 'document'},
            {data: 'customer'},
            {data: 'status'},
            {data: 'action', orderable: false},
        ]
    });

    $('body').on('click', '#showDetails', function() {
        var sales_id = $(this).data('id');
        $('#modal-md').modal('show');
        $.get("<?= base_url('sale') ?>" + '/' + sales_id + '/sales-detail', function(data) {
            $.each(data, function (key, value) {
                $('#sales_id').val(value.id);
                $('#transaction_date').html(value.transaction_date);
                $('#overdue_date').html(value.overdue_date);
                $('#payment_date').html(value.payment_date);
                $('#sales_desc').html(value.description);
                $('tbody#sales').append(`<tr class="sales">
                    <td>${value.item_name}</td>
                    <td>${value.qty}</td>
                    <td>${value.total_price}</td>
                </tr>`);
            })
        })
        $('tr.sales').remove();

        $.get("<?= base_url('sale') ?>" + '/' + sales_id + '/journal-detail', function(data) {
            $.each(data, function (key, value) {
                $('#sales_id').val(value.id);
                $('#transaction_number').html(value.transaction_number);
                $('#journal_date').html(value.date);
                $('#journal_desc').html(value.description);
                $('tbody#journal').append(`<tr class="journal">
                    <td>${value.transaction_number}</td>
                    <td>${value.name}|${value.account_code}</td>
                    <td>${value.debit}</td>
                    <td>${value.credit}</td>
                </tr>`);
            })
        })
        $('tr.journal').remove();
    });
});
</script>

<!-- Modal -->
<div class="modal fade" id="modal-md" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h4>Sales Detail</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Tanggal : <i id="transaction_date"></i></li>
                            <li class="list-group-item">Tanggal Jatuh Tempo : <i id="overdue_date"></i></li>
                            <li class="list-group-item">Tanggal Pembayaran : <i id="payment_date"></i></li>
                            <li class="list-group-item">Description : <i id="sales_desc"></i></li>
                        </ul>
                    </div>
                </div>
                <table class="table table-sm table-bordered table-striped">
                    <thead class="bg-navy">
                        <tr>
                            <th>Item Name</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="sales">

                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h4>Jurnal Detail</h4>
                    </div>
                </div>
                <table class="table table-sm table-bordered table-striped">
                    <thead class="bg-navy">
                        <tr>
                            <th>No Jurnal</th>
                            <th>Nama|Kode</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                    </thead>
                    <tbody id="journal">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>