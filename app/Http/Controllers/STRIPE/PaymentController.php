<?php

namespace App\Http\Controllers\STRIPE;

use App\Http\Controllers\Controller;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __invoke()
    {
        return view('stripe.formpayment');
    }
}
