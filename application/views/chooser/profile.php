<main id="main" role="main" class="intake">
    <div class="container">

        <div class="form-block" id="top">

            <h1>Mentee Profile</h1>

            <?=$this->session->flashdata('message');?>

            <?php echo form_open("#",array('class'=>'form','role'=>'form','id'=>'question_form'));?>
            <div class="carousel">
                <div class="mask">
                    <div class="slideset">


                        <?php foreach($mentee as $mentor){ ?>

                            <div data-cycle-hash="register" class="slide register_slide">

                                <div class="form-box">
                                    <strong class="title"> <a href="/dashboard">SKIP TO DASHBOARD</a></strong>
                                    <div class="holder" style="min-height:620px;">




                                        <?php
                                        //determine picture filename

                                        $pic_src = "/assets/images/img5.png";

                                        if($mentor['user']['picture'])
                                            $pic_src = "/uploads/".$mentor['user']['picture'];

                                        ?>

                                        <div class="img-box">
                                            <img style="float:left; padding-right:10px;" class="col-xs-7"
                                                 src="<?=$pic_src?>"
                                                 alt="<?= $mentor['user']['first_name'] ?>">
                                        </div>

                                        <h4 style="font-weight: bold;"><?=$mentor['user']['first_name']?></h4>
                                        <p><?= $mentor['user']['menteer_type'] == 37 ? 'Mentor' : ''; ?><?= $mentor['user']['menteer_type'] == 38 ? 'Mentee' : ''; ?><?= $mentor['user']['menteer_type'] == 41 ? 'Mentee/Mentor' : ''; ?></p>

                                        <div style="clear:both;"></div>
                                        <hr />
                                        <div align="center" class="well">
                                        <a href="/chooser/decline" class="btn btn-danger ">DECLINE</a>
                                        <a href="/chooser/accept" class="btn btn-success ">ACCEPT</a>
                                        </div>

                                        <hr />
                                        <div style="clear:both;"></div>
                                        <h2>Questionnaire Answers</h2>

                                        <hr />

                                        <h4>Why mentorship?</h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['1'] as $key=>$val) { ?>
                                                <li><?=$val['answer']?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>Would you prefer to be matched with someone based on skills, industry or both?</h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['2'] as $key=>$val) { ?>
                                                <li><?=$val['answer']?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>What type of mentorship relationship interests you? </h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['3'] as $key=>$val) { ?>
                                                <li><?=$val['answer']?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>Is it important to meet your menteer in person?</h4>
                                        <ul class="normal-font">

                                            <li><?=$mentor['answers']['4'][0]?></li>

                                        </ul>

                                        <h4>What type of time commitment are you open to? </h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['5'] as $key=>$val) { ?>
                                                <li><?=$val['answer']?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>Which mentorship communication style are you?  </h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['6'] as $key=>$val) { ?>
                                                <li><?=$val['answer']?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>Which mentorship communication style do you prefer?  </h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['7'] as $key=>$val) { ?>
                                                <li><?=$val['answer']?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>What are you passionate about? </h4>
                                        <ul class="normal-font">
                                            <li><?=$mentor['answers']['8'][0]?></li>
                                        </ul>

                                        <h4>What industry or industries are you interested in? </h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['9'] as $key=>$val) { ?>
                                                <li><?=$val?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>What industry or industries have you worked in? </h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['10'] as $key=>$val) { ?>
                                                <li><?=$val?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>What is your educational background? </h4>
                                        <ul class="normal-font">
                                            <li><?=$mentor['answers']['11'][0]?></li>
                                        </ul>

                                        <h4>What soft skills do you have?</h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['12'] as $key=>$val) { ?>
                                                <li><?=$val?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>What soft skills would you like to gain? </h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['13'] as $key=>$val) { ?>
                                                <li><?=$val?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>What hard skills do you have? </h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['14'] as $key=>$val) { ?>
                                                <li><?=$val?></li>
                                            <?php } ?>
                                        </ul>

                                        <h4>What hard skills would you like to gain? </h4>
                                        <ul class="normal-font">
                                            <?php foreach($mentor['answers']['15'] as $key=>$val) { ?>
                                                <li><?=$val?></li>
                                            <?php } ?>
                                        </ul>


                                    </div>
                                </div>

                                <a href="#top" class="btn btn-default fright">TOP</a>
                                <a href="/dashboard" class="btn btn-primary">SKIP TO DASHBOARD</a>

                            </div>

                        <?php } ?>

                    </div>
                </div>

            </div>
            <div class="btn-holder hide">
                <button class="btn btn-success">save</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</main>