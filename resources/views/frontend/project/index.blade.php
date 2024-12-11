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
                            aria-current="page">Çalışmalar
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>


<section class="wrapper !bg-[#ffffff]" style="margin-top:50px;margin-bottom:50px">
      <div class="container">
        <div class="projects-overflow">
          <div class="project item">
            <div class="flex flex-wrap mx-[-15px]">
              <figure class="lg:w-8/12 xl:w-7/12 w-full flex-[0_0_auto] px-[15px] max-w-full xl:!ml-[8.33333333%] rounded">
                <img src="/works/ayazmetal.jpg" alt="GO Dijital Çalışmalar">
            </figure>
              <div class="project-details flex justify-center flex-col px-[15px]" style="right: 10%; bottom: 25%;">
                <div class="card  shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rellax" data-rellax-xs-speed="0" data-rellax-mobile-speed="0">
                  <div class="card-body flex-[1_1_auto] p-[40px]">
                    <div class="post-header">
                      <div class="inline-flex uppercase tracking-[0.02rem] text-[0.7rem] font-bold relative align-top pl-[1.4rem] opacity-100 text-[#747ed1] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-[#747ed1] !mb-3">Web Tasarım - Logo</div>
                      <h2 class="post-title !mb-3 leading-[1.35]">Ayaz Metal</h2>
                    </div>
                    <div class="!relative">
                      <a href="#" class="more hover text-[#747ed1] focus:text-[#747ed1] hover:text-[#747ed1]">Siteye Git</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="project item">
            <div class="flex flex-wrap mx-[-15px]">
              <figure class="xl:w-6/12 lg:w-7/12 xl:!ml-[41.66666667%] lg:!ml-[41.66666667%] w-full flex-[0_0_auto] px-[15px] max-w-full rounded"> 
                <img src="/works/hbk.jpg" alt="image">
            </figure>
              <div class="project-details flex justify-center flex-col px-[15px]" style="left: 18%; bottom: 25%;">
                <div class="card  shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rellax" data-rellax-xs-speed="0" data-rellax-mobile-speed="0">
                  <div class="card-body flex-[1_1_auto] p-[40px]">
                    <div class="post-header">
                      <div class="inline-flex uppercase tracking-[0.02rem] text-[0.7rem] font-bold relative align-top pl-[1.4rem] opacity-100 text-[#7cb798] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-[#7cb798] !mb-3">Web Tasarım - Logo</div>
                      <h2 class="post-title !mb-3 leading-[1.35]">HBK Kepenk Tamir Servisi</h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="!relative">
                      <a href="#" class="more hover text-[#7cb798] focus:text-[#7cb798] hover:text-[#7cb798]">Siteye Git</a>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.project-details -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.project -->
          <div class="project item">
            <div class="flex flex-wrap mx-[-15px]">
              <figure class="lg:w-9/12 xl:w-7/12 xl:!ml-[16.66666667%] w-full flex-[0_0_auto] px-[15px] max-w-full rounded"> 
                <img src="/works/polipa.jpg" alt="image"></figure>
              <div class="project-details flex justify-center flex-col px-[15px]" style="right: 3%; bottom: 25%;">
                <div class="card  shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rellax" data-rellax-xs-speed="0" data-rellax-mobile-speed="0">
                  <div class="card-body flex-[1_1_auto] p-[40px]">
                    <div class="post-header">
                      <div class="inline-flex uppercase tracking-[0.02rem] text-[0.7rem] font-bold relative align-top pl-[1.4rem] opacity-100 text-[#a07cc5] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-[#a07cc5] !mb-3">Web Tasarım</div>
                      <h2 class="post-title !mb-3 leading-[1.35]">Polipa Bilişim</h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="!relative">
                      <a href="#" class="more hover text-[#a07cc5] focus:text-[#a07cc5] hover:text-[#a07cc5]">Siteye Git</a>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.project-details -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.project -->
          <div class="project item">
            <div class="flex flex-wrap mx-[-15px]">
              <figure class="lg:w-9/12 lg:!ml-[25%] xl:w-7/12 xl:!ml-[33.33333333%] w-full flex-[0_0_auto] px-[15px] max-w-full rounded"> 
                <img src="/works/ondance.jpg" alt="image"></figure>
              <div class="project-details flex justify-center flex-col px-[15px]" style="left: 12%; bottom: 25%;">
                <div class="card  shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rellax" data-rellax-xs-speed="0" data-rellax-mobile-speed="0">
                  <div class="card-body flex-[1_1_auto] p-[40px]">
                    <div class="post-header">
                      <div class="inline-flex uppercase tracking-[0.02rem] text-[0.7rem] font-bold relative align-top pl-[1.4rem] opacity-100 text-[#fab758] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-[#fab758] !mb-3">Web Site - E Ticaret</div>
                      <h2 class="post-title !mb-3 leading-[1.35]">ON Dance</h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="!relative">
                      <a href="https://on.dance" target="_blank" class="more hover text-[#fab758] focus:text-[#fab758] hover:text-[#fab758]">Siteye Git</a>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.project-details -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.project -->
          <div class="project item">
            <div class="flex flex-wrap mx-[-15px]">
              <figure class="lg:w-8/12 xl:w-6/12 xl:!ml-[8.33333333%] w-full flex-[0_0_auto] px-[15px] max-w-full rounded">
                 <img src="/works/psikolog.jpg" alt="image"></figure>
              <div class="project-details flex justify-center flex-col px-[15px]" style="right: 15%; bottom: 25%;">
                <div class="card  shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rellax" data-rellax-xs-speed="0" data-rellax-mobile-speed="0">
                  <div class="card-body flex-[1_1_auto] p-[40px]">
                    <div class="post-header">
                      <div class="inline-flex uppercase tracking-[0.02rem] text-[0.7rem] font-bold relative align-top pl-[1.4rem] opacity-100 text-[#f78b77] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-[#f78b77] !mb-3">Product</div>
                      <h2 class="post-title !mb-3 leading-[1.35]">Ceren Yağcıköseoğlu</h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="!relative">
                      <a href="#" class="more hover text-[#f78b77] focus:text-[#f78b77] hover:text-[#f78b77]">Siteye Git</a>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.project-details -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.project -->
          <div class="project item">
            <div class="flex flex-wrap mx-[-15px]">
              <figure class="lg:w-9/12 lg:!ml-[25%] xl:w-7/12 xl:!ml-[41.66666667%] w-full flex-[0_0_auto] px-[15px] max-w-full rounded"> <img src="/works/sms.jpg" alt="image"></figure>
              <div class="project-details flex justify-center  flex-col ms-lg-n150 xl:!ml-0" style="left: 18%; bottom: 25%;">
                <div class="card  shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rellax" data-rellax-xs-speed="0" data-rellax-mobile-speed="0">
                  <div class="card-body flex-[1_1_auto] p-[40px]">
                    <div class="post-header">
                      <div class="inline-flex uppercase tracking-[0.02rem] text-[0.7rem] font-bold relative align-top pl-[1.4rem] opacity-100 text-[#45c4a0] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-[#45c4a0] !mb-3">Web Tasarım - Logo</div>
                      <h2 class="post-title !mb-3 leading-[1.35]">Dinamik SMS </h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="!relative">
                      <a href="#" class="more hover text-[#45c4a0] focus:text-[#45c4a0] hover:text-[#45c4a0]">Siteye Git</a>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.project-details -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.project -->
          <div class="project item">
            <div class="flex flex-wrap mx-[-15px]">
              <figure class="lg:w-8/12 xl:w-6/12 xl:!ml-[8.33333333%] w-full flex-[0_0_auto] px-[15px] max-w-full rounded"> 
                <img src="/works/tunatech.jpg" alt="image"></figure>
              <div class="project-details flex justify-center flex-col px-[15px]" style="right: 15%; bottom: 25%;">
                <div class="card  shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rellax" data-rellax-xs-speed="0" data-rellax-mobile-speed="0">
                  <div class="card-body flex-[1_1_auto] p-[40px]">
                    <div class="post-header">
                      <div class="inline-flex uppercase tracking-[0.02rem] text-[0.7rem] font-bold relative align-top pl-[1.4rem] opacity-100 text-[#e2626b] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-[#e2626b] !mb-3">Web Tasarım - Logo</div>
                      <h2 class="post-title !mb-3 leading-[1.35]">TunaTech Bilişim</h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="!relative">
                      <a href="#" class="more hover text-[#e2626b] focus:text-[#e2626b] hover:text-[#e2626b]">Siteye Git</a>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.project-details -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.project -->
        </div>
       
      </div>
      <!-- /.container -->
    </section>
@endsection