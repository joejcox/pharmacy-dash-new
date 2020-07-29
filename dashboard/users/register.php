<?php include "../includes/header.php"; ?>
<?php
if ($_SESSION['userRole'] == "Moderator") {
    header("Location: /dashboard?error=rolerestricted");
    exit();
}
?>
<h2 class="title is-2">Create User</h2>

<hr />

<section class="section content-area">
    <form action="./_add-user.php" method="POST" class="register-form">
        <div class="field">
            <label for="mail">Email</label>
            <div class="control">
                <input class="input" type="email" name="mail" placeholder="Email address.." required />
            </div>
        </div>
        <?php include "../../partials/_form.php"; ?>
        <div class="field">
            <label for="password-repeat">Repeat Password:</label>
            <div class="control">
                <input class="input" type="password" name="password-repeat" placeholder="Repeat Password" required />
            </div>
        </div>
        <div class="field">
            <label for="user-role">Role</label>
            <div class="control is-expanded">
                <div class="select is-fullwidth">
                    <select name="user-role" required>
                        <option value="">Select Role</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Pharmacist">Pharmacist</option>
                    </select>
                </div>
            </div>
        </div>
        <button class="button is-link" type="submit" name="add-user">Add User</button>
    </form>
</section>


<?php include "../includes/footer.php"; ?>