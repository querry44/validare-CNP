<?php

function validare($cnp){
	if (strlen($cnp) != 13)
		return false;
		
	if ( !is_numeric($cnp))
		return false;
		
	$an = substr($cnp, 1, 2);
	switch (substr($cnp, 0, 1)) {
	   case 0:
			 return false;
	   case 1:
	   case 2:
			 $an = "19".$an;
			 break;
	   case 3:
	   case 4:
			 $an = "18".$an;
			 break;
	   case 5:
	   case 6:
			 $an = "20".$an;
			 break;
	}
	
	$luna = (int)substr($cnp, 3, 2);
	if ( $luna<1 || $luna>12 )
		return false;
		
	$zi = (int)substr($cnp, 5, 2);
	
	if ( !verifica_zi($an, $luna, $zi) )
		return false;
		
	$judet = (int)substr($cnp, 7, 2);
	if ( $judet<1 || $judet>52 || ($judet>46 && $judet<51) )
		return false;
		
	$numar = (int)substr($cnp, 9, 3);
	if ( $numar<1 )
		return false;
		
	$suma = 2 * substr($cnp, 0,1)+
			7 * substr($cnp, 1,1)+
			9 * substr($cnp, 2,1)+
			1 * substr($cnp, 3,1)+
			4 * substr($cnp, 4,1)+
			6 * substr($cnp, 5,1)+
			3 * substr($cnp, 6,1)+
			5 * substr($cnp, 7,1)+
			8 * substr($cnp, 8,1)+
			2 * substr($cnp, 9,1)+
			7 * substr($cnp, 10,1)+
			9 * substr($cnp, 11,1);
	$rest = $suma % 11;
	
	if ( $rest == 10 ) $rest=1;
	
	if ( $rest != substr($cnp, 12) )
		return false;
		
	return true;
}

function verifica_zi($an, $luna, $zi){
	if ( checkdate ( $luna , $zi , $an ) )
		return true;
	return false;
}

function valid($cnp){
	if (validare($cnp) )
		return $cnp." este valid"."<br>";
	return $cnp." este invalid"."<br>";
}
//exemple:
echo valid('6210803018343');
echo valid('5110802015849');
echo valid('1950808016675');
echo valid('1780810415845');
echo valid('3780630415842');
echo valid('7780810415846');

?>