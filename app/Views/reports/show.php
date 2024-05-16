<?php
$user = session()->get('user');
$this->setVar('title', $report->item);
echo $this->include('_templates/head');
?>
<main class="bg-light min-vh-100">
    <?= $this->include('_templates/navigation'); ?>
    <div class="row container-fluid justify-content-start mx-auto my-5">
        <h1 class="fs-2"><?= $report->quantity ?>, <?= $report->item ?></h1>
        <div class="row mb-4">
            <div class="col-auto">
                <span class="fw-bold">Requested by:</span>
                <?= $report->owner()->getFullName() ?>
            </div>
            <div class="col-auto">
                <span class="fw-bold">Requested on:</span>
                <?= $report->created_at->toDateString() ?>
            </div>
            <div class="col-auto">
                <span class="fw-bold">Due Date:</span>
                <?= $report->due_date ?>
            </div>
        </div>
        <div class="col-12" id="comments">
            <div class="row">
                <div class="col-12">
                    <h2 class="fs-4">Comments</h2>
                </div>
                <div class="col-lg-9 d-flex flex-column g-2">
                    <?php if (!$report->comments()) : ?>
                        <div class="bg-white p-2 rounded shadow-sm mb-3">
                            Be the first to comment on this topic.
                        </div>
                    <?php endif; ?>
                    <?php foreach ($report->comments()  as $comment) : ?>
                        <div class="bg-white p-2 rounded shadow-sm mb-3">
                            <?= $comment->comment ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-3">
                    <form action="/reports/comment/<?= $report->id ?>" class="d-block row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea name="comment" id="comment" class="form-control" placeholder="Comment" autocomplete="off" required></textarea>
                                <label for="comment">Your comment goes here...</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3 mb-lg-4">
                                <button class="btn btn-success border-0 mt-2 w-100" type="submit"><i class="fa fa-plus-circle"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->include('_templates/footer'); ?>