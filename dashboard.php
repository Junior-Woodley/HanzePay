<?php include 'partials/header.php';
@require("functions/functions.php");
?>

    <body>
    <div class="container mt-3 mb-3">
        <div class="col-md-12 col-xs-12 p-3">
            <h4 class="greeting">Welkom, <?php echo $_SESSION['naam']?></h4>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Uw HanzePay Saldo</h5>
                        <p class="card-text">
                        <h3 class="balance-text"><?php echo getSaldo($_SESSION['user_id']) ?></h3>
                        <sup class="xs-text">hanzepay credits</sup>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xs-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <a href="overmaken.php" class="btn btn-hanze btn-rounded">Overmaken</a>
                        <a href="#" class="btn btn-hanze btn-rounded">Aanvragen</a>
                        <a href="#" class="btn btn-hanze btn-rounded">Klussen</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 col-xs-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Recente activiteit</h5>
                        <?php getRecentactivity($_SESSION['user_id']); ?>
                        <div class="transaction-row p-2">
                            <div class="row">
                                <div class="col-md-2 col-3 text-center float-left">
                                <span class="transfer-datum">
                                26 SEPT
                                </span>
                                </div>
                                <div class="col-md-6 col-5 float-left p-1">
                                    <h5 class="transfer-text">Kantine</h5>
                                    <sup class="xs-text">Betaald</sup>
                                </div>
                                <div class="col-md-4 col-4 text-right">
                                    - <?php echo mt_rand(100,1000)?> HP
                                </div>
                            </div>
                        </div>
                        <div class="transaction-row p-2">
                            <div class="row">
                                <div class="col-md-2 col-3 text-center float-left">
                                <span class="transfer-datum">
                                26 SEPT
                                </span>
                                </div>
                                <div class="col-md-6 col-5 float-left p-1">
                                    <h5 class="transfer-text">Kantine</h5>
                                    <sup class="xs-text">Betaald</sup>
                                </div>
                                <div class="col-md-4 col-4 text-right">
                                    - <?php echo mt_rand(100,1000)?> HP
                                </div>
                            </div>
                        </div>
                        <div class="transaction-row p-2">
                            <div class="row">
                                <div class="col-md-2 col-3 text-center float-left">
                                <span class="transfer-datum">
                                26 SEPT
                                </span>
                                </div>
                                <div class="col-md-6 col-5 float-left p-1">
                                    <h5 class="transfer-text">Kantine</h5>
                                    <sup class="xs-text">Betaald</sup>
                                </div>
                                <div class="col-md-4 col-4 text-right">
                                    - <?php echo mt_rand(100,1000)?> HP
                                </div>
                            </div>
                        </div>
                        <div class="transaction-row p-2">
                            <div class="row">
                                <div class="col-md-2 col-3 text-center float-left">
                                <span class="transfer-datum">
                                26 SEPT
                                </span>
                                </div>
                                <div class="col-md-6 col-5 float-left p-1">
                                    <h5 class="transfer-text">Kantine</h5>
                                    <sup class="xs-text">Betaald</sup>
                                </div>
                                <div class="col-md-4 col-4 text-right">
                                    - <?php echo mt_rand(100,1000)?> HP
                                </div>
                            </div>
                        </div>
                        <div class="transaction-row p-2">
                            <div class="row">
                                <div class="col-md-2 col-3 text-center float-left">
                                <span class="transfer-datum">
                                26 SEPT
                                </span>
                                </div>
                                <div class="col-md-6 col-5 float-left p-1">
                                    <h5 class="transfer-text">Kantine</h5>
                                    <sup class="xs-text">Betaald</sup>
                                </div>
                                <div class="col-md-4 col-4 text-right">
                                    - <?php echo mt_rand(100,1000)?> HP
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xs-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Vragen?</h5>
                        <p class="card-text">
                            Indien u vragen heeft bezoek dan onze <a href="contact.php">contact</a> pagina.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

<?php include 'partials/footer.php';