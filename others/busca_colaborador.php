<?php
include "../dbconn.php";
if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $sql = 'select distinct nome, id from colaborador';

        $result = $conn -> query($sql);
        if ($result -> num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        echo json_encode($data);
}