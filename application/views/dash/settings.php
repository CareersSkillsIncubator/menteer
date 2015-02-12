<main id="main" role="main">
    <div class="container">
        <div class="form-block">
            <h1><span class="icon-settings"></span><i>My Settings</i></h1>

                <?=$this->session->flashdata('message');?>

                <?php $attributes = array('class' => 'form', 'id' => 'settings_form');?>
                <?php echo form_open('dashboard/settings_save',$attributes); ?>
                <div class="carousel">
                    <div class="mask">
                        <div class="slideset">
                            <div class="slide">
                                <div class="form-box">
                                    <strong class="title">Change password</strong>
                                    <div class="holder">
                                        <div class="form-group">
                                            <label class="large" for="oldpassword">Old Password</label>
                                            <input type="password" class="form-control" id="oldpassword" name="oldpassword">
                                        </div>
                                        <div class="form-group">
                                            <label class="large" for="newpassword">New Password</label>
                                            <input type="password" class="form-control" id="newpassword" name="newpassword">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-box">
                                    <strong class="title">Privacy Settings</strong>
                                    <div class="holder">
                                        <div class="form-row">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="share_email" value="1" <?=$settings[0] == 1 ? ' checked="checked"' : '';?>> Share my email with my menteer
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="share_phone" value="1" <?=$settings[1] == 1 ? ' checked="checked"' : '';?>> Share my phone number with my menteer
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="share_location" value="1" <?=$settings[2] == 1 ? ' checked="checked"' : '';?>> Share my location with my menteer
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-box">
                                    <strong class="title">Account Settings</strong>
                                    <div class="holder">
                                        <div class="form-row">
                                            <div class="checkbox">
                                                <label>
                                                    Profile: <input name="enabled" id="switch-state" class="switcher" type="checkbox" <?=$user['enabled'] ? 'checked':'';?> data-size="mini" value="1" data-on-text="Enabled" data-off-text="Disabled">
                                                </label>
                                            </div>
                                        </div>

                                        <?php if($this->session->userdata('user_kind') == 'both'){ ?>

                                            <div class="form-row">
                                                <div class="checkbox">
                                                    <label>
                                                        Menteer Type: <input <?=$user['is_matched'] == 0 ? '':'disabled';?> name="menteer_type" id="switch-state" class="switcher" type="checkbox" <?=$user['menteer_type']==37 ? 'checked':'';?> data-size="mini" value="37" data-on-text="Mentor" data-off-text="Menteer"> <span data-toggle="tooltip" data-placement="bottom" title="This option will be disabled if you are active or waiting on a request"> ? </span>
                                                    </label>
                                                </div>
                                            </div>

                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="form-box">
                                    <strong class="title" style="background-color: red; color:white; text-align: center;">DANGER ZONE</strong>
                                    <div class="holder">
                                        <div class="form-row"><p>&nbsp;</p>
                                            <div class="delete-account">
                                                <a class="btn btn-danger" href="/dashboard/delete" onClick="return confirm('Are you sure you want to delete your account?')">delete account</a>
                                            </div><p>&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <a class="btn-prev icon-arrow hide" href="#"></a>
                    <a class="btn-next icon-arrow2 hide" href="#"></a>
                </div>
                <p>&nbsp;</p>
                <div class="btn-holder">
                    <button class="btn btn-success">save</button> <a href="/dashboard">cancel</a>
                </div>
            <?php form_close(); ?>
        </div>
    </div>
</main>