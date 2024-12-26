@extends('backend.layout.app')

@section('content')

<div class="page-header d-print-none">
    <div class="col-12 d-flex justify-content-between mb-3">
        <x-dashboard.site.title title='Dashboard'/>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-9">

        <div class="card mb-2">
            <div class="card-status-top bg-primary"></div>
            <div class="card-header">
                <h3 class="card-title"><x-dashboard.icon.home />  Site Yönetimi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-dashboard.site.card-home-site model="category" count="{{$counts['categories']}}" icon="menu-list" name="Kategori"/>
                    <x-dashboard.site.card-home-site model="page" count="{{$counts['pages']}}" icon="edit" name="Sayfa"/>
                    <x-dashboard.site.card-home-site model="service" count="{{$counts['services']}}" icon="heart" name="Hizmet"/>
                    <x-dashboard.site.card-home-site model="blog" count="{{$counts['blogs']}}" icon="blog" name="Blog"/>
                    <x-dashboard.site.card-home-site model="faq" count="{{$counts['faqs']}}" icon="question-mark" name="S.S.S"/>
                    <x-dashboard.site.card-home-site model="faq" count="{{$counts['faqs']}}" icon="image" name="Galeri"/>
                    <x-dashboard.site.card-home-site model="faq" count="{{$counts['faqs']}}" icon="video" name="Video"/>
                    <x-dashboard.site.card-home-site model="team" count="{{$counts['teams']}}" icon="user" name="Ekip"/>
                    <x-dashboard.site.card-home-site model="faq" count="{{$counts['faqs']}}" icon="slider" name="Slider"/>
                    <x-dashboard.site.card-home-site model="faq" count="{{$counts['faqs']}}" icon="settings" name="Ayarlar"/>
                </div>               
            </div>
        </div>

        <div class="card mb-2">
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

        <div class="card mb-2">
            <div class="card-status-top bg-info"></div>

            <div class="card-header">
                <h3 class="card-title "><x-dashboard.icon.cart /> Sipariş Yönetimi</h3>
            </div>

            <div class="card-body">
                

                <div class="col-sm-3 mt-2">
                    <div class="card card-link card-link-pop bg-info-lt">
                        <div class="card-status-bottom bg-info"></div>
                        <div class="card-body p-2 text-center ">
                            <x-dashboard.icon.edit />
                            <div class="card-title mt-2 text-black">[{{$counts['categories']}}] Kategori</div> 
                            
                            <div class="row align-items-center">
                                
                                <div class="col">
                                    <div class="font-weight-medium">
                                        132 Sales
                                    </div>
                                    <div class="text-secondary">
                                        12 waiting payments
                                    </div>
                                </div>
                            </div>
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
            <div class="card-body">
              <h3 class="card-title">Top Pages</h3>
              <table class="table table-sm table-borderless">
                <thead>
                  <tr>
                    <th>Page</th>
                    <th class="text-end">Visitors</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="progressbg">
                        <div class="progress progressbg-progress">
                          <div class="progress-bar bg-primary-lt" style="width: 82.54%" role="progressbar" aria-valuenow="82.54" aria-valuemin="0" aria-valuemax="100" aria-label="82.54% Complete">
                            <span class="visually-hidden">82.54% Complete</span>
                          </div>
                        </div>
                        <div class="progressbg-text">/</div>
                      </div>
                    </td>
                    <td class="w-1 fw-bold text-end">4896</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="progressbg">
                        <div class="progress progressbg-progress">
                          <div class="progress-bar bg-primary-lt" style="width: 76.29%" role="progressbar" aria-valuenow="76.29" aria-valuemin="0" aria-valuemax="100" aria-label="76.29% Complete">
                            <span class="visually-hidden">76.29% Complete</span>
                          </div>
                        </div>
                        <div class="progressbg-text">/form-elements.html</div>
                      </div>
                    </td>
                    <td class="w-1 fw-bold text-end">3652</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="progressbg">
                        <div class="progress progressbg-progress">
                          <div class="progress-bar bg-primary-lt" style="width: 72.65%" role="progressbar" aria-valuenow="72.65" aria-valuemin="0" aria-valuemax="100" aria-label="72.65% Complete">
                            <span class="visually-hidden">72.65% Complete</span>
                          </div>
                        </div>
                        <div class="progressbg-text">/index.html</div>
                      </div>
                    </td>
                    <td class="w-1 fw-bold text-end">3256</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="progressbg">
                        <div class="progress progressbg-progress">
                          <div class="progress-bar bg-primary-lt" style="width: 44.89%" role="progressbar" aria-valuenow="44.89" aria-valuemin="0" aria-valuemax="100" aria-label="44.89% Complete">
                            <span class="visually-hidden">44.89% Complete</span>
                          </div>
                        </div>
                        <div class="progressbg-text">/icons.html</div>
                      </div>
                    </td>
                    <td class="w-1 fw-bold text-end">986</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="progressbg">
                        <div class="progress progressbg-progress">
                          <div class="progress-bar bg-primary-lt" style="width: 41.12%" role="progressbar" aria-valuenow="41.12" aria-valuemin="0" aria-valuemax="100" aria-label="41.12% Complete">
                            <span class="visually-hidden">41.12% Complete</span>
                          </div>
                        </div>
                        <div class="progressbg-text">/docs/</div>
                      </div>
                    </td>
                    <td class="w-1 fw-bold text-end">912</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="progressbg">
                        <div class="progress progressbg-progress">
                          <div class="progress-bar bg-primary-lt" style="width: 32.65%" role="progressbar" aria-valuenow="32.65" aria-valuemin="0" aria-valuemax="100" aria-label="32.65% Complete">
                            <span class="visually-hidden">32.65% Complete</span>
                          </div>
                        </div>
                        <div class="progressbg-text">/accordion.html</div>
                      </div>
                    </td>
                    <td class="w-1 fw-bold text-end">855</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="progressbg">
                        <div class="progress progressbg-progress">
                          <div class="progress-bar bg-primary-lt" style="width: 16.22%" role="progressbar" aria-valuenow="16.22" aria-valuemin="0" aria-valuemax="100" aria-label="16.22% Complete">
                            <span class="visually-hidden">16.22% Complete</span>
                          </div>
                        </div>
                        <div class="progressbg-text">/datagrid.html</div>
                      </div>
                    </td>
                    <td class="w-1 fw-bold text-end">764</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="progressbg">
                        <div class="progress progressbg-progress">
                          <div class="progress-bar bg-primary-lt" style="width: 8.69%" role="progressbar" aria-valuenow="8.69" aria-valuemin="0" aria-valuemax="100" aria-label="8.69% Complete">
                            <span class="visually-hidden">8.69% Complete</span>
                          </div>
                        </div>
                        <div class="progressbg-text">/datatables.html</div>
                      </div>
                    </td>
                    <td class="w-1 fw-bold text-end">686</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

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

        <div class="card">
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

