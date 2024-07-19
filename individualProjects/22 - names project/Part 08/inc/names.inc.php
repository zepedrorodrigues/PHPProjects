<?php
declare(strict_types=1);

function fetch_names_by_initial(string $char): array {
    global $pdo;

    $stmt = $pdo->prepare('SELECT DISTINCT `name` FROM `names` WHERE `name` LIKE :expr ORDER BY `name` ASC');
    $stmt->bindValue(':expr', "{$char}%");
    $stmt->execute();
    $names = [];
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results AS $result) {
        $names[] = $result['name'];
    }
    return $names;
}

function fetch_name_entries(string $name): array {
    global $pdo;

    $stmt = $pdo->prepare('SELECT * FROM `names` WHERE `name` = :name ORDER BY `year` ASC');
    $stmt->bindValue(':name', $name);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function gen_names_overview(): array {
    global $pdo;

    $stmt = $pdo->prepare('SELECT `name`, SUM(`count`) AS `sum` 
                           FROM `names` GROUP BY `name` ORDER BY `sum` DESC LIMIT 10');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}