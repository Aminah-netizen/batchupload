<h2 class="page-title">CNSB BATCH UPLOAD MANAGEMENT SYSTEM</h2>

<div class="container text-center batch-container">
    <div class="row justify-content-center">

        <!-- Deposit -->
        <div class="col-md-3">
            <div class="flip-box has-sub-links">
                <div class="flip-link main-link">
                    Deposit
                </div>

                <div class="sub-actions">
                    <?= $this->Html->link(
                        'Deposit (Single Items)',
                        ['controller' => 'Deposits', 'action' => 'add', '?' => ['mode' => 'single']],
                        ['class' => 'flip-link sub-link']
                    ) ?>

                    <?= $this->Html->link(
                        'Deposit (Multiple Items)',
                        ['controller' => 'DepositItems', 'action' => 'add', '?' => ['mode' => 'multiple']],
                        ['class' => 'flip-link sub-link']
                    ) ?>
                </div>
            </div>
        </div>

        <!-- Rental -->
        <div class="col-md-3">
            <div class="flip-box has-sub-links">
                <div class="flip-link main-link">
                    Rental
                </div>

                <div class="sub-actions">
                    <?= $this->Html->link(
                        'Rental (Single Item)',
                        ['controller' => 'Rentals', 'action' => 'add', '?' => ['mode' => 'single']],
                        ['class' => 'flip-link sub-link']
                    ) ?>

                    <?= $this->Html->link(
                        'Rental (Multiple Items)',
                        ['controller' => 'RentalItems', 'action' => 'add', '?' => ['mode' => 'multiple']],
                        ['class' => 'flip-link sub-link']
                    ) ?>
                </div>
            </div>
        </div>

        <!-- Deposit + Rental -->
        <div class="col-md-3">
            <div class="flip-box">
                <?= $this->Html->link(
                    'Deposit + Rental',
                    ['controller' => 'Forms', 'action' => 'addDepositRental'],
                    ['class' => 'flip-link']
                ) ?>
            </div>
        </div>

    </div>
</div>

<style>
/* =========================
   Page Title
   ========================= */
.page-title {
    text-align: center;
    margin-top: 48px;
    margin-bottom: 56px;

    font-weight: 600;
    font-size: 1.75rem;
    letter-spacing: 0.02em;
    color: #000;
}

/* =========================
   Container
   ========================= */
.batch-container {
    margin-top: 16px;
}

/* =========================
   Card Wrapper
   ========================= */
.flip-box {
    perspective: 1400px;
}

/* =========================
   Glass Card (Light Theme)
   ========================= */
.flip-link {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;

    height: 150px;
    width: 100%;

    background: linear-gradient(
        135deg,
        rgba(37, 99, 235, 0.12),
        rgba(37, 99, 235, 0.04)
    );
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);

    border-radius: 20px;
    border: 1px solid rgba(37, 99, 235, 0.18);

    color: #1b366e;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;

    box-shadow:
        0 8px 20px rgba(37, 99, 235, 0.18),
        inset 0 0 0 1px rgba(255, 255, 255, 0.6);

    transition:
        transform 0.45s cubic-bezier(.22,1,.36,1),
        box-shadow 0.45s ease,
        border-color 0.45s ease,
        opacity 0.3s ease;
}

/* =========================
   Hover Interaction
   ========================= */
.flip-box:hover .flip-link {
    transform: translateY(-10px) scale(1.02);
    box-shadow:
        0 35px 65px rgba(0, 0, 0, 0.45),
        0 0 40px rgba(96, 165, 250, 0.25);
    border-color: rgba(167, 139, 250, 0.45);
}

/* =========================
   Neon Glow Overlay
   ========================= */
.flip-link::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 20px;

    background:
        radial-gradient(
            circle at top left,
            rgba(96, 165, 250, 0.25),
            transparent 55%
        ),
        radial-gradient(
            circle at bottom right,
            rgba(251, 113, 133, 0.25),
            transparent 55%
        );

    opacity: 0;
    transition: opacity 0.45s ease;
    pointer-events: none;
}

.flip-box:hover .flip-link::after {
    opacity: 1;
}

/* =========================
   Sub-Link System
   ========================= */
.has-sub-links {
    position: relative;
}

.has-sub-links:hover .main-link {
    opacity: 0;
}

/* =========================
   Sub Actions
   ========================= */
.sub-actions {
    position: absolute;
    inset: 0;

    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 12px;

    opacity: 0;
    pointer-events: none;
    transition: opacity 0.35s ease;
}

.has-sub-links:hover .sub-actions {
    opacity: 1;
    pointer-events: auto;
}

/* =========================
   Sub Links
   ========================= */
.sub-link {
    height: auto;
    padding: 12px 14px;

    font-size: 0.95rem;
    font-weight: 500;

    background: rgba(255, 255, 255, 0.06);
    border-radius: 12px;

    transition:
        background 0.25s ease,
        transform 0.25s ease;
}

.sub-link:hover {
    background: rgba(255, 255, 255, 0.12);
    transform: translateY(-2px);
}

/* =========================
   Focus Accessibility
   ========================= */
.flip-link:focus-visible {
    outline: none;
    box-shadow:
        0 0 0 2px rgba(167, 139, 250, 0.7),
        0 0 30px rgba(96, 165, 250, 0.4);
}

/* =========================
   Reduced Motion
   ========================= */
@media (prefers-reduced-motion: reduce) {
    .flip-link {
        transition: none;
    }

    .flip-box:hover .flip-link {
        transform: none;
    }
}
</style>

<style>
    body {
        overflow: hidden;
        margin: 0;
        height: 100vh;
    }
    #cat {
        position: absolute;
        top: 60%;
        transform: translateY(-50%);
        width: 150px;
        transition: transform 0.1s linear;
    }
</style>
</head>
<body>


</body>


