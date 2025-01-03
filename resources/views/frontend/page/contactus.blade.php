@extends('frontend.layout.app')
@section('content')

<section class="wrapper !bg-[#edf2fc]">
    <div class="container text-center" style="padding-top: 60px;padding-bottom:60px">
        <div class="flex flex-wrap mx-[-15px]">
            <div class="sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-6/12 xxl:w-5/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                <h1 class="text-[calc(1.365rem_+_1.38vw)] font-bold leading-[1.2] xl:text-[2.4rem] mb-3 text-[#343f52]">İzmir Foça <br/>GO Dijital Ajans</h1>
                <nav class="inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb  flex flex-wrap bg-[none] p-0 !rounded-none list-none mb-[20px]">
                        <li class="breadcrumb-item flex text-[#60697b]">
                            <a class="text-[#60697b] hover:text-[#3f78e0]" href="{{ route('home')}}">Anasayfa</a>
                        </li>
                    
                        <li class="breadcrumb-item flex text-[#60697b] pl-2 before:font-normal before:flex before:items-center before:text-[rgba(96,105,123,.35)] before:content-['\e931'] before:text-[0.9rem] before:-mt-px before:pr-2 before:font-Unicons active"
                            aria-current="page">Bize Ulaşın
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="wrapper !bg-[#ffffff]  angled upper-end relative border-0 before:top-[-4rem] before:border-l-transparent before:border-r-[100vw] before:border-t-[4rem] before:border-[#fefefe] before:content-[''] before:block before:absolute before:z-0 before:border-y-transparent before:border-0 before:border-solid before:right-0 after:content-[''] after:block after:absolute after:z-0 after:border-y-transparent after:border-[#fefefe] after:border-0 after:border-solid after:right-0">
    <div class="container py-[4.5rem] xl:!py-24 lg:!py-24 md:!py-24">
      <div class="flex flex-wrap mx-[-15px] mt-[-50px] xl:mx-[-35px] lg:mx-[-20px] mb-24 items-center">
        <div class="xl:w-7/12 lg:w-7/12 w-full flex-[0_0_auto] xl:px-[35px] lg:px-[20px] px-[15px] mt-[50px] max-w-full !relative">
          <div class="shape bg-dot primary rellax !w-[8rem] !h-[8rem] absolute opacity-50  bg-[radial-gradient(#3f78e0_2px,transparent_2.5px)]" data-rellax-speed="1" style="top: 0; left: -1.4rem; z-index: 0;"></div>
          <div class="flex flex-wrap mx-[-15px] xl:mx-[-12.5px] lg:mx-[-12.5px] md:mx-[-12.5px] mt-[-25px]">
            <div class="xl:w-6/12 lg:w-6/12 md:w-6/12 w-full flex-[0_0_auto] px-[15px] xl:px-[12.5px] lg:px-[12.5px] md:px-[12.5px] mt-[25px] max-w-full">
              <figure class="rounded-[0.4rem] xl:!mt-10 lg:!mt-10 md:!mt-10 !relative"><img class="!rounded-[0.4rem]" src="/frontend/img/iletisim-2.jpg" alt="İzmir Web Tasarım Ajansı"></figure>
            </div>
            <!--/column -->
            <div class="xl:w-6/12 lg:w-6/12 md:w-6/12 w-full flex-[0_0_auto] px-[15px] xl:px-[12.5px] lg:px-[12.5px] md:px-[12.5px] mt-[25px] max-w-full">
              <div class="flex flex-wrap mx-[-15px] xl:mx-[-12.5px] lg:mx-[-12.5px] md:mx-[-12.5px] mt-[-25px]">
                <div class="w-full flex-[0_0_auto] px-[12.5px] mt-[25px] max-w-full xl:!order-2 lg:!order-2 md:!order-2">
                  <figure class="rounded-[0.4rem]"><img class="!rounded-[0.4rem]" src="/frontend/img/iletisim-1.jpg" alt="İzmir Web Tasarım Ajansı"></figure>
                </div>
                <!--/column -->
                <div class="xl:w-10/12 lg:w-10/12 md:w-10/12 w-full flex-[0_0_auto] px-[12.5px] mt-[25px] max-w-full">
                  <div class="card !bg-[#e0e9fa] !text-center counter-wrapper">
                    <div class="card-body !py-12">
                      <h3 class="counter !whitespace-nowrap xl:text-[2rem] text-[calc(1.325rem_+_0.9vw)] tracking-[normal] !leading-none mb-2">500+</h3>
                      <p class="!mb-0 text-[0.8rem] font-medium">Mutlu Müşteri</p>
                    </div>
                    <!--/.card-body -->
                  </div>
                  <!--/.card -->
                </div>
                <!--/column -->
              </div>
              <!--/.row -->
            </div>
            <!--/column -->
          </div>
          <!--/.row -->
        </div>
        <!--/column -->
        <div class="xl:w-5/12 lg:w-5/12 w-full flex-[0_0_auto] xl:px-[35px] lg:px-[20px] px-[15px] mt-[50px] max-w-full">
          <h2 class="text-[calc(1.305rem_+_0.66vw)] font-bold xl:text-[1.8rem] leading-[1.3] !mb-8">Hadi birlikte harika bir şey yapalım.</h2>
          <div class="flex flex-row">
            <div>
              <div class="icon text-[#3f78e0]  xl:text-[1.4rem] text-[calc(1.265rem_+_0.18vw)] mr-6 mt-[-0.25rem]"> <i class="uil uil-location-pin-alt before:content-['\ebd8']"></i> </div>
            </div>
            <div>
              <h5 class="!mb-1">Adres</h5>
              <address class=" not-italic leading-[inherit] mb-4">{{ config('settings.adres2')}}</address>
            </div>
          </div>
          <div class="flex flex-row">
            <div>
              <div class="icon text-[#3f78e0]  xl:text-[1.4rem] text-[calc(1.265rem_+_0.18vw)] mr-6 mt-[-0.25rem]"> <i class="uil uil-phone-volume before:content-['\ec50']"></i> </div>
            </div>
            <div>
              <h5 class="!mb-1">Telefon</h5>
              <p>{{ config('settings.telefon1')}}</p>
            </div>
          </div>
          <div class="flex flex-row">
            <div>
              <div class="icon text-[#3f78e0]  xl:text-[1.4rem] text-[calc(1.265rem_+_0.18vw)] mr-6 mt-[-0.25rem]"> <i class="uil uil-envelope before:content-['\eac8']"></i> </div>
            </div>
            <div>
              <h5 class="!mb-1">E-mail</h5>
              <p class="!mb-0"><a href="mailto:{{ config('settings.email1')}}" class="text-[#60697b]">{{ config('settings.email1')}}</a></p>
            </div>
          </div>
        </div>
        <!--/column -->
      </div>
      <!--/.row -->
      <div class="flex flex-wrap mx-[-15px]">
        <div class="xl:w-8/12 xl:!ml-[16.66666667%] lg:w-10/12 lg:!ml-[8.33333333%] w-full flex-[0_0_auto] px-[15px] max-w-full">
          <h2 class="text-[calc(1.305rem_+_0.66vw)] font-bold xl:text-[1.8rem] leading-[1.3] mb-3 !text-center">İletişim Formu</h2>
          <p class="lead leading-[1.65] text-[0.9rem] font-medium !text-center mb-10">İletişim formumuzdan bize ulaşın, en kısa sürede size geri dönüş yapacağız.</p>
          <form class="contact-form needs-validation" method="post" action="./assets/php/contact.php" novalidate>
            <div class="messages"></div>
            <div class="flex flex-wrap mx-[-10px]">
              <div class="xl:w-6/12 lg:w-6/12 md:w-6/12 w-full flex-[0_0_auto] px-[15px] max-w-full">
                <div class="form-floating relative !mb-4">
                  <input id="form_name" type="text" name="name" class=" form-control  relative block w-full text-[.75rem] font-medium text-[#60697b] bg-[#fefefe] bg-clip-padding border shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rounded-[0.4rem] border-solid border-[rgba(8,60,130,0.07)] transition-[border-color] duration-[0.15s] ease-in-out focus:text-[#60697b] focus:bg-[rgba(255,255,255,.03)] focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset] focus:!border-[rgba(63,120,224,0.5)] focus-visible:!border-[rgba(63,120,224,0.5)] focus-visible:!outline-0 placeholder:text-[#959ca9] placeholder:opacity-100 m-0 !pr-9 p-[.6rem_1rem] h-[calc(2.5rem_+_2px)] min-h-[calc(2.5rem_+_2px)] leading-[1.25]" placeholder="Jane" required>
                  <label for="form_name" class="text-[#959ca9] mb-2 inline-block text-[.75rem] absolute z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none border origin-[0_0] px-4 py-[0.6rem] border-solid border-transparent left-0 top-0 font-Manrope">Adınız Soyadınız*</label>

                </div>
              </div>
              <!-- /column -->
              <div class="xl:w-6/12 lg:w-6/12 md:w-6/12 w-full flex-[0_0_auto] px-[15px] max-w-full">
                <div class="form-floating relative !mb-4">
                  <input id="form_lastname" type="text" name="surname" class=" form-control  relative block w-full text-[.75rem] font-medium text-[#60697b] bg-[#fefefe] bg-clip-padding border shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rounded-[0.4rem] border-solid border-[rgba(8,60,130,0.07)] transition-[border-color] duration-[0.15s] ease-in-out focus:text-[#60697b] focus:bg-[rgba(255,255,255,.03)] focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset] focus:!border-[rgba(63,120,224,0.5)] focus-visible:!border-[rgba(63,120,224,0.5)] focus-visible:!outline-0 placeholder:text-[#959ca9] placeholder:opacity-100 m-0 !pr-9 p-[.6rem_1rem] h-[calc(2.5rem_+_2px)] min-h-[calc(2.5rem_+_2px)] leading-[1.25]" placeholder="Doe" required>
                  <label for="form_lastname" class="text-[#959ca9] mb-2 inline-block text-[.75rem] absolute z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none border origin-[0_0] px-4 py-[0.6rem] border-solid border-transparent left-0 top-0 font-Manrope">Firma Adı *</label>

                </div>
              </div>
              <!-- /column -->
              <div class="xl:w-6/12 lg:w-6/12 md:w-6/12 w-full flex-[0_0_auto] px-[15px] max-w-full">
                <div class="form-floating relative !mb-4">
                  <input id="form_email" type="email" name="email" class=" form-control  relative block w-full text-[.75rem] font-medium text-[#60697b] bg-[#fefefe] bg-clip-padding border shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rounded-[0.4rem] border-solid border-[rgba(8,60,130,0.07)] transition-[border-color] duration-[0.15s] ease-in-out focus:text-[#60697b] focus:bg-[rgba(255,255,255,.03)] focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset] focus:!border-[rgba(63,120,224,0.5)] focus-visible:!border-[rgba(63,120,224,0.5)] focus-visible:!outline-0 placeholder:text-[#959ca9] placeholder:opacity-100 m-0 !pr-9 p-[.6rem_1rem] h-[calc(2.5rem_+_2px)] min-h-[calc(2.5rem_+_2px)] leading-[1.25]" placeholder="jane.doe@example.com" required>
                  <label for="form_email" class="text-[#959ca9] mb-2 inline-block text-[.75rem] absolute z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none border origin-[0_0] px-4 py-[0.6rem] border-solid border-transparent left-0 top-0 font-Manrope">Email *</label>
                </div>
              </div>
              <!-- /column -->
              <div class="xl:w-6/12 lg:w-6/12 md:w-6/12 w-full flex-[0_0_auto] px-[15px] max-w-full">
                <div class="form-select-wrapper mb-4">
                  <select class="form-select" id="form-select" name="department" required>
                    <option selected disabled value="">Konu / Hizmet</option>
                    @foreach ($services as $item)
                    <option value="{{ $item->name}}">{{ $item->name}}</option>
                    @endforeach
                    <option value="İstek - Şikayet">İstek - Şikayet</option>
                   
                  </select>
                  
                </div>
              </div>
              <!-- /column -->
              <div class="w-full flex-[0_0_auto] px-[15px] max-w-full">
                <div class="form-floating relative !mb-4">
                  <textarea id="form_message" name="message" class=" form-control  relative block w-full text-[.75rem] font-medium text-[#60697b] bg-[#fefefe] bg-clip-padding border shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rounded-[0.4rem] border-solid border-[rgba(8,60,130,0.07)] transition-[border-color] duration-[0.15s] ease-in-out focus:text-[#60697b] focus:bg-[rgba(255,255,255,.03)] focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset] focus:!border-[rgba(63,120,224,0.5)] focus-visible:!border-[rgba(63,120,224,0.5)] focus-visible:!outline-0 placeholder:text-[#959ca9] placeholder:opacity-100 m-0 !pr-9 p-[.6rem_1rem] h-[calc(2.5rem_+_2px)] min-h-[calc(2.5rem_+_2px)] leading-[1.25]" placeholder="Your message" style="height: 150px" required></textarea>
                  <label for="form_message" class="text-[#959ca9] mb-2 inline-block text-[.75rem] absolute z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none border origin-[0_0] px-4 py-[0.6rem] border-solid border-transparent left-0 top-0 font-Manrope">Mesajınız *</label>
                  </div>
              </div>
              <!-- /column -->
              <div class="w-full flex-[0_0_auto] px-[15px] max-w-full !text-center">
                <input type="submit" class="btn btn-primary text-white !bg-[#3f78e0] border-[#3f78e0] hover:text-white hover:bg-[#3f78e0] hover:border-[#3f78e0] focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-[#3f78e0] active:border-[#3f78e0] disabled:text-white disabled:bg-[#3f78e0] disabled:border-[#3f78e0] !rounded-[50rem] btn-send !mb-3 hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,0.15)]" value="Mesajı Gönder">
              </div>
              <!-- /column -->
            </div>
            <!-- /.row -->
          </form>
          <!-- /form -->
        </div>
        <!-- /column -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
@endsection