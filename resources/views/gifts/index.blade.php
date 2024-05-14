@foreach ($gifts as $gift)
    <div class="flex h-[28rem] w-72 flex-col overflow-hidden rounded-xl border border-slate-500/10 shadow-lg">
        <img
            class="h-56 w-full"
            src="{{ $gift->image }}"
        />
        <p class="px-8 pt-5 text-xl">
            {{ $gift->name }}
        </p>
        <div
            class="mb-6 mt-auto px-8"
            x-data="{ showModal: false }"
        >
            <h5 class="font-semibold">
                @reais($gift->price)
            </h5>
            <button
                class="mt-5 rounded-full bg-green-950/95 px-6 py-2 font-medium text-white"
                x-on:click="showModal=true"
            >
                @lang('Give')
            </button>
            <div
                class="fixed left-0 top-0 z-50 flex h-full w-full bg-gray-500 bg-opacity-50"
                x-show="showModal"
            >
                <div class="m-auto flex flex-wrap rounded-xl border bg-white px-5 py-3 shadow">
                    <button
                        class="mb-auto ml-auto mt-0.5 text-gray-600"
                        type="button"
                        x-on:click="showModal = false"
                    >
                        <x-heroicon-o-x-mark class="h-5" />
                    </button>
                    <form
                        class="flex w-full flex-col gap-4"
                        id="gift-{{ $gift->id }}-content"
                    >
                        <input
                            name="id"
                            type="hidden"
                            value="{{ $gift->id }}"
                        />
                        <div>
                            <x-admin.label for="amount" />
                            <x-admin.text-input
                                autocomplete="off"
                                data-inputmask="'alias': 'currency', 'radixPoint': ',', 'autoUnmask': true"
                                name="amount"
                                required
                                type="text"
                                value="{{ number_format($gift->price, 2, ',', '') }}"
                                x-bind:disabled="disable"
                            />
                            <div id="gift-{{ $gift->id }}-amount-error"></div>
                        </div>
                        <div>
                            <x-admin.label
                                for="message"
                                text="Your name and message"
                            />
                            <x-admin.textarea
                                autocomplete="off"
                                maxlength="{{ 69 - strlen(config('app.pix.key')) }}"
                                name="message"
                                x-bind:disabled="disable"
                            />
                            <div id="gift-{{ $gift->id }}-message-error"></div>
                        </div>
                        <div class="flex py-3">
                            <button
                                class="m-auto rounded-full bg-green-950/95 px-6 py-2 font-medium text-white"
                                hx-post="{{ route('pix') }}"
                                hx-swap="none"
                            >
                                @lang('Generate Pix')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@if ($gifts->hasMorePages())
    <div class="content flex w-full justify-center">
        <button
            class="m-auto h-min rounded border border-slate-200 px-6 py-1.5 text-xs uppercase text-slate-700 hover:bg-neutral-500 hover:bg-opacity-10"
            hx-disabled-elt="this"
            hx-get="{{ $gifts->nextPageUrl() }}"
            hx-swap="outerHTML"
            hx-target="closest div"
            type="button"
        >
            @lang('Load more')
            <x-admin.loading class="h-5" />
        </button>
    </div>
@endif
