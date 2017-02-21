<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Crops For Future</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="styleTest.css">
  <link rel="stylesheet" href="component.css">
  <link rel="stylesheet" href="result-style.css">
  <!--DONUT CHART-->
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
          google.charts.load("current", {packages:["corechart"]});
          google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Food Classes', 'Nutrition Value in gram'],
              ['Calories'    ,    52],
              ['Carbs   '    ,  13.8],
              ['Sugar'       ,  10.4],
              ['Fiber'       ,   2.4],
              ['Protein'     ,   0.5]
            ]);

            var options = {
              title: 'Apple Nutrition Chart',
              pieHole: 0.3,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
     </script>
	<?php
		$servername = "localhost";
		$username = "Ning";
		$password = "ning3695";
		$dbname = "crops for the future";
	?>
</head>

<body>
<!--codes for inserting crops into specified arrays-->
<?php
	$conn = new mysqli($servername, $username, $password, $dbname);

	$crops = $conn->prepare ("SELECT Cropid, Type_Cereals, Type_Fruit, Type_Grass, Type_Herb, Type_Legume, Type_Pulse, Type_Root, Type_Tuber, Type_Vegetable, Type_Spices FROM crop_type_data");
	$crops->execute();
	$crops->bind_result($cropname, $boolean_cereal, $boolean_fruit, $boolean_grass, $boolean_herb, $boolean_legume, $boolean_pulse, $boolean_root, $boolean_tuber, $boolean_vegetable, $boolean_spices);
	
	//create arrays of crops of each type
	$cereal    = array();
	$fruit     = array();
	$grass     = array();
	$herb      = array();
	$legume    = array();
	$pulse     = array();
	$root      = array();
	$tuber     = array();
	$vegetable = array();
	$spices    = array();
	
	//inserting values into arrays
	while ($crops->fetch()){
		if ($boolean_cereal == 1) array_push ($cereal, $cropname);
		else if ($boolean_fruit == 1) array_push ($fruit, $cropname);
		else if ($boolean_grass == 1) array_push ($grass, $cropname);
		else if ($boolean_herb == 1) array_push ($herb, $cropname);
		else if ($boolean_legume == 1) array_push ($legume, $cropname);
		else if ($boolean_pulse == 1) array_push ($pulse, $cropname);
		else if ($boolean_root == 1) array_push ($root, $cropname);
		else if ($boolean_tuber == 1) array_push ($tuber, $cropname);
		else if ($boolean_vegetable == 1) array_push ($vegetable, $cropname);
		else if ($boolean_spices == 1) array_push ($spices, $cropname);
	}
?>

<div class='cbp-spmenu-push'>
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
	<?php
	//if($_GET['name']==3){
		echo "<h3>Grass</h3>";
		for($x=0;$x<sizeof($grass); $x++)
		echo "<a class='fancy-btn open'>$grass[$x]</a>";			
	//}
	?>		
	</nav>
</div>

<div class="modal-frame">
        <div class="modal">
		    <div class="modal-inset">
      			<div class="button close"><i class="fa fa-close"></i></div>
	
                <div class="modal-body">
				        <h3> Apples are one of the healthiest foods a person can eat !</h3>
               
      			        <div id="donutchart" style="width: 700px; height: 300px;"></div>
      			</div>
    		</div>
  	    </div>
    </div>
<div class="modal-overlay"></div>

<!--animated circular button code-->		
<div class='selector'>
  <ul>
  <?php
	$conn = new mysqli($servername, $username, $password, $dbname);

	$crops = $conn->prepare ("SELECT Crop_Type FROM crop_type");
	$crops->execute();
	$crops->bind_result($cropType);
	$i = 0;
	while($crops->fetch()){
		$i++;
		echo 
		"<li>
		  <input class='menuRight' id='$i' type='button'>
		  <label for='$i'>$cropType</label>
		</li>";
	}
?>
  </ul>
  <button>Crops</button>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
<script src="js/classie.js"></script>
<script src="js/result-index.js"></script>
<script>
	var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
		showRight = document.getElementsByClassName('menuRight'),
		body = document.body;

		for(var i=0; i < showRight.length; i++){
		showRight[i].onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( menuRight, 'cbp-spmenu-open' );
		disableOther( 'showRight' );
		};}

</script>

</body>
</html>