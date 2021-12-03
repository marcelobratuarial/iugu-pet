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
                    <h4 class="text-white">Gerenciar assinatura</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
          <section style="margin: 40px auto; position:relative" class="assinaturas">
            <?php if(isset($assinatura) && !empty($assinatura)) : ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="card border-success mb-3" style="display: relative">
                    <?php if($assinatura["active"]) : ?>
                      <span style="position: absolute; top: 5px; right: 10px" class="badge badge-pill badge-success">ATIVO</span>
                    <?php endif; ?>
                    <h4 class="card-header">Detalhes da assinatura</h4>
                    <div class="card-body text-success">
                      <h3><?= $assinatura['plan_name'] ?></h3>
                      <h5 class="card-title"><?= $assinatura["periodo"] ?></h5>
                      <!-- <a href="<?= base_url('minha-conta/assinatura/'.$assinatura["id"]) ?>" class="btn btn-primary">Detalhes</a> -->
                    </div>
                    <div class="card-footer">
                    <?php if(isset($assinatura['recent_invoices']) && !empty($assinatura['recent_invoices'])) : ?>
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Vencimento</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Status</th>
                            <th scope="col">Fatura</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($assinatura['recent_invoices'] as $i => $ri) : ?>

                          <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $ri['data'] ?></td>
                            <td><?= $assinatura["real"] ?></td>
                            <td><?= $ri['status'] ?></td>
                            <td><a target="_blank" href="<?= $ri['secure_url'] ?>" class="genric-btn default-border small circle arrow">Ver fatura</a></td>
                          </tr>  
                        <?php endforeach ?>
                        </tbody>
                      </table>
                    <?php endif; ?>
                    
                    </div>
                  </div>
                  <a href="#" class="genric-btn danger-border circle">Cancelar assinatura</a>
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