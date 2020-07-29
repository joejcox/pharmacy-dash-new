<?php
session_start();
if (isset($_SESSION['userId'])) {
    header("Location: /dashboard/");
    exit();
}
if (isset($_SESSION['id'])) {
    header("Location: /manager/");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.css" />
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>