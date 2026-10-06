<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar uma Pergunta</title>
</head>
<body>
    <h1>Listar uma Pergunta</h1>
    <h2>Pergunta de Múltipla Escolha</h2>
    <form action="" method="POST">

        ID
        <input type="number" name="idMultipla" required>

        <input type="submit" name="buscarMultipla" value="Buscar pergunta">

    </form>

    <?php

    if(isset($_POST["buscarMultipla"])) {

        $id = $_POST["idMultipla"];

        $arqPergunta = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo");

        $linha = fgets($arqPergunta);

        $encontrou = false;

        while(!feof($arqPergunta)) {

            $linha = fgets($arqPergunta);

            if($linha != "") {

                $colunaDados = explode(";", $linha);

                if(trim($colunaDados[0]) == $id) {

                    echo "<h3>Pergunta encontrada:</h3>";
                    echo "<p><b>ID:</b> " . $colunaDados[0] . "</p>";
                    echo "<p><b>Pergunta:</b> " . $colunaDados[1] . "</p>";
                    echo "<p><b>Letra A:</b> " . $colunaDados[2] . "</p>";
                    echo "<p><b>Letra B:</b> " . $colunaDados[3] . "</p>";
                    echo "<p><b>Letra C:</b> " . $colunaDados[4] . "</p>";
                    echo "<p><b>Letra D:</b> " . $colunaDados[5] . "</p>";
                    echo "<p><b>Resposta correta:</b> " . $colunaDados[6] . "</p>";
                    $encontrou = true;
                    break;

                }

            }

        }

        fclose($arqPergunta);


        if($encontrou == false) {

            echo "<p>Pergunta não encontrada.</p>";

        }

    }

    ?>

    <hr>

    <h2>Pergunta de Texto</h2>

    <form action="" method="POST">

        ID
        <input type="number" name="idTexto" required>

        <input type="submit" name="buscarTexto" value="Buscar pergunta">

    </form>

    <?php

    if(isset($_POST["buscarTexto"])) {

        $id = $_POST["idTexto"];
        $arqPergunta = fopen("perguntas_texto.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqPergunta);
        $encontrou = false;

        while(!feof($arqPergunta)) {

            $linha = fgets($arqPergunta);

            if($linha != "") {

                $colunaDados = explode(";", $linha);

                if(trim($colunaDados[0]) == $id) {

                    echo "<h3>Pergunta encontrada:</h3>";
                    echo "<p><b>ID:</b> " . $colunaDados[0] . "</p>";
                    echo "<p><b>Pergunta:</b> " . $colunaDados[1] . "</p>";
                    echo "<p><b>Resposta:</b> " . $colunaDados[2] . "</p>";
                    $encontrou = true;
                    break;

                }

            }

        }

        fclose($arqPergunta);

        if($encontrou == false) {

            echo "<p>Pergunta não encontrada.</p>";

        }

    }

    ?>

    <br>

    <a href="perguntas_texto.php">Criar pergunta de texto</a>
    
    <br><br>

    <a href="criar_perguntas_multipla_escolha.php">Criar pergunta de múltipla escolha</a>

    <br><br>

    <a href="alterar_multipla.php">Altere sua pergunta de multipla escolha</a>

    <br><br>

    <a href="alterar_texto.php">Altere sua pergunta dissertativa</a>

</body>
</html>