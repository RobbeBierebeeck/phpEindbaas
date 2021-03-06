<?php
use Drop\Core\User;
?><nav class="navbar navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="./images/logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Drop
        </a>
        <?php 
        if (basename($_SERVER['SCRIPT_NAME']) ==='index.php'):?>
        <form method="get">
            <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
        </form>
        <?php endif;?>
        <div class="d-flex align-items-center">
            <span class="rounded-circle nav__profilePicture" style="background-image: url('<?php echo User::getProfilePicture($_SESSION['user'])['profile_image'] ?>');"></span>
            <div class="dropdown me-3">

                <span class=" dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                    <?php echo htmlspecialchars(User::getById(User::getUserId($_SESSION['user']))['firstname']) ?>
                </span>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="profile.php?id=<?php echo User::getUserId($_SESSION['user'])?>">Profile</a></li>
                    <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                    <li><a class="dropdown-item" href="showCase.php?id=<?php echo User::getUserId($_SESSION['user'])?>">Your showcase</a></li>
                    <?php if (User::isModerator(User::getUserId($_SESSION['user']))):?>
                    <li><a class="dropdown-item" href="dashboard.php">Admin dashboard</a></li>
                    <?php endif;?>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Afmelden</a></li>
                </ul>
            </div>
            <a href="newPost.php" class="btn btn-primary">Drop your shot</a>
        </div>
    </div>
</nav>
