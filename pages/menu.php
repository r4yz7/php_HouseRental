<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="images/logo.png"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <!-- <a class="nav-link" href="?page=1"><?
                    // if(isset($_SESSION["radmin"])or isset($_SESSION["ruser"]))echo "Menu";
                    ?></a> -->
                    <a class="nav-link" href="?page=1">Menu</a>
                </li>
                    
                <li class="nav-item">
          <a class="nav-link
          <? echo $page == 4 ? "active" : "" ?>" href="?page=4"><?if(isset($_SESSION["radmin"]))echo "Admin panel";?></a>
        </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <a class="navbar-brand" href=""><img class="logo" src="images/user.png"></a>
                <li class="nav-item">
                    <a class="nav-link" href="?page=2"><?if(isset($_SESSION["radmin"])or isset($_SESSION["ruser"]))echo "Exit"; else echo "Log in";?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>