<?php
require_once 'conexao.php';

$editUser = null;
if ($_GET['action'] === 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);
    $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
}

$users = $pdo->query("SELECT * FROM users ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD com PDO e MySQL</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #ccc; text-align: left; }
        th { background: #2980b9; color: white; }
        form input, button { padding: 8px; margin: 5px 0; width: 100%; }
        button { background: #2980b9; color: white; border: none; cursor: pointer; }
        a { color: #2980b9; text-decoration: none; }
    </style>
</head>
<body>
<div class="container">
    <h1>Usuários</h1>

    <form method="POST" action="operacoes.php?action=<?php echo $editUser ? 'update' : 'create'; ?>">
        <?php if ($editUser): ?>
            <input type="hidden" name="id" value="<?php echo $editUser['id']; ?>">
        <?php endif; ?>
        <input type="text" name="name" placeholder="Nome" required value="<?php echo $editUser['name'] ?? ''; ?>">
        <input type="email" name="email" placeholder="Email" required value="<?php echo $editUser['email'] ?? ''; ?>">
        <button type="submit"><?php echo $editUser ? 'Atualizar' : 'Adicionar'; ?></button>
        <?php if ($editUser): ?>
            <a href="index.php">Cancelar</a>
        <?php endif; ?>
    </form>

    <table>
        <thead>
            <tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <a href="index.php?action=edit&id=<?php echo $user['id']; ?>">Editar</a> |
                    <a href="operacoes.php?action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Excluir este usuário?');">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($users)): ?>
            <tr><td colspan="4">Nenhum usuário encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
