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



<div class="form-group row new-trans">
  <div class="col-4">
  </div>
  <div class="input-group input-group-sm col-8">
      <div class="input-group-append">
          <button class="btn btn-outline-success add-lang-item" type="button">{{__('lang.add')}}</button>
      </div>
  </div>

</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.Bulk')}}</button>
</div>

</div>
@if($customFields)
<div class="clearfix"></div>
<div class="col-12 custom-field-container">
  <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
  {!! $customFields !!}
</div>
@endif
@push('scripts')
<script type="text/javascript">

     /**
         * delete lang item
         */
         $('.delete-lang-item').on('click', function () {
            // TODO Replace with pretty alert
            if (confirm("{{trans('lang.confirm_delete_message')}}")) {
                $(this).parents('div.form-group.row').slideUp().remove();
            }
        });

/**
* add new lang item
*/
$('.add-lang-item').on('click', function () {
   var newTrans = $(this).parents('div.new-trans');
   var product_id = newTrans.find('input.product_id').attr('name');
   var quantity = newTrans.find('input.quantity').val();
   var price = newTrans.find('input.price').val();
   var discount_price = newTrans.find('input.discount_price').val();
   
   var langItemTmpl =
       `<div class="form-group row">
       <div class="input-group input-group-sm col-8">
        <input class="form-control" placeholder="${product_id}" name="${product_id}" type="text" value="${product_id}" id="${product_id}">
        <input class="form-control" placeholder="${quantity}" name="${quantity}" type="text" value="${quantity}" id="${quantity}">
        <input class="form-control" placeholder="${price}" name="${price}" type="text" value="${price}" id="${price}">  
        <input class="form-control" placeholder="${discount_price}" name="${discount_price}" type="text" value="${discount_price}" id="${discount_price}">
           <div class="input-group-append">
               <button class="btn btn-outline-danger delete-lang-item" type="button">{{trans('lang.delete')}}</button>
           </div>
       </div>
       <div class="form-text offset-4 px-2 text-muted">
       </div>
   </div>`;
   var added = newTrans.before(langItemTmpl);
   newTrans.find('input.new-value').removeAttr('name');
   newTrans.find('input.new-value').val(null);
   newTrans.find('input.new-key').val(null);
   if (added) {
       $('.delete-lang-item').on('click', function () {
           // TODO Replace with pretty alert
           if (confirm("{{trans('lang.confirm_delete_message')}}")) {
               $(this).parents('div.form-group.row').slideUp().remove();
           }
       });
   }
});

</script>
@endpush



