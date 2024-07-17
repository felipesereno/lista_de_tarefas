<?php
require '../pdo/connection.php';  // Inclui o arquivo de conexão com o banco de dados

// Processar o formulário quando for enviado via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tarefa = $_POST['tarefa'] ?? null;  // Obtém a tarefa do formulário ou define como nulo se não for preenchida

    if (empty($tarefa)) {
        // Redireciona de volta para a página de visualização com uma mensagem de erro se a tarefa não for preenchida
        header("Location: ../view/viewTarefas.php?error=Por%20favor,%20preencha%20o%20campo%20de%20tarefa.");
        exit();
    } else {
        // Prepara a consulta SQL para inserir a tarefa no banco de dados
        $sql = "INSERT INTO usuario (tarefas) VALUES (:tarefa)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->bindParam(':tarefa', $tarefa, PDO::PARAM_STR);  // Vincula o parâmetro da tarefa
            if ($stmt->execute()) {
                // Redireciona com uma mensagem de sucesso se a inserção for bem-sucedida
                header("Location: ../view/viewTarefas.php?success=Tarefa%20criada%20com%20sucesso!");
            } else {
                // Redireciona com uma mensagem de erro se a inserção falhar
                header("Location: ../view/viewTarefas.php?error=Erro%20ao%20criar%20tarefa.");
            }
        } catch (PDOException $e) {
            // Redireciona com uma mensagem de erro contendo a mensagem da exceção
            header("Location: ../view/viewTarefas.php?error=Erro:%20" . urlencode($e->getMessage()));
        }
        exit();  // Encerra o script após o redirecionamento
    }
}

// Exibir as tarefas armazenadas no banco de dados
try {
    $sql = "SELECT id, tarefas FROM usuario";  // Prepara a consulta SQL para selecionar todas as tarefas
    $stmt = $pdo->prepare($sql);
    $stmt->execute();  // Executa a consulta
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtém todas as tarefas como um array associativo

    echo '<ul class="list-group">';  // Inicia a lista de tarefas
    foreach ($tarefas as $tarefa) {
        // Exibe cada tarefa em um item da lista com um botão para concluir (excluir)
        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
        echo htmlspecialchars($tarefa['tarefas']);  // Exibe a tarefa com caracteres especiais convertidos para entidades HTML
        //Abaixo:
        // Campo oculto com o ID da tarefa
        // Botão para enviar o formulário de exclusão
        echo '<form action="../controller/deleteTarefas.php" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="' . $tarefa['id'] . '">  
                <button class="btn btn-danger btn-sm" type="submit">Concluir</button>                    
            </form>';
        echo '</li>';
    }
    echo '</ul>';  // Fecha a lista de tarefas
} catch (PDOException $e) {
    // Exibe uma mensagem de erro se a consulta falhar
    echo "Erro: " . $e->getMessage();
}
?>
