<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaService
{
    /**
     * Medya dosyasını modele ekle.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $collection
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function uploadMedia($model, $file, $collection = 'page')
    {
        return $model->addMedia($file)->toMediaCollection($collection);
    }

    /**
     * Modele ait medya dosyalarını listele.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $collection
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listMedia($model, $collection = 'page')
    {
        return $model->getMedia($collection);
    }

    /**
     * Medya dosyasını sil.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     * @return void
     */
    public function deleteMedia(Media $media)
    {
        $media->delete();
    }
}
