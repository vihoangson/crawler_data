<?php
use Sunra\PhpSimple\HtmlDomParser;
use Symfony\Component\DomCrawler\Crawler;

include_once ('vendor/autoload.php');
//unlink('mm');
if(!file_exists('mm')){
    $limit  = 20;
    $file_name = 'https://ticketbox.vn/EventList/EventList/LoadEventList?Q=&CityName=&OtherLocation=false&CityId=&Categories=&From=&To=&DateFilter=&Price=3&SiteId=1&CultureName=&Offset=0&Limit='.$limit.'&TotalCount=3&categories=';
    $str = file_get_contents($file_name);
    file_put_contents('mm',$str);
}else{
    $str = file_get_contents('mm');
}

if(false){
    $dom = HtmlDomParser::str_get_html( $str );
    //$dom = HtmlDomParser::file_get_html( $file_name );
    $elems = $dom->find('a');
    var_dump($elems->innertext());
}

$crawler = new Crawler($str);
$crawler->filter('a')->first();
//var_dump($crawler);
var_dump($crawler->filter('a')->nextAll()->html());

//
// foreach ($crawler->filter('a') as $domElement) {
//     var_dump($domElement->html());
// }