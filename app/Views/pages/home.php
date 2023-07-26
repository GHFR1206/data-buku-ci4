<?= $this->extend('layout/template'); ?>

<!-- Breadcrumb -->
<?= $this->section('breadcrumb') ?>
    <li class="breadcrumb-item"><a href="/">Dasbor</a></li>
<?= $this->endsection() ?>

<!-- NavBar Active -->
<?= $this->section('navactivehome'); ?>
    active
<?= $this->endsection(); ?>


<!-- Content Title -->
<?= $this->section('content-title'); ?>
    <h2><b>Dasbor</b></h2>
<?= $this->endsection(); ?>


<!-- Main Content -->
<?= $this->section('content-main'); ?>
    <h4>Selamat Datang Admin, <b> <?= $user['username'] ?> </b>!</h4>
<?= $this->endsection(); ?>