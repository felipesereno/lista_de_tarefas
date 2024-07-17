<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/form.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Cadastro de Tarefas</title>
</head>
<body>
    <!-- Container principal que centraliza o conteúdo -->
    <div class="container">
        <h1 class="text-center">Lista de Tarefas</h1>
        <!-- Exibição de mensagens de erro, se existirem -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <!-- Exibe a mensagem de erro passada via parâmetro GET -->
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        
        <!-- Exibição de mensagens de sucesso, se existirem -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success" role="alert">
                <!-- Exibe a mensagem de sucesso passada via parâmetro GET -->
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>
        
        <!-- Div para o conteúdo principal -->
        <div class="conteudo">
            <!-- Formulário para adicionar uma nova tarefa -->
            <form action="../controller/cTarefas.php" method="POST">
                <div class="mb-3">
                    <!-- Campo de entrada para especificar a tarefa -->
                    <input type="text" class="form-control" id="tarefa" name="tarefa" placeholder="Especifique sua tarefa">
                </div>
                <div class="col-12">
                    <!-- Botão de envio do formulário -->
                    <button class="btn btn-primary w-100" type="submit">Enviar</button>
                </div>
            </form>
            
            <!-- Div para listar as tarefas existentes -->
            <div class="lista">
                <h2 class="text-center"></h2>
                <!-- Inclui o script PHP que exibe a lista de tarefas -->
                <?php include '../controller/cTarefas.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>
