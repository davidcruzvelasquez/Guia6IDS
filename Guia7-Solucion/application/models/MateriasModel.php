<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MateriasModel extends CI_Model
{
    public function construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
        $query = $this->db->get("materias");
        $records = $query->result();
        return $records;
    }

    //Funcion que permite agregar elementos a la tabla materias
    public function insert($data){
        $this->db->insert("materias",$data);
        $rows = $this->db->affected_rows();
        return $rows;
    }
    //Funcion que permite eliminar materias
    public function delete($id){
        if ($this->db->delete("materias","idmateria='" . $id ."'")){
            return true;
        }
    }
    ///Funcion que permite consultar materias por ID
    public function getById($id){
        return $this->db->get_where("materias",array("idmateria" => $id))->row();
    }

    ///Funcio que permite modificar.
    public function update($data,$id){
        try{
            $this->db->where("idmateria", $id);
            $this->db->update("materias", $data);
            $rows = $this->db->affected_rows();
            return $rows;
        }catch(Exception $ex){
            return -1;
        }
    }
}
