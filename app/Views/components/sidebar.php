<?php $uri = current_url(true); ?>
<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Dashboards</li>
            <li>
                <a href="<?= site_url() ?>" class="mm-active">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Dashboard
                </a>
            </li>
            <li class="app-sidebar__heading">Menu</li>
            <?php if (has_permission('developer-module')) : ?>
            <li>
                <a href="#" class="<?= $uri->getSegment(1) == 'company' ? 'mm-active' : '' ?>">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Organisasi
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul class="<?= $uri->getSegment(1) === 'company' ? 'mm-show' : '' ?>">
                    <li>
                        <a href="<?= base_url('company') ?>" class="<?= $uri->getSegment(1) === 'company' ? 'mm-active' : '' ?>">
                            <i class="metismenu-icon"></i>
                            Perusahaan
                        </a>
                    </li>
                    <li>
                    <a href="<?= site_url('store') ?>">
                            <i class="metismenu-icon"></i>
                            Store
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('contact') ?>">
                            <i class="metismenu-icon"></i>
                            User
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif ?>
            <?php if (has_permission('developer-module')) : ?>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Management Users
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="<?= site_url('user') ?>">
                            <i class="metismenu-icon"></i>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('group') ?>">
                            <i class="metismenu-icon">
                            </i>Groups
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif ?>
            <?php if (has_permission('client-module')) : ?>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Inventory
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="<?= site_url('item') ?>">
                            <i class="metismenu-icon"></i>
                            Item Master
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('group-item') ?>">
                            <i class="metismenu-icon"></i>
                            Item Group
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('warehouse') ?>">
                            <i class="metismenu-icon"></i>
                            Gudang
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('group') ?>">
                            <i class="metismenu-icon"></i>
                            List Harga Item
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif ?>
            <?php if (has_permission('client-module')) : ?>
            <li>
                <a href="<?= base_url('purchase') ?>">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Purchases Order
                </a>
            </li>
            <?php endif ?>
            <?php if (has_permission('client-module')) : ?>
            <li>
                <a href="<?= base_url('sale') ?>">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Sales Order
                </a>
            </li>
            <?php endif ?>
            <?php if (has_permission('client-module')) : ?>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Business Partners
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="<?= site_url('customer') ?>">
                            <i class="metismenu-icon"></i>
                            Pelanggan
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('vendor') ?>">
                            <i class="metismenu-icon"></i>
                            Vendor
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif ?>
            <?php if (has_permission('client-module')) : ?>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Accounting
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="<?= site_url('account') ?>">
                            <i class="metismenu-icon"></i>
                            Chart Of Accounts
                        </a>
                    </li>
                    <li> 
                        <a href="<?= site_url('journal') ?>">
                            <i class="metismenu-icon"></i>
                            Jurnal Entry
                        </a>
                    </li>
                </ul>
            </li>
            <?php endif ?>
            <?php if (has_permission('client-module')) : ?>
            <li>
                <a href="<?= base_url('report') ?>">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Report
                </a>
            </li>
            <?php endif ?>
            <li class="app-sidebar__heading">PRO Version</li>
            <li>
                <form id="logout-form" action="<?= base_url('logout') ?>" method="post">
                    <?= csrf_field() ?>
                </form>
                <a onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="metismenu-icon pe-7s-graph2"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>