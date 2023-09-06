<?php 
    require_once('../../bd/config/config.inc.php');
    require_once('../../model/loja_carro.class.php');
    require_once('../../model/loja.class.php');
    require_once('../../model/carro.class.php');

    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<?php include '../../templates/head.php'; ?>
<body>
    <?php include '../../templates/navbar.php'; ?>

    <br><br>
    <h1 align="center">Lojas e Carros</h1>
    <br><br>
    
    <section class='container'>
        <form action="acao.php" method="post">
            <label for="idloja">Id da Loja:</label> 
            <select name="idloja" id="idloja">
                <?php
                    $listar = Loja::listar();
                    foreach($listar as $item){
                        echo "<option value='".$item['idloja']."'>".$item['nome']."</option>";
                    }
                ?>
            </select>
            <label for="idcarro">Id do Carro:</label>
            <select name="idcarro" id="idcarro">
                <?php
                    $listar = Carro::listar();
                    foreach($listar as $item){
                        echo "<option value='".$item['idcarro']."'>".$item['modelo']."</option>";
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
                <th>Id Loja</th>
                <th>Nome</th>
                <th>Id Carro</th>
                <th>Modelo</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody align="middle" class="align-middle">
            <?php
                $listar = Loja_Carro::listar();
                foreach($listar as $item){
                    echo "<tr>
                            <td>".$item['loja_idloja']."</td>
                            <td>".$item['nome']."</td>
                            <td>".$item['carro_idcarro']."</td>
                            <td>".$item['modelo']."</td>
                            <td><a href='acao.php?acao=excluir&idloja=".$item['loja_idloja']."&idcarro=".$item['carro_idcarro']."'><button class='btn btn-outline-danger'>Excluir</button></a></td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>