<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>BPFipe</title>
	<!-- <meta name="description" content="The small framework with powerful features"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- STYLES -->

	<style {csp-style-nonce}>
		
		.lp-side {
			display: flex;
			align-items: center;
			height: 100vh;
		}
		.lp-form {
			padding: 50px 10px;
			/* height: 100vh; */
			display: flex;
			flex-direction: column;
		}
		.form-box {
			padding: 50px 10px;
/* 			
			display: flex;
			justify-content: center;
			align-items: center;
			align-content: center; */
		}
		.collection-item div span {
			text-overflow: ellipsis;
		}

		.collection-box.show {

			max-height: 600px;
			transition: all 0.7s ease-in;
			opacity: 1;
		}
		.collection {
			overflow:unset !important;
		}
		.collection-box {
			opacity: 0;
			height: auto;
			max-height: 0px;
			transition: all 0.7s ease-out;
		}

		.fullDetails.show, .year-box.show, .brand-box.show {
			max-width: 600px;
			max-height: 600px;
			transition: all 0.7s ease-in;
			opacity: 1;
		}

		.fullDetails, .year-box, .brand-box {
			opacity: 0;
			width: auto;
			max-width: 0px;
			height: auto;
			max-height: 0px;
			transition: all 0.2s ease-out;
		}

		.fullDetails.error table,
		.fullDetails.error p {
			opacity: 0;
			width: 0;
			height: 0;
		}
		.collection-item.active {
			color: #fff !important;
			background-color: #1a237e !important;
		}
		.collection-item {
			cursor: pointer;
			position: relative;
			transition: background-color 1s;
		}
		.collection li.collection-item:hover {
			color: #fff;
			background-color: #1a237e;
			transition: background-color 1s;
		}
		.collection li.collection-item.active::after {
			right: 0px !important;
			top: 10px !important;
			color: #fff;
		}
		.collection li.collection-item::after {
			color: #1a237e;
			font-family: 'Material Icons';
			content: "double_arrow";
			position: absolute;
			right: 10px;
			top: 10px;
			transition: right 0.6s ease-out, color 1s;
		}
		.collection li.collection-item:hover::after {
			right: 0px;
			color: #fff;
			transition: right 0.2s ease-in-out, color 1s;
		}
		.overlay {
			z-index: 9999999;
			display: none;
			opacity: 0;
			width: auto;
			max-width: 0px;
			height: auto;
			max-height: 0px;
			transition: all 0.2s ease-out;
		}
		.overlay.show {
			display: block;
			opacity: 1;
			transition: opacity 0.5s ease-in;
			color: #fff;
			position: absolute;
			width: 100vw;
			height: 100vh;
			max-width: 100vw;
			max-height: 100vh;
			top: 0;
			left: 0;
			background-color: rgba(0, 0, 0, 0.6);
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}
	</style>
</head>

