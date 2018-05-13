<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Follow extends MY_Controller {

    public function __construct() {
      parent::__construct();
      $this->data['title'] = 'Contatos';
      $this->data['url_pagina'] = base_url().''.$this->uri->segment(1);
      if($this->session->login === NULL || $this->session->login === FALSE){
        redirect('login/logout');
      }
    }

    public function index() {
      //Retornar usuários que ainda não foram seguidos
      $id = $this->session->id;
      //Apresenta usuários que estão sendo seguidos
      $seg = $this->db->query('select id_login, perfil, nome, cel, email from login where id_login in (select followed from follow where follower = '.$id.' and status = 1)')->result_array();
      //Quantidade se solicitações enviadas
      $sol = $this->db->query('select * FROM follow WHERE follower = '.$id.'  and status = 0')->result_array();
      $this->data['seguindo'] = ''; //Receber todas as pessoas que está seguindo
      if(count($seg) === 0){
          $this->data['seguindo'] = 'Você não está seguindo nenhum usuário até o momento.';
      }
      $this->data['dtSeg'] = $this->htmlSugest($seg);
      $this->data['solicitacao'] = '';
      if(count($sol) > 0){
        $this->data['solicitacao'] = 'Você solicitou '.count($sol).'';
      }
      //Apresenta sugestões de usuários para serem seguidos
      //Criar função para retornar todos os usuários de forma dinâmica
      $sugest = $this->db->query('select id_login, perfil, nome, cel, email from login where id_login not in (select followed from follow where follower = '.$id.' and status >= 0) and id_login <> '.$id.' limit 10 ')->result_array();
      $this->data['sugest'] = $this->htmlSugest($sugest); //Criar função para formatar html com as sugestões
      //Apresenta os seguidores
      $seguidores = $this->db->query('select id_login, perfil, nome, cel, email from login where id_login in (select follower from follow where followed = '.$id.' and status = 1)')->result_array();
      $this->data['seguidores'] = $seguidores;
      $this->data['conteudo'] = $this->parser->parse('telas/followed',$this->data,true);
      $this->parser->parse('layout/landing', $this->data);
    }

    public function follo($id_post){
      $id =  $this->session->id;
      if($id_post === $id){
        parent::exibeErro('Não pode seguir Você mesmo');
      }

      $v = $this->db->query('select * from follow where follower = '.$id.' and followed = '.$id_post.'')->result_array();
      $s = $this->db->query('select nome from login where id_login = '.$id_post.'')->result_array();
      if(count($v) !== 0){
          parent::exibeErro('Já está seguindo '.$s[0]['nome'].'');
      }
      $data['follower'] = $id;
      $data['followed'] =  $id_post;
      $data['status']   =  0;
      $this->load->model('Crud_model', 'p');
      $query = $this->p->insert($data,'follow');
      parent::exibeErro('A solicitação para '.$s[0]['nome'].' foi enviada.');
    }



    public function acept($id){
      $s = $this->db->query('select * from follow where follower = '.$id.' and followed = '.$this->session->id.' and status = 1 limit 1 ')->result_array();
      if(count($s) !== 0){
          parent::exibeErro('Já existe essa solicitação');
      }
      $this->load->model('Crud_model', 'p');
      $this->p->acept($id,$this->session->id);
      parent::exibeErro('Confirmada a colaboração, envie uma mensagem para o usuário');
    }

    public function solicitations(){
      $s = $this->db->query('select id_login, perfil, nome, cel, email from login where id_login  in (select follower from follow where followed = '.$this->session->id.' and status = 0)limit 10 ')->result_array();
      $this->data['sol'] = $s;
      (count($s) ===  0)? $this->data['conteudo'] = 'Nenhuma solicitação enviada':$this->data['conteudo'] = $this->parser->parse('telas/solicitations',$this->data,true);
      $this->parser->parse('layout/landing', $this->data);
    }

    public function htmlSugest($dados){
        $url = base_url();
        $html = '';
        for($i = 0; $i < count($dados); $i++){
          $html  .= '<div class="space-50"></div>
                      <div class="container text-center">
                          <div class="row">
                              <div class="col">
                                  <p>'.$dados[$i]['nome'].'</p>
                                  <a href="'.$url.'conta/exibir/'.$dados[$i]['id_login'].'" class="btn btn-simple btn-primary btn-round">Ver contato</a>
                              </div>
                          </div>
                  </div>';
        }
        return $html;
    }

}
