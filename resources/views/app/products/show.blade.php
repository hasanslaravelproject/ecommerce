@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('products.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.products.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.name')</h5>
                    <span>{{ $product->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.slug')</h5>
                    <span>{{ $product->slug ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.status')</h5>
                    <span>{{ $product->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $product->image ? \Storage::url($product->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.shop_id')</h5>
                    <span>{{ optional($product->shop)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.category_id')</h5>
                    <span>{{ optional($product->category)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.products.inputs.brand_id')</h5>
                    <span>{{ optional($product->brand)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Product::class)
                <a href="{{ route('products.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
