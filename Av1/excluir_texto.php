<?php

$msg = "";

$id = "";
$pergunta = "";
$resposta = "";

if(isset($_POST["buscar"])) {

    $id = $_POST["id"];

    $arqPergunta = fopen("perguntas_texto.txt", "r") or die("Erro ao abrir arquivo");

    $linha = fgets($arqPergunta);

    while(!feof($arqPergunta)) {

        $linha = fgets($arqPergunta);

        if($linha != "") {

            $colunaDados = explode(";", $linha);

            if($colunaDados[0] == $id) {

                $pergunta = $colunaDados[1];
                $resposta = $colunaDados[2];
                break;

            }
        }
    }

    fclose($arqPergunta);

}

if(isset($_POST["excluir"])) {

    $id = $_POST["id"];

    $arqPergunta = fopen("perguntas_texto.txt", "r") or die("Erro ao abrir arquivo");

    $perguntas = "";
    $linha = fgets($arqPergunta);
    $perguntas = $linha;

    while(!feof($arqPergunta)) {

        $linha = fgets($arqPergunta);

        if($linha != "") {

            $colunaDados = explode(";", $linha);

            if($colunaDados[0] == $id) {

                $msg = "Pergunta excluída com sucesso!";

            } else {

                $perguntas = $perguntas . $linha;

            }
        }
    }

    fclose($arqPergunta);

    $arqPergunta = fopen("perguntas_texto.txt", "w") or die("Erro ao abrir o arquivo");
    fwrite($arqPergunta, $perguntas);
    fclose($arqPergunta);

}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Pergunta de Texto</title>
</head>
<body>
    <h1>Excluir Pergunta de Texto</h1>
    <form action="excluir_texto.php" method="POST">

        <h3>Insira o ID da pergunta para excluir</h3>

        <br>

        ID
        <input type="number" name="id" value="<?php echo $id; ?>" required>

        <input type="submit" name="buscar" value="Buscar pergunta">

    </form>


    <?php echo "$msg"; ?>


    <?php

    if($pergunta != "") {

    ?>

        <br>

        <hr>

        <h3>Confira os dados antes de excluir:</h3>

        <p>ID: <?php echo $id; ?></p>
        <p>Pergunta: <?php echo $pergunta; ?></p>
        <p>Resposta: <?php echo $resposta; ?></p>


        <form action="excluir_texto.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <input type="submit" name="excluir" value="Confirmar exclusão">

        </form>

    <?php

    }

    ?>

     <br>

    <a href="perguntas_texto.php">Criar pergunta de texto</a>
    
    <br><br>

    <a href="criar_perguntas_multipla_escolha.php">Criar pergunta de múltipla escolha</a>

    <br><br>

    <a href="listar_perguntas.php">Veja suas perguntas</a>

    <br><br>

    <a href="listar_uma_pergunta.php">Veja uma pergunta especifica</a>

</body>
</html>