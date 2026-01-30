<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap" rel="stylesheet">

   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <?php
        echo $this->Html->script('color-modes.js');
        echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js');
    ?>

    <!-- Sticky footer layout (MINIMAL ADDITION) -->
    <style>
        html, body {
            height: 100%;
            background-color: #f8fafc;
            margin: 0;
        }

        body.app-layout {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main.main {
            flex: 1;
        }
    </style>
</head>

<body class="app-layout">

<nav class="top-nav">
    <div class="top-nav-title">
        <a href="<?= $this->Url->build('/') ?>">
            <?= $this->Html->image('cd.png', ['alt' => '', 'width' => '45', 'height' => '35']) ?>
            <span>celcomdigi</span>
        </a>
    </div>

   <style>
    .top-nav {
        background:
            radial-gradient(
                circle at left,
                rgba(147, 197, 253, 0.55),
                transparent 55%
            ),
            linear-gradient(
                90deg,
                #93c5fd 0%,   /* soft blue (left) */
                #60a5fa 40%,  /* medium blue */
                #2563eb 100%  /* dark blue (right) */
            );
        padding: 12px 24px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    .top-nav-title a {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #000;
        font-size: 1.2rem;
        font-weight: 600;
        text-decoration: none;
    }

    .top-nav-title a:hover {
        opacity: 0.9;
    }

   </style>

</nav>

<main class="main">
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</main>

<footer class="footer">
    <a href="<?= $this->Url->build('/') ?>" class="footer-brand">
        <i class="fa-brands fa-stack-overflow footer-icon"></i>
        <span class="footer-name">Code by <span>AminahKalong</span></span>
    </a>

    <style>
        .footer {
            padding: 20px;
            text-align: center;
        }

        .footer-brand {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #000000;
            font-size: 0.50rem;
            text-decoration: none;
        }

        .footer-icon {
            font-size: 1.3rem;
            color: #f97316;
            animation: footerFloat 3s ease-in-out infinite;
        }

        @keyframes footerFloat {
            0% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
            100% { transform: translateY(0); }
        }

        .footer-brand:hover .footer-icon {
            animation-play-state: paused;
            transform: scale(1.15);
        }

        .footer-name {
            font-weight: 500;
            letter-spacing: 0.03em;
        }
    </style>
</footer>

<!-- ========================= -->
<!-- TOAST CONTAINER -->
<!-- ========================= -->
<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
        <?= $this->Flash->render('flash', ['element' => 'bootstrap_toast']) ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toastElList = [].slice.call(document.querySelectorAll('.toast'));
    toastElList.forEach(function (toastEl) {
        const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
        toast.show();
    });
});
</script>

</body>
</html>



