<?php

$msg = "";

$id = "";
$pergunta = "";
$letraA = "";
$letraB = "";
$letraC = "";
$letraD = "";
$correta = "";


if(isset($_POST["buscar"])) {

    $id = $_POST["id"];

    $arqPergunta = fopen("perguntas.txt", "r")
        or die("Erro ao abrir arquivo");

    $linha = fgets($arqPergunta);

    while(!feof($arqPergunta)) {

        $linha = fgets($arqPergunta);

        if($linha != "") {

            $colunaDados = explode(";", $linha);

            if($colunaDados[0] == $id) {

                $pergunta = $colunaDados[1];
                $letraA = $colunaDados[2];
                $letraB = $colunaDados[3];
                $letraC = $colunaDados[4];
                $letraD = $colunaDados[5];
                $correta = trim($colunaDados[6]);
                break;
            }
        }
    }

    fclose($arqPergunta);

    if($pergunta == "") {

        $msg = "Pergunta não encontrada!";

    }

}

if(isset($_POST["alterar"])) {

    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $letraA = $_POST["letraA"];
    $letraB = $_POST["letraB"];
    $letraC = $_POST["letraC"];
    $letraD = $_POST["letraD"];
    $correta = $_POST["correta"];


    $arqPergunta = fopen("perguntas.txt", "r")or die("Erro ao abrir arquivo");

    $arqTemp = fopen("perguntasTemp.txt", "w")or die("Erro ao criar arquivo");

    $linha = fgets($arqPergunta);

    fprintf($arqTemp, "%s", $linha);

    while(!feof($arqPergunta)) {

        $linha = fgets($arqPergunta);

        if($linha != "") {

            $colunaDados = explode(";", $linha);

            if($colunaDados[0] == $id) {

                fprintf($arqTemp,"%s;%s;%s;%s;%s;%s;%s\n",$id,$pergunta,$letraA,$letraB,$letraC,$letraD,$correta);

            } else {

                fprintf($arqTemp, "%s", $linha);

            }
        }
    }


    fclose($arqPergunta);
    fclose($arqTemp);

    $arqPergunta = fopen("perguntas.txt", "w")or die("Erro ao abrir arquivo");

    $arqTemp = fopen("perguntasTemp.txt", "r")or die("Erro ao abrir arquivo");

    while(!feof($arqTemp)) {

        $linha = fgets($arqTemp);

        if($linha != "") {

            fprintf($arqPergunta, "%s", $linha);

        }
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
    <title>Alterar Pergunta</title>
</head>
<body>
    <h1>Alterar pergunta de múltipla escolha</h1>

    <form action="alterar_multipla.php" method="POST">

        <p>Digite o ID da pergunta:</p>

        <input type="number" name="id" value="<?php echo $id; ?>" required>

        <input type="submit" name="buscar" value="Buscar pergunta">

    </form>


    <br>

    <?php echo $msg; ?>


    <?php

    if($pergunta != "") {

    ?>

        <hr>

        <h2>Dados da pergunta</h2>

        <form action="alterar_multipla.php" method="POST">

            <p>ID:</p>

            <input type="number" name="id" value="<?php echo $id; ?>" readonly>

            <p>Pergunta:</p>

            <input type="text" name="pergunta" value="<?php echo $pergunta; ?>" required>


            <p>Letra A:</p>

            <input type="text" name="letraA" value="<?php echo $letraA; ?>" required>


            <p>Letra B:</p>

            <input type="text" name="letraB" value="<?php echo $letraB; ?>" required>

            <p>Letra C:</p>

            <input type="text" name="letraC" value="<?php echo $letraC; ?>" required>

            <p>Letra D:</p>

            <input type="text" name="letraD" value="<?php echo $letraD; ?>" required>

            <p>Qual é a resposta correta?</p>

            <select name="correta" required>

                <option value="A"
                    <?php if($correta == "A") echo "selected"; ?>>
                    Letra A
                </option>

                <option value="B"
                    <?php if($correta == "B") echo "selected"; ?>>
                    Letra B
                </option>

                <option value="C"
                    <?php if($correta == "C") echo "selected"; ?>>
                    Letra C
                </option>

                <option value="D"
                    <?php if($correta == "D") echo "selected"; ?>>
                    Letra D
                </option>

            </select>


            <br><br>


            <input type="submit" name="alterar" value="Confirmar alteração">

        </form>

    <?php

    }

    ?>

    <br>
    
    <a href="criar_perguntas_multipla_escolha.php">Volte para o criar multipla escolha</a>

    <br><br>

    <a href="listar_perguntas.php">Veja suas perguntas</a>

    <br><br>

    <a href="listar_uma_pergunta.php">Veja uma pergunta especifica</a>

</body>
</html>

