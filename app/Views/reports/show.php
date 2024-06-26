<?php
helper('number');
$user = session()->get('user');
$this->setVar('title', $report->item);
echo $this->include('_templates/head');
?>
<main class="bg-light min-vh-100">
    <?= $this->include('_templates/navigation'); ?>
    <div class="row container-fluid justify-content-start mx-auto my-5">
        <div class="col-12 row mx-auto mb-4 container-fluid p-2">
            <h1 class="fs-2"><?= $report->quantity ?> &times; <?= $report->item ?></h1>
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
        <div class="col-12 container-fluid bg-white rounded shadow-sm p-3" id="comments">
            <div class="row">
                <div class="col-12">
                    <h2 class="fs-3">Comments</h2>
                </div>
                <?= $this->include('_templates/alerts') ?>
                <div class="col-lg-7 d-flex flex-column g-2 container-fluid px-3">
                    <?php if (!$report->comments()) : ?>
                        <div class="border rounded bg-white p-2 mb-3">
                            Be the first to comment on this topic.
                        </div>
                    <?php endif; ?>
                    <?php foreach ($report->comments()  as $comment) : ?>
                        <div class="chat col-12">
                            <div class="border-start border-3" style="min-width: 200px; max-width: 400px;">
                                <h3 class="fs-6 fw-bold text-uppercase pt-2 ps-2">
                                    <i class="fa fa-user-circle me-2"></i><?= $comment->getAuthor() ?>
                                    <?= $user->id == $comment->user_id ? '(You)' : '' ?>
                                    <small class="text-muted text-lowercase"><?= $comment->created_at->humanize() ?></small>
                                </h3>
                                <div class="p-2 pt-0 mb-3">
                                    <p class="mb-0"><?= $comment->comment ?></p>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-5">
                    <form action="/reports/<?= $report->id ?>" method="post" class="d-block row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea name="comment" id="comment" class="form-control" placeholder="Comment" autocomplete="off" style="height: 200px;" required></textarea>
                                <label for="comment">Your comment goes here...</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3 mb-lg-4">
                                <button class="btn btn-success btn-lg border-0 mt-2 w-100" type="submit">Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->include('_templates/footer'); ?>