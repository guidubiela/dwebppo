<?php
require_once('database.class.php');
require_once('empresa.class.php');
require_once('carro.class.php');

class Marca extends Empresa{

    private $veiculos;

    public function __construct($pid, $pnome) {
        parent::__construct($pid, $pnome);
        $this->veiculos = array();
        $this->getVeiculos();
    }

    public function inserir(){
        $conexao = Database::conectar();
        $sql = 'INSERT INTO marca (nome)
                      VALUES (:nome)';
        $params = array(
            ':nome'=>$this->getNome()
        );
        Database::preparar($conexao, $sql, $params);
        return Database::executar($sql, $params);
    }

    public function excluir(){
        $conexao = Database::conectar();
        $sql = 'DELETE FROM carro 
                  WHERE marca_idmarca = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        Database::executar($sql, $params);

        $conexao = Database::conectar();
        $sql = 'DELETE FROM marca 
                  WHERE idmarca = :id';         
        $params = array(':id'=>$this->getId());
        Database::preparar($conexao, $sql, $params);       
        return Database::executar($sql, $params);
    }

    public function editar(){
        $conexao = Database::conectar();
        $sql = 'UPDATE marca
                    SET nome = :nome
                    WHERE idmarca = :id';
        $params = array(
            ':id' => $this->getId(),
            ':nome' => $this->getNome()
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

    private function getVeiculos() {
        $sql = 'SELECT * FROM carro 
                WHERE marca_idmarca = :id';
        $params = array(':id' => $this->getId());     
        $resultado = Database::listar($sql, $params);
        foreach($resultado as $item){
            $c = new Carro($item['idcarro'], $item['modelo'], $item['ano'], $item['km'], $item['idmarca']);
            $this->addVeiculo($c);
        }
    }

    public function addVeiculo(Veiculo $veiculo){
        $this->veiculos[] = $veiculo;
    }

}
?>