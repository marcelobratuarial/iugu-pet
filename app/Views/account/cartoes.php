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

<div style="margin: 50px auto" class="container">
    <div class="row">
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
          <a class="genric-btn primary-border circle add-new-card-btn" data-ref="cartoes" href="">Adicionar cartão <i class="fa fa-cc fa-1x"></i></a>
          <div style="display: none" class="AddCartaoArea pt-5">
            <div class="d-flex flex-column align-items-center justify-content-center">
              <h3>Adicionar cartão</h3>
              <form id="payment-form" data-ref="cartoes" action="" method="POST">
                <div class="usable-creditcard-form">
                    <div class="wrapper">
                        <div class="input-group mt-10 nmb_a">
                            <div class="icon ccic-brand"></div>
                            <input autocomplete="off" name="credit_card_number" class="credit_card_number single-input" data-iugu="number" placeholder="Número do Cartão" type="text" value="" />
                        </div>
                        <div class="input-group mt-10 nmb_b">
                            <div class="icon ccic-cvv"></div>
                            <input autocomplete="off" name="credit_card_cvv" class="credit_card_cvv single-input" data-iugu="verification_value" placeholder="CVV" type="text" value="" />
                        </div>
                        <div class="input-group mt-10 nmb_c">
                            <div class="icon ccic-name"></div>
                            <input name="credit_card_name" class="credit_card_name single-input" data-iugu="full_name" placeholder="Titular do Cartão" type="text" value="" />
                        </div>
                        <div class="input-group mt-10 nmb_d">
                            <div class="icon ccic-exp"></div>
                            <input name="credit_card_expiration" autocomplete="off" class="credit_card_expiration single-input" data-iugu="expiration" placeholder="MM/AA" type="text" value="" />
                        </div>
                    </div>
                    <div class="mt-4 mb-6">
                        <hr>
                        <ul>
                            <li><i class="fa fa-circle" aria-hidden="true"></i> <strong>Este será seu cartão principal</strong></li>
                            <!-- <li><i class="fa fa-circle" aria-hidden="true"></i> <a href="<?= base_url("minha-conta/cartoes") ?>">Gerenciar meus cartões (<?= count($user["payment_methods"]) ?>)</a></li> -->
                        </ul>


                        <hr>
                    </div>
                    <div class="footer">
                        <img src="https://s3-sa-east-1.amazonaws.com/storage.pupui.com.br/9CA0F40E971643D1B7C8DE46BBC18396/assets/cc-icons.e8f4c6b4db3cc0869fa93ad535acbfe7.png" alt="Visa, Master, Diners. Amex" border="0" />
                        <a class="iugu-btn" href="http://iugu.com" tabindex="-1"><img src="https://s3-sa-east-1.amazonaws.com/storage.pupui.com.br/9CA0F40E971643D1B7C8DE46BBC18396/assets/payments-by-iugu.1df7caaf6958f1b5774579fa807b5e7f.png" alt="Pagamentos por Iugu" border="0" /></a>
                    </div>
                </div>

                
                <div class="mt-4">
                    <hr>
                    <button class="genric-btn info circle saveCardBtn" type="submit"><span class="textPlace">Salvar cartão</span> <span class="ml-3 iconPlace"><i class="fa fa-check-circle fa-1x"></i></span></button>
                </div>
                <hr style="margin-bottom: 0" />
                <div class="response_area"></div>
              </form>
              
            </div>
            
          </div>
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