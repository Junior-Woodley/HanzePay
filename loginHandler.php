<?php
@require("DBconnection.php");

$emailErr = $wachtwoordErr = "";

if (isset($_POST['inloggen'])) {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    if (empty($email)) {
        $emailErr = "Er moet een email gegeven worden";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Dit is geen correct email adres";
    }

    if (empty($wachtwoord)) {
        $wachtwoordErr = "Er moet een wachtwoord gegeven worden";
    } elseif (strlen($wachtwoord) < 8) {
        $wachtwoordErr = "Het wachtwoord is altijd 8 tekens of langer";
    }

    if (empty($emailErr) && empty($wachtwoordErr)) {
        if (CheckLoginInDB($email, $wachtwoord)) {
            $wachtwoordErr = "Verkeerd wachtwoord of email gegeven";
        } else {
            $userInfo = getUserInfo($email, $wachtwoord);

            $_SESSION['naam'] = $userInfo['name'];
            $_SESSION['email'] = $userInfo['email'];
            $_SESSION['studentnr'] = $userInfo['studentnr'];
            $_SESSION['roll'] = $userInfo['roll'];
            $_SESSION['walletID'] = $userInfo['walletID'];

            header("Location: dashboard.php");
        }
    }
}

function CheckLoginInDB($email, $wachtwoord)
{
    $db = DBconnection::getConnection();

    if ($db->connect_error) {
        var_dump("Connection failed: " . $db->connect_error);
    }

    $sql = "SELECT * FROM user WHERE email='" . $email . "' AND password='" . $wachtwoord . "'";

    $results = $db->query($sql);

    $db = null;

    if ($results->num_rows > 0) {
        return false;
    }

    return true;

}

function getUserInfo($email, $wachtwoord) {
    var_dump($email, $wachtwoord);
    $db = DBconnection::getConnection();

    if ($db->connect_error) {
        var_dump("Connection failed: " . $db->connect_error);
    }

    $sql = "SELECT name, email, studentnr, Rolls_idRolls as 'roll', Wallets_idWallets as 'walletID' FROM user WHERE email='" . $email . "' AND password='" . $wachtwoord . "'";

    $result = $db->query($sql);

    $db = null;

    $row = $result->fetch_assoc();

    return $row;
}



