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
                <a href="<?= base_url('purchase') ?>" data-placement="bottom" class="btn-shadow btn-sm mr-3 btn btn-dark">
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
                                    <label for="vendor">Vendor <span class="text-danger">*</span></label>
                                    <select name="vendor" id="vendor" placeholder="Vendor/Supplier" class="form-control form-control-sm">
                                        <option selected disabled>Pilih Vendor</option>
                                        <?php foreach($vendors as $vendor) : ?>
                                        <option value="<?= $vendor->id ?>"><?= $vendor->name ?></option>
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
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="item">Pilih Item <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Pilih item" aria-label="Pilih item" disabled>
                                        <button type="button" class="btn btn-sm btn-primary form-control" onclick="showItem()">Pilih Item</button>
                                    </div>
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

                        <hr class="border border-primary border-3 opacity-75">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="">
                                    <table class="table table-striped">
                                        <thead>
                                            <th colspan="6" class="text-right"><h4><b>P#000001</b></h4></th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><h6>Sub Total</h6></td>
                                                <td id="subtotal_price"><h6>0</h6></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <div class="position-relative form-group">
                                                        <label for="discount">Potongan
                                                        <div role="group" class="btn-group-sm btn-group btn-group-toggle" data-toggle="buttons">
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="options" id="percent" autocomplete="off" checked="">
                                                                %
                                                            </label>
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="options" id="rupiah" autocomplete="off">
                                                                Rp.
                                                            </label>
                                                        </div>
                                                        </label>
                                                        <input type="text" name="discount_input" id="discount_input" class="form-control form-control-sm ">
                                                    </div>
                                                </td>
                                                <td colspan="2"><h6>Potongan : </h6></td>
                                                <td id="discount_price"><h6>0</h6></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                    <td colspan="2"><h4>Total</h4></td>
                                                <td id="total_price"><h6>0</h6></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <div class="mr-2">
                                        <a href="<?= base_url('purchase') ?>" class="btn btn-secondary btn-sm">CANCEL</a>
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
                {data: 'purchase_price'},
                {data: 'action', orderable: false},
            ]
        });

        $('body').on('click', '#createPurchase', function(e) {
            e.preventDefault();
            $('#createPurchase').attr('disabled', 'disabled');
            $('#createPurchase').html('Simpan ...');

            let discount_price = $('#discount_price').html();
            let subtotal_price = $('#subtotal_price').html();
            let total_price = $('#total_price').html();

            let formData = new FormData($('#itemForm')[0]);

            formData.append('subtotal_price', subtotal_price);
            formData.append('discount_price', discount_price);
            formData.append('total_price', total_price);

            $.ajax({
                data: formData,
                url: "<?= base_url('purchase') ?>",
                contentType : false,
                processData : false,
                type: "POST",
                success: function (data) {
                    $('#createPurchase').removeAttr('disabled');
                    $('#createPurchase').html("Simpan");
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                    });
                    setTimeout(function() {
                        window.location.href = '<?= base_url('purchase') ?>';
                    }, 1000);
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
            $.get("<?= base_url('purchase') ?>" + "/" + id + '/item', function(data) {

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

        $('body').on('input', '.qty', function () {
            let id = $(this).data('id');
            let qty = parseInt($(this).val());

            if (qty < 0) {
                alert('Wajib diisi');
                return;
            }

            $.post("<?= base_url('purchase') ?>" + "/" + id + '/check-stock', {
                qty: qty
            })
            .done(data => {
                console.log(data)
                $(this).removeClass('is-invalid')
            })
            .fail(response => {
                const data = (response.responseJSON)
                toastr.error(data.message);
                $(this).addClass('is-invalid')
            });

            let purchasePrice = $('.purchase_price[data-id=' + id + ']').val();
            let discount = $('.discount[data-id=' + id + ']').val() / 100;
            let subtotal;
            if (discount > 0) {
                subtotal = (qty * purchasePrice) - (qty * purchasePrice * discount);
            } else {
                subtotal = qty * purchasePrice;
            }
            $(`.subtotal[data-id="${id}"]`).val(subtotal);

            let subtotalPrice = 0;
            $('.subtotal').each(function () {
                subtotalPrice += parseInt($(this).val());
            });

            $(`#subtotal_price`).html(subtotalPrice);
            $(`#total_price`).html(subtotalPrice);
        });

        $('body').on('input', '.purchase_price', function () {
            let id = $(this).data('id');
            let purchasePrice = parseInt($(this).val());

            if (purchasePrice < 0) {
                alert('Wajib diisi');
                return;
            }

            let qty = $('.qty[data-id=' + id + ']').val();
            let discount = $('.discount[data-id=' + id + ']').val() / 100;

            let subtotal;
            if (discount > 0) {
                subtotal = (qty * purchasePrice) - (qty * purchasePrice * discount);
            } else {
                subtotal = qty * purchasePrice;
            }
            $(`.subtotal[data-id="${id}"]`).val(subtotal);
        });

        $('body').on('input', '.discount', function () {
            let id = $(this).data('id');
            let discount = parseInt($(this).val()) / 100;

            if (!discount < 1 || !discount > 100) {
                alert('Discount must be a number between 1 and 100');
                return;
            }

            let qty = $('.qty[data-id=' + id + ']').val();
            let purchasePrice = $('.purchase_price[data-id=' + id + ']').val();
            let subtotal;
            if (discount > 0) {
                subtotal = (qty * purchasePrice) - (qty * purchasePrice * discount);
            } else {
                subtotal = qty * purchasePrice;
            }
            $(`.subtotal[data-id="${id}"]`).val(subtotal);
        });

        $('body').on('input', '#discount_input', function () {
            let discount_input = parseInt($(this).val());
            
            let subtotalPrice = parseInt($('#subtotal_price').text());
            console.log(subtotalPrice)
            const totalPrice = subtotalPrice - discount_input
            $(`#discount_price`).html(discount_input);
            $(`#total_price`).html(totalPrice);
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