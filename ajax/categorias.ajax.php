<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{

	/*=============================================
	EDITAR FAMILIAS
	=============================================*/	

	public $idCategoria;
	public $idFamilia;

	public function ajaxEditarCategoria(){

		$item = "id";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}
	public function ajaxEditarFamilia(){

		$item = "ID_FAMILIA";
		$valor = $this->idFamilia;

		$respuesta = ControladorCategorias::ctrOracleMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR FAMILIAS
=============================================*/	
if(isset($_POST["idFamilia"])){

	$categoria = new AjaxCategorias();
	$categoria -> idFamilia = $_POST["idFamilia"];
	$categoria -> ajaxEditarFamilia();
}
