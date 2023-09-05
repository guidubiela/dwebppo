<?php
require_once('database.class.php');
require_once('veiculo.class.php');

class Moto extends Veiculo{
    
    public function __construct($pid, $pmodelo, $pano, $pkm, $pidmarca) {
        parent::__construct($pid, $pmodelo, $pano, $pkm, $pidmarca);
    }

    public function inserir(){
        $conexao = Database::conectar();
        $sql = 'INSERT INTO moto (modelo, ano, km, marca_idmarca)
                      VALUES (:modelo, :ano, :km, :idmarca)';
        $params = array(
            ':modelo'=>$this->getModelo(),
            ':ano'=>$this->getAno(),
            ':km'=>$this->getKm(),
            ':idmarca'=>$this->getIdmarca()

        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public function editar(){
        $conexao = Database::conectar();
        $sql = 'DELETE FROM moto 
                  WHERE idmoto = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        return Database::executar($sql, $params);
    }

    public function excluir(){
        $conexao = Database::conectar();
        $sql = 'UPDATE moto
                    SET modelo = :modelo,
                        ano  = :ano,
                        km  = :km,
                        marca_idmarca  = :idmarca
                    WHERE idmoto = :id';
        $params = array(
            ':id'=>$this->getId(),
            ':modelo'=>$this->getModelo(),
            ':ano'=>$this->getAno(),
            ':km'=>$this->getKm(),
            ':idmarca'=>$this->getIdmarca()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public static function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM moto';
        switch($tipo){
            case 1: $sql .= ' WHERE idmoto = :info'; break;
            case 2: $sql .= ' WHERE modelo like :info';  break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
    }

}
?>