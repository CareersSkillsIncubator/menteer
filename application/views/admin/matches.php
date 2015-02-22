<main id="main" role="main">
    <div class="container">
        <div class="form-block">
        <?=$this->session->flashdata('message');?>

            <h1>Matches Revoked By Mentee</h1>
            <p>&nbsp;</p>

            <div style="clear:both;"></div>

            <table class="table table-hover">
                <tr><th>Mentee ID</th><th>Mentor ID</th><th>Date</th></tr>
            <?php
            foreach($revokes as $item){
            ?>
                <tr>
                    <td><?=$item['mentee_id'];?></td>
                    <td><?=$item['mentor_id'];?></td>
                    <td><?=$item['stamp'];?></td>
                </tr>
            <?php } ?>
            </table>

            <h1>Matches Ended By Mentor</h1>
            <p>&nbsp;</p>

            <div style="clear:both;"></div>

            <table class="table table-hover">
                <tr><th>Mentee ID</th><th>Mentor ID</th><th>Date</th></tr>
                <?php
                if(is_array($ends)){
                foreach($ends as $item){
                    ?>
                    <tr>
                        <td><?=$item['mentee_id'];?></td>
                        <td><?=$item['mentor_id'];?></td>
                        <td><?=$item['stamp'];?></td>
                    </tr>
                <?php } }?>
            </table>
            <br /><br /><a href="/admin"> &larr; go back</a>
        </div>
    </div>
</main>
