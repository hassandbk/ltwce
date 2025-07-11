<!DOCTYPE html>
<html lang="en">
<?= view('partials/head', ['data' => $data, 'styles' => $styles ?? []]); ?>

<body class="tracking-tight text-slate-800 antialiased font-inter bg-white" x-data="authModalApp()" x-init="
    init();
    <?php if (session()->getFlashdata('show_login')): ?>
        open('login');
    <?php endif; ?>
" x-cloak>
  <div class="overflow-hidden min-h-screen flex-col flex">
    <?= view('partials/header', ['data' => $data]); ?>

    <div class="flex-1 overflow-hidden">
      <?= $content ?? ''; ?>
    </div>

    <?= view('partials/modals/modals_auth'); ?>
    <?= view('partials/footer'); ?>
  </div>

  <?= view('partials/footer_scripts', [
    'helper_scripts' => $helper_scripts ?? [], // Pass helper scripts
    'component_scripts' => $component_scripts ?? [] // Pass component scripts
  ]); ?>
</body>

</html>