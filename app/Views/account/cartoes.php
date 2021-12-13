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
                    <h4 class="text-white">Gerenciar meus cartões </h4>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row checkoutPage">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
          
          <section style="margin: 40px auto; position:relative" class="cartoes">
            <?php if(session()->has("card_not_found")) : ?>

              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= session("card_not_found") ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
            <?php endif; ?>
            <?php if(session()->has("removed_card")) : ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?= session("removed_card") ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <?php endif; ?>
            <?php if(isset($user['payment_methods']) && !empty($user['payment_methods'])) : ?>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Bandeira</th>
                    <th scope="col">Número</th>
                    <th scope="col">Detalhes</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($user['payment_methods'] as $i => $pm) : ?>

                      
                  <?php 
                    $dft = ($pm['default']) ? '<span class="badge badge-primary">Padrão</span>' : '';
                  ?>
                  <tr>
                    <th scope="row"><?= $i+1 ?></th>
                    <td><img src="<?=base_url("assets/img/brands/". strtolower($pm['data']['brand']).".png") ?>" width="80" style="margin-right: 20px; object-fit: cover; width: 80px" ><?= $pm['data']['brand'] ?></td>
                    <td><?= $pm['data']['display_number'] ?> <?=$dft?><br><?=$pm['data']['holder_name']?></td>
                    <td><a href="<?= base_url('minha-conta/cartao/'.$pm["id"]) ?>" class="genric-btn info-border circle small">Detalhes</a></td>
                  </tr>  
                <?php endforeach ?>
                </tbody>
              </table>
              <?php endif; ?>
          </section>
          <hr>
          <a class="genric-btn primary-border circle  add-new-card-btn" href="">Adicionar cartão <i class="fa fa-cc fa-1x"></i></a>
          <div class="AddCartaoArea row d-flex justify-content-center pt-5">
            
            
            
            
          </div>
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