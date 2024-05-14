<div
    class="flex w-full justify-center"
    hx-swap-oob="true"
    id="gift-{{ request()->id }}-content"
>
    <div class="w-96">
        <div class="flex w-full justify-center">
            {!! $qr_code !!}
        </div>
        <p class="font-medium">
            Copia e cola:
        </p>
        <p class="break-words rounded border px-3 py-1.5">
            {{ $payload }}
        </p>
        <p class="mt-3">
            Para realizar o pix basta abrir o aplicativo do seu banco,
        </p>
        <p class="mt-2">
            Ir na área Pix e copiar o codigo "copia e cola" e colar no aplicativo.
        </p>
        <p class="mt-2">
            Ou ler o Qr Code acima.
        </p>
        <p class="mt-2 font-medium">
            Deus abençoe grandemente,
            <br />
            Amanda e Gabriel.
        </p>
    </div>
</div>
