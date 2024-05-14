<?php

namespace App\Services;

class PixService
{
    public const ID_PAYLOAD_FORMAT_INDICATOR = '00';

    public const ID_MERCHANT_ACCOUNT_INFORMATION = '26';

    public const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';

    public const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';

    public const ID_MERCHANT_ACCOUNT_INFORMATION_MESSAGE = '02';

    public const ID_MERCHANT_CATEGORY_CODE = '52';

    public const ID_TRANSACTION_CURRENCY = '53';

    public const ID_TRANSACTION_AMOUNT = '54';

    public const ID_COUNTRY_CODE = '58';

    public const ID_MERCHANT_NAME = '59';

    public const ID_MERCHANT_CITY = '60';

    public const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';

    public const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';

    public const ID_CRC16 = '63';

    public const SIZE_CRC16 = '04';

    public const MERCHANT_ACCOUNT_INFORMATION_GUI = 'br.gov.bcb.pix';

    public const PAYLOAD_FORMAT_INDICATOR = '01';

    public const MERCHANT_CATEGORY_CODE = '0000';

    public const TRANSACTION_CURRENCY = '986';

    public const COUNTRY_CODE = 'BR';

    public const ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '***';

    public function payload(float $amount, ?string $message = null): string
    {
        if (! config('app.pix.key')) {
            throw new \InvalidArgumentException('Pix key needs to be set');
        }

        $merchant_account_information_value = $this->payloadValue(static::ID_MERCHANT_ACCOUNT_INFORMATION_GUI, static::MERCHANT_ACCOUNT_INFORMATION_GUI)
            .$this->payloadValue(static::ID_MERCHANT_ACCOUNT_INFORMATION_KEY, config('app.pix.key'))
            .$this->payloadValue(static::ID_MERCHANT_ACCOUNT_INFORMATION_MESSAGE, $message ?? '');

        if (strlen($merchant_account_information_value) > 99) {
            throw new \InvalidArgumentException('Too long merchant account information');
        }

        $txid_value = $this->payloadValue(static::ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID, static::ADDITIONAL_DATA_FIELD_TEMPLATE_TXID);

        $payload = $this->payloadValue(static::ID_PAYLOAD_FORMAT_INDICATOR, static::PAYLOAD_FORMAT_INDICATOR)
            .$this->payloadValue(static::ID_MERCHANT_ACCOUNT_INFORMATION, $merchant_account_information_value)
            .$this->payloadValue(static::ID_MERCHANT_CATEGORY_CODE, static::MERCHANT_CATEGORY_CODE)
            .$this->payloadValue(static::ID_TRANSACTION_CURRENCY, static::TRANSACTION_CURRENCY)
            .$this->payloadValue(static::ID_TRANSACTION_AMOUNT, number_format($amount, 2, '.', ''))
            .$this->payloadValue(static::ID_COUNTRY_CODE, static::COUNTRY_CODE)
            .$this->payloadValue(static::ID_MERCHANT_NAME, config('app.pix.name'))
            .$this->payloadValue(static::ID_MERCHANT_CITY, config('app.pix.city'))
            .$this->payloadValue(static::ID_ADDITIONAL_DATA_FIELD_TEMPLATE, $txid_value);

        return $payload.$this->payloadValue(self::ID_CRC16, $this->CRC16($payload));
    }

    private function payloadValue(string $id, string $value): string
    {
        if (empty($value)) {
            return '';
        }

        $size = str(strlen($value))->padLeft(2, '0');

        return "$id$size$value";
    }

    private function CRC16(string $payload): string
    {
        $payload .= self::ID_CRC16.self::SIZE_CRC16;

        $polynom = 0x1021;
        $result = 0xFFFF;

        if (($length = strlen($payload)) > 0) {
            for ($offset = 0; $offset < $length; $offset++) {
                $result ^= (ord($payload[$offset]) << 8);
                for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                    if (($result <<= 1) & 0x10000) {
                        $result ^= $polynom;
                    }
                    $result &= 0xFFFF;
                }
            }
        }

        return strtoupper(dechex($result));
    }
}
