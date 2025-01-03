@extends('frontend.layout.app')
@section('content')
<div class="container py-12">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Site Analizi: {{ $analysis->name }}</h2>
            
            <!-- Desktop Görünüm -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Desktop Görünüm</h4>
                </div>
                <div class="card-body">
                    <img src="{{ Storage::url($analysis->desktop_image) }}" 
                         alt="Desktop Screenshot" 
                         class="img-fluid rounded shadow">
                </div>
            </div>

            <!-- Mobil Görünüm -->
            <div class="card">
                <div class="card-header">
                    <h4>Mobil Görünüm</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{ Storage::url($analysis->mobile_image) }}" 
                         alt="Mobile Screenshot" 
                         class="img-fluid rounded shadow" 
                         style="max-width: 375px">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection