<main id="main" role="main" class="intake">
    <div class="container">

        <div class="form-block">

            <h1>Menteer Dashboard</h1>

            <?php

            $private = explode(',',$match['privacy_settings']);

            ?>

            <?= $this->session->flashdata('message'); ?>

            <?php echo form_open_multipart(
                "#",
                array('class' => 'form', 'role' => 'form', 'id' => 'profile_form')
            ); ?>
            <div class="carousel">
                <div class="mask">
                    <div class="slideset">

                        <div data-cycle-hash="register" class="slide register_slide">

                            <?php
                            // determine match status

                            $status = "pending";

                            if ($match['is_matched'] > 0 && $match['match_status'] == 'pending') {
                                $status = "waiting on confirmation";
                            }

                            if ($match['is_matched'] > 0 && $match['match_status'] == 'active') {
                                $status = "matched";
                            }

                            ?>


                            <div class="form-box">
                                <strong class="title"> <a href="/dashboard">BACK</a> <span
                                        style="float:right;"><a href="#">MATCH STATUS: <?= strtoupper(
                                                $status
                                            ) ?></a> </span> </strong>

                                <div class="holder" style="min-height:620px; line-height: 20px;">

                                    <?php
                                    //determine picture filename

                                    $pic_src = "/assets/images/img5.png";

                                    if($match['picture'])
                                        $pic_src = "/uploads/".$match['picture'];

                                    ?>

                                    <div class="col-xs-12">
                                        <div class="img-box">
                                            <img style="float:left; padding-right:10px;" class="col-xs-5"
                                                 src="<?=$pic_src?>"
                                                 alt="<?= $match['first_name'] ?> <?= $match['last_name'] ?>">
                                        </div>


                                        <h4 style="font-weight: bold; padding-left:10px;">
                                            <?= $match['first_name'] ?> <?= $match['last_name'] ?>
                                        </h4>

                                        <p><?= $match['menteer_type'] == 37 ? 'Mentor' : ''; ?><?= $match['menteer_type'] == 38 ? 'Mentee' : ''; ?><?= $match['menteer_type'] == 41 ? 'Mentee/Mentor' : ''; ?></p>



                                        <p class="<?=$private[0] ? '':'hide';?>"><?= $match['email'] ?></p>

                                        <p style="font-size:.8em;"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <a href="#" data-toggle="modal" data-target="#myModalMessage">Send Message to <?= $match['first_name'] ?></a><br />
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <a href="#">Book Meeting with <?= $match['first_name'] ?></a></p>

                                        <div style="clear:both;"></div>


                                        <hr/>

                                        <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6 <?=$private[2] ? '':'hide';?>"><?= $match['location'] ?></div>
                                        <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6 <?=$private[1] ? '':'hide';?>"><?= $match['phone'] ?></div>


                                        <div class="col-xs-12">
                                            <hr/>

                                            <div style="clear:both;"></div>
                                            <strong class="title"> CAREER STATUS</strong>
                                            <div class="well"><?= $match['career_status'] ?></div>

                                            <div style="clear:both;"></div>
                                            <strong class="title"> CAREER GOALS</strong>
                                            <div class="well"><?= $match['career_goals'] ?></div>

                                            <div style="clear:both;"></div>
                                            <strong class="title"> EDUCATION</strong>
                                            <div class="well"><?= $match['education'] ?></div>


                                            <div style="clear:both;"></div>
                                            <strong class="title"> EXPERIENCE</strong>
                                            <div class="well"><?= $match['experience'] ?></div>

                                            <div style="clear:both;"></div>
                                            <strong class="title"> SKILLS</strong>
                                            <div class="well"><?= $match['skills'] ?></div>


                                            <div style="clear:both;"></div>
                                            <strong class="title"> PASSION</strong>
                                            <div class="well"><?= $match['passion'] ?></div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
</main>
<!-- Not Matched -->
<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel">Send A Message</h2>
            </div>
            <div class="modal-body">

                <?php $attributes = array('class' => 'form', 'id' => 'message_form');?>
                <?php echo form_open('dashboard/send_message',$attributes); ?>
                <div class="form-group">
                    <div class="form-row col-xs-8">
                        <input type="text" class="form-control col-xs-4" id="message_subject" name="message_subject" placeholder="subject">
                    </div>
                </div>
                <div class="form-group col-xs-8">
                        <textarea class="form-control" rows="6" name="message_body" id="message_body" placeholder="your message here"></textarea>
                </div>
                    <div style="clear:both;"></div>
                    <button type="submit" class="btn btn-default">Send</button>
                </form>

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default close" data-dismiss="modal" aria-label="Close">Close</a>

            </div>
        </div>
    </div>
</div>