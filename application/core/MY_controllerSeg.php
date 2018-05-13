<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_controllerSeg extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->library('session');
        $this->data['SOL']    = $this->countSol();
        $this->data['NOME']   = $this->session->nome;
        $this->data['PERFIL'] = $this->retornaPerfil();
    }

    public function exibeErro($msg){
          $this->data['message'] = strtoupper($msg);
          return $this->parser->parse('msg/msg', $this->data);
    }

}
