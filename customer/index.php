<?php require "../header.php"; ?>

<main class="section landing" id="main" role="main">
    <div class="container">
        <div class="login-container">
            <h2 class="title is-3">
                Customer Portal
            </h2>

            <form action="./_customer-login.php" method="POST">
                <?php require "../partials/_form.php" ?>
                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-link" name="login-submit">Log In</button>
                    </div>
                </div>
            </form>
            <div class="alt-login">Don't have an account? <a href="./register.php">Register</a></div>
        </div>

</main>

<?php require "../footer.php"; ?>