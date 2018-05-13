<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->library('session');
        $this->data['title'] = 'Login';
        $this->data['url_pagina'] = base_url().''.$this->uri->segment(1);
    }

    public function index() {
      $this->data['conteudo'] = $this->parser->parse('telas/login',$this->data,true);
      $this->parser->parse('layout/login', $this->data);
    }

    public function logar(){
        $dados = $this->input->post();


        if(!isset($dados['senha'])  || $dados['senha'] === ""){
            die('Informe uma senha');
        }


        if( !isset($dados['cel']) || $dados['cel'] === ""){
            die('Informe uma senha');
        }


        $dados['senha'] = md5($dados['senha']);
        $this->load->model('Crud_model', 'p');
        $v = $this->p->select_where('cel',$dados['cel'], 'login');
        if(count($v) === 0){
            $url = base_url();
            die('O celular informado não foi encontrado no banco de dados, deseja <a href="'.$url.'conta/criar">criar uma conta?</a>');
        }
        $query = $this->db->query('select * from login where senha = "'.$dados['senha'].'" and cel = "'.$dados['cel'].'" ');
        $v = $query->result_array();
        if(count($v) === 0){
            die('Nenhuma informação encontrada');
        }
        $dados = $v;
        $this->session->set_userdata('cel', $dados[0]['cel']);
        $this->session->set_userdata('email', $dados[0]['email']);
        $this->session->set_userdata('id', $dados[0]['id_login']);
        $this->session->set_userdata('nome', $dados[0]['nome']);
        $this->session->set_userdata('perfil', $dados[0]['perfil']);
        $this->session->set_userdata('login', TRUE);



        redirect('main');
   }

  public function logout(){
      $this->session->sess_destroy();
      redirect('login');
  }
}
