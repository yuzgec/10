<header class="relative wrapper !bg-[#f6f3f9]">
    <div
        class="gradient-5 text-white font-bold !text-[.75rem] mb-2 !relative"
        style="z-index: 1;">
        <div class="container py-2 !text-center">
            <p class="!mb-0">✨ Yazın Sıcağında, Web Sitenizi Yenileyin! %50 İndirimle
                Dijital Dünyada Parlayın!
                <a href="#" class="!text-white hover inline-flex items-center">
                    Detaylı Bilgi İçin
                    <i class="uil uil-arrow-right text-[0.8rem] before:content-['\e94c']"></i>
                </a>
            </p>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container xl:flex-row lg:flex-row !flex-nowrap items-center">
            <div class="navbar-brand w-full">
                <a href="{{ route('home')}}" title="Anasayfa">
                    <img
                        src="/frontend/img/godijital.png"
                        srcset="/frontend/img/godijital.png"
                        alt="İzmir Web Tasarım Ajansı"
                        style="width: 150px"></a>
                </div>
                <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                    <div class="offcanvas-header xl:hidden lg:hidden flex items-center justify-between flex-row p-6">
                        <h3 class="text-white xl:text-[1.5rem] !text-[calc(1.275rem_+_0.3vw)] !mb-0">GO Dijital</h3>
                        <button
                            type="button"
                            class="btn-close btn-close-white mr-[-0.75rem] m-0 p-0 leading-none text-[#343f52] transition-all duration-[0.2s] ease-in-out border-0 motion-reduce:transition-none before:text-[1.05rem] before:content-['\ed3b'] before:w-[1.8rem] before:h-[1.8rem] before:leading-[1.8rem] before:shadow-none before:transition-[background] before:duration-[0.2s] before:ease-in-out before:flex before:justify-center before:items-center before:m-0 before:p-0 before:rounded-[100%] hover:no-underline bg-inherit before:bg-[rgba(255,255,255,.08)] before:font-Unicons hover:before:bg-[rgba(0,0,0,.11)] focus:outline-0"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close">
                        </button>
                    </div>
                    <div class="offcanvas-body xl:!ml-auto lg:!ml-auto flex  flex-col !h-full">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a
                                    class="nav-link !text-[.85rem] !tracking-[normal] hover:!text-[#a07cc5] after:!text-[#a07cc5]"
                                    href="{{ route('home')}}"
                                    title="Anasayfa">
                                    {{ __('site.anasayfa') }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle !text-[.85rem] !tracking-[normal] hover:!text-[#a07cc5] after:!text-[#a07cc5]"
                                    href="#"
                                    data-bs-toggle="dropdown">
                                    Kurumsal
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($pages as $item )
                                    <li class="dropdown ">
                                        <a class="dropdown-item hover:!text-[#a07cc5]"
                                            href="{{ route('page.detail', $item->slug )}}">
                                            {{ $item->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle !text-[.85rem] !tracking-[normal] hover:!text-[#a07cc5] after:!text-[#a07cc5]"
                                    href="#"
                                    data-bs-toggle="dropdown">
                                    Hizmetler
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($categories->where('parent_id', 2) as $item )
                                    <li class="dropdown ">
                                        <a class="dropdown-item hover:!text-[#a07cc5]"
                                            href="{{ route('category.detail',$item->slug)}}">
                                            {{ $item->name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link !text-[.85rem] !tracking-[normal] hover:!text-[#a07cc5] after:!text-[#a07cc5]"
                                    href="{{ route('projects')}}">
                                    Çalışmalar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link !text-[.85rem] !tracking-[normal] hover:!text-[#a07cc5] after:!text-[#a07cc5]"
                                    href="{{ route('brands')}}">
                                    Markalar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link !text-[.85rem] !tracking-[normal] hover:!text-[#a07cc5] after:!text-[#a07cc5]"
                                    href="{{ route('blogs')}}">
                                    Blog
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link !text-[.85rem] !tracking-[normal] hover:!text-[#a07cc5] after:!text-[#a07cc5]"
                                    href="{{ route('contactus')}}">
                                    İletişim
                                </a>
                            </li>
                           {{--  @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li class="nav-item">

                                <a class="nav-link !text-[.85rem] !tracking-[normal] hover:!text-[#a07cc5] after:!text-[#a07cc5]"

                                       hreflang="{{ $localeCode }}"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, '/', [], true) }}">
                                        {{ $localeCode  }}
                                    </a>
                                </li>
                            @endforeach --}}
                        </ul>

                        <div class="offcanvas-footer xl:hidden lg:hidden">
                            <div>
                                <a href="mailto:{{ config('settings.email1')}}" class="link-inverse">{{ config('settings.email1')}}</a><br>{{ config('settings.telefon1')}}<br>
                                    <nav class="nav social social-white mt-4">
                                        <a
                                            class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]"
                                            href="#">
                                            <i class="uil uil-twitter before:content-['\ed59'] !text-white text-[1rem]"></i>
                                        </a>
                                        <a
                                            class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]"
                                            href="#">
                                            <i class="uil uil-facebook-f before:content-['\eae2'] !text-white text-[1rem]"></i>
                                        </a>
                                        <a
                                            class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]"
                                            href="#">
                                            <i class="uil uil-dribbble before:content-['\eaa2'] !text-white text-[1rem]"></i>
                                        </a>
                                        <a
                                            class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]"
                                            href="#">
                                            <i class="uil uil-instagram before:content-['\eb9c'] !text-white text-[1rem]"></i>
                                        </a>
                                        <a
                                            class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]"
                                            href="#">
                                            <i class="uil uil-youtube before:content-['\edb5'] !text-white text-[1rem]"></i>
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navbar-other w-full !flex !ml-auto">
                        <ul class="navbar-nav !flex-row !items-center !ml-auto">

                            <li class="nav-item">
                                <nav class="nav social social-muted justify-end text-right">
                                    <a
                                        class="m-[0_0_0_.7rem] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 hover:translate-y-[-0.15rem]"
                                        href="#">
                                        <i
                                            class="uil uil-instagram before:content-['\eb9c'] text-[1rem] text-[#d53581]"></i>
                                    </a>
                                </nav>
                            </li>
                            <li class="nav-item hidden xl:block lg:block md:block">
                                <a
                                    href="{{ route('offer')}}"
                                    class="btn btn-sm btn-violet text-white !bg-[#a07cc5] border-[#a07cc5] hover:text-white hover:bg-[#a07cc5] hover:border-[#a07cc5] focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-[#a07cc5] active:border-[#a07cc5] disabled:text-white disabled:bg-[#a07cc5] disabled:border-[#a07cc5]  !text-[.85rem] !rounded-[50rem] hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,0.15)]">
                                    Teklif Al
                                </a>
                            </li>
                            <li class="nav-item xl:hidden lg:hidden">
                                <button class="hamburger offcanvas-nav-btn">
                                    <span></span>
                                </button>
                            </li>
                        </ul>                        
                    </div>
                </div>
            </nav>
        </header>