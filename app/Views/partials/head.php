<head>
    <meta charset="utf-8" />

    <title>
        <?= esc($data['title'] ?? 'LTWCE') ?>
        <?= !empty($data['subtitle']) ? ' | ' . esc($data['subtitle']) : '' ?>
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="<?= esc($data['description'] ?? 'LTWCE SACCO – Empowering Communities Through Financial Inclusion') ?>" />
    <meta name="keywords"
        content="<?= esc($data['keywords'] ?? 'LTWCE, SACCO, financial inclusion, community empowerment, savings, loans, microfinance, cooperative') ?>" />
    <link rel="icon" href="<?= base_url('assets/images/logo.png') ?>" type="image/x-icon" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet" />

    <!-- Fonts & Vendors -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vendors/aos.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/tailwind_output.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" />

    <!-- Per-page styles -->
    <?php if (!empty($styles)): ?>
        <?php foreach ($styles as $css): ?>
            <link rel="stylesheet" href="<?= base_url($css) ?>" />
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>