<?php
/**
 * File name: OptionController.php
 * Last modified: 2020.06.03 at 20:04:42
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\Criteria\Options\OptionsOfUserCriteria;
use App\Criteria\Products\ProductsOfUserCriteria;
use App\DataTables\OptionDataTable;
use App\Http\Requests\CreateOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\BulkRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UploadRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class BlukController extends Controller
{
    /** @var  BulkRepository */
    private $BulkRepository;

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
     * @var OptionGroupRepository
     */
    private $optionGroupRepository;

    public function __construct(BulkRepository $optionRepo, CustomFieldRepository $customFieldRepo, UploadRepository $uploadRepo
        , ProductRepository $productRepo)
    {
        parent::__construct();
        $this->BulkRepository = $optionRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->uploadRepository = $uploadRepo;
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Option.
     *
     * @param OptionDataTable $optionDataTable
     * @return Response
     */
    public function index(OptionDataTable $optionDataTable)
    {
        return $optionDataTable->render('Bulk.index');
    }

    /**
     * Show the form for creating a new Option.
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function create()
    {
        $this->productRepository->pushCriteria(new ProductsOfUserCriteria(auth()->id()));
        $product = $this->productRepository->groupedByMarkets();

        //dd($product);

        $hasCustomField = in_array($this->BulkRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->BulkRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('Bulk.create')->with("customFields", isset($html) ? $html : false)->with("product", $product);
    }

    /**
     * Store a newly created Option in storage.
     *
     * @param CreateOptionRequest $request
     *
     * @return Response
     */
    public function store(CreateOptionRequest $request)
    {
        $input = $request->all();
        //////get array
        $product_idd= $request->only('product_id');
        $quantityy = $request->only('quantity');
        $pricee= $request->only('price');
        $discount_pricee = $request->only('discount_price');
        //////get value  array 
        $product_id= $product_idd['product_id'];
        $quantity=$quantityy['quantity'];
        $price=$pricee['price'];
        $discount_price=$discount_pricee['discount_price'];
   // dd($quantity);

   if( $discount_price == null && $quantity == null  &&  $price == null){
    Flash::error(__('lang.Bulkerror', ['operator' => __('lang.Bulk')]));

 }  
 elseif( $quantity == null && $price != null && $discount_price != null ){
    $this->productRepository->update(['price' => $price], $product_id);
    $this->productRepository->update(['discount_price' => $discount_price], $product_id);
    Flash::success(__('lang.saved_successfully', ['operator' => __('lang.Bulk')]));

 }
 elseif( $price == null && $quantity != null && $discount_price != null){
    $this->productRepository->update(['quantity' => $quantity], $product_id);
    $this->productRepository->update(['discount_price' => $discount_price], $product_id);
    Flash::success(__('lang.saved_successfully', ['operator' => __('lang.Bulk')]));

 }
 elseif( $discount_price == null && $quantity != null  &&  $price != null){
    $this->productRepository->update(['price' => $price], $product_id);
    $this->productRepository->update(['quantity' => $quantity], $product_id);
    Flash::success(__('lang.saved_successfully', ['operator' => __('lang.Bulk')]));

 }
 elseif( $quantity == null && $price == null){
    
    $this->productRepository->update(['discount_price' => $discount_price], $product_id);
    Flash::success(__('lang.saved_successfully', ['operator' => __('lang.Bulk')]));


 }
 elseif( $quantity == null && $discount_price == null){
    $this->productRepository->update(['price' => $price], $product_id);
    Flash::success(__('lang.saved_successfully', ['operator' => __('lang.Bulk')]));


 }
 elseif( $price == null && $discount_price == null){
    $this->productRepository->update(['quantity' => $quantity], $product_id);
    Flash::success(__('lang.saved_successfully', ['operator' => __('lang.Bulk')]));


 }
 elseif( $discount_price != null && $quantity != null  &&  $price != null){
    $this->productRepository->update(['price' => $price], $product_id);
    $this->productRepository->update(['quantity' => $quantity], $product_id);
    $this->productRepository->update(['discount_price' => $discount_price], $product_id);

    Flash::success(__('lang.saved_successfully', ['operator' => __('lang.Bulk')]));

 }










        return redirect(route('Bulk.create'));
    }

    /**
     * Display the specified Option.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function show($id)
    {
        $this->BulkRepository->pushCriteria(new BulkOfUserCriteria(auth()->id()));

        $option = $this->BulkRepository->findWithoutFail($id);

        if (empty($option)) {
            Flash::error('Option not found');

            return redirect(route('Bulk.index'));
        }

        return view('Bulk.show')->with('option', $option);
    }

    /**
     * Show the form for editing the specified Option.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function edit($id)
    {
        $this->BulkRepository->pushCriteria(new OptionsOfUserCriteria(auth()->id()));
        $option = $this->BulkRepository->findWithoutFail($id);
        if (empty($option)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.option')]));
            return redirect(route('Bulk.index'));
        }
        $this->productRepository->pushCriteria(new ProductsOfUserCriteria(auth()->id()));
        $product = $this->productRepository->groupedByMarkets();
        $optionGroup = $this->optionGroupRepository->pluck('name', 'id');


        $customFieldsValues = $option->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->BulkRepository->model());
        $hasCustomField = in_array($this->BulkRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('Bulk.edit')->with('option', $option)->with("customFields", isset($html) ? $html : false)->with("product", $product)->with("optionGroup", $optionGroup);
    }

    /**
     * Update the specified Option in storage.
     *
     * @param int $id
     * @param UpdateOptionRequest $request
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function update($id, UpdateOptionRequest $request)
    {
        $this->BulkRepository->pushCriteria(new OptionsOfUserCriteria(auth()->id()));

        $option = $this->BulkRepository->findWithoutFail($id);

        if (empty($option)) {
            Flash::error('Option not found');
            return redirect(route('Bulk.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->BulkRepository->model());
        try {
            $option = $this->BulkRepository->update($input, $id);

            if (isset($input['image']) && $input['image']) {
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($option, 'image');
            }
            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $option->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.option')]));

        return redirect(route('Bulk.index'));
    }

    /**
     * Remove the specified Option from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function destroy($id)
    {
        $this->BulkRepository->pushCriteria(new OptionsOfUserCriteria(auth()->id()));
        $option = $this->BulkRepository->findWithoutFail($id);

        if (empty($option)) {
            Flash::error('Option not found');

            return redirect(route('Bulk.index'));
        }

        $this->BulkRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.option')]));

        return redirect(route('Bulk.index'));
    }

    /**
     * Remove Media of Option
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $option = $this->BulkRepository->findWithoutFail($input['id']);
        try {
            if ($option->hasMedia($input['collection'])) {
                $option->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
