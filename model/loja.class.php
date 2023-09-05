<?php
require_once('database.class.php');
require_once('empresa.class.php');

class Loja extends Empresa{

    private $cnpj;

    public function __construct($pid, $pnome, $pfund, $pcnpj) {
        parent::__construct($pid, $pnome, $pfund);
        $this->getCnpj();
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function inserir(){
        $conexao = Database::conectar();
        $sql = 'INSERT INTO loja (nome, fund, cnpj)
                      VALUES (:nome, :fund, :cnpj)';
        $params = array(
            ':nome'=>$this->getNome(),
            ':fund'=>$this->getFund(),
            ':cnpj'=>$this->getCnpj()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public function editar(){
        $conexao = Database::conectar();
        $sql = 'DELETE FROM loja 
                  WHERE idloja = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        return Database::executar($sql, $params);
    }

    public function excluir(){
        $conexao = Database::conectar();
        $sql = 'UPDATE loja
                    SET nome = :nome,
                        fund  = :fund,
                        cnpj = :cnpj
                    WHERE idloja = :id';
        $params = array(
            ':id'=>$this->getId(),
            ':nome'=>$this->getNome(),
            ':fund'=>$this->getFund(),
            ':cnpj'=>$this->getCnpj()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public static function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM loja';
        switch($tipo){
            case 1: $sql .= ' WHERE idloja = :info'; break;
            case 2: $sql .= ' WHERE nome like :info';  break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
    }

}
?>