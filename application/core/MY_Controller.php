<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->library('session');

        $this->verificaUsuario();

        $this->data['SOL']    = $this->countSol();
        $this->data['NOME']   = $this->session->nome;
        $this->data['PERFIL'] = $this->retornaPerfil();

        //Manobrar criptografia
        $this->load->library('encryption');
        $this->encryption->initialize(array('driver' => 'openssl'));

  //      $key = bin2hex($this->encryption->create_key(16)); var_dump($key);


    }

    public function exibeErro($msg){
          $this->data['message'] = strtoupper($msg);
          return $this->parser->parse('msg/msg', $this->data);
    }

    private function retornaPerfil(){
          $perfil = '';
          switch ($this->session->perfil) {
            case '1':
              $perfil = 'Administrador';
              break;
            default:
              $perfil = 'Usuário';
              break;
          }
          return $perfil;
    }

    public function verificaUsuario(){
        //var_dump($this->session->id); die();
        // se o tempo atual for maior que o tempo de logout
        if( !isset($this->session->start_login) ){
          //var_dump($this->session->id); die();
          $this->session->start_login = time(); //pega tempo que logou
         // adiciona 30 segundos ao tempo e grava em outra variável de sessão
         $time = $this->session->start_login + 30 * 5;
         $this->session->set_userdata('start_login', time());
         $this->session->set_userdata('logout_time', $time);
        }
        if(time() >= $this->session->logout_time || $this->session->id == NULL){
            redirect('login/logout');
        }else{
          $this->data['DESLOGA'] = $this->session->logout_time - time(); // tempo que falta
          $this->session->logout_time = time() + 60 * 5;
        }
    }

    public function countSol(){
        $sol = $this->db->query('select count(*) as c from login where id_login  in (select follower from follow where followed = '.$this->session->id.' and status = 0)')->result_array();
        $sol = $sol[0]['c'];
        if($sol === "0"){
          $sol = '';
        }
        return $sol;
    }

    public function inverteData($data){
        if(count(explode("/",$data)) > 1){
            return implode("-",array_reverse(explode("/",$data)));
        }elseif(count(explode("-",$data)) > 1){
            return implode("/",array_reverse(explode("-",$data)));
        }
    }

    public function form(){
         return $html = '  <div class="section section-contact-us text-center">
               <div class="container">
                   <h2 class="title">Want to work with us?</h2>
                   <p class="description">Your project is very important to us.</p>
                   <div class="row">
                       <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">
                           <div class="input-group input-lg">
                               <span class="input-group-addon">
                                   <i class="now-ui-icons users_circle-08"></i>
                               </span>
                               <input type="text" class="form-control" placeholder="First Name...">
                           </div>
                           <div class="input-group input-lg">
                               <span class="input-group-addon">
                                   <i class="now-ui-icons ui-1_email-85"></i>
                               </span>
                               <input type="text" class="form-control" placeholder="Email...">
                           </div>
                           <div class="textarea-container">
                               <textarea class="form-control" name="name" rows="4" cols="80" placeholder="Type a message..."></textarea>
                           </div>
                           <div class="send-button">
                               <a href="#pablo" class="btn btn-primary btn-round btn-block btn-lg">Send Message</a>
                           </div>
                       </div>
                   </div>
               </div>
           </div>';
    }

//FUNÇÃO PARA GERAR FORMULÁRIOS BÁSICOS VERSÃO 0.1
//ESTAT FUNÇÃO VISA DISPONIBILIZAR UMA FORMA PRÁTICA DE CRIAÇÃO  E PADRONIZAÇÃO DE FORMULÁRIOS
    public function gerarForm($array, $titulo, $btn, $urlAction) {
       //URL BASE
        $form = '<form id="formulario" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="POST" action="'.$urlAction.'">';
        for ($i = 0; $i < count($array); $i++) {
            ($array[$i]['required']) ? $span = '<span class="required"> * </span>' : $span = ''; //Verifica se é campo obrigatório
            ($array[$i]['readonly']) ? $readonly = 'readonly = readonly"' : $readonly = ''; //Verifica se é campo obrigatório
            $tag = $array[$i]["tag"];
            $form .= $this->$tag('input',$array[$i]["type"],$array[$i]["name"],$array[$i]["value"],$readonly,$array[$i]["titulo"],$span,$array[$i]["options"]);//recebe o código do input
        }
        $form .= '<div class="ln_solid"></div>
                           <div class="form-group">
                                   <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                          <a id="btnAction" class="btn btn-primary">' . $btn . '</a>
                                          <a href="'.base_url().''.$this->uri->segment(1).'" class="btn btn-default" type="button">Cancelar</a>
                                   </div>
                           </div>
                   </form>
               ';
        return $form;
    }

    public function input($id = "", $type="", $name="", $value="", $readonly="",$titulo,$span,$option="" ){
       return '<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">' . $titulo . ' ' . $span . '</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="'.$id.'" class="form-control col-md-7 col-xs-12" name="' . $name . '"  type="' . $type . '" value="' . $value . '"  ' . $readonly . '>
                           </div>
                     </div>';
    }

    public function textarea($id = "", $type="", $name="", $value="", $readonly="",$titulo,$span,$option="" ){
       return '<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">' . $titulo . ' ' . $span . '</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                             <textarea class="form-control" name='.$name.'></textarea>
                           </div>
                     </div>';
    }

   public function select($id = "", $type="", $name="", $value="", $readonly="",$titulo,$span,$option="" ){
       $valor = $value;
       $selected = '';
       $select = '<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">' . $titulo . ' ' . $span . '</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                             <select class="form-control" name='.$name.'>';
                                 foreach ($option as $key => $value) {
                                       if($key == $valor){
                                            $selected = 'selected';
                                            $select  .=   '<option value='.$key.' '.$selected.'>'.$value.'</option>';
                                            continue;
                                         }
                                          $select  .=   '<option value='.$key.'>'.$value.'</option>';
                                 }
       $select .=    '</select>
                           </div>
                     </div>';
       return $select;
    }
}
