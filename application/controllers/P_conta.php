<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_conta extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->library('parser');
      $this->load->library('session');
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

    public function cadastrar(){
      $dados = $this->input->post();

      if($dados['senha'] !== $dados['confsenha']){
              $this->exibeErro('As senhas informadas não conferem.');
      }
      if($dados['senha'] === ""){
          $this->exibeErro('Informe uma senha');
      }
        unset($dados['confsenha']);
        $dados['cel'] = trim($dados['cel']);
        $dados['cel'] = str_replace(" ","",$dados['cel']);
        $dados['senha'] = md5($dados['senha']);
        $this->load->model('Crud_model', 'p');
        $v = $this->p->select_where('cel',$dados['cel'], 'login'); //Verifico se já existe cadastro para o usuário
        if(count($v) !== 0){
            $this->exibeErro('O celular informado já existe.');
        }
        $v = $this->p->select_where('email',$dados['email'], 'login'); //Verifico se já existe email para o usuário
        if(count($v) !== 0){
            $this->exibeErro('O email informado já existe.');
        }
        if(count($v) === 0){
            $query = $this->p->insert($dados,'login');
            $this->exibeErro('dados cadastrados');
        }
    }

    public function exibeErro($msg){
          $this->data['message'] = strtoupper($msg);
          return $this->parser->parse('msg/msg', $this->data);
    }


}
