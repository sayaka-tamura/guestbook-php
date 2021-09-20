<?php

  function severInfo(){
      $h = $_SERVER['HTTP_HOST'];
      $r = $_SERVER['HTTP_REFERER'];

      return array($h, $r);
  }

  // CRUD methods (READ)
  function SelectInfo(){
    $sql = "SELECT * FROM message WHERE (m_id = :m_id);";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":m_id", $m_id);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row;
  }
?>