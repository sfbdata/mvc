<?php

$dbPath = __DIR__.'/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");


$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false){
    header('Location: /?sucesso=0');
    return;
}

$title = filter_input(INPUT_POST, 'title');
if ($title === false) {
    header('Location: /?sucesso=0');
    return;
}

$sql = 'INSERT INTO videos (url, title) VALUES (?,?)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $url);
$stmt->bindValue(2, $title);

if ($stmt->execute() === false) {
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}



