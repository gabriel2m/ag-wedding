<?php

namespace App\Http\Controllers;

use App\Http\Requests\PixRequest;
use App\Services\PixService;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class PixController extends Controller
{
    public function __invoke(PixRequest $request, PixService $pixService)
    {
        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(300),
                new SvgImageBackEnd()
            )
        );

        $payload = $pixService->payload(
            $request->float('amount'),
            "$request->id, {$request->string('message')->ascii()->lower()->trim()}"
        );

        return view('pix.show', [
            'qr_code' => $writer->writeString($payload),
            'payload' => $payload,
        ]);
    }
}
