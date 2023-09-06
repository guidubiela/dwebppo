<!DOCTYPE html>
<html lang="en">
<?php
    require_once ('../../model/carro.class.php');
    require_once ('../../model/marca.class.php');
    require_once ('../../bd/config/config.inc.php');

    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $id = isset($_GET['id']) ? $_GET['id']:0;

    if ($id > 0){
        $dados = Carro::listar(1,$id)[0];
    }
?>
<?php include '../../templates/head.php'; ?>
<body>
    <?php include '../../templates/navbar.php'; ?>

    <br><br>
    <h1 align="center">Carros</h1>
    <br><br>
    
    <section class='container'>
        <form action="acao.php" method="post">
            <label for="id">Id:</label>
            <input readonly type="text" name='id' id='id' value='<?php if($acao == 'editar') echo $dados['idcarro']; else echo 0; ?>'>
            <label for="modelo">Modelo:</label>
            <input type="text" name='modelo' id='modelo' value='<?php if($acao == 'editar') echo $dados['modelo']; ?>'>
            <label for="ano">Ano:</label>
            <input type="text" name='ano' id='ano' value='<?php if($acao == 'editar') echo $dados['ano']; ?>'>
            <label for="km">Quilometragem:</label>
            <input type="text" name='km' id='km' value='<?php if($acao == 'editar') echo $dados['km']; ?>'>
            <label for="marca">Marca:</label>
            <select name="idmarca" id="idmarca">
                <?php
                    $listar = Marca::listar();
                    foreach($listar as $item){
                        if($acao == 'editar'){
                            if($item['idmarca'] == $dados['id']){
                                echo "<option value='{$item['idmarca']}' selected>{$item['nome']}</option>";
                            }
                            else{
                                echo "<option value='{$item['idmarca']}'>{$item['nome']}</option>";
                            }
                        }
                        else{
                            echo "<option value='{$item['idmarca']}'>{$item['nome']}</option>";
                        }
                    }
                ?>
            </select>
            <button class="btn btn-outline-dark" type="submit" value='salvar' name='acao' id='acao'>Salvar</button>
        </form>
    </section>
    <br><br>
    <table class="table container">
        <thead align="middle">
            <tr>
                <th>Id</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Quilometragem</th>
                <th>Marca</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody align="middle" class="align-middle">
            <?php
                $listar = Carro::listar();
                foreach($listar as $item){
                    echo "<tr>
                            <td>".$item['idcarro']."</td>
                            <td>".$item['modelo']."</td>
                            <td>".$item['ano']."</td>
                            <td>".$item['km']."</td>
                            <td>".$item['marca_idmarca']."</td>
                            <td><a href='index.php?acao=editar&id=".$item['idcarro']."'><button class='btn btn-outline-warning'>Editar</button></a></td>
                            <td><a href='acao.php?acao=excluir&id=".$item['idcarro']."'><button class='btn btn-outline-danger'>Excluir</button></a></td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>