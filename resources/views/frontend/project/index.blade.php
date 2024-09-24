@extends('frontend.layout.app')
@section('content')
<div class="container pt-10 pb-36 xl:pt-[4.5rem] lg:pt-[4.5rem] md:pt-[4.5rem] xl:pb-40 lg:pb-40 md:pb-40 !text-center">
    <div class="flex flex-wrap mx-[-15px]">
        <div class="sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-6/12 xxl:w-5/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
            <h1 class="text-[calc(1.365rem_+_1.38vw)] font-bold leading-[1.2] xl:text-[2.4rem] mb-3 text-[#343f52]">Yaptığımız Bazı Çalışmalar</h1>
            <nav class="inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb  flex flex-wrap bg-[none] p-0 !rounded-none list-none mb-[20px]">
                    <li class="breadcrumb-item flex text-[#60697b]">
                        <a class="text-[#60697b] hover:text-[#3f78e0]" href="{{ route('home')}}">Anasayfa</a>
                    </li>
                    <li class="breadcrumb-item flex text-[#60697b] pl-2 before:font-normal before:flex before:items-center before:text-[rgba(96,105,123,.35)] before:content-['\e931'] before:text-[0.9rem] before:-mt-px before:pr-2 before:font-Unicons active"
                        aria-current="page">Projeler
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
</section>
@endsection