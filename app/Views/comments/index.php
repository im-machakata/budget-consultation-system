<?php
$user = session()->get('user');
$this->setVar('title', 'Comments');
$myProfile = session()->get('user');
echo $this->include('_templates/head');
?>
<main class="bg-light min-vh-100">
    <?= $this->include('_templates/navigation'); ?>
    <div class="container-fluid justify-content-center px-3 px-lg-4">
        <h1 class="fs-2 fw-bold">Recent Comments</h1>
        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <div class="bg-white shadow-sm rounded p-3 pb-2">
            <div class="row row-cols-1 g-2 mb-2">
                <?php foreach ($comments as $comment) : ?>
                    <div class="col">
                        <div class="border-start border-3" style="min-width: 200px; max-width: 400px;">
                            <h3 class="fs-6 fw-bold text-uppercase pt-2 ps-2">
                                <i class="fa fa-user-circle me-2"></i><?= $comment->getAuthor() ?>
                                <?= $user->id == $comment->user_id ? '(You)' : '' ?>
                                <small class="text-muted text-lowercase"><?= $comment->created_at->humanize() ?></small>
                            </h3>
                            <div class="p-2 pt-0 mb-3">
                                <p class="mb-0"><?= $comment->comment ?></p>
                                <p class="mb-0">
                                    <a href="/reports/<?= $comment->getReport()->id ?>">View Report</a>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <?= $pager->links() ?>
            </div>
        </div>
</main>
<?= $this->include('_templates/footer'); ?>