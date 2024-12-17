@extends('frontend.layout.app')

@section('content')

    <section class="wrapper" style="background-color:#011e3d">
        <div class="container text-center" style="padding-top: 60px;padding-bottom:60px">
            <div class="flex flex-wrap mx-[-15px]">
                <div class="sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-6/12 xxl:w-5/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                    <h1 class="text-[calc(1.365rem_+_1.38vw)] font-bold leading-[1.2] xl:text-[2.4rem] mb-3 text-white">{{ $detail->name}}</h1>
                    <nav class="inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb  flex flex-wrap bg-[none] p-0 !rounded-none list-none mb-[20px]">
                            <li class="breadcrumb-item flex text-white">
                                <a class="text-white hover:text-white" href="{{ route('home')}}">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item flex text-white pl-2 before:font-normal before:flex before:items-center before:text-[rgba(96,105,123,.35)] before:content-['\e931'] before:text-[0.9rem] before:-mt-px before:pr-2 before:font-Unicons active"
                                aria-current="page">İzmir Ajans</li>
                            <li class="breadcrumb-item flex text-white pl-2 before:font-normal before:flex before:items-center before:text-[rgba(96,105,123,.35)] before:content-['\e931'] before:text-[0.9rem] before:-mt-px before:pr-2 before:font-Unicons active"
                                aria-current="page">{{ $detail->name}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="wrapper !bg-[#ffffff]  angled upper-end relative border-0 before:top-[-4rem] before:border-l-transparent before:border-r-[100vw] before:border-t-[4rem] before:border-[#fefefe] before:content-[''] before:block before:absolute before:z-0 before:border-y-transparent before:border-0 before:border-solid before:right-0 after:content-[''] after:block after:absolute after:z-0 after:border-y-transparent after:border-[#fefefe] after:border-0 after:border-solid after:right-0">
        <div class="container">



            <div class="flex flex-wrap mx-[-15px] row-cols-2 row-cols-md-3 row-cols-xl-5 mb-10 justify-center">
                @foreach ($services->where('category_id', $detail->id) as $item)

                    <div class="xl:w-4/12 group cursor-dark rounded lg:w-4/12 md:w-4/12 w-6/12 flex-[0_0_auto] px-[15px] max-w-full mt-[30px]">
                    <a href="{{ route('service.detail', [$item->getCategory->slug, $item->slug]) }}" title="{{ $item->name }}">
                    <div class="card lift !shadow-[0_0.25rem_1.75rem_rgba(30,34,40,0.07)] !h-full items-center">
                        <div class="card-body items-center flex !px-3 py-6 xl:!p-8 lg:!p-8 md:!p-8">
                            <figure class=" md:!px-3 xl:!px-0 xxl:!px-3 !mb-0">
                                    <h4>{{ $item->name}}</h4>
                              
                            </figure>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
            
        </div>


    </section>


    <div class="container mt-10 mb-10">
        <div class="flex flex-wrap mx-[-15px]">
            <div class="xl:w-12/12 lg:w-10/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                <div class="blog single ">
                    <div class="card">
                      
                        <div class="card-body flex-[1_1_auto] p-[40px] xl:p-[2.8rem_3rem_2.8rem] lg:p-[2.8rem_3rem_2.8rem] md:p-[2.8rem_3rem_2.8rem]">
                            <div class="classic-view">
                                <article class="post mb-8">
                                    <div class="relative mb-5">
                                        <h2 class="h1 !mb-4 !leading-[1.3]">İzmir Foça GO Dijital Ajans - {{ $detail->name}}</h2>
                                        {!! $detail->desc !!}
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
@endsection