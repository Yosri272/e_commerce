<?php
/**
 * File name: OffersAPIController.php
 * Last modified: 2020.09.12 at 20:01:58
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;


use App\Models\Offers;
use App\Repositories\OffersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class OffersController
 * @package App\Http\Controllers\API
 */

class OffersAPIController extends Controller
{
     /** @var  OffersRepository */
     private $OffersRepository;

     public function __construct(OffersRepository $OffersRepo)
     {
         $this->OffersRepository = $OffersRepo;
     }
 
     /**
      * Display a listing of the Offers.
      * GET|HEAD /Offers
      *
      * @param Request $request
      * @return \Illuminate\Http\JsonResponse
      */
     public function index(Request $request)
     {
         try{
             $this->OffersRepository->pushCriteria(new RequestCriteria($request));
             $this->OffersRepository->pushCriteria(new LimitOffsetCriteria($request));
         } catch (RepositoryException $e) {
             Flash::error($e->getMessage());
         }
         $Offers = $this->OffersRepository->all();
 
         return $this->sendResponse($Offers->toArray(), 'Offers retrieved successfully');
     }
 
     /**
      * Display the specified Offers.
      * GET|HEAD /Offers/{id}
      *
      * @param  int $id
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function show($id)
     {
         /** @var Offers $Offers */
         if (!empty($this->OffersRepository)) {
             $Offers = $this->OffersRepository->findWithoutFail($id);
         }
 
         if (empty($Offers)) {
             return $this->sendError('Offers not found');
         }
 
         return $this->sendResponse($Offers->toArray(), 'Offers retrieved successfully');
     }
}
