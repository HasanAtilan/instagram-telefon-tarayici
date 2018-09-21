 <?php
 error_reporting(0);
 ini_set('max_execution_time', 500);  
  function verilericek($albakalim,$isimbul,$isimbitir){  
  $albakalim= explode($isimbul,$albakalim);  
  $albakalim= $albakalim[1];  
  $albakalim= explode($isimbitir,$albakalim);  
  $albakalim= $albakalim[0];  
  return $albakalim;  
  }  
 function fonksiyonumuz($isim) {  
      $kaynak = file_get_contents('https://www.instagram.com/explore/tags/'.$isim.'/');  
      $meraba = explode('window._sharedData = ', $kaynak);  
      $jsonalalim = explode(';</script>', $meraba[1]);   
      $indirek = json_decode($jsonalalim[0], TRUE);  
      return $indirek;   
 }  
 $isim = 'Hasan';  
 $sonuclar = fonksiyonumuz($isim);  
 $limit = 4;   
 $resim= array();  
      for ($i=0; $i < $limit; $i++) {   
           $sonra = $sonuclar['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node'];  
           $link = $sonra['shortcode'];   
           $link = "http://www.instagram.com/p/$link";              
           $albakalim = file_get_contents($link);  
           $siteyial= verilericek($albakalim,'username":"','"');       
           $baslik =verilericek($albakalim,'<meta property="og:title" content="','on Instagram');       
           $yeni_site = "http://www.instagram.com/$siteyial";  
           $veriyial = file_get_contents($yeni_site);  
           $telefon= verilericek($veriyial,'business_phone_number":"','"');       
           echo "$baslik $telefon<br>";  
 }  
 
 ?>
