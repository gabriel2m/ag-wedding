<div class="grid gap-x-6 gap-y-5 md:grid-cols-7">
    <div class="col-span-3">
        <x-admin.label for="name" />
        <x-admin.text-input
            autocomplete="off"
            name="name"
            required
            value="{{ $guest->name }}"
            x-bind:disabled="disable"
        />
        <x-error name="name" />
    </div>
    <div class="col-span-3">
        <x-admin.label for="phone_number" />
        <x-admin.text-input
            autocomplete="off"
            data-inputmask="'mask': '(99) 99999-9999'"
            name="phone_number"
            type="text"
            value="{{ $guest->phone_number }}"
            x-bind:disabled="disable"
        />
        <x-error name="phone_number" />
    </div>
    <div>
        <x-admin.label for="response" />
        <select
            class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-inset focus:ring-blue-400/80 sm:text-sm sm:leading-6"
            id="response"
            name="response"
        >
            @foreach (WeddingGuestResponse::cases() as $response)
                <option
                    @selected($response == $guest->response)
                    value="{{ $response->value }}"
                >
                    {{ $response->label() }}
                </option>
            @endforeach
        </select>
    </div>
</div>
