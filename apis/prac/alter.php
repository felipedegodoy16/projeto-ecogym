<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';
  
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: PUT");
  header("Access-Control-Allow-Headers: Content-Type");

  $datas = json_decode(file_get_contents("php://input"), true);

  $res = 0;

  // Delete Exer
  $sql = "SELECT * FROM exercicio WHERE FK_TREINO_ID = :id_prac;";

  // Conectando ao banco e preparando a query
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":id_prac", $datas['practice']['id'], PDO::PARAM_INT);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $allExercises = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach($allExercises as $exDb) {
    $dif = 0;
    foreach($datas['exercises'] as $ex) {
      if(intval($ex['id']) === $exDb['ID_EXERCICIO']) {
        $dif = 1;
        continue;
      }
    }
    if(!$dif) {
      $sql = "DELETE FROM exercicio WHERE ID_EXERCICIO = :id_exer;";

      // Conectando ao banco e preparando a query
      $stmt = ConnectionFactory::getConnection()->prepare($sql);

      $stmt->bindValue(":id_exer", $exDb['ID_EXERCICIO'], PDO::PARAM_INT);

      $stmt->execute() or die(print_r($stmt->errorInfo(), true));

      $res++;
    }
  }

  foreach($datas['exercises'] as $exer) {
    if($exer['id']) {
      $sql = "UPDATE exercicio SET EXERCICIO = :name_exer, SERIES = :series, REPETICOES = :reps, CARGA = :charge WHERE ID_EXERCICIO = :id;";
    } else {
      $sql = "INSERT INTO exercicio (ID_EXERCICIO, EXERCICIO, SERIES, REPETICOES, CARGA, FK_TREINO_ID) VALUES (DEFAULT, :name_exer, :series, :reps, :charge, :id_prac);";
    }

    // Conectando ao banco e preparando a query
    $stmt = ConnectionFactory::getConnection()->prepare($sql);

    $stmt->bindValue(":name_exer", $exer["name"], PDO::PARAM_STR);
    $stmt->bindValue(":series", $exer["series"], PDO::PARAM_INT);
    $stmt->bindValue(":reps", $exer["reps"], PDO::PARAM_INT);
    $stmt->bindValue(":charge", $exer["charge"], PDO::PARAM_INT);

    if($exer['id']) {
      $stmt->bindValue(":id", $exer['id'], PDO::PARAM_INT);
    } else {
      $stmt->bindValue(":id_prac", $datas['practice']['id'], PDO::PARAM_INT);
    }

    $stmt->execute() or die(print_r($stmt->errorInfo(), true));

    if($stmt->rowCount()) {
      $res++;
    }
  }

  $sql = "UPDATE treino SET TREINO = :name_treino, DESCANSO = :relax WHERE ID_TREINO = :id;";

  // Conectando ao banco e preparando a query
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":name_treino", $datas['practice']['name'], PDO::PARAM_STR);
  $stmt->bindValue(":relax", $datas['practice']['relax'], PDO::PARAM_STR);
  $stmt->bindValue(":id", $datas['practice']['id'], PDO::PARAM_STR);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));

  if($stmt->rowCount()) {
    echo json_encode(["status" => "success", "title" => "Alterado!", "message" => "O treino foi alterado com sucesso."]);
    exit();
  }

  if($res) {
    echo json_encode(["status" => "success", "title" => "Alterado!", "message" => "O treino foi alterado com sucesso."]);
    exit();
  }

echo json_encode(["status" => "error", "title" => "Nada Alterado!", "message" => "Nenhum dado foi alterado."]);
exit();