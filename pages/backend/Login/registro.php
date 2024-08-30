<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cafeteria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Encriptar la contraseña
$rol_id = 0; // Asumiendo que todos los registros desde esta página son de clientes

// Verificar si el email ya existe
$sql = "SELECT * FROM usuarios WHERE Correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "El email ya está registrado.";
} else {
    // Insertar nuevo usuario en la tabla usuarios
    $sql = "INSERT INTO usuarios (Usuario, Contrasena, Rol_ID, Correo, Nombre) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $usuario, $contrasena, $rol_id, $correo, $nombre);

    if ($stmt->execute()) {
        $usuario_id = $stmt->insert_id;

        // Si es un cliente (Rol_ID = 0), también insertar en la tabla clientes
        if ($rol_id == 0) {
            $sql_cliente = "INSERT INTO clientes (ID_Cliente, Nombre, Rol_ID) VALUES (?, ?, ?)";
            $stmt_cliente = $conn->prepare($sql_cliente);
            $stmt_cliente->bind_param("isi", $usuario_id, $nombre, $rol_id);
            $stmt_cliente->execute();
            $stmt_cliente->close();
        }

        echo "Registro exitoso.";
        // Redirigir al usuario a la página de inicio de sesión
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
        header("Location: login.php");
        exit();
    }
}

$stmt->close();
$conn->close();
