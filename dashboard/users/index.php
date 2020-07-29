<?php include "../includes/header.php"; ?>
<?php if ($_SESSION['userRole'] !== "Administrator") {
   header("Location: /?error=adminonly");
   exit();
}
?>
<?php include $path . "partials/_add-user-modal.php"; ?>
<div class="title-with-button">

    <h2 class="title is-2"><i class="fas fa-user"></i> User Management</h2>
    <?php include $path . "partials/_add-user-btn.php"; ?>
</div>
<hr />
<?php
require $path . "dashboard/includes/dbh.php";

$admin = mysqli_query($conn, "SELECT roleUsers FROM users WHERE roleUsers = 'Administrator'");
$users = mysqli_query($conn, "SELECT * FROM users where idUsers");
$pharmacists = mysqli_query($conn, "SELECT roleUsers FROM users WHERE roleUsers = 'Pharmacist'");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$numOfAdmins = mysqli_num_rows($admin);
$numOfUsers = mysqli_num_rows($users);
$numOfPharmacists = mysqli_num_rows($pharmacists);

mysqli_free_result($admin);
mysqli_free_result($users);
mysqli_free_result($pharmacists);


?>

<section class="section no-p">
    <div class="columns user-overview">
        <div class="column is-one-third has-text-centered">
            <h4 class="title is-5">Total Users</h4>
            <h5 class="title is-1 overview-count"><?= $numOfUsers ?></h5>
        </div>
        <div class="column is-one-third has-text-centered">
            <h4 class="title is-5">Administrators</h4>
            <h5 class="title is-1 overview-count"><?= $numOfAdmins ?></h5>
        </div>
        <div class="column is-one-third has-text-centered">
            <h4 class="title is-5">Pharmacists</h4>
            <h5 class="title is-1 overview-count"><?= $numOfPharmacists ?></h5>
        </div>
    </div>
</section>
<section class="section filter-section">
    <input type="text" class="input is-medium user-filter-search" placeholder="Search users..." id="tableSearch" />
</section>
<section class="section content-area">

    <?php // Print out the users, their email and their roles. Have an option box to change the role of the user.

    $users = mysqli_query($conn, "SELECT * FROM users WHERE idUsers");

    // Will need to replace all hard coded "administrator" etc and pull the select options from database

    echo '<table class="table" id="users-table">
    <thead>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Manage User</th>
      </tr>
    </thead>
    <tbody>';

    while($row = mysqli_fetch_array($users)) {

        $userId = $row['uidUsers'];
        $userRole = $row['roleUsers'];
        $userEmail = $row['emailUsers'];
        $id = $row['idUsers'];


        echo "
            <tr>
                <td>{$userId}</td>
                <td>{$userEmail}</td>
                <td>{$userRole}</td>
                <td>
                    <div class=\"buttons is-grouped\">
                        <form class=\"form role-switch\" action=\"_edit-role.php\" method=\"POST\" id=\"{$id}\">
                            <input type=\"hidden\" class=\"role-switch-input\" name=\"id\" value=\"{$id}\" />
                            <select class=\"select is-small\" name=\"user-role\" required>
                                <option value=\"\">Change Role</option>
                                <option value=\"Administrator\">Administrator</option>
                                <option value=\"Pharmacist\">Pharmacist</option>
                            </select>
                        <button class=\"button change-role is-small is-link\" name=\"edit-role\" type=\"submit\">Change Role</button>
                        </form>
                    <button class=\"button is-small is-danger delete-btn\">
                        <i class=\"fas fa-times\"></i>
                    </button>
                    <div class=\"modal user-delete\">
                        <div class=\"modal-background\"></div>
                            <div class=\"modal-content\">
                                <h4 class=\"title is-4\">Confirm User Deletion</h3>
                                <p>Are you sure you wish to delete this user?</p>
                                <div class=\"buttons is-grouped\">
                                    <form class=\"form\" action=\"_delete-user.php\" method=\"POST\">
                                        <input type=\"hidden\" name=\"uid\" value=\"{$id}\" />
                                        <button class=\"button is-link\" name=\"delete-user\" type=\"submit\">
                                            Confirm
                                        </button>
                                    </form>
                                    <button class=\"button is-danger cancel\">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            ";
    }


    echo '</tbody></table>';

    mysqli_close($conn);
    ?>

</section>

<script src="../../js/add-user.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<?php include "../includes/footer.php"; ?>