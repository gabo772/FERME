<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductos(){

		$item = null;
    	$valor = null;

  		$productos = ControladorProductos::ctrOracleMostrarProductos($item, $valor);	
		
  		$datosJson = '{
		  "data": [';
		
		  for($i = 0; $i < count($productos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$productos[$i]["IMAGEN"]."' width='40px'>";

		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "ID_FAMILIA";
		  	$valor = $productos[$i]["ID_FAMILIA"];

		  	$familia = ControladorCategorias::ctrOracleMostrarCategorias($item, $valor);

		  	/*=============================================
 	 		STOCK
  			=============================================*/ 

  			if($productos[$i]["STOCK"] <= 10){

  				$stock = "<button class='btn btn-danger'>".$productos[$i]["STOCK"]."</button>";

  			}else if($productos[$i]["STOCK"] > 11 && $productos[$i]["STOCK"] <= 15){

  				$stock = "<button class='btn btn-warning'>".$productos[$i]["STOCK"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$productos[$i]["STOCK"]."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

			  $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["ID_PRODUCTO"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["ID_PRODUCTO"]."' codigo='".$productos[$i]["ID_PRODUCTO"]."' imagen='".$productos[$i]["IMAGEN"]."'><i class='fa fa-times'></i></button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
				  "'.$productos[$i]["ID_PRODUCTO"].'",
			      "'.$productos[$i]["NOMBRE"].'",
			      "'.$familia["DESCRIPCION"].'",
			      "'.$stock.'",
			      "'.$productos[$i]["PRECIO"].'", 
			      "'.$productos[$i]["PRECIO"].'",
				  "'.$productos[$i]["FEC_VENCIMIENTO"].'",
				  "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

