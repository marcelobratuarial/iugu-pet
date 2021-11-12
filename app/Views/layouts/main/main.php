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
            Iugu.setAccountID("4F8D7432F6621AEF83D433C5E197F32E")
            Iugu.setTestMode(true)
            Iugu.setup()
            
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



                $('#payment-form').submit(function(evt) {
                    evt.preventDefault()
                    var form = $(this);
                    var tokenResponseHandler = function(data) {
                        
                        if (data.errors) {
                            alert("Erro salvando cartão: " + JSON.stringify(data.errors));
                        } else {
                            $("#token").val( data.id );
                            // form.get(0).submit();
                        }
                        
                        
                    }
                    
                    Iugu.createPaymentToken(this, tokenResponseHandler);
                    return false;
                });
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