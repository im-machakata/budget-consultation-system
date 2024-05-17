<?php
helper('number');
$user = session()->get('user');
$this->setVar('title', $report->item);
echo $this->include('_templates/head');
?>
<main class="bg-light min-vh-100">
    <?= $this->include('_templates/navigation'); ?>
    <div class="row container-fluid justify-content-start mx-auto my-5">
        <h1 class="fs-2"><?= $report->quantity ?> &times; <?= $report->item ?></h1>
        <div class="row mb-4">
            <div class="col-auto col-lg-3">
                <span class="fw-bold">Requested by:</span>
                <?= $report->owner()->getFullName() ?>
            </div>
            <div class="col-auto col-lg-3">
                <span class="fw-bold">Requested on:</span>
                <?= $report->created_at->toFormattedDateString() ?>
            </div>
            <div class="col-auto col-lg-3">
                <span class="fw-bold">Due Date:</span>
                <?= $report->due_date->toFormattedDateString() ?>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-auto col-lg-3">
                <span class="fw-bold">Item Price:</span>
                $<?= $report->item_price ?>
            </div>
            <div class="col-auto col-lg-3">
                <span class="fw-bold">Quantity:</span>
                <?= $report->quantity ?>
            </div>
            <div class="col-auto col-lg-3">
                <span class="fw-bold">Total Price:</span>
                <?= number_to_currency($report->item_price * $report->quantity, 'USD', 'en_US', '2') ?>
            </div>
        </div>
        <div class="col-12" id="comments">
            <div class="row">
                <div class="col-12">
                    <h2 class="fs-4">Comments</h2>
                </div>
                <div class="col-lg-9 d-flex flex-column g-2 container-fluid">
                    <?php if (!$report->comments()) : ?>
                        <div class="border rounded bg-white p-2 mb-3">
                            Be the first to comment on this topic.
                        </div>
                    <?php endif; ?>
                    <?php foreach ($report->comments()  as $comment) : ?>
                        <div class="border rounded bg-white p-2 mb-3" style="width: fit-content; max-width: 400px;">
                            <h3 class="fs-6 fw-bold text-uppercase"><i class="fa fa-user-circle me-2"></i><?= $comment->getAuthor() ?></h3>
                            <p class="mb-0"><?= $comment->comment ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-3">
                    <form action="/reports/<?= $report->id ?>" method="post" class="d-block row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea name="comment" id="comment" class="form-control" placeholder="Comment" autocomplete="off" required></textarea>
                                <label for="comment">Your comment goes here...</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3 mb-lg-4">
                                <button class="btn btn-success border-0 mt-2 w-100" type="submit">Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->include('_templates/footer'); ?>