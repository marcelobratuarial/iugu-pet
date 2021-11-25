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
                    <h3>Assinatura: <?= $plan->name ?></h3>
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
                        
                        <form method="POST" id="loginForm" action="">
                            <div class="mt-10">
                                <input type="email" name="email" placeholder="Nome de usuário" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nome de usuário'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="password" name="password" placeholder="Senha" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Senha'" required class="single-input">
                            </div>
                            <hr style="margin-bottom: 0" />
                            <div class="response_area"></div>
                            <button type="submit" class="logitBtn genric-btn success circle arrow mt-1">Continuar<span class="lnr lnr-arrow-right"></span></button>
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
                                    <hr>
                                    <h4>Dados</h4>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mt-10">
                                                <input type="text" name="name" placeholder="Nome completo" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nome completo'" required class="single-input">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-group-icon mt-10">
                                        <div class="icon"><i class="fa fa-at" aria-hidden="true"></i></div>
                                        <input type="email" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required class="single-input">
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group-icon mt-10">
                                                <div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
                                                <input type="text" name="address" placeholder="Endereço" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Endereço'" required class="single-input">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mt-10">
                                                <input type="text" name="number" placeholder="nº" onfocus="this.placeholder = ''" onblur="this.placeholder = 'nº'" required class="single-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="mt-10">
                                                <input type="text" name="bairro" placeholder="Bairro" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Bairro'" required class="single-input">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mt-10">
                                                <input type="text" name="complemento" placeholder="Complemento" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Complemento'" class="single-input">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-5">
                                            <div class="input-group-icon mt-10">
                                                <div class="icon"><i class="ti ti-map-alt" aria-hidden="true"></i></div>
                                                <div class="form-select" id="default-select">
                                                    <select name="estado">
                                                        <option value=" 1">Estado</option>
                                                        <option value="1">Minas Gerais</option>
                                                        <option value="1">Curitiba</option>
                                                        <option value="1">São Paulo</option>
                                                        <option value="1">Rio de Janeiro</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="input-group-icon mt-10">
                                                <div class="icon"><i class="ti ti-map" aria-hidden="true"></i></div>
                                                <div class="form-select" id="default-select">
                                                    <select name="cidade">
                                                        <option value=" 1">Cidade</option>
                                                        <option value="1">Belo Horizonte</option>
                                                        <option value="1">Rio de Janeiro</option>
                                                        <option value="1">São Paulo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Dados do Pet</h4>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="mt-10">
                                                <input type="text" name="pet_name" placeholder="Nome" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nome'" required class="single-input">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mt-10">
                                                <input type="text" name="pet_nasc" placeholder="Nascimento" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nascimento'" required class="single-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mt-10">
                                            <div class="default-select">
                                                <select name="pet_raca">
                                                    <option value="1">Raça</option>
                                                    <option value="1">Chiuaua</option>
                                                    <option value="1">York Shire</option>
                                                    <option value="1">Pastor Alemão</option>
                                                    <option value="1">Fila Brasileiro</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mt-10">
                                                <input type="text" name="pet_peso" placeholder="Peso KG" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Peso KG'" required class="single-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="boxPass">
                                    <hr>
                                    <h4>Criar senha</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mt-10">
                                                <input type="password" name="password" placeholder="*****" onfocus="this.placeholder = ''" onblur="this.placeholder = '*****'" required class="single-input">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mt-10">
                                                <input type="password" name="confirmpassword" placeholder="*****" onfocus="this.placeholder = ''" onblur="this.placeholder = '*****'" class="single-input">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr style="margin-bottom: 0" />
                                <div class="response_area"></div>
                                <button type="submit" class="registerBtn genric-btn success circle arrow mt-1">Continuar<span class="lnr lnr-arrow-right"></span></button>
                            </form>
                        </div>
                        
                        <div class="verBox">
                            <hr>
                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <h5>Quase pronto!</h5>
                                    <p class="custom-message">
                                    </p>
                                </div>
                            </div>
                            <h4 style="margin-bottom: 0">Código de verificação</h4>
                                    
                            <form method="POST" class="verForm" action="">
                                
                                <div class="row mt-10">
                                    <div class="col-md-6">
                                        <input type="text" name="confp1" required class="confp1 single-input">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="confp2" required class="confp2 single-input">
                                    </div>
                                    
                                </div>
                                
                                <hr style="margin-bottom: 0" />
                                <div class="response_area"></div>
                                <button type="submit" class="logitBtn genric-btn success circle arrow">Confirmar<span class="lnr lnr-arrow-right"></span></button>
                                <!-- <button class="genric-btn success circle arrow">Login<span class="lnr lnr-arrow-right"></span></button> -->
                            </form>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
            <?php else: ?>
                
            <div class="paymentMethodArea row d-flex justify-content-center pt-5">
                <div class="col-md-8">
                    <?php echo $user["email"] ?>
                    <pre>

                        <?php //var_dump($payment) ?>
                        <?php //var_dump(is_array($payment)) ?>
                    </pre>
                    <?php if(is_array($payment)): ?>
                    <div class="row d-flex optPayment optPaymentChecked justify-content-center pt-5">
                        <div class="col-md-12">
                            <div class="form-check d-flex form-lg form-check-inline mb-4">
                                <input checked class="form-check-input" type="radio" name="payment_meth" data-rf="loginForm" id="pdefault" value="<?= $payment["id"] ?>">
                                <label class="form-check-label" for="pdefault"><h3 style="margin-bottom: 0"><?= $payment["data"]["display_number"] ?></h3></label>
                            </div>
                            <div class="defCard">
                                <?= $payment["data"]["brand"] ?><br>
                                <strong><?= $payment["data"]["holder_name"] ?></strong>
                                
                                <hr>
                                <?php if(isset($user["payment_methods"]) && count($user["payment_methods"]) > 1) : ?>
                                <a href="<?= base_url("minha-conta/cartoes") ?>">Gerenciar meus cartões (<?= count($user["payment_methods"]) ?>)</a>
                                <?php endif; ?>
                            </div>
                            
                            
                        </div>
                        
                    </div>
                    <?php else: ?>
                    
                    <?php endif; ?>
                    
                    <div class="row d-flex optPayment justify-content-center pt-5 mb-5">
                        <div class="col-md-12">
                            <div class="form-check d-flex form-lg form-check-inline mb-4">
                                <input class="form-check-input" type="radio" name="payment_meth" data-rf="loginForm" id="addCard" value="option1">
                                <label class="form-check-label" for="addCard"><h3 style="margin-bottom: 0">Adicionar cartão</h3></label>
                            </div>
                            
                            <form id="payment-form" target="_blank" action="" method="POST">
                                <div class="usable-creditcard-form">
                                    <div class="wrapper">
                                        <div class="input-group mt-10 nmb_a">
                                            <div class="icon ccic-brand"></div>
                                            <input autocomplete="off" class="credit_card_number single-input" data-iugu="number" placeholder="Número do Cartão" type="text" value="" />
                                        </div>
                                        <div class="input-group mt-10 nmb_b">
                                            <div class="icon ccic-cvv"></div>
                                            <input autocomplete="off" class="credit_card_cvv single-input" data-iugu="verification_value" placeholder="CVV" type="text" value="" />
                                        </div>
                                        <div class="input-group mt-10 nmb_c">
                                            <div class="icon ccic-name"></div>
                                            <input class="credit_card_name single-input" data-iugu="full_name" placeholder="Titular do Cartão" type="text" value="" />
                                        </div>
                                        <div class="input-group mt-10 nmb_d">
                                            <div class="icon ccic-exp"></div>
                                            <input autocomplete="off" class="credit_card_expiration single-input" data-iugu="expiration" placeholder="MM/AA" type="text" value="" />
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-6">
                                        <hr>
                                        <ul>
                                            <li><strong>Este será seu cartão principal</strong></li>
                                            <li><a href="<?= base_url("minha-conta/cartoes") ?>">Gerenciar meus cartões (<?= count($user["payment_methods"]) ?>)</a></li>
                                        </ul>
                                        
                                        
                                        <hr>
                                    </div>
                                    <div class="footer">
                                        <img src="https://s3-sa-east-1.amazonaws.com/storage.pupui.com.br/9CA0F40E971643D1B7C8DE46BBC18396/assets/cc-icons.e8f4c6b4db3cc0869fa93ad535acbfe7.png" alt="Visa, Master, Diners. Amex" border="0" />
                                        <a class="iugu-btn" href="http://iugu.com" tabindex="-1"><img src="https://s3-sa-east-1.amazonaws.com/storage.pupui.com.br/9CA0F40E971643D1B7C8DE46BBC18396/assets/payments-by-iugu.1df7caaf6958f1b5774579fa807b5e7f.png" alt="Pagamentos por Iugu" border="0" /></a>
                                    </div>
                                </div>

                                <!-- <div class="token-area">
                                    <label for="token">Token do Cartão de Crédito - Enviar para seu Servidor</label>
                                    <input type="text" name="token" id="token" value="" readonly="true" size="64" style="text-align:center" />
                                </div> -->

                                <div class="mt-4">
                                    <hr>
                                    <button class="btn btn-primary" type="submit">Salvar</button>
                                </div>

                            </form>
                            
                            
                        </div>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
        <div class="col">
            <div class="service_area">
                <div class="single_service">
                    <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                        <div class="service_icon">
                            <img src="<?= base_url("assets/img/service/service_icon_1.png") ?>" alt="">
                        </div>
                    </div>
                    <div class="service_content text-center">
                        <h3><?= $plan->name ?></h3>
                        <a href="" class="btn btn-outline-primary planPrice"><?= $plan->prices[0]->value_cents ?></a>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($plan->features as $feature) : ?>
                                <li class="list-group-item"><?= $feature->name ?></li>
                            <?php endforeach ?>
                            <!-- <li class="list-group-item">Transporte leva e traz</li>
                            <li class="list-group-item">Hospedagem de animais</li>
                            <li class="list-group-item">Consulta Veterinária</li>
                            <li class="list-group-item">Envio de Ração</li>
                            <li class="list-group-item">Assistencia Funeral</li>
                            <li class="list-group-item">Mais...</li> -->
                        </ul>

                    </div>
                    <div class="d-flex justify-content-center pt-4"><a href="<?= base_url("assinar/" . $plan->id) ?>" class="btn btn-primary">Assinar agora</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>