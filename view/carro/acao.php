<?php
    $id = isset($_POST['id']) ? $_POST['id']: 0;
    $modelo = isset($_POST['modelo']) ? $_POST['modelo']: '';
    $ano = isset($_POST['ano']) ? $_POST['ano']: 0;
    $km = isset($_POST['km']) ? $_POST['km']: 0;
    $idmarca = isset($_POST['idmarca']) ? $_POST['idmarca']: 0;

    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    if($acao == 'salvar'){
        if ($id > 0){
            try{
                require_once('../../model/carro.class.php');
                $carro = new Carro($id, $modelo, $ano, $km, $idmarca);
                $carro->editar();
                header('location:index.php');   

            }catch(Exception $e){
                echo "Erro: ".$e->getMessage();
            }
        }

        else {
            try{
                require_once('../../model/carro.class.php');
                $carro = new Carro($id, $modelo, $ano, $km, $idmarca);
                $carro->inserir();
                header('location:index.php');   
    
            }catch(Exception $e){
                echo "Erro: ".$e->getMessage();
            }
        }
    }

    else if ($acao == 'excluir'){
        $id = isset($_GET['id']) ? $_GET['id']: 0;
        try{
            require_once('../../model/carro.class.php');
            $carro = new Carro($id, $modelo, $ano, $km, $idmarca);
            $carro->excluir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>