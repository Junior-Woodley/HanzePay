<?php

@require("DBconnection.php");

$voornaamErr = $achternaamErr = $emailErr = $wachtwoordErr = $studentnummerErr = $geslachtErr = "";
$emptyMsg = "Dit veld is verplicht";
$specialCharMsg = "Dit veld mag geen speciale tekens bevatten";

if (isset($_POST['registreren'])) {
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $studentnummer = $_POST['studentnummer'];
    if (!empty($_POST['geslacht'])) {
        $geslacht = $_POST['geslacht'];
    }

    // Zet error bericht als er:
    // Geen voornaam is mee gegeven.
    // Een spatie in de naam zit.
    // Er speciale leestekens in de naam zitten.
    if (empty($voornaam)) {
        $voornaamErr = $emptyMsg;
    } elseif (preg_match('/\s/', $voornaam)) {
        $voornaamErr = "Je voornaam mag geen spatie bevatten";
    } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $voornaam)) {
        $voornaamErr = $specialCharMsg;
    } elseif (ctype_alnum($voornaam)) {
        $voornaamErr = "Mag alleen letters bevatten";
    }

    // Zet error bericht als er:
    // Geen geslacht is geselecteerd.
    if (empty($geslacht)) {
        $geslachtErr = "Er moet een geslacht worden geselecteerd";
    }

    // Zet error bericht als er:
    // Geen voornaam is mee gegeven.
    // Er speciale leestekens in de naam zitten.
    if (empty($achternaam)) {
        $achternaamErr = $emptyMsg;
    } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $achternaam)) {
        $achternaamErr = $specialCharMsg;
    } elseif (ctype_alnum($achternaam)) {
        $achternaamErr = "Mag alleen letters bevatten";
    }

    // Zet error bericht als er:
    // Geen email is mee gegeven.
    if (empty($email)) {
        $emailErr = $emptyMsg;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Dit is geen correct email adres";
    } elseif (preg_match('/\s/', $email)) {
        $emailErr = "Je email mag geen spatie bevatten";
    }

    // Zet error bericht als er:
    // Geen wachtwoord is mee gegeven.
    // Minder dan 8 karakters in het wachtwoord zitten.
    if (empty($wachtwoord)) {
        $wachtwoordErr = $emptyMsg;
    } elseif (strlen($wachtwoord) < 8) {
        $wachtwoordErr = "Het wacht woord moet 8 of meer karakters bevatten";
    } elseif (preg_match('/\s/', $wachtwoord)) {
        $wachtwoordErr = "Je email mag geen spatie bevatten";
    }

    // Zet error bericht als er:
    // Geen studentnummer is mee gegeven.
    // Geen geldig studentnummer is mee gegeven.
    if ((!empty($studentnummer)) && (strlen($studentnummer) < 6 || strlen($studentnummer) > 6) && is_numeric($studentnummer)) {
        $studentnummerErr = "Dit is geen geldig studentnummer";
    } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $studentnummer)) {
        $studentnummerErr = $specialCharMsg;
    }

    // Als er geen error messages zijn voeg dan de user toe aan de databases
    if (empty($voornaamErr) && empty($achternaamErr) && empty($emailErr) && empty($wachtwoordErr) && empty($studentnummerErr) && empty($geslachtErr)) {

        // Als de gebruiker niet bestaad de user toevoegen.
        if (!user_exists($email)) {
            $naam = $voornaam;
            $naam .= " " . $achternaam;

            // Bouw de query voor het inserten van de user.
            $sql = "INSERT INTO users (name, email, password, studentnr, geslacht)
                VALUES ('" . $naam . "', '" . $email . "','" . md5($wachtwoord) . "','" . $studentnummer . "', '" . $geslacht . "')";

            $db = DBconnection::getConnection();

            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

            if ($db->query($sql) === TRUE) {
                header("Location: login.php");
                die();
            } else {
                var_dump("Error: " . $sql . "<br>" . $db->error);
            }
            // connectie weer sluiten

            $db = null;
        } else {
            $emailErr = "Dit email adres is al geregistreert";
        }

    }
}

function user_exists($email)
{
    $db = DBconnection::getConnection();

    if ($db->connect_error) {
        var_dump("Connection failed: " . $db->connect_error);
    }

    $sql = "SELECT count(*) as c FROM users WHERE email='" . $email . "'";
    $results = $db->query($sql);

    $db = null;

    var_dump($results);
    if (!$results->num_rows < 1) {
        return false;
    } else {
        return true;
    }
}