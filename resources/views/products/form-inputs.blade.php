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
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $product->status : 'inactive')) @endphp
            <option value="inactive" {{ $selected == 'inactive' ? 'selected' : '' }} >Inactive</option>
            <option value="active" {{ $selected == 'active' ? 'selected' : '' }} >Active</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <div
            x-data="imageViewer('{{ $editing && $product->image ? \Storage::url($product->image) : '' }}')"
        >
            <x-inputs.partials.label
                name="image"
                label="Image"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2 form-group">
               
                    type="file"
                    name="image"  class="form-control">
                    multiple
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    
    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.select name="shop_id" label="shop" required>
           <option >Select a shop</option>
            @foreach($shops as  $shop)
            <option value="{{ $shop->id }}" {{isset($product->shop_id) && $product->shop_id == $shop->id ? 'selected' : '' }} >{{ $shop->name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
    
    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.select name="category_id" label="Category" required>
           <option >Select a category</option>
            @foreach($categories as  $category)
            <option value="{{ $category->id }}" {{isset($product->category_id) && $product->category_id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
    
    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.select name="brand_id" label="Brand" required>
           <option >Select a brand</option>
            @foreach($brands as  $brand)
            <option value="{{ $brand->id }}" {{isset($product->brand_id) && $product->brand_id == $brand->id ? 'selected' : '' }} >{{ $brand->name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <div class="card p-2">
    <h4>Product Details</h4>
    <div class="row">
    <div class="col-sm-4 col-4">
    <label for="">Price</label>
    <input type="text class="form-control" name="price" >
    </div>

    <div class="col-sm-4 col-4">
    <label for="">Color</label>
    <input type="text class="form-control" name="color" >
    </div>

    <div class="col-sm-4 col-4">
    <label for="">Size</label>
    <input type="text class="form-control" name="size" >
    </div>

    <div class="col-sm-12 col-12">
    <label for="">Description</label>
    <textarea name="" id="" cols="5" rows="4 " class="form-control" name="description"></textarea>
    </div>
    </div>
    </div>
    
</div>
