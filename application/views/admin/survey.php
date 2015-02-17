<main id="main" role="main">
    <div class="container">
        <div class="form-block">
        <?=$this->session->flashdata('message');?>

            <h1>Survey Setup</h1>
        <p>&nbsp;</p>

        <div style="clear:both;"></div>

            <center>
        <?php $attributes = array('class' => 'form', 'id' => 'survey_form');?>
        <?php echo form_open('admin/survey_save',$attributes); ?>

            <div class="form-group">
                <label for="question"><strong>Question</strong></label>
                <textarea name="question" cols="35" rows="10" class="form-control"><?=$content[1]['question']?></textarea>
            </div>

                <?php
                $answer1 = 0;
                $answer2 = 0;
                $answer3 = 0;
                $answer4 = 0;
                if(is_array($counts)) {

                    foreach ($counts as $count) {
                        if ($count['answer'] == $content[2]['answer']) {
                            $answer1 = $count['COUNT(*)'];
                        }
                    }


                    foreach ($counts as $count) {
                        if ($count['answer'] == $content[3]['answer']) {
                            $answer2 = $count['COUNT(*)'];
                        }
                    }


                    foreach ($counts as $count) {
                        if ($count['answer'] == $content[4]['answer']) {
                            $answer3 = $count['COUNT(*)'];
                        }
                    }


                    foreach ($counts as $count) {
                        if ($count['answer'] == $content[6]['answer']) {
                            $answer4 = $count['COUNT(*)'];
                        }
                    }
                }
                ?>

            <div class="form-group">
                <label for="answer1"><strong>Answer 1</strong> (<?=$answer1?>)</label>
                <textarea name="answer1" cols="35" rows="5" class="form-control"><?=$content[2]['answer']?></textarea>
            </div>
                <div class="form-group">
                    <label for="answer2"><strong>Answer 2</strong> (<?=$answer2?>)</label>
                    <textarea name="answer2" cols="35" rows="5" class="form-control"><?=$content[3]['answer']?></textarea>
                </div>
                <div class="form-group">
                    <label for="answer3"><strong>Answer 3</strong> (<?=$answer3?>)</label>
                    <textarea name="answer3" cols="35" rows="5" class="form-control"><?=$content[4]['answer']?></textarea>
                </div>
                <div class="form-group">
                    <label for="answer4"><strong>Answer 4</strong> (<?=$answer4?>)</label>
                    <textarea name="answer4" cols="35" rows="5" class="form-control"><?=$content[6]['answer']?></textarea>
                </div>

                <div class="form-group">
                    <label for="publish"><strong>Publish?</strong>
                    <input type="checkbox" value="1" name="publish" <?=$content[1]['is_active'] == 1 ? 'checked="checked"' : '';?> />
                    </label>
                </div>

                <div class="form-group">
                    <a href="/admin/survey_reset" onclick="return confirm('Are you sure you would like to reset the survey?');">reset survey</a>
                </div>

                <button type="submit" class="btn btn-default">Submit</button> <a href="/admin">cancel</a>
        <?php form_close(); ?>
            </center>

</div>
    </div>
</main>
