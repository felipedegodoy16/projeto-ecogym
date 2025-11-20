<?php 

  require_once __DIR__ . '/../../class/ConnectionFactory.php';
  
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type");

  $datas = json_decode(file_get_contents("php://input"), true);

  $practice = $datas['practice'];
  $exercises = $datas['exercises'];

  $sql = "INSERT INTO treino (ID_TREINO, TREINO, DESCANSO) VALUES (DEFAULT, :prac_name, :relax);";
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":prac_name", $practice['name'], PDO::PARAM_STR);
  $stmt->bindValue(":relax", $practice['relax'], PDO::PARAM_INT);
  // $stmt->bindValue(":prac_name", 'teste', PDO::PARAM_STR);
  // $stmt->bindValue(":relax", '32', PDO::PARAM_INT);
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
    
  echo json_encode(["status" => "success", "title" => "Sucesso!", "message" => "Treino cadastrado com sucesso."]);

  ////////////////////
// $treino = $input["treino"];
// $exercicios = $input["exercicios"];

// // Conexão com o banco
// $conn = new mysqli("localhost", "root", "", "academia");

// // Salva o treino
// $stmt = $conn->prepare("INSERT INTO treino (nome, obs) VALUES (?, ?)");
// $stmt->bind_param("ss", $treino["nome"], $treino["obs"]);
// $stmt->execute();

// $idTreino = $stmt->insert_id;

// // Insere exercícios
// $stmt2 = $conn->prepare("INSERT INTO exercicio (id_treino, nome, series, reps, carga)
//                          VALUES (?, ?, ?, ?, ?)");

// foreach ($exercicios as $ex) {
//     $stmt2->bind_param("isiii",
//         $idTreino,
//         $ex["nome"],
//         $ex["series"],
//         $ex["reps"],
//         $ex["carga"]
//     );
//     $stmt2->execute();
// }

// echo json_encode(["status" => "ok", "msg" => "Treino e exercícios salvos"]);