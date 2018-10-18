<?php

@require ("DBconnection.php");

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