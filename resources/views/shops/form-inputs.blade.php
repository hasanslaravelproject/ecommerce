@php $editing = isset($shop) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $shop->name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="address"
            label="Address"
            value="{{ old('address', ($editing ? $shop->address : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $shop->email : '')) }}"
            maxlength="255"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="profile_image"
            label="Profile Image"
            value="{{ old('profile_image', ($editing ? $shop->profile_image : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $shop->status : 'Inactive')) @endphp
            <option value="inactive" {{ $selected == 'inactive' ? 'selected' : '' }} >Inactive</option>
            <option value="active" {{ $selected == 'active' ? 'selected' : '' }} >Active</option>
            <option value="band" {{ $selected == 'band' ? 'selected' : '' }} >Band</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
