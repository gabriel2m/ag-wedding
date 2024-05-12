<div class="grid grid-cols-3 gap-x-6 gap-y-5">
    <div class="col-span-2">
        <x-admin.label for="name" />
        <x-admin.text-input
            autocomplete="off"
            name="name"
            required
            value="{{ $gift->name }}"
            x-bind:disabled="disable"
        />
        <x-error name="name" />
    </div>
    <div class="col-span-1">
        <x-admin.label for="price" />
        <x-admin.text-input
            autocomplete="off"
            data-inputmask="'alias': 'currency'"
            name="price"
            type="text"
            value="{{ $gift->price }}"
            x-bind:disabled="disable"
        />
        <x-error name="price" />
    </div>
    <div class="col-span-full">
        <x-admin.label for="image" />
        <x-admin.text-input
            autocomplete="off"
            name="image"
            required
            value="{{ $gift->image }}"
            x-bind:disabled="disable"
        />
        <x-error name="image" />
    </div>
</div>
