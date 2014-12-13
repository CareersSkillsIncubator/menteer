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
                    <span class="copyright text-center">&copy; <?=date('Y');?> Career Skills Incubator</span>
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

</body>
</html>