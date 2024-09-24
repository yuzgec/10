<div class="form-group mb-3 row">
    <label class="form-label col-3 col-form-label">{{$label}}</label>
    <div class="col">
        {{Form::textArea($name, null, ["class" => $class . (($errors->has($name))?" is-invalid":""), 'id' => $ck, 'rows' => 5])}}
    </div>
</div>
@if($errors->has($name))
    <div class="invalid-feedback">{{$errors->first($name)}}</div>
@endif
