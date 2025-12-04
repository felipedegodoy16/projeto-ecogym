<?php 

  require_once __DIR__ . '/../files/logged_admin.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  if(!isset($_GET['id'])) {
    echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);
    exit();
  }

  $sql = "SELECT * FROM usuarios u LEFT JOIN cep ce ON u.FK_CEP_ID = ce.ID_CEP LEFT JOIN bairro b ON ce.FK_BAIRRO_ID = b.ID_BAIRRO LEFT JOIN cidade ci ON b.FK_CIDADE_ID = ci.ID_CIDADE LEFT JOIN estado e ON ci.FK_ESTADO_ID = e.ID_ESTADO WHERE u.ID_USUARIO = :id;";

  // Conectando ao banco e preparando a query
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":id", intval($_GET['id']), PDO::PARAM_INT);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $datas = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

  if($stmt->rowCount()){

    echo json_encode($datas);
    exit();

  }

echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);