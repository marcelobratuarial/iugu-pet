<?= $this->extend('layouts/main/main') ?>

<?= $this->section('header') ?>

<?= $this->include('layouts/main/parts/header') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php /*<?= $this->include('parts/home/slider') ?>
    <?= $this->include('parts/home/about') ?>
    <?= $this->include('parts/home/our-services') ?>
    <?php // $this->include('parts/home/numbers') ?>
    <?= $this->include('parts/home/team') ?>
    <?= $this->include('parts/home/testimonials') ?>
    <?= $this->include('parts/home/our-content') ?> */
// print_r($plan); exit;
?>


<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcam_text text-center">
                    <h3>Minha conta</h3>
                    <h4 class="text-white">Gerenciar meus pets</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row checkoutPage">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
            <section style="margin: 40px auto">
                <h3>Meus pets</h3>
                <hr style="width: 100%">
                <?php if (isset($pets) && !empty($pets)) : ?>
                    <div class="row">
                        <?php foreach ($pets as $pet) : ?>
                            <div class="col-md-6">
                                <div class="card border-success mb-3" style="position:relative">
                                    <?php if(isset($pet["assinatura"]) && $pet["assinatura"]['isValid']) : ?>
                                        <span style="position: absolute; top: 5px; right: 10px" class="badge badge-pill badge-success">ATIVO</span>
                                    <?php elseif(isset($pet["assinatura"]) && !$pet["assinatura"]['isValid']) : ?>
                                        <span style="position: absolute; top: 5px; right: 10px" class="badge badge-pill badge-warning">EXPIRADO</span>
                                    <?php else : ?>
                                        <span style="position: absolute; top: 5px; right: 10px" class="badge badge-pill badge-info">SEM ASSINATURA</span>
                                    <?php endif; ?>
                                    <div class="card-header"><h3><?= $pet['pet_name'] ?></h3></div>
                                    <div class="card-body text-success">
                                        <?php if(isset($pet["assinatura"])) : ?>
                                            <a href="<?= base_url('minha-conta/assinatura/' . $pet["assinatura"]['id']) ?>" class="genric-btn info small circle">Assinatura</a>
                                        <?php endif; ?>
                                        <a href="<?= base_url('minha-conta/pet/' . $pet["id"]) ?>" class="genric-btn info small circle">Detalhes do Pet</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>
            </section>

        </div>
        <div class="col">
            <nav style="margin: 40px auto" class="nav flex-column">
                <a class="nav-link active" href="<?= base_url('minha-conta') ?>">Dashboard</a>
                <a class="nav-link" href="<?= base_url('minha-conta/assinaturas') ?>">Assinaturas</a>
                <a class="nav-link" href="<?= base_url('minha-conta/cartoes') ?>">Cartões</a>
                <a class="nav-link" href="<?= base_url('minha-conta/meus-pets') ?>">Meus Pets</a>
                <a class="nav-link" href="<?= base_url('minha-conta/meus-dados') ?>">Meus dados</a>
            </nav>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>