<body>

	<!-- HEADER: MENU + HEROE SECTION -->
	<header>
	<?php /*
		<div class="menu">
			<ul>
				<li class="logo"><a href="https://codeigniter.com" target="_blank">
						<img height="44" title="CodeIgniter Logo" alt="Visit CodeIgniter.com official website!" src="http://192.168.10.214/brasilatuarial/new/assets/img/logo/logo.png"></a>
				</li>
				<!-- <li class="menu-toggle">
				<button onclick="toggleMenu();">&#9776;</button>
			</li>
			<li class="menu-item hidden"><a href="#">Home</a></li>
			<li class="menu-item hidden"><a href="https://codeigniter4.github.io/userguide/" target="_blank">Docs</a>
			</li>
			<li class="menu-item hidden"><a href="https://forum.codeigniter.com/" target="_blank">Community</a></li>
			<li class="menu-item hidden"><a
					href="https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md" target="_blank">Contribute</a>
			</li> -->
			</ul>
		</div>

		<div class="heroe">

		<h1>Welcome to CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?></h1>

		<h2>The small framework with powerful features</h2>

	</div> */ ?>

	</header>
	
	<!-- CONTENT -->
	<div class="overlay">
	<img height="44" title="Logo" alt="" src="<?=base_url("assets/img/loading.gif")?>">
		<h6>Aguarde...</h6>
	</div>
	<section>
		<div class="container">
			<div class="row">
				<div class="lp-side col s3">
				<img height="44" title="Logo" alt="" src="<?=base_url("assets/img/logo.png")?>">
				</div>
				<div class="lp-form col s9">
					
					<div class="form-box">
						<div class="row center-align">
							<?php /*
							<div class="input-field col s12">
								<select id="reference">
									<option value="">Selecione</option>
									<option value="<?= $datas['ConsultarTabelaDeReferencia'][0]->Codigo ?>" selected><?= $datas['ConsultarTabelaDeReferencia'][0]->Mes ?></option>

								</select>
								<label>Tabela de Referência: <span class="selectedReference"></span></label>
							</div> */ ?>
							<label>Tabela de Referência: <span class="selectedReference"><?= $datas['ConsultarTabelaDeReferencia'][0]->Mes ?></span></label>
							<input type="hidden" name="reference"  value="<?= $datas['ConsultarTabelaDeReferencia'][0]->Codigo ?>" id="reference">
						</div>
						<div class="row center-align">
							<div style="display: flex; flex-direction: row;justify-content: space-evenly;">
								<label>
									<input value="1" name="tipo_v" type="radio" />
									<span>Carro</span>
								</label>
								<label>
									<input value="2" name="tipo_v" type="radio" />
									<span>Moto</span>
								</label>
								<label>
									<input value="3" name="tipo_v" type="radio" />
									<span>Caminhão</span>
								</label>
							</div>
							<span class="selectedTipo"></span>
						</div>
						<div class="row center-align">
							<div class="brand-box input-field col s6">
								<select name="" id="brands">
									<option value="" class="defB">Selecione</option>

									<?php
									foreach ($datas['ConsultarMarcas'] as $marca) :
									?>
										<option value="<?= $marca->Value ?>"><?= $marca->Label ?></option>
									<?php endforeach ?>
								</select>
								<label>Marca: <span class="selectedBrand"></span></label>
							</div>
							<div class="year-box input-field col s6">
								<select name="" id="year">
									<option value="">Selecione</option>

									<?php
									for ($a = 2021; $a >= 1950; $a--) :
									?>
										<option value="<?= $a ?>"><?= $a ?></option>
									<?php endfor; ?>
								</select>
								<label>Ano</label>
							</div>
							<!-- <div class="combustivel-box input-field col s3">
							<select name="" id="combustivel">
								<option selected value="1">Gasolina</option>
								<option value="2">Álcool</option>
								<option value="3">Diesel</option>
							</select>
						</div> -->
						</div>



						<div class="row collection-box">
							<div class="col s6" style="max-height: 500px; overflow: auto">
								<ul class="collection">
									<!-- <li class="collection-header"><h4>Veículos</h4></li> -->

								</ul>
							</div>
							<div class="col s6">
								<div class="fullDetails white-text card blue-grey darken-1">
									<div class="card-content">
										<span class="card-title center-align"></span>
										<p></p>
									</div>
									<!-- <div class="card-action">
									<a href="#">This is a link</a>
									<a href="#">This is a link</a>
								</div> -->
									<table style="width:100%" class=" white-text">
										<tr>
											<th class="right-align">Marca:</th>
											<td id="Vmarca"></td>
										</tr>
										<tr>
											<th class="right-align">Modelo:</th>
											<td id="Vmodelo"></td>
										</tr>
										<tr>
											<th class="right-align">Ano:</th>
											<td id="Vano"></td>
										</tr>
										<tr>
											<th class="right-align">Combustível:</th>
											<td id="Vcombustivel"></td>
										</tr>
										<tr>
											<th class="right-align">Código FIPE:</th>
											<td id="Vfipe"></td>
										</tr>

									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			
			
			
			
		</div>

	</section>

	<!-- <div class="further">

	<section>

		<h1>Go further</h1>

		<h2>
			<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><rect x='32' y='96' width='64' height='368' rx='16' ry='16' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/><line x1='112' y1='224' x2='240' y2='224' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='112' y1='400' x2='240' y2='400' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><rect x='112' y='160' width='128' height='304' rx='16' ry='16' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/><rect x='256' y='48' width='96' height='416' rx='16' ry='16' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/><path d='M422.46,96.11l-40.4,4.25c-11.12,1.17-19.18,11.57-17.93,23.1l34.92,321.59c1.26,11.53,11.37,20,22.49,18.84l40.4-4.25c11.12-1.17,19.18-11.57,17.93-23.1L445,115C443.69,103.42,433.58,94.94,422.46,96.11Z' style='fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px'/></svg>
			Learn
		</h2>

		<p>The User Guide contains an introduction, tutorial, a number of "how to"
			guides, and then reference documentation for the components that make up
			the framework. Check the <a href="https://codeigniter4.github.io/userguide"
			target="_blank">User Guide</a> !</p>

		<h2>
			<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg>
			Discuss
		</h2>

		<p>CodeIgniter is a community-developed open source project, with several
			 venues for the community members to gather and exchange ideas. View all
			 the threads on <a href="https://forum.codeigniter.com/"
			 target="_blank">CodeIgniter's forum</a>, or <a href="https://codeigniterchat.slack.com/"
			 target="_blank">chat on Slack</a> !</p>

		<h2>
			 <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><line x1='176' y1='48' x2='336' y2='48' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><line x1='118' y1='304' x2='394' y2='304' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path d='M208,48v93.48a64.09,64.09,0,0,1-9.88,34.18L73.21,373.49C48.4,412.78,76.63,464,123.08,464H388.92c46.45,0,74.68-51.22,49.87-90.51L313.87,175.66A64.09,64.09,0,0,1,304,141.48V48' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg>
			 Contribute
		</h2>

		<p>CodeIgniter is a community driven project and accepts contributions
			 of code and documentation from the community. Why not
			 <a href="https://codeigniter.com/en/contribute" target="_blank">
			 join us</a> ?</p>

	</section>

