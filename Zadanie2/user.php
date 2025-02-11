<?php

require 'db.php';
function createUser($data) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
    $stmt->execute([
        ':username' => $data['username'],
        ':password' => password_hash($data['password'], PASSWORD_BCRYPT), 
        ':email' => $data['email']
    ]);
    return ['id' => $pdo->lastInsertId(), 'username' => $data['username'], 'email' => $data['email']];
}


function getUser($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function updateUser($id, $data) {
    global $pdo;
    $fields = [];
    if (isset($data['username'])) {
        $fields[] = "username = :username";
    }
    if (isset($data['email'])) {
        $fields[] = "email = :email";
    }
    
    if (empty($fields)) {
        return null;
    }

    $sql = "UPDATE users SET " . implode(", ", $fields) . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    $params = [':id' => $id];
    if (isset($data['username'])) {
        $params[':username'] = $data['username'];
    }
    if (isset($data['email'])) {
        $params[':email'] = $data['email'];
    }

    $stmt->execute($params);
    return getUser($id);
}

function deleteUser($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}
?>
