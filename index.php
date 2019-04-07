<?php
use Sunra\PhpSimple\HtmlDomParser;
use Symfony\Component\DomCrawler\Crawler;

include_once ('vendor/autoload.php');
$file_name = 'https://ticketbox.vn/EventList/EventList/LoadEventList?Q=&CityName=&OtherLocation=false&CityId=&Categories=&From=&To=&DateFilter=&Price=3&SiteId=1&CultureName=&Offset=0&Limit=3&TotalCount=3&categories=';
$str = file_get_contents($file_name);
if(false){
    $dom = HtmlDomParser::str_get_html( $str );
    //$dom = HtmlDomParser::file_get_html( $file_name );
    $elems = $dom->find('a');
    var_dump($elems->innertext());
}

$crawler = new Crawler($str);
var_dump($crawler);

foreach ($crawler as $domElement) {
//    var_dump($domElement->text());
}