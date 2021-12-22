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
            <?php // print_r($assinatura);
            if(isset($assinatura) && !empty($assinatura)) : ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="card border-success mb-3" style="display: relative">
                    <?php if($assinatura["active"] && !$assinatura["suspended"]) : ?>
                      <span style="position: absolute; top: 5px; right: 10px" class="badge badge-pill badge-success">ATIVO</span>
                    <?php elseif($assinatura["active"] && $assinatura["suspended"]) : ?>
                      <span style="position: absolute; top: 5px; right: 10px" class="badge badge-pill badge-warning">SUSPENSO</span>
                    <?php endif; ?>
                    <h4 class="card-header">Detalhes da assinatura</h4>
                    <?php //print_r($assinatura['pet']);exit; ?>
                    <div class="card-body text-success">
                      <div class="row">
                        <div class="col-md-6">
                          <h3><?= $assinatura['plan_name'] ?></h3>
                          <h5 class="card-title"><?= $assinatura["periodo"] ?></h5>
                          <hr>
                          <?php if(!empty($assinatura['pet'])) : ?>
                          
                                <h3><?= $assinatura['pet']["pet_name"]; ?></h3>
                          <?php else : ?>
                            Nenhum Pet vinculado
                          <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                          <?php if(!empty($assinatura['features'])) : ?>
                          <ul class="list-group list-group-flush">
                              <?php foreach ($assinatura['features'] as $feature) : ?>
                                  <li class="list-group-item"><?= $feature["name"] ?></li>
                              <?php endforeach ?>
                          </ul>
                          <?php else : ?>
                            Nenhum recurso no <?= $assinatura['plan_name'] ?>
                          <?php endif; ?>
                        </div>
                      </div>
                      
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
                      <div class="mt-5">
                        <a class="genric-btn success-border small circle" data-toggle="collapse" href="#logsBox" role="button" aria-expanded="false" aria-controls="logsBox">Histórico</a>
      
                        <div class="collapse multi-collapse" id="logsBox">
                          <div class="card card-body">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Data</th>
                                  <th scope="col">Descrição</th>
                                  <th scope="col">Nota</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php foreach($assinatura['logs'] as $i => $log) : ?>

                                <tr>
                                  <th scope="row"><?= $i ?></th>
                                  <td><?= $log['data'] ?></td>
                                  <td><?= $log["description"] ?></td>
                                  <td><?= $log['notes'] ?></td>
                                  
                                </tr>  
                              <?php endforeach ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    
                    </div>
                  </div>
                  <a href="#" style="<?= ($assinatura["suspended"]) ? 'display: none': '' ?>" data-toggle="modal" data-target="#SuspendConfirm" class="suspender-assinatura-btn genric-btn danger-border circle">Suspender assinatura</a>
                  <a href="#" style="<?= (!$assinatura["suspended"]) ? 'display: none': '' ?>" data-toggle="modal" data-target="#ActivateConfirm" class="ativar-assinatura-btn genric-btn info-border circle">Ativar assinatura</a>
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
            <a class="nav-link" href="<?= base_url('minha-conta/meus-pets') ?>">Meus Pets</a>
            <a class="nav-link" href="<?= base_url('minha-conta/meus-dados') ?>">Meus dados</a>
          </nav>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>

<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="SuspendConfirm" tabindex="-1" role="dialog" aria-labelledby="SuspendConfirmTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SuspendConfirmLongTitle">Suspender assinatura</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        Você deseja mesmo <strong>SUPENDER</strong> sua assinatura?
      </div>
      <div class="modal-footer">
        <button type="button" class="genric-btn primary-border circle small" id="cancelar-suspensao-btn" data-dismiss="modal">Cancelar</button>
        
        <button type="button" data-ass-id="<?= $assinatura["id"] ?>" class="genric-btn danger-border circle small" id="confimar-suspensao-btn">
        <span class="textPlace">Confirmar suspensão</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span>
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
        
        <button type="button" data-ass-id="<?= $assinatura["id"] ?>" class="genric-btn info-border circle small" id="confimar-ativacao-btn">
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