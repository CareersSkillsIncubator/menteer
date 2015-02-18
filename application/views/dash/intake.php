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
                                <h1>Edit Question <?=$count?> of <?=$num_questions?></h1>

                                <div class="form-box">
                                    <strong class="title"> <a href="/dashboard/myprofile" style="font-weight: bold;"> &larr; BACK</a>  </strong>
                                    <div class="holder" style="min-height:300px;">
                                        <h4 style="font-weight: bold;"><?=$data['question']?></h4>
                                        <div class="form-group field<?=$key?>">

                                            <?php switch($data['type']) {

                                            case "checkbox":

                                                $checkbox_arr = array();

                                                foreach($data['answer_data'] as $item){

                                                    switch($count) {
                                                        case 1:
                                                        case 5:
                                                        case 6:
                                                        case 7:
                                                            foreach($answers[$count] as $a) {

                                                                $checkbox_arr[] = $a['id'];

                                                            }
                                                            break;
                                                        default:

                                                    }

                                                ?>

                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="<?=$key?>" value="<?=$item['id']?>" tabindex="-1" <?=in_array($item['id'],$checkbox_arr) ? 'checked="checked"' : '';?> >
                                                        <?=$item['answer']?>
                                                    </label>
                                                </div>

                                            <?php }

                                            break;

                                            case "radio":

                                                $radio_arr = array();

                                                foreach($data['answer_data'] as $item){

                                                switch($count) {
                                                    case 2:
                                                    case 3:
                                                    case 16:
                                                        foreach($answers[$count] as $a) {

                                                            $radio_arr[] = $a['id'];

                                                        }
                                                        break;
                                                    default:

                                                }


                                            ?>
                                                <div class="col-md-offset-1 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1 <?=$count==16 && !in_array($item['id'],$radio_arr) ? 'hide':'';?>">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$key?>" value="<?=$item['id']?>" tabindex="-1" <?=in_array($item['id'],$radio_arr) ? 'checked="checked"' : '';?>> <?=$item['answer']?>
                                                    </label>
                                                </div>

                                                <div style="clear:both;"></div>

                                            <?php }


                                            if($count == 16){
                                                ?>

                                                <div id="register-error-message" class="alert alert-danger hide">Something went wrong.</div>

                                                <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <label>&nbsp;</label>
                                                    <button class="btn btn-success update-registration" tabindex="-1">update all questions</button>
                                                </div>

                                            <?php }

                                            break;

                                            case "yesno":?>

                                                <div class="col-md-offset-1 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$key?>" value="Yes" tabindex="-1" <?=$answers[$count][0]=='yes' ? 'checked="checked"' : '';?>> Yes
                                                    </label>
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="col-md-offset-1 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="<?=$key?>" value="No" tabindex="-1" <?=$answers[$count][0]=='no' ? 'checked="checked"' : '';?>> No
                                                    </label>
                                                </div>
                                                <div style="clear:both;"></div>

                                            <?php break;

                                            case "open":?>

                                                <textarea name="<?=$key?>" rows="10" class="form-control" tabindex="-1"><?=$answers[$count][0]?></textarea>

                                            <?php break;

                                            case "list":?>

                                            <?php
                                            $comma_sep = implode(',',$answers[$count]);
                                            ?>

                                            <input type="text" name="<?=$key?>" class="form-control" id="tokenfield<?=$key?>" value="<?=$comma_sep?>" tabindex="-1" placeholder="Type something and hit enter" />


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
                <a class=" btn-prev icon-arrow arrow-prev" href="#"></a>
                <a class=" btn-next icon-arrow2 arrow-next" href="#"></a>
            </div>
            <div class="btn-holder hide">
                <button class="btn btn-success">save</button>
            </div>
            <input type="hidden" id="turnpage" name="turnpage" value="1" />
            <input type="hidden" id="turnpageupdate" name="turnpageupdate" value="1" />


            <?php echo form_close();?>
        </div>
    </div>
    <script>
        if($("input[name=turnpage]").val() == 1)
            $(".arrow-prev").hide();
    </script>
</main>