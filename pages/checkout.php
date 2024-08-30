<?php
session_start();

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$response = array("success" => false, "message" => "");

// Datos de conexión a la base de datos
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cafeteria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    error_log("Conexión fallida: " . $conn->connect_error);
    $response["message"] = "Conexión fallida: " . $conn->connect_error;
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Error de JSON: " . json_last_error_msg());
        $response["message"] = 'Error de JSON: ' . json_last_error_msg();
        echo json_encode($response);
        exit();
    }

    $productos = $data['productos'];
    $total_a_pagar = $data['total_a_pagar'];

    // Verificar si el usuario está logueado
    if (!isset($_SESSION['user_id'])) {
        error_log("Debe iniciar sesión para realizar un pedido");
        $response["message"] = 'Debe iniciar sesión para realizar un pedido';
        echo json_encode($response);
        exit();
    }

    $usuario_realizador = $_SESSION['user_id'];

    // Verificar que el ID del usuario exista en la tabla clientes
    $stmt_check_user = $conn->prepare("SELECT ID_Cliente FROM clientes WHERE ID_Cliente = ?");
    $stmt_check_user->bind_param("i", $usuario_realizador);
    $stmt_check_user->execute();
    $result_check_user = $stmt_check_user->get_result();

    if ($result_check_user->num_rows == 0) {
        error_log("El usuario no existe en la tabla clientes: " . $usuario_realizador);
        $response["message"] = 'El usuario no existe en la tabla clientes';
        echo json_encode($response);
        exit();
    }

    $stmt_check_user->close();

    $productos_json = json_encode($productos);

    // Insertar el pedido en la tabla 'pedido'
    $stmt = $conn->prepare("INSERT INTO pedido (productos, Fecha_ingreso, Estado_pedido, Total_A_Pagar, Usuario_realizador) VALUES (?, NOW(), 'pendiente', ?, ?)");
    if ($stmt === false) {
        error_log("Error en la preparación del statement: " . $conn->error);
        $response["message"] = 'Error en la preparación del statement: ' . $conn->error;
        echo json_encode($response);
        exit();
    }
    $stmt->bind_param("sds", $productos_json, $total_a_pagar, $usuario_realizador);

    if ($stmt->execute()) {
        // Obtener el ID del pedido insertado
        $pedido_id = $stmt->insert_id;

        // Actualizar el carrito de compras con el ID del pedido y el total
        $stmt_update = $conn->prepare("UPDATE carro_de_compra SET ID_Pedido = ?, Total_A_Pagar = ? WHERE ID_carrito = ?");
        $stmt_update->bind_param("idi", $pedido_id, $total_a_pagar, $_SESSION['carrito_id']);
        if ($stmt_update->execute()) {
            $response["success"] = true;
            $response["message"] = 'Pedido realizado con éxito';
            echo json_encode($response);
        } else {
            error_log("Error al actualizar el carrito de compras: " . $stmt_update->error);
            $response["message"] = 'Error al actualizar el carrito de compras: ' . $stmt_update->error;
            echo json_encode($response);
        }
        $stmt_update->close();
    } else {
        error_log("Error al realizar el pedido: " . $stmt->error);
        $response["message"] = 'Error al realizar el pedido: ' . $stmt->error;
        echo json_encode($response);
    }

    $stmt->close();
}

$conn->close();
?>
