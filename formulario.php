
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Formulário com PHP</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $mensagem = $_POST['mensagem'];

        $conn = new mysqli("localhost", "phpuser", "1234", "projeto_php");

        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        $sql = "INSERT INTO mensagens (nome, mensagem) VALUES ('$nome', '$mensagem')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:#00ff00;'>Mensagem enviada com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>Erro ao enviar mensagem: " . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>

    <h2>Deixe sua mensagem:</h2>

    <p style="color: orange; opacity: 0.9; position: absolute; right: 20px; top: 100px; font-size: 5px; font-family: monospace;">
  Termina ativo... Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt consectetur face
</p>


    <form method="post" action="formulario.php">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>

        <label for="mensagem">Mensagem:</label><br>
        <textarea id="mensagem" name="mensagem" required></textarea><br>

        <input type="submit" value="Enviar">
    </form>

    <br><br>
<a href="listar.php" class="botao-voltar">Ver Mensagens</a>


</body>
</html>
