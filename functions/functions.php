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