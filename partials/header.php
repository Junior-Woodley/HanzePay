<?php session_start() ?>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap core CSS -->
<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:regular,bolditalic" rel="stylesheet">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="./css/mdb.min.css" rel="stylesheet">
<link href="./css/style.css" rel="stylesheet"/>


<meta name="viewport" content="width=device-width, initial-scale=1.0">

<nav class="navbar navbar-expand-lg navbar-light white border-bottom border-light py-3">
    <div class="container">
    <a class="navbar-brand" href="index.php">
        <img src="./img/hanzepay-logo.png" height="30" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Ontdek</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
            <?php if(isset($_SESSION['naam'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Mijn Dashboard</a>
            </li>
            <li class="nav-item dropdown show">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-default"
                     aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item waves-effect waves-light" href="#">Mijn profiel</a>
                    <a class="dropdown-item waves-effect waves-light" href="./handlers/logoutHandler.php">Uitloggen</a>
                </div>
            </li>
            <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registreren.php">Registreren</a>
            </li>
            <?php } ?>
        </ul>
    </div>
    </div>
</nav>
