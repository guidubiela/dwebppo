<?php
abstract class Veiculo{
    
    private $id = 0;
    private $modelo;
    private $ano;
    private $km;
    private $idmarca;

    public function __construct($pid, $pmodelo, $pano, $pkm, $pidmarca) {
        $this->setId($pid);
        $this->setNome($pmodelo);
        $this->setAno($pano);
        $this->setKm($pkm);
        $this->setIdmarca($pidmarca);
    }


    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($modelo) {
        $this->modelo = $modelo;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }

    public function setKm($km) {
        $this->km = $km;
    }

    public function setIdmarca($idmarca) {
        $this->idmarca = $idmarca;
    }


    public function getId() {
        return $this->id;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getKm() {
        return $this->km;
    }

    public function getIdmarca() {
        return $this->idmarca;
    }

    public abstract function inserir();
    public abstract function editar();
    public abstract function excluir();

}
?>