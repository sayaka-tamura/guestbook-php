<?php

  function severInfo(){
      $h = $_SERVER['HTTP_HOST'];
      $r = $_SERVER['HTTP_REFERER'];

      return array($h, $r);
  }

  
  function getPrimaryKey(){

    var_dump($_GET["m_id"]);
    var_dump($_SESSION["m_id"]);

    if (!isset($_GET["m_id"])) {
      exit;
    } else {
      $m_id = $_GET["m_id"];
      $_SESSION["m_id"] = $m_id;  //主キーを$_SESSIONに格納
    }

    return $m_id;

  }

  /*
  // CRUD methods (READ)
  function selectInfo($db){
    $sql = "SELECT * FROM message WHERE (m_id = :m_id);";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":m_id", $m_id);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row;
  }
  */
?>