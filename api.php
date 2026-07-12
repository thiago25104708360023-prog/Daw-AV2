<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $_GET['action'] ?? '';

$db = getDBConnection();

switch ($action) {
    case 'check-auth':
        if (isset($_SESSION['user_id'])) {
            echo json_encode([
                'authenticated' => true, 
                'user' => [
                    'id' => $_SESSION['user_id'],
                    'name' => $_SESSION['user_name'],
                    'email' => $_SESSION['user_email']
                ]
            ]);
        } else {
            echo json_encode(['authenticated' => false]);
        }
        break;

    case 'login':
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        // Validação simples: precisa ter algo antes do @ e algo depois do @
        if (!preg_match('/^\S+@\S+$/', $email)) {
            echo json_encode(['success' => false, 'error' => 'E-mail inválido.']);
            break;
        }

        // Busca o usuário pelo e-mail
        $stmt = $db->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // password_verify compara a senha digitada com o hash salvo no banco
        if (!$user || !password_verify($password, $user['password'])) {
            echo json_encode(['success' => false, 'error' => 'E-mail ou senha incorretos.']);
            break;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        echo json_encode([
            'success' => true,
            'message' => 'Login efetuado com sucesso',
            'user' => [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email']
            ]
        ]);
        break;

    case 'register':
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if ($name === '' || !preg_match('/^\S+@\S+$/', $email) || strlen($password) < 6) {
            echo json_encode(['success' => false, 'error' => 'Preencha nome, e-mail válido e senha com pelo menos 6 caracteres.']);
            break;
        }

        // Confere se já existe alguém com esse e-mail (a coluna também é UNIQUE no banco)
        $checkStmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $checkStmt->execute([$email]);
        if ($checkStmt->fetch()) {
            echo json_encode(['success' => false, 'error' => 'Este e-mail já está cadastrado.']);
            break;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $insertStmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $insertStmt->execute([$name, $email, $hashedPassword]);

        $_SESSION['user_id'] = $db->lastInsertId();
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;

        echo json_encode([
            'success' => true,
            'message' => 'Conta criada com sucesso!',
            'user' => [
                'id' => $_SESSION['user_id'],
                'name' => $name,
                'email' => $email
            ]
        ]);
        break;

    case 'logout':
        session_destroy();
        echo json_encode(['success' => true]);
        break;

    case 'get-services':
        $categoriesQuery = $db->query("SELECT * FROM categories ORDER BY id ASC");
        $categories = $categoriesQuery->fetchAll();

        $result = [];
        foreach ($categories as $cat) {
            $stmt = $db->prepare("SELECT * FROM services WHERE category_id = ? ORDER BY id ASC");
            $stmt->execute([$cat['id']]);
            $cat['services'] = $stmt->fetchAll();
            $result[] = $cat;
        }

        echo json_encode(['success' => true, 'data' => $result]);
        break;

    case 'save-appointment':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'error' => 'Acesso não autorizado.']);
            break;
        }

        $cart = $data['cart'] ?? [];
        $totalPrice = floatval($data['total_price'] ?? 0);

        if (empty($cart)) {
            echo json_encode(['success' => false, 'error' => 'O carrinho está vazio.']);
            break;
        }

        try {
            $db->beginTransaction();

            $stmt = $db->prepare("INSERT INTO appointments (user_id, total_price) VALUES (?, ?)");
            $stmt->execute([$_SESSION['user_id'], $totalPrice]);
            $appointmentId = $db->lastInsertId();
 
            $itemStmt = $db->prepare("INSERT INTO appointment_items (appointment_id, service_id, booking_date, booking_time, price) VALUES (?, ?, ?, ?, ?)");
            foreach ($cart as $item) {
                $itemStmt->execute([
                    $appointmentId,
                    $item['id'],
                    $item['date'],
                    $item['time'],
                    $item['price']
                ]);
            }

            $db->commit();
            echo json_encode(['success' => true, 'message' => 'Agendamento cadastrado com sucesso no banco de dados!']);
        } catch (Exception $e) {
            $db->rollBack();
            echo json_encode(['success' => false, 'error' => 'Erro ao processar agendamento: ' . $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Ação inválida.']);
        break;
}
