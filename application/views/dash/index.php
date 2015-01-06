<main id="main" role="main">
    <div class="container">
        <div class="block">
            <header class="heading">
                <div class="holder">
                    <strong class="title">HELLO <br><?=$user['first_name']?>!</strong>
                    <div class="user-box">
                        <div class="img-box"><a href="#"><img src="/assets/images/img5.png" height="45" width="45" alt="image description"></a></div>
                        <strong class="name"><?=$user['first_name']?><span><?=$user['last_name']?></span></strong>
                    </div>
                </div>
                <div class="frame">
                    <a href="#">
                        <span class="icon icon-user1"></span>
                        <strong class="title">MENTEER <br>DASHBOARD</strong>
                    </a>
                </div>
            </header>
            <ul class="items-list">
                <li>
                    <a href="#">
                        <span class="icon icon-user"></span>
                        <span class="text">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-calendar"></span>
                        <span class="text">Events</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-settings"></span>
                        <span class="text">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-note"></span>
                        <span class="text">Tasks</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-folder"></span>
                        <span class="text">Resources</span>
                    </a>
                </li>
                <li>
                    <a href="/logout" class="logout">
                        <span class="sub-text">LOG OUT</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</main>