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
                <div>Data Laporan
                    <div class="page-title-subheading">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-journal"><a href="#">Home</a></li>
                                <li class="breadcrumb-journal active" aria-current="page">Laporan</li>
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
                    <h3 class="card-title">Daftar Akun</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table my-3 table-sm table-hover table-striped" id="datatables">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="3%">Kode</th>
                                    <th width="3%">Nama Akun</th>
                                    <th width="3%">Debit</th>
                                    <th width="3%">Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($accounts as $account) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td style="align-left"><?= $account->code ?></td>
                                    <td><?= $account->name ?></td>
                                    <td class="text-right"><?= $account->debit ?></td>
                                    <td class="text-right"><?= $account->credit ?></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <h3 class="card-title">Data Laporan Neraca</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table my-3 table-sm table-hover table-striped" id="datatables">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Akun</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Asset/Harta</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($assets as $asset) : ?>
                                    <tr>
                                        <td><?= $asset->code . ' | ' . $asset->name ?></td>
                                        <td><?= $asset->debit - $asset->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Total Asset : </b></th>
                                    <th>0</th>
                                </tr>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Liability/Kewajiban</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($liabilities as $liability) : ?>
                                    <tr>
                                        <td><?= $liability->code . ' | ' . $liability->name ?></td>
                                        <td><?= $liability->debit - $liability->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Total Kewajiban : </b></th>
                                    <th>0</th>
                                </tr>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Equity/Modal</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($equities as $equity) : ?>
                                    <tr>
                                        <td><?= $equity->code . ' | ' . $equity->name ?></td>
                                        <td><?= $equity->debit - $equity->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td><b>Pendapatan Periode Ini : </b></td>
                                    <td>312313</td>
                                </tr>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Total Modal : </b></th>
                                    <th>0</th>
                                </tr>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Total Semuanya Harusnya 0 atau Balance</b></th>
                                    <th>0</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <h3 class="card-title">Data Laporan Laba Rugi</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table my-3 table-sm table-hover table-striped" id="datatables">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Akun</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Pendapatan</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($revenues as $revenue) : ?>
                                    <tr>
                                        <td><?= $revenue->code . ' | ' . $revenue->name ?></td>
                                        <td><?= $revenue->debit - $revenue->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Total : </b></th>
                                    <th>0</th>
                                </tr>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Cost Of Sales</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($cost_of_sales as $cost_of_sale) : ?>
                                    <tr>
                                        <td><?= $cost_of_sale->code . ' | ' . $cost_of_sale->name ?></td>
                                        <td><?= $cost_of_sale->debit - $cost_of_sale->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Total : </b></th>
                                    <th>0</th>
                                </tr>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Equity/Modal</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($operational_expenses as $operational_expense) : ?>
                                    <tr>
                                        <td><?= $operational_expense->code . ' | ' . $operational_expense->name ?></td>
                                        <td><?= $operational_expense->debit - $operational_expense->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Total : </b></th>
                                    <th>0</th>
                                </tr>
                                <tr style="color: #fff; background: #0000ff;">
                                    <th><b>Total Laba/Rugi</b></th>
                                    <th>0</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>