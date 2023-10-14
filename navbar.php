<!-- Wappler include head-page="users.php" appConnect="local" is="dmx-app" bootstrap5="local" fontawesome_5="cdn" components="{dmxBootstrap5Navigation:{},dmxBrowser:{}}" -->
<div is="dmx-browser" id="browser1"></div>
<dmx-serverconnect id="scLogout" url="dmxConnect/api/Logout.php" noload dmx-on:success="browser1.goto('index.php')" dmx-on:error="browser1.goto('index.php')" dmx-on:unauthorized="browser1.goto('index.php')" dmx-on:forbidden="browser1.goto('index.php')"></dmx-serverconnect>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Rewards Calculator</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="users.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="calculator.php">Calculator</a>
                    </li>
                </ul>
                <form class="d-flex ms-lg-auto">
                    <button class="btn btn-outline-light" dmx-on:click="browser1.goto('index.php');scLogout.load();"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        </div>
    </nav>