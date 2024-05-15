<?php
$user = session()->get('user');
$isAdmin = $user->roles == UserRoles::ADMIN;
$isCitizen = $user->roles == UserRoles::CITIZEN;
$isExecutive = $user->roles == UserRoles::EXECUTIVE;

function pageIsActive($url)
{
    return is_int(strpos(current_url(), $url)) ? 'active' : '';
}
?>
<nav class="navbar navbar-expand-lg bg-success navbar-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold ps-lg-2 ms-0 d-flex align-items-center" href="/">
            <img src="/static/images/logo.jpg" alt="" class="rounded me-2 me-lg-3" style="height: 35px;">
            <?= env('app.name') ?? 'a1Bugcon'?>
        </a>
        <button class="navbar-toggler btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= pageIsActive('/dashboard') ?>" href="/dashboard">Dashboard</a>
                </li>
                <?php if ($isExecutive) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= pageIsActive('/requests') ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Requests
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/requests">View Requests</a></li>
                            <li><a class="dropdown-item" href="/requests/new">New Request</a></li>
                        </ul>
                    </li>
                <?php elseif ($isAdmin) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= pageIsActive('/comments') ?>" href="/comments">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= pageIsActive('/reports') ?>" href="/reports">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= pageIsActive('/users') ?>" href="/users">Users</a>
                    </li>
                <?php elseif ($isCitizen) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= pageIsActive('/requests') ?>" href="/requests">Requests</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link <?= pageIsActive('/logout') ?>" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>