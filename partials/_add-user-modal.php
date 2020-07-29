<div class="modal"id="add-user-modal">
    <div class="modal-background" id="add-user-modal-bg"></div>
    <div class="modal-content">
        <h2 class="title is-3">Add User</h2>
        <form action="/dashboard/users/_add-user.php" method="POST" class="register-form">
            <div class="field">
                <label for="mail">Email</label>
                <div class="control">
                    <input class="input" type="email" name="mail" placeholder="Email address.." required />
                </div>
            </div>
            <?php include "F:\laragon\www\dashboard\partials\_form.php"; ?>
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
            <button class="button is-danger" id="add-user-cancel">Cancel</button>
        </form>
        
    </div>
</div>
