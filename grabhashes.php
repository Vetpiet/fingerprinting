<?php
    session_start();

    $fpHashes = $_GET['hashes'];

    $_SESSION["hashedfingerprintboth"] = hash('sha256', $fpHashes);

    echo $_SESSION['hashedfingerprintboth'];
