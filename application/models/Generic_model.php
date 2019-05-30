<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generic_model extends CI_Model {

    private $table = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set("America/Sao_Paulo");
    }

    protected function get_table() {
        return $this->table;
    }

    protected function setTable($table) {
        $this->table = $table;
        return $this;
    }

    protected function select() {

    }

    protected function insert($obj) {
        $this->db->insert($this->table, $obj);
        return  $this->db->insert_id();;
    }

    protected function update($id, $data) {

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