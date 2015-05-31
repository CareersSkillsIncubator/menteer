<main id="main" role="main" class="intake">
    <div class="container">

        <div class="form-block">

            <?= $this->session->flashdata('message'); ?>

            <div class="form-box">
                <strong class="title"> <a href="/dashboard" style="font-weight: bold;"> &larr; BACK</a>
                </strong>

                <div class="holder" style="min-height:300px;">


                    <?php echo form_open_multipart(
                        "/dashboard/save_task",
                        array('class' => 'form', 'role' => 'form', 'id' => 'profile_form')
                    ); ?>


                    <div class="btn-holder ">
                        <div class="col-xs-8"><input class="form-control" type="text" name="newtask" placeholder="" value=""></div>
                        <button class="btn btn-success profile-save">add task</button>

                        <div style="clear:both;"></div>
                    </div>

                    <?php echo form_close(); ?>

                    <hr/>

                    <h1>My Tasks</h1>

                    <hr/>

                   <ul>
                       <?php

                       if(!is_array($mytasks)){
                           echo "<div align=\"center\">Hey, we didn't find any of your tasks. Try to add one above.</div>";
                       }else {

                           foreach ($mytasks as $mytask) {

                               echo "<li>";
                               echo $mytask['task'];
                               echo " &nbsp;&nbsp;&nbsp;<a style=\"color:red;\" href=\"/dashboard/delete_task?id=" . encrypt_url(
                                       $mytask['id']
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