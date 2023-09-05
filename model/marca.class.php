<?php
require_once('database.class.php');
require_once('empresa.class.php');

class Marca extends Empresa{

    public function __construct($pid, $pnome, $pfund) {
        parent::__construct($pid, $pnome, $pfund);
    }

    public function inserir(){
        $conexao = Database::conectar();
        $sql = 'INSERT INTO marca (nome, fund)
                      VALUES (:nome, :fund)';
        $params = array(
            ':nome'=>$this->getNome(),
            ':fund'=>$this->getFund() 
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public function editar(){
        $conexao = Database::conectar();
        $sql = 'DELETE FROM marca 
                  WHERE idmarca = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        return Database::executar($sql, $params);
    }

    public function excluir(){
        $conexao = Database::conectar();
        $sql = 'UPDATE marca
                    SET nome = :nome,
                        fund  = :fund
                    WHERE idmarca = :id';
        $params = array(
            ':id'=>$this->getId(),
            ':nome'=> $this->getNome(),
            ':fund'=> $this->getFund()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public static function listar($tipo = 0, $info = ''){
        $sql = 'SELECT * FROM marca';
        switch($tipo){
            case 1: $sql .= ' WHERE idmarca = :info'; break;
            case 2: $sql .= ' WHERE nome like :info';  break;
        }           
        $params = array();
        if ($tipo > 0)
            $params = array(':info'=>$info);         
        return Database::listar($sql, $params);
    }

}
?>