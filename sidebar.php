<div class="sidebar">
    <div class="sidebar-top">
        <h2 class="title is-4 logo">
            PSCPTNMGR
        </h2>

        <ul>
            <li><a href="/dashboard/">Overview</a></li>
            <li><a href="/dashboard/prescriptions/">Prescriptions</a></li>
            <li><a href="/dashboard/customers/">Customers</a></li>
    </ul>
            <?php
                if ($_SESSION['userRole'] === "Administrator") { ?>

                    <hr class="sidebar-hr" />
                    <h2 class="title is-5 sidebar-header">Admin</h2>
                    <ul>
                    <li><a href="/dashboard/users/">Manage Users</a></li>
                    <li><a href="/dashboard/users/roles">Manage Roles</a></li>
                </ul>
              <?php  }
            ?>
    </div>
    <div class="sidebar-bottom">
        <form action="/_logout.php" class="logout-form" method="POST">
            <button type="submit" name="logout-button" class="logout button is-link">Log Out</button>
        </form>
    </div>
</div>