<?php 
include "../config.php";

$s = "SELECT a.* from tb_prodi";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Infografis PMB</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min2.css">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="js/mdb.js"></script>
  <script src="js/chart.js"></script>

</head>
<body>
 
<div class="container">
  <h2>Infografis PMB</h2>
  Tahun Ajaran 
  <select>
  	<option selected>2019</option>
  	<option>2020</option>	
  	<option>2021</option>	
  	<option>All</option>	
  </select>
  <p>Show Options</p>
  <small>
  	<div id="opsi_check" class="row">
  		<div>&nbsp;&nbsp;&nbsp;&nbsp;<input id="check_per_jenis_kelamin" type="checkbox"> 
  		<label for="check_per_jenis_kelamin">Per Jenis Kelamin</label></div>
  		<div>&nbsp;&nbsp;&nbsp;&nbsp;<input id="check_per_prodi" type="checkbox"> 
  		<label for="check_per_prodi">Per Prodi</label></div>
  		<div>&nbsp;&nbsp;&nbsp;&nbsp;<input id="check_per_kab" type="checkbox"> 
  		<label for="check_per_kab">Per Kabupaten</label></div>
  		<div>&nbsp;&nbsp;&nbsp;&nbsp;<input id="check_per_kec_kota_crb" type="checkbox"> 
  		<label for="check_per_kec_kota_crb">Per Kecamatan Kota Cirebon</label></div>
  		<div>&nbsp;&nbsp;&nbsp;&nbsp;<input id="check_per_kec_kab_crb" type="checkbox"> 
  		<label for="check_per_kec_kab_crb">Per Kecamatan Kab Cirebon</label></div>
  	</div>
  </small>
  <hr>

 	<div class="row">
 		<div class="col-md-6">
 			<div class="panel panel-default">
 			  <div class="panel-heading">Jumlah Mahasiswa per Prodi</div>
 			  <div class="panel-body">
 			  	<input type="hidden" value="<?=$jumlah_mahasiswa?>">
 			  	<canvas id="jumlah_mahasiswa" style="max-width: 500px;"></canvas>
 			  	<script type="text/javascript">
 			  		var ctx = document.getElementById("jumlah_mahasiswa").getContext('2d');
 			  		var jumlah_mahasiswa = new Chart(ctx, {
 			  			type: 'bar',
 			  			data: {
 			  				labels: ["TI", "RPL", "SI", "MI", "KA"],
 			  				datasets: [{
 			  					label: 'Mahasiswa IKMI per Prodi',
 			  					data: [82, 19, 3, 5, 2],
 			  					backgroundColor: [
 			  					'rgba(255, 99, 132, 0.2)',
 			  					'rgba(54, 162, 235, 0.2)',
 			  					'rgba(255, 206, 86, 0.2)',
 			  					'rgba(75, 192, 192, 0.2)',
 			  					'rgba(153, 102, 255, 0.2)',
 			  					'rgba(255, 159, 64, 0.2)'
 			  					],
 			  					borderColor: [
 			  					'rgba(255,99,132,1)',
 			  					'rgba(54, 162, 235, 1)',
 			  					'rgba(255, 206, 86, 1)',
 			  					'rgba(75, 192, 192, 1)',
 			  					'rgba(153, 102, 255, 1)',
 			  					'rgba(255, 159, 64, 1)'
 			  					],
 			  					borderWidth: 1
 			  				}]
 			  			},
 			  			options: {
 			  				scales: {
 			  					yAxes: [{
 			  						ticks: {
 			  							beginAtZero: true
 			  						}
 			  					}]
 			  				}
 			  			}
 			  		});
 			  	</script>

 			  </div>
 			</div>
 		</div>


 		<div class="col-md-6">
 			<div class="panel panel-default">
 			  <div class="panel-heading">Jumlah Mahasiswa per Kabupaten</div>
 			  <div class="panel-body">
 			  	<input type="hidden" value="<?=$by_kabupaten?>">
 			  	<canvas id="by_kabupaten" style="max-width: 500px;"></canvas>
 			  	<script type="text/javascript">
 			  		var ctx = document.getElementById("by_kabupaten").getContext('2d');
 			  		var by_kabupaten = new Chart(ctx, {
 			  			type: 'bar',
 			  			data: {
 			  				labels: ["Kota Crb", "Kab Crb", "Majalengka", "Kuningan", "Indramayu","Lainnya"],
 			  				datasets: [{
 			  					label: 'Jumlah Mahasiswa per Kabupaten',
 			  					data: [41, 101, 7, 5, 5,23],
 			  					backgroundColor: [
 			  					'rgba(247, 62, 244, 0.2)',
 			  					'rgba(54, 162, 235, 0.2)',
 			  					'rgba(153, 102, 255, 0.2)',
 			  					'rgba(153, 102, 255, 0.2)',
 			  					'rgba(153, 102, 255, 0.2)',
 			  					'rgba(255, 159, 64, 0.2)'
 			  					],
 			  					borderColor: [
 			  					'rgba(255,99,132,1)',
 			  					'rgba(54, 162, 235, 1)',
 			  					'rgba(75, 192, 192, 1)',
 			  					'rgba(75, 192, 192, 1)',
 			  					'rgba(75, 192, 192, 1)',
 			  					'rgba(255, 159, 64, 1)'
 			  					],
 			  					borderWidth: 1
 			  				}]
 			  			},
 			  			options: {
 			  				scales: {
 			  					yAxes: [{
 			  						ticks: {
 			  							beginAtZero: true
 			  						}
 			  					}]
 			  				}
 			  			}
 			  		});
 			  	</script>

 			  </div>
 			</div>
 		</div>
 	
 	</div>







 	<div class="row">
 		<div class="col-md-6">
 			<div class="panel panel-default">
 			  <div class="panel-heading">Per Kecamatan Kota Cirebon</div>
 			  <div class="panel-body">
 			  	<input type="hidden" value="<?=$by_kota_cirebon?>">
 			  	<canvas id="by_kota_cirebon" style="max-width: 500px;"></canvas>
 			  	<script type="text/javascript">
 			  		new Chart(document.getElementById("by_kota_cirebon"), {
 			  			"type": "horizontalBar",
 			  			"data": {
 			  				"labels": ["Harjamukti", "Kesambi", "Lemahwungkuk", "Kejaksan", "Pekalipan"],
 			  				"datasets": [{
 			  					"label": "Kota Cirebon",
 			  					"data": [19, 9, 6, 6, 1],
 			  					"fill": false,
 			  					"backgroundColor": [
 			  					"rgba(255, 99, 132, 0.2)", 
 			  					"rgba(255, 159, 64, 0.2)",
 			  					"rgba(255, 205, 86, 0.2)", 
 			  					"rgba(75, 192, 192, 0.2)", 
 			  					"rgba(54, 162, 235, 0.2)",
 			  					"rgba(153, 102, 255, 0.2)", 
 			  					"rgba(201, 203, 207, 0.2)"
 			  					],
 			  					"borderColor": [
 			  					"rgb(255, 99, 132)", 
 			  					"rgb(255, 159, 64)", 
 			  					"rgb(255, 205, 86)",
 			  					"rgb(75, 192, 192)", 
 			  					"rgb(54, 162, 235)", 
 			  					"rgb(153, 102, 255)", 
 			  					"rgb(201, 203, 207)"
 			  					],
 			  					"borderWidth": 1
 			  				}]
 			  			},
 			  			"options": {
 			  				"scales": {
 			  					"xAxes": [{
 			  						"ticks": {
 			  							"beginAtZero": true
 			  						}
 			  					}]
 			  				}
 			  			}
 			  		});
 			  	</script>

 			  </div>
 			</div>
 		</div>


 		<div class="col-md-6">
 			<div class="panel panel-default">
 			  <div class="panel-heading">Per Kecamatan Kab Cirebon</div>
 			  <div class="panel-body">
 			  	<input type="hidden" value="<?=$by_kab_cirebon?>">
 			  	<canvas id="by_kab_cirebon" style="max-width: 500px;height: 500px"></canvas>
 			  	<script type="text/javascript">
 			  		new Chart(document.getElementById("by_kab_cirebon"), {
 			  			"type": "horizontalBar",
 			  			"data": {
 			  				"labels": ["Mundu","Talun","Sumber","Lemahabang","Plumbon","Gunungjati","Astanajapura","Klangenan","Gegesik","Suranenggala","Susukan","Gempol","Greged","Depok","Panguragan","Jamblang","Karangsembung","Kapetakan","Palimanan","Kaliwedi","Arjawinangun","Kedawung","Pabedilan","Susukanlebak","Waled","Dukupuntang","Losari","Tengah Tani","Karangwareng","Pabuaran"],
 			  				"datasets": [{
 			  					"label": "Kabupaten Cirebon",
 			  					"data": [12,9,7,7,6,6,6,4,4,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,1,1,1,1,1,1],
 			  					"fill": false,
 			  					"backgroundColor": [
 			  					"rgba(255, 99, 132, 0.2)", 
 			  					"rgba(255, 159, 64, 0.2)",
 			  					"rgba(255, 205, 86, 0.2)", 
 			  					"rgba(75, 192, 192, 0.2)", 
 			  					"rgba(54, 162, 235, 0.2)",
 			  					"rgba(153, 102, 255, 0.2)", 
 			  					"rgba(201, 203, 207, 0.2)"
 			  					],
 			  					"borderColor": [
 			  					"rgb(255, 99, 132)", 
 			  					"rgb(255, 159, 64)", 
 			  					"rgb(255, 205, 86)",
 			  					"rgb(75, 192, 192)", 
 			  					"rgb(54, 162, 235)", 
 			  					"rgb(153, 102, 255)", 
 			  					"rgb(201, 203, 207)"
 			  					],
 			  					"borderWidth": 1
 			  				}]
 			  			},
 			  			"options": {
 			  				"scales": {
 			  					"xAxes": [{
 			  						"ticks": {
 			  							"beginAtZero": true
 			  						}
 			  					}]
 			  				}
 			  			}
 			  		});
 			  	</script>

 			  </div>
 			</div>
 		</div>
 	
 	</div>
</div>

</body>
</html>
