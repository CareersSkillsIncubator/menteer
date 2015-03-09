<main id="main" role="main">
    <div class="section win-height non-bg">
        <div class="img"><img src="/assets/images/img1.jpg" height="612" width="658" alt="image description"></div>
        <div class="footer-box">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <section class="box">
                            <h1>Are you a mentor?</h1>
                            <a class="btn btn-default" href="/intake">be a menteer</a>
                        </section>
                    </div>
                    <div class="col-sm-3 col-sm-offset-6">
                        <section class="box">
                            <h1>Are you a mentee?</h1>
                            <a class="btn btn-default" href="/intake">be a menteer</a>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section win-height" id="about" style="min-height:670px;">
        <div class="container">
            <div class="row">
                <span class="circle color"></span>
                <span class="circle top right item"></span>
                <div class="col-sm-6 col-sm-offset-6">
                    <div class="text-block">
                        <h1>ABOUT</h1>

                        <?=nl2br($content[1]['description'])?>

                        <p>This app was made possibly with generous support from &nbsp;<a href="http://cira.ca/"><img src="/assets/images/calogo.jpg" width="150px"  /></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section win-height" id="story" style="min-height:670px;">
        <div class="container">
            <div class="row">
                <span class="circle top"></span>
                <span class="circle right color item"></span>
                <div class="col-sm-7">
                    <div class="text-block left">
                        <h1>STORY</h1>

                        <?=nl2br($content[2]['description'])?>

                         Learn more about <a href="http://www.careerskillsincubator.com/">CSCI</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section win-height item item-color hide" id="menteers">
        <div class="container">
            <div class="row">
                <span class="circle item"></span>
                <span class="circle right item"></span>
                <div class="col-sm-12">
                    <h1 class="text-center">MENTEERS</h1>
                    <div class="col-wrapp">
                        <div class="col">
                            <div class="img-box">
                                <a href="#"><img src="/assets/images/img2.jpg" height="171" width="184" alt="image description"></a>
                            </div>
                            <h2><a href="#">Firstname Lastname</a></h2>
                            <p>Lorem ipsum dolor sit amet, in verear conceptam adversarium duo. Fuisset interesset pri ea, in reque principes disputando vim. His veri soluta eu.</p>
                            <ul class="social-networks">
                                <li><a class="icon-linkedin" href="#"></a></li>
                                <li><a class="icon-twitter" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="col">
                            <div class="img-box">
                                <a href="#"><img src="/assets/images/img3.jpg" height="171" width="184" alt="image description"></a>
                            </div>
                            <h2><a href="#">Firstname Lastname</a></h2>
                            <p>Has quis erant tibique ea, eu harum percipit vituperatoribus sea, eu nam quis eros delectus. Mei eu fugit perpetua theophrastus, vis consul inimicus deseruisse ex, pri summo iriure postulant cu.</p>
                            <ul class="social-networks">
                                <li><a class="icon-linkedin" href="#"></a></li>
                                <li><a class="icon-twitter" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="col">
                            <div class="img-box">
                                <a href="#"><img src="/assets/images/img4.jpg" height="171" width="184" alt="image description"></a>
                            </div>
                            <h2><a href="#">Firstname Lastname</a></h2>
                            <p>Pro in affert putant latine, case saperet et nec. Quaeque numquam duo eu, sea erant omnes labitur at. Mei ex ludus primis, decore sententiae ad qui. In eum error epicurei.</p>
                            <ul class="social-networks">
                                <li><a class="icon-linkedin" href="#"></a></li>
                                <li><a class="icon-twitter" href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section win-height item-color last" id="login" style="min-height:800px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <section class="contact-box">
                        <h1>LOG IN <?=$this->session->userdata('demo')==1? '(DEMO)': ''; ?></h1>

                        <?php echo form_open("#",array('class'=>'sign-form','role'=>'form'));?>
                            <div id="login-error-message" class="alert alert-danger hide">Username or Password Incorrect</div>

                            <div id="login-activate-message" class="alert alert-success <?=$this->input->get('activated') ? '' : 'hide';?>">Account Activated</div>

                            <div class="form-group">
                                <label for="name">EMAIL</label>
                                <input type="text" class="form-control" id="login-email" value="<?=$remember_email?>" tabindex="-1">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="login-password" tabindex="1">
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" id="check-1" tabindex="2"><label for="check-1">REMEMBER ME</label>
                            </div>
                            <div class="btn-holder">
                                <button id="submit-login" type="submit" class="btn btn-default">Submit</button>
                                <p class="help-block"><a href="#" data-toggle="modal" data-target="#forgot-modal">Forgot Password?</a><br><a href="/intake">Sign Me Up</a></p>
                            </div>
                        <?php echo form_close();?>

                    </section>
                </div>
                <div class="col-sm-6">
                    <section class="contact-box">
                        <h1>CONTACT</h1>
                        <div class="map-box">

                            <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ca/maps?q=585+Dundas+St+E,+Toronto,+ON+M5A+2B7&amp;ie=UTF8&amp;hq=&amp;hnear=585+Dundas+St+E,+Toronto,+Ontario+M5A+2B7&amp;ll=43.660077,-79.362063&amp;spn=0.00676,0.01074&amp;t=m&amp;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.ca/maps?q=585+Dundas+St+E,+Toronto,+ON+M5A+2B7&amp;ie=UTF8&amp;hq=&amp;hnear=585+Dundas+St+E,+Toronto,+Ontario+M5A+2B7&amp;ll=43.660077,-79.362063&amp;spn=0.00676,0.01074&amp;t=m&amp;z=14&amp;source=embed" style="color:#0000FF;text-align:left"></a></small>

                        </div>
                        <address><a href="mailto:info@careerskillsincubator.com">info@careerskillsincubator.com</a><br />Regent Park 585 Dundas St E<br> Toronto, ON M5A 2B7 Canada </address>
                    </section>
                </div>
            </div>
        </div>