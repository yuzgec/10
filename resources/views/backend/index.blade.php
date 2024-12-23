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
                                <x-dashboard.icon.menu-list />
                                <div class="card-title mt-2 text-black">[{{$counts['categories']}}] Kategori</div>                         
                            </div>
                            <x-dashboard.site.home-card-link model="category"/>
                        </div>
                    </div>

                    <div class="col-sm-3 mt-2">
                        <div class="card card-link card-link-pop bg-primary-lt">
                            <div class="card-status-bottom bg-primary"></div>
                            <div class="card-body p-2 text-center ">
                                <x-dashboard.icon.edit />
                                <div class="card-title mt-2">[{{$counts['pages']}}] Sayfa</div>                         
                            </div>
                            <x-dashboard.site.home-card-link model="page"/>

                        </div>
                    </div>

                    <div class="col-sm-3 mt-2">
                        <div class="card card-link card-link-pop bg-primary-lt">
                            <div class="card-status-bottom bg-primary"></div>
                            <div class="card-body p-2 text-center ">
                                <x-dashboard.icon.heart />
                                <div class="card-title mt-2">[{{$counts['services']}}] Hizmet</div>                         
                            </div>
                            <x-dashboard.site.home-card-link model="service"/>

                        </div>
                    </div>

                    <div class="col-sm-3 mt-2">
                        <div class="card card-link card-link-pop bg-primary-lt">
                            <div class="card-status-bottom bg-primary"></div>
                            <div class="card-body p-2 text-center ">
                                <x-dashboard.icon.blog />
                                <div class="card-title mt-2">[{{$counts['blogs']}}] Blog</div>                         
                            </div>
                            <x-dashboard.site.home-card-link model="blog"/>

                        </div>
                    </div>

                    <div class="col-sm-3 mt-2">
                        <div class="card card-link card-link-pop bg-primary-lt">
                            <div class="card-status-bottom bg-primary"></div>
                            <div class="card-body p-2 text-center ">
                                <x-dashboard.icon.question-mark />
                                <div class="card-title mt-2">[{{$counts['faqs']}}] S.S.S</div>                         
                            </div>
                            <x-dashboard.site.home-card-link model="faq"/>

                        </div>
                    </div>

                    <div class="col-sm-3 mt-2">
                        <div class="card card-link card-link-pop bg-primary-lt">
                            <div class="card-status-bottom bg-primary"></div>
                            <div class="card-body p-2 text-center ">
                                <x-dashboard.icon.image />
                                <div class="card-title mt-2">[{{$counts['faqs']}}] Resim Galeri</div>                         
                            </div>
                            <x-dashboard.site.home-card-link model="faq"/>

                        </div>
                    </div>

                    
                    <div class="col-sm-3 mt-2">
                        <div class="card card-link card-link-pop bg-primary-lt">
                            <div class="card-status-bottom bg-primary"></div>
                            <div class="card-body p-2 text-center ">
                                <x-dashboard.icon.video />
                                <div class="card-title mt-2">[{{$counts['faqs']}}] Video Galeri</div>                         
                            </div>
                            <x-dashboard.site.home-card-link model="faq"/>

                        </div>
                    </div>

                    <div class="col-sm-3 mt-2">
                        <div class="card card-link card-link-pop bg-primary-lt">
                            <div class="card-status-bottom bg-primary"></div>
                            <div class="card-body p-2 text-center ">
                                <x-dashboard.icon.user />
                                <div class="card-title mt-2">[{{$counts['faqs']}}] Ekip</div>                         
                            </div>
                            <x-dashboard.site.home-card-link model="faq"/>

                        </div>
                    </div>

                    <div class="col-sm-3 mt-2">
                        <div class="card card-link card-link-pop bg-primary-lt">
                            <div class="card-status-bottom bg-primary"></div>
                            <div class="card-body p-2 text-center ">
                                <x-dashboard.icon.slider />
                                <div class="card-title mt-2">[{{$counts['faqs']}}] Slider</div>                         
                            </div>
                            <x-dashboard.site.home-card-link model="faq"/>

                        </div>
                    </div>

                    <div class="col-sm-3 mt-2">
                        <div class="card card-link card-link-pop bg-primary-lt">
                            <div class="card-status-bottom bg-primary"></div>
                            <div class="card-body p-2 text-center ">
                                <x-dashboard.icon.settings />
                                <div class="card-title mt-2">[{{$counts['faqs']}}] Ayarlar</div>                         
                            </div>
                            <x-dashboard.site.home-card-link model="faq"/>

                        </div>
                    </div>


                    
                    
    
                </div>
                
                
            </div>
            
        </div>

        <div class="card mt-3">
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


        <div class="card card-sm card-link card-link-pop bg-info-lt mt-3">
            <div class="card-status-top bg-info"></div>
            <div class="card-header">
                <h3 class="card-title"><x-dashboard.icon.cart /> Sipariş Yönetimi</h3>
            </div>

            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <x-dashboard.icon.cart/>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            132 Sales
                        </div>
                        <div class="text-secondary">
                            12 waiting payments
                        </div>
                    </div>
                </div>

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
      
    <div class="col-12 col-md-3">

        <div class="card mb-3">
            <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <h3 class="card-title"><x-dashboard.icon.comment /> İletişim Form</h3>
                </div>
                <div class="list-group list-group-flush list-group-hoverable">
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto"><span class="badge bg-red"></span></div>
                            <div class="col-auto">
                                <a href="#">
                                    <span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
                                </a>
                            </div>
                            <div class="col text-truncate">
                                <a href="#" class="text-reset d-block">Paweł Kuna</a>
                            <div class="d-block text-secondary text-truncate mt-n1">Change deprecated html tags to text decoration classes (#29604)</div>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="list-group-item-actions"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <x-dashboard.icon.edit />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="height: 28rem">
            <div class="card-status-top bg-primary"></div>
            <div class="card-header">
                <h3 class="card-title"><x-dashboard.icon.blog /> Son Blog Yazıları</h3>
            </div>
            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                <div class="divide-y">
                    @foreach ($blog->take(4) as $item)
                    <div>
                        <div class="row">
                            <div class="col-auto">
                                <img src="{{ $item->getFirstMediaUrl('page', 'icon')}}" class="avatar me-2">
                            </div>
                            <div class="col">
                                <div class="text-truncate">{{ $item->name}}</div>
                                <div class="text-secondary">{{ $item->created_at}}</div>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="badge bg-primary"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <div>
            </div>
        </div>

        
    </div>
</div>



@endsection

