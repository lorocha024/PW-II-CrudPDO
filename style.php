<?php
require_once 'conexao.php';
require_once 'processa.php';

$action = $_GET['action'] ?? null;
$editUser = null;

if ($action === 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
}

$stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>CRUD PDO MySQL</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f7f8;
    color: #333;
    margin: 0;
    padding: 20px;
  }
  .container {
    max-width: 720px;
    margin: 0 auto;
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
  }
  h1 {
    text-align: center;
    color: #007bff;
  }
  form {
    margin-bottom: 25px;
  }
  input[type="text"], input[type="email"] {
    width: calc(50% - 12px);
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-right: 16px;
    font-size: 1rem;
  }
  input[type="email"] {
    margin-right: 0;
  }
  button {
    background-color: #007bff;
    color: white;
    padding: 9px 16px;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #0056b3;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }
  th, td {
    padding: 12px 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
  }
  th {
    background-color: #007bff;
    color: white;
  }
  a.button-link {
    text-decoration: none;
    color: white;
    background-color: #28a745;
    padding: 5px 11px;
    border-radius: 4px;
    font-size: 0.9rem;
  }
  a.button-link.delete {
    background-color: #dc3545;
  }
  a.button-link:hover {
    opacity: 0.85;
  }
</style>
</head>
<body>
<div class="container">
  <h1>CRUD com PDO & MySQL</h1>

  <form method="post" action="processa.php?action=<?php echo $editUser ? 'update' : 'create'; ?>">
    <?php if ($editUser): ?>
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($editUser['id']); ?>" />
    <?php endif; ?>
    <input type="text" name="name" placeholder="Nome" required value="<?php echo $editUser ? htmlspecialchars($editUser['name']) : ''; ?>" />
    <input type="email" name="email" placeholder="Email" required value="<?php echo $editUser ? htmlspecialchars($editUser['email']) : ''; ?>" />
    <button type="submit"><?php echo $editUser ? 'Atualizar' : 'Adicionar'; ?></button>
    <?php if ($editUser): ?>
      <a href="style.php" class="button-link" style="background-color: #6c757d; margin-left:10px;">Cancelar</a>
    <?php endif; ?>
  </form>

  <?php if (count($users) === 0): ?>
    <p>Nenhum registro encontrado.</p>
  <?php else: ?>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
      <tr>
        <td><?php echo htmlspecialchars($user['id']); ?></td>
        <td><?php echo htmlspecialchars($user['name']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td>
          <a href="style.php?action=edit&id=<?php echo $user['id']; ?>" class="button-link">Editar</a>
          <a href="processa.php?action=delete&id=<?php echo $user['id']; ?>" class="button-link delete" onclick="return confirm('Tem certeza que deseja excluir este registro?')">Excluir</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>
</div>
</body>
</html>
