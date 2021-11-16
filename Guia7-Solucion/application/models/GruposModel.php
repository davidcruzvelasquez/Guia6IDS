<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GruposModel extends CI_Model
{
    public function construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
        $query = $this->db->get("grupos");
        $records = $query->result();
        return $records;
    }

    //Funcion que permite agregar elementos a la tabla grupos
    public function insert($data){
        $this->db->insert("grupos",$data);
        $rows = $this->db->affected_rows();
        return $rows;
    }
    //Funcion que permite eliminar grupos
    public function delete($id){
        if ($this->db->delete("grupos","idgrupo='" . $id ."'")){
            return true;
        }
    }
    ///Funcion que permite consultar grupos por ID
    public function getById($id){
        return $this->db->get_where("grupos",array("idgrupo" => $id))->row();
    }

    ///Funcio que permite modificar.
    public function update($data,$id){
        try{
            $this->db->where("idgrupo", $id);
            $this->db->update("grupos", $data);
            $rows = $this->db->affected_rows();
            return $rows;
        }catch(Exception $ex){
            return -1;
        }
    }
}
