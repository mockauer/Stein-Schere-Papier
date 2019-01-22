<?php
session_start();
?>
       <h2>stein-schere-papier.</h2>
               <div id="uberschrift"><strong>stein-schere-papier</strong></div>
<form method="post" action='#'>
	<label>Was w&auml;hlst du?</label> | <input type="radio" id="stein" name="wahl" value="0"> <label for="mc"> Stein</label> <input type="radio" id="schere" name="wahl" value="1"><label for="mc"> Schere</label> <input type="radio" id="papier" name="wahl" value="2"><label for="mc"> Papier</label>
	<input type="submit" name="auswahl" value="Auswahl" /><br/>
	<label>Wer zuerst 15 Punkte hat, hat gewonnen.</label>
	</form>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //something posted

    if (isset($_POST['auswahl']) && isset($_POST["wahl"])) {
		$auswahl = $_POST["wahl"];
		$computer = rand(0,2);
		// 0 - Stein
		// 1 - Schere
		// 2 - Papier
		$wert = ["Stein", "Schere", "Papier"];
		if($auswahl == $computer){
			echo "Unentschieden bei haben ".$wert[$auswahl]." gew&auml;hlt.<br/>";
		}
		else if(($auswahl == 1 && $computer == 0) || ($auswahl == 2 && $computer == 1) || ($auswahl == 0 && $computer == 2)){
			//computer gewinnt
			echo "Der Computer hat gewonnen.<br/>";
			echo $wert[$computer] . " schl&auml;gt " . $wert[$auswahl]. "<br/>";
			$_SESSION["computer"]++;
		}
		else if(($auswahl == 1 && $computer == 2) || ($auswahl == 0 && $computer == 1) || ($auswahl == 2 && $computer == 0)){
			//auswahl gewinnt
			echo "Du hast gewonnen.<br/>";
			echo $wert[$auswahl] . " schl&auml;gt " . $wert[$computer]."<br/>";
			$_SESSION["mensch"]++;
		}
		
		if(!isset($_SESSION["mensch"])){
			$_SESSION["mensch"] = 0;
		}
		if(!isset($_SESSION["computer"])){
			$_SESSION["computer"] = 0;
		}
		
		echo "Insgesamt steht es:<br/>Du: ".$_SESSION["mensch"] . " - Computer: ".$_SESSION["computer"];
		
		if($_SESSION["mensch"] == 15){
			echo "<br/>Du hast gegen den Computer gewonnen";
			$_SESSION["mensch"] = 0;
			$_SESSION["computer"] = 0;			
		} else if($_SESSION["computer"] == 15){
			echo "<br/>Du hast gegen den Computer verloren";
			$_SESSION["mensch"] = 0;
			$_SESSION["computer"] = 0;	
		}		
			
	} else {
		echo "Du musst schon eine Auswahl treffen.";
	}
}
?>
	<br/>
	<br/>

     
<form action='#' method='post'><label style='font-size: 12px;'>&copy;mockauer <?php date('Y') ?></label><input type='submit' name='version' class='app' value='Version 1.0'/></form>
    <br/>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //something posted

    if (isset($_POST['version'])){
		echo "<strong class='footer'>Versionsgeschichte</strong>";
		echo "<ul class='footer'><u>Version 1.0</u>";
		echo "<li class='footer'>Spielfertigstellung</li>";
		echo "<li class='footer'>Punktestand mittels Session</li></ul>";
	}
}

?>
<br/>
