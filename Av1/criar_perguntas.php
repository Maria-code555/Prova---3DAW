<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
 
    $pergunta = $_POST["pergunta"]; 

    $msg = ""; 
 
    if (!file_exists("perguntas.txt")) { 
 
        $arqAluno = fopen("perguntas.txt", "w") or die("Erro ao criar!"); 
        $linha = "pergunta\n"; 
 
        fwrite($arqPergunta, $linha);
        fclose($arqPergunta); 
    } 
 
    $arqPergunta = fopen("perguntas.txt", "a") or die("erro ao criar"); 
    $linha = $pergunta . "\n"; 

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
            Crie a sua pergunta de multipla escolha 
        </p> 
 
        <form action="" method="POST"> 
 
        <input type="text" pergunta="pergunta" required> 

        <input type="submit" value="criar pergunta"> 
        </form>  
         
        <?php echo $msg; ?>
         
        <br> 
 
</body> 
</html>