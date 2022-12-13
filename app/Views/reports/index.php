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
                    <h3 class="card-title">Data Laporan Neraca</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table my-3 table-sm table-hover table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Akun</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><b>Asset/Harta</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($assets as $asset) : ?>
                                    <tr>
                                        <td><?= $asset->code . ' | ' . $asset->name ?></td>
                                        <td><?= $asset->debit - $asset->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <th><b>Total Asset : </b></th>
                                    <th><?= $asset->total ?></th>
                                </tr>
                                <tr>
                                    <th><b>Liability/Kewajiban</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($liabilities as $liability) : ?>
                                    <tr>
                                        <td><?= $liability->code . ' | ' . $liability->name ?></td>
                                        <td><?= $liability->credit - $liability->debit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <th><b>Total Kewajiban : </b></th>
                                    <th><?= $liability->total ?></th>
                                </tr>
                                <tr>
                                    <th><b>Equity/Modal</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($equities as $equity) : ?>
                                    <tr>
                                        <td><?= $equity->code . ' | ' . $equity->name ?></td>
                                        <td><?= $equity->credit - $equity->debit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td><b>Pendapatan Periode Ini : </b></td>
                                    <td><?= $revenues[0]->total - $cost_of_sales[0]->total ?></td>
                                </tr>
                                <tr>
                                    <th><b>Total Modal : </b></th>
                                    <th><?= $equity->total + ($revenues[0]->total - $cost_of_sales[0]->total) ?></th>
                                </tr>
                                <tr>
                                    <th><b>Balance Sheet</b></th>
                                    <th><?= $asset->total - ($liability->total + ($equity->total + ($revenues[0]->total - $cost_of_sales[0]->total)))  ?></th>
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
                    <table class="table my-3 table-sm table-hover table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Akun</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><b>Pendapatan</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($revenues as $revenue) : ?>
                                    <tr>
                                        <td><?= $revenue->code . ' | ' . $revenue->name ?></td>
                                        <td><?= $revenue->credit - $revenue->debit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <th><b>Total : </b></th>
                                    <th><?= $revenue->total ?></th>
                                </tr>
                                <tr>
                                    <th><b>Cost Of Sales</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($cost_of_sales as $cost_of_sale) : ?>
                                    <tr>
                                        <td><?= $cost_of_sale->code . ' | ' . $cost_of_sale->name ?></td>
                                        <td><?= $cost_of_sale->debit - $cost_of_sale->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <th><b>Total : </b></th>
                                    <th><?= $cost_of_sale->total ?></th>
                                </tr>
                                <tr>
                                    <th><b>Biaya Operasional</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($operational_expenses as $operational_expense) : ?>
                                    <tr>
                                        <td><?= $operational_expense->code . ' | ' . $operational_expense->name ?></td>
                                        <td><?= $operational_expense->debit - $operational_expense->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <th><b>Total : </b></th>
                                    <th><?= $operational_expense->total ?></th>
                                </tr>
                                <tr>
                                    <th><b>Other Income</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($other_incomes as $other_income) : ?>
                                    <tr>
                                        <td><?= $other_income->code . ' | ' . $other_income->name ?></td>
                                        <td><?= $other_income->debit - $other_income->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <th><b>Total : </b></th>
                                    <th><?= $other_income->total ?></th>
                                </tr>
                                <tr>
                                    <th><b>Other Income</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($other_expenses as $other_expense) : ?>
                                    <tr>
                                        <td><?= $other_expense->code . ' | ' . $other_expense->name ?></td>
                                        <td><?= $other_expense->debit - $other_expense->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <th><b>Total : </b></th>
                                    <th><?= $other_expense->total ?></th>
                                </tr>
                                <tr>
                                    <th><b>Taxes</b></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($taxes as $tax) : ?>
                                    <tr>
                                        <td><?= $tax->code . ' | ' . $tax->name ?></td>
                                        <td><?= $tax->debit - $tax->credit ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <th><b>Total : </b></th>
                                    <th><?= $tax->total ?></th>
                                </tr>
                                <tr>
                                    <th><b>Total Laba/Rugi</b></th>
                                    <th><?= $revenues[0]->total - $cost_of_sales[0]->total ?></th>
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
                    <h3 class="card-title">Daftar Akun</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table my-3 table-sm table-hover table-striped">
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
</div>

<?= $this->endSection() ?>