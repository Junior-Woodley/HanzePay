<?php include 'partials/header.php' ?>

    <body>
    <div class="container mt-3 mb-3">
        <div class="col-md-12 justify-content-center d-flex">
            <div class="col-md-6 col-xs-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <!-- Default form register -->
                        <form class="text-center p-5">

                            <p class="h4 mb-4">Aanmelden</p>

                            <div class="form-row mb-4">
                                <div class="col">
                                    <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="Voornaam">
                                </div>
                                <div class="col">
                                    <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Achternaam">
                                </div>
                            </div>

                            <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail">

                            <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Wachtwoord" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                            <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                Minstens 8 karakters
                            </small>

                            <input type="text" id="defaultRegisterPhonePassword" class="form-control" placeholder="Studentnummer" aria-describedby="defaultRegisterFormPhoneHelpBlock">
                            <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
                                Te vinden op je studentenpas
                            </small>

                            <button class="btn btn-hanze btn-rounded my-4 btn-block" type="submit">Aanmelden</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

<?php include 'partials/footer.php'; ?>