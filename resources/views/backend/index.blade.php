@extends('backend.layout.app')

@section('content')

<div class="page-header d-print-none">
    <div class="col-12 d-flex justify-content-between mb-3">
        <x-dashboard.site.title title='Dashboard'/>
        <x-dashboard.site.preview/>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-9">
        <div class="row">
              <div class="card">
                  <div class="card-status-top bg-primary"></div>
                  <div class="card-header">
                      <h3 class="card-title">Site Yönetimi</h3>
                  </div>
                  <div class="card-body">
                      <div class="row">
      
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-primary-lt">
                                  <div class="card-status-bottom bg-primary"></div>
                                  <div class="card-body p-2 text-center ">
                                      <x-dashboard.icon.edit />
                                      <div class="card-title mt-2 text-black">[{{$counts['categories']}}] Kategori</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('category.index')}}" title="Kategori Yönetimi" class="btn btn-outline-primary text-black">
                                          Kategori Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>
      
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-primary-lt">
                                  <div class="card-status-bottom bg-primary"></div>
                                  <div class="card-body p-2 text-center ">
                                       <x-dashboard.icon.edit />
                                      <div class="card-title mt-2">[{{$counts['pages']}}] Sayfa</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('page.index')}}" title="Sayfa Yönetimi" class="btn btn-outline-primary  ">
                                          Sayfa Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>
      
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-primary-lt">
                                  <div class="card-status-bottom bg-primary"></div>
                                  <div class="card-body p-2 text-center ">
                                      <x-dashboard.icon.edit />
                                      <div class="card-title mt-2">[{{$counts['services']}}] Hizmet</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('service.index')}}" title="Hizmet Yönetimi" class="btn btn-outline-primary  ">
                                          Hizmet Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>
      
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-primary-lt">
                                  <div class="card-status-bottom bg-primary"></div>
                                  <div class="card-body p-2 text-center ">
                                      <x-dashboard.icon.edit />
                                      <div class="card-title mt-2">[{{$counts['blogs']}}] Blog</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('blog.index')}}" title="Blog Yönetimi" class="btn btn-outline-primary  ">
                                          Blog Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>
      
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-primary-lt">
                                  <div class="card-status-bottom bg-primary"></div>
                                  <div class="card-body p-2 text-center ">
                                      <x-dashboard.icon.edit />
                                      <div class="card-title mt-2">[{{$counts['faqs']}}] S.S.S</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('faq.index')}}" title="S.S.S Yönetimi" class="btn btn-outline-primary  ">
                                          S.S.S Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>
      
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-primary-lt">
                                  <div class="card-status-bottom bg-primary"></div>
                                  <div class="card-body p-2 text-center ">
                                      <x-dashboard.icon.image />
                                      <div class="card-title mt-2">[{{$counts['faqs']}}] Resim Galeri</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('faq.index')}}" title="S.S.S Yönetimi" class="btn btn-outline-primary  ">
                                          Galeri Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>
      
                          
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-primary-lt">
                                  <div class="card-status-bottom bg-primary"></div>
                                  <div class="card-body p-2 text-center ">
                                      <x-dashboard.icon.edit />
                                      <div class="card-title mt-2">[{{$counts['faqs']}}] Video Galeri</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('faq.index')}}" title="S.S.S Yönetimi" class="btn btn-outline-primary  ">
                                          Galeri Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>
      
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-primary-lt">
                                  <div class="card-status-bottom bg-primary"></div>
                                  <div class="card-body p-2 text-center ">
                                      <x-dashboard.icon.user />
                                      <div class="card-title mt-2">[{{$counts['faqs']}}] Ekip</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('faq.index')}}" title="S.S.S Yönetimi" class="btn btn-outline-primary  ">
                                          Ekip Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>
      
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-primary-lt">
                                  <div class="card-status-bottom bg-primary"></div>
                                  <div class="card-body p-2 text-center ">
                                      <x-dashboard.icon.edit />
                                      <div class="card-title mt-2">[{{$counts['faqs']}}] Slider</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('faq.index')}}" title="S.S.S Yönetimi" class="btn btn-outline-primary  ">
                                          Slider Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>
      
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-primary-lt">
                                  <div class="card-status-bottom bg-primary"></div>
                                  <div class="card-body p-2 text-center ">
                                      <x-dashboard.icon.settings />
                                      <div class="card-title mt-2">[{{$counts['faqs']}}] Ayarlar</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('faq.index')}}" title="S.S.S Yönetimi" class="btn btn-outline-primary  ">
                                          Ayarlar Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>
      
      
                          
                          
          
                      </div>
                     
                      
                  </div>
                  
              </div>
      
            
        </div>
      </div>
      
      <div class="col-12 col-md-9 mt-3">
          <div class="row">
              <div class="card">
                  <div class="card-status-top bg-warning"></div>
                  <div class="card-header">
                      <h3 class="card-title"><x-dashboard.icon.cart /> E-Ticaret Yönetimi</h3>
                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-sm-3 mt-2">
                              <div class="card card-link card-link-pop bg-warning-lt">
                                  <div class="card-status-bottom bg-warning"></div>
                                  <div class="card-body p-2 text-center ">
                                      <x-dashboard.icon.edit />
                                      <div class="card-title mt-2 text-black">[{{$counts['categories']}}] Kategori</div>                         
                                  </div>
                                  <div class="card-footer text-center">
                                      <a href="{{ route('category.index')}}" title="Kategori Yönetimi" class="btn btn-outline-warning text-black">
                                          Kategori Yönetimi
                                      </a>
                                  </div>
                              </div>
                          </div>                    
                      </div>
                       
                  </div>
              </div>
          </div>
      </div>


      <div class="col-12 col-md-9 mt-3">
        <div class="row">
            <div class="card">
                <div class="card-status-top bg-info"></div>
                <div class="card-header">
                    <h3 class="card-title"><x-dashboard.icon.cart /> Sipariş Yönetimi</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 mt-2">
                            <div class="card card-link card-link-pop bg-info-lt">
                                <div class="card-status-bottom bg-info"></div>
                                <div class="card-body p-2 text-center ">
                                    <x-dashboard.icon.edit />
                                    <div class="card-title mt-2 text-black">[{{$counts['categories']}}] Kategori</div>                         
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('category.index')}}" title="Kategori Yönetimi" class="btn btn-outline-info text-black">
                                        Kategori Yönetimi
                                    </a>
                                </div>
                            </div>
                        </div>                    
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

