@extends('backend.layout.app')

@section('content') 

{!! html()->form()->method('POST')->action(route('product-attributes.store'))->attribute('data-action', 'create')->open() !!}

<x-dashboard.crud.create-header route='product-attributes' name="Özellik"/>

<div class="col-12">
    <div class="card">
        <div class="card-status-top bg-blue"></div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        @foreach($language as $lang)
                        <li class="nav-item">
                            <a href="#{{ $lang->lang }}" 
                                class="nav-link {{ $loop->first ? 'active' : '' }}"
                                data-bs-toggle="tab" 
                                role="tab">
                                <img src="/flags/{{ $lang->lang }}.svg" alt="{{ $lang->lang }}" style="margin-right: 5px;"> 
                                <b>{{ strtoupper($lang->lang) }}</b>
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        @foreach($language as $lang)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                 id="{{ $lang->lang }}" 
                                 role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Özellik Adı ({{ strtoupper($lang->lang) }})
                                    </label>
                                    <input type="text" 
                                           name="name[{{ $lang->lang }}]" 
                                           class="form-control"
                                           required>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="status" checked>
                    <span class="form-check-label">Aktif</span>
                </label>
            </div>
        </div>
    </div>
</div>

{!! html()->form()->close() !!}

@endsection 