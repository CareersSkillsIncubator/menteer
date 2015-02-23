<main id="main" role="main" class="donate">
    <div class="container">

        <div class="form-block">

            <h1>Donation Form</h1>

            <?= $this->session->flashdata('message'); ?>

            <?php
            if(isset($error)){
                echo "<div class=\"alert alert-danger\">".$error."</div>";
            }
            ?>

            <link rel="stylesheet" type="text/css" href="/assets/css/donate.css" media="all">
            <script type="text/javascript" src="https://js.stripe.com/v2"></script>
            <script type="text/javascript">
                Stripe.setPublishableKey('<?php echo $config['publishable-key'] ?>');
            </script>
            <script type="text/javascript" src="/assets/js/donate.js"></script>

            <p>
                <?=nl2br($content[3]['description'])?>
            </p>

            <div class="messages">
                <!-- Error messages go here go here -->
            </div>

            <?php echo form_open(
                "/dashboard/donate",
                array('class' => 'form donation-form', 'role' => 'form', 'id' => 'donation-form', 'method' => 'POST')
            ); ?>

            <legend>
                Contact Information
            </legend>
                <fieldset>

                    <div class="form-row form-first-name">
                        <label>First Name</label>
                        <input type="text" name="first-name" class="first-name text" value="<?=$this->input->post('first-name');?>">
                    </div>
                    <div class="form-row form-last-name">
                        <label>Last Name</label>
                        <input type="text" name="last-name" class="last-name text" value="<?=$this->input->post('last-name');?>">
                    </div>
                    <div class="form-row form-email">
                        <label>Email</label>
                        <input type="text" name="email" class="email text" value="<?=$this->input->post('email');?>">
                    </div>
                    <div class="form-row form-address">
                        <label>Address</label>
                        <textarea name="address" cols="30" rows="2" class="address text"><?=$this->input->post('address');?></textarea>
                    </div>
                    <div class="form-row form-city">
                        <label>City</label>
                        <input type="text" name="city" class="city text" value="<?=$this->input->post('city');?>">
                    </div>
                    <div class="form-row form-state">
                        <label>Prov/State</label>
                        <select name="state" class="state text">
                            <?php
                            if($this->input->post('state'))
                            echo "<option value=\"".$this->input->post('state')."\" selected=\"selected\">".$this->input->post('state')."</option>";
                            ?>
                            <option value="ON">Ontario</option>
                            <option value="AB">Alberta</option>
                            <option value="BC">British Columbia</option>
                            <option value="MB">Manitoba</option>
                            <option value="NB">New Brunswick</option>
                            <option value="NL">Newfoundland and Labrador</option>
                            <option value="NS">Nova Scotia</option>
                            <option value="PE">Prince Edward Island</option>
                            <option value="QC">Quebec</option>
                            <option value="SK">Saskatchewan</option>
                            <option value="NT">Northwest Territories</option>
                            <option value="NU">Nunavut</option>
                            <option value="YT">Yukon</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div class="form-row form-zip">
                        <label>Postal/Zip</label>
                        <input type="text" name="zip" class="zip text" value="<?=$this->input->post('zip');?>">
                    </div>
                </fieldset>

            <p&nbsp;></p>
            <legend>
                Your Generous Donation
            </legend>

                <fieldset>

                    <div class="form-row form-amount">
                        <label><input type="radio" name="amount" class="set-amount" value="25"> $25</label>
                        <label><input type="radio" name="amount" class="set-amount" value="50"> $50</label>
                        <label><input type="radio" name="amount" class="set-amount" value="75"> $75</label>
                        <label><input type="radio" name="amount" class="set-amount" value="100"> $100</label>

                        <label><input type="radio" name="amount" class="other-amount" value="0"> Other:</label>
                        $<input type="text" class="amount text" disabled>
                    </div>
                    <div class="form-row form-number">
                        <label>Card Number</label>
                        <input type="text" autocomplete="off" class="card-number text" value="">
                    </div>
                    <div class="form-row form-cvc">
                        <label>CVC</label>
                        <input type="text" autocomplete="off" class="card-cvc text" value="">
                    </div>
                    <div class="form-row form-expiry">
                        <label>Expiration Date</label>

                        <?php
                        $month= date("m");
                        ?>

                        <select class="card-expiry-month text">
                            <option value="01" <?=$month=="01"? 'selected="selected"':'';?>>January</option>
                            <option value="02" <?=$month=="02"? 'selected="selected"':'';?>>February</option>
                            <option value="03" <?=$month=="03"? 'selected="selected"':'';?>>March</option>
                            <option value="04" <?=$month=="04"? 'selected="selected"':'';?>>April</option>
                            <option value="05" <?=$month=="05"? 'selected="selected"':'';?>>May</option>
                            <option value="06" <?=$month=="06"? 'selected="selected"':'';?>>June</option>
                            <option value="07" <?=$month=="07"? 'selected="selected"':'';?>>July</option>
                            <option value="08" <?=$month=="08"? 'selected="selected"':'';?>>August</option>
                            <option value="09" <?=$month=="09"? 'selected="selected"':'';?>>September</option>
                            <option value="10" <?=$month=="10"? 'selected="selected"':'';?>>October</option>
                            <option value="11" <?=$month=="11"? 'selected="selected"':'';?>>November</option>
                            <option value="12" <?=$month=="12"? 'selected="selected"':'';?>>December</option>
                        </select>
                        <select class="card-expiry-year text">

                            <? for ($year = date("Y"); $year < date("Y") + 10; ++$year) { ?>
                                <option value="<?= $year ?>"><?= $year ?></option>
                            <? } ?>

                        </select>
                    </div>
                    <div class="form-row form-submit">
                        <input type="submit" class="submit-button btn btn-primary" value="Submit Donation">

                        <?php
                        if($config['test-mode']==true)
                            echo "<div style=\"color:red;\">IN TEST MODE</div>";
                        ?>
                    </div>
                </fieldset>
            </form>


            <?php echo form_close(); ?>
        </div>
</main>