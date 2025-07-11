<script src="<?= base_url('assets/js/vendors/aos.js') ?>"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
  integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
  data-cf-beacon='{"rayId":"955b15f3eeabb910","version":"2025.6.2","r":1}' crossorigin="anonymous"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>

<?php if (!empty($helper_scripts)): ?>
  <?php foreach ($helper_scripts as $js_helper): ?>
    <script src="<?= base_url($js_helper) ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($component_scripts)): ?>
  <?php foreach ($component_scripts as $js_component): ?>
    <script src="<?= base_url($js_component) ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>