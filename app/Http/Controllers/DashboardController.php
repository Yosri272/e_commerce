<?php

namespace App\Http\Controllers;

use App\Criteria\Markets\MarketsOfUserCriteria;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\MarketRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\MarketUser;
class DashboardController extends Controller
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
         $id_uesr = auth()->user()->id;
        
         $tt = auth()->user();
        
         
          if ($tt->hasRole('client')) {
              
               $ordersCount = $this->orderRepository->count();
                $membersCount = $this->userRepository->count();
                $marketsCount = $this->marketRepository->count();
       
                $markets = $this->marketRepository->limit(4);
                 $earning = $this->paymentRepository->all()->sum('price');
                $ajaxEarningUrl = route('payments.byMonth',['api_token'=>auth()->user()->api_token]);
             return view('dashboard.client')
                           ->with("ajaxEarningUrl", $ajaxEarningUrl)
                           ->with("ordersCount", $ordersCount)
                           ->with("marketsCount", $marketsCount)
                           ->with("markets", $markets)
                           ->with("membersCount", $membersCount)
                           ->with("earning", $earning);
              
              
              
          }elseif($tt->hasRole('admin')){
              

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
          }else{
             $marketsCount = MarketUser::where('user_id','=',$id_uesr)->count();
            
           
              
              //  $ordersCount = $this->orderRepository->count();
                $ordersCount =0;
                $membersCount = $this->userRepository->count();
                
               // $marketsCount = $this->marketRepository->count();
                 $MarketUser=$this->marketRepository->pushCriteria(new MarketsOfUserCriteria(auth()->id()));
                
                 
                // $markets = $this->marketRepository->where('id','=',41)->limit(4);

                $markets = $this->marketRepository->limit(4);
               foreach($markets as $market){
                  $s= $market->id;

               }
              
                
                 $earning = $this->paymentRepository->where('user_id','=',$id_uesr)->sum('price');
               
               // $ajaxEarningUrl = route('payments.byMonth',['api_token'=>auth()->user()->api_token]);
                
                $ajaxEarningUrl = 0;
                //dd($ordersCount);
             return view('dashboard.manager')
                           ->with("ajaxEarningUrl", $ajaxEarningUrl)
                           ->with("ordersCount", $ordersCount)
                           ->with("marketsCount", $marketsCount)
                           ->with("markets", $markets)
                           ->with("membersCount", $membersCount)
                           ->with("earning", $earning);
              
             
              
          }
      
    }
}
