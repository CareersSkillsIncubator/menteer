<main id="main" role="main" class="donate">
    <div class="container">

        <div class="form-block">

            <h1>Thanks for the Donation!</h1>

            <?= $this->session->flashdata('message'); ?>


            <p>
                <?=nl2br($content[4]['description'])?>
            </p>

            <a href="/dashboard">&larr; Back To Dashboard</a>

        </div>
</main>