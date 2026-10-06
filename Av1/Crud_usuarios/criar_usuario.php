<?php

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST["nome"];
    $email = $_POST["email"];

    if (!file_exists("usuarios.txt")) {

        $arqUsuario = fopen("usuarios.txt", "w") or die("Erro ao criar!");

        $linha = "nome;email\n";

        fwrite($arqUsuario, $linha);

        fclose($arqUsuario);
    }

    $arqUsuario = fopen("usuarios.txt", "a") or die("erro ao criar");

    $linha = $nome . ";" . $email . "\n";

    fwrite($arqUsuario, $linha);

    fclose($arqUsuario);

    $msg = "Usuario criado com sucesso!!!";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar usuario</title>
</head>
<body>
        <h1>Criar usuarios</h1>

        <p class="subtitulo">
            Preencha os dados do usuario
        </p>

        <form action="criar_usuario.php" method="POST">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" required>

        <br><br>

        <input type="submit" value="Criar usuario">

        </form> 
        
        <p><?php echo $msg; ?></p>
        
        <a href="listar_usuario.php">Ir para a lista de usuarios cadastrados</a>

</body>
</html>
