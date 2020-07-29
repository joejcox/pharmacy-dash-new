<?php include "../../includes/header.php"; 

if ($_SESSION['userRole'] !== "Administrator") {
   header("Location: /?error=adminonly");
   exit();
}
?>
<?php include $path . "partials/_add-user-modal.php"; ?>
<div class="title-with-button">

    <h2 class="title is-2"><i class="fas fa-user"></i> Roles</h2>
</div>
<hr />




<?php include "../../includes/footer.php"; ?>