<?php
// Cadastro com erros de sintaxe e falta de validação
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);

    $erros = array();
    
    if (empty($nome)) {
        $erros[] = "O nome é obrigatório";
    }
    
    if (empty($email)) {
        $erros[] = "O email é obrigatório";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Email inválido";
    }

    if (empty($erros)) {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome, $email);
        $res = $stmt->execute();
    
        if ($res) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar!";
        }
        $stmt->close();
    } else {
        foreach ($erros as $erro) {
            echo $erro . "<br>";
        }
    }
}

?>

<form method="POST">
    Nome: <input type="text" name="nome"><br>
    Email: <input type="email" name="email"><br>
    <input type="submit" value="Cadastrar">
</form>