<?php

header("Content-Type: application/json");

function connectDb() {
    $host = 'mysql'; // nome do serviço no docker-compose
    $db   = 'meu_banco';
    $user = 'meu_usuario';
    $pass = 'minha_senha';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        $db = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Erro na conexão com o banco de dados: " . $e->getMessage()]);
        exit;
    }

    // Cria a tabela caso não exista
    $db->exec("CREATE TABLE IF NOT EXISTS motos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        modelo VARCHAR(255) NOT NULL,
        marca VARCHAR(255) NOT NULL,
        ano INT NOT NULL,
        preco DECIMAL(10,2) NOT NULL
    )");

    return $db;
}

$db = connectDb();

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$scriptName = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
$apiPath = array_slice($requestUri, count($scriptName));

if ($method == 'GET' && count($apiPath) == 1 && $apiPath[0] == 'motos') {
    $stmt = $db->query("SELECT * FROM motos");
    $motos = $stmt->fetchAll();
    echo json_encode($motos);

} elseif ($method == 'POST' && count($apiPath) == 1 && $apiPath[0] == 'motos') {
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input['modelo'], $input['marca'], $input['ano'], $input['preco'])) {
        $stmt = $db->prepare("INSERT INTO motos (modelo, marca, ano, preco) VALUES (?, ?, ?, ?)");
        $stmt->execute([$input['modelo'], $input['marca'], $input['ano'], $input['preco']]);
        echo json_encode(["message" => "Moto criada com sucesso", "id" => $db->lastInsertId()]);
    } else {
        echo json_encode(["error" => "Dados incompletos"]);
    }

} elseif ($method == 'GET' && count($apiPath) == 2 && $apiPath[0] == 'motos') {
    $id = (int)$apiPath[1];
    $stmt = $db->prepare("SELECT * FROM motos WHERE id = ?");
    $stmt->execute([$id]);
    $moto = $stmt->fetch();
    echo $moto ? json_encode($moto) : json_encode(["error" => "Moto não encontrada"]);

} elseif ($method == 'PUT' && count($apiPath) == 2 && $apiPath[0] == 'motos') {
    $id = (int)$apiPath[1];
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input['modelo'], $input['marca'], $input['ano'], $input['preco'])) {
        $stmt = $db->prepare("UPDATE motos SET modelo = ?, marca = ?, ano = ?, preco = ? WHERE id = ?");
        $stmt->execute([$input['modelo'], $input['marca'], $input['ano'], $input['preco'], $id]);
        echo json_encode(["message" => "Moto atualizada com sucesso"]);
    } else {
        echo json_encode(["error" => "Dados incompletos"]);
    }

} elseif ($method == 'DELETE' && count($apiPath) == 2 && $apiPath[0] == 'motos') {
    $id = (int)$apiPath[1];
    $stmt = $db->prepare("DELETE FROM motos WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(["message" => "Moto deletada com sucesso"]);

} else {
    echo json_encode(["error" => "Rota não encontrada"]);
}
