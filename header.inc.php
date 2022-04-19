<?php
?><nav class="navbar navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Drop
        </a>
        <form>
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </form>
        <div class="d-flex align-items-center">
            <span class="rounded-circle nav__profilePicture" style="background-image: url('<?php echo User::getProfilePicture($_SESSION['user']) ?>');"></span>
            <div class="dropdown me-3">

                <span class=" dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                    <?php echo htmlspecialchars(User::getById(User::getUserId($_SESSION['user']))['firstname']) ?>
                </span>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="profile.php">Profiel</a></li>
                    <li><a class="dropdown-item" href="settings.php">Instellingen</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Afmelden</a></li>
                </ul>
            </div>
            <a href="newPost.php" button" class="btn btn-primary">Drop your shot</a>
        </div>
    </div>
</nav>