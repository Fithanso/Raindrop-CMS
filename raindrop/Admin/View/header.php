<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <link rel="apple-touch-icon" sizes="57x57" href="/raindrop/Admin/View/misc/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/raindrop/Admin/View/misc/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/raindrop/Admin/View/misc/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/raindrop/Admin/View/misc/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/raindrop/Admin/View/misc/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/raindrop/Admin/View/misc/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/raindrop/Admin/View/misc/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/raindrop/Admin/View/misc/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/raindrop/Admin/View/misc/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/raindrop/Admin/View/misc/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/raindrop/Admin/View/misc/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/raindrop/Admin/View/misc/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/raindrop/Admin/View/misc/favicon/favicon-16x16.png">
    <link rel="manifest" href="/raindrop/Admin/View/misc/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/raindrop/Admin/View//ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <title>Админ-панель</title>

    <!-- Bootstrap core CSS -->
    <link href="/raindrop/Admin/Assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- simplelineicons for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">

    <!-- Redactor CSS -->
    <link rel="stylesheet" href="/raindrop/Admin/Assets/js/plugins/redactor/redactor.css">

    <!-- Custom styles for this template -->
    <link href="/raindrop/Admin/Assets/css/dashboard.css" rel="stylesheet">
</head>

<body>
<header>

    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/admin/"><?= $lang->dashboardMain['dashboard']?></a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <?php foreach(Customize::getInstance()->getAdminMenuItems() as $key => $item): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=$item['urlPath']?>">
                                <i class="<?=$item['classIcon']?>"></i>
			                    <?= $lang->dashboardMain[$key]?>
                            </a>
                        </li>
                    <?php endforeach;?>


                </ul>
            </div>

            <div class="right-toolbar">
                <a href="/admin/logout/" class="logout">
                    <i class="icon-logout icons"></i> <?= $lang->dashboardMain['logout']?>
                </a>
            </div>
        </div>
    </nav>
    <div class="bottom-navbar-separator">

    </div>
</header>