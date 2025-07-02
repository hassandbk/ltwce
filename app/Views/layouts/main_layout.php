<!DOCTYPE html>
<html lang="en">
<!-- Head Section -->
<?= view('partials/head', ['data' => $data]); ?>

<body class="tracking-tight text-slate-800 antialiased font-inter bg-white" x-data="supportApp()" x-init="init()"
    x-cloak>
    <!-- Page wrapper -->
    <div class="overflow-hidden min-h-screen flex-col flex">
        <!-- Header Section -->
        <?= view('partials/header', ['data' => $data]); ?>

        <!-- Main Content (Dynamic Content) -->
        <div class="overflow-hidden min-h-screen flex-col flex-1">

            <!-- Dynamically injected content (home.php or other views) -->
            <?= isset($data['content']) ? $data['content'] : ''; ?>

        </div>
        <!-- Footer Section -->
        <?= view('partials/modals/modals_auth', ['data' => $data]); ?>

        <!-- Footer Section -->
        <?= view('partials/footer', ['data' => $data]); ?>
    </div>
    <!-- Footer Scripts -->
    <?= view('partials/footer_scripts', ['data' => $data]); ?>

    <!-- Additional JS files (Optional) -->
    <?php if (!empty($data['scripts'])): ?>
        <?php foreach ($data['scripts'] as $script): ?>
            <script src="<?= base_url($script) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>