<main id="main" role="main">
    <div class="container">
        <div class="form-block">
        <?=$this->session->flashdata('message');?>

            <h1>CMS</h1>
        <p>&nbsp;</p>

        <div style="clear:both;"></div>

            <center>
        <?php $attributes = array('class' => 'form', 'id' => 'cms_form');?>
        <?php echo form_open('admin/cms_save',$attributes); ?>

            <div class="form-group">
                <label for="about"><strong>About</strong></label>
                <textarea name="about" cols="35" rows="15" class="form-control"><?=$content[1]['description']?></textarea>
            </div>
            <div class="form-group">
                <label for="story"><strong>Story</strong></label>
                <textarea name="story" cols="35" rows="15" class="form-control"><?=$content[2]['description']?></textarea>
            </div>
            <button type="submit" class="btn btn-default">Submit</button> <a href="/admin">cancel</a>
        <?php form_close(); ?>
            </center>

</div>
    </div>
</main>
