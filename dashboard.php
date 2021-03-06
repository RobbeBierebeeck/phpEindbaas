<?php
    use Drop\Helpers\Security;
    use Drop\Core\Moderator;
    use Drop\Core\Post;
    use Drop\Core\XSS;
    include_once (__DIR__ .'/vendor/autoload.php');

    Security::onlyLoggedInUsers();
    Security::onlyAdminUsers($_SESSION['user']);
    $reportedUsers = Moderator::getAllReportedUsers();

    if (!empty($_GET['block'])){
        Moderator::blockUser($_GET['block']);
    }
    if (!empty($_GET['unblock'])){
        Moderator::unblockUser($_GET['unblock']);
    }
    if (!empty($_GET['banUser'])){
        Moderator::banUser($_GET['banUser']);
    }
    if (!empty($_GET['removeReport'])){
        Moderator::removeReport($_GET['removeReport']);
    }
    if (isset($_GET['blockedUsers'])){
        $blockedUsers = Moderator::getAllBlockedUsers();
    }
    if (isset($_GET['reportedPosts'])){
        $reportedPosts = Moderator::getAllReportedPosts();
    }

    if (!empty($_GET['removePost'])){
        Post::deletePostImage($_GET['removePost']);
        Post::deletePostById($_GET['removePost']) ;

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
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?inviteLinks">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-users" aria-hidden="true">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Invite links
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php?reportedPosts">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-users" aria-hidden="true">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Reported Posts
                        </a>
                    </li>
                </ul>
                </ul>
            </div>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 vh-100">

            <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Moderator dashboard</h1>
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
                        <th scope="col">Unblock</th>
                        <th scope="col">Ban</th>
                    </tr>
                    </thead>
                    <?php foreach ($blockedUsers as $blockedUser):?>
                    <tr>
                        <td><?php echo $blockedUser['id']?></td>
                        <td><?php echo XSS::specialChars(  $blockedUser['firstName']) ." ". XSS::specialChars($blockedUser['lastName'])?></td>
                        <td><?php echo $blockedUser['email']?></td>
                        <td><a type="button" href="dashboard.php?blockedUsers&unblock=<?php echo $blockedUser['id']?>" class="btn btn-secondary">Unblock</a></td>
                        <td><a type="button" href="dashboard.php?banUser=<?php echo $blockedUser['id']?>" class="btn btn-danger">Ban User</a></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <?php endif;?>

            <?php if(empty($_GET) || isset($_GET['users'])):?>
            <h2>Reported Users</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Reports</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reportedUsers as $reportedUser):?>
                            <tr>
                                <td><?php echo $reportedUser['id']?></td>
                                <td><?php echo XSS::specialChars($reportedUser['firstName']) ." ". XSS::specialChars($reportedUser['lastName'])?></td>
                                <td><?php echo $reportedUser['email']?></td>
                                <td><?php echo $reportedUser['timesReported']?></td>
                                <td><a type="button" href="dashboard.php?block=<?php echo $reportedUser['id']?>" class="btn btn-secondary">Block</a></td>
                                <td><a type="button" href="dashboard.php?removeReport=<?php echo $reportedUser['id']?>" class="btn btn-secondary">Remove reports</a></td>
                            </tr>
                        <?php endforeach;?>
                            </tbody>

                </table>
            </div>
            <?php endif;?>

            <?php if(isset($_GET['reportedPosts'])):?>
                <h2>Reported Users</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">PostId</th>
                            <th scope="col">Title</th>
                            <th scope="col">User</th>
                            <th scope="col">Reports</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reportedPosts as $reportedPost):?>
                            <tr>
                                <td><?php echo $reportedPost['id']?></td>
                                <td><?php echo XSS::specialChars($reportedPost['title'])?></td>
                                <td><?php echo XSS::specialChars($reportedPost['firstname'])?></td>
                                <td><?php echo $reportedPost['count']?></td>
                                <td><a type="button" href="dashboard.php?removePost=<?php echo $reportedPost['id']?>" class="btn btn-secondary">Remove post</a></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>

                    </table>
                </div>
            <?php endif;?>


            <?php if (isset($_GET['inviteLinks'])):?>
            <h2>generate invite links</h2>
            <div class="table-responsive">
                <input type="text" name="code" id="code">
                <a type="button" id="createLink" href="" class="btn btn-secondary">create invite link</a>
            </div>
            <?php endif;?>
        </main>

        <script src="./scripts/createInvite.js"></script>
</body>
</html>