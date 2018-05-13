<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class questoes extends MY_Controller {

    public function __construct() {
      parent::__construct();
      $this->data['title'] = 'Questões';
      $this->data['url_pagina'] = base_url().''.$this->uri->segment(1);
    }

    public function index() {
      //Retornar as questões cadatradas
      $this->parser->parse('layout/login', $this->data);
    }

    public function criar($id){

      if(empty($id)){
        parent::exibeErro('Informe a pesquisa');
      }

      $this->load->model('Crud_model', 'p');
      $v = $this->p->select_where('id_pesquisa',$id, 'pesquisa'); //Verifico se já existe cadastro para o usuário
      if(count($v) === 0){
        parent::exibeErro('Pesquisa não encontrada.');
      }

      $this->data['titulo'] = $v[0]['titulo'];
      $this->data['id'] = $id;

      $this->data['conteudo'] = $this->parser->parse('telas/questoes', $this->data, true);
      $this->parser->parse('layout/landing', $this->data);
    }

    public function cadastrar(){

      $dados = $this->input->post();

      if($dados['tipo'] === NULL){
        parent::exibeErro('selecione o tipo');
      }

      if(empty($dados['a'])){
        parent::exibeErro('Preencha todas as opções');
      }

      if(empty($dados['b'])){
        parent::exibeErro('Preencha todas as opções');
      }

      if(empty($dados['c'])){
        parent::exibeErro('Preencha todas as opções');
      }

      if(empty($dados['d'])){
        parent::exibeErro('Preencha todas as opções');
      }

      if(empty($dados['e'])){
        parent::exibeErro('Preencha todas as opções');
      }

      if($dados['id_pesquisa'] === ""){
          parent::exibeErro('Foi encontrado um erro');
      }

        $this->load->model('Crud_model', 'p');
        $query = $this->p->insert($dados,'questao');

        parent::exibeErro('Dados cadastrados');
      
      }
}
