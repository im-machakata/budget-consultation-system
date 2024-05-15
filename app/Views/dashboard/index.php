<?php
$this->setVar('title', 'Dashboard');
echo $this->include('_templates/head');
?>
<main class="bg-light min-vh-100">
    <?= $this->include('_templates/navigation'); ?>
    <div class="container-fluid">
        <h1 class="fs-2 fw-bold">Dashboard</h1>
        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <div class="row g-3">
            <?php foreach ($stats as $row) : ?>
                <div class="col-lg-3">
                    <div class="bg-white rounded shadow-sm p-4 mb-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h2 class="fs-2 mb-0 font-monospace"><?= $row['value'] ?></h2>
                                <p class="mb-0"><?= $row['comment'] ?></p>
                            </div>
                            <div class="col-4">
                                <div class="ratio ratio-1x1 d-flex align-items-center justify-content-center" style="max-height: 100px; max-width: 100px;">
                                    <span class="rounded-circle bg-success w-full h-full text-center text-white d-flex align-items-center justify-content-center">
                                        <i class="<?= $row['icon'] ?> fa-2x"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?= $this->include('_templates/footer'); ?>