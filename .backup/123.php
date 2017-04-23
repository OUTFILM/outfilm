<?php
		$slideB = "slide0btn";
		for($slidebtn = 0;$slidebtn<3;$slidebtn++) {
		$slideB[5] = $slidebtn ;
		
		echo "$slideB";
		echo "----";
		echo "slide".(($slidebtn+1) % 3)."btn";
		
		}
?>