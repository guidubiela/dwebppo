<?php
require_once('loja.class.php');
require_once('carro.class.php');

class Loja_Carro {

    private $idloja;
    private $idcarro;

    public function __construct($pidloja, $pidcarro) {
        $this->setIdloja($pidloja);
        $this->setIdcarro($pidcarro);
    }

    public function setIdloja($idloja) {
        $this->idloja = $idloja;
    }

    public function setIdcarro($idcarro) {
        $this->idcarro = $idcarro;
    }

    public function getIdloja() {
        return $this->idloja;
    }

    public function getIdcarro() {
        return $this->idcarro;
    }


    public function inserir(){
        $conexao = Database::conectar();
        $sql = 'INSERT INTO loja_carro (loja_idloja, carro_idcarro)
                      VALUES (:idloja, :idcarro)';
        $params = array(
            ':idloja'=>$this->getIdloja(),
            ':idcarro'=>$this->getIdcarro()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public function excluir(){
        $conexao = Database::conectar();
        $sql = 'DELETE FROM loja_carro 
                  WHERE loja_idloja = :idloja
                  AND   carro_idcarro = :idcarro';         
        $params = array(
            ':idloja'=>$this->getIdloja(),
            ':idcarro'=>$this->getIdcarro()
        );
        Database::preparar($conexao, $sql, $params);       
        return Database::executar($sql, $params);
    }

    public function editar(){
        $conexao = Database::conectar();
        $sql = 'UPDATE loja
                    SET nome = :nome,
                        cnpj = :cnpj
                    WHERE idloja = :id';
        $params = array(
            ':id'=>$this->getId(),
            ':nome'=>$this->getNome(),
            ':cnpj'=>$this->getCnpj()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public static function listar(){
        $sql = 'SELECT loja_idloja, nome, carro_idcarro, modelo FROM loja, loja_carro, carro WHERE idloja = loja_idloja AND idcarro =  carro_idcarro';    
        $params = array();     
        return Database::listar($sql, $params);
    }
}
?>