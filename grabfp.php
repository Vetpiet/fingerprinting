<?php
    session_start();

    $fpUrl = $_GET['png'];

    $_SESSION["hashedfingerprint"] = hash('sha256', $fpUrl);

    echo $_SESSION['hashedfingerprint'];
