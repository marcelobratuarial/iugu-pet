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
                    <h4 class="text-white">Gerenciar minhas assinaturas </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
          <section style="margin: 40px auto; position:relative" class="assinaturas">
            <?php if(isset($assinaturas) && !empty($assinaturas)) : ?>
              <div class="row">
                <?php foreach($assinaturas as $ass) : ?>
                  <div class="col-md-6">
                    <div class="card border-success mb-3" style="">
                      <div class="card-header"><?= $ass['plan_name'] ?></div>
                      <div class="card-body text-success">
                        <h5 class="card-title"><?= $ass["periodo"] ?></h5>
                        <p class="card-text"><?= $ass["real"] ?></p>
                        <a href="<?= base_url('minha-conta/assinatura/'.$ass["id"]) ?>" class="btn btn-primary">Detalhes</a>
                      </div>
                    </div>
                  </div>
                <?php endforeach ?>
              <?php endif; ?>
          </section>
          <hr />
        </div>
        <div class="col">
          <nav style="margin: 40px auto" class="nav flex-column">
            <a class="nav-link active" href="<?= base_url('minha-conta') ?>">Dashboard</a>
            <a class="nav-link" href="<?= base_url('minha-conta/assinaturas') ?>">Assinaturas</a>
            <a class="nav-link" href="<?= base_url('minha-conta/cartoes') ?>">Cartões</a>
            <a class="nav-link" href="<?= base_url('minha-conta/meus-dados') ?>">Meus dados</a>
          </nav>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>