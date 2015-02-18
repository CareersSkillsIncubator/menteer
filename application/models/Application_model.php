<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Menteer
 *
 * Original Code is Menteer, Released January 2015
 *
 * The initial developer of the Original Code is CSCI (CareerSkillsIncubator) with
 * the generous support from CIRA.ca (Community Investment Program)
 *
 *
 */

// multipurpose model
class Application_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @param array $params
     * @return array|bool
     */
    function get($params = array()) {

        if(!isset($params['table']))
            return false;

        $limit			= isset($params['limit']) ? $params['limit'] : false;
        $order			= isset($params['order']) ? $params['order'] : false;
        $group_by		= isset($params['group_by']) ? $params['group_by'] : false;

        $id				= isset($params['id']) ? $params['id'] : false;
        $user_id		= isset($params['user_id']) ? $params['user_id'] : false;
        $users_id		= isset($params['users_id']) ? $params['users_id'] : false;

        $my_tasks		= isset($params['user_task_id']) ? $params['user_task_id'] : false;


        $questionnaire_id	= isset($params['questionnaire_id']) ? $params['questionnaire_id'] : false;
        $mentors        = isset($params['mentors']) ? true : false;
        $mentees        = isset($params['mentees']) ? true : false;
        $both           = isset($params['both']) ? true : false;
        $matched           = isset($params['matched']) ? true : false;

        if($group_by)
            $sql        = "SELECT answer, COUNT(*) FROM ".$params['table']." WHERE id !='' ";
        else
           $sql			= "SELECT * FROM ".$params['table']." WHERE id != '' ";

        $sql			.= $id ?  " AND id = '".$id."' " : " ";
        $sql			.= $user_id ?  " AND user_id = '".$user_id."' " : " ";
        $sql			.= $users_id ?  " AND users_id = '".$users_id."' " : " ";
        $sql			.= $questionnaire_id ?  " AND questionnaire_id = '".$questionnaire_id."' " : " ";

        $sql            .= $my_tasks ? " AND user_id = '" . $my_tasks . "' " : "";
        $sql            .= $mentors ? " AND menteer_type=37 " : " ";
        $sql            .= $mentees ? " AND menteer_type=38 " : " ";
        $sql            .= $both ? " AND questionnaire_answer_id=41 AND questionnaire_id=16 " : " ";
        $sql            .= $matched ? " AND match_status='active' " : " ";

        $sql            .= $group_by ? " GROUP BY ".$group_by." " : " ";
        $sql			.= $order ? " ORDER BY ".$order." " : " ";
        $sql			.= $limit ? " LIMIT ".$limit." " : " ";

        $data			= $this->db->query($sql)->result_array();

        if ($this->db->affected_rows() == 0)
            return false;

        if($group_by)
            return $data;

        return $id || $user_id || $users_id ? $data[0] : $this->_index($data);
    }

    function save_batch($params = array()) {

        if(!isset($params['table']))
            return false;

        $this->db->insert_batch($params['table'], $params['data']);

        return true;

    }

    /**
     * @param array $params
     * @return bool
     */
    function delete($params = array()) {

        if(!isset($params['table']))
            return false;

        if(!isset($params['key']))
            return false;

        if(!isset($params['value']))
            return false;

        $this->db->delete($params['table'], array($params['key'] => $params['value']));

    }

    /**
     * @param array $params
     * @return bool
     */
    function update($params = array()) {

        if(!isset($params['table']))
            return false;

        $this->db->where('id', $params['id']);
        $this->db->update($params['table'], $params['data']);

    }

    /**
     * @param array $params
     * @return bool
     */
    function insert($params = array()) {

        if(!isset($params['table']))
            return false;

        $this->db->insert($params['table'], $params['data']);

        return $this->db->insert_id();

    }

    /*
     * @param varchar table name
     */
    function reset($table) {

        $this->db->empty_table($table);

        return true;
    }

    /**
     * @param $data
     * @return array
     */
    function _index($data) {

        $ret = array();

        foreach ($data as $item){

            $ret[$item['id']] = $item;
        }
        return $ret;
    }
}