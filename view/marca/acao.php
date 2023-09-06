<?php
    $id = isset($_POST['id']) ? $_POST['id']: 0;
    $nome = isset($_POST['nome']) ? $_POST['nome']: '';

    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    if($acao == 'salvar'){
        if ($id > 0){
            try{
                require_once('../../model/marca.class.php');
                $marca = new Marca($id, $nome);
                $marca->editar();
                header('location:index.php');   

            }catch(Exception $e){
                echo "Erro: ".$e->getMessage();
            }
        }

        else {
            try{
                require_once('../../model/marca.class.php');
                $marca = new Marca($id, $nome);
                $marca->inserir();
                header('location:index.php');   
    
            }catch(Exception $e){
                echo "Erro: ".$e->getMessage();
            }
        }
    }

    else if ($acao == 'excluir'){
        $id = isset($_GET['id']) ? $_GET['id']: 0;
        try{
            require_once('../../model/marca.class.php');
            $marca = new Marca($id, $nome);
            $marca->excluir();
            header('location:index.php');   

        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
?>