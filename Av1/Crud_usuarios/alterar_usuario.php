<?php

$msg = "";

$nome = "";
$email = "";
$nomeAntigo = "";

if(isset($_POST["buscar"])) {

    $nome = $_POST["nome"];

    $arqUsuario = fopen("usuarios.txt", "r") or die("Erro ao abrir arquivo");

    $linha = fgets($arqUsuario);

    while(!feof($arqUsuario)) {

        $linha = fgets($arqUsuario);

        if($linha != "") {

            $colunaDados = explode(";", $linha);

            if(trim($colunaDados[0]) == $nome) {

                $email = trim($colunaDados[1]);

                $nomeAntigo = $nome;

                break;

            }
        }
    }
    fclose($arqUsuario);
}

if(isset($_POST["alterar"])) {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $nomeAntigo = $_POST["nomeAntigo"];

    $arqUsuario = fopen("usuarios.txt", "r") or die("Erro ao abrir arquivo");

    $arqTemp = fopen("usuariosTemp.txt", "w") or die("Erro ao criar arquivo");

    $linha = fgets($arqUsuario);

    fprintf($arqTemp, "%s", $linha);

    while(!feof($arqUsuario)) {

        $linha = fgets($arqUsuario);

        if($linha != "") {

            $colunaDados = explode(";", $linha);

            if(trim($colunaDados[0]) == $nomeAntigo) {

                fprintf($arqTemp, "%s;%s\n", $nome, $email);

            } else {

                fprintf($arqTemp, "%s", $linha);

            }
        }
    }

    fclose($arqUsuario);
    fclose($arqTemp);

    $arqUsuario = fopen("usuarios.txt", "w") or die("Erro ao abrir arquivo");

    $arqTemp = fopen("usuariosTemp.txt", "r") or die("Erro ao abrir arquivo");

    while(!feof($arqTemp)) {

        $linha = fgets($arqTemp);

        if($linha != "") {

            fprintf($arqUsuario, "%s", $linha);

        }
    }

    fclose($arqUsuario);
    fclose($arqTemp);

    $msg = "Usuario alterado com sucesso!";

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar usuario</title>
</head>
<body>
    <h1>Alterar usuario</h1>
    <form action="alterar_usuario.php" method="POST">

        <h3>Insira o nome do usuario que deseja alterar</h3>

        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required>

        <input type="submit" name="buscar" value="Buscar usuario">

    </form>

    <p><?php echo $msg; ?></p>

    <?php

    if($email != "") {

    ?>
        <br>

        <hr>
        <form action="alterar_usuario.php" method="POST">

            <h3>Insira os dados para alterar o usuario</h3>

            <input type="hidden" name="nomeAntigo" value="<?php echo $nomeAntigo; ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $nome; ?>" required>

            <br><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required>

            <br><br>

            <input type="submit" name="alterar" value="Confirmar alteração">

        </form>

    <?php

    }

    ?>

    <br>

    <a href="listar_usuario.php">Voltar para a listagem de usuarios</a>

    <br><br>

    <a href="criar_usuario.php">Voltar para criar usuarios</a>

</body>
</html>