<?php
@require("./classes/DBconnection.php");

function user_exists($email)
{
    print_r($email);
    $db = DBconnection::getConnection();

    // Check of er een connectie gemaakt is
    if ($db->connect_error) {
        var_dump("Connection failed: " . $db->connect_error);
    }

    // Haal alles users met het $email adres op.
    $sql = "SELECT count(*) as c FROM users WHERE email='" . $email . "'";
    $results = $db->query($sql);

    $db = null;

    if ($results) {
        $result = ($results->fetch_assoc());

        if ($result['c'] >= 1) {
            // Als de user niet bestaat dan return false.
            return false;
        } else {
            // Als de user wel bestaat dan return true.
            return true;
        }
    } else {
        die("Unable to run");
    }
}

function getEmailList()
{
    $db = DBconnection::getConnection();
    $emails = [];

    if ($db->connect_error) {
        var_dump("Connection failed: " . $db->connect_error);
    }

    $sql = "SELECT email FROM users ORDER BY email";
    $results = $db->query($sql);

    $db = null;

    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            if (isset($_SESSION['email'])) {
                if ($row['email'] != $_SESSION['email']) {
                    array_push($emails, $row['email']);
                }
            } else {
                array_push($emails, $row['email']);
            }
        }
    }

    print_r($emails);


    return $emails;
}

function getSaldo($user_id) {
    $db = DBconnection::getConnection();

    if ($db->connect_error) {
        var_dump("Connection failed: " . $db->connect_error);
    }

    $sql = "SELECT saldo FROM wallets WHERE idUser='" . $user_id . "'";

    $result = $db->query($sql);

    $db = null;

    $row = $result->fetch_assoc();

    return $row['saldo'];
}

function registreerNieuweUser($naam, $email, $wachtwoord, $studentnummer, $geslacht) {
    // Bouw de query voor het inserten van de user.
    $sql = "INSERT INTO users (name, email, password, studentnr, geslacht)
                VALUES ('" . $naam . "', '" . $email . "','" . $wachtwoord . "','" . $studentnummer . "', '" . $geslacht . "')";

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
}

function transferSaldo($aantal, $ontvangerEmail, $beschrijving, $email) {
    // Maak verbinding met de databases.
    $db = DBconnection::getConnection();

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // sql voor afschrijven overgemaakte bedrag.
    $sqlVerzender = "UPDATE wallets SET saldo = saldo - $aantal WHERE idUser = (SELECT idUser FROM users WHERE email = '".$email."')";

    // sql voor toevoegen overgemaakte bedrag.
    $sqlOntvanger = "UPDATE wallets SET saldo = saldo + $aantal WHERE idUser = (SELECT idUser FROM users WHERE email = '". $ontvangerEmail ."')";

    // Maak sql die de transactie toevoegd.
    $sqlTransactie = "INSERT INTO transactions (description, amount, sender, receiver) VALUES ('". $beschrijving ."', '". $aantal ."', '". $email ."', '". $ontvangerEmail ."')";

    if ($db->query($sqlVerzender) === TRUE) {
        if ($db->query($sqlOntvanger) === TRUE) {
            if ($db->query($sqlTransactie) === TRUE) {
                print_r("Succes volle transactie");
            } else {
                var_dump("Error: " . $sqlTransactie . "<br>" . $db->error);
            }
        } else {
            var_dump("Error: " . $sqlOntvanger . "<br>" . $db->error);
        }
    } else {
        var_dump("Error: " . $sqlVerzender . "<br>" . $db->error);
    }

    // connectie weer sluiten
    $db = null;
}

