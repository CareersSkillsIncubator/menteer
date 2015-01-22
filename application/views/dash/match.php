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