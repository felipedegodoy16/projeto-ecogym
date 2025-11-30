<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';
  
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type");

  $datas = json_decode(file_get_contents("php://input"), true);

  $practice = $datas['practice'];
  $exercises = $datas['exercises'];

  $sql = "INSERT INTO treino (ID_TREINO, TREINO, DESCANSO, ATIVO) VALUES (DEFAULT, :prac_name, :relax, 'A');";
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":prac_name", $practice['name'], PDO::PARAM_STR);
  $stmt->bindValue(":relax", $practice['relax'], PDO::PARAM_INT);
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));

  $id_prac = ConnectionFactory::getConnection()->lastInsertId();

  $sql = "INSERT INTO exercicio (ID_EXERCICIO, EXERCICIO, SERIES, REPETICOES, CARGA, FK_TREINO_ID) VALUES (DEFAULT, :exercise, :series, :reps, :charge, :id_prac);";
  $stmt2 = ConnectionFactory::getConnection()->prepare($sql);

  foreach ($exercises as $ex) {
      $stmt2->bindValue(":exercise", $ex["name"], PDO::PARAM_STR);
      $stmt2->bindValue(":series", $ex["series"], PDO::PARAM_INT);
      $stmt2->bindValue(":reps", $ex["reps"], PDO::PARAM_INT);
      $stmt2->bindValue(":charge", $ex["charge"], PDO::PARAM_INT);
      $stmt2->bindValue(":id_prac", $id_prac, PDO::PARAM_INT);
      $stmt2->execute() or die(print_r($stmt->errorInfo(), true));
  }

  $sql = "SELECT * FROM treino t LEFT JOIN exercicio e ON t.ID_TREINO = e.FK_TREINO_ID WHERE t.ID_TREINO = :id_prac;";

  // Conectando ao banco e preparando a query
  $stmt3 = ConnectionFactory::getConnection()->prepare($sql);

  $stmt3->bindValue(":id_prac", $id_prac, PDO::PARAM_INT);
  $stmt3->execute() or die(print_r($stmt->errorInfo(), true));
  $datas = $stmt3->fetchAll(PDO::FETCH_ASSOC);

  $group_datas = [];

  foreach ($datas as $d) {
      $id_treino = $d['ID_TREINO'];
      
      if (!isset($group_datas[$id_treino])) {
          $group_datas[$id_treino] = [
              'id_treino' => $id_treino,
              'name_treino' => $d['TREINO'],
              'relax' => $d['DESCANSO'],
              'exercises' => []
          ];
      }
      
      if ($d['ID_EXERCICIO'] != null) { // Garante que há um produto real
          $group_datas[$id_treino]['exercises'][] = [
              'id_exercise' => $d['ID_EXERCICIO'],
              'name_exercise' => $d['EXERCICIO'],
              'series' => $d['SERIES'],
              'reps' => $d['REPETICOES'],
              'charge' => $d['CARGA']
          ];
      }
  }

  $final_datas = array_values($group_datas);

  if($final_datas){

    echo json_encode(["status" => "success", "title" => "Sucesso!", "message" => "Treino cadastrado com sucesso.", "datas" => $final_datas]);
    exit();

  }
    
  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível cadastrar o treino."]);