<?php

// check if button clicked was add-user name
if (isset($_POST['add-user'])) {

    // require DB Connection
    require "../includes/dbh.php";

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password-repeat'];
    $role = $_POST['user-role'];

    // Check for empty fields incase somebody removes required via dev tools
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat) || empty($role)) {
        header("Location: ./?error=emptyfields&user=" . $username . "&mail=" . $email);
        exit();
    }
    // Check that email and username are valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ./?error=invalidmailuser");
        exit();
    }
    // Check for invalid email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ./?error=invalidmail&uid=" . $username);
        exit();
    }
    // Check for valid username
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ./?error=invaliduser&mail=" . $email);
        exit();
    }
    // Check passwords match
    else if ($password !== $passwordRepeat) {
        header("Location: ./?error=passwordnomatch&user=" . $username . "&mail=" . $email);
    } else {

        // Safely check username and email doesn't exist in DB using prepared statements
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=? OR emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);

            // Check result from DB and store it in stmt variable
            mysqli_stmt_store_result($stmt);

            // Check how many rows we had as a result
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0) {
                header("Location: ./?error=usernameoremailexists");
                exit();
            } else {
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, roleUsers) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ./?error=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPwd, $role);
                    mysqli_stmt_execute($stmt);
                    header("Location: ./?createuser=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: /");
    exit();
}
