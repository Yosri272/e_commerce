@if($customFields)
<h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

  <!-- Product Id Field -->
<div class="form-group row ">
  {!! Form::label('product_id', trans("lang.Bulk_product_id"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::select('product_id', $product, null, ['class' => 'select2 form-control']) !!}
    <div class="form-text text-muted">{{ trans("lang.Bulk_product_id_help") }}</div>
  </div>
</div>

<!-- quantity product Field -->
<div class="form-group row ">
  {!! Form::label('quantity product', trans("lang.quantity_product"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    {!! Form::number('quantity', null,  ['class' => 'form-control','placeholder'=>  trans("lang.quantity_product_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.quantity_product_help") }}
    </div>
  </div>
</div>




</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Price Field -->
<div class="form-group row ">
  {!! Form::label('price', trans("lang.Bulk_price"), ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
      {!! Form::number('price', null,  ['class' => 'form-control','step'=>"any",'placeholder'=>  trans("lang.Bulk_price_placeholder")]) !!}
    <div class="form-text text-muted">
      {{ trans("lang.Bulk_price_help") }}
    </div>
  </div>
</div>


  <!-- Discount Price Field -->
  <div class="form-group row ">
    {!! Form::label('discount_price', trans("lang.Bulk_discount_price"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::number('discount_price', null,  ['class' => 'form-control','placeholder'=>  trans("lang.Bulk_discount_price_placeholder"),'step'=>"any", 'min'=>"0"]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.Bulk_discount_price_help") }}
        </div>
    </div>
</div>




</div>
@if($customFields)
<div class="clearfix"></div>
<div class="col-12 custom-field-container">
  <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
  {!! $customFields !!}
</div>
@endif
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.Bulk')}}</button>
</div>
