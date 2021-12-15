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
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row checkoutPage">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
            <section style="margin: 40px auto">
                <h3>Meus dados</h3>
                <hr style="width: 100%">
                <form method="POST" id="editarForm" action="">
                    <div class="boxDados">
                        
                        <h4>Dados</h4>
                        <div class="row mt-10">
                            <div class="col-12">
                                <div style="position:relative">
                                    <input placeholder="Nome" type="text" value="<?= $user['name'] ?>" name="name" class="single-input">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col">
                                <div class="input-group-icon">
                                    <div class="icon"><i class="fa fa-at" aria-hidden="true"></i></div>
                                    <input placeholder="Email" type="email" value="<?= $user['email'] ?>" id="email" name="email" placeholder="Email" class="single-input">
                                </div>
                            </div>
                        </div>


                        <div class="row mt-10">
                            <div class="col">
                                <div class="input-group-icon">
                                    <div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
                                    <input placeholder="CEP" type="text" id="cep" value="<?= $user['zip_code'] ?>" name="cep" placeholder="CEP" class="single-input">
                                </div>
                            </div>
                        </div>

                        
                        <div class="row mt-10">
                            <div class="col">
                                <div class="input-group-icon">
                                    <div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
                                    <input placeholder="Rua/Av" type="text" id="address" value="<?= $user['street'] ?>"  name="address" placeholder="Endereço" class="single-input">
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="position:relative">
                                    <input placeholder="Número" type="text" id="number" value="<?= $user['number'] ?>" name="number" placeholder="nº" class="single-input">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-8">
                                <div style="position:relative">
                                    <input placeholder="Bairro" type="text" value="<?= $user['district'] ?>" id="bairro" name="bairro" placeholder="Bairro" class="single-input">
                                </div>
                            </div>
                            <div class="col">
                                <div style="position:relative">
                                    <input placeholder="Complemento" type="text" id="complemento" value="<?= $user['complement'] ?>" name="complemento" placeholder="Complemento" class="single-input">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-5">
                                <div class="input-group-icon mt-10">
                                    <div class="icon"><i class="ti ti-map-alt" aria-hidden="true"></i></div>
                                    <div class="estados-select form-select" id="default-select">
                                        <select name="estado" id="estados">
                                            <option value="">Estado</option>
                                            <?php if(isset($estados)) : ?>
                                            <?php foreach($estados as $estado) : ?>
                                                <option class="estado-item" <?= $estado->sigla == $user["state"] ? ' selected ' : '' ?> value="<?= $estado->sigla ?>"><?= $estado->nome ?></option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <!-- <input type="hidden" value="" id="selected_state" name="estado"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-7  mt-10">
                                <div style="position:relative">
                                    <input placeholder="Cidade" type="text" name="cidade" id="cidade" value="<?= $user['city'] ?>" placeholder="Cidade" class="single-input">
                                </div>
                                <!-- <div class="input-group-icon mt-10">
                                    <div class="icon"><i class="ti ti-map" aria-hidden="true"></i></div>
                                    <div class="form-select" id="default-select">
                                        <select name="cidades" id="cidades">
                                            <option value="-">Cidade</option>
                                        </select>
                                        <input type="hidden" value="" id="selected_city" name="cidade">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="row mt-10"><hr></div>
                        
                        
                    </div>
                    
                    <hr style="margin-bottom: 0" />
                    <div class="response_area"></div>
                    <button type="submit" class="d-flex align-items-center justify-content-center editarFormBtn genric-btn success circle arrow mt-1"><span class="textPlace">Salvar</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span></button>
                </form>
            </section>
           
            <section style="margin: 80px auto">
                <h3>Segurança</h3>
                <hr style="width: 100%">
                <form method="POST" id="changePassForm" action="">
                    
                    <div class="boxPass">
                        
                        <h4>Alterar senha</h4>
                        <div class="row" style="margin: 40px auto">
                            <div class="col-6">
                                <div style="position:relative">
                                    <label for="currentpassword">Senha atual</label>
                                    <input id="currentpassword" type="password" name="currentpassword" placeholder="*****" class="single-input">
                                </div>
                            </div>
                            

                        </div>
                        <div class="row" style="margin: 40px auto">
                            <div class="col-6">
                                <div style="position:relative">
                                    <label for="password">Nova senha</label>
                                    <input id="password" type="password" name="password" placeholder="*****" class="single-input">
                                </div>
                            </div>
                            <div class="col-6">
                                <div style="position:relative">
                                <label for="confirmpassword">Confirmar nova senha</label>
                                    <input id="confirmpassword" type="password" name="confirmpassword" placeholder="*****" class="single-input">
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr style="margin-bottom: 0" />
                    <div class="response_area"></div>
                    <button type="submit" class="d-flex align-items-center justify-content-center changePassFormBtn genric-btn success circle arrow mt-1"><span class="textPlace">Atualizar senha</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span></button>
                </form>
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