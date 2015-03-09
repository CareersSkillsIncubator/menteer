<main id="main" role="main" class="intake">
    <div class="container">

        <div id="top" class="form-block">

            <h1>Menteer Dashboard</h1>

            <?php

            $private = explode(',',$match['privacy_settings']);

            ?>

            <?= $this->session->flashdata('message'); ?>

            <?php echo form_open_multipart(
                "#",
                array('class' => 'form', 'role' => 'form', 'id' => 'profile_form')
            ); ?>
            <div class="carousel">
                <div class="mask">
                    <div class="slideset">

                        <div data-cycle-hash="register" class="slide register_slide">

                            <?php
                            // determine match status

                            $status = "pending";

                            if ($match['is_matched'] > 0 && $match['match_status'] == 'pending') {
                                $status = "waiting";
                            }

                            if ($match['is_matched'] > 0 && $match['match_status'] == 'active') {
                                $status = "matched";
                            }

                            ?>


                            <div class="form-box">
                                <strong class="title"> <a href="/dashboard" style="font-weight: bold;"> &larr; BACK</a> <span
                                        style="float:right;"><a href="#">STATUS: <?= strtoupper(
                                                $status
                                            ) ?></a> </span> </strong>

                                <div class="holder" style="min-height:620px; line-height: 20px;">

                                    <?php
                                    //determine picture filename

                                    $pic_src = "/assets/images/img5.png";

                                    if($match['picture'])
                                        $pic_src = "/uploads/".$match['picture'];

                                    ?>

                                    <div class="col-xs-12">
                                        <div class="img-box">
                                            <img style="float:left; padding-right:10px;" class="col-xs-7"
                                                 src="<?=$pic_src?>"
                                                 alt="<?= $match['first_name'] ?> <?= $match['last_name'] ?>">
                                        </div>


                                        <h4 style="font-weight: bold; padding-left:10px;">
                                            <?= $match['first_name'] ?> <?= $match['last_name'] ?>
                                        </h4>

                                        <p><?= $match['menteer_type'] == 37 ? 'Mentor' : ''; ?><?= $match['menteer_type'] == 38 ? 'Mentee' : ''; ?><?= $match['menteer_type'] == 41 ? 'Mentee/Mentor' : ''; ?></p>

                                        <div style="clear:both;"></div>

                                        <h5 class=" <?=$private[0] ? '':'hide';?> col-xs-12" style="margin-top:15px; margin-bottom:15px; text-align: center;"><a href="mailto:<?= $match['email'] ?>">
                                                <?=$this->session->userdata('demo') == 1 ? '**********'.substr($match['email'],strpos($match['email'],'@'),28) : $match['email'];?>
                                            </a></h5>

                                        <div style="clear:both;"></div>

                                        <p style="font-size:.8em; text-align: center;" ><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <a href="#" data-toggle="modal" data-target="#myModalMessage">Send Message</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <a href="#" data-toggle="modal" data-target="#myModalMeeting">Book Meeting</a></p>

                                        <div style="clear:both;"></div>


                                        <hr/>

                                        <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6 <?=$private[2] ? '':'hide';?>"><?= $match['location'] ?></div>
                                        <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6 <?=$private[1] ? '':'hide';?>"><?=$this->session->userdata('demo') == 1 ? '*** - *** - ****' : $match['phone'];?></div>


                                        <div class="col-xs-12">
                                            <hr/>

                                            <div style="clear:both;"></div>
                                            <strong class="title"> CAREER STATUS</strong>
                                            <div class="well"><?= $match['career_status'] ?></div>

                                            <div style="clear:both;"></div>
                                            <strong class="title"> CAREER GOALS</strong>
                                            <div class="well"><?= $match['career_goals'] ?></div>

                                            <div style="clear:both;"></div>
                                            <strong class="title"> EDUCATION</strong>
                                            <div class="well"><?= $match['education'] ?></div>


                                            <div style="clear:both;"></div>
                                            <strong class="title"> EXPERIENCE</strong>
                                            <div class="well"><?= $match['experience'] ?></div>

                                            <div style="clear:both;"></div>
                                            <strong class="title"> SKILLS</strong>
                                            <div class="well"><?= $match['skills'] ?></div>


                                            <div style="clear:both;"></div>
                                            <strong class="title"> PASSION</strong>
                                            <div class="well"><?= $match['passion'] ?></div>

                                        </div>

                                    </div>

                                </div>

                                <div align="center" style="padding-bottom: 10px;"><a onclick="return confirm('Are you sure you would like to end this match?');" class="btn btn-danger" href="/dashboard/end/<?=encrypt_url($user['is_matched'])?>">End Match</a></div>

                            </div>

                            <a href="/dashboard" class="btn btn-primary">BACK</a>

                            <a href="#top" class="btn btn-default fright">TOP</a>

                        </div>
                    </div>

                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
