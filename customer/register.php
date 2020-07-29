<?php require "../header.php"; ?>

<main class="section landing" id="main" role="main">
    <div class="container">
        <div class="login-container">
            <h2 class="title is-4">
                Customer Registration
            </h2>

            <form action="./_customer-signup.php" method="POST">
            <div class="field">
                <div class="control">
                    <input class="input" type="text" name="firstName" placeholder="First Name" required />
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="input" type="text" name="lastName" placeholder="Last Name" required />
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="input" type="email" name="email" placeholder="Your email address" required />
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="input" type="text" name="uid" placeholder="Username" required />
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="input" type="password" name="password" placeholder="Password" required />
                </div>
            </div>
                <div class="field">
                <div class="control">
                    <input class="input" type="password" name="password-repeat" placeholder="Repeat password" required />
                </div>
            </div>
                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-link" name="signup">Register</button>
                    </div>
                </div>
            </form>
            <div class="alt-login">Already have an account? <a href="./">Log In</a></div>
        </div>

</main>

<?php require "../footer.php"; ?>