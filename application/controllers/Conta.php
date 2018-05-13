<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class conta extends MY_Controller {

    public function __construct() {
      parent::__construct();
      $this->data['title'] = 'Conta';
      $this->data['url_pagina'] = base_url().''.$this->uri->segment(1);
    }

    public function index() {
      $this->data['conteudo'] = $this->parser->parse('telas/criar-conta',$this->data,true);
      $this->parser->parse('layout/login', $this->data);
    }

    public function criar(){
      $this->data['conteudo'] = $this->parser->parse('telas/criar-conta', $this->data, true);
      $this->parser->parse('layout/login', $this->data);
    }

    public function editar(){


      $this->load->model('Crud_model','c');
      $info = $this->c->select_where('id_login',$this->session->id,'login');



      $this->data['nome']  = $info[0]['nome'];
      $this->data['email'] = $info[0]['email'];
      $this->data['descr'] = $info[0]['descr'];
      $this->data['conteudo'] = $this->parser->parse('telas/editar-conta', $this->data, true);
      $this->parser->parse('layout/landing', $this->data);
    }

    public function cadastrar(){
      $dados = $this->input->post();
      if($dados['senha'] !== $dados['confsenha']){
              parent::exibeErro('As senhas informadas não conferem.');
      }
      if($dados['senha'] === ""){
          parent::exibeErro('Informe uma senha');
      }
        unset($dados['confsenha']);
        $dados['cel'] = trim($dados['cel']);
        $dados['cel'] = str_replace(" ","",$dados['cel']);
        $dados['senha'] = md5($dados['senha']);


        $this->load->model('Crud_model', 'p');
        $v = $this->p->select_where('cel',$dados['cel'], 'login'); //Verifico se já existe cadastro para o usuário


        if(count($v) !== 0){
            parent::exibeErro('O celular informado já existe.');
        }
        $v = $this->p->select_where('email',$dados['email'], 'login'); //Verifico se já existe email para o usuário
        if(count($v) !== 0){
            parent::exibeErro('O email informado já existe.');
        }
        if(count($v) === 0){
            $query = $this->p->insert($dados,'login');
            parent::exibeErro('dados cadastrados');
        }
    }

    public function alterar(){
      $dados = $this->input->post();
      $this->load->model('Crud_model', 'p');
      $query = $this->p->update('id_login',$this->session->id,$dados,'login');
      parent::exibeErro('dados alterados');
    }


    public function exibir($id = ""){


      $this->load->model('Crud_model', 'c');

      $dados = $this->c->select_where('id_login',$id,'login');

      $pesquisas  =  $this->db->query('select * from pesquisa where autor = '.$id.'')->result_array();



      $this->data['seguidores'] = $seguidores  = $this->db->query('select id_login, perfil, nome, cel, email from login where id_login in (select follower from follow where followed = '.$id.' and status = 1)')->result_array();



      $this->data['contrib']    = $contrib    = $this->db->query('select * from pesquisa_login where id_login = '.$id.' and status = 1')->result_array();


      //manipular informação sobre seguir usuário


      $this->data['seguir']  = $this->htmlSeguir($id);
      if(count($dados) === 0) {
         parent::exibeErro('Nenhuma conta encontrada');
      }

      $this->data['pesquisas']  = $this->htmlPesquisas($pesquisas);

      if(count($seguidores) === 0 ){
        $this->data['seguidores'] = 'O usuário não possui seguidores.';
      }
      $this->data['nome']     = $dados[0]['nome'];
      $this->data['descr']     = $dados[0]['descr'];
      $this->data['totalPesquisas']     = count($pesquisas);
      $this->data['totalSeguidores']    = count($seguidores);
      $this->data['totalParticipacoes'] = count($contrib);
      //Id do usuário a ser seguido

      $this->data['id'] = $id;
      $this->parser->parse('layout/profile', $this->data);
    }



 public function htmlPesquisas($dados){
     $c = count($dados);
     if($c === 0){
       return 'Nenhuma pesquisa criada.';
     }
     $html = '';
     for($i = 0; $i < $c; $i++){
       $html .= '<h5>'.$dados[$i]['titulo'].'</h5>';
       $html .= '<p>'.$dados[$i]['descricao'].'</p>';

     }

     return $html;
 }

  public function htmlSeguir($id){
    $url = base_url();
    $html = '<a href="'.$url.'conta/editar" class="btn btn-info btn-round btn-lg">Editar</a>';
    if($this->session->id === $id){
        return $html;
    }
    $v = $this->db->query('select * from follow where follower = '.$this->session->id.' and followed = '.$id.'')->result_array();
    $html = '<a href="'.$url.'follow/follo/'.$id.'" class="btn btn-primary btn-round btn-lg">Seguir</a>';
    if(count($v) !== 0){
        $html = '<a href="#" class="btn btn-info btn-round btn-lg">Seguindo</a>';
    }
    return $html;
  }

}
