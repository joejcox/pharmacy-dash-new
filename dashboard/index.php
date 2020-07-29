<?php include "./includes/header.php"; ?>
<div class="title-with-button">
    <h2 class="title is-2">Overview</h2>
    <?php if ($_SESSION['userRole'] == "Administrator") {
        echo '<a href="/dashboard/users/" class="button is-link is-outlined">Manage Users</a>';
    }
    ?>
</div>
<hr />

<section class="section content-area">

    <h4 class="title is-5">New Prescriptions</h4>
    <h5 class="title is-1">0</h5>


</section>
<?php include "./includes/footer.php"; ?>