<section id="contact-main" class="contact-main section">
    <div class="container text-center">
    </div>
</section>
<section class="container contact-form-section">
    <h2 class="text-center">Choose a New Password</h2>
    <p class="intro text-center">Nearly there, just enter your new password (twice, to be sure) and you'll be inside your dashboard again in seconds.</p>

    <div class="row text-center">
        <div class="contact-form col-md-6 col-sm-12 col-xs-12 col-md-offset-3 col-sm-offset-0 col-xs-offset-0">

            <div id="reset-message-fail" class="alert alert-danger hide"></div>

            <div id="reset-message-success" class="alert alert-success hide">Great! Your password has been changed.</div>

            <?php echo form_open('#');?>
                <input type="hidden" name="code" value="<?=$code?>" />
                <input type="hidden" name="user_id" value="<?=$this->encryption->encrypt($user_id['value'])?>" />

                <div class="form-group name">
                    <input id="new-password" type="password" class="form-control" placeholder="Choose a password">
                </div><!--//form-group-->
                <div class="form-group email">
                    <input id="new-password-confirm" type="password" class="form-control" placeholder="One more time...">
                </div><!--//form-group-->

                <button type="submit" class="btn btn-block btn-cta-primary" id="submit-set-password">Set Password</button>

            <?php echo form_close();?>
        </div><!--//contact-form-->
    </div><!--//row-->
</section>


</div><!--//wrapper-->

