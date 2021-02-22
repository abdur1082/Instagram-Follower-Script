<?php

########
#
# RZLSFT- INSTAGRAM COMMENT SCRIPT
# VER : V1.1
#
######## 
require __DIR__ . '/vendor/autoload.php';
use Phpfastcache\Helper\Psr16Adapter;
//error_reporting(0);


if (@!empty($_POST['kullanici'])) {

	extract($_POST);
	if (@!empty($kullanici)) {
	if (@!empty($adet)) {
	if (@!empty($delay)) {

$dosya = fopen('userler.txt', 'r');
$icerik = fread($dosya, filesize('userler.txt'));
$donusturme=explode("-",$icerik);
$sayi=count($donusturme)-2;







for ($i=0; $i <$adet ; $i++) {
	$random=rand(0,$sayi);
$veri=$donusturme[$random];
$parcala=explode(",",$veri);
$username = str_replace("[", "", $parcala[0]);
$password = str_replace("]", "", $parcala[1]); 
	if (@$parcala[2]) {
	$proxyTam = str_replace("]", "", $parcala[2]);
	$instagram = \InstagramScraper\Instagram::withCredentials(new \GuzzleHttp\Client(['proxy' => $proxyTam]), $username, $password, new Psr16Adapter('Files'));
	$login=$instagram->login();
}else{
	$instagram = \InstagramScraper\Instagram::withCredentials(new \GuzzleHttp\Client(), $username, $password, new Psr16Adapter('Files'));
	$login=$instagram->login();
}
$account    = $instagram->getAccount($kullanici);
$tas=$instagram->follow($account->getId());


	sleep($delay);


}

if (empty($tas)) {
	$data['durum']="basarili";
	$data['message']="Takipçiler Gönderildi";
		print_r(json_encode($data));
}else if($tas == "silik"){
	$data['durum']="hata";
	$data['message']="Medya Bulunamadı";
		print_r(json_encode($data));
}else{
		$data['durum']="hata";
	$data['message']="Hata, Tekrar Deneyiniz";
		print_r(json_encode($data));
}

}else{

	$data['durum']="hata";
	$data['message']="Lütfen Boş Alan Bırakmayınız";
		print_r(json_encode($data));
}
}else{

	$data['durum']="hata";
	$data['message']="Lütfen Boş Alan Bırakmayınız";
		print_r(json_encode($data));
}
}else{

	$data['durum']="hata";
	$data['message']="Lütfen Boş Alan Bırakmayınız";
		print_r(json_encode($data));
}

}

if (@!empty($_POST['username'])) {
	extract($_POST);
	
	
	if (!empty($username)) {
		if (!empty($password)) {

if ($proxy) {
	$instagram = \InstagramScraper\Instagram::withCredentials(new \GuzzleHttp\Client(['proxy' => $proxy]), $username, $password,new Psr16Adapter('Files'));
	$login=$instagram->login();
}else{
	$instagram = \InstagramScraper\Instagram::withCredentials(new \GuzzleHttp\Client(), $username, $password, new Psr16Adapter('Files'));
	$login=$instagram->login();
}

	
	if ($login == "hata") {
			$data['durum']="hata";
	$data['message']="Kullanıcı adınızı veya şifrenizi kontrol ediniz.";
		print_r(json_encode($data));
	}else if($login =="proxyHata")
{

	$data['durum']="hata";
	$data['message']="Proxy kontrol Ediniz";
		print_r(json_encode($data));
}else
	{



		$file = 'userler.txt';
		$find = "[".$_POST['username'].",".$_POST['password']."]";
		$contents = file_get_contents($file);
		$pattern = preg_quote($find, '/');
		$pattern = "/^.*$pattern.*$/m";


		if(preg_match_all($pattern, $contents, $matches)){

	$data['durum']="basarili";
	$data['message']="User Zaten Ekli";
		print_r(json_encode($data));
		}
		else{
$data['durum']="basarili";
	$data['message']="Başarılı User eklenmiştir";
		print_r(json_encode($data));
$dosya = fopen ("userler.txt" , 'a'); //dosya oluşturma işlemi
$yaz="[".$_POST['username'].",".$_POST['password'].",".$proxy."]-";
 //dosya içine ne yazmak istiyorsanız buraya yazın. $değer
fwrite ( $dosya , $yaz ) ;
fclose ($dosya);
} 




}

}else{

	$data['durum']="hata";
	$data['message']="Lütfen Boş Alan Bırakmayınız";
		print_r(json_encode($data));
}

}else{

	$data['durum']="hata";
	$data['message']="Lütfen Boş Alan Bırakmayınız";
		print_r(json_encode($data));
}



}



?>