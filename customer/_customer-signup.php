<?php

// check if button clicked was add-user name
if (isset($_POST['signup'])) {

    // require DB Connection
    require "../dashboard/includes/dbh.php";

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['uid'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password-repeat'];

    // Check for empty fields incase somebody removes required via dev tools
    if (empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ./register.php?error=emptyfields&firstName=" . $firstName . "&lastName=" . $lastName . "&user=" . $username . "&mail=" . $email);
        exit();
    }
    // Check that email and username are valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ./register.php?error=invalidmailuser");
        exit();
    }
    // Check for invalid email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ./register.php?error=invalidmail&firstName=" . $firstName . "&lastName=" . $lastName . "&user=" . $username);
        exit();
    }
    // Check for valid username
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ./register.php?error=invaliduser&mail=" . $email);
        exit();
    }
    // Check passwords match
    else if ($password !== $passwordRepeat) {
        header("Location: ./register.php?error=passwordnomatch&firstName=" . $firstName . "&lastName=" . $lastName . "&user=" . $username . "&mail=" . $email);
    } else {

        // Safely check username and email doesn't exist in DB using prepared statements
        $sql = "SELECT customer_uid FROM customers WHERE customer_uid=? OR customer_email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./register.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);

            // Check result from DB and store it in stmt variable
            mysqli_stmt_store_result($stmt);

            // Check how many rows we had as a result
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0) {
                header("Location: ./register.php?error=userexists");
                exit();
            } else {
                $sql = "INSERT INTO customers (first_name, last_name, customer_uid, customer_email, customer_pwd) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ./register.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $username, $email, $hashedPwd);
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
