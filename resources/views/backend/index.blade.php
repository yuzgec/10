@extends('backend.layout.app')

@section('content')

<div class="page-header d-print-none">
    <div class="col-12 d-flex justify-content-between mb-3">
        <x-dashboard.site.title title='Dashboard'/>
        <x-dashboard.site.preview/>
    </div>
</div>

<div class="col-12 col-md-12">
  <div class="row">
      <div class="col-sm-3 mt-2">
          <div class="card">
              <div class="card-status-bottom bg-primary"></div>
              <div class="card-body p-2 text-center ">
                  <div class="demo-icon-preview">
                      <div data-icon-preview-icon="">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg>
                      </div>
                  </div>
                  <div class="text-h3 m-0 font-weight-bold">[4] Sayfa</div>
                  <div class="text-muted mb-3">
                      <a href="https://sasder.org/go/page" title="Sayfa Yönetimi" class="btn btn-outline-tabler btn-sm ">
                          Sayfa Yönetimi
                      </a>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-sm-3 mt-2">
          <div class="card">
              <div class="card-status-bottom bg-primary"></div>
              <div class="card-body p-2 text-center ">
                  <div class="demo-icon-preview">
                      <div data-icon-preview-icon="">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="7" width="18" height="13" rx="2"></rect><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path><line x1="12" y1="12" x2="12" y2="12.01"></line><path d="M3 13a20 20 0 0 0 18 0"></path></svg>
                      </div>
                  </div>
                  <div class="text-h3 m-0 font-weight-bold">[11] Kongre</div>
                  <div class="text-muted mb-3">
                      <a href="https://sasder.org/go/project" title="Proje Yönetimi" class="btn btn-outline-tabler btn-sm ">
                          Kongre Yönetimi
                      </a>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-sm-3 mt-2">
          <div class="card">
              <div class="card-status-bottom bg-primary"></div>
              <div class="card-body p-2 text-center ">
                  <div class="demo-icon-preview">
                      <div data-icon-preview-icon="">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <circle cx="9" cy="7" r="4"></circle>
                              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                          </svg>
                      </div>
                  </div>
                  <div class="text-h3 m-0 font-weight-bold">[10] Yönetim Kurulu</div>
                  <div class="text-muted mb-3">
                      <a href="https://sasder.org/go/team" title="Proje Yönetimi" class="btn btn-outline-tabler btn-sm ">
                          Yönetim Kurulu Yönetimi
                      </a>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-sm-3 mt-2">
          <div class="card">
              <div class="card-status-bottom bg-primary"></div>
              <div class="card-body p-2 text-center ">
                
                  <svg xmlns="http://www.w3.org/2000/svg" style="width: 60px;height: 60px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="13 3 13 10 19 10 11 21 11 14 5 14 13 3"></polyline></svg>
                  
                  <div class="text-h3 m-0 font-weight-bold">[0] Etkinlik</div>
                  <div class="text-muted mb-3">
                      <a href="https://sasder.org/go/event" title="Proje Yönetimi" class="btn btn-outline-tabler btn-sm ">
                          Etkinlik Yönetimi
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <a href="#tabs-home-7" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
              Home</a>
          </li>
          <li class="nav-item" role="presentation">
            <a href="#tabs-profile-7" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
              Profile</a>
          </li>
          <li class="nav-item" role="presentation">
            <a href="#tabs-activity-7" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"><!-- Download SVG icon from http://tabler-icons.io/i/activity -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12h4l3 8l4 -16l3 8h4"></path></svg>
              Activity</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active show" id="tabs-home-7" role="tabpanel">
            <h4>Home tab</h4>
            <div class="card">
              <div class="card-body text-center">
                  <i class="fa fa-globe text-primary fa-3x text-primary-shadow"></i>
                  <h6 class="mt-4 mb-2">Total Visit</h6>
                  <h2 class="mb-2 number-font">834</h2>
                  <p class="text-muted">Sed ut perspiciatis unde omnis accusantium doloremque</p>
              </div>
          </div>          
        </div>
          <div class="tab-pane" id="tabs-profile-7" role="tabpanel">
            <h4>Profile tab</h4>
            <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
          </div>
          <div class="tab-pane" id="tabs-activity-7" role="tabpanel">
            <h4>Activity tab</h4>
            <div>Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit mauris accumsan nibh habitant senectus</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

