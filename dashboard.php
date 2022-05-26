<?php
    use Drop\Helpers\Security;
    use Drop\Core\Admin;
    include_once (__DIR__ .'/vendor/autoload.php');

    Security::onlyLoggedInUsers();
    Security::onlyAdminUsers($_SESSION['user']);
    $reportedUsers = Admin::getAllReportedUsers();

    if (!empty($_GET['block'])){
        Admin::blockUser($_GET['block']);
    }
    if (!empty($_GET['unblock'])){
        Admin::unblockUser($_GET['unblock']);
    }
    if (isset($_GET['blockedUsers'])){
        $blockedUsers = Admin::getAllBlockedUsers();
    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-avatar@latest/dist/avatar.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<?php include_once(__DIR__.'/partials/header.inc.php')?>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse vh-100">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column" >
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?users">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-users" aria-hidden="true">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?blockedUsers">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-users" aria-hidden="true">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Blocked Users
                        </a>
                    </li>
                </ul>
                </ul>
            </div>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 vh-100">

            <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin dashboard</h1>
            </div>
            <?php if (isset($_GET['blockedUsers'])):?>
            <h2>Blocked Users</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Block</th>
                    </tr>
                    </thead>
                    <?php foreach ($blockedUsers as $blockedUser):?>
                    <tr>
                        <td><?php echo $blockedUser['id']?></td>
                        <td><?php echo $blockedUser['firstName'] ." ". $blockedUser['lastName']?></td>
                        <td><?php echo $blockedUser['email']?></td>
                        <td><a type="button" href="dashboard.php?blockedUsers&unblock=<?php echo $blockedUser['id']?>" class="btn btn-secondary">Unblock</a></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>

                </table>
            </div>
            <?php else:?>
            <h2>Reported Users</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Block</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reportedUsers as $reportedUser):?>
                            <tr>
                                <td><?php echo $reportedUser['id']?></td>
                                <td><?php echo $reportedUser['firstName'] ." ". $reportedUser['lastName']?></td>
                                <td><?php echo $reportedUser['email']?></td>
                                <td><?php echo $reportedUser['timesReported']?></td>
                                <td><a type="button" href="dashboard.php?block=<?php echo $reportedUser['id']?>" class="btn btn-secondary">Block</a></td>
                            </tr>
                        <?php endforeach;?>
                            </tbody>

                </table>
            </div>
            <?php endif;?>
        </main>

</body>
</html>