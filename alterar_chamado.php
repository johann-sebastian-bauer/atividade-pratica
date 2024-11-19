<?php
include "dbconn.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "select * from chamado where ID = " . $_POST['id'];
    $result = $conn -> query($sql);
    $item = $result -> fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="others/index.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Alterar chamado</h1>
    <form action="alterar_chamado.php" method="POST">
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="aberto" <?php if($item['status_chamado'] == "aberto"){ echo("default");} else{ echo "";} ?>>Aberto</option>
            <option value="andamento" <?php if($item['status_chamado'] == "em andamento"){ echo("default");} else{ echo "";} ?>>Em andamento</option>
            <option value="resolvido" <?php if($item['status_chamado'] == "resolvido"){ echo("default");} else{ echo "";} ?>>Resolvido</option>
        </select>
        <br>
        <label for="colaborador">Colaborador</label>
        <select name="colaborador" id="colaborador" onclick="search()">
        </select>
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>