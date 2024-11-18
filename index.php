<?php
include "dbconn.php";
$sql = "select id_cliente, chamado.ID as chamado_ID, status_chamado, criticidade, data_abertura, cliente.nome as nome_cliente, colaborador.nome as nome_colaborador from chamado inner join cliente on cliente.ID = id_cliente inner join colaborador on colaborador.ID = chamado.id_colaborador where 1 = 1 ";
if($_SERVER["REQUEST_METHOD"] == "POST"){
 if(isset($_POST["criticidade"])){
    $criticidade = $_POST["criticidade"];
    $sql .= "and criticidade = '$criticidade' ";
 }
 $status = $_POST["status"];
 $colaborador = $_POST["colaborador"];
 if($status != "selecione"){
    $sql .= "and status_chamado = '$status' ";
 }
 if($colaborador != "selecione"){
    $sql .= "and colaborador.nome = '$colaborador' ";
 }
}
$sql .= "order by status_chamado, criticidade ";
 $result = $conn -> query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script defer src="others/index.js"></script>
    <title>Chamados</title>
</head>
<body>
    <div id="app"></div>
    <h1>Chamados</h1>
    <h2>Filtros:</h2>
    <form action="index.php" method="POST">
        <div>
            <h3>Criticidade:</h3>
            <input type="radio" id="baixa" name="criticidade" value="baixa">
            <label for="baixa">baixa</label><br>
            <input type="radio" id="media" name="criticidade" value="media">
            <label for="media">media</label><br>
            <input type="radio" id="alta" name="criticidade" value="alta">
            <label for="alta">alta</label>
        </div>
        <div>
            <label for="status">Status:</label>
            <br>
            <select name="status" id="status">
                <option value="selecione" default>SELECIONE</option>
                <option value="aberto">Aberto</option>
                <option value="andamento">Em andamento</option>
                <option value="resolvido">Resolvido</option>
            </select>
        </div>
        <div>
        <select name="colaborador" id="colaborador" onclick="search()">
                <option value="selecione" default>SELECIONE</option>
        </select>
        </div>
        <input type="submit" value="Enviar">
    </form>
    <div id="table">
        <table>
            <thead>
                <th>Cliente</th>
                <th>Colaborador</th>
                <th>Status</th>
                <th>Criticidade</th>
                <th>Data de Abertura</th>
                <th></th>
            </thead>
            <tbody>
                <?php 
                    if(isset($result) && $result -> num_rows > 0){
                        while($row = $result -> fetch_assoc()){
                            echo "<form action='index.php' method='POST'> <tr>
                            <input type='hidden' value='" . $row['chamado_ID'] . "'
                            <td> {$row['nome_cliente']} </td>
                            <td> {$row['nome_colaborador']} </td>
                            <td> {$row['status_chamado']} </td>
                            <td> {$row['criticidade']} </td>
                            <td> {$row['data_abertura']} </td>
                            <td> <a href='editarUsuario.php?id='><button >Editar</button></a> </td>
                            </tr>
                            </form>";
                        }
                        
                    }
                    else{
                        echo "<tr>
                        <td colspan='5' >Nenhum usuario encontrado</td>
                        </tr>";
                    }
                    echo "</tbody></table>";
                ?>
    </div>
</div>
</body>
</html>