<?php include 'partials/header.php' ?>

    <body>
    <div class="container mt-3 mb-3">
        <div class="col-md-12 justify-content-center d-flex">
            <div class="col-md-6 col-xs-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form class="text-center border border-light p-5">
                            <p class="h4 mb-4">Inloggen</p>
                            <input type="email" id="defaultLoginFormEmail" class="form-control mb-4"
                                   placeholder="E-mail">
                            <input type="password" id="defaultLoginFormPassword" class="form-control mb-4"
                                   placeholder="Wachtwoord">

                            <div class="d-flex justify-content-around">
                                <div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="defaultLoginFormRemember">
                                        <label class="custom-control-label" for="defaultLoginFormRemember">Onthoud
                                            mij</label>
                                    </div>
                                </div>
                                <div>
                                    <a href="">Wachtwoord vergeten</a>
                                </div>
                            </div>
                            <button class="btn btn-hanze btn-block my-4" type="submit">Inloggen</button>
                            <p>Nog geen lid?
                                <a href="registreren.php">Registreren</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

<?php include 'partials/footer.php';