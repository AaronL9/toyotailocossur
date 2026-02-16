<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Toyota Ilocos Sur</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
</head>

<body class="flex flex-col min-h-screen">

    <?= $this->renderSection("mainContent") ?>

    <?php if (getenv("CI_ENVIRONMENT") === 'development'): ?>
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/src/main.ts"></script>

        <!-- Vite HMR + JS -->
    <?php else: ?>
        <script type="module" src="<?= vite_asset('src/main.ts'); ?>"></script>
    <?php endif; ?>
</body>

</html>