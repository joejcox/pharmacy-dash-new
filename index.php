<?php require "header.php"; ?>

<main class="section landing" id="main" role="main">
    <div class="container">
        <div class="login-container">
            <h2 class="title is-3">
                Pscptnmgr
            </h2>

            <form action="_login.php" method="POST">
                <?php require "./partials/_form.php" ?>
                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-link" name="login-submit">Login</button>
                    </div>
                </div>
            </form>
            <div class="alt-login">Are you a customer? <a href="/customer">Log in here</a></div>
        </div>

</main>

<?php require "footer.php"; ?>