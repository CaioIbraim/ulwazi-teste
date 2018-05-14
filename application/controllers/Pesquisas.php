<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesquisas extends MY_Controller {

    public function __construct() {
      parent::__construct();
      $this->data['title'] = 'Pesquisa';
      $this->data['url_pagina'] = base_url().''.$this->uri->segment(1);
    }

    public function index() {
      $query = $this->db->query('select * from pesquisa join login on  autor = '.$this->session->id.' where id_login = autor');
      $v = $query->result_array();

      if(count($v) === 0){
          parent::exibeErro('Nenhuma informação encontrada');
      }
        $this->data['titulo'] = 'Apresentar as pesquisas do usuário';
        $this->data['conteudo'] = $this->html($v);
        $this->parser->parse('layout/landing', $this->data);
    }

    public function info($id){
      //Apresentar estatísticas sobre a pesquisa
      $dados = $this->db->query('select * from pesquisa join login on id_login = autor where status = \'1\' and id_pesquisa = '.$id.'')->result_array();



      $escolhas = $this->db->query('select 	id_questao,	texto,
                                    	SUM(opc_escolhida = \'a\') AS A,
                                        SUM(opc_escolhida = \'b\') AS B,
                                        SUM(opc_escolhida = \'c\') AS C,
                                        SUM(opc_escolhida = \'d\') AS D,
                                        SUM(opc_escolhida = \'e\') AS E
                                    FROM
                                    	escolha,
                                        questao
                                    WHERE
                                     	fk_questao = id_questao
                                    AND
                                    	id_questao in (SELECT id_questao FROM questao WHERE id_pesquisa = '.$id.')
                                    GROUP BY texto
                                    ORDER BY id_questao')->result_array();



      if(count($dados) === 0){
        return  parent::exibeErro('Nenhuma informação encontrada');
      }

      $this->data['escolhas'] = '';
      if(count($escolhas) !== 0){
          $this->data['escolhas'] = $escolhas;
      }

      $this->data['titulo'] = $dados[0]['titulo'];
      $this->data['conteudo'] = $this->html($dados);
      $this->parser->parse('layout/landing', $this->data);
    }


   public function questao($id){
      $id_user = $this->session->id;
      //Verificar se o usuário já respondeu o questionário
      //Status == 1 :: questionário respondido
      //Status == 0 :: questionário aberto
      $query = $this->db->query('select * from pesquisa_login where  id_login = '.$id_user.' and id_pesquisa = '.$id.'');
      $v = $query->result_array();

      if(count($v) === 0){
        //Registrar acesso do usuário
        $dados =  array();
        $dados['id_pesquisa']   = $id;
        $dados['id_login']      = $id_user;
        $dados['status']        = '0';
        $this->load->model('Crud_model', 'p');
        $this->p->insert($dados,'pesquisa_login');
        return $this->questao($id);//Chama a função novamente
      }

      if($v[0]['status'] === '1'){
        //Se o questionário ainda não foi respondido pelo usuário exibir respostas
        parent::exibeErro('Pesquisa finalizada');
      }

      $query = $this->db->query('select * FROM `questao` WHERE id_questao not in (SELECT fk_questao from escolha where fk_login = '.$id_user.')   and id_pesquisa = '.$id.' limit 1');//Gambiarra aqui melhorar código
      $v = $query->result_array();

      if(count($v) === 0){
          $query = $this->db->query('select * from escolha, questao  where  fk_login = '.$id_user.' and id_pesquisa = '.$id.' and fk_questao = id_questao limit 1');
          $v = $query->result_array();
          if(count($v) !== 0){
            $this->load->model('Crud_model', 'p');
            $dados['status']   = '1';
            $this->p->update('id_login',$id_user,$dados,'pesquisa_login');
             parent::exibeErro('Terminou aqui');
          }
          $query = $this->db->query('select * from questao  where  id_pesquisa = '.$id.' limit 1');
          $v = $query->result_array();
      }

      if(count($v) !== 0){
        $html = '';
        $url = base_url();
        $this->data['titulo'] = 'Questão';
        $i = 0;

            if($v[$i]['tipo'] === '1'){
              $html .= '<div class="col-md-12">
                          <div class="team-player">
                            <h4 class="title">'.$v[$i]['texto'].'</h4>
                            <p><a href="'.$url.'/pesquisas/escolha/'.$id_user.'/'.$v[$i]['id_questao'].'/'.$id.'/1" class="btn btn-primary btn-round btn-lg btn-block"> Sim </a></p>
                            <p><a href="'.$url.'/pesquisas/escolha/'.$id_user.'/'.$v[$i]['id_questao'].'/'.$id.'/0" class="btn btn-primary btn-round btn-lg btn-block"> Não </a></p>
                          </div>
                        </div>';
            }else{
              $html .= '<div class="col-md-12">
                          <div class="team-player">
                            <h4 class="title">'.$v[$i]['texto'].'</h4>
                            <p><a href="'.$url.'/pesquisas/escolha/'.$id_user.'/'.$v[$i]['id_questao'].'/'.$id.'/a" class="btn btn-primary btn-round btn-lg btn-block"> '.$v[$i]['a'].'</a></p>
                            <p><a href="'.$url.'/pesquisas/escolha/'.$id_user.'/'.$v[$i]['id_questao'].'/'.$id.'/b" class="btn btn-primary btn-round btn-lg btn-block"> '.$v[$i]['b'].'</a></p>
                            <p><a href="'.$url.'/pesquisas/escolha/'.$id_user.'/'.$v[$i]['id_questao'].'/'.$id.'/c" class="btn btn-primary btn-round btn-lg btn-block"> '.$v[$i]['c'].'</a></p>
                            <p><a href="'.$url.'/pesquisas/escolha/'.$id_user.'/'.$v[$i]['id_questao'].'/'.$id.'/d" class="btn btn-primary btn-round btn-lg btn-block"> '.$v[$i]['d'].'</a></p>
                            <p><a href="'.$url.'/pesquisas/escolha/'.$id_user.'/'.$v[$i]['id_questao'].'/'.$id.'/e" class="btn btn-primary btn-round btn-lg btn-block"> '.$v[$i]['e'].'</a></p>
                          </div>
                        </div>';
            }
        $this->data['conteudo'] = $html;
        return $this->parser->parse('layout/landing', $this->data);

      }
      parent::exibeErro('Nenhuma questão encontrada.');
   }

public function escolha($id_login,$id_questao,$id_pesquisa,$opc){
  $dados = array();
  $dados['fk_login']        = $id_login;
  $dados['fk_questao']      = $id_questao;
  $dados['opc_escolhida']   = $opc;
  $this->load->model('Crud_model', 'p');
  $this->p->insert($dados,'escolha');
  redirect('pesquisas/questao/'.$id_pesquisa.'');
}


public function cadastrarPesquisa(){
  $this->data['conteudo'] = $this->parser->parse('telas/pesquisas',$this->data, true);
  return $this->parser->parse('layout/landing', $this->data);
}


public function cadastrar(){
  $dados = $this->input->post();
  if(empty($dados['titulo'])){
    parent::exibeErro('Preencha o título');
  }
  if(empty($dados['dt_ini'])){
    parent::exibeErro('Preencha a data de início');
  }
  if(empty($dados['dt_fim'])){
    parent::exibeErro('Preencha a data de finalização');
  }
  if(empty($dados['descricao'])){
    parent::exibeErro('Preencha a descrição');
  }

  $dados['dt_ini'] = parent::inverteData($dados['dt_ini']); //Formata data para o padrão correto para inserção
  $dados['dt_fim'] = parent::inverteData($dados['dt_fim']); //Formata data para o padrão correto para inserção

  $dados['status'] = 0;
  $dados['autor'] = $this->session->id;

  $this->load->model('Crud_model', 'p');
  $this->p->insert($dados,'pesquisa');
  parent::exibeErro('pesquisa cadastrada.');
}




public function alterarPesquisa(){
  $dados = $this->input->post();
  if(empty($dados['titulo'])){
    parent::exibeErro('Preencha o título');
  }
  if(empty($dados['dt_ini'])){
    parent::exibeErro('Preencha a data de início');
  }
  if(empty($dados['dt_fim'])){
    parent::exibeErro('Preencha a data de finalização');
  }
  if(empty($dados['descricao'])){
    parent::exibeErro('Preencha a descrição');
  }

  //$dados['dt_ini'] = parent::inverteData($dados['dt_ini']); //Formata data para o padrão correto para inserção
  //$dados['dt_fim'] = parent::inverteData($dados['dt_fim']); //Formata data para o padrão correto para inserção

  //$dados['status'] = 0;
  //$dados['autor'] = $this->session->id;

  $this->load->model('Crud_model', 'p');
  $query = $this->p->update('id_pesquisa',$dados['id_pesquisa'],$dados,'pesquisa');
  parent::exibeErro('pesquisa alterada.');
}



public function publicar($id){

  $id_user = $this->db->query('select autor from pesquisa where id_pesquisa = '.$id.'')->result_array();
  $id_user = $id_user[0]['autor'];

  if($this->session->id = $id_user){
    $dados['status'] = 1;
    $this->load->model('Crud_model', 'p');
    $this->p->update('id_pesquisa',$id,$dados,'pesquisa');
    parent::exibeErro('pesquisa publicada.');
  }
}

public function alterar($id){
  $id_user = $this->session->id;
  $pesquisa = $this->db->query('select * from pesquisa where autor = '.$id_user.' and id_pesquisa = '.$id.' ')->result_array();

  if(count($pesquisa) > 0){
    $questoes =  $this->db->query('select * from questao where id_pesquisa = '.$id.' ')->result_array();


      $this->data['pesquisa'] = $pesquisa;
      $this->data['questao']  = $questoes;
      $this->data['conteudo'] = $this->parser->parse('telas/altpesquisas',$this->data, true);
      return $this->parser->parse('layout/landing', $this->data);
  }

    parent::exibeErro('Nenuma informação encontrada.');
}


//TRATAMENTO DO HTML
   public function html($v){
      $url = base_url();
      $t = count($v);
      $html = '';

      $col = '4';
      if($t === 1){
        $col = '12';
      }
      if($t === 2 ){
        $col = '6';
      }


      for($i = 0; $i < $t; $i++){

        $ini = parent::inverteData($v[$i]['dt_ini']);
        $fim = parent::inverteData($v[$i]['dt_fim']);

        $html .= '<div class="col-md-'.$col.'">
                    <div class="team-player">
                        <img src="'.$url.'theme/assets/img/avatar.jpg" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
                        <h4 class="title">'.$v[$i]['titulo'].'</h4>
                        <p><small class="title"> '.$ini.' - '.$fim.' </small></p>
                        <p><small class="title"> Autor da pesquisa : '.$v[$i]['nome'].' </small></p>
                        ';
        if($t === 1){
          $html .=  '<p class="description">'.$v[$i]['descricao'].'</p>';

          $html .= '  <div class="text-center">
                <a href="#pablo" class="btn btn-primary btn-icon btn-round">
                    <i class="fa fa-facebook-square"></i>
                </a>
                <a href="#pablo" class="btn btn-primary btn-icon btn-round">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="#pablo" class="btn btn-primary btn-icon btn-round">
                    <i class="fa fa-google-plus"></i>
                </a>
          ';

        }else{
          $html .=  '<a href="'.$url.'pesquisas/info/'.$v[$i]['id_pesquisa'].'" class="btn btn-primary btn-icon btn-round"><i class="fa fa-info"></i></a>';
        }

        if($v[$i]['status'] === '1'){
          $html .=  '<a href="'.$url.'pesquisas/questao/'.$v[$i]['id_pesquisa'].'" class="btn btn-primary btn-icon btn-round"><i class="fa fa-check"></i></a>';
        }

        if($v[$i]['status'] === '0'){
          $html .=  '<a href="'.$url.'pesquisas/publicar/'.$v[$i]['id_pesquisa'].'" class="btn btn-primary btn-icon btn-round"><i class="fa fa-share-alt"></i></a>';
        }


        if(($v[$i]['autor'] === $this->session->id) && ($v[$i]['status'] === '0')){
          $html .=  '<a href="'.$url.'questoes/criar/'.$v[$i]['id_pesquisa'].'" class="btn btn-primary btn-icon btn-round"><i class="fa fa-plus"></i></a>';
        }

        if($v[$i]['autor'] === $this->session->id){
          $html .=  '<a href="'.$url.'pesquisas/alterar/'.$v[$i]['id_pesquisa'].'" class="btn btn-primary btn-icon btn-round"><i class="fa fa-edit"></i></a>';
        }

        $html .=      '
          </div>
          </div>
          </div>';
      }

      return $html;

  }

}
