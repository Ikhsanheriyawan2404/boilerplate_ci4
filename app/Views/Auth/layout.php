<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="en" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="../../../../favicon.ico">
    <title>Login - SPBU Pro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="ArchitectUI HTML Bootstrap 4 Dashboard Template" />

    <meta name="msapplication-tap-highlight" content="no" />
    <link href="<?= base_url(); ?>/template/assets/css/main-login.css" rel="stylesheet" />
    <?= $this->renderSection('pageStyles') ?>
</head>


<body>

    <div class="app-container app-theme-white body-tabs-shadow">
        <?= $this->renderSection('main') ?>
    </div>


    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?= base_url(); ?>/template/assets/scripts/main-login.js"></script>
    <?= $this->renderSection('pageScripts') ?>
</body>

</html>