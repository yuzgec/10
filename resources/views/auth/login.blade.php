@extends('frontend.layout.app')


@section('content')

<section class="wrapper bg-[#21262c] opacity-100 text-white">
    <div class="container pt-32 !text-center">
        <div class="flex flex-wrap mx-[-15px]">
            <div class="xl:w-8/12 lg:w-8/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
                <h1 lass="text-[calc(1.365rem_+_1.38vw)] font-bold leading-[1.2] xl:text-[2.4rem] mb-3 text-white">
                    Giriş Yap
                </h1>
                <nav class="inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb flex flex-wrap bg-[none] mb-4 p-0 !rounded-none list-none">
                        <li class="breadcrumb-item flex text-[#60697b]">
                            <a class=" text-inherit text-white hover:!text-white" href="{{ route('home')}}">
                                Anasayfa
                            </a>
                        </li>
                        <li class="breadcrumb-item active flex text-white pl-2 before:font-normal before:flex before:items-center before:text-[rgba(255,255,255,0.35)] before:content-['\e931'] before:text-[0.9rem] before:-mt-px before:pr-2 before:font-Unicons" aria-current="page">
                            Giriş Yap
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>


<section class="wrapper !bg-[#ffffff]">
      <div class="container !pb-[4.5rem] xl:!pb-24 lg:!pb-24 md:!pb-24">
        <div class="flex flex-wrap mx-[-15px]">
          <div class="!mt-[-9rem] w-full flex-[1_0_0%] px-[15px] max-w-full !relative z-[3]">
            <div class="card !shadow-[0_0.25rem_1.75rem_rgba(30,34,40,0.07)]">
              <div class="flex flex-wrap mx-0 !text-center">
                <div class="xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] max-w-full image-wrapper bg-image rounded-t-[0.4rem] rounded-lg-start sm:hidden xsm:hidden block bg-cover bg-[center_center] bg-no-repeat !bg-scroll md:min-h-[25rem]" 
                data-image-src="/frontend/img/godijital.png" 
                style="background-image: url('/frontend/img/godijital.png');">
                </div>
                <div class="xl:w-6/12 lg:w-6/12 w-full flex-[0_0_auto] max-w-full">
                  <div class="!p-10 md:!p-12  xl:!p-[4rem] lg:!p-[4rem]">
                    <h2 class="mb-3 text-left">GO Dİjital</h2>
                    <p class="lead text-[0.9rem] font-medium !leading-[1.65] !mb-6 text-left">Gelişmiş Yönetim Paneline Hoş Geldiniz.</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                      <div class="form-floating !relative mb-4">
                        <input type="email" name="email" class="form-control px-4 py-[0.6rem] h-[calc(2.5rem_+_2px)] min-h-[calc(2.5rem_+_2px)] leading-[1.25] block w-full text-[12px] font-medium text-[#60697b] appearance-none bg-[#fefefe] bg-clip-padding border shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rounded-[0.4rem] border-solid border-[rgba(8,60,130,0.07)] motion-reduce:transition-none focus:text-[#60697b] focus:bg-[#fefefe] focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset] focus:border-[#9fbcf0] disabled:bg-[#aab0bc] disabled:opacity-100 file:mt-[-0.6rem] file:mr-[-1rem] file:mb-[-0.6rem] file:ml-[-1rem] file:text-[#60697b] file:bg-[#fefefe] file:pointer-events-none file:transition-all file:duration-[0.2s] file:ease-in-out file:px-4 file:py-[0.6rem] file:rounded-none file:border-inherit file:border-solid file:border-0 motion-reduce:file:transition-none focus:!border-[rgba(63,120,224,0.5)] focus-visible:!border-[rgba(63,120,224,0.5)] focus-visible:!outline-0" placeholder="Email" id="loginEmail">
                        <label class=" text-[#959ca9] text-[.75rem] absolute z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none border origin-[0_0] px-4 py-[0.6rem] border-solid border-transparent left-0 top-0 inline-block" for="loginEmail">Email</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-floating !relative password-field mb-4">
                        <input type="password" name="password" class="form-control px-4 py-[0.6rem] h-[calc(2.5rem_+_2px)] min-h-[calc(2.5rem_+_2px)] leading-[1.25] block w-full text-[12px] font-medium text-[#60697b] appearance-none bg-[#fefefe] bg-clip-padding border shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rounded-[0.4rem] border-solid border-[rgba(8,60,130,0.07)] motion-reduce:transition-none focus:text-[#60697b] focus:bg-[#fefefe] focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset] focus:border-[#9fbcf0] disabled:bg-[#aab0bc] disabled:opacity-100 file:mt-[-0.6rem] file:mr-[-1rem] file:mb-[-0.6rem] file:ml-[-1rem] file:text-[#60697b] file:bg-[#fefefe] file:pointer-events-none file:transition-all file:duration-[0.2s] file:ease-in-out file:px-4 file:py-[0.6rem] file:rounded-none file:border-inherit file:border-solid file:border-0 motion-reduce:file:transition-none focus:!border-[rgba(63,120,224,0.5)] focus-visible:!border-[rgba(63,120,224,0.5)] focus-visible:!outline-0" placeholder="Password" id="loginPassword">
                        <span class="password-toggle absolute -translate-y-2/4 cursor-pointer text-[0.9rem] text-[#959ca9] right-3 top-2/4"><i class="uil uil-eye"></i></span>
                        <label class=" text-[#959ca9] text-[.75rem] absolute z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none border origin-[0_0] px-4 py-[0.6rem] border-solid border-transparent left-0 top-0 inline-block" for="loginPassword">Password</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary text-white !bg-[#3f78e0] border-[#3f78e0] hover:text-white hover:bg-[#3f78e0] hover:border-[#3f78e0] focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-[#3f78e0] active:border-[#3f78e0] disabled:text-white disabled:bg-[#3f78e0] disabled:border-[#3f78e0] !rounded-[50rem] btn-login w-full mb-2">Giriş Yap</button>
                    </form>
                    <p class="!mb-1"><a href="#" class="hover">Parolamı Unuttum</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
