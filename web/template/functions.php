<?php

  function severInfo(){
      $h = $_SERVER['HTTP_HOST'];
      $r = $_SERVER['HTTP_REFERER'];

      return array($h, $r);
  }
  
  function getPrimaryKey(){

    if (!isset($_GET["m_id"])) {
      exit;
    } else {
      $m_id = $_GET["m_id"];
    }

    return $m_id;

  }

  // CRUD methods (READ ONE)
  function selectMsgOne($db, $m_id){
    $sql = "SELECT * FROM message WHERE (m_id = :m_id);";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":m_id", $m_id);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row;
  }

  // CRUD methods (Create)
  function insertMsg($db, $m_name, $m_mail, $m_message){
    // データの追加
    $sql = "INSERT INTO message (m_name, m_mail, m_message, m_dt) VALUES (:m_name, :m_mail, :m_message, NOW())";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":m_name", $m_name);
    $stmt->bindParam(":m_mail", $m_mail);
    $stmt->bindParam(":m_message", $m_message);
    $stmt->execute();

    // エラーチェック
    $error = $stmt->errorInfo();
    if ($error[0] != "00000") {
      $message = "データの追加に失敗しました。{$error[2]}";
    } else {
      $message = "データを追加しました。データ番号：" . $db->lastInsertId();
    }

    return $message;
  
  }

?>