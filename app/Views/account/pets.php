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
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
            <section style="margin: 40px auto">
                <h3>Meus pets</h3>
                <hr class="w-100">

                <a data-toggle="modal" data-target="#AddPetModal" class="genric-btn primary-border circle  add-new-pet-btn" href="">Cadastrar Pet <i class="fa fa-paw fa-1x"></i></a>
                <hr style="width: 100%">
                <?php if (isset($pets) && !empty($pets)) : ?>
                    <div class="row" id="pets">
                        <?php foreach ($pets as $pet) : ?>
                            <div class="col-md-6" id="box-pet-id-<?= $pet["id"] ?>">
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
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <?php if(isset($pet["assinatura"])) : ?>
                                                <a href="<?= base_url('minha-conta/assinatura/' . $pet["assinatura"]['id']) ?>" class="genric-btn info small circle">Assinatura</a>
                                                <hr style="width: 80%">
                                            <?php endif; ?>
                                            <a href="<?= base_url('minha-conta/pet/' . $pet["id"]) ?>" class="genric-btn info small circle">Detalhes do Pet</a>
                                        </div>
                                        
                                    </div>
                                    <div class="card-footer" style="text-align: right">
                                    <?php if((!isset($pet["assinatura"])) || (isset($pet["assinatura"]) && !$pet["assinatura"]['isValid'])) : ?>
                                        <a href="<?= base_url('minha-conta/pet/' . $pet["id"]) ?>" data-pet-id="<?= $pet["id"] ?>" class="remover-pet-btn genric-btn danger small circle">Remover Pet</a>
                                    <?php endif; ?>
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



<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="RemoverPetConfirm" tabindex="-1" role="dialog" aria-labelledby="RemoverPetConfirmTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RemoverPetConfirmLongTitle">Remover Pet</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        Você deseja mesmo <strong>REMOVER</strong> este pet?
      </div>
      <div class="modal-footer">
        <button type="button" class="genric-btn primary-border circle small" id="cancelar-remover-pet-btn" data-dismiss="modal">Cancelar</button>
        
        <button type="button" data-pet-id="" class="genric-btn danger-border circle small" id="confimar-remover-pet-btn">
        <span class="textPlace">Remover</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="AddPetModal" tabindex="-1" role="dialog" aria-labelledby="AddPetModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddPetModalLongTitle">Cadastrar Pet</h5>
            </div>
            <div class="modal-body">
                <form action="" id="cadPetForm">
                    <h4>Dados do Pet</h4>
                    <div class="row mt-10">
                        <div class="col-8">
                            <div style="position:relative">
                                <input type="text" name="pet_name" placeholder="Nome"  class="single-input">
                            </div>
                        </div>
                        <div class="col">
                            <div style="position:relative">
                                <input type="text" id="pet_nasc" name="pet_nasc" placeholder="Nascimento"  class="single-input">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-6">
                            <div style="position:relative">
                                <input type="text" name="pet_raca" placeholder="Raça"  class="single-input">
                            </div>
                        </div>
                        <div class="col">
                            <div style="position:relative">
                                <input type="text" name="pet_peso" placeholder="Peso KG" class="single-input">
                            </div>
                        </div>
                    </div>
                    <hr style="margin-bottom: 0" />
                    <div class="response_area"></div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="genric-btn primary-border circle small" id="cancelar-add-pet-btn" data-dismiss="modal">Cancelar</button>

                <button type="button" data-ass-id="" data-ref="pet-list" class="genric-btn info-border circle small" id="save-pet-btn">
                    <span class="textPlace">Salvar</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span>
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
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>