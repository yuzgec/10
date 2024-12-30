@extends('frontend.layout.app')
@section('content') 
  <section class="wrapper !bg-[#ffffff]">
      <div class="container pt-14 xl:pt-[4.5rem] lg:pt-[4.5rem] md:pt-[4.5rem] pb-[4.5rem] xl:pb-24 lg:pb-24 md:pb-24">
          <div class="flex flex-wrap mx-[-15px]">
              <div class="lg:w-8/12 xl:w-7/12 xxl:w-6/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto !text-center">
                    <h1 class="!mb-3">Bir Hata Oluştu</h1>
                    <p>Üzgünüz, bir hata ile karşılaştık. Lütfen daha sonra tekrar deneyin.</p>

                    <a  href="{{ route('home')}}" 
                        title="Anasayfa" 
                        class="btn btn-primary text-white !bg-[#3f78e0] border-[#3f78e0] hover:text-white hover:bg-[#3f78e0] hover:border-[#3f78e0] focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-[#3f78e0] active:border-[#3f78e0] disabled:text-white disabled:bg-[#3f78e0] disabled:border-[#3f78e0] !rounded-[50rem] hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,0.15)]">
                        Anasayfa
                    </a>
              </div>
          </div>
      </div>
  </section>
@endsection