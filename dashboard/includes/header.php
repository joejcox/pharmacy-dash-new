<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: /?error=accessdenied");
    exit();
}


$path = $_SERVER['DOCUMENT_ROOT'];
$sidebar = $path . "/sidebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.css" />
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>

    <div class="wrapper">

        <?php
        include_once($sidebar); ?>
        <main role="main" id="main">
            <div class="content">