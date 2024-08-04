<h1>Add a new product to "{{ $website->title }}"</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post">
    @csrf
    <label>
        Product: &nbsp;
        <select name="product_id">
            <option selected>Please select the related product</option>
            @if($products)
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                @endforeach
            @endif
        </select>
    </label>
    <br><br>
    <label>
        Product Link: &nbsp;
        <input type="url" name="product_path" style="width: 350px" placeholder="The product link on your website">
    </label>
    <br><br>
    <button type="submit">Submit</button>
</form>
