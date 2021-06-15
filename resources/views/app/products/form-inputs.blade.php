@php $editing = isset($product) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $product->name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="slug"
            label="Slug"
            value="{{ old('slug', ($editing ? $product->slug : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $product->status : 'inactive')) @endphp
            <option value="inactive" {{ $selected == 'inactive' ? 'selected' : '' }} >Inactive</option>
            <option value="active" {{ $selected == 'active' ? 'selected' : '' }} >Active</option>
        </x-inputs.select>
    </x-inputs.group>

 
    
     
    <div class="mt-2 form-group">
    <label for="">Image</label>
                <input
                    type="file" class="form-control"
                    name="product_pic[]"
                
                    multiple
            >
            </div>
    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.select name="shop_id" label="Shop" required>
            @php $selected = old('shop_id', ($editing ? $product->shop_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Shop</option>
            @foreach($shops as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.select name="category_id" label="Category" required>
            @php $selected = old('category_id', ($editing ? $product->category_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Category</option>
            @foreach($categories as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.select name="brand_id" label="Brand" required>
            @php $selected = old('brand_id', ($editing ? $product->brand_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Brand</option>
            @foreach($brands as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
<div class="row">
<div class="form-group col-sm-6">
<label for="">Price</label>
<input type="number" name="price" class="form-control">
</div>

<div class="form-group col-sm-6">
<label for="">Size</label>
<input type="number" name="size" class="form-control">
</div>

<div class="form-group col-sm-4">
<label for="">Color</label>
<input type="number" name="color" class="form-control">
</div>
<div class="form-group col-sm-4">
<label for="">Discount Type</label>
<select name="discount_type" class="form-control">
<option value="flat">Flat</option>
<option value="percentage">Percentage</option>
</select>
</div>
<div class="form-group col-sm-4">
<label for="">Discount</label>
<input type="number" name="discount" class="form-control">
</div>
</div>