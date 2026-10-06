<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de usuarios</title>
</head>
<body>
    <h1>Lista de usuarios</h1>

      <table border="2">
        <tr><th>NOME</th><th>EMAIL</th><th>AÇÕES</th></tr>
        
        <?php

$arqUsuario = fopen("usuarios.txt", "r") or die("erro ao abrir arquivo");

$linha = fgets($arqUsuario);

while(!feof($arqUsuario)) {

    $linha = fgets($arqUsuario);

    if($linha != "") {

        $colunaDados = explode(";", $linha);

       echo "<tr><td>" . $colunaDados[0] . "</td>" .
                    "<td>" . $colunaDados[1] . "</td>" .
                    "<td>" .
                    "<a href='alterar_usuario.php?nome=" . $colunaDados[0] . "'>Alterar</a> " .
                    "<a href='excluir_usuario.php?nome=" . $colunaDados[0] . "'>Excluir</a>" .
                    "</td></tr>";
    }
}

fclose($arqUsuario);

?>

</table>

</body>
</html>