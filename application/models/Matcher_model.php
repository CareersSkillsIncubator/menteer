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

class Matcher_model extends CI_Model
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
        $id				= isset($params['id']) ? $params['id'] : false;
        $user_id			= isset($params['user_id']) ? $params['user_id'] : false;
        $questionnaire_id	= isset($params['questionnaire_id']) ? $params['questionnaire_id'] : false;
        $get_mentors    = isset($params['get_mentors']) ? true : false;
        $select         = isset($params['select']) ? $params['select'] : '*';

        $sql			= "SELECT ".$select." FROM ".$params['table']." WHERE enabled = 1 ";

        $sql            .= $get_mentors ? " AND menteer_type != " . MENTEE_ID . " AND is_matched = 0 " : " ";
        $sql			.= $id ?  " AND id = '".$id."' " : " ";
        $sql			.= $user_id ?  " AND user_id = '".$user_id."' " : " ";
        $sql			.= $questionnaire_id ?  " AND questionnaire_id = '".$questionnaire_id."' " : " ";

        $sql			.= $order ? " ORDER BY ".$order." " : " ";
        $sql			.= $limit ? " LIMIT ".$limit." " : " ";

        $data			= $this->db->query($sql)->result_array();

        if ($this->db->affected_rows() == 0)
            return false;

        return $id ? $data[0] : $this->_index($data);
    }

    /**
     * @param array $params
     * @return bool
     */
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
    function update($params = array()) {

        if(!isset($params['table']))
            return false;

        $this->db->where('id', $params['id']);
        $this->db->update($params['table'], $params['data']);

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