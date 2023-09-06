<!DOCTYPE html>
<html lang="en">
<?php
    require_once ('../../model/marca.class.php');
    require_once ('../../bd/config/config.inc.php');

    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $id = isset($_GET['id']) ? $_GET['id']:0;

    if ($id > 0){
        $dados = Marca::listar(1,$id)[0];
    }
?>
<?php include '../../templates/head.php'; ?>
<body>
    <?php include '../../templates/navbar.php'; ?>

    <br><br>
    <h1 align="center">Marcas</h1>
    <br><br>
    
    <section class='container'>
        <form action="acao.php" method="post">
            <label for="id">Id:</label>
            <input readonly type="text" name='id' id='id' value='<?php if($acao == 'editar') echo $dados['idmarca']; else echo 0; ?>'>
            <label for="nome">Nome:</label>
            <input type="text" name='nome' id='nome' value='<?php if($acao == 'editar') echo $dados['nome']; ?>'>
            <button class="btn btn-outline-dark" type="submit" value='salvar' name='acao' id='acao'>Salvar</button>
        </form>
    </section>
    <br><br>
    <table class="table container">
        <thead align="middle">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody align="middle" class="align-middle">
            <?php
                $listar = Marca::listar();
                foreach($listar as $item){
                    echo "<tr>
                            <td>".$item['idmarca']."</td>
                            <td>".$item['nome']."</td>
                            <td><a href='index.php?acao=editar&id=".$item['idmarca']."'><button class='btn btn-outline-warning'>Editar</button></a></td>
                            <td><a href='acao.php?acao=excluir&id=".$item['idmarca']."'><button class='btn btn-outline-danger'>Excluir</button></a></td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>