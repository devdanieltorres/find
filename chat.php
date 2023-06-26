<?php
// Verifica se a mensagem foi enviada
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $message = $_POST["message"];
    $groupname = $_POST["groupname"];

    if (!empty($message) && !empty($groupname) && $groupname !== "nenhum grupo") {
        $chatFile = "conversas/" . $groupname . ".txt";
        file_put_contents($chatFile, $username . ": " . $message . PHP_EOL, FILE_APPEND);
    }
    exit;
}

// Retorna as mensagens existentes
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $groupname = $_GET["groupname"];
    if (!empty($groupname) && $groupname !== "nenhum grupo") {
        $chatFile = "conversas/" . $groupname . ".txt";

        $messages = [];
        if (file_exists($chatFile)) {
            $messages = file($chatFile, FILE_IGNORE_NEW_LINES);
        }
        echo json_encode(["messages" => $messages]);
    }
    exit;
}
?>