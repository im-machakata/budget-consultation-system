<?php
$user = session()->get('user');
$this->setVar('title', 'Reports');
echo $this->include('_templates/head');
?>
<main class="bg-light min-vh-100">
    <?= $this->include('_templates/navigation'); ?>
    <div class="row container-fluid justify-content-start mx-auto my-5">
        <h1 class="fs-2">Reports</h1>
        <?php if ($user->roles == UserRoles::EXECUTIVE) : ?>
            <p>View existing or create new reports. </p>
        <?php elseif ($user->roles == UserRoles::ADMIN) : ?>
            <p>View, approve or rejected exisitng reports.</p>
        <?php else : ?>
            <p>What are your thoughts on this budget report.</p>
        <?php endif; ?>
        <div class="col-12">
            <div class="container-fluid bg-white p-2 shadow-sm rounded">
                <?php if ($user->roles == UserRoles::EXECUTIVE) : ?>
                    <form action="/reports" method="post" class="col-12 row align-items-center mx-auto">
                        <?= $this->include('_templates/alerts') ?>
                        <div class="col-lg-7">
                            <div class="mb-3">
                                <input type="text" name="item" id="item" class="form-control" placeholder="Item" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <input type="number" name="quantity" id="quantity" class="form-control" min="1" placeholder="Quantity" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <input type="date" name="due_date" id="quantity" class="form-control" min="<?= date('Y-m-d', strtotime('+24 hours')) ?>" placeholder="Due Date" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="mb-3 mb-lg-4">
                                <button class="btn btn-success border-0 mt-2 w-100" type="submit"><i class="fa fa-plus-circle"></i></button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
                <div class="table-responsive mb-2 mb-lg-0 px-lg-2">
                    <table class="table align-middle table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Added On</th>
                                <th scope="col">Due On</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports as $report) : ?>
                                <tr>
                                    <td><?= $report->id ?></td>
                                    <td><?= $report->item ?></td>
                                    <td><?= $report->quantity ?></td>
                                    <td><?= $report->created_at->toDateString() ?></td>
                                    <td><?= $report->due_date ?></td>
                                    <td>
                                        <?php if ($report->created_at == $report->updated_at) {
                                            echo '<span class="badge bg-primary">Pending</span>';
                                        } elseif ($report->approved == 1) {
                                            echo '<span class="badge bg-success">Approved</span>';
                                        } else {
                                            echo '<span class="badge bg-danger">Rejected</span>';
                                        } ?>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <?php if ($user->roles == UserRoles::ADMIN) : ?>
                                                <?php if ($report->approved == 1 || $report->created_at == $report->updated_at) : ?>
                                                    <a href="/reports/reject/<?= $report->id ?>" class="btn btn-sm btn-warning"><i class="fa fa-cancel"></i> Reject</a>
                                                <?php endif;
                                                if ($report->approved == 0 || $report->created_at == $report->updated_at) : ?>
                                                    <a href="/reports/approve/<?= $report->id ?>" class="btn btn-sm btn-success border-0"><i class="fa fa-check"></i> Approve</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <a href="/reports/<?= $report->id ?>#comments" class="btn btn-sm btn-primary"><i class="fa fa-comments"></i> Comments</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?= $pager->links() ?>
            </div>
        </div>
    </div>
</main>
<?= $this->include('_templates/footer'); ?>