<?php

if (isset($_POST['login-submit'])) {
    require "../dashboard/includes/dbh.php";

    $username = $_POST['uid'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header("Location: /?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM customers WHERE customer_uid=? OR customer_email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['customer_pwd']);
                if ($pwdCheck == false) {
                    header("Location: ./?error=passwordincorrect");
                    exit();
                } else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION['id'] = $row['customer_id'];
                    $_SESSION['username'] = $row['customer_uid'];
                    $_SESSION['firstName'] = $row['first_name'];
                    header("Location: /manager/");
                    exit();
                } else {
                    header("Location: ./?error=incorrectpassword");
                    exit();
                }
            } else {
                header("Location: ./?error=nousermatch");
                exit();
            }
        }
    }
} else {
    header("Location: ./?error=accessdenied");
    exit();
}
