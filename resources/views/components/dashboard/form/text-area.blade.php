<div class="form-group mb-3 row">
    <label class="form-label col-3 col-form-label">{{$label}}</label>
    <div class="col">

        {!! Html::textarea($name)
            ->class($class . ($errors->has($name) ? ' is-invalid' : '')) // Hata durumunda 'is-invalid' sınıfı
            ->id($ck) // ID değeri
            ->attribute('rows', 5) // Satır sayısı
        !!}
    </div>
</div>
@if($errors->has($name))
    <div class="invalid-feedback">{{$errors->first($name)}}</div>
@endif
