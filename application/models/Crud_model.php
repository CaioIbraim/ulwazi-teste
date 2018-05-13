<?php
class Crud_Model extends CI_Model
{
    public function get_total_pessoas()
    {
        $query = $this->db->select("COUNT(*) as num")->get("sc_audit.tb_pessoa");
        $result = $query->row();
        if(isset($result))
           return $result->num;
        return 0;
    }
    public function select_where($id_table, $id_post, $table){
      $tabelas = explode(",", trim($table));
      $totTab = count($tabelas);
      if($totTab === 1){
         $query = $this->db->get_where($tabelas[0], array($id_table => $id_post));

         if(count($query->result_array()) > 0){
            return $query->result_array();
         }
          show_error($message = "Nenhuma informação encontrada.", $status_code="500", $heading = 'An Error Was Encountered');
      }




         $this->db->select('*');
         $this->db->from($tabelas[0]);
            for($i = 1; $i < $totTab; $i++){
               $this->db->join("$tabelas[$i]","$tabelas[$i].$id_table = $tabelas[0].$id_table");
            }
         $this->db->where("$tabelas[0].$id_table", "$id_post");
         $query = $this->db->get();

         return  $query->result_array();

    }
    //manobrando com update de tabelas
    public function update($id_tabela, $id_post,$data,$table){
       $this->db->where($id_tabela, $id_post);
       $this->db->update($table, $data);
    }

    //Aceitando a colaboração
    public function acept($id1, $id2){
        $this->db->set('status', '1');
        $this->db->where('follower', $id1);
        $this->db->where('followed', $id2);
        $this->db->update('follow');
    }

    public function update_pesquisa_usuario($id_login, $id_pesquisa,$data){
       $this->db->where('id_login', $id_login);
       $this->db->where('id_pesquisa', $id_pesquisa);
       $this->db->update('pesquisa_usuario', $data);
    }
    //manobrando com insert de tabelas
    public function insert($data,$table){
      $this->db->insert($table, $data);
    }
    //manobrando com insert de tabelas
    public function delete($id_table,$id_post,$table){
      $this->db->delete($table, array($id_table => $id_post)); // Produces: // DELETE FROM mytable  // WHERE id = $id
    }
}
