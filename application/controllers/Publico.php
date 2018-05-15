<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publico extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->library('parser');
      $this->load->library('session');
      $this->load->library('utilidades');
      $this->load->library('encryption');
      $this->encryption->initialize(array('driver' => 'mycript'));

      $this->data['title'] = 'Acesso público';
      $this->data['url_pagina'] = base_url().''.$this->uri->segment(1);

    }

    public function index() {

        $url = base_url();
        $this->data['titulo'] = 'Apresentar pesquisas públicas do usuário';

        $dados = $this->db->query('select * from pesquisa join login on id_login = autor where status = \'1\'  and pesquisa.perfil = \'0\'')->result_array();


        $this->data['conteudo'] = '<h3>Crie uma conta para participar da nossa plataforma e colaborar com os nossos pesquisadores.</h3>
                                    <hr>
                                      <div class="col-md-12">
                                        <hr>
                                        <h2>Pesquisas publicadas</h2>
                                        <hr>
                                      </div>';

        $this->data['conteudo'] .= $this->htmlPesquisas($dados);

        $this->parser->parse('layout/landing_p', $this->data);
    }




    public function pesquisa($nome = ''){

        $this->load->model('Crud_model', 'p');
        $dados = $this->p->select_where('link',$nome,'pesquisa');




        if(count($dados) > 0){
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
                                          id_questao in (SELECT id_questao FROM questao WHERE id_pesquisa = '.$dados[0]['id_pesquisa'].')
                                        GROUP BY texto
                                        ORDER BY id_questao')->result_array();
        }
        echo '<pre>';


        echo 'select 	id_questao,	texto,
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
                                        id_questao in (SELECT id_questao FROM questao WHERE id_pesquisa = '.$dados[0]['id_pesquisa'].')
                                      GROUP BY texto
                                      ORDER BY id_questao';


         die();





        $this->data['conteudo'] = '<h3>'.$dados[0]['titulo'].'</h3>
                                    <hr>
                                      <div class="col-md-12">
                                        <hr>

                                            <p align = "left">
                                            '.$dados[0]['descricao'].'
                                            </p>
                                        <hr>

                                        <h4>Estatísticas</h4>



                                      </div>';



        $this->parser->parse('layout/landing_p', $this->data);
    }













    public function info($nome = '', $titulo = ''){

      /*
      $id = $this->encryption->decrypt($id);
      var_dump($id); die();
      ($id === '')?redirect('publico'):NULL;
      //VERIFICA AS CONDIÇÕES DA VARIÁVEL
      (empty($id))?redirect('publico'):NULL;
      ($id === FALSE)?redirect('publico'):NULL;
      */


      //Apresentar estatísticas sobre a pesquisa
      $dados = $this->db->query('select * from pesquisa join login on id_login = autor where status = \'1\' and autor = '.$nome.' and titulo = '.trim($titulo).' and pesquisa.perfil = \'0\'')->result_array();

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
      $this->parser->parse('layout/landing_p', $this->data);
    }






public function htmlPesquisas($dados){
          $url = base_url();
          $t = count($dados);
          $html = '';

          for($i = 0; $i < $t; $i++){
            $ini = $this->utilidades->inverteData($dados[$i]['dt_ini']);
            $fim = $this->utilidades->inverteData($dados[$i]['dt_fim']);
            $html .= '
                      <div class="row">
                             <div class="col-md-6">
                               <h4 class="title">'.$dados[$i]['titulo'].'</h4>
                               <p><small class="title"> Autor da pesquisa : '.$dados[$i]['nome'].' </small></p>
                               <a href="'.$url.'publico/pesquisa/'.$dados[$i]['link'].'" class="btn btn-primary">Saiba Mais</a>
                            </div>
                       </div>';
          }
          return $html;
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

        $ini = $this->utilidades->inverteData($v[$i]['dt_ini']);
        $fim = $this->utilidades->inverteData($v[$i]['dt_fim']);

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
                  <hr>
                  <a href="'.$url.'publico" class="btn btn-primary">Participe da pesquisa</a>
                </div>';

        }

        $html .=      '</div>
                    </div>';
      }

      return $html;

  }

}
