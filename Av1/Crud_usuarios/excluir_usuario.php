<?php

$msg = "";

$nome = "";
$email = "";

if(isset($_POST["buscar"])) {

    $nome = $_POST["nome"];

    $arqUsuario = fopen("usuarios.txt", "r") or die("Erro ao abrir arquivo");

    $linha = fgets($arqUsuario);

    while(!feof($arqUsuario)) {

        $linha = fgets($arqUsuario);

        if($linha != "") {

            $colunaDados = explode(";", $linha);

            if($colunaDados[0] == $nome) {
                $email = $colunaDados[1];
                break;

            }
        }
    }
    fclose($arqUsuario);

}

if(isset($_POST["excluir"])) {

    $nome = $_POST["nome"];

    $arqUsuario = fopen("usuarios.txt", "r") or die("Erro ao abrir arquivo");

    $usuarios = "";

    $linha = fgets($arqUsuario);

    $usuarios = $linha;

    while(!feof($arqUsuario)) {

        $linha = fgets($arqUsuario);

        if($linha != "") {

            $colunaDados = explode(";", $linha);

            if($colunaDados[0] == $nome) {

                $msg = "Usuario excluído com sucesso!";

            } else {

                $usuarios = $usuarios . $linha;

            }
        }
    }
    fclose($arqUsuario);

    $arqUsuario = fopen("usuarios.txt", "w") or die("Erro ao abrir o arquivo");

    fwrite($arqUsuario, $usuarios);

    fclose($arqUsuario);

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuario</title>
</head>
<body>
    <h1>Excluir Usuario</h1>
    <form action="excluir_usuario.php" method="POST">

        <h3>Insira o nome do usuario que deseja excluir</h3>

        <br>

        Nome
        <input type="text" name="nome" value="<?php echo $nome; ?>" required>

        <input type="submit" name="buscar" value="Buscar usuario">

    </form>


    <p><?php echo $msg; ?></p>

    <?php

    if($email != "") {

    ?>
        <br>

        <hr>
        <h3>Confira os dados antes de excluir:</h3>

        <p>Nome: <?php echo $nome; ?></p>

        <p>Email: <?php echo $email; ?></p>

        <form action="excluir_usuario.php" method="POST">

            <input type="hidden" name="nome" value="<?php echo $nome; ?>">

            <input type="submit" name="excluir" value="Confirmar exclusão">

        </form>

    <?php

    }

    ?>

    <br>

    <a href="listar_usuario.php">Voltar para a lista de usuarios</a>

    <br><br>

    <a href="criar_usuario.php">Voltar para criar usuarios</a>

</body>
</html>