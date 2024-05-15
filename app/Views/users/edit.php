<?php
$this->setVar('title', 'Update Profile');
echo $this->include('_templates/head');
?>
<main class="bg-light min-vh-100">
    <?= $this->include('_templates/navigation'); ?>
    <div class="row container-fluid justify-content-start my-5 mx-auto">
        <h1 class="fs-2">Update <?= $user->firstname ?>'s profile</h1>
        <p>Change user's details and system access levels.</p>
        <form action="/users/edit/<?= $user->id ?>" method="post" class="col-12 col-lg-6 row">
            <?= $this->include('_templates/alerts') ?>
            <div class="col-md-6">
                <div class="mb-3 form-floating">
                    <input type="text" name="username" id="username" class="form-control" value="<?= $user->username ?>" placeholder="Username" autocomplete="off" required>
                    <label for="username" class="form-label">Username</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 form-floating">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
                    <label for="password" class="form-label">Password</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 form-floating">
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="John" autocomplete="off" value="<?= $user->firstname ?>" required>
                    <label for="name" class="form-label">First Name</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 form-floating">
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Doe" autocomplete="off" value="<?= $user->lastname ?>" required>
                    <label for="lastname" class="form-label">Last Name</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 form-floating">
                    <input type="email" name="email" id="email" class="form-control" placeholder="johndoe@gmail.com" autocomplete="off" value="<?= $user->email ?>" required>
                    <label for="email" class="form-label">Email</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 form-floating">
                    <select name="roles" id="roles" class="form-control">
                        <option value="<?= UserRoles::ADMIN ?>" <?= $user->roles == UserRoles::ADMIN ? 'selected' : '' ?>><?= ucwords(UserRoles::ADMIN) ?></option>
                        <option value="<?= UserRoles::EXECUTIVE ?>" <?= $user->roles == UserRoles::EXECUTIVE ? 'selected' : '' ?>><?= ucwords(UserRoles::EXECUTIVE) ?></option>
                        <option value="<?= UserRoles::CITIZEN ?>" <?= $user->roles == UserRoles::CITIZEN ? 'selected' : '' ?>><?= ucwords(UserRoles::CITIZEN) ?></option>
                    </select>
                    <label for="roles" class="form-label">Role</label>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3 mb-lg-4">
                    <button class="btn btn-lg btn-success mt-2" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</main>
<?= $this->include('_templates/footer'); ?>