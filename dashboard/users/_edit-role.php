<?php

if (isset($_POST['edit-role'])) {

    require "../includes/dbh.php";

    $userId = $_POST['id'];
    $userRole = $_POST['user-role'];


    $sql = "SELECT idUsers FROM users WHERE idUsers=?";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./?error=sqlnoprepare");
        exit();
    }
    get the user and remove it 
    else {
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);

        // Check result from DB and store it in stmt variable
        mysqli_stmt_store_result($stmt);

        // Check how many rows we had as a result
        $resultCheck = mysqli_stmt_num_rows($stmt);

        if ($resultCheck == 0) {
            header("Location: ./?error=usernoexist");
            exit();
        } else {
            $sql = "UPDATE users set roleUsers=? WHERE idUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ./?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $userRole, $userId);
                mysqli_stmt_execute($stmt);
                header("Location: ./?rolechange=success");
                exit();
            }
        }
    }
} else {
    header("Location: /");
    exit();
}