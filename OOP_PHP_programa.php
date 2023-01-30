<?php error_reporting(0);
// Jakaitis Darius
// Objektinio programavimo užduotis 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><title>Programa iš c++ į OOP php</title>
	<style>
	ul li {
	  color: darkblue;
	  margin: 5px;
	}
	</style>
</head>
<body>
<div class="container">
<br/>	
<?php 
if (isset($_GET['reset'])) {
	$ses = $_SESSION['kiekis'];
	unset($ses);
	}
	$tit = new Duomenys($kiek,$laik);
	print "<h2>".$tit->title()."</h2>";  
?>
<br/>
    <div class="col-sm-4">
<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET['kiek'] !=""){  
	  $kiek = $_GET['kiek'];
	  $laik = $_GET['laikas'];
	  $duom = new Duomenys($kiek,$laik);
	  $g_kieki = $duom->gautiKieki();
	} 
?>
	<form method="GET" action="<?php print $_SERVER['PHP_SELF']; ?>">
<?php 
    if($_SESSION['kiekis'] != true){?>
		<div class="input-group">
		<span class="input-group-addon">Kiek dalyvių:</span>
		<input type="text" class="form-control" placeholder="Įrašykite skaičius" name="kiek"/>
		<div class="input-group-btn">
		<button class="btn btn-default" type="submit"><i class=" glyphicon glyphicon-plus"></i></button>
		</div>
		</div>
<?php  } else { 
	     print "";
		 }
	$n=$_SESSION['kiekis'];
	if($g_kieki){  
        print "<br>Kiekis pridėtas: ". $_SESSION['kiekis']; ?>
		<button type="submit" class="btn btn-warning" name="reset" ><i class=" glyphicon glyphicon-trash"></i></button>
<?php } else {  
        echo "<br>Pateikite duomenis";  
      } ?>
	<br/>
	&nbsp;
	</form>
	<form method="GET" action="<?php print $_SERVER['PHP_SELF']; ?>">
	<input type="hidden" class="form-control" name="kiek" value="<?php print $n; ?>" />
	
<?php  
    for($i=1; $i<=$n; $i++){ ?>
	   <div class="input-group">
	   <span class="input-group-addon">Įrašyti<?php print " ".$i; ?>-ojo dalyvio laiką:</span>
       <input type="text" class="form-control" placeholder="Laikas" name="laikas[]"/>
       </div>
	<br/>
<?php } ?>
	&nbsp;
    <button type="submit"  class="btn btn-primary">Pateikti skaičiavimui</button>
   	<br/>
	<br/>
	<br/>
	</form>
   </div>	
    <div class="col-sm-8">
    <h2 class="mt-5">UŽDUOTIS</h2>
    <i style="color: #00ace6;">
	Konkurse dalyvauja n dalyvių. Pirmasis dalyvis atliko užduotį per t1 minučių, antrasis – per t2,<br> n-
	tasis – per tn. Parašykite programą, surandančią, kuris dalyvis įveikė užduotį lėčiausiai ir keliomis<br>
	minutėmis jis buvo lėtesnis už visų dalyvių užduočių atlikimo laiko vidurkį, taip pat ir greičiausias dalyvis,<br> išspausdinkite visų dalyvių
	užduočių atlikimo vidurkį.<br>
	<b>Pasitikrinkite:</b><br>
	Kiek dalyvių konkurse: 4<br>
	Koks 1 dalyvio laikas: 22<br>
	Koks 2 dalyvio laikas: 20<br>
	Koks 3 dalyvio laikas: 25<br>
	Koks 4 dalyvio laikas: 25<br>

	Trumpiausiai atliko užduotį 2 dalyvis. Lėčiausiai atliko užduotį 4 dalyvis. Atliko lėčiau nei vidurkis 3 min. Vidurkis: 23 min.
	</i>
	<h2> SPRENDIMAS</h2>
	<p>__________________________</p>
	<?php if( $laik != ""){
	print "<p>Konkurse dalyvavo: <b>".$n."</b> dalyviai.<br>"; 
	} else if($kiek > 0){
	print "Jūs įvedėte $n dalyvius, pridėkite jiems laikus";
	} else { 
	print "Dar nepridėta jokių duomenų";}
	  if( $laik != ""){ 
      $duom->gautiRezultatus();
	  $ilg2 = $duom->ilgiausio_t();
	  $greic = $duom->greiciausio_t();
	  $vid_t = $duom->laiko_vidurkis();
	  $maxv = $duom->max_t();
	  print "</p>
	  <ul>";
		print "<li>Užduoties atlikimo bendras laiko vidurkis: <b>$vid_t</b> min.</li>";
		print "<li>Trumpiausiai atliko užduotį <b>$greic</b> dalyvis.</li>"; 
		print "<li>Ilgiausiai atliko užduotį <b>$ilg2</b> dalyvis.</li>";
		print "<li><b>$ilg2</b>-asis dalyvis užduotį atliko <b>$maxv</b> min.
		ilgiau nei bendras vidurkis.</li>";
		print "</ul>";
		print "<br><br>"; 
	} else {
		print "";
		   } ?>
	 </div>
     </div>
   </body>
