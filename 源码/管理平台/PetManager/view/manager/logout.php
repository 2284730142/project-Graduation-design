<?php
    session_start();
    unset($_SESSION["uName"]);
    unset($_SESSION["Id"]);
    header('location:../../login.php');