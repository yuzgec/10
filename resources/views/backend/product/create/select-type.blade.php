@extends('backend.layout.app')

@section('content')
<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ürün Tipi Seçin</h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('product.create.simple') }}" class="card card-link">
                                <div class="card-body text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg mb-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 12v-6a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v8"></path>
                                        <path d="M10 12l4 4m0 -4l-4 4"></path>
                                    </svg>
                                    <h3>Basit Ürün</h3>
                                    <p class="text-muted">
                                        Tek bir varyasyonu olan standart ürünler için.
                                        Örneğin: Kitap, bardak vb.
                                    </p>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-6">
                            <a href="{{ route('product.create.variable') }}" class="card card-link">
                                <div class="card-body text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg mb-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 4h6a2 2 0 0 1 2 2v14l-5 -3l-5 3v-14a2 2 0 0 1 2 -2"></path>
                                    </svg>
                                    <h3>Varyantlı Ürün</h3>
                                    <p class="text-muted">
                                        Renk, beden gibi farklı seçenekleri olan ürünler için.
                                        Örneğin: Tişört, ayakkabı vb.
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 