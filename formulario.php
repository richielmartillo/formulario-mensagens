<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "817426", "formulario_



































mensagens");


if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$mensagemSucesso = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $mensagem = $_POST["mensagem"];

    $stmt = $conn->prepare("INSERT INTO mensagens (nome, mensagem) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $mensagem);

    if ($stmt->execute()) {
        $mensagemSucesso = true;
        // Redirecionar para listar.php após sucesso
        header("Location: listar.php");
        exit();
    } else {
        echo "<p>Erro ao enviar a mensagem.</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Deixe sua Mensagem</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Deixe sua mensagem:</h2>
    <form action="formulario.php" method="post">
        <input type="text" name="nome" placeholder="Seu nome" required><br>
        <textarea name="mensagem" placeholder="Sua mensagem" required></textarea><br>
        <input type="submit" value="Enviar">
    </form>

    <?php if ($mensagemSucesso): ?>
        <p class="sucesso">Mensagem enviada com sucesso!</p>
    <?php endif; ?>
</body>
</html>
