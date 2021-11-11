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
    <?= $this->include('parts/home/our-content') ?> */ ?>


<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcam_text text-center">
                    <h3>Serviços</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- bradcam_area_start -->
<div class="service_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="single_service">
                    <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                        <div class="service_icon">
                            <img src="img/service/service_icon_1.png" alt="">
                        </div>
                    </div>
                    <div class="service_content text-center">
                        <h3>Leva e traz </h3>
                        <p>Por solicitação do associado, a Ikê acionará e/ou agendará o serviço de Leva e Traz de animais domésticos para clínicas veterinárias, banho, tosa e hotéis, sendo que serviço deverá ser solicitado com um prazo mínimo de 24 (vinte e quatro) horas de antecedência. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_service active">
                    <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                        <div class="service_icon">
                            <img src="img/service/service_icon_2.png" alt="">
                        </div>
                    </div>
                    <div class="service_content text-center">
                        <h3>Hospedagem</h3>
                        <p>Em caso de lesão ou doença do Usuário, que o impeça de cuidar do seu pet, devidamente atestado através de laudo médico, serão disponibilizados estadia em Hotel Pet/Pet Shop ou Veterinária mais próximo da residência do usuário.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_service">
                    <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                        <div class="service_icon">
                            <img src="img/service/service_icon_3.png" alt="">
                        </div>
                    </div>
                    <div class="service_content text-center">
                        <h3>Consulta Veterinária</h3>
                        <p>- O usuário terá a sua disposição consultas veterinárias na rede credenciada da Assistência, para atendimento preventivo e rotineiro ao seu animal de estimação. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_service">
                    <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                        <div class="service_icon">
                            <img src="img/service/service_icon_3.png" alt="">
                        </div>
                    </div>
                    <div class="service_content text-center">
                        <h3>Envio de Ração</h3>
                        <p>Quando necessário, o Usuário poderá acionar a Assistência 24 horas para solicitar o envio de ração à sua residência. É necessário que no momento do atendimento o Usuário saiba a marca, o tipo e o peso do produto desejado. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_service">
                    <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                        <div class="service_icon">
                            <img src="img/service/service_icon_3.png" alt="">
                        </div>
                    </div>
                    <div class="service_content text-center">
                        <h3>Assistência Funeral</h3>
                        <p>Em caso de falecimento do Animal Assistido, Assistência será responsável pela realização da cremação ou sepultamento do Animal Assistido (desde que disponível no município da ocorrência) no local mais próximo do evento.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_service">
                    <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                        <div class="service_icon">
                            <img src="img/service/service_icon_3.png" alt="">
                        </div>
                    </div>
                    <div class="service_content text-center">
                        <h3>Agendamento de consultas </h3>
                        <p>Quando necessário, o Usuário poderá utilizar a nossa Assistência para agendar consultas veterinárias na nossa rede credenciada ou em seu veterinário particular, conforme preferência de local, data e horário.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>