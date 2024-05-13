<?php
$this->setVar('title', 'Login');
echo $this->include('_templates/head');
?>
<main class="d-flex flex-column justify-content-center align-items-center bg-success" style="min-height: 100vh">
    <div class="row justify-content-center shadow rounded-4 p-3 bg-white mx-2" style="max-width: 400px;">
        <div class="text-center col-12">
            <img src="/static/images/logo.jpg" alt="System Logo" class="img-flud rounded mt-3" height="100">
            <h1 class="fw-bold h2 mb-3">welcome back</h1>
        </div>
        <?= $this->include('_templates/alerts') ?>
        <form action="/login" method="post" class="d-block col-12">
            <div class="mb-3 form-floating">
                <input type="text" name="username" id="username" class="form-control" value placeholder="Username" autocomplete="off" required>
                <label for="username" class="form-label">Username</label>
            </div>
            <div class="mb-3 form-floating">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" required>
                <label for="password" class="form-label">Password</label>
            </div>
            <div class="mb-3">
                <button class="btn btn-lg btn-success mt-2 w-100" type="submit">Login</button>
            </div>
            <div class="mb-3 text-lg-center">
                <a href="/reset">Reset password</a> or <a href="/register">create account</a>.
            </div>
        </form>
    </div>
</main>
<?= $this->include('_templates/footer'); ?>