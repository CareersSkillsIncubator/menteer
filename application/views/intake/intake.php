<main id="main" role="main" class="intake">
    <div class="container">
        <div class="form-block">
            <form role="form" class="form">

                <div class="carousel">
                    <div class="mask">
                        <div class="slideset"><?php
                                $count = 1;
                                foreach($questions as $key=>$data){?>
                                <div data-cycle-hash="<?=$key?>" class="slide">
                                    <h1>Question <?=$count?> of <?=$num_questions?></h1>

                                    <div class="form-box">
                                        <strong class="title"></strong>
                                        <div class="holder" style="min-height:300px;">
                                            <h4 style="font-weight: bold;"><?=$data['question']?></h4>
                                            <div class="form-group">


                                                <?php switch($data['type']) {

                                                    case "checkbox":

                                                        foreach($data['answer_data'] as $item){ ?>

                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" value="<?=$item['id']?>" tabindex="-1">
                                                                    <?=$item['answer']?>
                                                                </label>
                                                            </div>

                                                        <?php }

                                                        break;

                                                    case "radio":


                                                        foreach($data['answer_data'] as $item){ ?>
                                                            <div class="col-md-offset-1 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1">
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="radio<?=$key?>" value="<?=$item['id']?>" tabindex="-1"> <?=$item['answer']?>
                                                                </label>
                                                            </div>
                                                            <div style="clear:both;"></div>

                                                        <?php }


                                                        break;

                                                    case "yesno":?>

                                                        <div class="col-md-offset-1 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="radio<?=$key?>" value="Yes" tabindex="-1"> Yes
                                                            </label>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                        <div class="col-md-offset-1 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="radio<?=$key?>" value="No" tabindex="-1"> No
                                                            </label>
                                                        </div>
                                                        <div style="clear:both;"></div>

                                                        <?php break;

                                                    case "open":?>

                                                        <textarea name="open<?=$key?>" rows="10" class="form-control" tabindex="-1"></textarea>

                                                        <?php break;

                                                    case "list":?>



                                                <input type="text" class="form-control" id="tokenfield<?=$key?>" value="" tabindex="-1" />


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


                        </div>
                    </div>
                    <a class=" btn-prev icon-arrow" href="#"></a>
                    <a class=" btn-next icon-arrow2" href="#"></a>
                </div>
                <div class="btn-holder hide">
                    <button class="btn btn-success">save</button>
                </div>
            </form>
        </div>
    </div>
</main>