<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Perguntas</title>
</head>
<body>
    <h1>Lista de Perguntas</h1>
    <h2>Perguntas de Múltipla Escolha</h2>
    <table border="1">

        <tr><th>ID</th><th>PERGUNTA</th><th>LETRA A</th><th>LETRA B</th><th>LETRA C</th><th>LETRA D</th><th>RESPOSTA CORRETA</th></tr>

        <?php

        $arqPergunta = fopen("perguntas.txt", "r") or die("erro ao abrir arquivo");

        $linha = fgets($arqPergunta);

        while(!feof($arqPergunta)) {

            $linha = fgets($arqPergunta);

            if($linha != "") {

                $colunaDados = explode(";", $linha);

                echo "<tr><td>" . $colunaDados[0] . "</td>" .
                    "<td>" . $colunaDados[1] . "</td>" .
                    "<td>" . $colunaDados[2] . "</td>" .
                    "<td>" . $colunaDados[3] . "</td>" .
                    "<td>" . $colunaDados[4] . "</td>" .
                    "<td>" . $colunaDados[5] . "</td>" .
                    "<td>" . $colunaDados[6] . "</td></tr>";
            }
        }

        fclose($arqPergunta);

        ?>

    </table>


    <h2>Perguntas de Texto</h2>

    <table border="1">

        <tr><th>ID</th><th>PERGUNTA</th><th>RESPOSTA</th></tr>

        <?php

        $arqPergunta = fopen("perguntas_texto.txt", "r") or die("erro ao abrir arquivo");

        $linha = fgets($arqPergunta);

        while(!feof($arqPergunta)) {

            $linha = fgets($arqPergunta);

            if($linha != "") {

                $colunaDados = explode(";", $linha);

                echo "<tr><td>" . $colunaDados[0] . "</td>" .
                    "<td>" . $colunaDados[1] . "</td>" .
                    "<td>" . $colunaDados[2] . "</td></tr>";
            }
        }

        fclose($arqPergunta);

        ?>

    </table>

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