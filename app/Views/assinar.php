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
            <?php if (empty($user)) : ?>
                <div class="authArea">
                    <div class="row d-flex optChecked justify-content-center pt-5">
                        <div class="col-md-8">
                            <div class="form-check d-flex align-items-center form-lg form-check-inline">
                                <input checked class="form-check-input" type="radio" name="login_cadastro" data-rf="loginForm" id="logar" value="option1">
                                <label class="form-check-label" for="logar">
                                    <h3 style="margin-bottom: 0">Já tem um cadastro?</h3>
                                </label>
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
                                <button type="submit" class="d-flex align-items-center justify-content-center logitBtn genric-btn success circle mt-1"><span class="textPlace">Continuar</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span></button>
                                <!-- <button class="genric-btn success circle arrow">Login<span class="lnr lnr-arrow-right"></span></button> -->
                            </form>

                        </div>

                    </div>
                    <div class="row d-flex justify-content-center pt-5">
                        <div class="col-md-8">
                            <div class="form-check d-flex align-items-center form-lg form-check-inline">
                                <input class="form-check-input" type="radio" name="login_cadastro" data-rf="registerForm" id="cadastrar" value="1">
                                <label class="form-check-label" for="cadastrar">
                                    <h3 style="margin-bottom: 0">Cadastrar agora</h3>
                                </label>
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
                                                            <?php if (isset($estados)) : ?>
                                                                <?php foreach ($estados as $estado) : ?>
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
                                        <div class="row mt-10">
                                            <hr>
                                        </div>
                                        <h4>Dados do Pet</h4>
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
                                        </div>
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
                                    <button type="submit" class="d-flex align-items-center justify-content-center verifyBtn genric-btn success circle arrow mt-1"><span class="textPlace">Verificar</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span></button>
                                    <!-- <button class="genric-btn success circle arrow">Login<span class="lnr lnr-arrow-right"></span></button> -->
                                </form>
                            </div>



                        </div>
                    </div>
                </div>
            <?php else : ?>

                <div class="paymentMethodArea row d-flex justify-content-center pt-5">
                    <div class="col-md-10">
                        <h3><?= $user["name"] ?></h3>
                        <p><?= $user["email"] ?></p>
                        <hr>
                        <ul>
                            <?php foreach ($user["address"] as $a) : ?>
                                <li>
                                    <?= $a ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>


                        <hr>
                        <ul>
                            <?php foreach ($user["pet_data"] as $pd) : ?>
                                <li><strong><?= $pd["display"] ?></strong>: <?= $pd["value"] ?></li>
                            <?php endforeach ?>
                        </ul>

                        <?php
                        // print_r($user);
                        $hasCard = (is_array($payment) || count($user["payment_methods"]) > 0);

                        ?>
                        <div id="defaultCard" <?= ($hasCard) ? '"' : 'style="display: none"' ?> class="row optPayment optPaymentChecked pt-5">
                            <div class="col-md-12">
                                <div class="form-check d-flex form-lg form-check-inline mb-4">
                                    <input checked class="form-check-input" type="radio" name="payment_meth" data-rf="loginForm" id="pdefault" value="<?= ($hasCard) ? $payment["id"] : '' ?>">
                                    <label class="form-check-label" for="pdefault">
                                        <h3 style="margin-bottom: 0"><?= ($hasCard) ? $payment["data"]["display_number"] : '' ?></h3>
                                    </label>
                                </div>
                                <div class="defCard">
                                    <span class="def-card-brand"><?= ($hasCard) ? $payment["data"]["brand"] : '' ?></span><br>
                                    <span class="def-card-name"><?= ($hasCard) ? '<strong>' . $payment["data"]["holder_name"] . '</strong>' : '' ?></span>

                                    <hr>

                                    <div class="manageCardLink" <?= ($hasCard) ? '"' : 'style="display: none"' ?>>

                                        <a href="<?= base_url("minha-conta/cartoes") ?>">Gerenciar meus cartões (<span class="cardCount"><?= count($user["payment_methods"]) ?></span>)</a>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <?php if (!$hasCard) : ?>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <hr class="w-100">
                                </div>
                            </div>
                            <div class="row no-box-container">
                                <div class="col-md-12">
                                    <div class=" d-flex flex-column align-items-center justify-content-center">
                                        <div class="alert alert-warning  d-flex flex-column align-items-center justify-content-center" role="alert">
                                            <h4 class="mb-3 mt-3 d-flex align-items-center justify-content-center"><span style="font-size: 2.2rem;" class="mr-2"><i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i></span> Você não tem nenhum cartão cadastrado.</h4>
                                            <hr class="w-100">

                                            <a class="genric-btn primary-border circle  add-new-card-btn" href="">Adicionar cartão <i class="fa fa-cc fa-1x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div <?= ($hasCard) ? '' : 'style="display: none"' ?> class="addCardArea row optPayment pt-5 mb-5">
                            <div class="col-md-12">
                                <div class="form-check d-flex form-lg form-check-inline mb-4">
                                    <input class="form-check-input" type="radio" name="payment_meth" data-rf="payment-form" id="addCard" value="option1">
                                    <label class="form-check-label" for="addCard">
                                        <h3 style="margin-bottom: 0">Adicionar cartão</h3>
                                    </label>
                                </div>

                                <form id="payment-form" action="" method="POST">
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

                                    <!-- <div class="token-area">
                                    <label for="token">Token do Cartão de Crédito - Enviar para seu Servidor</label>
                                    <input type="text" name="token" id="token" value="" readonly="true" size="64" style="text-align:center" />
                                </div> -->

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
                    <div class="d-flex justify-content-center pt-4">
                        <a href="#" data-toggle="modal" data-target="#AssinarConfirm" class="assinar-plano-btn genric-btn info-border circle">Continuar</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" data-backdrop="static" id="AssinarConfirm" tabindex="-1" role="dialog" aria-labelledby="AssinarConfirmTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AssinarConfirmLongTitle">Confirmar assinatura de plano</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
                </div>
                <div class="modal-body">
                    <h4>Quase pronto!</h4>
                    <div class="defaultCard"></div>
                    <div class="selectedPlan"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="genric-btn primary-border circle small" id="cancelar-assinar-btn" data-dismiss="modal">Cancelar</button>


                    <form id="finish-form" action="" method="post">
                        <input type="hidden" id="h-plan-id" name="plan_id" value="<?= $plan->identifier ?>">
                        <input type="hidden" id="h-cid" name="cid" value="<?= isset($user["id"]) ? $user["id"] : NULL ?>">
                        <button type="submit" class="confirmar-assinar-btn genric-btn info circle">
                            <span class="textPlace">Confirmar assinatura</span> <span class="ml-3 iconPlace"><i class="fa fa-chevron-right fa-1x"></i></span>
                        </button>

                    </form>

                </div>
                <div class="row">
                    <div class="col">
                        <hr style="margin-bottom: 0" />
                        <div class="response_area"></div>
                    </div>
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