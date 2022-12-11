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
                <a href="<?= base_url('contact') ?>">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Contacts
                </a>
            </li>
            <li>
                <a href="<?= base_url('account') ?>">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Chart Of Accounts
                </a>
            </li>
            <li class="app-sidebar__heading">UI Components</li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Elements
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="elements-buttons-standard.html">
                            <i class="metismenu-icon"></i>
                            Buttons
                        </a>
                    </li>
                    <li>
                        <a href="elements-dropdowns.html">
                            <i class="metismenu-icon">
                            </i>Dropdowns
                        </a>
                    </li>
                    <li>
                        <a href="elements-icons.html">
                            <i class="metismenu-icon">
                            </i>Icons
                        </a>
                    </li>
                    <li>
                        <a href="elements-badges-labels.html">
                            <i class="metismenu-icon">
                            </i>Badges
                        </a>
                    </li>
                    <li>
                        <a href="elements-cards.html">
                            <i class="metismenu-icon">
                            </i>Cards
                        </a>
                    </li>
                    <li>
                        <a href="elements-list-group.html">
                            <i class="metismenu-icon">
                            </i>List Groups
                        </a>
                    </li>
                    <li>
                        <a href="elements-navigation.html">
                            <i class="metismenu-icon">
                            </i>Navigation Menus
                        </a>
                    </li>
                    <li>
                        <a href="elements-utilities.html">
                            <i class="metismenu-icon">
                            </i>Utilities
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-car"></i>
                    Components
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="components-tabs.html">
                            <i class="metismenu-icon">
                            </i>Tabs
                        </a>
                    </li>
                    <li>
                        <a href="components-accordions.html">
                            <i class="metismenu-icon">
                            </i>Accordions
                        </a>
                    </li>
                    <li>
                        <a href="components-notifications.html">
                            <i class="metismenu-icon">
                            </i>Notifications
                        </a>
                    </li>
                    <li>
                        <a href="components-modals.html">
                            <i class="metismenu-icon">
                            </i>Modals
                        </a>
                    </li>
                    <li>
                        <a href="components-progress-bar.html">
                            <i class="metismenu-icon">
                            </i>Progress Bar
                        </a>
                    </li>
                    <li>
                        <a href="components-tooltips-popovers.html">
                            <i class="metismenu-icon">
                            </i>Tooltips &amp; Popovers
                        </a>
                    </li>
                    <li>
                        <a href="components-carousel.html">
                            <i class="metismenu-icon">
                            </i>Carousel
                        </a>
                    </li>
                    <li>
                        <a href="components-calendar.html">
                            <i class="metismenu-icon">
                            </i>Calendar
                        </a>
                    </li>
                    <li>
                        <a href="components-pagination.html">
                            <i class="metismenu-icon">
                            </i>Pagination
                        </a>
                    </li>
                    <li>
                        <a href="components-scrollable-elements.html">
                            <i class="metismenu-icon">
                            </i>Scrollable
                        </a>
                    </li>
                    <li>
                        <a href="components-maps.html">
                            <i class="metismenu-icon">
                            </i>Maps
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="tables-regular.html">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Tables
                </a>
            </li>
            <li class="app-sidebar__heading">Widgets</li>
            <li>
                <a href="dashboard-boxes.html">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Dashboard Boxes
                </a>
            </li>
            <li class="app-sidebar__heading">Forms</li>
            <li>
                <a href="forms-controls.html">
                    <i class="metismenu-icon pe-7s-mouse">
                    </i>Forms Controls
                </a>
            </li>
            <li>
                <a href="forms-layouts.html">
                    <i class="metismenu-icon pe-7s-eyedropper">
                    </i>Forms Layouts
                </a>
            </li>
            <li>
                <a href="forms-validation.html">
                    <i class="metismenu-icon pe-7s-pendrive">
                    </i>Forms Validation
                </a>
            </li>
            <li class="app-sidebar__heading">Charts</li>
            <li>
                <a href="charts-chartjs.html">
                    <i class="metismenu-icon pe-7s-graph2">
                    </i>ChartJS
                </a>
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