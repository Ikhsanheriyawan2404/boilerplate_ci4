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
                                <?php
                                $totalAsset = 0;
                                foreach ($assets as $asset) : ?>
                                    <tr>
                                        <td><?= $asset->code . ' | ' . $asset->name ?></td>
                                        <td><?= number_format($asset->saldo) ?></td>
                                    </tr>
                                <?php
                                $totalAsset += $asset->saldo;
                                endforeach ?>
                                <tr>
                                    <th><b>Total Asset : </b></th>
                                    <th><?= number_format($totalAsset) ?></th>
                                </tr>
                                <tr>
                                    <th><b>Liability/Kewajiban</b></th>
                                    <th></th>
                                </tr>
                                <?php 
                                $totalLiability = 0;
                                foreach ($liabilities as $liability) : ?>
                                    <tr>
                                        <td><?= $liability->code . ' | ' . $liability->name ?></td>
                                        <td><?= number_format($liability->saldo) ?></td>
                                    </tr>
                                <?php
                                $totalLiability += $liability->saldo; 
                                endforeach ?>
                                <tr>
                                    <th><b>Total Kewajiban : </b></th>
                                    <th><?= number_format($totalLiability) ?></th>
                                </tr>
                                <tr>
                                    <th><b>Equity/Modal</b></th>
                                    <th></th>
                                </tr>
                                <?php
                                $totalEquity = 0; 
                                foreach ($equities as $equity) : ?>
                                    <tr>
                                        <td><?= $equity->code . ' | ' . $equity->name ?></td>
                                        <td><?= number_format($equity->saldo) ?></td>
                                    </tr>
                                <?php
                                $totalEquity += $equity->saldo; 
                                endforeach ?>
                                <tr>
                                    <th><b>Total Modal : </b></th>
                                    <th><?= number_format($totalEquity) ?></th>
                                </tr>
                                <tr>
                                    <th><b>Total Modal & Kewajiban : </b></th>
                                    <th><?= number_format($totalEquity + $totalLiability) ?></th>
                                </tr>
                                <tr>
                                    <th><b>Balance Sheet</b></th>
                                    <th><?= number_format($totalEquity + $totalLiability - $totalAsset) ?></th>
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
                                <?php
                                $totalRevenue = 0; 
                                foreach ($revenues as $revenue) : ?>
                                    <tr>
                                        <td><?= $revenue->code . ' | ' . $revenue->name ?></td>
                                        <td><?= number_format($revenue->saldo) ?></td>
                                    </tr>
                                <?php 
                                $totalRevenue += $revenue->saldo;
                                endforeach ?>
                                <tr>
                                    <th><b>Total : </b></th>
                                    <th><?= number_format($totalRevenue) ?></th>
                                </tr>
                                <tr>
                                    <th><b>Cost Of Sales</b></th>
                                    <th></th>
                                </tr>
                                <?php
                                $totalCostOfSales = 0;
                                foreach ($cost_of_sales as $cost_of_sale) : ?>
                                    <tr>
                                        <td><?= $cost_of_sale->code . ' | ' . $cost_of_sale->name ?></td>
                                        <td><?= number_format($cost_of_sale->saldo) ?></td>
                                    </tr>
                                <?php
                                $totalCostOfSales += $cost_of_sale->saldo;
                                endforeach ?>
                                <tr>
                                    <th><b>Total : </b></th>
                                    <th><?= number_format($totalCostOfSales) ?></th>
                                </tr>
                                <tr>
                                    <th><b>Total Laba/Rugi</b></th>
                                    <th></th>
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
                                    <th width="3%">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($accounts as $account) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td style="align-left"><?= $account->code ?></td>
                                    <td><?= $account->name ?></td>
                                    <td class="text-right"><?= $account->saldo !== null ? number_format($account->saldo) : 0 ?></td>
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