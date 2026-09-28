<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
 
    $pergunta = $_POST["pergunta"]; 
    $letraA = $_POST["letraA"];
    $letraB = $_POST["letraB"];
    $letraC = $_POST["letraC"];
    $letraD = $_POST["letraD"];
    $correta = $_POST["correta"];

    $msg = ""; 
 
    if (!file_exists("perguntas.txt")) { 
 
        $arqPergunta = fopen("perguntas.txt", "w") or die("Erro ao criar!"); 
        $linha = "pergunta;letraA;letraB;letraC;letraD;correta\n"; 
 
        fwrite($arqPergunta, $linha);
        fclose($arqPergunta); 
    } 
 
    $arqPergunta = fopen("perguntas.txt", "a") or die("erro ao criar"); 

    $linha = $pergunta . ";" . $letraA . ";" . $letraB . ";" . $letraC . ";" . $letraD . ";" . $correta . "\n"; 

    fwrite($arqPergunta, $linha); 
    fclose($arqPergunta); 

    $msg = "Pergunta criada com sucesso!!!"; 
} 
 
?> 
 
<!DOCTYPE html> 
<html lang="pt-br"> 
 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 
    <title>Crie suas perguntas</title>
</head> 
 
<body> 

    <h1>Crie suas perguntas</h1> 

    <p class="subtitulo"> 
        Crie a sua pergunta de múltipla escolha
    </p> 
 
    <form action="" method="POST"> 
 
        <p>Pergunta:</p>
        <input type="text" name="pergunta" required>

        <p>Letra A:</p>
        <input type="text" name="letraA" required>

        <p>Letra B:</p>
        <input type="text" name="letraB" required>

        <p>Letra C:</p>
        <input type="text" name="letraC" required>

        <p>Letra D:</p>
        <input type="text" name="letraD" required>

        <p>Qual é a resposta correta?</p>

        <select name="correta" required>
            <option value="A">Letra A</option>
            <option value="B">Letra B</option>
            <option value="C">Letra C</option>
            <option value="D">Letra D</option>
        </select>

        <br><br>

        <input type="submit" value="Criar pergunta de múltipla escolha"> 

    </form>  
         
    <?php echo $msg; ?>
         
    <br> 
 
</body> 
</html>
