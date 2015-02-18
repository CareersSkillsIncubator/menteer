<main id="main" role="main" class="intake">
    <div class="container">
        <div class="form-block">


            <?php echo form_open("#",array('class'=>'form','role'=>'form','id'=>'question_form'));?>
                <div class="carousel">
                    <div class="mask">
                        <div class="slideset"><?php
                                $count = 1;
                                foreach($questions as $key=>$data){?>
                                <div data-cycle-hash="<?=$key?>" class="slide">
                                    <div class="alert alert-danger intake-err">Question Not Answered</div>
                                    <script>
                                        $('.intake-err').hide();
                                    </script>
                                    <h1>Question <?=$count?> of <?=$num_questions?></h1>

                                    <div class="form-box">
                                        <strong class="title"></strong>
                                        <div class="holder" style="min-height:300px;">
                                            <h4 style="font-weight: bold;"><?=$data['question']?></h4>
                                            <div class="form-group field<?=$key?>">



                                                <?php switch($data['type']) {

                                                    case "checkbox":

                                                        foreach($data['answer_data'] as $item){ ?>

                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="<?=$key?>" value="<?=$item['id']?>" tabindex="-1">
                                                                    <?=$item['answer']?>
                                                                </label>
                                                            </div>

                                                        <?php }

                                                        break;

                                                    case "radio":


                                                        foreach($data['answer_data'] as $item){ ?>
                                                            <div class="col-md-offset-1 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1">
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="<?=$key?>" value="<?=$item['id']?>" tabindex="-1"> <?=$item['answer']?>
                                                                </label>
                                                            </div>
                                                            <div style="clear:both;"></div>

                                                        <?php }


                                                        break;

                                                    case "yesno":?>

                                                        <div class="col-md-offset-1 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="<?=$key?>" value="Yes" tabindex="-1"> Yes
                                                            </label>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                        <div class="col-md-offset-1 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="<?=$key?>" value="No" tabindex="-1"> No
                                                            </label>
                                                        </div>
                                                        <div style="clear:both;"></div>

                                                        <?php break;

                                                    case "open":?>

                                                        <textarea name="<?=$key?>" rows="10" class="form-control" tabindex="-1"></textarea>

                                                        <?php break;

                                                    case "list":?>



                                                <input type="text" name="<?=$key?>" class="form-control" id="tokenfield<?=$key?>" value="" tabindex="-1" placeholder="Type something and hit enter" />


                                                <?php

                                                $array = explode(',',$data['answer_data'][0]['answer']);
                                                $comma_separated = implode("','", $array);
                                                $comma_separated = "'".$comma_separated."'";

                                                ?>

                                                    <script>
                                                        $('#tokenfield<?=$key?>').tokenfield({
                                                            autocomplete: {
                                                                source: [<?=$comma_separated?>],
                                                                delay: 100
                                                            },
                                                            showAutocompleteOnFocus: false
                                                        })
                                                    </script>



                                                    <?php break;
                                                    default:


                                                } ?>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $count++; } ?>

                                <div data-cycle-hash="register" class="slide register_slide">

                                    <div class="alert alert-danger intake-err">Question Not Answered</div>

                                    <h1>Register</h1>

                                    <div class="form-box">
                                        <strong class="title"></strong>
                                        <div class="holder" style="min-height:620px;">
                                            <h4 style="font-weight: bold;">Just one more step...</h4>

                                            <div id="register-error-message" class="alert alert-danger hide">Something went wrong.</div>

                                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <label for="first_name" style="margin-top:5px; padding-top:5px;">FIRST NAME</label>
                                                <input class="form-control" type="text" name="first_name" id="registration-fname" placeholder="" tabindex="-1">
                                            </div>

                                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <label for="last_name" style="margin-top:5px; padding-top:5px;">LAST NAME</label>
                                                <input class="form-control" type="text" name="last_name" id="registration-lname" placeholder="" tabindex="-1">
                                            </div>

                                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <label for="email" style="margin-top:5px; padding-top:5px;">EMAIL</label>
                                                <input class="form-control" type="text" name="email" id="registration-email" placeholder="" tabindex="-1">
                                            </div>
                                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <label style="margin-top:5px; padding-top:5px;" for="password">PASSWORD</label>
                                                <input class="form-control" type="password" name="password" id="registration-password" placeholder="" tabindex="-1">
                                            </div>
                                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <label style="margin-top:5px; padding-top:5px;" for="password_confirm">PASSWORD CONFIRM</label>
                                                <input class="form-control" type="password" name="password_confirm" id="registration-password-confirm" placeholder="" tabindex="-1">
                                            </div>

                                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <label>&nbsp;</label>
                                                <button class="btn btn-success submit-registration" tabindex="-1">continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <a class=" btn-prev icon-arrow arrow-prev" href="#"></a>
                    <a class=" btn-next icon-arrow2 arrow-next" href="#"></a>
                </div>
                <div class="btn-holder hide">
                    <button class="btn btn-success">save</button>
                </div>
            <input type="hidden" id="turnpage" name="turnpage" value="1" />
            <input type="hidden" id="turnpageupdate" name="turnpageupdate" value="0" />

            <?php echo form_close();?>
        </div>
    </div>
    <script>
        if($("input[name=turnpage]").val() == 1)
            $(".arrow-prev").hide();
    </script>
</main>
