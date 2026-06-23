<?php
session_start();
require_once 'config.php';

// Define que toda saída deste arquivo vai ser no formato JSON
header('Content-Type: application/json');

// Captura payloads em JSON enviados por um POST
$data = json_decode(file_get_contents('php://input'), true) ?? [];
$action = $_GET['action'] ?? '';

$db = getDBConnection();

switch ($action) {
    case 'check-auth':
        // Verifica se a sessão do usuário tá ativa no servidor
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
        $password = trim($data['password'] ?? '');

        if (empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'error' => 'Por favor, preencha todos os campos.']);
            break;
        }

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Grava login em sessão
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            echo json_encode([
                'success' => true, 
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'E-mail ou senha incorretos.']);
        }
        break;

    case 'logout':
        session_destroy();
        echo json_encode(['success' => true]);
        break;

    case 'get-services':
        // Busca a árvore completa de categorias com seus respectivos serviços vinculados
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

            // Insere cada item individualizado com data e hora selecionados nos popups
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
