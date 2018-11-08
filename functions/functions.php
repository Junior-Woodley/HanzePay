<?php
@require("./classes/DBconnection.php");

function user_exists($email)
{
    $db = DBconnection::getConnection();

    // Check of er een connectie gemaakt is
    checkconnection($db);

    // Haal alles users met het $email adres op.
    $sql = "SELECT count(*) as c FROM users WHERE email='" . $email . "'";
    $results = $db->query($sql);

    $results = checkResultsTrueOrFalse($results);
    return $results;
}

// Checkt of het studentnummer al in gebruik is.
function studentnummer_registerd($studentnummer)
{
    $db = DBconnection::getConnection();

    // Check of er een connectie gemaakt is
    checkconnection($db);

    // Haal alles users met het $email adres op.
    $sql = "SELECT count(*) as c FROM users WHERE studentnr='" . $studentnummer . "'";
    $results = $db->query($sql);

    $results = checkResultsTrueOrFalse($results);
    return $results;
}

function getEmailList()
{
    $db = DBconnection::getConnection();
    $emails = [];

    checkconnection($db);

    $sql = "SELECT email FROM users ORDER BY email";
    $results = $db->query($sql);


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

    return $emails;
}

function getSaldo($user_id) {
    $db = DBconnection::getConnection();

    checkconnection($db);

    $sql = "SELECT saldo FROM wallets WHERE idUser='" . $user_id . "'";

    $result = $db->query($sql);

    $row = $result->fetch_assoc();

    return $row['saldo'];
}

function registreerNieuweUser($naam, $email, $wachtwoord, $studentnummer, $geslacht) {
    $db = DBconnection::getConnection();

    checkconnection($db);

    // Bouw de query voor het inserten van de user.
    $sql = "INSERT INTO users (name, email, password, studentnr, geslacht)
                VALUES ('" . $naam . "', '" . $email . "','" . $wachtwoord . "','" . $studentnummer . "', '" . $geslacht . "')";

    if ($db->query($sql) === TRUE) {
        header("Location: login.php");
        die();
    } else {
        var_dump("Error: " . $sql . "<br>" . $db->error);
    }
}

function transferSaldo($aantal, $ontvangerEmail, $beschrijving, $email) {
    // Maak verbinding met de databases.
    $db = DBconnection::getConnection();

    checkconnection($db);

    // sql voor afschrijven overgemaakte bedrag.
    $sqlVerzender = "UPDATE wallets SET saldo = saldo - $aantal WHERE idUser = (SELECT idUser FROM users WHERE email = '".$email."')";

    // sql voor toevoegen overgemaakte bedrag.
    $sqlOntvanger = "UPDATE wallets SET saldo = saldo + $aantal WHERE idUser = (SELECT idUser FROM users WHERE email = '". $ontvangerEmail ."')";

    // Voer alle queries uit.
    // Eerst het saldo afschrijven.
    if ($db->query($sqlVerzender)) {
        // Ten tweede het saldo bij de ontvanger er bij schrijven.
        if ($db->query($sqlOntvanger)) {
            // Ten derde de transactie noteren.
            $emailArray = [$email, $ontvangerEmail];
            // Als de transactie is geregistreed dan doorwijzen naar het dashboard
            if (transactionAdd($beschrijving, $aantal, $emailArray)) {
                header("Location: dashboard.php");
            } else {
                print_r("Transactie notatie mislukt");
            }
        } else {
            var_dump("Error: " . $sqlOntvanger . "<br>" . $db->error);
        }
    } else {
        var_dump("Error: " . $sqlVerzender . "<br>" . $db->error);
    }
}

// Voegd de transactie data aan de database toe. $emailArray = [$verzenderEmail, $ontvangerEmail].
function transactionAdd($beschrijving,  $aantal, $emailArray) {
    $userIds = [];

    $db = DBconnection::getConnection();

    checkconnection($db);

    // Add transaction data to databases
    // Add transaction link to wallet //  add both wallets
    // Maak sql die de transactie toevoegd.
    $sqlTransactie = "INSERT INTO transactions (description, amount) VALUES ('". $beschrijving ."', '". $aantal ."')";

    if (!$db->query($sqlTransactie)) {
        return false;
    }

    // Haal wallet id van de sender en ontvanger op.
    foreach ($emailArray as $email) {
        // Get users wallet_id
        $sqlGetUserWallet_id = "SELECT idWallet FROM wallets WHERE idUser = (SELECT idUser FROM users WHERE email = '" . $email . "')";

        $result = $db->query($sqlGetUserWallet_id);

        $id = $result->fetch_assoc();

        array_push($userIds, $id["idWallet"]);
    }

    // Haal transactie ID van de geplaatste transactie op.
    $sqlGetTransactionID = "SELECT idTransaction FROM transactions ORDER BY idTransaction DESC LIMIT 1";

    $transactionID = ($db->query($sqlGetTransactionID))->fetch_assoc();
    $transactionID = $transactionID["idTransaction"];

    // Verbind de wallets aan de transactie in de DB.
    $sqlTransactieToWallets = "INSERT INTO transaction_has_wallets (Transaction_id, Wallets_id_Sender, Wallets_id_Receiver) VALUES ('" . $transactionID . "' , '" . $userIds[0] . "' , '" . $userIds[1] . "')";

    if ($db->query($sqlTransactieToWallets)) {
        return true;
    } else {
        return false;
    }
}

// Checkt de verbinding met de databases.
function checkconnection($db) {
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
}

// Geef data of er NULL of meer terug gegeven is.
function checkResultsTrueOrFalse($results) {
    if ($results) {
        $result = ($results->fetch_assoc());

        if ($result['c'] >= 1) {
            // Als de gegeven data niet in de database bestaat dan return false.
            return false;
        } else {
            // Als de gegeven data wel in de database bestaat dan return true.
            return true;
        }
    } else {
        die("Unable to run");
    }
}

