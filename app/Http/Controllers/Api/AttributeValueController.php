<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\JsonResponse;

class AttributeValueController extends Controller
{
    public function getValues(ProductAttribute $attribute): JsonResponse
    {
        $values = $attribute->values()
            ->where('status', 1)
            ->orderBy('rank')
            ->get()
            ->map(function($value) {
                return [
                    'id' => $value->id,
                    'name' => $value->translate('tr')->name,
                    'color_code' => $value->color_code
                ];
            });

        return response()->json($values);
    }
} 