<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veify OTP</title>
</head>
<body>
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
    <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <?php if (session()->get('otp')): ?>
    <h3>OTP Anda (Simulasi)</h3>
    <p style="font-size: 2rem;"><?= esc(session()->get('otp')) ?></p>
    <?php endif; ?>

    <a href="<?php base_url('forpas') ?>">Kembali</a>
</body>
</html>