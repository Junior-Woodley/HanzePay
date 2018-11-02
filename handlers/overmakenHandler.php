<?php

@require ("./functions/functions.php");

$ontvangerEmailErr = $aantalErr = $beschrijvingErr = "";

if (isset($_POST['overmaken'])) {

    $ontvangerEmail = $_POST['ontvangerEmail'];
    $aantal = $_POST['aantal'];
    $beschrijving = $_POST['beschrijving'];

    // Geeft een error als er:
    // Geen geldige waarde is ingevult
    if(!isset($aantal) || $aantal == 0) {
        $aantalErr = "Er moet een geldig aantal worden aangegeven";
    }

    if (empty($aantalErr)) {
        if (getSaldo($_SESSION['user_id']) >= $aantal) {
            removeSaldo($aantal);
            transferSaldo($aantal, $ontvangerEmail, $beschrijving, $_SESSION['email']);
        } else {
            $aantalErr = "Je hebt niet genoeg saldo";
        }
    }

}

function removeSaldo($aantal) {
    
    echo "Ik ga $aantal saldo afschrijven bij " . $_SESSION['naam'];
}

function transferSaldo($aantal, $ontvangerEmail, $beschrijving, $email) {
    echo "Ik $email ga $aantal overmaken naar $ontvangerEmail en wil dit er bij zeggen: $beschrijving";
}