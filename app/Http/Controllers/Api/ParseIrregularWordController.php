<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte;

class ParseIrregularWordController extends Controller
{
    public function index()
    {
        $url = 'https://grammarway.com/ua/irregular-verbs';
        $crawler = Goutte::request('GET', $url);
        $all = $crawler->filter('body > div >  main > div > section ')->children()->last()->children()->children()->last()->children();
//        $all =  $crawler->html();

        $html = '';

        foreach ($all as $key => $domElement) {
            if ($key != 0)
                $html .= $domElement->ownerDocument->saveHTML($domElement);
        }

        return response()->json($html);
    }

}
