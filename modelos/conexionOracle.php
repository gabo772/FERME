<?php 
  class ConexionOracle{
    private $dbname='oci:dbname=//localhost:1521/XE';
    private $user='ferme';
    private $pass='123';

    public function conectar(){
      try{
        $base=new PDO($this->dbname,$this->user,$this->pass);
        $base->exec("SET CARACTER SET utf8");

        if($base){
          //echo "Conexion exitosa";
          return $base;
        }
      }
      catch(Exception $e){
        echo "Error de conexion ".$e->getMessage();
      }
    }

    public function listarRutsClientes($con){
      $sql="SELECT * FROM cliente";
      $stmnt=$con->prepare($sql);
      $stmnt->execute();
      while($row=$stmnt->fetch(PDO::FETCH_ASSOC)){
        echo "<br>"."Rut: ".$row['RUT_CLIENTE']."<br>";
      }
    }

  }
  

?>