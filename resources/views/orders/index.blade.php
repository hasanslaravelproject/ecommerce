@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.orders.index_title')</h4>
                </div>

                <div class="searchbar mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{route('orders.index')}}" method="get">
                                <div class="input-group">
                                    <input

                                        type="text"
                                        name="token"
                                        placeholder="enter order token"
                                        value="{{isset($requestData['token'])?$requestData['token']:''}}"
                                        class="form-control"
                                        autocomplete="off"
                                    />
                                    <div class="input-group-append">
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">
                            @can('create', App\Models\Order::class)
                                <a
                                    href="{{ route('orders.create') }}"
                                    class="btn btn-primary"
                                >
                                    <i class="icon ion-md-add"></i>
                                    @lang('crud.common.create')
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.orders.inputs.total')
                            </th>
                            <th class="text-right">
                                @lang('crud.orders.inputs.discount')
                            </th>
                            <th class="text-left">
                                @lang('crud.orders.inputs.stauts')
                            </th>

                            <th class="text-left">
                                Validation
                            </th>

                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->total ?? '-' }}</td>
                                <td>{{ $order->discount ?? '-' }}</td>
                                <td>
                                    @if($order->status=='pending')
                                    <button type="button"
                                            class="btn light badge-danger btn-sm dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false">
                                        {{ucwords($order->status)}}
                                    </button>
                                    @elseif($order->status=='approved')
                                        <button type="button"
                                                class="btn light badge-success btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            {{ucwords($order->status)}}
                                        </button>
                                    @elseif($order->status=='on_the_way')
                                        <button type="button"
                                                class="btn light badge-info btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            {{ucwords($order->status)}}
                                        </button>
                                    @elseif($order->status=='delivered')
                                        <button type="button"
                                                class="btn light badge-success btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            {{ucwords($order->status)}}
                                        </button>
                                    @elseif($order->status=='rejected')
                                        <button type="button" disabled
                                                class="btn light badge-danger light btn-sm">
                                            {{ucwords($order->status)}}
                                        </button>
                                    @endif




                                    @if ($order->expire_date > now())
                                    <div class="dropdown-menu" x-placement="bottom-start"
                                         style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                        @if($order->status=='pending')
                                            <button
                                                data-order-id="{{$order->id}}"
                                                data-status="approved"
                                                type="button"
                                                data-confirmation="{{trans('Are you sure to approved this order')}}"
                                                class="statusChange dropdown-item">
                                                Approve
                                            </button>
                                            <button
                                                data-order-id="{{$order->id}}"
                                                data-status="rejected"
                                                type="button"
                                                data-confirmation="{{trans('Are you sure to reject this order')}}"
                                                class="statusChange dropdown-item">
                                                Reject
                                            </button>
                                        @elseif($order->status=='approved')
                                            <button
                                                data-order-id="{{$order->id}}"
                                                data-status="on_the_way"
                                                type="button"
                                                data-confirmation="{{trans('Are you sure to ready this order')}}"
                                                class="statusChange dropdown-item">
                                                Ready for delivered
                                            </button>
                                        @elseif($order->status=='on_the_way')
                                            <button
                                                data-order-id="{{$order->id}}"
                                                data-status="delivered"
                                                type="button"
                                                data-confirmation="{{trans('Are you sure to delivered this order')}}"
                                                class="statusChange dropdown-item">
                                                Delivered
                                            </button>
                                        @elseif($order->status=='rejected')
                                            <button disabled class=" dropdown-item">
                                                Rejected
                                            </button>
                                        @endif
                                    </div>
                                        @endif
                                </td>
                                @php
                                    $settings=\App\Models\Settings::where('key','order_booking')->first();
                                     $validateTime=json_decode($settings->value);
                                @endphp
                                <td>
                                    @if ($order->expire_date > now())
                                        available
                                    @else
                                        unavailable
                                    @endif

                                </td>
                                @if ($order->expire_date > now())
                                    <td class="text-center" style="width: 134px;">
                                        <div
                                            role="group"
                                            aria-label="Row Actions"
                                            class="btn-group"
                                        >
                                            @can('update', $order)
                                                <a
                                                    href="{{ route('orders.edit', $order) }}"
                                                >
                                                    <button
                                                        type="button"
                                                        class="btn btn-light"
                                                    >
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                            @endcan @can('view', $order)
                                                <a
                                                    href="{{ route('orders.show', $order) }}"
                                                >
                                                    <button
                                                        type="button"
                                                        class="btn btn-light"
                                                    >
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                            @endcan @can('delete', $order)
                                                <form
                                                    action="{{ route('orders.destroy', $order) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                                >
                                                    @csrf @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="btn btn-light text-danger"
                                                    >
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">{{$orders}}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('Change order status')}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;
                    </button>
                </div>
                <form action="{{route('orders.status.change')}}" method="get">
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="status" name="status">
                        <h4 id="confirmation"></h4>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{trans('Confirm')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.statusChange').on('click', function (e) {
            e.preventDefault();
            const id = $(this).attr('data-order-id');
            const status = $(this).attr('data-status');
            const confirmation = $(this).attr('data-confirmation');

            $('#id').val(id);
            $('#confirmation').text(confirmation);
            $('#status').val(status);
            $('#statusModal').modal('show');
        })
    </script>
    @endsection
