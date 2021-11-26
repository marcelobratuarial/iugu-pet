<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--  -->
    <!--    Document Title-->
    <!-- =============================================-->
    <title>Brasil Benefícios</title>
    <!--  -->
    <!--    Favicons-->
    <!--    =============================================-->
    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/owl.carousel.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/magnific-popup.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/themify-icons.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/nice-select.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/flaticon.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/gijgo.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/animate.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/slicknav.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/style.css") ?>">

    <?= $this->renderSection('cCss') ?>

    <!-- <meta property="og:type" content="website" />
        <meta property="fb:app_id" content="917706978842477" />
        
        <meta property="og:url" content="//brasilbeneficios.club" />
        <meta property="og:site_name" content="Clube Brasil Benefícios" />
        <meta property="og:title" content="Clube Brasil Benefícios" />
        <meta property="og:description" content="Clube de Benefícios" />
        
        <meta property="og:image" content="http://brasilbeneficios.club/assets/img/logo/og-bb.png" />
        <meta property="og:image:secure_url" content="https://brasilbeneficios.club/assets/img/logo/og-bb.png" />
        <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="257" />
        <meta property="og:image:height" content="257" />
        <meta property="og:image:alt" content="Brasil Benefícios Logo" /> -->
    <!-- <style>
            video {
                -webkit-filter: brightness(132%); 
                filter: brightness(132%); 
            }
        </style> -->
</head>

