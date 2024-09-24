<div class="form-group mb-3 row">
    <label class="form-label col-{{$column}} col-form-label">{{$label}}</label>
    <div class="col">
        {{Form::text($name, null,
         ["class" => $class . (($errors->has($name)) ? " is-invalid" : ""),
         'placeholder' => $placeholder, 
         'id' => $id,
         'maxlength' => $maxlength,
          ...[], 
        ],)}}
        @if($errors->has($name))
            <div class="invalid-feedback" style="display: block">{{$errors->first($name)}}</div>
        @endif
        @if($maxlength > 0)
            <small class="charCount character-count"></small>
        @endif

    </div>
</div>
