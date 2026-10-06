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

        $colunaDados = explode(";", $linha);

        if($colunaDados[0] == $id) {

            $pergunta = $colunaDados[1];
            $resposta = $colunaDados[2];

            break;
        }
    }

    fclose($arqPergunta);

}


if(isset($_POST["alterar"])) {

    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $resposta = $_POST["resposta"];


    $arqPergunta = fopen("perguntas_texto.txt", "r") or die("Erro ao abrir arquivo");

    $arqTemp = fopen("perguntas_textoTemp.txt", "w") or die("Erro ao criar arquivo");


    $linha = fgets($arqPergunta);

    fprintf($arqTemp, "%s", $linha);


    while(!feof($arqPergunta)) {

        $linha = fgets($arqPergunta);

        $colunaDados = explode(";", $linha);

        if($colunaDados[0] == $id) {

            fprintf($arqTemp, "%s;%s;%s\n", $id, $pergunta, $resposta);

        } else {

            fprintf($arqTemp, "%s", $linha);

        }
    }


    fclose($arqPergunta);
    fclose($arqTemp);


    $arqPergunta = fopen("perguntas_texto.txt", "w") or die("Erro ao abrir arquivo");

    $arqTemp = fopen("perguntas_textoTemp.txt", "r") or die("Erro ao abrir arquivo");


    while(!feof($arqTemp)) {

        $linha = fgets($arqTemp);

        fprintf($arqPergunta, "%s", $linha);

    }


    fclose($arqPergunta);
    fclose($arqTemp);


    $msg = "Pergunta alterada com sucesso!";

}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Pergunta de Texto</title>
</head>
<body>
    <form action="alterar_texto.php" method="POST">

        <h3>Insira o ID da pergunta para alterar</h3>

        <br>

        ID
        <input type="number" name="id" id="id" value="<?php echo $id; ?>" required>

        <input type="submit" name="buscar" value="Buscar pergunta">

    </form>


    <?php echo "$msg"; ?>


    <?php

    if($pergunta != "") {

    ?>

        <br>

        <hr>

        <form action="alterar_texto.php" method="POST">

            <h3>Insira as informações para alterar a pergunta</h3>

            <br>

            ID
            <input type="number" name="id" id="id" value="<?php echo $id; ?>" readonly>

            <br><br>

            Pergunta
            <input type="text" name="pergunta" id="pergunta" value="<?php echo $pergunta; ?>" required>

            <br><br>

            Resposta
            <input type="text" name="resposta" id="resposta" value="<?php echo $resposta; ?>" required>

            <br><br>

            <input type="submit" name="alterar" value="Confirmar alteração">

        </form>

    <?php

    }

    ?>

    <br>
    
    <a href="perguntas_texto.php">Volte para o criar pergunta de texto</a>

    <br><br>

    <a href="listar_perguntas.php">Veja suas perguntas</a>

    <br><br>

    <a href="listar_uma_pergunta.php">Veja uma pergunta especifica</a>

</body>
</html>
