<?php

class Login_Model extends CI_Model {
	
	public function __construct( $bd = false, $controller = null ) {
		
		
	}
	
	public function logarUsuario($arrArgs=null){

		// CARREGANDO DADOS
		$i = 0;
		$arrDados['login']              = $arrArgs[$i++]; // LOGIN DO USUÁRIO
		$arrDados['nome']  				= $arrArgs[$i++]; // NOME DO USUÁRIO
		$arrDados['cpf']   				= $arrArgs[$i++]; // CPF DO USUÁRIO
		$arrDados['codigo_om_usuario']  = $arrArgs[$i++]; // OM DO USUÁRIO
		$arrDados['sigla_om_usuario'] 	= $arrArgs[$i++]; // OM DO USUÁRIO
		$arrDados['id_perfil'] 			= $arrArgs[$i++]; // ID DO PERFIL NO LOGIN
		$arrDados['perfil'] 			= $arrArgs[$i++]; // NOME DO PERFIL NO LOGIN
		$arrDados['codigo_om_login'] 	= $arrArgs[$i++]; // ABRANGENCIA DO USUÁRIO
		$arrDados['sigla_om_login'] 	= $arrArgs[$i++]; // ABRANGENCIA DO USUÁRIO
		// ----------------------------------------------------------------
				
		// REDIRECIONANDO O USUÁRIO
		$seg = new Seguranca();
		$seg->informarLogin($arrDados);
		// ----------------------------------------------------------------
	}
	
}