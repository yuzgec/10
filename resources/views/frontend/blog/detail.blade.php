@extends('frontend.layout.app')
    @if(!$detail->addGoogle)
        <meta name="robots" content="noindex">
    @endif
@section('content')

<section class="wrapper !bg-[#edf2fc]">
    <div class="container text-center" style="padding-top: 60px;padding-bottom:60px">
        <div class="flex flex-wrap mx-[-15px]">
            <div class="md:w-10/12 lg:w-10/12 xl:w-8/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                <div class="post-header !mb-[.9rem]">
                    <div class="inline-flex uppercase tracking-[0.02rem] text-[0.7rem] font-bold text-[#aab0bc] mb-[0.4rem]  text-line relative align-top pl-[1.4rem] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-[#3f78e0]">
                        <a href="{{ route('blog.category', $detail->getCategory->slug) }}" class="hover" rel="category">{{ $detail->getCategory->name}}</a>
                    </div>
                    <h1 class="text-[calc(1.365rem_+_1.38vw)] font-bold leading-[1.2] xl:text-[2.4rem] mb-4">
                        @php $formattedText = str_replace(',', "\n", $detail->name); echo
                        nl2br($formattedText) @endphp
                    </h1>
                    <ul class="text-[0.8rem] text-[#aab0bc] m-0 p-0 list-none !mb-5">
                        <li class="post-date inline-block">
                            <i
                                class="uil uil-calendar-alt pr-[0.2rem] align-[-.05rem] before:content-['\e9ba']"></i>
                            <span>{{$detail->created_at}}</span>
                        </li>
                        <li
                            class="post-author inline-block before:content-[''] before:inline-block before:w-[0.2rem] before:h-[0.2rem] before:opacity-50 before:m-[0_.6rem_0_.4rem] before:rounded-[100%] before:align-[.15rem] before:bg-[#aab0bc]">
                            <i class="uil uil-user pr-[0.2rem] align-[-.05rem] before:content-['\ed6f']"></i>
                            <span>GO Dijital</span>
                        </li>
                        <li
                            class="post-likes inline-block before:content-[''] before:inline-block before:w-[0.2rem] before:h-[0.2rem] before:opacity-50 before:m-[0_.6rem_0_.4rem] before:rounded-[100%] before:align-[.15rem] before:bg-[#aab0bc]">
                            <i class="uil uil-eye pr-[0.2rem] align-[-.05rem]"></i>
                            {{ views($detail)->unique()->count()}}
                            <span>
                                Görüntülenme</span>
                        </li>
                    </ul>
                </div>
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
                        GO Dijital
                </div>

            </div>
        </div>
    </section>
@endif
@endsection