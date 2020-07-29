<?php include "../includes/header.php"; ?>
<?php if (!$_SESSION['userRole']) {
   header("Location: /?error=adminonly");
   exit();
}
?>
<div class="title-with-button">

    <h2 class="title is-2">Customers</h2>
</div>
<hr />
<section class="section filter-section">
    <input type="text" class="input is-medium user-filter-search" placeholder="Search customers..." id="customerSearch" />
</section>
<section class="section content-area">

    <?php // Print out the users, their email and their roles. Have an option box to change the role of the user.

    
    require $path . "dashboard/includes/dbh.php";

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $users = mysqli_query($conn, "SELECT * FROM customers WHERE customer_id");


    echo '<table class="table" id="customers-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>';

    while ($row = mysqli_fetch_array($users)) {

        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $userName = $row['customer_uid'];
        $userEmail = $row['customer_email'];

        echo "
            <tr>
                <td>{$firstName} {$lastName}</td>
                <td>{$userName}</td>
                <td>{$userEmail}</td>
            ";
    }

    echo '</tbody></table>';

    mysqli_close($conn);
    ?>

</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<?php include "../includes/footer.php"; ?>