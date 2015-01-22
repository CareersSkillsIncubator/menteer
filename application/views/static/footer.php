<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="holder">
                    <ul class="social-networks">
                        <li><a class="icon-facebook" href="https://www.facebook.com/CareerSkillsIncubator"></a></li>
                        <li><a class="icon-twitter" href="https://twitter.com/CSCIncubator"></a></li>
                        <li><a class="icon-linkedin" href="https://www.linkedin.com/vsearch/p?company=Career+Skills+Incubator&trk=prof-0-ovw-curr_pos"></a></li>
                    </ul>
                    <span class="copyright text-center">&copy; <?=date('Y');?> Career Skills Incubator  | <a href="/privacy">Privacy Policy</a></span>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<!-- Forgot Password Modal -->
<div class="modal modal-login modal-lg" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="loginModalLabel" class="modal-title text-center">Password Reset</h3>
                <p>Just let us know the email you use to sign in to Menteer and we'll help you get your password back.</p>
            </div>
            <div class="modal-body">
                <div class="login-form-container">

                    <div id="forgot-error-message" class="alert alert-danger hide">Email not found.</div>
                    <div id="forgot-success-message" class="alert alert-success hide">Great, we've sent instructions for changing your password for your email address!</div>

                    <?php echo form_open("#",array('class'=>'login-form sign-form2'));?>
                    <div class="form-group email">
                        <label class="sr-only" for="forgot-email">Your email</label>
                        <input id="forgot-email" type="email" class="form-control login-email identity" placeholder="Your email">
                    </div><!--//form-group-->
                    <button id="submit-reset-password" type="submit" class="btn btn-block btn-cta-primary">Send Reset Email</button>
                    <?php echo form_close();?>

                </div><!--//login-form-container-->
            </div><!--//modal-body-->
            <div class="modal-footer">
                <p><a href="/">Need help? Get in touch &rarr;</a></p>
            </div><!--//modal-footer-->
        </div><!--//modal-content-->
    </div><!--//modal-dialog-->
</div><!--//modal-->
</main>
</div>


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">window.jQuery || document.write('<script src="/assets/js/jquery-1.11.1.min.js"><\/script>')</script>

<?php if($this->uri->segment(1) != 'auth'){?>
<script type="text/javascript" src="/assets/js/jquery.main.js?v=<?=V?>"></script>
<?php } ?>

<script src="/assets/js/bootstrap.min.js?v=<?=V?>"></script>
<script src="/assets/js/application.js?v=<?=V?>"></script>

<?php if(ENVIRONMENT=='production') { ?>
<script>
    // Include the UserVoice JavaScript SDK (only needed once on a page)
    UserVoice=window.UserVoice||[];(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/E5q5tXLOK68HdKWuF1QYrg.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})();

    //
    // UserVoice Javascript SDK developer documentation:
    // https://www.uservoice.com/o/javascript-sdk
    //

    // Set colors
    UserVoice.push(['set', {
        accent_color: '#448dd6',
        trigger_color: 'white',
        trigger_background_color: 'rgba(46, 49, 51, 0.6)'
    }]);

    // Identify the user and pass traits
    // To enable, replace sample data with actual user traits and uncomment the line
    UserVoice.push(['identify', {
        //email:      'john.doe@example.com', // User’s email address
        //name:       'John Doe', // User’s real name
        //created_at: 1364406966, // Unix timestamp for the date the user signed up
        //id:         123, // Optional: Unique id of the user (if set, this should not change)
        //type:       'Owner', // Optional: segment your users by type
        //account: {
        //  id:           123, // Optional: associate multiple users with a single account
        //  name:         'Acme, Co.', // Account name
        //  created_at:   1364406966, // Unix timestamp for the date the account was created
        //  monthly_rate: 9.99, // Decimal; monthly rate of the account
        //  ltv:          1495.00, // Decimal; lifetime value of the account
        //  plan:         'Enhanced' // Plan name for the account
        //}
    }]);

    // Add default trigger to the bottom-right corner of the window:
    UserVoice.push(['addTrigger', { mode: 'contact', trigger_position: 'bottom-right' }]);

    // Or, use your own custom trigger:
    //UserVoice.push(['addTrigger', '#id', { mode: 'contact' }]);

    // Autoprompt for Satisfaction and SmartVote (only displayed under certain conditions)
    UserVoice.push(['autoprompt', {}]);
</script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-58836549-1', 'auto');
        ga('send', 'pageview');

    </script>
<?php } ?>

</body>
</html>