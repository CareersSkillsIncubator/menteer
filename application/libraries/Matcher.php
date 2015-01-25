<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Matcher (Designed for current and specific question set 2015)
 *
 *
 */
class Matcher
{

    /**
     * __construct
     *
     * @return void
     * @author
     **/
    public function __construct()
    {
        $this->load->config('matcher', true);

        // Load the session, CI2 as a library, CI3 uses it as a driver
        if (substr(CI_VERSION, 0, 1) == '2') {
            $this->load->library('session');
        } else {
            $this->load->driver('session');
        }

        $this->load->model('Matcher_model');

    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     *
     **/
    public function __call($method, $arguments)
    {
        if (!method_exists($this->ion_auth_model, $method)) {
            throw new Exception('Undefined method Ion_auth::' . $method . '() called');
        }

        return call_user_func_array(array($this->matcher_model, $method), $arguments);
    }

    /**
     * __get
     *
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * I can't remember where I first saw this, so thank you if you are the original author. -Militis
     *
     * @access    public
     * @param    $var
     * @return    mixed
     */
    public function __get($var)
    {
        return get_instance()->$var;
    }

    // return matches
    public function get_matches($user_id, $num_matches = MAX_MATCHES)
    {
        if (intval($user_id) <= 0) {
            return false;
        }

        // mentee questionnaire info
        $mentee = $this->Matcher_model->get(array('table' => 'users', 'id' => $user_id));
        $mentee_answers = $this->Matcher_model->get(array('table' => 'users_answers', 'user_id' => $user_id));

        //check if valid mentee user_id
        if ($mentee['menteer_type'] != MENTOR_ID) {

            // get initial list of valid and unmatched mentors
            $data = array('get_mentors' => true, 'table' => 'users', 'select' => 'id');
            $mentors = $this->Matcher_model->get($data);

            if (is_array($mentors)) {
                // start the matching process and sort mentors based on questionnaire
                foreach ($mentors as $key => $value) {

                    // get active mentor answers
                    $mentor_answers[$key] = $this->Matcher_model->get(
                        array('table' => 'users_answers', 'user_id' => $key)
                    );

                }

                return $this->_matchulator($mentee_answers, $mentor_answers, $num_matches); // array of matches
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    // specific for CSCI / Menteer.ca
    protected function _matchulator($mentee_array, $mentors_array, $num_matches)
    {

        // record mentee answers for easy comparison
        foreach ($mentee_array as $item) {
            switch ($item['questionnaire_id']) {
                case 2:
                    $q2_mentee_answer = $item['questionnaire_answer_id']; // id example
                    break;
                case 3:
                    $q3_mentee_answer = $item['questionnaire_answer_id'];
                    break;
                case 4:
                    $q4_mentee_answer = $item['questionnaire_answer_text']; // text example
                    break;
                case 5:
                    $q5_mentee_answer[] = $item['questionnaire_answer_id']; // array example
                    break;
                case 6:
                    $q6_mentee_answer[] = $item['questionnaire_answer_id'];
                    break;
                case 7:
                    $q7_mentee_answer[] = $item['questionnaire_answer_id'];
                    break;
                case 9:
                    $q9_mentee_answer[] = $item['questionnaire_answer_text'];
                    break;
                case 10:
                    $q10_mentee_answer[] = $item['questionnaire_answer_text'];
                    break;
                case 12:
                    $q12_mentee_answer[] = $item['questionnaire_answer_text'];
                    break;
                case 13:
                    $q13_mentee_answer[] = $item['questionnaire_answer_text'];
                    break;
                case 14:
                    $q14_mentee_answer[] = $item['questionnaire_answer_text'];
                    break;
                case 15:
                    $q15_mentee_answer[] = $item['questionnaire_answer_text'];
                    break;

                default:
            }
        }

        // Q2
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 2);
        $result = $this->Matcher_model->get($data);
        $q2_weight = $result['importance'];

        // Q3
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 3);
        $result = $this->Matcher_model->get($data);
        $q3_weight = $result['importance'];

        // Q4
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 4);
        $result = $this->Matcher_model->get($data);
        $q4_weight = $result['importance'];

        // Q5
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 5);
        $result = $this->Matcher_model->get($data);
        $q5_weight = $result['importance'];

        // Q6
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 6);
        $result = $this->Matcher_model->get($data);
        $q6_weight = $result['importance'];