</div> -->

	<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->


	<!-- SCRIPTS -->
	<script src="<?= base_url("public/js/jquery-3.6.0.min.js") ?>"></script>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

	<script>
		var response;
		$(document).ready(function() {
			$('select').formSelect();


			var ref;
			var tipo;
			var brand;
			var year;
			var data;
			// var combustivel;
			// var brand;
			// $("#reference").on("change", function() {
			// 	ref = $("#reference").val() //$("#reference option:selected").val();
			// 	$(".selectedReference").text(ref)
			// });

			$("input[name='tipo_v']").on("change", function() {
				$(".overlay").addClass("show")
				tipo = $("input[name=tipo_v]:checked").val();
				ref = $("#reference").val() // $("#reference option:selected").val();
				
				$(".collection-box, .year-box, .brand-box, .fullDetails").removeClass("show")
				

				console.log(tipo)
				// $(".selectedTipo").text(tipo)
				data = {
					act: "ConsultarMarcas",
					payload: {
						codigoTabelaReferencia: ref,
						codigoTipoVeiculo: tipo
					}
				}
				find(data).then((e) => {
					console.log(e)
					$("#brands option").not(':first').remove();


					var instance = M.FormSelect.getInstance($("#brands"));
					instance.destroy()
					$.each(e, function(i, item) {

						$("#brands").append($('<option>', {
							value: item.Value,
							text: item.Label
						}))
					})
					$("#brands").formSelect();
					$(".brand-box").addClass("show")
					
					// console.log(instance)

				}).then(()=>{
					$(".overlay").removeClass("show")
				})

			});

			$("#brands").on("change", function() {
				$(".overlay").addClass("show")

				brand = $("#brands option:selected").val();
				tipo = $("input[name=tipo_v]:checked").val();
				$(".selectedBrand").text(brand)
				const p1 = new Promise((resolve, reject) => {
					$(".collection-box, .year-box, .fullDetails").removeClass("show")
				
					resolve();
				});
				p1.then(() => {
					$(".collection .collection-item").remove()
				})

				// ref = $("#year option:selected").val();
				data = {
					act: "ConsultarModelos",
					payload: {
						codigoTabelaReferencia: ref,
						codigoTipoVeiculo: tipo,
						codigoMarca: brand
					}
				}

				// console.log(data)
				find(data).then(function(veh) {
					console.log("ddssasdf", veh)

					$("#year option").not(':first').remove();


					var instance = M.FormSelect.getInstance($("#year"));
					instance.destroy()
					$.each(veh.Anos, function(i, item) {

						$("#year").append($('<option>', {
							value: item.Value,
							text: item.Label
						}))
					})
					$("#year").formSelect();



					$.each(veh.Modelos, (i, item) => {
						var nItem = `<li data-idref="` + item.Value + `" class="collection-item">
						<div><span>` + item.Label + `</span>
						</div>
					</li>`
						$(".collection").append(nItem)

						// console.log(item.Label)
					})
					$(".collection-box, .year-box").addClass("show")
					
				}).then(() => {
					$(".overlay").removeClass("show")
				})
			});
			$(".collection").on("click", ".collection-item", function() {
				$(".overlay").addClass("show")
				ref = $("#reference").val() // $("#reference option:selected").val();
				tipo = $("input[name=tipo_v]:checked").val();
				brand = $("#brands option:selected").val();
				year = $("#year option:selected").val();
				// combustivel = $("#combustivel option:selected").val();
				modelId = $(this).data("idref")
				$("li.collection-item").removeClass("active")
				$(this).addClass("active");
				// console.log(combustivel)
				$(".fullDetails").removeClass("show")
				console.log(year)
				var [Y, C] = year.split("-")
				console.log(Y)
				console.log(C)

				data = {
					act: "ConsultarValorComTodosParametros",
					payload: {
						"codigoTabelaReferencia": ref,
						"codigoTipoVeiculo": tipo,
						"codigoMarca": brand,
						"ano": year,
						"codigoTipoCombustivel": C,
						"anoModelo": Y,
						"codigoModelo": modelId,
						"tipoConsulta": "tradicional"
					}
				}
				find(data).then(function(veh) {
					console.log("testeeeee", veh)
					if (typeof veh.erro !== 'undefined') {
						console.log("error")
						$(".fullDetails .card-title").text("Nenhum resultado")
						$(".fullDetails").addClass("error").addClass("show")
							.removeClass("blue-grey").removeClass("darken-1")
							.addClass("red").addClass("darken-4")
						// $(".combustivel-box").removeClass("show")
					} else {

						const p1 = new Promise((resolve, reject) => {
							$(".fullDetails .card-title").text(veh.Valor)
							$(".fullDetails #Vmarca").text(veh.Marca)
							$(".fullDetails #Vmodelo").text(veh.Modelo)
							$(".fullDetails #Vano").text(veh.AnoModelo)
							$(".fullDetails #Vfipe").text(veh.CodigoFipe)
							$(".fullDetails #Vcombustivel").text(veh.Combustivel)
							// $(".fullDetails .card-title").text(veh.Modelo)
							resolve();
						});
						p1.then(() => {
							// $(".collection .collection-item").remove()

							$(".fullDetails").removeClass("error")
								.addClass('show')
								.addClass("blue-grey").addClass("darken-1")
								.removeClass("red").removeClass("darken-4")
						})
					}
				}).then(() =>{
					$(".overlay").removeClass("show")
				})
			})
			$("#year").on("change", function() {
				$(".overlay").addClass("show")
				year = $("#year option:selected").val();
				tipo = $("input[name=tipo_v]:checked").val();
				const p1 = new Promise((resolve, reject) => {
					$(".collection-box, .fullDetails").removeClass("show")
				
					resolve();
				});
				p1.then(() => {
					$(".collection .collection-item").remove()
					// $(".combustivel-box").addClass("show")
				})

				// ref = $("#year option:selected").val();
				console.log(year)
				var [Y, C] = year.split("-")
				data = {
					act: "ConsultarModelosAtravesDoAno",
					payload: {
						codigoTabelaReferencia: ref,
						codigoTipoVeiculo: tipo,
						codigoMarca: brand,
						anoModelo: Y
					}
				}

				// console.log(data)
				find(data).then(function(veh) {
					// console.log("ddssasdf", veh)

					$.each(veh, (i, item) => {
						var nItem = `<li data-idref="` + item.Value + `" class="collection-item">
						<div><span>` + item.Label + `</span>
							
						</div>
					</li>`
						$(".collection").append(nItem)

						// console.log(item.Label)
					})
					$(".collection-box").addClass("show")
				}).then(()=>{
					$(".overlay").removeClass("show")
				})
				// console.log(response)
				// $.each(res, function(a,b) {
				// 	console.log(b)
				// })
				// $(".selectedBrand").text(ref)

			});
		});
		// async function elHideReset(els) {
		// 	$(".collection-box").removeClass("show")
		// }
		async function find(payload) {
			// console.log(payload)
			var result;
			try {
				result = await $.ajax({
					type: "POST",
					data: payload,
					url: base_url + "/api",
					dataType: 'json',
					success: (r) => {
						// $('#contactForm :input').attr('disabled', 'disabled');
						// $('#contactForm').fadeTo( "slow", 1, function() {
						// 	$(this).find(':input').attr('disabled', 'disabled');
						// 	$(this).find('label').css('cursor','default');
						// 	$('#contactModal').fadeIn()
						// 	$('.modal').modal('hide');
						// 	$('#contactModal').modal("show")

						// 	$('#contactForm')[0].reset()
						// 	$(this).find(':input').attr('disabled', false);
						// })
						// console.log(r)
						response = r
					},
					error: (e) => {
						console.warn("erro", e)
						// $('#contactForm').fadeTo( "slow", 1, function() {
						// 	$('#error').fadeIn()
						// 	$('.modal').modal('hide');
						// 	$('#error').modal('show');
						// })
						response = e
					}
				})
				return result;
			} catch (error) {
				console.error(error);
			}
			console.warn(response)

		}

		
	</script>
	<script>
		var base_url = '<?= base_url('/') ?>';
	</script>
	<!-- -->

</body>

</html>