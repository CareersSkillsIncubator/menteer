<main id="main" role="main">
    <div class="container">
        <div class="block">
            <header class="heading">

                <?=$this->session->flashdata('message');?>

                <?php if($user['is_matched']==0 && $user['menteer_type']=='38' && is_array($this->session->userdata('matches'))){ ?>
                <div class="alert alert-warning">Click <a href="/chooser?enabled=1">here</a> to view possible mentors.</div>
                <?php } ?>

                <?php if($user['is_matched']==0 && $user['menteer_type']=='38' && !is_array($this->session->userdata('matches'))){ ?>
                    <div class="alert alert-warning">We currently don't have any Mentor profiles available at this time. Try again tomorrow.</div>
                <?php } ?>

                <?php if($user['is_matched']!=0 && $user['menteer_type']=='37' && $user['match_status']=='pending'){ ?>
                    <div class="alert alert-info">You have been selected as a Mentor. Click <a href="/chooser/profile">here</a> to view the Mentee profile and decide whether to accept or decline.</div>
                <?php } ?>


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

    <!-- Agreement Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close hide" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">You're almost there!</h2>
                </div>
                <div class="modal-body">
                    As a menteer I agree to:<br /><br />
                    -Demonstrate respect and appreciation to all parties involved<br /><br />
                    -Protect the privacy of my menteer and only share what they have explicitly provided me permission to share with others<br /><br />
                    -Practice safety and common sense, such as only meeting in public spaces, and read more safety tips here<br /><br />
                    -Attempt to resolve issues with my menteer, but when assistance is needed to reach out to the awesome volunteers at <a href="mailto:mentorship@careerskillsincubator.com">mentorship@careerskillsincubator.com</a> for support<br /><br />
                    -Review the resources provided here on tips for a productive menteer relationship<br /><br />
                    -Challenge myself and others to have a fun and productive experience!<br /><br />

                    <p>Click "Accept" to proceed.</p>

                </div>
                <div class="modal-footer">
                    <a href="/logout" class="btn btn-default">Logout</a>
                    <a href="/accept" class="btn btn-primary">Accept</a>
                </div>
            </div>
        </div>
    </div>

<?php if($user['agree']== 0) { //user must agree before continuing?>
    <script>
        $('#myModal').modal({
            keyboard: false,
            backdrop: 'static'
        })
    </script>
<?php } ?>

</main>

