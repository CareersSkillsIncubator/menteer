<main id="main" role="main">
    <div class="container">
        <div class="block">
            <header class="heading">

                <?=$this->session->flashdata('message');?>

                <?php if($user['is_matched']==0 && $user['menteer_type']=='38' && is_array($this->session->userdata('matches'))){ ?>
                <div class="alert alert-warning">Click <a href="/chooser?enabled=1"><u>here</u></a> to view possible mentors.</div>
                <?php } ?>

                <?php if($user['is_matched']==0 && $user['menteer_type']=='38' && !is_array($this->session->userdata('matches'))){ ?>
                    <div class="alert alert-warning">We currently don't have any Mentor profiles available at this time. Try again tomorrow.</div>
                <?php } ?>

                <?php if($this->session->userdata('user_kind') == "both" && $user['is_matched']==0 && $user['menteer_type']=='37' && $user['match_status']=='pending'){ ?>
                    <div class="alert alert-info">You are currently a Mentor. </div>
                <?php } ?>

                <?php if($user['is_matched']!=0 && $user['menteer_type']=='37' && $user['match_status']=='pending'){ ?>
                    <div class="alert alert-info">You have been selected as a Mentor. Click <a href="/chooser/profile"><u>here</u></a> to view the Mentee profile and decide whether to accept or decline.</div>
                <?php } ?>

                <?php if($user['is_matched'] > 0 && $user['menteer_type']=='38' && $user['match_status']=='pending'){ ?>
                    <div class="alert alert-info">You are currently awaiting for your chosen mentor to accept your request. Click <a href="/dashboard/revoke/<?=encrypt_url($user['is_matched'])?>"><u>here</u></a> to revoke this request.</div>
                <?php } ?>


                <?php if($user['active']==0){ ?>
                    <div class="alert alert-info">Your account has not been activated. Please check your email and follow the link to activate.</div>
                <?php } ?>


                <?php
                //determine picture filename

                $pic_src = "/assets/images/img5.png";

                if($user['picture'])
                    $pic_src = "/uploads/".$user['picture'];

                ?>

                <div class="holder">
                    <strong class="title">HELLO <br><?=$user['first_name']?>!</strong>
                    <div class="user-box">
                        <div class="img-box"><a href="/dashboard/myprofile"><img src="<?=$pic_src?>" height="45" width="45" alt="<?=$user['first_name']?> <?=$user['last_name']?>"></a></div>
                        <strong class="name"><?=$user['first_name']?><span><?=$user['last_name']?></span></strong>
                    </div>
                </div>
                <div class="frame">

                    <?php
                    if($user['match_status']=='active' && $user['is_matched'] > 0) {
                    ?>
                    <a href="/dashboard/match">
                    <?php }else{ ?>

                        <a href="#" data-toggle="modal" data-target="#myModalNotMatched">

                    <?php }?>

                        <span class="icon icon-user1"></span>
                        <strong class="title" style="font-size:1.1em;">MENTEER&nbsp;<br> DASHBOARD</strong>
                    </a>
                </div>
            </header>
            <ul class="items-list">
                <li>
                    <a href="/dashboard/myprofile">
                        <span class="icon icon-user"></span>
                        <span class="text">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#myModalComingSoon">
                        <span class="icon icon-calendar"></span>
                        <span class="text">Events</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/settings">
                        <span class="icon icon-settings"></span>
                        <span class="text">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#myModalComingSoon">
                        <span class="icon icon-note"></span>
                        <span class="text">Tasks</span>
                    </a>
                </li>
                <li>
                    <a href="http://www.careerskillsincubator.com/programs/resources/" target="_blank">
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

            <?php if($this->session->userdata('cloaking')==1) {?>
            <a href="/dashboard/decloak" class="btn btn-danger" style="float:right;" align="center">DE-CLOAK</a>
            <?php } ?>
        </div>

    </div>


    <!-- Coming Soon -->
    <div class="modal fade" id="myModalComingSoon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">New Feature</h2>
                </div>
                <div class="modal-body">
                    Coming Soon<br /><br />


                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default close" data-dismiss="modal" aria-label="Close">Close</a>

                </div>
            </div>
        </div>
    </div>


    <!-- Not Matched -->
    <div class="modal fade" id="myModalNotMatched" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">Notice</h2>
                </div>
                <div class="modal-body">

                    <?php if($user['menteer_type']==37) { ?>

                    You currently do not have a match. You will be notified once a Menteer requests you as their Mentor.<br /><br />

                    <?php } ?>

                    <?php if($user['menteer_type']==38) { ?>

                        You currently do not have a mentor. <br /><br />

                    <?php } ?>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default close" data-dismiss="modal" aria-label="Close">Close</a>

                </div>
            </div>
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

