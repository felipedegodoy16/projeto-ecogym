<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  $sql = "SELECT * FROM treino t LEFT JOIN exercicio e ON t.ID_TREINO = e.FK_TREINO_ID WHERE t.ATIVO = 'A' ORDER BY t.ID_TREINO ASC;";

  // Conectando ao banco e preparando a query
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    echo json_encode($final_datas);
    exit();

  }

echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);