<?php
require_once('database.class.php');
require_once('veiculo.class.php');

class Carro extends Veiculo {
    
    public function __construct($pid, $pmodelo, $pano, $pkm, $pidmarca) {
        parent::__construct($pid, $pmodelo, $pano, $pkm, $pidmarca);
    }

    public function inserir(){
        $conexao = Database::conectar();
        $sql = 'INSERT INTO carro (modelo, ano, km, marca_idmarca)
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

    public function excluir(){
        $conexao = Database::conectar();
        $sql = 'DELETE FROM loja_carro 
                  WHERE carro_idcarro = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        Database::executar($sql, $params);

        $conexao = Database::conectar();
        $sql = 'DELETE FROM carro 
                  WHERE idcarro = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        return Database::executar($sql, $params);
    }

    public function editar(){
        $conexao = Database::conectar();
        $sql = 'UPDATE carro
                    SET modelo = :modelo,
                        ano  = :ano,
                        km  = :km,
                        marca_idmarca  = :idmarca
                    WHERE idcarro = :id';
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
        $sql = 'SELECT * FROM carro';
        switch($tipo){
            case 1: $sql .= ' WHERE idcarro = :info'; break;
            case 2: $sql .= ' WHERE modelo like :info';  break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
    }

}
?>