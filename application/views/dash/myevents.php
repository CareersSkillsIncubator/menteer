<main id="main" role="main" class="intake">
    <div class="container">

        <div class="form-block">

            <?= $this->session->flashdata('message'); ?>

            <div class="form-box">
                <strong class="title"> <a href="/dashboard" style="font-weight: bold;"> &larr; BACK</a>
                </strong>

                <div class="holder" style="min-height:300px;">


                    <?php echo form_open_multipart(
                        "/dashboard/save_event",
                        array('class' => 'form', 'role' => 'form', 'id' => 'profile_form')
                    ); ?>


                    <div class="btn-holder ">
                        <div class="col-xs-8"><input class="form-control" type="text" name="newevent" placeholder="" value=""></div>
                        <button class="btn btn-success profile-save">add event</button>

                        <div style="clear:both;"></div>
                    </div>

                    <?php echo form_close(); ?>

                    <hr/>

                    <h1>My Events</h1>

                    <hr/>

                   <ul>
                       <?php

                       if(!is_array($myevents)){
                           echo "<div align=\"center\">Hey, we didn't find any of your events. Try to add one above.</div>";
                       }else {

                           foreach ($myevents as $myevent) {

                               echo "<li>";
                               echo $myevent['event'];
                               echo " &nbsp;&nbsp;&nbsp;<a style=\"color:red;\" href=\"/dashboard/delete_event/" . encrypt_url(
                                       $myevent['id']
                                   ) . "\"> x </a>";
                               echo "</li>";

                           }
                       }
                       ?>
                   </ul>

                </div>
            </div>
        </div>
</main>