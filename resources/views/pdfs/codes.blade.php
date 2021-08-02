<div class="body">
    @foreach ($products->chunk(50) as $array)
    @foreach ($array as $product)
       
          <div class="code-div">
            {!! DNS1D::getBarcodeHTML($product->code, 'C39').$product->code.'  '. $product->name !!} <br>
          </div>
        
    @endforeach
@endforeach
</div>
<style>
    .body{
        margin: 6px;
    }
    .code-div{
       
        margin-bottom: 18px
    }
</style>