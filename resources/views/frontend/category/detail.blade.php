@extends('frontend.layout.app')

@section('content')

    <section class="wrapper !bg-[#edf2fc]">
        <div class="container text-center" style="padding-top: 40px;padding-bottom:40px">
            <div class="flex flex-wrap mx-[-15px]">
                <div class="sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-6/12 xxl:w-5/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                    <h1 class="text-[calc(1.365rem_+_1.38vw)] font-bold leading-[1.2] xl:text-[2.4rem] mb-3 text-[#343f52]">{{ $detail->name}}</h1>
                    <nav class="inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb  flex flex-wrap bg-[none] p-0 !rounded-none list-none mb-[20px]">
                            <li class="breadcrumb-item flex text-[#60697b]">
                                <a class="text-[#60697b] hover:text-[#3f78e0]" href="{{ route('home')}}">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item flex text-[#60697b] pl-2 before:font-normal before:flex before:items-center before:text-[rgba(96,105,123,.35)] before:content-['\e931'] before:text-[0.9rem] before:-mt-px before:pr-2 before:font-Unicons active"
                                aria-current="page">İzmir Ajans</li>
                            <li class="breadcrumb-item flex text-[#60697b] pl-2 before:font-normal before:flex before:items-center before:text-[rgba(96,105,123,.35)] before:content-['\e931'] before:text-[0.9rem] before:-mt-px before:pr-2 before:font-Unicons active"
                                aria-current="page">{{ $detail->name}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="wrapper !bg-[#ffffff] ">
        <div class="container">

            <div class="flex flex-wrap mx-[-15px] row-cols-2 row-cols-md-3 row-cols-xl-5 xl:mx-[-15px] lg:mx-[-15px] mt-[-30px] justify-center">
                @foreach ($services->where('category_id', $detail->id) as $item)
                <div class="xl:w-4/12 lg:w-4/12 md:w-4/12 w-6/12 flex-[0_0_auto] px-[15px] max-w-full mt-[30px]">
                    <a href="{{ route('service.detail', $item->slug) }}">
                    <div class="card !shadow-[0_0.25rem_1.75rem_rgba(30,34,40,0.07)] !h-full items-center">
                        <div class="card-body items-center flex !px-3 py-6 xl:!p-8 lg:!p-8 md:!p-8">
                            <figure class="md:!px-3 xl:!px-0 xxl:!px-3  !mb-0">
                                <h4>{{ $item->name}}</h4>
                            </figure>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
                  
            <h2 class="!text-[.75rem] uppercase text-[#aab0bc] !mb-3 tracking-[0.02rem] leading-[1.35]">Our Clients</h2>
            <div class="flex flex-wrap mx-[-15px] xl:mx-[-20px] lg:mx-[-20px] mb-10 mt-[-25px]">
                <div class="xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] xl:px-[20px] lg:px-[20px] px-[15px] max-w-full mt-[25px]">
                    <h3 class="text-[calc(1.285rem_+_0.42vw)] font-bold xl:text-[1.6rem] !leading-[1.3] !mb-0">We
                        are trusted by over 300+ clients. Join them by using our services and grow your
                        business.
                    </h3>
                </div>
                <div class="xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] xl:px-[20px] lg:px-[20px] px-[15px] max-w-full mt-[25px]">
                    <p class="lead text-[0.9rem] font-medium leading-[1.65] !mb-0">Donec</p>
                </div>
            </div>
        </div>
    </section>
@endsection