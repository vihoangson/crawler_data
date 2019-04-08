<?php

use Sunra\PhpSimple\HtmlDomParser;
use Symfony\Component\DomCrawler\Crawler;

include_once('vendor/autoload.php');

function get_data_ticketbox() {
    $file_log = 'data.log';
    //unlink($file_log);

    if (!file_exists($file_log)) {
        $limit     = 200;
        $file_name = 'https://ticketbox.vn/EventList/EventList/LoadEventList?Q=&CityName=&OtherLocation=false&CityId=&Categories=&From=&To=&DateFilter=&Price=3&SiteId=1&CultureName=&Offset=0&Limit=' . $limit . '&TotalCount=3&categories=';
        $str       = file_get_contents($file_name);
        file_put_contents($file_log, $str);
    } else {
        $str = file_get_contents($file_log);
    }

    return $str;
}
function sample_dom_ticketbox(){
    $crawler = new Crawler(get_data_ticketbox());

    $crawler->filter('.card-cover')
            ->each(function ($dom, $i) {
                //var_dump($dom->attr('style'));
                preg_match('/url\((.+)\)/', $dom->attr('style'), $match);
                echo "<img src='" . ($match[1] ?? "") . "'>";
                //var_dump($match[1]);
            });
    foreach ($crawler->filter('.event-title a') as $v) {
        var_dump(trim($v->nodeValue));
    }
}

function get_data_tiki() {
    $file_name = 'https://tiki.vn/may-danh-trung/c2108?src=mega-menu';
    $file_name = 'https://tiki.vn/dien-thoai-smartphone/c1795/samsung?src=mega-menu';
    $file_name = 'https://tiki.vn/but-may-hoc-sinh-preppy-nhat-ban-co-f03-p10037689.html?src=personalization&2hi=0';
    // $file_name = 'https://tiki.vn';

    $file_log = 'data_tiki'.base64_encode($file_name).'.log';
    //unlink($file_log);

    if (!file_exists($file_log)) {
        $str       = file_get_contents($file_name);
        file_put_contents($file_log, $str);
    } else {
        $str = file_get_contents($file_log);
    }

    return $str;
}
function sample_dom_tiki(){

    // preg_match_all('/product_option(.+)/',get_data_tiki(),$match);
    // var_dump($match);
    // die;
    $crawler = new Crawler(get_data_tiki());

    // $crawler->filter('.card-cover')
    //         ->each(function ($dom, $i) {
    //             //var_dump($dom->attr('style'));
    //             preg_match('/url\((.+)\)/', $dom->attr('style'), $match);
    //             echo "<img src='" . ($match[1] ?? "") . "'>";
    //             //var_dump($match[1]);
    //         });
    foreach ($crawler->filter('#span-price') as $v) {
        var_dump(trim($v->nodeValue));
    }
    foreach ($crawler->filter('.item-name span') as $v) {
        var_dump(trim($v->nodeValue));
    }

}
sample_dom_tiki();