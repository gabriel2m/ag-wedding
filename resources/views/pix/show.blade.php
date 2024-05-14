<div
    class="w-full"
    hx-swap-oob="true"
    id="gift-{{ request()->id }}-content"
>
    <div class="flex w-full justify-center">
        {!! $qr_code !!}
    </div>
    <p class="font-medium">
        Copia e cola:
    </p>
    <p class="break-words rounded border px-3 py-1.5">
        {{ $payload }}
    </p>
    <p class="mt-2 font-medium">
        Chave Pix:
    </p>
    <p class="break-words rounded border px-3 py-1.5">
        {{ config('app.pix.key') }}
    </p>
    <p class="mt-3">
        Para fazer o pix basta abrir o aplicativo do seu banco e realizar <span class="font-semibold">uma</span> das opções:
    </p>
    <p class="mt-2">
        1. Ir na área Pix e copiar o codigo "copia e cola" que está acima e colar no aplicativo.
    </p>
    <p class="mt-2">
        2. Ler o Qr Code acima.
    </p>
    <p class="mt-2">
        3. Copiar a chave pix e gerar o pix pelo próprio aplicativo.
    </p>
    <p class="mt-2 font-medium">
        Deus abençoe grandemente,
        <br />
        Amanda e Gabriel.
    </p>
</div>
