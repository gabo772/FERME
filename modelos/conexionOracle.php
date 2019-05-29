<?php 
  class ConexionOracle{
    private $dbname='oci:dbname=XE';
    private $user='ferme';
    private $pass='1234';

    public function conectar(){
      try{
        $base=new PDO($this->dbname,$this->user,$this->pass);
        $base->exec("SET CARACTER SET utf8");

        if($base){
          echo "Conexion exitosa";
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
  $con=new ConexionOracle();

  
  $llamarMetodo=$con->conectar();
  $con->listarRutsClientes($llamarMetodo);
  

?>