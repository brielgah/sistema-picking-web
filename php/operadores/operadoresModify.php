<?php
  include_once "../db.php";

  $num = $_POST['numero_empleado'];
  $link = open_database();

  $sql = 'SELECT * FROM Operador WHERE num_empleado ="'.$num.'";';
  $result = $link->query($sql);
  $link->close();

  $actual = $result->fetch_assoc();
  $f = $actual["nombre"];

  $data = array();
  $data[0] = $f;

  echo json_encode($data);
  exit();
?>
