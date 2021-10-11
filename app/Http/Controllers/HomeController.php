<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\GeoIP\MaxMindGeoLite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        // $config = config('services.maxmind');
        // $geoip = new MaxMindGeoLite($config['account_id'], $config['license_key']);

        // $country = $geoip->country('213.244.80.165');

        $latest = Product::latest()->take(10)->get();
        return view('front.home', [
            'latest' => $latest,
        ]);
    }
}
