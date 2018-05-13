<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

    public function __construct() {
      parent::__construct();
      $this->data['title'] = 'Bem vindo a ULWAZI';
      $this->data['url_pagina'] = base_url().''.$this->uri->segment(1);
      if($this->session->login === NULL || $this->session->login === FALSE){
        redirect('login/logout');
      }
    }

    public function index() {
        //listar todas as pesquisas com status = 1 de usuários que eu esteja seguindo
        $cont = $this->db->query('select
                                    	p.id_pesquisa,
                                        p.titulo,
                                        l.nome,
                                        case
                                        	when p.status = \'1\' then "aberta"
                                        	when p.status = \'0\' then "Em andamento"
                                          when p.status = \'2\' then "Finalizada"
                                          end  as status,
                                    	case
                                        	when pl.status = \'1\' then "contribuido"
                                          else "contribuir"
                                          end as participacao,
                                        pl.avaliacao
                                    from
                                      	pesquisa as p,
                                        login as l,
                                        pesquisa_login as pl
                                    where
                                    	p.id_pesquisa = pl.id_pesquisa
                                    and
                                    	pl.id_login   = '.$this->session->id.'
                                    and
                                    	l.id_login    = p.autor
                                    and
                                      p.perfil      = \'1\'
                                    and
                                    	p.autor  in (select followed from follow where follower = '.$this->session->id.' and status = 1) ')->result_array();


        //se a query retornar zero nenhum  possui uma consulta pública publicada
        $info = "";

        if(count($cont) === 0){
          $info = "No momento a ULWAZI não encontrou nenhuma pesquisa, siga algum usuário e interaja mais com nossa comunidade.";
        }


        //caso o usuário seja administrador
        $this->data['acao'] = '';

        if($this->session->perfil === "1"){
            $url = base_url();
            $this->data['acao'] = ' <a href="'.$url.'pesquisas/cadastrarPesquisa"><h3>Contribua com uma pesquisa.</h3></a>';
        }




        $this->data['info'] = $info; //Listar as pesquisas recentes dos usuários que eu sigo
        $this->data['pesquisas'] = $cont; //Listar as pesquisas recentes dos usuários que eu sigo
        $this->data['conteudo'] = $this->parser->parse('telas/main',$this->data,true);
        $this->parser->parse('layout/landing', $this->data);
    }
}