</html>

<?php 
 class Antraste {
	const ANTRASTE = "Dariaus Jakaičio sukurta programa, <br/>panaudota C++ užduotis"; // Konstanta
	public function title() {
	return self::ANTRASTE;
    }
 }
 
 class Duomenys extends Antraste{
	 public $kiek;
	 public $laikas;
   public $k;
	 public $vidurkis;

   function __construct($kiek, $laikas) {
        $this->kiek = $kiek; 
	$this->laikas = $laikas;
   }
	  
	function gautiKieki(){
		$n =$this->kiek;
                $_SESSION['kiekis'] = $n;
		$rezult = $n;
		return $rezult;
	}
	 function gautiRezultatus(){
		  
		$dalyvio_laikas = $this->laikas;
		$rezultatas = $dalyvio_laikas;
		foreach($rezultatas as $rezult){
                $k=$this->k;
		$k=$k+1; // kiekis ++
		print "".$k."-ojo dalyvio laikas: ".$rezult." min.<br>";	   
	    }
	 }
	function ilgiausio_t(){
		$dalyvio_laikas = $this->laikas;
		$rezultatas = $dalyvio_laikas;
		$max_val = max($rezultatas);
		foreach($rezultatas as $rezult){
			$k=$this->k;
                        $k=$k+1; // kiekis ++
			if ($rezult == $max_val){
			$ilg=$k;
			} 
		}
        return $ilg; 	  
	}
	function greiciausio_t(){
		  
		$dalyvio_laikas = $this->laikas;
		$rezultatas = $dalyvio_laikas;
		$min_val = min($rezultatas);
		foreach($rezultatas as $rezult){
                $k=$this->k;
		$k=$k+1; // kiekis ++
		if ($rezult == $min_val){
		$greic=$k;
		}
		}	 
		return $greic;
	}
	   
	function max_t(){
	$dalyvio_laikas = $this->laikas;
	$rezultatas = $dalyvio_laikas;
	$max_val = max($rezultatas);	
	foreach($rezultatas as $rezult){
	$k=$this->k;
	$vidurkis=$this->vidurkis;
		$k=$k+1; // kiekis ++
		$vidurkis +=$rezult; // bendras laikas
		$bendras_laikas=number_format ($vidurkis/$k, 0, ".", ","); // dalyvių bendras laiko vidurkis
		if ($rezult == $max_val) {
			$max_laikas = $rezult;
		} 
		}
		$maxv = $max_laikas-$bendras_laikas;	
		return $maxv;
	}
	   
	function laiko_vidurkis(){
		  
		$dalyvio_laikas = $this->laikas;
		$rezultatas = $dalyvio_laikas;
		foreach($rezultatas as $rezult){
	        $k=$this->k;
	        $vidurkis=$this->vidurkis;
		$k=$k+1; // kiekis ++
		$vidurkis +=$rezult; // bendras laikas
		$bendras_laikas=number_format ($vidurkis/$k, 0, ".", ","); // dalyvių bendras laiko vidurkis
		}
		$vid = $bendras_laikas;	
		return $vid;
	}
	function __destruct() {
		  if($this->laikas > 0){
			  print "<br><p align='center' style='color: green' >Programa veikia tinkamai<p><br>";
		  } 
	}
 }
?>
