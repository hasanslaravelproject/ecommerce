@php $editing = isset($order) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="total"
            label="Total"
            value="{{ old('total', ($editing ? $order->total : '')) }}"
            max="255"
            step="0.01"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="discount"
            label="Discount"
            value="{{ old('discount', ($editing ? $order->discount : '')) }}"
            max="255"
            step="0.01"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="stauts" label="Stauts">
            @php $selected = old('stauts', ($editing ? $order->stauts : '')) @endphp
            <option value="pending" {{ $selected == 'pending' ? 'selected' : '' }} >Pending</option>
            <option value="approved" {{ $selected == 'approved' ? 'selected' : '' }} >Approved</option>
            <option value="rejected" {{ $selected == 'rejected' ? 'selected' : '' }} >Rejected</option>
            <option value="on_the_way" {{ $selected == 'on_the_way' ? 'selected' : '' }} >On the way</option>
            <option value="delivered" {{ $selected == 'delivered' ? 'selected' : '' }} >Delivered</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
