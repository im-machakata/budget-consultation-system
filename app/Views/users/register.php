<?php
$this->setVar('title', 'Register');
echo $this->include('_templates/head');
?>
<main class="d-flex flex-column justify-content-center align-items-center bg-success" style="min-height: 100vh">
    <div class="row justify-content-center shadow rounded-4 p-3 bg-white mx-4 my-5" style="max-width: 800px;">
        <div class="text-center col-12">
            <img src="/static/images/logo.jpg" alt="System Logo" class="img-flud rounded mt-3" height="100">
            <h1 class="fw-bold h2 mb-4">create account</h1>
        </div>
        <?= $this->include('_templates/alerts') ?>
        <form action="/register" method="post" class="col-12 row">
            <div class="col-lg-4 col-md-6">
                <div class="mb-3 form-floating">
                    <input type="text" name="username" id="username" class="form-control" value placeholder="Username" autocomplete="off" required>
                    <label for="username" class="form-label">Username</label>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="mb-3 form-floating">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" required>
                    <label for="password" class="form-label">Password</label>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="mb-3 form-floating">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Password" autocomplete="off" required>
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="mb-3 form-floating">
                    <input type="text" name="firstname" id="firstname" class="form-control" value placeholder="John" autocomplete="off" required>
                    <label for="name" class="form-label">First Name</label>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="mb-3 form-floating">
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Doe" autocomplete="off" required>
                    <label for="lastname" class="form-label">Last Name</label>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="mb-3 form-floating">
                    <input type="email" name="email" id="email" class="form-control" placeholder="johndoe@gmail.com" autocomplete="off" required>
                    <label for="email" class="form-label">Email</label>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3 mb-lg-4">
                    <button class="btn btn-lg btn-success mt-2 w-100" type="submit">Register</button>
                </div>
                <div class="mb-3 text-md-center">
                    <a href="/reset">Reset password</a> or <a href="/login">login</a>.
                </div>
            </div>
        </form>
    </div>
</main>
<?= $this->include('_templates/footer'); ?>