<h2>Listagem de mensagens</h2>

<?php

    include_once("conexao.php");

    $query = mysqli_query($conexao,"SELECT * FROM contatos");

    while($tabela = mysqli_fetch_array($query)){
        echo "Nome: $tabela[nome] <br>";
        echo "E-mail: $tabela[email] <br>";
        echo "Assunto: $tabela[assunto] <br>";
        echo "Mensagem: $tabela[mensagem] <br>";
        echo "<a href=?pg=excluir&id=$tabela[id]>[x] Excluir mensagem</a><br>";
        echo "<hr>";
    }

    mysqli_close($conexao);