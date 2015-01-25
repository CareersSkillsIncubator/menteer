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

class Questionnaire_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tb = 'questionnaire';

    }

    /**
     * @param array $params
     * @return array|bool
     */
    function get($params = array()) {

        $limit			= isset($params['limit']) ? $params['limit'] : false;
        $order			= isset($params['order']) ? $params['order'] : 'position ASC';
        $id				= isset($params['id']) ? $params['id'] : false;

        $sql			= "SELECT ".$this->tb.".* FROM ".$this->tb." WHERE question != '' ";

        $sql			.= $id ?  "AND id = '".$id."' " : "";
        $sql			.= $order ? " ORDER BY ".$order." " : "";
        $sql			.= $limit ? " LIMIT ".$limit." " : "";

        $data			= $this->db->query($sql)->result_array();

        if ($this->db->affected_rows() == 0)
            return false;

        return $id ? $data[0] : $this->_index($data);
    }

    /**
     * @param $data
     * @return array
     */
    function _index($data) {

        $ret = array();

        foreach ($data as $item){

            $sql = "SELECT * FROM questionnaire_answers WHERE questionnaire_id = " . $item['id'] . ' ORDER BY position ASC';
            $answer_data = $this->db->query($sql)->result_array();

            $ret[$item['id']] = $item;
            $ret[$item['id']]['answer_data'] = $answer_data;

        }
        return $ret;
    }
}