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
                    <h4 class="text-white">Gerenciar cartão</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
          <section style="margin: 40px auto; position:relative" class="cartoes">
            <?php // print_r($cartao);
            if(isset($cartao) && !empty($cartao)) : ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="card border-success mb-3" style="display: relative">
                    
                    <span style="<?= (!$cartao["default"]) ? 'display:none;' : '' ?>position: absolute; top: 5px; right: 10px" class="badge badge-pill badge-success" id="definir-cartao-padrao-badge">PADRÃO</span>
                  
                    <a style="<?= ($cartao["default"]) ? 'display:none;' : '' ?>position: absolute; top: 5px; right: 10px"  href="#" style="" data-toggle="modal" data-target="#DefinirCartaoPadraoConfirm" class="definir-cartao-padrao-btn genric-btn info-border small circle">Definir como cartão padrão</a>
                    
                    <h4 class="card-header">Detalhes do cartão</h4>
                    <?php //print_r($assinatura);exit; ?>
                    <div class="card-body text-success">
                      <div class="row">
                        <div class="col-md-4">
                          <img src="<?=base_url("assets/img/brands/". strtolower($cartao['data']['brand']).".png") ?>" width="200" style="margin-right: 20px; object-fit: cover; width: 200px" >
                        </div>
                        <div class="col-md-8">
                          <?php if(strlen($cartao['description']) > 0) : ?>
                          <h5><small>DESCRIÇÃO</small></h5>
                          <p><?= $cartao['description'] ?></p>
                          <hr>
                          <?php endif; ?>
                          <h4><?= $cartao["data"]["display_number"] ?></h4>
                          <h4><?= $cartao["data"]["holder_name"] ?></h4>
                          <h5><?= $cartao["data"]["month"] ?>/<?= $cartao["data"]["year"] ?></h5>
                        </div>
                      </div>
                      
                    </div>
                    <div class="card-footer">
                      
                    </div>
                  </div>
                  <a href="#" style="" data-toggle="modal" data-target="#RemoveCardConfirm" class="remover-cartao-btn genric-btn danger-border circle">Remover cartão</a>
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

<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="RemoveCardConfirm" tabindex="-1" role="dialog" aria-labelledby="RemoveCardConfirmTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RemoveCardConfirmLongTitle">Remover cartão</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        Você deseja mesmo <strong>REMOVER</strong> este cartão?
      </div>
      <div class="modal-footer">
        <button type="button" class="genric-btn primary-border circle small" id="cancelar-remover-cartao-btn" data-dismiss="modal">Cancelar</button>
        
        <button type="button" data-card-id="<?= $cartao["id"] ?>" class="genric-btn danger-border circle small" id="confimar-remover-cartao-btn">
        <span class="textPlace">Remover</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="DefinirCartaoPadraoConfirm" tabindex="-1" role="dialog" aria-labelledby="DefinirCartaoPadraoConfirmTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DefinirCartaoPadraoConfirmLongTitle">Definir cartão padrão</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        Você deseja mesmo definir este cartão como padrão?
      </div>
      <div class="modal-footer">
        <button type="button" class="genric-btn primary-border circle small" id="cancelar-definir-cartao-padrao-btn" data-dismiss="modal">Cancelar</button>
        
        <button type="button" data-card-id="<?= $cartao["id"] ?>" class="genric-btn info-border circle small" id="confimar-definir-cartao-padrao-btn">
        <span class="textPlace">Definir padrão</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="ActivateConfirm" tabindex="-1" role="dialog" aria-labelledby="ActivateConfirmTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ativar assinatura</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        Você deseja mesmo <strong>ATIVAR</strong> sua assinatura?
      </div>
      <div class="modal-footer">
        <button type="button" class="genric-btn primary-border circle small" id="cancelar-ativacao-btn" data-dismiss="modal">Cancelar</button>
        
        <button type="button" data-ass-id="<?= $cartao["id"] ?>" class="genric-btn info-border circle small" id="confimar-ativacao-btn">
        <span class="textPlace">Confirmar ativação</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="ResponseCustom" tabindex="-1" role="dialog" aria-labelledby="ResponseCustomTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ResponseCustomLongTitle"></h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="genric-btn primary-border circle small" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>