        // Q7
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 7);
        $result = $this->Matcher_model->get($data);
        $q7_weight = $result['importance'];

        // Q9
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 9);
        $result = $this->Matcher_model->get($data);
        $q9_weight = $result['importance'];

        // Q10
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 10);
        $result = $this->Matcher_model->get($data);
        $q10_weight = $result['importance'];

        // Q12
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 12);
        $result = $this->Matcher_model->get($data);
        $q12_weight = $result['importance'];

        // Q13
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 13);
        $result = $this->Matcher_model->get($data);
        $q13_weight = $result['importance'];

        // Q14
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 14);
        $result = $this->Matcher_model->get($data);
        $q14_weight = $result['importance'];

        // Q15
        $data = array('table' => 'questionnaire', 'select' => 'importance', 'id' => 15);
        $result = $this->Matcher_model->get($data);
        $q15_weight = $result['importance'];


        // loop through each mentor to get all the data for each question
        foreach ($mentors_array as $mentor) {

            foreach ($mentor as $item) {

                $skip = false;

                if (!isset($score[$item['user_id']])) {
                    $score[$item['user_id']] = 0;
                }
                if (!isset($total[$item['user_id']])) {
                    $total[$item['user_id']] = 0;
                }
                if (!isset($perc[$item['user_id']])) {
                    $perc[$item['user_id']] = 0;
                }

                switch ($item['questionnaire_id']) {
                    case 2: // radio example
                        $q2_mentor_answers[$item['user_id']] = $item['questionnaire_answer_id'];

                        if ($item['questionnaire_answer_id'] == $q2_mentee_answer || $item['questionnaire_answer_id'] == 14 || $q2_mentee_answer == 14) {
                            $score[$item['user_id']] = $score[$item['user_id']] + $q2_weight;
                        }

                        // Q2 Calculations
                        $total[$item['user_id']] += $q2_weight;

                        break;

                    case 3:

                        $q3_mentor_answers[$item['user_id']] = $item['questionnaire_answer_id'];

                        if ($item['questionnaire_answer_id'] == $q3_mentee_answer) {
                            $score[$item['user_id']] = $score[$item['user_id']] + $q3_weight;
                        }

                        // Q3 Calculations
                        $total[$item['user_id']] += $q3_weight;


                        break;

                    case 4:
                        $q4_mentor_answers[$item['user_id']] = $item['questionnaire_answer_text'];

                        if ($item['questionnaire_answer_text'] == $q4_mentee_answer) {
                            $score[$item['user_id']] = $score[$item['user_id']] + $q4_weight;
                        }

                        // Q4 Calculations
                        $total[$item['user_id']] += $q4_weight;

                        break;

                    case 5: // checkbox example

                        // Q5 Calculations
                        if (!isset($q5_mentor_answers[$item['user_id']])) {
                            $total[$item['user_id']] += $q5_weight;
                        }

                        $q5_mentor_answers[$item['user_id']][] = $item['questionnaire_answer_id'];


                        break;

                    case 6:

                        $q6_mentor_answers[$item['user_id']][] = $item['questionnaire_answer_id'];

                        break;

                    case 7:

                        $q7_mentor_answers[$item['user_id']][] = $item['questionnaire_answer_id'];

                        break;

                    case 10:

                        $q10_mentor_answers[$item['user_id']][] = $item['questionnaire_answer_text'];

                        break;
                    case 12:

                        $q12_mentor_answers[$item['user_id']][] = $item['questionnaire_answer_text'];

                        break;
                    case 13:

                        $q13_mentor_answers[$item['user_id']][] = $item['questionnaire_answer_text'];

                        break;
                    case 14:

                        $q14_mentor_answers[$item['user_id']][] = $item['questionnaire_answer_text'];

                        break;
                    case 15:

                        $q15_mentor_answers[$item['user_id']][] = $item['questionnaire_answer_text'];

                        break;


                    default:

                }

                $last_id = $item['user_id'];
            }

            // FINISHING UP NOW


            // Q5
            $r = array_intersect($q5_mentor_answers[$last_id], $q5_mentee_answer);

            if (count($r) > 0 || in_array(17, $q5_mentor_answers[$last_id]) || in_array(17, $q5_mentee_answer)) {
                $score[$item['user_id']] = $score[$item['user_id']] + $q5_weight;
            }


            // Final Questions


            switch ($q3_mentee_answer) {
                case "18": // traditional

                    switch ($q2_mentee_answer) {
                        case "12": // skills

                            $r1 = array_intersect($q10_mentor_answers[$last_id], $q9_mentee_answer);
                            $weight = 10 * count($r1); // q9
                            if(count($r1) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r2 = array_intersect($q12_mentor_answers[$last_id], $q13_mentee_answer);
                            $weight = 250 * count($r2); // q12
                            if(count($r2) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r3 = array_intersect($q14_mentor_answers[$last_id], $q15_mentee_answer);
                            $weight = 250 * count($r3); // q14
                            if(count($r3) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $matches = 0;
                            $weight = 10;
                            foreach($q7_mentor_answers[$last_id] as $item){

                                // mapping to q6
                                $val = 0;
                                switch($item) {
                                    case 27:
                                        $val = 23;
                                        break;
                                    case 28:
                                        $val = 24;
                                        break;
                                    case 29:
                                        $val = 25;
                                        break;
                                    case 30:
                                        $val = 26;
                                        break;
                                }
                                if(in_array($val,$q6_mentee_answer))
                                    $matches++;

                            }
                            if($matches > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            break;
                        case "13": // industry

                            $r1 = array_intersect($q10_mentor_answers[$last_id], $q9_mentee_answer);
                            $weight = 250 * count($r1); // q9
                            if(count($r1) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r2 = array_intersect($q12_mentor_answers[$last_id], $q13_mentee_answer);
                            $weight = 10 * count($r2); // q12
                            if(count($r2) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r3 = array_intersect($q14_mentor_answers[$last_id], $q15_mentee_answer);
                            $weight = 50 * count($r3); // q14
                            if(count($r3) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $matches = 0;
                            $weight = 50;
                            foreach($q7_mentor_answers[$last_id] as $item){

                                // mapping to q6
                                $val = 0;
                                switch($item) {
                                    case 27:
                                        $val = 23;
                                        break;
                                    case 28:
                                        $val = 24;
                                        break;
                                    case 29:
                                        $val = 25;
                                        break;
                                    case 30:
                                        $val = 26;
                                        break;
                                }
                                if(in_array($val,$q6_mentee_answer))
                                    $matches++;

                            }
                            if($matches > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            break;
                        default : // either

                            $r1 = array_intersect($q10_mentor_answers[$last_id], $q9_mentee_answer);
                            $weight = 50 * count($r1); // q9
                            if(count($r1) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r2 = array_intersect($q12_mentor_answers[$last_id], $q13_mentee_answer);
                            $weight = 50 * count($r2); // q12
                            if(count($r2) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r3 = array_intersect($q14_mentor_answers[$last_id], $q15_mentee_answer);
                            $weight = 50 * count($r3); // q14
                            if(count($r3) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $matches = 0;
                            $weight = 50;
                            foreach($q7_mentor_answers[$last_id] as $item){

                                // mapping to q6
                                $val = 0;
                                switch($item) {
                                    case 27:
                                        $val = 23;
                                        break;
                                    case 28:
                                        $val = 24;
                                        break;
                                    case 29:
                                        $val = 25;
                                        break;
                                    case 30:
                                        $val = 26;
                                        break;
                                }
                                if(in_array($val,$q6_mentee_answer))
                                    $matches++;

                            }
                            if($matches > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                    }

                    break;
                case "15": // peer

                    switch ($q2_mentee_answer) {
                        case "12": // skills

                            $r1 = array_intersect($q10_mentor_answers[$last_id], $q9_mentee_answer);
                            $weight = 10 * count($r1); // q9
                            if(count($r1) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r2 = array_intersect($q13_mentor_answers[$last_id], $q13_mentee_answer);
                            $weight = 250 * count($r2); // q12
                            if(count($r2) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r3 = array_intersect($q15_mentor_answers[$last_id], $q15_mentee_answer);
                            $weight = 250 * count($r3); // q14
                            if(count($r3) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $matches = 0;
                            $weight = 10;
                            foreach($q7_mentor_answers[$last_id] as $item){

                                // mapping to q6
                                $val = 0;
                                switch($item) {
                                    case 27:
                                        $val = 23;
                                        break;
                                    case 28:
                                        $val = 24;
                                        break;
                                    case 29:
                                        $val = 25;
                                        break;
                                    case 30:
                                        $val = 26;
                                        break;
                                }
                                if(in_array($val,$q6_mentee_answer))
                                    $matches++;

                            }
                            if($matches > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            break;
                        case "13": // industry

                            $r1 = array_intersect($q10_mentor_answers[$last_id], $q9_mentee_answer);
                            $weight = 250 * count($r1); // q9
                            if(count($r1) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r2 = array_intersect($q13_mentor_answers[$last_id], $q13_mentee_answer);
                            $weight = 250 * count($r2); // q12
                            if(count($r2) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r3 = array_intersect($q15_mentor_answers[$last_id], $q15_mentee_answer);
                            $weight = 250 * count($r3); // q15
                            if(count($r3) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $matches = 0;
                            $weight = 10;
                            foreach($q7_mentor_answers[$last_id] as $item){

                                // mapping to q6
                                $val = 0;
                                switch($item) {
                                    case 27:
                                        $val = 23;
                                        break;
                                    case 28:
                                        $val = 24;
                                        break;
                                    case 29:
                                        $val = 25;
                                        break;
                                    case 30:
                                        $val = 26;
                                        break;
                                }
                                if(in_array($val,$q6_mentee_answer))
                                    $matches++;

                            }
                            if($matches > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            break;
                        default : // either

                            $r1 = array_intersect($q10_mentor_answers[$last_id], $q9_mentee_answer);
                            $weight = 50 * count($r1); // q9
                            if(count($r1) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r2 = array_intersect($q13_mentor_answers[$last_id], $q13_mentee_answer);
                            $weight = 250 * count($r2); // q12
                            if(count($r2) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r3 = array_intersect($q15_mentor_answers[$last_id], $q15_mentee_answer);
                            $weight = 250 * count($r3); // q15
                            if(count($r3) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $matches = 0;
                            $weight = 10;
                            foreach($q7_mentor_answers[$last_id] as $item){

                                // mapping to q6
                                $val = 0;
                                switch($item) {
                                    case 27:
                                        $val = 23;
                                        break;
                                    case 28:
                                        $val = 24;
                                        break;
                                    case 29:
                                        $val = 25;
                                        break;
                                    case 30:
                                        $val = 26;
                                        break;
                                }
                                if(in_array($val,$q6_mentee_answer))
                                    $matches++;

                            }
                            if($matches > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                    }

                    break;

                case "16": // entrepreneur

                    switch ($q2_mentee_answer) {
                        case "12": // skills

                            $r1 = array_intersect($q10_mentor_answers[$last_id], $q9_mentee_answer);
                            $weight = 50 * count($r1); // q9
                            if(count($r1) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r2 = array_intersect($q12_mentor_answers[$last_id], $q13_mentee_answer);
                            $weight = 250 * count($r2); // q12
                            if(count($r2) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r3 = array_intersect($q14_mentor_answers[$last_id], $q15_mentee_answer);
                            $weight = 50 * count($r3); // q14
                            if(count($r3) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $matches = 0;
                            $weight = 10;
                            foreach($q7_mentor_answers[$last_id] as $item){

                                // mapping to q6
                                $val = 0;
                                switch($item) {
                                    case 27:
                                        $val = 23;
                                        break;
                                    case 28:
                                        $val = 24;
                                        break;
                                    case 29:
                                        $val = 25;
                                        break;
                                    case 30:
                                        $val = 26;
                                        break;
                                }
                                if(in_array($val,$q6_mentee_answer))
                                    $matches++;

                            }
                            if($matches > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;
                            break;
                        case "13": // industry

                            $r1 = array_intersect($q10_mentor_answers[$last_id], $q9_mentee_answer);
                            $weight = 50 * count($r1); // q9
                            if(count($r1) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r2 = array_intersect($q12_mentor_answers[$last_id], $q13_mentee_answer);
                            $weight = 50 * count($r2); // q12
                            if(count($r2) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r3 = array_intersect($q14_mentor_answers[$last_id], $q15_mentee_answer);
                            $weight = 250 * count($r3); // q14
                            if(count($r3) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $matches = 0;
                            $weight = 10;
                            foreach($q7_mentor_answers[$last_id] as $item){

                                // mapping to q6
                                $val = 0;
                                switch($item) {
                                    case 27:
                                        $val = 23;
                                        break;
                                    case 28:
                                        $val = 24;
                                        break;
                                    case 29:
                                        $val = 25;
                                        break;
                                    case 30:
                                        $val = 26;
                                        break;
                                }
                                if(in_array($val,$q6_mentee_answer))
                                    $matches++;

                            }
                            if($matches > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            break;
                        default : // either

                            $r1 = array_intersect($q10_mentor_answers[$last_id], $q9_mentee_answer);
                            $weight = 50 * count($r1); // q9
                            if(count($r1) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r2 = array_intersect($q12_mentor_answers[$last_id], $q13_mentee_answer);
                            $weight = 50 * count($r2); // q12
                            if(count($r2) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $r3 = array_intersect($q14_mentor_answers[$last_id], $q15_mentee_answer);
                            $weight = 50 * count($r3); // q14
                            if(count($r3) > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                            $matches = 0;
                            $weight = 10;
                            foreach($q7_mentor_answers[$last_id] as $item){

                                // mapping to q6
                                $val = 0;
                                switch($item) {
                                    case 27:
                                        $val = 23;
                                        break;
                                    case 28:
                                        $val = 24;
                                        break;
                                    case 29:
                                        $val = 25;
                                        break;
                                    case 30:
                                        $val = 26;
                                        break;
                                }
                                if(in_array($val,$q6_mentee_answer))
                                    $matches++;

                            }
                            if($matches > 0)
                                $score[$item['user_id']] = $score[$item['user_id']] + $weight;
                            $total[$last_id] += $weight;

                    }

                    break;

                default : // motivational


            }



            // FINAL CALC
            if ($total[$last_id] != 0) {
                $perc[$last_id] = ($score[$last_id] / $total[$last_id]) * 100;
            }


        }

        // SLICE JUST WHAT WE NEED
        arsort($perc);
        return array_slice($perc, 0, $num_matches, true);

    }

}