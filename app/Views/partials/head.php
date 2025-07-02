<head>
    <meta charset="utf-8" />
    
    <!-- Title Section -->
    <title>
        <?= isset($data['title']) ? $data['title'] : 'LTWCE – Support Dashboard'; ?>
        <?= isset($data['subtitle']) ? " | " . $data['subtitle'] : ''; ?>
    </title>
    
    <link rel="icon" href="/assets/images/logo.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet" />
    
    <!-- AOS animations -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vendors/aos.css') ?>" />
    
    <!-- Tailwind utilities -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <!-- Custom overrides -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>" />
    
    <!-- Global Font Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Additional Stylesheets (optional) -->
    <?php if (!empty($data['styles'])): ?>
        <?php foreach ($data['styles'] as $style): ?>
            <link rel="stylesheet" href="<?= base_url($style) ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>
