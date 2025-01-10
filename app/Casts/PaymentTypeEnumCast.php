<?php

namespace App\Casts;

use App\Enums\CustomerPaymentTypeEnum;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class PaymentTypeEnumCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?CustomerPaymentTypeEnum
    {
        if (!isset($value) || !in_array((int) $value, CustomerPaymentTypeEnum::values())) {
            return CustomerPaymentTypeEnum::ADVANCE;
        }
        return CustomerPaymentTypeEnum::from((int) $value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?int
    {
        if ($value instanceof CustomerPaymentTypeEnum) {
            return $value->value;
        }
        
        $intValue = isset($value) ? (int) $value : null;
        
        if (!isset($intValue) || !in_array($intValue, CustomerPaymentTypeEnum::values())) {
            return CustomerPaymentTypeEnum::ADVANCE->value;
        }
        
        return $intValue;
    }
} 