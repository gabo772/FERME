<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";


class AjaxProductos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idFamilia;

  public function ajaxCrearCodigoProducto(){

    $item = "FAMILIA_ID_FAMILIA";
    $valor = $this->idFamilia;

    $respuesta = ControladorProductos::ctrOracleMostrarProductos($item, $valor);

    echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idProducto;

  public function ajaxEditarProducto(){

    $item = "ID_PRODUCTO";
    $valor = $this->idProducto;
    
    $respuesta = ControladorProductos::ctrOracleMostrarProductos($item, $valor);

    echo json_encode($respuesta);

  }

}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/ 

if(isset($_POST["idFamilia"])){

  $codigoProducto = new AjaxProductos();
  $codigoProducto -> idFamilia = $_POST["idFamilia"];
  $codigoProducto -> ajaxCrearCodigoProducto();

}
/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProducto"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST["idProducto"];
  $editarProducto -> ajaxEditarProducto();

}





