<?php 

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    
    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"]; 
    $resposta = $_POST["resposta"];

    if (!file_exists("perguntas_texto.txt")) { 

        $arqPergunta = fopen("perguntas_texto.txt", "w") or die("Erro ao criar!"); 
        $linha = "id;pergunta;resposta\n"; 

        fwrite($arqPergunta, $linha);
        fclose($arqPergunta); 
    }
    
    $arqPergunta = fopen("perguntas_texto.txt", "a") or die("erro ao criar"); 
    $linha = $id . ";" . $pergunta . ";" . $resposta . "\n";
        
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
        Crie a sua pergunta de texto
    </p> 

    <form action="perguntas_texto.php" method="POST"> 
        
        <p>ID:</p>
        <input type="number" name="id" required>

        <p>Pergunta:</p>
        <input type="text" name="pergunta" required>

        <p>Resposta:</p>
        <input type="text" name="resposta" required>

        <br><br>

        <input type="submit" value="Criar pergunta de texto"> 

    </form>  

    <?php echo $msg; ?>

    <br>
    
    <a href="criar_perguntas_multipla_escolha.php">Criar pergunta de múltipla escolha</a>
   
    <br><br>

    <a href="alterar_texto.php">Altere sua pergunta dissertativa</a>
    
    <br><br>

    <a href="listar_perguntas.php">Veja suas perguntas</a>

    <br><br>

    <a href="listar_uma_pergunta.php">Veja uma pergunta especifica</a>


</body> 
</html>
