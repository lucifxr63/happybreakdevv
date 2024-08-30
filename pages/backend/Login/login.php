<?php
session_start();

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

// Verificar si los datos del formulario están presentes
if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Verificar el email y la contraseña
    $sql = "SELECT * FROM Usuarios WHERE Correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($contrasena, $user['Contrasena'])) {
            // Inicio de sesión exitoso
            $_SESSION['user_id'] = $user['ID_Usuarios'];
            $_SESSION['user_name'] = $user['Nombre'];
            $_SESSION['user_email'] = $user['Correo'];
            $_SESSION['user_role'] = $user['Rol_ID'];
            
            // Redirigir al usuario según su rol
            switch ($user['Rol_ID']) {
                case 0:
                    header("Location: ../../index.php");
                    break;
                case 1:
                    header("Location: ../../index.php");
                    break;
                case 2:
                    header("Location: ../../index.php");
                    break;
                case 3:
                    header("Location: ../../index.php");
                    break;
                default:
                    header("Location: ../../index.php");
                    break;
            }
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró una cuenta con ese email.";
    }

    $stmt->close();
} else {
    header("Location: ../../login.php");
}

$conn->close();
?>
