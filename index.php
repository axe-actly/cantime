<!DOCTYPE html>
<?php
  include 'helper.php';
 // var_dump($_POST);
  if(isset($_POST['tag'])&&isset($_POST['inout'])){
    entree($_POST['tag'],$_POST['inout']);
  }
?>
<html>
  <head>
    <script type="text/javascript">
      window.onload = generateRandomNumber;
      function generateRandomNumber(){
        var n = 25;
        var number = Math.floor(Math.random()*n)+1;
        document.getElementById("randomNumber").innerHTML = number;
      }
    </script>
    <script src="Chart.bundle.js"></script>
    <script src="utils.js"></script>
	  <style>
  	  canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
      }
    </style>
  </head>
  <body>
    <h1>
      Nombre de personnes a la cantine : 
      <?php
        $nombre = compte()[0];
        echo $nombre;
      ?>
    </h1>
    <div style="width: 75%">
		<canvas id="canvas"></canvas>
	</div>
	<button id="randomizeData">Randomize Data</button>
	<script>
		var barChartData = {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets: [{
				label: 'Dataset 1',
				backgroundColor: [
					window.chartColors.red,
					window.chartColors.orange,
					window.chartColors.yellow,
					window.chartColors.green,
					window.chartColors.blue,
					window.chartColors.purple,
					window.chartColors.red
				],
				yAxisID: 'y-axis-1',
				data: [
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor()
				]
			}, {
				label: 'Dataset 2',
				backgroundColor: window.chartColors.grey,
				yAxisID: 'y-axis-2',
				data: [
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor()
				]
			}]
		};
		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Chart.js Bar Chart - Multi Axis'
					},
					tooltips: {
						mode: 'index',
						intersect: true
					},
					scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-2',
							gridLines: {
								drawOnChartArea: false
							}
						}],
					}
				}
			});
		};
		document.getElementById('randomizeData').addEventListener('click', function() {
			barChartData.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});
			window.myBar.update();
		});
	</script>
  </body>
</html>
