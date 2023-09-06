<?php
abstract class Empresa {

    private $id = 0;
    private $nome;

    public function __construct($pid, $pnome) {
        $this->setId($pid);
        $this->setNome($pnome);
    }


    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public abstract function inserir();
    public abstract function editar();
    public abstract function excluir();
}
?>