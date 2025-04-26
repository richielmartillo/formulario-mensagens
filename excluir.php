<?php
// Verifica se foi enviado um ID
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    // Conexão com o banco de dados
    $conn = new mysqli("localhost", "phpuser", "1234", "projeto_php");

    // Verifica conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Prepara e executa a exclusão
    $stmt = $conn->prepare("DELETE FROM mensagens WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: listar.php");
        exit();
    } else {
        echo "Erro ao excluir mensagem.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID inválido.";
}
?>
