<?php

require_once "conexion.php";
require_once "conexionOracle.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlOracleMostrarProductos($tabla,$item,$valor){
		
		if($item != null){
			
			$stmt = ConexionOracle::conectar();
			$preparado=$stmt->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_producto DESC");
			$preparado -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$preparado -> execute();

			return $preparado -> fetch();

		}else{
			$stmt = ConexionOracle::conectar();
			$preparado=$stmt->prepare("SELECT * FROM $tabla");
			$preparado->execute();

			return $preparado -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlOracleIngresarProducto($tabla, $datos){

		$stmt = ConexionOracle::conectar();
		$preparado=$stmt->prepare("INSERT INTO $tabla(familia_id_familia, id_producto, nombre, imagen, stock, precio, precio) VALUES (:familia_id_familia, :id_producto, :nombre, :imagen, :stock, :precio, :precio)");

		$preparado->bindParam(":familia_id_familia", $datos["familia_id_familia"], PDO::PARAM_INT);
		$preparado->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_STR);
		$preparado->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$preparado->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$preparado->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$preparado->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$preparado->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

		if($preparado->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlOracleEditarProducto($tabla, $datos){

		$stmt = ConexionOracle::conectar();
		$preparado=$stmt->prepare("UPDATE $tabla SET familia_id_familia = :familia_id_familia, nombre = :nombre, imagen = :imagen, stock = :stock, precio = :precio, precio = :precio WHERE id_producto = :id_producto");

		$preparado->bindParam(":familia_id_familia", $datos["familia_id_familia"], PDO::PARAM_INT);
		$preparado->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_STR);
		$preparado->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$preparado->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$preparado->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$preparado->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$preparado->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

		if($preparado->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlOracleEliminarProducto($tabla, $datos){

		$stmt = ConexionOracle::conectar();
		$preparado=$stmt->prepare("DELETE FROM $tabla WHERE id_producto = :id_producto");

		$preparado -> bindParam(":id_producto", $datos, PDO::PARAM_INT);

		if($preparado -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}