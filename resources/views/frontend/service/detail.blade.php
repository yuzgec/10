@extends('frontend.layout.app')
@section('customCSS')
    @if(!$detail->addGoogle)
        <meta name="robots" content="noindex">
    @endif
@endsection

@section('content')

<section class="wrapper !bg-[#edf2fc]">
    <div class="container text-center" style="padding-top: 60px;padding-bottom:60px">
        <div class="flex flex-wrap mx-[-15px]">
            <div class="sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-6/12 xxl:w-5/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                <h1 class="text-[calc(1.365rem_+_1.38vw)] font-bold leading-[1.2] xl:text-[2.4rem] mb-3 text-[#343f52]">{{ $detail->name}}</h1>
                <nav class="inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb  flex flex-wrap bg-[none] p-0 !rounded-none list-none mb-[20px]">
                        <li class="breadcrumb-item flex text-[#60697b]">
                            <a class="text-[#60697b] hover:text-[#3f78e0]" href="{{ route('home')}}">Anasayfa</a>
                        </li>
                        <li class="breadcrumb-item flex text-[#60697b] pl-2 before:font-normal before:flex before:items-center before:text-[rgba(96,105,123,.35)] before:content-['\e931'] before:text-[0.9rem] before:-mt-px before:pr-2 before:font-Unicons active"
                            aria-current="page">{{ $detail->getCategory->name}}</li>
                        <li class="breadcrumb-item flex text-[#60697b] pl-2 before:font-normal before:flex before:items-center before:text-[rgba(96,105,123,.35)] before:content-['\e931'] before:text-[0.9rem] before:-mt-px before:pr-2 before:font-Unicons active"
                            aria-current="page">{{ $detail->name}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

@if(!$detail->deleteContent)
    <section class="wrapper !bg-[#ffffff]  angled upper-end relative border-0 before:top-[-4rem] before:border-l-transparent before:border-r-[100vw] before:border-t-[4rem] before:border-[#fefefe] before:content-[''] before:block before:absolute before:z-0 before:border-y-transparent before:border-0 before:border-solid before:right-0 after:content-[''] after:block after:absolute after:z-0 after:border-y-transparent after:border-[#fefefe] after:border-0 after:border-solid after:right-0">
        <div class="container">
            <div class="flex flex-wrap mx-[-15px] mt-[-15px]">
                    
                <div class="xl:w-9/12 w-full flex-[0_0_auto] px-[15px] max-w-full mt-[15px]">
                        {!! $detail->desc !!}
                </div>

                <div class="xl:w-3/12 w-full flex-[0_0_auto] px-[15px] max-w-full mt-[15px]">
                    <div class="job-list">
                        <h3 class="!mb-4">{{ $detail->getCategory->name}}</h3>
                        @foreach ($services->where('category_id', $detail->getCategory->id) as $item)
                            
                        
                        <a href="{{ route('service.detail', [$item->getCategory->slug, $item->slug])}}" title="{{ $item->name }}" class="card mb-4 lift" style="background-color:{{($detail->id == $item->id ) ? '#e2e2e2' : null}}">
                            <div class="card-body p-2">
                                <span class="flex flex-wrap mx-[-10px] justify-between items-center">
                                    <span class="w-12/12 md:w-12/12 lg:w-12/12 xl:w-12/12 flex-[0_0_auto] px-[15px] max-w-full text-[#60697b] flex items-center">
                                        {{ $item->name}}
                                    </span>
                                    <span class="hidden xl:block lg:block w-1/12 flex-[0_0_auto] px-[15px] max-w-full !text-center text-[#60697b]">
                                        <i class="uil uil-angle-right-b before:content-['\e930']"></i>
                                    </span>
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@endsection