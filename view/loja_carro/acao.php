<?php
    $idloja = isset($_POST['idloja']) ? $_POST['idloja']: 0;
    $idcarro = isset($_POST['idcarro']) ? $_POST['idcarro']: 0;

    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    if($acao == 'salvar'){ 
        try{
            require_once('../../model/loja_carro.class.php');
            $loja_carro = new Loja_Carro($idloja, $idcarro);
            $loja_carro->inserir();
            header('location:index.php');   
    
        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    else if ($acao == 'excluir'){
        $idloja = isset($_GET['idloja']) ? $_GET['idloja']: 0;
        $idcarro = isset($_GET['idcarro']) ? $_GET['idcarro']: 0;
        try{
            require_once('../../model/loja_carro.class.php');
            $loja_carro = new Loja_Carro($idloja, $idcarro);
            $loja_carro->excluir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>