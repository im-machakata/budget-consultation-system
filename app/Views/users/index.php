<?php
$this->setVar('title', 'Users');
$myProfile = session()->get('user');
echo $this->include('_templates/head');
?>
<main class="bg-light min-vh-100">
    <?= $this->include('_templates/navigation'); ?>
    <div class="container-fluid">
        <h1 class="fs-2 fw-bold">Users</h1>
        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <div class="bg-white shadow-sm rounded p-2 pb-2">
            <div class="d-flex justify-content-between mb-2">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="/users/new" class="btn btn-primary">New User</a>
                </div>
            </div>
            <div class="table-responsive mb-2 mb-lg-0">
                <table class="table align-middle table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $user->id ?></td>
                                <td><?= $user->firstname ?></td>
                                <td><?= $user->lastname ?></td>
                                <td><?= $user->email ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <?php if ($myProfile->id == $user->id) : ?>
                                            <a href="/users/ban/<?= $user->id ?>" class="btn btn-sm btn-danger disabled" aria-disabled="true" disabled><i class="fa fa-ban"></i> Ban</a>
                                        <?php else : ?>
                                            <?php if ($user->banned_at) : ?>
                                                <a href="/users/unban/<?= $user->id ?>" class="btn btn-sm btn-outline-danger"><i class="fa fa-ban"></i> Unban</a>
                                            <?php else : ?>
                                                <a href="/users/ban/<?= $user->id ?>" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Ban</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <a href="/users/comments/<?= $user->id ?>" class="btn btn-sm btn-primary"><i class="fa fa-comments"></i> Comments</a>
                                        <a href="/users/reports/<?= $user->id ?>" class="btn btn-sm btn-success border-0"><i class="fa fa-newspaper"></i> Reports</a>
                                        <a href="/users/edit/<?= $user->id ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i> Edit</a>
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
</main>
<?= $this->include('_templates/footer'); ?>