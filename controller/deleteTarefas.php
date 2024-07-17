<?php
require '../pdo/connection.php';  // Inclui o arquivo de conexão com o banco de dados

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;  // Obtém o ID da tarefa do formulário ou define como nulo se não for fornecido

    if ($id) {
        try {
            // Prepara a consulta SQL para excluir a tarefa com base no ID
            $sql = "DELETE FROM usuario WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);  // Vincula o parâmetro do ID
            
            // Executa a consulta e verifica se a exclusão foi bem-sucedida
            if ($stmt->execute()) {
                echo "Tarefa excluída com sucesso!";
            } else {
                echo "Erro ao excluir tarefa.";
            }
        } catch (PDOException $e) {
            // Exibe uma mensagem de erro se ocorrer uma exceção
            echo "Erro: " . $e->getMessage();
        }
    } else {
        // Exibe uma mensagem de erro se o ID não for fornecido
        echo "ID da tarefa não fornecido.";
    }
}

// Redireciona de volta para a página principal
header("Location: ../view/viewTarefas.php");
exit;  // Encerra o script após o redirecionamento
?>

