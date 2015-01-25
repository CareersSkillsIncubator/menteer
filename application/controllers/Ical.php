<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ical extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Application_model');

    }

    public function index()
    {

        die('meeting not found');

    }

    public function q($id)
    {

        $id = decrypt_url($id);

        if($id > 0) {

            $ical = $this->Application_model->get(array('table'=>'meetings','id'=>$id));

            //print_r($ical);

            $ical['month'] = sprintf('%02d', $ical['month']);
            $ical['day'] = sprintf('%02d', $ical['day']);

            $date = $ical['year'].$ical['month'].$ical['day'];

            $startTime  = date("Hi", strtotime( $ical['start_time']. " " .  $ical['start_ampm'])) + 500;
            $endTime  = date("Hi", strtotime( $ical['end_time']. " " .  $ical['end_ampm'])) + 500;

            $subject = $ical['meeting_subject'];
            $desc = $ical['meeting_desc'];

            $ical = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Google Inc//Google Calendar 70.9054//EN
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:PUBLISH
BEGIN:VEVENT
UID:" . md5(uniqid(mt_rand(), true)) . "menteer.ca
DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z
DTSTART:".$date."T".$startTime."00Z
DTEND:".$date."T".$endTime."00Z
SUMMARY:".$subject."
DESCRIPTION:".$desc."
LOCATION:
SEQUENCE:0
STATUS:CONFIRMED
TRANSP:OPAQUE
END:VEVENT
END:VCALENDAR";

            //set correct content-type-header
            header('Content-type: text/calendar; charset=utf-8');
            header('Content-Disposition: inline; filename=calendar.ics');
            echo $ical;
            exit;


        }else{

            die('meeting not found');

        }

    }

}
