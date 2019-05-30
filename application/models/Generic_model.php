<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generic_model extends CI_Model {

    public $table = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set("America/Sao_Paulo");
    }

    function get_table() {
        return $this->table;
    }

    function get_var($var, $id) {
        $query = $this->db->get_where($this->table, array('ID' => (int) $id));
        $result = $query->result();
        if (sizeof($result) == 1) {
            return $result[0]->$var;
        }else
            return '';
    }

    function get_all() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    function custom_sql($args = array()) {
        if (isset($args['orderby']) && is_array($args['orderby'])) {

            $this->db->order_by($args['orderby']['field'], $args['orderby']['type']);

        }

        if (isset($args['limit']) && is_array($args['limit'])) {

            $this->db->limit((int) $args['limit']['size'], (int) $args['limit']['offset']);

        }

        if ( isset( $args['where'] ) ) {

            foreach($args['where'] as $key => $value){

                $this->db->where($key, $value);

            }

        }

        $query = $this->db->get($this->table);
        return $query->result();
    }

    function count_all() {
        return $this->db->count_all($this->table);
    }

    function get_by_id($id) {
        $query = $this->db->get_where($this->table, array('ID' => $id));
        $result = $query->result();
        if (sizeof($result) == 1) {
            return $result[0];
        }else
            return false;
    }

    function get_by_field($field, $value) {
        $query = $this->db->get_where($this->table, array($field => $value));

        $result = $query->result();
        if (sizeof($result) == 1) {
            return $result[0];
        }else
            return false;
    }

    function get_all_by_field($field, $value) {
        $query = $this->db->get_where($this->table, array($field => $value));
        return $query->result();
    }

    function insert($obj, $date_time = TRUE) {
        /* codigo oracle  */
        $this->db->set('ID', $this->sequence.".NEXTVAL", FALSE);
        // if ($date_time) $obj->DT_CADASTRO = date('d/m/y H:i:s,0');
        $isInsert= $this->db->insert($this->table, $obj);
        if($isInsert){
            $this->db->select($this->sequence.'.CURRVAL ID FROM DUAL');
            $query = $this->db->get();
            $result = $query->result();
        }
        return  $result[0]->ID;
    }

    function update($id, $data) {

        if(is_array($data)){
            foreach ($data as $key => $value) {
                $data[$key] = trim($value);
            }
        }

        if(is_object($data)){
            foreach ($data as $key => $value) {
                $data->$key = trim($value);
            }
        }

        $this->db->where('ID', $id);
        return $this->db->update($this->table, $data);
    }

    function delete($id) {
        return $this->db->delete($this->table, array('ID' => $id));
    }

    function custom_delete($key, $value) {
        return $this->db->delete($this->table, array($key => $value));
    }

}