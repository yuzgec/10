<footer class="bg-[rgba(52,63,82)] opacity-100 text-[#cacaca]">
    
    <div class="container py-10">
        <div class="xl:flex lg:flex flex-row xl:!items-center lg:!items-center">
            <h3 class="xl:text-[1.9rem] text-[calc(1.315rem_+_0.78vw)] !leading-[1.25] font-bold !mb-6 xl:!mb-0 lg:!mb-0 lg:pr-40 xl:pr-60 xxl:pr-[22.5rem] text-white">Size özel çözümlerimiz ile işinizi bir adım öteye taşımak için teklif alın. </h3>
            <a href="{{ route('contactus')}}" title="Teklif Al" class="btn btn-violet text-white !bg-[#a07cc5] border-[#a07cc5] hover:text-white hover:bg-[#a07cc5] hover:border-[#a07cc5] 
			focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-[#a07cc5] active:border-[#a07cc5] disabled:text-white disabled:bg-[#a07cc5]
			 disabled:border-[#a07cc5]  !text-[.85rem] !rounded-[50rem]  !mb-0 whitespace-nowrap">Teklif Al</a>
        </div>
        <hr class="mt-[3rem] mb-[3.5rem] opacity-100 m-[4.5rem_0] border-t border-solid border-[rgba(164,174,198,.2)]">
            <div class="flex flex-wrap mx-[-15px] mt-[-30px] xl:mt-0 lg:mt-0">
                <div class="md:w-4/12 xl:w-3/12 lg:w-3/12 w-full flex-[0_0_auto] px-[15px] max-w-full xl:mt-0 lg:mt-0 mt-[30px]">
                    <div class="widget text-[#cacaca]">
                        <img class="!mb-4" src="/logof.png" srcset="/logof.png"alt="İzmir GO Dijital Ajans"/>
                            <p class="!mb-4">© 2024 İzmir GO Dijital Ajans.<br class="hidden xl:block lg:block text-[#cacaca]">Tüm Hakları Saklıdır.</p>
                        <nav class="nav social social-white">
                            <a class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]"
                                href="https://www.facebook.com/{{ config('settings.facebook')}}" title="GO Dijital Facebook">
                                <i class="uil uil-facebook-f before:content-['\eae2'] !text-white text-[1rem]"></i>
                            </a>
                            <a class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]"
                                href="https://www.instagram.com/{{ config('settings.instagram')}}" title="GO Dijital İnstagram">
                                <i class="uil uil-instagram before:content-['\eb9c'] !text-white text-[1rem]"></i>
                            </a>
                            <a class="text-[#cacaca] text-[1rem] transition-all duration-[0.2s] ease-in-out translate-y-0 motion-reduce:transition-none hover:translate-y-[-0.15rem] m-[0_.7rem_0_0]"
                                href="https://www.youtube.com/{{ config('settings.youtube')}}" title="GO Dijital Youtube">
                                <i class="uil uil-youtube before:content-['\edb5'] !text-white text-[1rem]"></i>
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="md:w-4/12 xl:w-3/12 lg:w-3/12 w-full flex-[0_0_auto] px-[15px] max-w-full xl:mt-0 lg:mt-0 mt-[30px]">
                    <div class="widget text-[#cacaca]">
                        <h4 class="widget-title text-white !mb-3 !text-[1rem] !leading-[1.45]">İletişim Bilgileri</h4>
                        <address class="xl:pr-20 xxl:!pr-28 not-italic leading-[inherit] block mb-4">{{ config('settings.adres1')}}</address>
                        <a class="text-[#cacaca] hover:text-[#a07cc5]"
                            href="mailto:{{ config('settings.email1')}}">
                            {{ config('settings.email1')}}
                        </a>
                        <br>
                        {{ config('settings.telefon1')}}
                    </div>
                </div>

                <div class="md:w-4/12 xl:w-3/12 lg:w-3/12 w-full flex-[0_0_auto] px-[15px] max-w-full xl:mt-0 lg:mt-0 mt-[30px]">
                    <div class="widget text-[#cacaca]">
                        <h4 class="widget-title text-white !mb-3 !text-[1rem] !leading-[1.45]">Hizmetlerimiz</h4>
                        <ul class="pl-0 list-none   !mb-0">
                        @foreach ($categories->where('parent_id', 2) as $item )
                            <li>
                                <a class="text-[#cacaca] hover:text-[#a07cc5]" href="{{ route('category.detail', $item->slug)}}" title="{{ $item->name}}">
                                    {{ $item->name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                            <div class="md:w-full xl:w-3/12 lg:w-3/12 w-full flex-[0_0_auto] px-[15px] max-w-full xl:mt-0 lg:mt-0 mt-[30px]">
                                <div class="widget text-[#cacaca]">
                                    <h4 class="widget-title text-white !mb-3 !text-[1rem] !leading-[1.45]">Haber Bülteni</h4>
                                    <p class="!mb-5">Mail bültemize katılarak en güncel teknoloji haberlerini alabilirsiniz.</p>
                                    <div class="newsletter-wrapper">

                                    <div id="mc_embed_signup2">
                                            <form
                                                action="#"
                                                method="post"
                                                id="mc-embedded-subscribe-form2"
                                                name="mc-embedded-subscribe-form"
                                                class="validate dark-fields"
                                                target="_blank"
                                                novalidate="novalidate">
                                                <div id="mc_embed_signup_scroll2">
                                                    <div
                                                        class="!text-left input-group form-floating !relative flex flex-wrap items-stretch w-full">
                                                        <input
                                                            type="email"
                                                            value=""
                                                            name="EMAIL"
                                                            class="required email form-control block w-full text-[12px] font-medium leading-[1.7] appearance-none bg-clip-padding shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] px-4 py-[0.6rem] rounded-[0.4rem] motion-reduce:transition-none focus:text-[#60697b] focus:bg-[rgba(255,255,255,.03)] focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset] disabled:bg-[#aab0bc] disabled:opacity-100 file:mt-[-0.6rem] file:mr-[-1rem] file:mb-[-0.6rem] file:ml-[-1rem] file:text-[#60697b] file:bg-[#fefefe] file:pointer-events-none file:transition-all file:duration-[0.2s] file:ease-in-out file:px-4 file:py-[0.6rem] file:rounded-none motion-reduce:file:transition-none placeholder:text-[#959ca9] placeholder:opacity-100 border border-solid !border-[rgba(255,255,255,0.1)] text-[#cacaca] focus:!border-[#a07cc5] bg-[rgba(255,255,255,.03)] focus-visible:!border-[#a07cc5] focus-visible:!outline-0"
                                                            placeholder="Email Adresinizi Giriniz..."
                                                            id="mce-EMAIL2">
                                                            <label
                                                                class="!ml-[0.05rem] text-[#959ca9] text-[.75rem] absolute z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none origin-[0_0] px-4 py-[0.6rem] left-0 top-0"
                                                                for="mce-EMAIL2">Email Adresiniz</label>
                                                            <input
                                                                type="submit"
                                                                value="KATIL"
                                                                name="subscribe"
                                                                id="mc-embedded-subscribe2"
                                                                class="btn btn-violet text-white !bg-[#a07cc5] border-[#a07cc5] hover:text-white hover:bg-[#a07cc5] hover:border-[#a07cc5] focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-[#a07cc5] active:border-[#a07cc5] disabled:text-white disabled:bg-[#a07cc5] disabled:border-[#a07cc5]  !relative z-[2] focus:z-[5] hover:!transform-none border-0"></div>
                                                            <div id="mce-responses2" class="clear">
                                                                <div class="response" id="mce-error-response2" style="display:none"></div>
                                                                <div class="response" id="mce-success-response2" style="display:none"></div>
                                                            </div>
                                                       
                                                            <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                                                <input
                                                                    type="text"
                                                                    name="b_ddc180777a163e0f9f66ee014_4b1bcfa0bc"
                                                                    tabindex="-1"
                                                                    value=""></div>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </footer>