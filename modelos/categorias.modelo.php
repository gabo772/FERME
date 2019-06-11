<?php

require_once "conexion.php";

class ModeloCategorias{
// hola mundooo
	/*=============================================
	CREAR FAMILIA
	=============================================*/

	static public function mdlIngresarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria) VALUES (:categoria)");

		$stmt->bindParam(":categoria", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR FAMILIAS
	=============================================*/

	static public function mdlMostrarCategorias($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

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
	static public function mdlOracleMostrarCategorias($tabla, $item, $valor){

		if($item != null){

			$stmt = ConexionOracle::conectar();
			$preparado=$stmt->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$preparado -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$preparado -> execute();

			return $preparado -> fetch();

		}else{

			$stmt = ConexionOracle::conectar();
			$preparado=$stmt->prepare("SELECT * FROM $tabla");
			$preparado -> execute();

			return $preparado -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR FAMILIA
	=============================================*/

	static public function mdlEditarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria WHERE id = :id");

		$stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR FAMILIA
	=============================================*/

	static public function mdlBorrarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

