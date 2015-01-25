<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Application_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function get($params = array()) {

        if(!isset($params['table']))
            return false;

        $limit			= isset($params['limit']) ? $params['limit'] : false;
        $order			= isset($params['order']) ? $params['order'] : false;
        $id				= isset($params['id']) ? $params['id'] : false;
        $user_id			= isset($params['user_id']) ? $params['user_id'] : false;
        $questionnaire_id	= isset($params['questionnaire_id']) ? $params['questionnaire_id'] : false;

        $sql			= "SELECT * FROM ".$params['table']." WHERE id != '' ";

        $sql			.= $id ?  " AND id = '".$id."' " : " ";
        $sql			.= $user_id ?  " AND user_id = '".$user_id."' " : " ";
        $sql			.= $questionnaire_id ?  " AND questionnaire_id = '".$questionnaire_id."' " : " ";

        $sql			.= $order ? " ORDER BY ".$order." " : " ";
        $sql			.= $limit ? " LIMIT ".$limit." " : " ";

        $data			= $this->db->query($sql)->result_array();

        if ($this->db->affected_rows() == 0)
            return false;

        return $id || $user_id ? $data[0] : $this->_index($data);
    }

    function save_batch($params = array()) {

        if(!isset($params['table']))
            return false;

        $this->db->insert_batch($params['table'], $params['data']);

        return true;

    }

    function update($params = array()) {

        if(!isset($params['table']))
            return false;

        $this->db->where('id', $params['id']);
        $this->db->update($params['table'], $params['data']);

    }

    function insert($params = array()) {

        if(!isset($params['table']))
            return false;

        $this->db->insert($params['table'], $params['data']);

        return $this->db->insert_id();

    }

    function _index($data) {

        $ret = array();

        foreach ($data as $item){

            $ret[$item['id']] = $item;
        }
        return $ret;
    }
}