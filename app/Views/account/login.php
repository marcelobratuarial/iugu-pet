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
                    <h3>Assinatura:</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row checkoutPage">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
            <?php if(empty($user)) : ?>
            <div class="authArea">
                <div class="row d-flex optChecked justify-content-center pt-5">
                    <div class="col-md-8">
                        <div class="form-check d-flex align-items-center form-lg form-check-inline">
                            <input checked class="form-check-input" type="radio" name="login_cadastro" data-rf="loginForm" id="logar" value="option1">
                            <label class="form-check-label" for="logar"><h3 style="margin-bottom: 0">Já tem um cadastro?</h3></label>
                        </div>
                        
                        <form method="POST" id="loginForm" data-form-ref="my-account" action="">
                            <div class="mt-10">
                                <input type="email" name="email" placeholder="Nome de usuário" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nome de usuário'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="password" name="password" placeholder="Senha" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Senha'" required class="single-input">
                            </div>
                            <hr style="margin-bottom: 0" />
                            <div class="response_area"></div>
                            <button type="submit" class="d-flex align-items-center justify-content-center logitBtn genric-btn success circle mt-1"><span class="textPlace">Continuar</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span></button>
                            <!-- <button class="genric-btn success circle arrow">Login<span class="lnr lnr-arrow-right"></span></button> -->
                        </form>
                        
                    </div>

                </div>
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-md-8">
                        <div class="form-check d-flex align-items-center form-lg form-check-inline">
                            <input class="form-check-input" type="radio" name="login_cadastro" data-rf="registerForm" id="cadastrar" value="1">
                            <label class="form-check-label" for="cadastrar"><h3 style="margin-bottom: 0">Cadastrar agora</h3></label>
                        </div>
                        <div class="dataBox">
                            <form method="POST" id="registerForm" action="">
                                <div class="boxDados">
                                    
                                    <h4>Dados</h4>
                                    <div class="row mt-10">
                                        <div class="col-12">
                                            <div style="position:relative">
                                                <input type="text" name="name" class="single-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-10">
                                        <div class="col">
                                            <div class="input-group-icon">
                                                <div class="icon"><i class="fa fa-at" aria-hidden="true"></i></div>
                                                <input type="email" id="email" name="email" placeholder="Email" class="single-input">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-10">
                                        <div class="col">
                                            <div class="input-group-icon">
                                                <div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
                                                <input type="text" id="cep" name="cep" placeholder="CEP" class="single-input">
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row mt-10">
                                        <div class="col">
                                            <div class="input-group-icon">
                                                <div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
                                                <input type="text" id="address" name="address" placeholder="Endereço" class="single-input">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div style="position:relative">
                                                <input type="text" id="number" name="number" placeholder="nº" class="single-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-10">
                                        <div class="col-8">
                                            <div style="position:relative">
                                                <input type="text" id="bairro" name="bairro" placeholder="Bairro" class="single-input">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div style="position:relative">
                                                <input type="text" id="complemento" name="complemento" placeholder="Complemento" class="single-input">
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
                                                            <option class="estado-item" value="<?= $estado->sigla ?>"><?= $estado->nome ?></option>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <!-- <input type="hidden" value="" id="selected_state" name="estado"> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7  mt-10">
                                            <div style="position:relative">
                                                <input type="text" name="cidade" id="cidade" placeholder="Cidade" class="single-input">
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
                                    <?php /* <h4>Dados do Pet</h4>
                                    <div class="row mt-10">
                                        <div class="col-8">
                                            <div style="position:relative">
                                                <input type="text" name="pet_name" placeholder="Nome" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nome'" class="single-input">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div style="position:relative">
                                                <input type="text" name="pet_nasc" placeholder="Nascimento" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nascimento'" class="single-input">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row mt-10">
                                        <div class="col-6">
                                            <div style="position:relative">
                                                <input type="text" name="pet_raca" placeholder="Raça" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Raça'" class="single-input">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div style="position:relative">
                                                <input type="text" name="pet_peso" placeholder="Peso KG" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Peso KG'" class="single-input">
                                            </div>
                                        </div>
                                    </div>*/ ?>
                                </div>
                                <div class="boxPass">
                                    
                                    <h4>Criar senha</h4>
                                    <div class="row mt-10">
                                        <div class="col-6">
                                            <div style="position:relative">
                                                <input type="password" name="password" placeholder="*****" onfocus="this.placeholder = ''" onblur="this.placeholder = '*****'" class="single-input">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div style="position:relative">
                                                <input type="password" name="confirmpassword" placeholder="*****" onfocus="this.placeholder = ''" onblur="this.placeholder = '*****'" class="single-input">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr style="margin-bottom: 0" />
                                <div class="response_area"></div>
                                <button type="submit" class="d-flex align-items-center justify-content-center registerBtn genric-btn success circle arrow mt-1"><span class="textPlace">Continuar</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span></button>
                            </form>
                        </div>
                        
                        <div class="verBox">
                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <h5>Quase pronto!</h5>
                                    <p class="custom-message">
                                    </p>
                                </div>
                            </div>
                            <h4 style="margin-bottom: 0">Código de verificação</h4>
                                    
                            <form method="POST" data-form-ref="my-account" class="verForm" action="">
                                
                                <div class="row mt-10">
                                    <div class="col-6">
                                        <input type="text" name="confp1" required class="confp1 single-input">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="confp2" required class="confp2 single-input">
                                    </div>
                                    
                                </div>
                                
                                <hr style="margin-bottom: 0" />
                                <div class="response_area"></div>
                                <button type="submit" data-form-ref="my-account" class="d-flex align-items-center justify-content-center verifyBtn genric-btn success circle arrow mt-1"><span class="textPlace">Verificar</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span></button>
                                <!-- <button class="genric-btn success circle arrow">Login<span class="lnr lnr-arrow-right"></span></button> -->
                            </form>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
            <?php else: ?>
                
            
            <?php endif; ?>
            
        </div>
        <div class="col">
            
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>