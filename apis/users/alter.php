<?php 

  require_once __DIR__ . '/../files/logged_admin.php';
  require_once __DIR__ . '/../../class/UserDAO.php';
  require_once __DIR__ . '/../../class/AddressDAO.php';
  
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: PUT");
  header("Access-Control-Allow-Headers: Content-Type");

  $id = $_GET['id'];

  $datas = json_decode(file_get_contents("php://input"), true);

  $name = trim($datas['register-name']);
  $cpf = trim($datas['register-cpf']);
  $email = trim($datas['register-email']);
  $phone = trim($datas['register-phone']);
  $genre = trim($datas['register-genre']);

  if(!validaCPF($cpf)) {
    echo json_encode(["status" => "error", "title" => "Erro!", "message" => "O CPF digitado não é um CPF válido."]);
    exit();
  }
  
  $cep = trim($datas['register-cep']);
  $state = trim($datas['register-state']);
  $city = trim($datas['register-city']);
  $neighborhood = trim($datas['register-bairro']);
  $street = trim($datas['register-street']);
  $number = trim($datas['register-number']);

  $address = new Address();
  $addressDAO = new AddressDAO($address);

  $address->setCep($cep);
  $address->setState(strtoupper($state));
  $address->setCity($city);
  $address->setNeighborhood($neighborhood);
  $address->setStreet($street);
  $address->setNumber($number);

  $addressDAO->insert();

  $user = new User();
  $userDAO = new UserDAO($user);

  $user->setId($id);
  $user->setName($name);
  $user->setCpf($cpf);
  $user->setPhone($phone);
  $user->setGenre($genre);
  $user->setEmail($email);
  $user->setAddress($address);
    
  echo json_encode($userDAO->alter());

  // Função para validação do CPF
  function validaCPF($cpf) {
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
      
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
      return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
      return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf[$c] * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf[$c] != $d) {
        return false;
      }
    }
    return true;
  }