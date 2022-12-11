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
            <li class="app-sidebar__heading">Developer</li>
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
            <li>
                <a href="<?= base_url('purchase') ?>">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Purchases Order
                </a>
            </li>
            <li>
                <a href="<?= base_url('sale') ?>">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Sales Order
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Business Partners
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="<?= site_url('customers') ?>">
                            <i class="metismenu-icon"></i>
                            Pelanggan
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('vendors') ?>">
                            <i class="metismenu-icon"></i>
                            Vendor
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Accounting
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="<?= site_url('accounts') ?>">
                            <i class="metismenu-icon"></i>
                            Chart Of Accounts
                        </a>
                    </li>
                    <li> 
                        <a href="<?= site_url('journals') ?>">
                            <i class="metismenu-icon"></i>
                            Jurnal Entry
                        </a>
                    </li>
                </ul>
            </li>
            <li class="app-sidebar__heading">PRO Version</li>
            <li>
                <a href="https://dashboardpack.com/theme-details/architectui-dashboard-html-pro/" target="_blank">
                    <i class="metismenu-icon pe-7s-graph2">
                    </i>
                    Upgrade to PRO
                </a>
            </li>
        </ul>
    </div>
</div>