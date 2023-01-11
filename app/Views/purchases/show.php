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
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                        <input type="hidden" name="purchase_id" id="purchase_id" value="<?= $purchase->id ?>">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="vendor">Vendor <span class="text-danger">*</span></label>
                                    <select name="vendor" id="vendor" placeholder="Vendor/Supplier" class="form-control form-control-sm">
                                        <option selected disabled>Pilih Vendor</option>
                                   
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
                                    <input name="transaction_date" id="transaction_date" type="date" class="form-control form-control-sm" value="<?= $purchase->transaction_date ?>">
                                </div>
                                <div class="position-relative form-group">
                                    <label for="overdue_date" class="">Tgl Jatuh Tempo <span class="text-danger">*</span></label>
                                    <input name="overdue_date" id="overdue_date" type="date" class="form-control form-control-sm" value="<?= $purchase->overdue_date ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="description" class="">Deskripsi</label>
                                    <textarea name="description" id="description" placeholder="Deskripsi..." class="form-control form-control-sm"><?= $purchase->description ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table my-3 table-sm table-hover table-striped" id="table-order">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>No</th>
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
                                            <?php
                                            $no = 1;
                                            foreach ($purchaseDetails as $purchaseDetail) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $purchaseDetail->item_code ?></td>
                                                    <td><?= $purchaseDetail->item_name ?></td>
                                                    <td><?= $purchaseDetail->qty ?></td>
                                                    <td><?= $purchaseDetail->price ?></td>
                                                    <td><?= $purchaseDetail->discount ?></td>
                                                    <td><?= $purchaseDetail->subtotal ?></td>
                                                </tr>
                                            <?php endforeach ?>
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
                                                <td id="subtotal_price"><h6><?= $purchase->subtotal ?></h6></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><h6>Potongan : </h6></td>
                                                <td id="discount_price"><h6><?= $purchase->discount ?></h6></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                    <td colspan="2"><h4>Total</h4></td>
                                                <td id="total_price"><h6><?= $purchase->total_price ?></h6></td>
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
                                        <button class="btn btn-primary btn-sm" id="editPurchase">UBAH PEMBELIAN</button>
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
</script>

<?= $this->endSection() ?>