<?php

/**
 * File name: OffersController.php
 * Last modified: 2020.09.12 at 20:01:58
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\DataTables\OffersDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOffersRequest;
use App\Http\Requests\UpdateOffersRequest;
use App\Repositories\OffersRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\UploadRepository;
use App\Repositories\ProductRepository;
use App\Repositories\MarketRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;



class OffersController extends Controller
{
     /** @var  offersRepository */
     private $offersRepository;

     /**
      * @var CustomFieldRepository
      */
     private $customFieldRepository;
 
     /**
      * @var UploadRepository
      */
     private $uploadRepository;
     /**
      * @var ProductRepository
      */
     private $productRepository;
     /**
      * @var MarketRepository
      */
     private $marketRepository;


     public function __construct(OffersRepository $offersRepo, CustomFieldRepository $customFieldRepo, UploadRepository $uploadRepo
        , ProductRepository $productRepo
        , MarketRepository $marketRepo)
    {
        
        parent::__construct();
        $this->offersRepository = $offersRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->uploadRepository = $uploadRepo;
        $this->productRepository = $productRepo;
        $this->marketRepository = $marketRepo;
    }

    /**
     * Display a listing of the Offers.
     *
     * @param OffersDataTable $OffersDataTable
     * @return Response
     */
    public function index(OffersDataTable $OffersDataTable)
    {
        
        return $OffersDataTable->render('offers.index');
    }

    /**
     * Show the form for creating a new Offers.
     *
     * @return Response
     */
    public function create()
    {
        
        $product = $this->productRepository->pluck('name', 'id');
        $market = $this->marketRepository->pluck('name', 'id');

        $hasCustomField = in_array($this->offersRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->offersRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('offers.create')->with("customFields", isset($html) ? $html : false)->with("product", $product)->with("market", $market);
    }

    /**
     * Store a newly created Offers in storage.
     *
     * @param CreateOffersRequest $request
     *
     * @return Response
     */
    public function store(CreateOffersRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->offersRepository->model());
        try {
            $offers = $this->offersRepository->create($input);
            $offers->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($offers, 'image');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.offers')]));

        return redirect(route('offers.index'));
    }

    /**
     * Display the specified Offers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $offers = $this->offersRepository->findWithoutFail($id);

        if (empty($offers)) {
            Flash::error('Offers not found');

            return redirect(route('offers.index'));
        }

        return view('offers.show')->with('offers', $offers);
    }

    /**
     * Show the form for editing the specified Offers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $offers = $this->offersRepository->findWithoutFail($id);
        $product = $this->productRepository->pluck('name', 'id')->toArray();
        $market = $this->marketRepository->pluck('name', 'id')->toArray();
        $product = array('' => trans('lang.offers_product_id_placeholder')) + $product;
        $market = array('' => trans('lang.offers_market_id_placeholder')) + $market;


        if (empty($offers)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.offers')]));

            return redirect(route('offers.index'));
        }
        $customFieldsValues = $offers->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->offersRepository->model());
        $hasCustomField = in_array($this->offersRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('offers.edit')->with('offers', $offers)->with("customFields", isset($html) ? $html : false)->with("product", $product)->with("market", $market);
    }

    /**
     * Update the specified Offers in storage.
     *
     * @param int $id
     * @param UpdateOffersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOffersRequest $request)
    {
        $offers = $this->offersRepository->findWithoutFail($id);

        if (empty($offers)) {
            Flash::error('Offers not found');
            return redirect(route('offers.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->offersRepository->model());
        try {
            if(!isset($input['product_id'])){
                $input['product_id'] = null;
            }
            if(!isset($input['market_id'])){
                $input['market_id'] = null;
            }
            $offers = $this->offersRepository->update($input, $id);

            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($offers, 'image');
            }
            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $offers->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.offers')]));

        return redirect(route('offers.index'));
    }

    /**
     * Remove the specified Offers from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $offers = $this->offersRepository->findWithoutFail($id);

        if (empty($offers)) {
            Flash::error('Offers not found');

            return redirect(route('offers.index'));
        }

        $this->offersRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.offers')]));

        return redirect(route('offers.index'));
    }

    /**
     * Remove Media of Offers
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $offers = $this->offersRepository->findWithoutFail($input['id']);
        try {
            if ($offers->hasMedia($input['collection'])) {
                $offers->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
