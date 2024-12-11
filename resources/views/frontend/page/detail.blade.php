@extends('frontend.layout.app')
@if(!$detail->addGoogle)
    <meta name="robots" content="noindex">
@endif
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

  <section class="wrapper bg-white" style="margin-top:80px;margin-bottom:50px">
    <div class="container">
        <div class="flex flex-wrap mx-[-15px]">
            <div class="xl:w-10/12 lg:w-10/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                <div class="blog single !mt-[-7rem]">
                    <div class="card">
                        <figure class="flex flex-wrap mx-auto " style="margin-top:50px">
                            <img src="/frontend/img/godijital.png" alt="İzmir GO Dijital Web Tasarım ve Reklam Ajansı" style="width:400px">
                        </figure>
                        <div class="card-body flex-[1_1_auto] p-[40px] xl:p-[2.8rem_3rem_2.8rem] lg:p-[2.8rem_3rem_2.8rem] md:p-[2.8rem_3rem_2.8rem]">
                            <div class="classic-view">
                                <article class="post mb-8">
                                    <div class="relative mb-5">
                                        <h2 class="h1 !mb-4 !leading-[1.3]">İzmir GO Dijital Web Tasarım ve Reklam Ajansı</h2>
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
    </section>
    @endif

  

@endsection