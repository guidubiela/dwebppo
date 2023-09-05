<?php
abstract class Empresa {

    private $id;
    private $nome;
    private $fund;

    public function __construct($pid, $pnome, $pfund) {
        $this->setId($pid);
        $this->setNome($pnome);
        $this->setFund($pfund);
    }


    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setFund($fund) {
        $this->fund = $fund;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getFund() {
        return $this->fund;
    }

    public abstract function inserir(){}
    public abstract function editar(){}
    public abstract function excluir(){}
}
?>