<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\MarketRepository;
use App\Repositories\UserRepository;

class languageHomeController extends Controller
{
    /** @var  OrderRepository */
    private $orderRepository;


    /**
     * @var UserRepository
     */
    private $userRepository;

    /** @var  MarketRepository */
    private $marketRepository;
    /** @var  PaymentRepository */
    private $paymentRepository;

    public function __construct(OrderRepository $orderRepo, UserRepository $userRepo, PaymentRepository $paymentRepo, MarketRepository $marketRepo)
    {
        parent::__construct();
        $this->orderRepository = $orderRepo;
        $this->userRepository = $userRepo;
        $this->marketRepository = $marketRepo;
        $this->paymentRepository = $paymentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordersCount = $this->orderRepository->count();
        $membersCount = $this->userRepository->count();
        $marketsCount = $this->marketRepository->count();
       
        $markets = $this->marketRepository->limit(4);
        $earning = $this->paymentRepository->all()->sum('price');
        $ajaxEarningUrl = route('payments.byMonth',['api_token'=>auth()->user()->api_token]);
        return view('dashboard.index')
            ->with("ajaxEarningUrl", $ajaxEarningUrl)
            ->with("ordersCount", $ordersCount)
            ->with("marketsCount", $marketsCount)
            ->with("markets", $markets)
            ->with("membersCount", $membersCount)
            ->with("earning", $earning);
    }
    
     function changeLang($langcode){

        App::setLocale($langcode);
        session()->put("lang_code",$langcode);
        return redirect()->back();
    }
  }