<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $title ?? 'SIKABU-Pro' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="<?= base_url('template') ?>/main.css" rel="stylesheet">

    <?= $this->renderSection('custom-styles') ?>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?= $this->include('components/navbar') ?>
        <div class="ui-theme-settings">
            <!-- <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
            </button> -->
            <div class="theme-settings__inner">
                <div class="scrollbar-container">
                    
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>

                <?= $this->include('components/sidebar') ?>

            </div>
            <div class="app-main__outer">

                <!-- Value of content -->
                <?= $this->renderSection('content') ?>

                <!-- FOoter -->
                <?= $this->include('components/footer') ?>
            </div>
            <!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
        </div>
    </div>
    <!-- JQuery -->
    <script src="<?= base_url('template')?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('template')?>/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Main JS -->
    <script type="text/javascript" src="<?= base_url('template') ?>/assets/scripts/main.js"></script>

    <?= $this->renderSection('custom-scripts') ?>
</body>

</html>