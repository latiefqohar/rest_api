<?php
 
 
 
 class M_mahasiswa extends CI_Model {
 
     public function getdata($table){
         return $this->db->get($table);
     }

     public function getdata_where($where,$table){
        return $this->db->get_where($table, $where);
     }

     public function delete($table,$w){
        $this->db->delete($table,$w);
        return $this->db->affected_rows();
     }

     public function add($table,$data){
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
        
     }
     public function update($table,$data,$w){
         $this->db->update($table, $data, $w);
         return $this->db->affected_rows();
     }
 
 }
 
 /* End of file M_mahasiswa.php */
  
?>