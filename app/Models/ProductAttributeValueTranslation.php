<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Traits\LogsActivityTrait;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttributeValueTranslation extends Model
{
    use LogsActivityTrait, HasFactory, HasSlug;

    public $timestamps = false;
    protected $guarded = [];

    protected $translationForeignKey = 'p_attribute_value_id';
    protected $logAttributes = ['value', 'slug'];
    protected $table = 'p_attr_val_trans';
    protected $fillable = ['locale', 'value', 'slug', 'product_attribute_value_id'];

    public function getCustomAttributeNames()
    {
        return ['value' => 'Değer', 'slug' => 'Link'];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('value')
            ->saveSlugsTo('slug')
            ->allowDuplicateSlugs();
    }

    public function attributeValue()
    {
        return $this->belongsTo(ProductAttributeValue::class, 'p_attribute_value_id');
    }
} 