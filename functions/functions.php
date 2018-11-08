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

// Haalt een lijst met alle emails behalve van de huidige user als die er is op.
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

// Haalt de saldo van de huidige user op.
function getSaldo($user_id) {
    $db = DBconnection::getConnection();

    checkconnection($db);

    $sql = "SELECT saldo FROM wallets WHERE idUser='" . $user_id . "'";

    $result = $db->query($sql);

    $row = $result->fetch_assoc();

    return $row['saldo'];
}

// Registreert een nieuwe user.
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

// Zet het saldo over bij het overmaken.
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

// Voegt de transactie data aan de database toe. $emailArray = [$verzenderEmail, $ontvangerEmail].
function transactionAdd($beschrijving, $aantal, $emailArray) {
    $walletIds = [];
    $userIds = [];

    $db = DBconnection::getConnection();

    checkconnection($db);

    foreach ($emailArray as $email) {
        $sqlGetUser_id = "SELECT idUser FROM users WHERE email = '" . $email . "'";

        $result2 = $db->query($sqlGetUser_id);

        $id = $result2->fetch_assoc();

        array_push($userIds, $id["idUser"]);
    }

    // Plaats de transactie
    $sqlTransactie = "INSERT INTO transactions (description, amount, sender_user_id, receiver_user_id) VALUES ('". $beschrijving ."', '". $aantal ."', '" . $userIds[0] . "', '" . $userIds[1] . "')";

    if (!$db->query($sqlTransactie)) {
        return false;
    }

    // Haal transactie ID van de geplaatste transactie op.
    $sqlGetTransactionID = "SELECT idTransaction FROM transactions ORDER BY idTransaction DESC LIMIT 1";

    $transactionID = ($db->query($sqlGetTransactionID))->fetch_assoc();
    $transactionID = $transactionID["idTransaction"];

    $i = 0;

    foreach ($emailArray as $email) {
        // Get users wallet_id
        $sqlGetUserWallet_id = "SELECT idWallet FROM wallets WHERE idUser = (SELECT idUser FROM users WHERE email = '" . $email . "')";

        $result1 = $db->query($sqlGetUserWallet_id);

        $id = $result1->fetch_assoc();

        // Verbind de wallets aan de transactie in de DB.
        $sqlTransactieToWallets = "INSERT INTO transaction_has_wallets (transaction_id, wallet_id) VALUES ('" . $transactionID . "' , '" . $id['idWallet'] . "')";

        if ($db->query($sqlTransactieToWallets)) {
            if ($i == 1) {
                return true;
            }
        } else {
            if ($i == 1) {
                return false;
            }
        }

        $i++;
    }
}

// Haalt een lijst van de activiteiten van een user op.
function getRecentActivity($user_id) {
    $db = DBconnection::getConnection();

    checkconnection($db);

    $sqlGetActivity = "SELECT t.idTransaction as 'transactionID', t.amount as 'amount', t.description as 'description' ,DAY(t.createdDate) as 'day', MONTH(t.createdDate) as 'month', YEAR(t.createdDate) as 'year'
                        FROM users u
                        INNER JOIN wallets w ON w.idUser = u.idUser
                        INNER JOIN transaction_has_wallets thw ON thw.wallet_id = w.idWallet
                        INNER JOIN transactions t ON t.idTransaction = thw.transaction_id
                        WHERE w.idUser = '" . $user_id . "'";

    $results = $db->query($sqlGetActivity);

    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
        // Doe dingen met de data
        }
    } else {
        // Geef data terug die zeggen dat er nog geen activiteit heeft plaats gevonden
    }
};

// Haalt betaalverzoeken op
function getPaymentRequest() {

};

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

