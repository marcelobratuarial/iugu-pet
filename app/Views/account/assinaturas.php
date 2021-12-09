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
                    <div class="card border-success mb-3" style="position:relative">
                      <?php if($ass["active"] && !$ass["suspended"]) : ?>
                        <span style="position: absolute; top: 5px; right: 10px" class="badge badge-pill badge-success">ATIVO</span>
                      <?php elseif($ass["active"] && $ass["suspended"]) : ?>
                        <span style="position: absolute; top: 5px; right: 10px" class="badge badge-pill badge-warning">SUSPENSO</span>
                      <?php endif; ?>
                      <div class="card-header"><?= $ass['plan_name'] ?></div>
                      <div class="card-body text-success">
                        <h5 class="card-title"><?= $ass["periodo"] ?></h5>
                        <p class="card-text"><?= $ass["real"] ?></p>
                        <a href="<?= base_url('minha-conta/assinatura/'.$ass["id"]) ?>" class="btn btn-primary">Detalhes</a>
                      </div>
                    </div>
                  </div>
                <?php endforeach ?>
              <?php else: ?>
                <div class="row mt-3 mb-3">
                    <div class="col-md-12">
                        <hr class="w-100">
                    </div>
                </div>
                <div class="row no-box-container">
                    <div class="col-md-12">
                        <div class=" d-flex flex-column align-items-center justify-content-center">
                            <div class="alert alert-warning  d-flex flex-column align-items-center justify-content-center" role="alert">
                                <h4 class="mb-3 mt-3 d-flex align-items-center justify-content-center"><span style="font-size: 2.2rem;" class="mr-2"><i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i></span> Você não tem nenhuma assinatura.</h4>
                                <hr class="w-100">

                                <a class="genric-btn primary-border circle " href="<?= base_url("/") ?>">Conheça nossos planos </a>
                            </div>
                        </div>
                    </div>
                </div>
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