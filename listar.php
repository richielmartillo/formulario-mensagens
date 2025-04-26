<?php
// Ativa erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco
$conn = new mysqli("localhost", "phpuser", "1234", "projeto_php");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta com o ID incluído
$sql = "SELECT id, nome, mensagem FROM mensagens ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mensagens Recebidas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Mensagens Recebidas</h2>

    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>" . htmlspecialchars($row["nome"]) . ":</strong> " . 
             htmlspecialchars($row["mensagem"]) . "</p>";
        
        echo "<form method='post' action='excluir.php' style='display:inline;'>
                <input type='hidden' name='id' value='" . $row["id"] . "'>
                <input type='submit' value='Excluir'>
              </form>
              <hr>";
    }
    
    ?>
    
    <br><br>
<a href="formulario.php" class="botao-voltar">Voltar para o Formulário</a>

</body>
</html>
