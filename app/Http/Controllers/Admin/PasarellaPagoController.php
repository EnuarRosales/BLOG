<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PasarellaPagoController extends Controller
{
    public function index()
    {
        $payU =$this->generateFirmaPayU();
        return view('admin.pasarelaPago.index',compact('payU'));
        
    }

    public function generateFirmaPayU()
    {
        $referenceCode = Str::random(20);
        $signature = md5(config('services.payU.api_key') . '~' . config('services.payU.merchant_id') . '~' . $referenceCode . '~' . '140000' . '~' . config('services.payU.currency'));

        return [
            'referenceCode' => $referenceCode,
            'signature'=> $signature,
        ];
    }
}