<body>
    <?php /*<div class="CustomLoader active">
            <!-- <img src="<?= base_url('assets/images/loader/loading.png') ?>" alt=""> -->
            <video id="Loader" muted="true" autoplay playsinline>
                <source src="<?= base_url('assets/videos/logoanimada03.mp4') ?>" type="video/mp4" />
            <!-- <source src="movie.ogg" type="video/ogg" /> -->
            Your browser does not support the video tag.
            </video>
        </div> */ ?>
    <?= $this->renderSection('header') ?>

    <main style="clear: both;">
        <?= $this->renderSection('content') ?>



    </main>


    <?= $this->renderSection('footer') ?>

    <!-- JS here -->
    <script src="<?= base_url("assets/js/vendor/modernizr-3.5.0.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/vendor/jquery-1.12.4.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/popper.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/bootstrap.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/owl.carousel.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/isotope.pkgd.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/ajax-form.js") ?>"></script>
    <script src="<?= base_url("assets/js/waypoints.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.counterup.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/imagesloaded.pkgd.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/scrollIt.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.scrollUp.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/wow.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/nice-select.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.slicknav.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.magnific-popup.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/plugins.js") ?>"></script>
    <script src="<?= base_url("assets/js/gijgo.min.js") ?>"></script>

    <!--contact js-->
    <script src="<?= base_url("assets/js/contact.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.mask.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.ajaxchimp.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.form.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.validate.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/mail-script.js") ?>"></script>
    <script type="text/javascript" src="https://js.iugu.com/v2"></script>
    <script src="<?= base_url("assets/js/main.js") ?>"></script>
    <script>
        function formatReal(int) {
            var tmp = int + '';
            tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
            if (tmp.length > 6)
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

            return tmp;
        }
        $(document).ready(function() {
            
            var estadosApi = "https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome";
            $.getJSON( estadosApi, {
                format: "json"
            })
            .done(function( data ) {
                console.log(data)
                $.each( data, function( i, item ) {
                    
                    var cp = item
                    delete cp['microregiao']
                    delete cp['regiao-imediata']
                    var s = JSON.stringify(cp)
                       
                    var op = `<option data-ob='`+s+`' value='`+item.id+`'>`+item.nome+`</option>`
                    $( "#estados" ).append( op );
                    
                });
                $( "#estados" ).niceSelect('update');

            });
            $( "#estados" ).on("change", function(e) {
                $( "#cidades" ).find("option").not(":first").remove()
                
                const UF = $(this).find("option:selected").val()
                var ob = $(this).find("option:selected").data("ob")
                
                $( "#selected_state" ).val( JSON.stringify(ob) );
                var cidadesApi = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/"+UF+"/municipios?orderBy=nome";
                $.getJSON( cidadesApi, {
                    format: "json"
                })
                .done(function( data ) {
                    console.log(data)
                    $.each( data, function( i, item ) {

                        let cp2 = JSON.parse(JSON.stringify(item))
                        delete cp2['microrregiao']
                        delete cp2['mesorregiao']
                        delete cp2['regiao-imediata']
                        var s = JSON.stringify(cp2)
                        var op = `<option data-ob='`+s+`' value='`+item.id+`'>`+item.nome+`</option>`
                        $( "#cidades" ).append( op );
                        
                        
                    });
                    $( "#cidades" ).niceSelect('update');

                });
            })
            $( "#cidades" ).on("change", function(e) {
                $( "#cidades" ).find("option").not(":first").remove()
                var ob = $(this).find("option:selected").data("ob")
                $( "#selected_city" ).val( JSON.stringify(ob) );
            })
            Iugu.setAccountID("4F8D7432F6621AEF83D433C5E197F32E")
            Iugu.setTestMode(true)
            Iugu.setup()
            var brand
            var ccn

            $(".credit_card_number").on("blur", function(e) {
                ccn = $(this).val()
                console.log(ccn)
                var card_valid = Iugu.utils.validateCreditCardNumber(ccn); 
                console.log(card_valid)
                if(card_valid) {
                    brand = Iugu.utils.getBrandByCreditCardNumber(ccn)
                    console.log(brand)
                }
            })
            $(".credit_card_cvv").on("blur", function(e) {
                var cvv = $(this).val()
                var cvv_valid = Iugu.utils.validateCVV(ccn, brand);
                console.log(cvv_valid)
            })
            jQuery(function($) {
                $("#email").on("blur", function(e) {
                    var form = $(this);
                    e.preventDefault()
                    // Seu código para continuar a submissão
                    // Ex: form.submit();
                    var url = '<?= base_url('/check-cEmail') ?>';
                    // var lb = $(this).parent('div').find(".custom-control-label")
                    // var data = $(form).serializeArray()
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'email': $("#email").val()
                        },
                        // fail: errPost,
                        success: function (response) {
                            console.log(response)
                            // lb.text(response)
                            // $(".custom-control-label").text(text);
                            // $('#imgPreview').attr('src', '');
                            // $('#imgPreview').slideUp(200);
                            // $(".remove-image").slideUp(100);
                            // $('#noImageBox').slideDown(250);
                            // $("#upload-box").slideDown(500);
                        },
                        dataType: 'json',
                        // headers: {'X-Requested-With': 'XMLHttpRequest'}
                    });
                    if ($(this).is(":checked") ) {
                        // console
                    }
                })
                $('#finish-form').on("submit", function(evt) {
                    evt.preventDefault()
                    var form = $(this);
                    var url = '<?= base_url('/api') ?>';
                    var payload = {
                            'call': 'subscriptions',
                            'method': 'POST',
                            'payload': {
                                'plan_identifier': $("#h-plan-id").val(),
                                'customer_id': $("#h-cid").val()
                            }
                        }
                        $.ajax({
                                type: "POST",
                                url: url,
                                data: payload,
                                fail: function(r){
                                    console.log(r)
                                },
                                success: function (response) {
                                    console.log(response)
                                    console.log(typeof response.error)
                                    if(response.error) {
                                        // if(response.error_code == 'UNAUTH' || response.error_code == 'UNAUTH_NE' ) {
                                        //     $(".response_area").html("Autenticação negada. Verifique usuário e senha.")
                                        // } else if(response.error_code == 'NEED_VER') {
                                        // }
                                        /*
                                        var p = new Promise((resolve)=> {
                                            $(form).find(".response_area").html(response.message)
                                            resolve("OK")
                                        })
                                        p.then((e)=> {
                                            console.log(e)
                                            $(form).find(".response_area").slideDown(234);
                                        }).then((e) => {
                                            
                                            
                                            if(response.error_code == 'NEED_VER' || response.error_code == 'NEED_VER_EXP') {
                                                var verBox = $(".verBox")
                                                // console.log($(".optChecked .verBox .custom-message"))
                                                // console.log(response.custom_message)
                                                
                                                
                                                if($(".optChecked").find(".verBox").length == 0) {
                                                    $(verBox).clone().attr('id', 'verLForm').appendTo(".optChecked > div");
                                                    
                                                } else {
                                                    console.log("Not")
                                                }
                                                var pp = new Promise((resolve) => {
                                                    
                                                    setTimeout(() => {
                                                        $(form).find(".response_area").slideUp(432);
                                                        $(form).slideUp(500);
                                                        resolve()
                                                    }, 4000);
                                                })
                                                pp.then(()=> {
                                                    $(".optChecked .verBox .custom-message").html(response.custom_message)
                                                    setTimeout(() => {
                                                        $(".optChecked").find(".verBox").addClass("show")
                                                    }, 500)    
                                                    
                                                })
                                            }
                                        }) */
                                        
                                        
                                    }
                                    // lb.text(response)
                                    // $(".custom-control-label").text(text);
                                    // $('#imgPreview').attr('src', '');
                                    // $('#imgPreview').slideUp(200);
                                    // $(".remove-image").slideUp(100);
                                    // $('#noImageBox').slideDown(250);
                                    // $("#upload-box").slideDown(500);
                                },
                                dataType: 'json',
                                headers: {'X-Requested-With': 'XMLHttpRequest'}
                            });
                });
                $('#payment-form').submit(function(evt) {
                    evt.preventDefault()
                    var form = $(this);
                    var tokenResponseHandler = function(data) {
                        
                        if (data.errors) {
                            alert("Erro salvando cartão: " + JSON.stringify(data.errors));
                        } else {
                            // $("#token").val( data.id );
                            var url = '<?= base_url('/api') ?>';
                            // var lb = $(this).parent('div').find(".custom-control-label")
                            // var data = $(form).serializeArray()
                            var payload = {
                                'call': 'payment_methods',
                                'method': 'POST',
                                'payload': {
                                    token: data.id
                                }
                            }
                            
                            // console.log(data)
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: payload,
                                fail: function(r){
                                    console.log(r)
                                },
                                success: function (response) {
                                    console.log(response)
                                    console.log(typeof response.error)
                                    if(response.error) {
                                        // if(response.error_code == 'UNAUTH' || response.error_code == 'UNAUTH_NE' ) {
                                        //     $(".response_area").html("Autenticação negada. Verifique usuário e senha.")
                                        // } else if(response.error_code == 'NEED_VER') {
                                        // }
                                        var p = new Promise((resolve)=> {
                                            $(form).find(".response_area").html(response.message)
                                            resolve("OK")
                                        })
                                        p.then((e)=> {
                                            console.log(e)
                                            $(form).find(".response_area").slideDown(234);
                                        }).then((e) => {
                                            
                                            
                                            if(response.error_code == 'NEED_VER' || response.error_code == 'NEED_VER_EXP') {
                                                var verBox = $(".verBox")
                                                // console.log($(".optChecked .verBox .custom-message"))
                                                // console.log(response.custom_message)
                                                
                                                
                                                if($(".optChecked").find(".verBox").length == 0) {
                                                    $(verBox).clone().attr('id', 'verLForm').appendTo(".optChecked > div");
                                                    
                                                } else {
                                                    console.log("Not")
                                                }
                                                var pp = new Promise((resolve) => {
                                                    
                                                    setTimeout(() => {
                                                        $(form).find(".response_area").slideUp(432);
                                                        $(form).slideUp(500);
                                                        resolve()
                                                    }, 4000);
                                                })
                                                pp.then(()=> {
                                                    $(".optChecked .verBox .custom-message").html(response.custom_message)
                                                    setTimeout(() => {
                                                        $(".optChecked").find(".verBox").addClass("show")
                                                    }, 500)    
                                                    
                                                })
                                            }
                                        })
                                        
                                        
                                    }
                                    // lb.text(response)
                                    // $(".custom-control-label").text(text);
                                    // $('#imgPreview').attr('src', '');
                                    // $('#imgPreview').slideUp(200);
                                    // $(".remove-image").slideUp(100);
                                    // $('#noImageBox').slideDown(250);
                                    // $("#upload-box").slideDown(500);
                                },
                                dataType: 'json',
                                headers: {'X-Requested-With': 'XMLHttpRequest'}
                            });
                            // form.get(0).submit();
                        }
                        
                        
                    }
                    
                    Iugu.createPaymentToken(this, tokenResponseHandler);
                    return false;
                });
                // $(document).scroll(function() {
                //     console.log("ref", $(".bradcam_text").offset().top)
                //     console.log("ref2", $(".checkoutPage > div > .row:nth(0)").offset().top)
                //     console.log("bradcam_area ", $(".bradcam_area").outerHeight(true))
                //     console.log("header", $("header").outerHeight(true))
                // })
                $(".checkoutPage .authArea .form-check-input").on("click", function(e){
                    // console.log($(this).data("rf"))

                    const that = this
                    // var ref
                    // var html
                    var p = new Promise(function(resolve) {
                        $(".checkoutPage > div > .row").removeClass("optChecked").not($(that).closest(".row"))
                        // console.log($(that).closest(".row").find("form:first"))
                        $(that).closest(".row").addClass("optChecked")
                        // console.log($(".checkoutPage > div > .row:first"))
                        // ref = $(".bradcam_text").offset().top //$("#"+$(this).data("rf")).offset().top
                        // console.log("ref", ref)
                        setTimeout(() => {
                            resolve("OK")
                        }, 200);
                    })
                    
                    p.then(() => {
                        var ref1 = $(".bradcam_area").outerHeight(true)
                        var ref2 = $("header").outerHeight(true)
                        var diff = ref1 + ref2
                        var ref = $(that).closest(".row").offset().top
                        var f = (ref + 180) - diff
                        // console.log(ref1)
                        // console.log(ref2)
                        // console.log(diff)
                        // console.log(ref)
                        // console.log(f)
                        var s = 0
                        if($(this).data("rf") == "registerForm") {
                            s = s + 33
                        } else {
                            console.warn("nao");
                        }
                            

                        $("html").animate({
                            scrollTop: f - s
                        }, 350);
                        // console.log("ref", ref)
                        // console.warn("html", html)
                    }).then(() => {
                        // console.log($(that).closest(".row").find("form:first input:first"))
                        $(that).closest(".row").find("form:first input:first").focus()
                    })

                    
                    // const el = document.querySelector("#"+$(this).data("rf"));
                    // console.log(el)
                    // get scroll position in px
                    // console.log(el.scrollLeft, el.scrollTop);
                    // $("html").animate({scrollTop: 340}, 350);
                    // console.log($("#"+$(this).data("rf")).offset().top)
                    // var container = $('html');
                    // var scrollTo = $("#"+$(this).data("rf"));
                    // // console.log("scrollTo.offset().top ",scrollTo.offset().top )
                    // // console.log("container.offset().top ",container.offset().top )
                    // // console.log("container.scrollTop() ",container.scrollTop() )
                    // // Calculating new position of scrollbar
                    // var position = scrollTo.offset().top 
                    //         - container.offset().top 
                    //         + (container.scrollTop() + 280);
                    
                    
                    // e.target.scrollIntoView(true)
                    /*console.log($("#"+$(this).data("rf")).offset().top)
                    console.log($("#"+$(this).data("rf")))
                    var p = new Promise(function(resolve) {
                        $(".checkoutPage > div > .row").removeClass("optChecked")
                        $(this).closest(".row").addClass("optChecked")
                        resolve("OK")
                    }).then(() => {
                        var container = $(".bradcam_text");
                        var scrollTo = $("#"+$(this).data("rf"));
                
                        // Calculating new position of scrollbar
                        var position = scrollTo.offset().top 
                                - container.offset().top 
                                + container.scrollTop();
                        
                        $("html,body").animate({
                            scrollTop: position
                        }, 350);
                        // $('body').scrollTo($("#"+$(this).data("rf"))); 
                    }) */
                    // var container = $('body');
                    // var scrollTo = $("#"+$(this).data("rf"));
            
                    // // Calculating new position of scrollbar
                    // var position = scrollTo.offset().top 
                    //         - container.offset().top 
                    //         + container.scrollTop();
                    
                    
                    // Setting the value of scrollbar
                    // container.scrollTop(position);
                    // $("html,body").animate({
                    //     scrollTop: $(".optChecked .form-check-input").offset().top + 100
                    // }, 350);
                    // .scrollTo('#target')
                    // $('body').scrollTo($("#"+$(this).data("rf"))); 
                })
                $(".checkoutPage .paymentMethodArea .form-check-input").on("click", function(e){
                    // console.log($(this).data("rf"))

                    const that = this
                    // var ref
                    // var html
                    var p = new Promise(function(resolve) {
                        $(".checkoutPage .paymentMethodArea .optPayment").removeClass("optPaymentChecked").not($(that).closest(".optPayment"))
                        // console.log($(that).closest(".row").find("form:first"))
                        $(that).closest(".optPayment").addClass("optPaymentChecked")
                        // console.log($(".checkoutPage > div > .row:first"))
                        // ref = $(".bradcam_text").offset().top //$("#"+$(this).data("rf")).offset().top
                        // console.log("ref", ref)
                        setTimeout(() => {
                            resolve("OK")
                        }, 200);
                    })
                    
                    p.then(() => {
                        var ref1 = $(".bradcam_area").outerHeight(true)
                        var ref2 = $("header").outerHeight(true)
                        var diff = ref1 + ref2
                        var ref = $(that).closest(".optPayment").offset().top
                        var f = (ref + 180) - diff
                        console.log(ref1)
                        // console.log(ref2)
                        // console.log(diff)
                        // console.log(ref)
                        // console.log(f)
                        var s = 0
                        // if($(this).data("rf") == "registerForm") {
                        //     s = s + 33
                        // } else {
                        //     console.warn("nao");
                        // }
                            

                        $("html").animate({
                            scrollTop: f - s
                        }, 350);
                        // console.log("ref", ref)
                        // console.warn("html", html)
                    }).then(() => {
                        // console.log($(that).closest(".row").find("form:first input:first"))
                        $(that).closest(".optPayment").find("form:first input:first").focus()
                    })

                    
                    // const el = document.querySelector("#"+$(this).data("rf"));
                    // console.log(el)
                    // get scroll position in px
                    // console.log(el.scrollLeft, el.scrollTop);
                    // $("html").animate({scrollTop: 340}, 350);
                    // console.log($("#"+$(this).data("rf")).offset().top)
                    // var container = $('html');
                    // var scrollTo = $("#"+$(this).data("rf"));
                    // // console.log("scrollTo.offset().top ",scrollTo.offset().top )
                    // // console.log("container.offset().top ",container.offset().top )
                    // // console.log("container.scrollTop() ",container.scrollTop() )
                    // // Calculating new position of scrollbar
                    // var position = scrollTo.offset().top 
                    //         - container.offset().top 
                    //         + (container.scrollTop() + 280);
                    
                    
                    // e.target.scrollIntoView(true)
                    /*console.log($("#"+$(this).data("rf")).offset().top)
                    console.log($("#"+$(this).data("rf")))
                    var p = new Promise(function(resolve) {
                        $(".checkoutPage > div > .row").removeClass("optChecked")
                        $(this).closest(".row").addClass("optChecked")
                        resolve("OK")
                    }).then(() => {
                        var container = $(".bradcam_text");
                        var scrollTo = $("#"+$(this).data("rf"));
                
                        // Calculating new position of scrollbar
                        var position = scrollTo.offset().top 
                                - container.offset().top 
                                + container.scrollTop();
                        
                        $("html,body").animate({
                            scrollTop: position
                        }, 350);
                        // $('body').scrollTo($("#"+$(this).data("rf"))); 
                    }) */
                    // var container = $('body');
                    // var scrollTo = $("#"+$(this).data("rf"));
            
                    // // Calculating new position of scrollbar
                    // var position = scrollTo.offset().top 
                    //         - container.offset().top 
                    //         + container.scrollTop();
                    
                    
                    // Setting the value of scrollbar
                    // container.scrollTop(position);
                    // $("html,body").animate({
                    //     scrollTop: $(".optChecked .form-check-input").offset().top + 100
                    // }, 350);
                    // .scrollTo('#target')
                    // $('body').scrollTo($("#"+$(this).data("rf"))); 
                })
                $(document).on("submit", ".optChecked .verForm, .optChecked #verLForm form", function(e) {
                    var form = $(this);
                    console.log(form)
                    e.preventDefault()
                    // Seu código para continuar a submissão
                    // Ex: form.submit();
                    var url = '<?= base_url('/check-code') ?>';
                    // var lb = $(this).parent('div').find(".custom-control-label")
                    // var data = $(form).serializeArray()
                    var payload = {
                        code: $(".confp1").val() + "" + $(".confp2").val()
                    }
                    
                    // console.log(data)
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: payload,
                        fail: function(r){
                            console.log(r)
                        },
                        success: function (response) {
                            console.log(response)
                            console.log(typeof response.error)
                            if(response.error) {
                                // if(response.error_code == 'UNAUTH' || response.error_code == 'UNAUTH_NE' ) {
                                //     $(".response_area").html("Autenticação negada. Verifique usuário e senha.")
                                // } else if(response.error_code == 'NEED_VER') {
                                // }
                                var p = new Promise((resolve)=> {
                                    $(form).find(".response_area").html(response.message)
                                    resolve("OK")
                                })
                                p.then((e)=> {
                                    console.log(e)
                                    $(form).find(".response_area").slideDown(234);
                                }).then((e) => {
                                    
                                    
                                    if(response.error_code == 'NEED_VER' || response.error_code == 'NEED_VER_EXP') {
                                        var verBox = $(".verBox")
                                        // console.log($(".optChecked .verBox .custom-message"))
                                        // console.log(response.custom_message)
                                        
                                        
                                        if($(".optChecked").find(".verBox").length == 0) {
                                            $(verBox).clone().attr('id', 'verLForm').appendTo(".optChecked > div");
                                            
                                        } else {
                                            console.log("Not")
                                        }
                                        var pp = new Promise((resolve) => {
                                            
                                            setTimeout(() => {
                                                $(form).find(".response_area").slideUp(432);
                                                $(form).slideUp(500);
                                                resolve()
                                            }, 4000);
                                        })
                                        pp.then(()=> {
                                            $(".optChecked .verBox .custom-message").html(response.custom_message)
                                            setTimeout(() => {
                                                $(".optChecked").find(".verBox").addClass("show")
                                            }, 500)    
                                            
                                        })
                                    }
                                })
                                
                                
                            }
                            // lb.text(response)
                            // $(".custom-control-label").text(text);
                            // $('#imgPreview').attr('src', '');
                            // $('#imgPreview').slideUp(200);
                            // $(".remove-image").slideUp(100);
                            // $('#noImageBox').slideDown(250);
                            // $("#upload-box").slideDown(500);
                        },
                        dataType: 'json',
                        // headers: {'X-Requested-With': 'XMLHttpRequest'}
                    });
                    if ($(this).is(":checked") ) {
                        // console
                    }
                })
                $("#registerForm").on("submit", function(e) {
                    var form = $(this);
                    e.preventDefault()
                    // Seu código para continuar a submissão
                    // Ex: form.submit();
                    var url = '<?= base_url('/register') ?>';
                    // var lb = $(this).parent('div').find(".custom-control-label")
                    var data = $(form).serializeArray()
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        // fail: errPost,
                        success: function (response) {
                            console.log(response)
                            if(!response.error) {
                                
                                var p = new Promise(function(resolve) {
                                    $(".optChecked .verBox").addClass("show")
                                    $(".optChecked .dataBox").addClass("hide")
                                    $(".optChecked .custom-message").html(response.custom_message)
                                    // $("html").animate({scrollTop: 340}, 350);
                                    setTimeout(() => {
                                        resolve("OK")
                                    }, 200);
                                })
                                p.then(() => {
                                    $(".dataBox.hide").slideUp(200)
                                    var ref1 = $(".bradcam_area").outerHeight(true)
                                    var ref2 = $("header").outerHeight(true)
                                    var diff = ref1 + ref2
                                    var ref = $(".verBox").offset().top
                                    var f = (ref + 180) - diff
                                    

                                    $("html").animate({
                                        scrollTop: f
                                    }, 350);
                                }).then(() => {
                                    setTimeout(() => {
                                        $(".checkoutPage .form-check-input").addClass("disabled")
                                        $(".checkoutPage .form-check-input").attr("disabled", true)
                                        $(".verBox").find("form:first input:first").focus()    
                                    }, 360);
                                    
                                })

                            }
                            if(response.error) {
                                if(response.error_code == 'REQ_FIELDS') {
                                    console.log(response.errors)
                                    $.each(response.errors, function(f,m) {
                                        console.log(f)
                                        console.log(m)
                                        var el = $(form).find("input[name='"+f+"']")
                                        $("<div class='dyn-response'><i class='fa fa-exclamation' aria-hidden='true'></i><span>"+m+"</span></div>").insertAfter(el)
                                        console.log(el)
                                        setTimeout(() => {
                                            $(".dyn-response").addClass("show")
                                        }, 700);
                                    })
                                }
                            }
                            // lb.text(response)
                            // $(".custom-control-label").text(text);
                            // $('#imgPreview').attr('src', '');
                            // $('#imgPreview').slideUp(200);
                            // $(".remove-image").slideUp(100);
                            // $('#noImageBox').slideDown(250);
                            // $("#upload-box").slideDown(500);
                        },
                        dataType: 'json',
                        // headers: {'X-Requested-With': 'XMLHttpRequest'}
                    });
                    if ($(this).is(":checked") ) {
                        // console
                    }
                })

                $("#loginForm").on("submit", function(e) {
                    var form = $(this);
                    console.log("enra")
                    e.preventDefault()
                    $(form).find(".logitBtn").addClass('disabled')
                    $(form).find(".logitBtn").attr('disabled', true)
                    $(form).find(".logitBtn .textPlace").html('Autenticando')
                    $(form).find(".logitBtn .iconPlace").html('<i class="fa fa-circle-o-notch fa-spin fa-1x"></i>')
                    // Seu código para continuar a submissão
                    // Ex: form.submit();
                    var url = '<?= base_url('/logar') ?>';
                    // var lb = $(this).parent('div').find(".custom-control-label")
                    var data = $(form).serializeArray()
                    console.log(data)
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        fail: function(r){
                            console.log(r)
                            $(form).find(".logitBtn").removeClass('disabled')
                            $(form).find(".logitBtn").removeAttr('disabled')
                            $(form).find(".logitBtn .textPlace").html('Continuar')
                            $(form).find(".logitBtn .iconPlace").html('<i class="fa fa-chevron-right fa-1x"></i>')
                    
                        },
                        success: function (response) {
                            console.log(response)
                            console.log(typeof response.error)
                            if(response.error) {
                                // if(response.error_code == 'UNAUTH' || response.error_code == 'UNAUTH_NE' ) {
                                //     $(".response_area").html("Autenticação negada. Verifique usuário e senha.")
                                // } else if(response.error_code == 'NEED_VER') {
                                // }
                                if(response.error_code == 'NEED_VER' || response.error_code == 'NEED_VER_EXP') {
                                    var verBox = $(".verBox")
                                    // console.log($(".optChecked .verBox .custom-message"))
                                    // console.log(response.custom_message)
                                    
                                    
                                    if($(".optChecked").find(".verBox").length == 0) {
                                        $(verBox).clone().attr('id', 'verLForm').appendTo(".optChecked > div");
                                        
                                    } else {
                                        console.log("Not")
                                    }
                                    var pp = new Promise((resolve) => {
                                        
                                        setTimeout(() => {
                                            $(form).find(".response_area").removeClass("show");
                                            $(form).slideUp(500);
                                            resolve()
                                        }, 4000);
                                    })
                                    pp.then(()=> {
                                        $(".optChecked .verBox .custom-message").html(response.custom_message)
                                        setTimeout(() => {
                                            $(".optChecked").find(".verBox").addClass("show")
                                        }, 500)    
                                        $(form).find(".logitBtn").removeClass('disabled')
                                        $(form).find(".logitBtn").removeAttr('disabled')
                                        $(form).find(".logitBtn .textPlace").html('Continuar')
                                        $(form).find(".logitBtn .iconPlace").html('<i class="fa fa-chevron-right fa-1x"></i>')
                                    })
                                }
                                if(response.error_code == 'UNAUTH' || response.error_code == 'UNAUTH_NE') {
                                    // console.log($(".optChecked .verBox .custom-message"))
                                    // console.log(response.custom_message)
                                    var pp = new Promise((resolve) => {
                                        $(".optChecked").find(".response_area").html(response.message)
                                        $(".optChecked").find(".response_area").addClass("field_error").addClass("show");
                                        setTimeout(() => {
                                            $(".optChecked").find(".response_area").removeClass("show").removeClass("field_error");
                                            resolve(form)
                                        }, 4000);
                                    })
                                    pp.then((form)=> {
                                        $(form).find("input:first").focus()
                                        console.log($(form))
                                        console.log($(form).find("input:first"))
                                        // $(".optChecked .verBox .custom-message").html(response.custom_message)
                                        // setTimeout(() => {
                                        //     $(".optChecked").find(".verBox").addClass("show").addClass("field-error")
                                        // }, 500)    
                                        $(form).find(".logitBtn").removeClass('disabled')
                                        $(form).find(".logitBtn").removeAttr('disabled')
                                        $(form).find(".logitBtn .textPlace").html('Continuar')
                                        $(form).find(".logitBtn .iconPlace").html('<i class="fa fa-chevron-right fa-1x"></i>')
                                    })
                                    
                                } 
                                
                                
                            } else {
                                var pp = new Promise((resolve) => {
                                    $(".optChecked").find(".response_area").html(response.message)
                                    $(".optChecked").find(".response_area").addClass("show");
                                    setTimeout(() => {
                                        
                                        resolve(form)
                                    }, 2000);
                                })
                                pp.then((form)=> {
                                    
                                    // $(".optChecked .verBox .custom-message").html(response.custom_message)
                                    // setTimeout(() => {
                                    //     $(".optChecked").find(".verBox").addClass("show").addClass("field-error")
                                    // }, 500)    
                                    // $(form).find(".logitBtn").removeClass('disabled')
                                    // $(form).find(".logitBtn").removeAttr('disabled')
                                    $(form).find(".logitBtn .textPlace").html(response.message)
                                    $(form).find(".logitBtn .iconPlace").html('<i class="fa fa-check-circle-o fa-1x"></i>')
                                    
                                    setTimeout(() => {
                                        $(".optChecked").find(".response_area").removeClass("show")
                                    }, 300);
                                    setTimeout(() => {
                                        $(form).slideUp(500)
                                        location.reload();
                                    }, 600);
                                })
                            }
                            // lb.text(response)
                            // $(".custom-control-label").text(text);
                            // $('#imgPreview').attr('src', '');
                            // $('#imgPreview').slideUp(200);
                            // $(".remove-image").slideUp(100);
                            // $('#noImageBox').slideDown(250);
                            // $("#upload-box").slideDown(500);
                        },
                        dataType: 'json',
                        // headers: {'X-Requested-With': 'XMLHttpRequest'}
                    });
                    if ($(this).is(":checked") ) {
                        // console
                    }
                })
            });
            $.each($(".planPrice"), function(i, p) {
                var unformatted = $(p).text()
                var unformatted = unformatted / 100;
                // var f = formatReal(unformatted);
                var f = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(unformatted)
                // console.log(unformatted)
                console.log(f)
                $(p).text(f)
            })

        })
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            disableDaysOfWeek: [0, 0],
            //     icons: {
            //      rightIcon: '<span class="fa fa-caret-down"></span>'
            //  }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }

        });
        var timepicker = $('#timepicker').timepicker({
            format: 'HH.MM'
        });
    </script>
</body>

</html>