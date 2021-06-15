@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('shops.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.shops.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.shops.inputs.name')</h5>
                    <span>{{ $shop->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.shops.inputs.address')</h5>
                    <span>{{ $shop->address ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.shops.inputs.email')</h5>
                    <span>{{ $shop->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.shops.inputs.profile_image')</h5>
                    <span>{{ $shop->profile_image ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.shops.inputs.status')</h5>
                    <span>{{ $shop->status ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('shops.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Shop::class)
                <a href="{{ route('shops.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