</main>
<!-- Send Message -->
<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel">Send A Message</h2>
            </div>
            <div class="modal-body">

                <?php $attributes = array('class' => 'form', 'id' => 'message_form');?>
                <?php echo form_open('dashboard/send_message',$attributes); ?>
                <div class="form-group">
                    <div class="form-row col-xs-8">
                        <input type="text" class="form-control col-xs-4" id="message_subject" name="message_subject" placeholder="subject">
                    </div>
                </div>
                <div class="form-group col-xs-8">
                        <textarea class="form-control" rows="6" name="message_body" id="message_body" placeholder="your message here"></textarea>
                </div>
                    <div style="clear:both;"></div>
                    <button type="submit" class="btn btn-default">Send</button>
                </form>

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default close" data-dismiss="modal" aria-label="Close">Close</a>

            </div>
        </div>
    </div>
</div>
<!-- Send Meeting Invite -->
<div class="modal fade" id="myModalMeeting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel">Book Meeting Request</h2>
            </div>
            <div class="modal-body">

                <?php $attributes = array('class' => 'form', 'id' => 'meeting_form');?>
                <?php echo form_open('dashboard/send_meeting',$attributes); ?>
                <div class="form-group">
                    <div class="form-row col-xs-8">
                        <input type="text" class="form-control col-xs-4" id="meeting_subject" name="meeting_subject" placeholder="subject">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row col-xs-8">

                        <?php
                        $month = date('m');
                        $day = date('j');
                        ?>
                        <select name="month" id="month">
                            <option value="1"  <?PHP if($month==1) echo "selected";?>>January</option>
                            <option value="2"  <?PHP if($month==2) echo "selected";?>>February</option>
                            <option value="3"  <?PHP if($month==3) echo "selected";?>>March</option>
                            <option value="4"  <?PHP if($month==4) echo "selected";?>>April</option>
                            <option value="5"  <?PHP if($month==5) echo "selected";?>>May</option>
                            <option value="6"  <?PHP if($month==6) echo "selected";?>>June</option>
                            <option value="7"  <?PHP if($month==7) echo "selected";?>>July</option>
                            <option value="8"  <?PHP if($month==8) echo "selected";?>>August</option>
                            <option value="9"  <?PHP if($month==9) echo "selected";?>>September</option>
                            <option value="10" <?PHP if($month==10) echo "selected";?>>October</option>
                            <option value="11" <?PHP if($month==11) echo "selected";?>>November</option>
                            <option value="12" <?PHP if($month==12) echo "selected";?>>December</option>
                        </select>

                        <select name="day" id="day">
                            <option value="1"  <?PHP if($day==1) echo "selected";?>>1</option>
                            <option value="2"  <?PHP if($day==2) echo "selected";?>>2</option>
                            <option value="3"  <?PHP if($day==3) echo "selected";?>>3</option>
                            <option value="4"  <?PHP if($day==4) echo "selected";?>>4</option>
                            <option value="5"  <?PHP if($day==5) echo "selected";?>>5</option>
                            <option value="6"  <?PHP if($day==6) echo "selected";?>>6</option>
                            <option value="7"  <?PHP if($day==7) echo "selected";?>>7</option>
                            <option value="8"  <?PHP if($day==8) echo "selected";?>>8</option>
                            <option value="9"  <?PHP if($day==9) echo "selected";?>>9</option>
                            <option value="10" <?PHP if($day==10) echo "selected";?>>10</option>
                            <option value="11" <?PHP if($day==11) echo "selected";?>>11</option>
                            <option value="12" <?PHP if($day==12) echo "selected";?>>12</option>
                            <option value="13" <?PHP if($day==13) echo "selected";?>>13</option>
                            <option value="14" <?PHP if($day==14) echo "selected";?>>14</option>
                            <option value="15" <?PHP if($day==15) echo "selected";?>>15</option>
                            <option value="16" <?PHP if($day==16) echo "selected";?>>16</option>
                            <option value="17" <?PHP if($day==17) echo "selected";?>>17</option>
                            <option value="18" <?PHP if($day==18) echo "selected";?>>18</option>
                            <option value="19" <?PHP if($day==19) echo "selected";?>>19</option>
                            <option value="20" <?PHP if($day==20) echo "selected";?>>20</option>
                            <option value="21" <?PHP if($day==21) echo "selected";?>>21</option>
                            <option value="22" <?PHP if($day==22) echo "selected";?>>22</option>
                            <option value="23" <?PHP if($day==23) echo "selected";?>>23</option>
                            <option value="24" <?PHP if($day==24) echo "selected";?>>24</option>
                            <option value="25" <?PHP if($day==25) echo "selected";?>>25</option>
                            <option value="26" <?PHP if($day==26) echo "selected";?>>26</option>
                            <option value="27" <?PHP if($day==27) echo "selected";?>>27</option>
                            <option value="28" <?PHP if($day==28) echo "selected";?>>28</option>
                            <option value="29" <?PHP if($day==29) echo "selected";?>>29</option>
                            <option value="30" <?PHP if($day==30) echo "selected";?>>30</option>
                            <option value="31" <?PHP if($day==31) echo "selected";?>>31</option>
                        </select>

                        <select name="year" id="year">
                            <?PHP for($i=date("Y"); $i<=date("Y")+2; $i++)
                                if(isset($year) && $year == $i)
                                    echo "<option value='$i' selected>$i</option>";
                                else
                                    echo "<option value='$i'>$i</option>";
                            ?>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row col-xs-8">

                        <select name="start_time" class="col-xs-3" style="margin-right:3px;">
                            <option value="0">Start Time</option>
                            <option value="1:00">1:00</option>
                            <option value="1:30">1:30</option>
                            <option value="2:00">2:00</option>
                            <option value="2:30">2:30</option>
                            <option value="3:00">3:00</option>
                            <option value="3:30">3:30</option>
                            <option value="4:00">4:00</option>
                            <option value="4:30">4:30</option>
                            <option value="5:00">5:00</option>
                            <option value="5:30">5:30</option>
                            <option value="6:00">6:00</option>
                            <option value="6:30">6:30</option>
                            <option value="7:00">7:00</option>
                            <option value="7:30">7:30</option>
                            <option value="8:00">8:00</option>
                            <option value="8:30">8:30</option>
                            <option value="9:00">9:00</option>
                            <option value="9:30">9:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                        </select>

                        <select name="start_ampm" class="col-xs-2 " style="margin-right:3px;">
                            <option value="am">AM</option>
                            <option value="pm">PM</option>
                        </select>

                        <select name="end_time" class="col-xs-3" style="margin-right:3px;">
                            <option value="0">End Time</option>
                            <option value="1:00">1:00</option>
                            <option value="1:30">1:30</option>
                            <option value="2:00">2:00</option>
                            <option value="2:30">2:30</option>
                            <option value="3:00">3:00</option>
                            <option value="3:30">3:30</option>
                            <option value="4:00">4:00</option>
                            <option value="4:30">4:30</option>
                            <option value="5:00">5:00</option>
                            <option value="5:30">5:30</option>
                            <option value="6:00">6:00</option>
                            <option value="6:30">6:30</option>
                            <option value="7:00">7:00</option>
                            <option value="7:30">7:30</option>
                            <option value="8:00">8:00</option>
                            <option value="8:30">8:30</option>
                            <option value="9:00">9:00</option>
                            <option value="9:30">9:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                        </select>

                        <select name="end_ampm" class="col-xs-2 " style="margin-right:3px;">
                            <option value="am">AM</option>
                            <option value="pm">PM</option>
                        </select>
                         &nbsp;<small style="color:blue;"><em>EST</em></small>

                    </div>
                </div>



                <div class="form-group col-xs-8">
                    <textarea class="form-control" rows="6" name="meeting_desc" id="meeting_desc" placeholder="your message here"></textarea>
                </div>
                <div style="clear:both;"></div>
                <button type="submit" class="btn btn-default">Request Meeting</button>
                </form>

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default close" data-dismiss="modal" aria-label="Close">Close</a>

            </div>
        </div>
    </div>
</div>