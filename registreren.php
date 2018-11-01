<?php include 'partials/header.php' ?>

<?php include 'registrerenHandler.php' ?>

    <body>
    <div class="container mt-3 mb-3">
        <div class="col-md-12 justify-content-center d-flex">
            <div class="col-md-6 col-xs-6 mb-3">
                <div class="card">
                        <!-- Default form register -->
                        <form method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                              class="text-center p-5">

                            <p class="h4 mb-4">Aanmelden</p>

                            <div class="form-row mb-4">
                                <div class="col">
                                    <input type="text" id="defaultRegisterFormFirstName" class="form-control"
                                           placeholder="Voornaam" name="voornaam">
                                    <span class="error"> <?php echo $voornaamErr; ?></span>
                                </div>
                                <div class="col">
                                    <input type="text" id="defaultRegisterFormLastName" class="form-control"
                                           placeholder="Achternaam" name="achternaam">
                                    <span class="error"> <?php echo $achternaamErr; ?></span>
                                </div>
                            </div>

                                <input type="email" id="defaultRegisterFormEmail" class="form-control mt-4"
                                       placeholder="E-mail" name="email">
                                <span class="error"> <?php echo $emailErr; ?></span>

                                <input type="password" id="defaultRegisterFormPassword" class="form-control mt-4"
                                       placeholder="Wachtwoord" aria-describedby="defaultRegisterFormPasswordHelpBlock"
                                       name="wachtwoord">
                                <span class="error"> <?php echo $wachtwoordErr; ?></span>
                                <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted">
                                    Minstens 8 karakters
                                </small>


                            <input type="text" id="defaultRegisterPhonePassword" class="form-control mt-4"
                                   placeholder="Studentnummer" aria-describedby="defaultRegisterFormPhoneHelpBlock"
                                   name="studentnummer">
                            <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted">
                                Te vinden op je studentenpas
                            </small>
                            <span class="error"> <?php echo $studentnummerErr; ?></span>

                            <div class="form-control mt-4">
                            <input type="radio" name="geslacht" value="man"> Man
                            <input type="radio" name="geslacht" value="vrouw"> Vrouw
                            </div>

                            <span class="error"> <?php echo $geslachtErr; ?></span>

                            <button class="btn btn-hanze btn-rounded my-4 btn-block" type="submit" name="registreren">
                                Aanmelden
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

<?php include 'partials/footer.php'; ?>