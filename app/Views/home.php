
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

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider slider_bg_1 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="slider_text">
                            <h3>Seu pet merece<span> tudo de melhor!</span></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dog_thumb d-none d-lg-block">
                <img src="<?=  base_url("assets/img/banner/dog.png") ?>" alt="">
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- service_area_start  -->
    <div class="pet_care_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="pet_thumb">
                        <img src="<?=  base_url("assets/img/about/pet_care.png") ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1 col-md-6">
                    <div class="pet_info">
                        <div class="section_title">
                            <h3><span>Nos importamos com o seu pet</span>
                               assim como você!</h3>
                            <p>Lorem ipsum dolor sit , consectetur adipiscing elit, sed do <br> iusmod tempor incididunt ut labore et dolore magna aliqua. <br> Quis ipsum suspendisse ultrices gravida. Risus commodo <br>
                                viverra maecenas accumsan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="service_area" name="planos">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-7 col-md-10">
                    <div class="section_title text-center mb-95">
                        <h3>Planos para o seu pet</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php foreach($plans as $i=> $plan) : ?>
                <div class="col-lg-4 col-md-6">
                    <div class="single_service">
                         <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                             <div class="service_icon">
                                 <img src="<?=  base_url("assets/img/service/service_icon_".$i.".png") ?>" alt="">
                             </div>
                         </div>
                         <div class="service_content text-center">
                            <h3><?= $plan["name"] ?></h3>
                            <a href="<?= base_url("assinar/".$plan["id"]) ?>" class="btn btn-outline-primary planPrice"><?= $plan["prices"][0]["value_cents"] ?></a>
                            <ul class="list-group list-group-flush">
                                <?php foreach($plan["features"] as $feature) : ?>
                                <li class="list-group-item"><?= $feature["name"] ?></li>
                                <?php endforeach ?>
                                <!-- <li class="list-group-item">Transporte leva e traz</li>
                                <li class="list-group-item">Hospedagem de animais</li>
                                <li class="list-group-item">Consulta Veterinária</li>
                                <li class="list-group-item">Envio de Ração</li>
                                <li class="list-group-item">Assistencia Funeral</li>
                                <li class="list-group-item">Mais...</li> -->
                            </ul>
                            
                         </div>
                         <div class="d-flex justify-content-center pt-4"><a href="<?= base_url("assinar/".$plan["id"]) ?>" class="btn btn-primary">Assinar agora</a></div>
                    </div>
                    
                </div>
                <?php endforeach ?>
                <!-- <div class="col-lg-4 col-md-6">
                    <div class="single_service">
                         <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                             <div class="service_icon">
                                 <img src="<?=  base_url("assets/img/service/service_icon_1.png") ?>" alt="">
                             </div>
                         </div>
                         <div class="service_content text-center">
                            <h3>Plano Básico</h3>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Transporte leva e traz</li>
                                <li class="list-group-item">Hospedagem de animais</li>
                                <li class="list-group-item">Consulta Veterinária</li>
                                <li class="list-group-item">Envio de Ração</li>
                                <li class="list-group-item">Assistencia Funeral</li>
                                <li class="list-group-item">Mais...</li>
                              </ul>
                         </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_service active">
                         <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                             <div class="service_icon">
                                 <img src="<?=  base_url("assets/img/service/service_icon_2.png") ?>" alt="">
                             </div>
                         </div>
                         <div class="service_content text-center">
                            <h3>Plano Completo</h3>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Transporte leva e traz</li>
                                <li class="list-group-item">Hospedagem de animais</li>
                                <li class="list-group-item">Consulta Veterinária</li>
                                <li class="list-group-item">Envio de Ração</li>
                                <li class="list-group-item">Assistencia Funeral</li>
                                <li class="list-group-item">Mais...</li>
                              </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_service">
                         <div class="service_thumb service_icon_bg_1 d-flex align-items-center justify-content-center">
                             <div class="service_icon">
                                 <img src="<?=  base_url("assets/img/service/service_icon_3.png") ?>" alt="">
                             </div>
                         </div>
                         <div class="service_content text-center">
                            <h3>Plano Plus</h3>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Transporte leva e traz</li>
                                <li class="list-group-item">Hospedagem de animais</li>
                                <li class="list-group-item">Consulta Veterinária</li>
                                <li class="list-group-item">Envio de Ração</li>
                                <li class="list-group-item">Assistencia Funeral</li>
                                <li class="list-group-item">Mais...</li>
                              </ul>
                         </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- service_area_end -->

    <!-- pet_care_area_start  -->
    
    <!-- pet_care_area_end  -->

    <!-- adapt_area_start  -->
    <div class="adapt_area">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5">
                    <div class="adapt_help">
                        <div class="section_title">
                            <h3><span>Lorem ipsum</span> dolor sit </h3>
                            <p>Lorem ipsum dolor sit , consectetur adipiscing elit, sed do iusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="adapt_about">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6">
                                <div class="single_adapt text-center">
                                    <img src="<?=  base_url("assets/img/adapt_icon/1.png")?>" alt="">
                                    <div class="adapt_content">
                                        <h3 class="counter">452</h3>
                                        <p>Pets Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="single_adapt text-center">
                                    <img src="<?=  base_url("assets/img/adapt_icon/3.png")?>" alt="">
                                    <div class="adapt_content">
                                        <h3><span class="counter">52</span>+</h3>
                                        <p>Pets Available</p>
                                    </div>
                                </div>
                                <div class="single_adapt text-center">
                                    <img src="<?=  base_url("assets/img/adapt_icon/2.png")?>" alt="">
                                    <div class="adapt_content">
                                        <h3><span class="counter">52</span>+</h3>
                                        <p>Pets Available</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- adapt_area_end  -->

    <!-- testmonial_area_start  -->
    <div class="testmonial_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="textmonial_active owl-carousel">
                        <div class="testmonial_wrap">
                            <div class="single_testmonial d-flex align-items-center">
                                <div class="test_thumb">
                                    <img src="<?=  base_url("assets/img/testmonial/1.png")?>" alt="">
                                </div>
                                <div class="test_content">
                                    <h4>Jhon Walker</h4>
                                    <span>Head of web design</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.</p>
                                </div>
                            </div>
                        </div>
                        <div class="testmonial_wrap">
                            <div class="single_testmonial d-flex align-items-center">
                                <div class="test_thumb">
                                    <img src="<?=  base_url("assets/img/testmonial/1.png")?>" alt="">
                                </div>
                                <div class="test_content">
                                    <h4>Jhon Walker</h4>
                                    <span>Head of web design</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.</p>
                                </div>
                            </div>
                        </div>
                        <div class="testmonial_wrap">
                            <div class="single_testmonial d-flex align-items-center">
                                <div class="test_thumb">
                                    <img src="<?=  base_url("assets/img/testmonial/1.png") ?>" alt="">
                                </div>
                                <div class="test_content">
                                    <h4>Jhon Walker</h4>
                                    <span>Head of web design</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- testmonial_area_end  -->

    <!-- team_area_start  -->
    <!--<div class="team_area">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-6 col-md-10">
                    <div class="section_title text-center mb-95">
                        <h3>Our Team</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single_team">
                        <div class="thumb">
                            <img src="img/team/1.png" alt="">
                        </div>
                        <div class="member_name text-center">
                            <div class="mamber_inner">
                                <h4>Rala Emaia</h4>
                                <p>Senior Director</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_team">
                        <div class="thumb">
                            <img src="img/team/2.png" alt="">
                        </div>
                        <div class="member_name text-center">
                            <div class="mamber_inner">
                                <h4>jhon Smith</h4>
                                <p>Senior Director</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single_team">
                        <div class="thumb">
                            <img src="img/team/3.png" alt="">
                        </div>
                        <div class="member_name text-center">
                            <div class="mamber_inner">
                                <h4>Rala Emaia</h4>
                                <p>Senior Director</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- team_area_start  -->

    <div class="contact_anipat anipat_bg_1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact_text text-center">
                        <div class="section_title text-center">
                            <h3>Lorem ipsum</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.</p>                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
    <?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>