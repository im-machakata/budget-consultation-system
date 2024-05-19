<?php
$this->setVar('title', 'Reset Password');
echo $this->include('_templates/head');
?>
<main class="d-flex flex-column justify-content-center align-items-center bg-success" style="min-height: 100vh">
    <div class="row justify-content-center shadow rounded-4 p-3 bg-white mx-2" style="max-width: 400px;">
        <div class="text-center col-12">
            <img src="/static/images/logo.jpg" alt="System Logo" class="img-flud rounded mt-3" height="100">
            <h1 class="fw-bold h2">reset password</h1>
            <p class="text-muted mb-3">Enter your account's email address.</p>
        </div>
        <?= $this->include('_templates/alerts') ?>
        <form action="/reset" method="post" class="d-block col-12">
            <div class="mb-3 form-floating">
                <input type="email" name="email" id="email" class="form-control" value placeholder="Email" autocomplete="off" required>
                <label for="email" class="form-label">Email</label>
            </div>
            <div class="mb-3">
                <button class="btn btn-lg btn-success mt-2 w-100" type="submit">Get instructions</button>
            </div>
            <div class="mb-3 text-lg-center">
                <a href="/login">Login</a> or <a href="/register">create account</a>.
            </div>
        </form>
    </div>
</main>
<?= $this->include('_templates/footer'); ?>