<!-- LOGO HEADER BEGIN -->
<div class="navbar navbar-inverse set-radius-zero" >
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="admin/assets/img/logo.png" />
            </a>
        </div>
    </div>
</div>
<!-- LOGO HEADER END-->
<!-- MENU SECTION BEGIN -->
<section class="menu-section">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li>
                            <a href="programmation.php" <?php if ($_SESSION['page']=='prgrammation') { echo('class="menu-top-active"'); } ?>>PROGRAMMATION</a>
                        </li>
                        <li>
                        <?php 
                            if(isset($_SESSION['user'])){ 
                                //user query in order to take name/surname
                                //user selection query
                                $user_query = 'SELECT * FROM Utenti where Mail=?';

                                //fetch user
                                $result = $conn->prepare($user_query);
                                $result->execute([$_SESSION['user']]);
                                $user = $result->fetch();
                                $user_name = $user['Nome'];
                                $user_surname = $user['Cognome'];
                                $user_mail = $user['Mail'];
                                $user_psw = $user['Password'];
                                $user_salt = $user['Salt'];
                                $admin = $user['Amministratore'];

                                //if not admin, redirect to login
                                if ($admin) {
                                    header('Location: admin/index.php');
                                }
                        ?>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <?php echo (strtoupper($user_name . ' ' . $user_surname . ' ')); ?> <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="update-profile.php" <?php if ($_SESSION['page']=='update-profile') { echo('class="menu-top-active"'); } ?>>USER PROFILE</a></li>
                                <li class="divider"></li>
                                <li><a href="admin/exe-logout.php"></i>LOGOUT</a></li>
                            </ul>
                            <li>
                                <a href="booked-shows.php" <?php if ($_SESSION['page']=='booked-shows') { echo('class="menu-top-active"'); } ?>>BOOKED SHOWS</a>
                            </li>
                        <?php } else { ?>
                        </li>
                        <li>
                            <a href="admin/login.php" <?php if ($_SESSION['page']=='log-in') { echo('class="menu-top-active"'); } ?>>LOG IN</a>
                        </li>
                        <li>
                            <a href="signup.php" <?php if ($_SESSION['page']=='sign-up') { echo('class="menu-top-active"'); } ?>>SIGN UP</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- MENU SECTION END-->