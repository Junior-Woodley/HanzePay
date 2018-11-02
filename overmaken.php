<?php include 'partials/header.php';?>

<?php
@include("handlers/overmakenHandler.php");
?>

<body>
<div class="container mt-3 mb-3">
    <div class="col-md-12 justify-content-center d-flex">
        <div class="col-md-6 col-xs-6 mb-3">
            <div class="card">
                <!-- Default form register -->
                <form method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                      class="text-center p-5">

                    <p class="h4 mb-4">Overmaken</p>

                    <select class="form-control mt-4" name="ontvangerEmail">
                        <?php
                            $emails = getEmailList();

                            foreach ($emails as $email) {
                                echo "<option name='ontvangerEmail' value='$email'>$email</option>";
                            }
                        ?>
                    </select>
                    <span class="error"> <?php echo $ontvangerEmailErr; ?></span>

                    <input type="number" name="aantal" step=".01" placeholder="Aantal" class="form-control mt-4">
                    <span class="error"> <?php echo $aantalErr; ?></span>

                    <textarea name="beschrijving" placeholder="Beschrijving" class="form-control mt-4"></textarea>
                    <span class="error"> <?php echo $beschrijvingErr; ?></span>

                    <button class="btn btn-hanze btn-rounded my-4 btn-block" type="submit" name="overmaken">
                        Overmaken
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>

<?php include 'partials/footer.php';