<?php

require_once __DIR__ . '/../config/conection.php';

// Criação (Create)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $safra = $_POST['safra'];
    $pais_origem = $_POST['pais_origem'];
    $preco = $_POST['preco'];
    $sql = "INSERT INTO vinhos (nome, tipo, safra, pais_origem, preco) VALUES ('$nome', '$tipo', '$safra', '$pais_origem', '$preco')";
    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<div class='error'>Erro ao criar vinho: " . $conn->error . "</div>";
    }
}

// Atualização (Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $safra = $_POST['safra'];
    $pais_origem = $_POST['pais_origem'];
    $preco = $_POST['preco'];
    $sql = "UPDATE vinhos SET nome='$nome', tipo='$tipo', safra='$safra', pais_origem='$pais_origem', preco='$preco' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<div class='error'>Erro ao atualizar vinho: " . $conn->error . "</div>";
    }
}

// Exclusão (Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM vinhos WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<div class='error'>Erro ao excluir vinho: " . $conn->error . "</div>";
    }
}

// Leitura (Read)
$sql = "SELECT * FROM vinhos";
$result = $conn->query($sql);

// HTML para o CRUD
echo '<!DOCTYPE html>';
echo '<html lang="pt-BR">';

echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>CRUD DE VINHOS | VINI</title>';
echo '<link rel="icon" href="../images/catvineicon.png" type="image/png">'; // Corrigido: ponto e vírgula no final
echo '<script src="https://cdn.tailwindcss.com"></script>'; // Corrigido: ponto e vírgula no final
echo '</head>';

echo '<body class="bg-gray-900 text-gray-200 p-4">'; // Tema escuro com Tailwind
echo '<div class="max-w-4xl mx-auto">';

echo '<h2 class="text-2xl font-bold mb-4">CRUD DE VINHOS DO VINI</h2>';

// Formulário de criação
echo '<form method="POST" class="mb-8">';
echo '<div class="mb-4"><label class="font-bold" >Nome:</label> <input type="text" name="nome" required class="border p-2 rounded w-full text-black"></div>';
echo '<div class="mb-4"><label class="font-bold" >Tipo:</label> <input type="text" name="tipo" required class="border p-2 rounded w-full text-black"></div>';
echo '<div class="mb-4"><label class="font-bold" >Safra:</label> <input type="number" name="safra" required class="border p-2 rounded w-full text-black"></div>';
echo '<div class="mb-4"><label class="font-bold" >País de Origem:</label> <input type="text" name="pais_origem" class="border p-2 rounded w-full text-black"></div>';
echo '<div class="mb-4"><label class="font-bold">Preço R$:</label> <input type="number" step="0.01" name="preco" required class="border p-2 rounded w-full text-black"></div>';
echo '<button type="submit" name="create" class="bg-rose-400 text-white px-4 py-2 rounded hover:bg-rose-500 w-full mt-5">CRIAR</button>';
echo '</form>';

// Lista de vinhos
echo '<h3 class="text-xl font-bold mb-4">LISTA DE VINHOS:</h3>';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<form method='POST' class='mb-4'>";
        echo "<div class='mb-2'><label>ID:</label> <input type='text' name='id' value='{$row['id']}' readonly class='border p-2 rounded w-full text-black bg-gray-800 text-gray-400'></div>";
        echo "<div class='mb-2'><label>Nome:</label> <input type='text' name='nome' value='{$row['nome']}' class='border p-2 rounded w-full text-black'></div>";
        echo "<div class='mb-2'><label>Tipo:</label> <input type='text' name='tipo' value='{$row['tipo']}' class='border p-2 rounded w-full text-black'></div>";
        echo "<div class='mb-2'><label>Safra:</label> <input type='number' name='safra' value='{$row['safra']}' class='border p-2 rounded w-full text-black'></div>";
        echo "<div class='mb-2'><label>País de Origem:</label> <input type='text' name='pais_origem' value='{$row['pais_origem']}' class='border p-2 rounded w-full text-black'></div>";
        echo "<div class='mb-2'><label>Preço R$:</label> <input type='number' step='0.01' name='preco' value='{$row['preco']}' class='border p-2 rounded w-full text-black'></div>";
        echo "<button type='submit' name='update' class='bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600'>Atualizar</button>";
        echo "<button type='submit' name='delete' class='bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ml-2'>Excluir</button>";
        echo "</form>";
    }
} else {
    echo '<p>Nenhum vinho encontrado...</p>';
}

echo '</div>';
echo '</body>';
echo '</html>';

$conn->close();
