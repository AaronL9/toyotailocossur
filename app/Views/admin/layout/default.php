<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Toyota Ilocos Sur</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">
  <base href="<?= base_url() ?>">

  <?= csrf_meta("csrf-token"); ?>
  <?php if (getenv("CI_ENVIRONMENT") !== 'development'): ?>
    <?= vite_css("admin.ts") ?>
    <!-- Vite HMR + JS -->
  <?php endif; ?>
</head>

<body class="flex flex-col min-h-screen" data-page="<?= $page ?? "" ?>">

  <?= $this->renderSection("login_content") ?>
  <?= $this->renderSection("sidebar") ?>
  <?= $this->renderSection("adminContent") ?>

  <?php if (getenv("CI_ENVIRONMENT") === 'development'): ?>
    <script type="module" src="http://localhost:5173/dist/@vite/client"></script>
    <script type="module" src="http://localhost:5173/dist/admin.ts"></script>

    <!-- Vite HMR + JS -->
  <?php else: ?>
    <script type="module" src="/dist/<?= vite_asset('admin.ts'); ?>"></script>
  <?php endif; ?>
</body>

</html>