@extends('frontend.layout.app')
@section('content')

<section class="wrapper !bg-[#ffffff]  angled upper-end relative border-0 before:top-[-4rem] before:border-l-transparent before:border-r-[100vw] before:border-t-[4rem] before:border-[#fefefe] before:content-[''] before:block before:absolute before:z-0 before:border-y-transparent before:border-0 before:border-solid before:right-0 after:content-[''] after:block after:absolute after:z-0 after:border-y-transparent after:border-[#fefefe] after:border-0 after:border-solid after:right-0">
    
    <div  class="container" style="margin-top:50px;margin-bottom:50px">
        <div class="!relative">
            <div class="flex flex-wrap mx-[-15px] xl:mx-[-35px] lg:mx-[-20px] mt-[-50px] items-center">
                @foreach ($blog as $item )
                <div class="xl:w-4/12 lg:w-6/12 w-full flex-[0_0_auto] xl:px-[15px] lg:px-[20px] px-[15px] max-w-full mt-[50px] xl:!order-2 lg:!order-2 !relative">
                    <article>
                        <div class="card">
                    
                            <figure class="card-img-top overlay overlay-1 hover-scale group">
                                <a href="{{ route('blog.detail', $item->slug) }}" title="{{ $item->name}}">
                                    <img class="!transition-all !duration-[0.35s] !ease-in-out group-hover:scale-105" src="{{ $item->getFirstMediaUrl('page', 'thumb') }}" alt="İzmir Web Tasarım ve SEO Uzmanı ">
                                </a>
                                <figcaption class="group-hover:opacity-100 absolute w-full h-full opacity-0 text-center px-4 py-3 inset-0 z-[5] pointer-events-none p-2">
                                    <h5 class="from-top  !mb-0 absolute w-full translate-y-[-80%] p-[.75rem_1rem] left-0 top-2/4">Devamını Oku</h5>
                                </figcaption>
                            </figure>
                            <div class="card-body flex-[1_1_auto] p-[40px] xl:p-[1.75rem_1.75rem_1rem_1.75rem] lg:p-[1.75rem_1.75rem_1rem_1.75rem] md:p-[1.75rem_1.75rem_1rem_1.75rem] sm:pb-4 xsm:pb-4  ">
                                <div class="post-header">
                                    <div class="inline-flex mb-[.4rem] uppercase tracking-[0.02rem] text-[0.7rem] font-bold text-[#aab0bc] relative align-top pl-[1.4rem] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-[#3f78e0]">
                                        <a href="{{ route('blog.category', $item->getCategory->slug) }}" class="hover" rel="category">{{ $item->getCategory->name}}</a>
                                    </div>
                                    <h2 class="post-title h3 !mt-1 !mb-3">
                                        <a class="text-[#343f52] hover:text-[#3f78e0]"  href="{{ route('blog.detail', $item->slug) }}" title="{{ $item->name}}">{{ $item->name}}</a>
                                    </h2>
                                </div>
                                <div class="!relative">
                                    {{ $item->short}}
                                </div>
                            </div>

                            <div class="card-footer xl:p-[1.25rem_1.75rem_1.25rem] lg:p-[1.25rem_1.75rem_1.25rem] md:p-[1.25rem_1.75rem_1.25rem] p-[18px_40px]">
                                <ul class="text-[0.7rem] text-[#aab0bc] m-0 p-0 list-none flex  !mb-0">
                                    <li class="post-date inline-block">
                                        <i class="uil uil-calendar-alt pr-[0.2rem] align-[-.05rem] before:content-['\e9ba']"></i>
                                        <span>{{ $item->created_at}}</span>
                                    </li>
                                    <!--  <li class="post-comments inline-block before:content-[''] before:inline-block before:w-[0.2rem] before:h-[0.2rem] before:opacity-50 before:m-[0_.6rem_0] before:rounded-[100%] before:align-[.15rem] before:bg-[#aab0bc]">
                                        <a class="text-[#aab0bc] hover:text-[#3f78e0] hover:border-[#3f78e0]" href="#">
                                            <i class="uil uil-comment pr-[0.2rem] align-[-.05rem] before:content-['\ea54']"></i>
                                            4
                                        </a>
                                    </li> -->
                                    <li class="post-likes !ml-auto inline-block">
                                        <i class="uil uil-eye pr-[0.2rem] align-[-.05rem]"></i>
                                        {{ views($item)->unique()->count()}} Görüntülenme
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection