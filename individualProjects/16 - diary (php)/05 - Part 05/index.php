<?php

require __DIR__ . '/inc/functions.inc.php';
require __DIR__ . '/inc/db-connect.inc.php';

$perPage = 3;
$page = (int) ($_GET['page'] ?? 1);
if ($page < 1) $page = 1;

// $page = 1, $offset => 0
// $page = 2, $offset => $perPage
// $page = 3, $offset => $perPage * 2
$offset = ($page - 1) * $perPage;

$stmtCount = $pdo->prepare('SELECT COUNT(*) AS `count` FROM `entries`');
$stmtCount->execute();
$count = $stmtCount->fetch(PDO::FETCH_ASSOC)['count'];

$numPages = ceil($count / $perPage);

$stmt = $pdo->prepare('SELECT * FROM `entries` ORDER BY `date` DESC, `id` DESC LIMIT :perPage OFFSET :offset');
$stmt->bindValue('perPage', (int) $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', (int) $offset, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php require __DIR__ . '/views/header.view.php'; ?>
<h1 class="main-heading">Entries</h1>
<?php foreach ($results AS $result): ?>
    <div class="card">
        <div class="card__image-container">
            <img class="card__image" src="images/pexels-canva-studio-3153199.jpg" alt="" />
        </div>
        <div class="card__desc-container">
            <div class="card__desc-time"><?php echo e($result['date']); ?></div>
            <h2 class="card__heading"><?php echo e($result['title']); ?></h2>
            <p class="card__paragraph">
                <?php echo nl2br(e($result['message'])); ?>
            </p>
        </div>
    </div>
<?php endforeach; ?>

<?php if ($numPages > 1): ?>
    <ul class="pagination">
        <?php if ($page > 1): ?>
            <li class="pagination__li">
                <a 
                    class="pagination__link" 
                    href="index.php?<?php echo http_build_query(['page' => $page - 1]); ?>">⏴</a>
            </li>
        <?php endif; ?>
        <?php for($x = 1; $x <= $numPages; $x++): ?>
            <li class="pagination__li">
                <a 
                    class="pagination__link <?php if ($page === $x): ?>pagination__link--active<?php endif; ?>" 
                    href="index.php?<?php echo http_build_query(['page' => $x]); ?>">
                    <?php echo e($x); ?>
                </a>
            </li>
        <?php endfor; ?>
        <?php if ($page < $numPages): ?>
            <li class="pagination__li">
                <a 
                    class="pagination__link" 
                    href="index.php?<?php echo http_build_query(['page' => $page + 1]); ?>">⏵</a>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<?php require __DIR__ . '/views/footer.view.php'; ?>