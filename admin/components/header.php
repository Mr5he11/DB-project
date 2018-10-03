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
                <img class="logo" src="assets/img/logo.png"/>
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
                            <a href="index.php" <?php if ($_SESSION['page']=='index') { echo('class="menu-top-active"'); } ?>>OVERVIEW</a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">
                                ADD <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" <?php if ($_SESSION['page']=='add-admin') { echo('class="menu-top-active"'); } ?> href="add-admin.php">ADMIN</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" <?php if ($_SESSION['page']=='add-movie') { echo('class="menu-top-active"'); } ?> href="add-movie.php">MOVIE</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" <?php if ($_SESSION['page']=='add-room') { echo('class="menu-top-active"'); } ?> href="add-room.php">ROOM</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" <?php if ($_SESSION['page']=='add-schedule') { echo('class="menu-top-active"'); } ?> href="add-schedule.php">SCHEDULE</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="dropdown-toggle" id="ddlmenuItem2" data-toggle="dropdown" href="#">
                                MANAGE <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem2">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-users.php" <?php if ($_SESSION['page']=='manage-users') { echo('class="menu-top-active"'); } ?>>USERS</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-movies.php" <?php if ($_SESSION['page']=='manage-movies') { echo('class="menu-top-active"'); } ?>>MOVIES</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <?php echo (strtoupper($user_name . ' ' . $user_surname . ' ')); ?> <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="update-profile.php" <?php if ($_SESSION['page']=='update-profile') { echo('class="menu-top-active"'); } ?>>USER PROFILE</a></li>
                                <li class="divider"></li>
                                <li><a href="exe-logout.php"></i>LOGOUT</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- MENU SECTION END-->