
<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "phpuser", "1234", "projeto_php");

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
    <input type="text" name="nome" placeholder="Seu nome" required><br><br>
    <textarea name="mensagem" placeholder="Sua mensagem" required></textarea><br><br>
    <input type="submit" value="Enviar">
</form>

<?php if ($mensagemSucesso): ?>
    <p class="sucesso">Mensagem enviada com sucesso!</p>
<?php endif; ?>

</body>
</html>
