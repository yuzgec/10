<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-brand navbar-brand-autodark mb-10">
            <a href="{{ route('go')}}">
              <img src="/backend/godijital.png" width="110" class="navbar-brand-image">
            </a>
          </div>
          <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('go')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-dashboard.icon.home width="20" height="20"/>
                        </span>
                        <span class="nav-link-title pt-1">
                            Anasayfa
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown {{ Request::is('go/crm*') ? 'show' : '' }}">
                    <a class="nav-link dropdown-toggle"
                        href="#navbar-help"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside"
                        role="button"
                        aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-dashboard.icon.user width="20" height="20"/>
                        </span>
                        <span class="nav-link-title pt-1">
                            CRM
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Request::is('go/crm*') ? 'show' : '' }}">
                        
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <x-dashboard.icon.add width="16"/> Müşteri
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('customer.index')}}" class="dropdown-item">
                                    Müşteri Listesi
                                </a>
                                <a href="{{ route('customer.create')}}" class="dropdown-item">
                                    Müşteri Ekle
                                </a>
                                <a href="{{ route('customer.index')}}" class="dropdown-item">
                                    Müşteri Raporları
                                </a>
                            </div>
                        </div>
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <x-dashboard.icon.date width="16"/> Randevu
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('calendar')}}" class="dropdown-item">
                                    Takvim
                                </a>
                            </div>
                        </div>
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <x-dashboard.icon.lira width="16"/> Ödeme
                            </a>
                            <div class="dropdown-menu">
                                <a href="./cards.html" class="dropdown-item">
                                    Müşteri Listesi
                                </a>
                            </div>
                        </div>

                        <a class="dropdown-item"
                            href="{{ route('offer.index')}}"
                            title="Kullanıcı Oluştur">
                            <x-dashboard.icon.pdf width="16"/> Teklifler
                        </a>
                        
                        <a class="dropdown-item"
                            href="{{ route('workflow.index')}}"
                            title="Kullanıcı Oluştur">
                            <x-dashboard.icon.date width="16"/> İş Takvimi
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('user.create')}}"
                            title="Kullanıcı Oluştur">
                            <x-dashboard.icon.sms width="16"/> SMS Gönder
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('user.create')}}"
                            title="Kullanıcı Oluştur">
                            <x-dashboard.icon.envelope width="16"/> Email Gönder
                        </a>
                        
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                        href="#navbar-help"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside"
                        role="button"
                        aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-dashboard.icon.user width="20" height="20"/>
                        </span>
                        <span class="nav-link-title pt-1">
                            İ.K.
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <x-dashboard.icon.add width="16" height="16"/> Personel
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('customer.index')}}" class="dropdown-item">
                                Personel Listesi
                                </a>
                                <a href="{{ route('customer.create')}}" class="dropdown-item">
                                Personel Ekle
                                </a>
                            </div>
                        </div>
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <x-dashboard.icon.add width="16" height="16"/> İzin
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('customer.index')}}" class="dropdown-item">
                                    Personel Listesi
                                </a>
                                <a href="{{ route('customer.create')}}" class="dropdown-item">
                                    Personel Ekle
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('go/user/*') ? 'show' : '' }}"
                        href="#navbar-help"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside"
                        role="button"
                        aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-dashboard.icon.user width="20" height="20"/>
                        </span>
                        <span class="nav-link-title pt-1">
                            Kullanıcı
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Request::is('go/user/*') ? 'show' : '' }}">
                        <a class="dropdown-item"
                            href="{{ route('user.index')}}"
                            title="Kullanıcı Listesi">
                            Kullanıcı Listesi
                        </a>
                        <a class="dropdown-item"
                            href="{{ route('user.create')}}"
                            title="Kullanıcı Oluştur">
                            Kullanıcı Ekle
                        </a>
                        <a class="dropdown-item"
                            href="{{ route('role.index')}}"
                            title="Kullanıcı Rolleri">
                            Kullanıcı Roller
                        </a>
                        <a class="dropdown-item" href="{{ route('permission.index')}}">
                            Kullanıcı Yetkileri
                        </a>
                        <a class="dropdown-item" href="{{route('activity')}}" title="Etkinlikler">
                            Kullanıcı Etkinlikleri
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown {{ Request::is('go') || Request::is('go/site*') ? 'show' : '' }}">
                    <a class="nav-link dropdown-toggle {{ Request::is('go') || Request::is('go/site*') ? 'text-white' : '' }}"
                        href="#navbar-help"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside"
                        role="button"
                        aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-dashboard.icon.user width="20" height="20"/>
                        </span>
                        <span class="nav-link-title pt-1">
                            Site Yönetimi
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Request::is('go') || Request::is('go/site*') ? 'show' : '' }}">
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle {{ Request::is('go/site/page*') ? 'show' : '' }}" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <x-dashboard.icon.edit width="16" height="16"/> Sayfa
                            </a>
                            <div class="dropdown-menu {{ Request::is('go/site/page*') ? 'show' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('page.index')}}"
                                    title="Sayfa Listesi">
                                    <x-dashboard.icon.menu-list width="16"/> Sayfa Yönetimi
                                </a>
                                <a class="dropdown-item"
                                    href="{{ route('page.create')}}"
                                    title="Sayfa Oluştur">
                                    <x-dashboard.icon.add width="16"/> Sayfa Oluştur
                                </a>
                                <a class="dropdown-item"
                                    href="{{ route('category.index', ['q' =>'sayfa','name' => 'Sayfa'])}}"
                                    title="Sayfa Kategori Listesi">
                                    <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                </a>
                                <a class="dropdown-item" href="{{route('page.trash')}}" title="Silinmiş Sayfalar">
                                    <x-dashboard.icon.delete width="16"/> Silinmiş Sayfalar
                                </a>
                            </div>
                        </div>
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle {{ Request::is('go/site/service*') ? 'show' : '' }}" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <x-dashboard.icon.heart width="16" height="16"/> Hizmet
                            </a>
                            <div class="dropdown-menu {{ Request::is('go/site/service*') ? 'show' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('service.index')}}"
                                    title="Sayfa Listesi">
                                    <x-dashboard.icon.menu-list width="16"/> Hizmet Listele
                                </a>
                                <a class="dropdown-item"
                                    href="{{ route('service.create')}}"
                                    title="Hizmet Oluştur">
                                    <x-dashboard.icon.add width="16"/> Hizmet Oluştur
                                </a>
                                <a class="dropdown-item"
                                href="{{ route('category.index', ['q' => 'hizmet','name' => 'Hizmet'])}}"
                                title="Sayfa Oluştur">
                                    <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                </a>
                                
                                <a class="dropdown-item" href="{{route('service.trash')}}" title="Silinmiş Hizmetler">
                                    <x-dashboard.icon.delete width="16"/> Silinmiş Sayfalar
                                </a>
                            </div>
                        </div>
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle {{ Request::is('go/site/blog*') ? 'show' : '' }}" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <x-dashboard.icon.blog width="16" height="16"/> Blog
                            </a>
                            <div class="dropdown-menu {{ Request::is('go/site/blog*') ? 'show' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('blog.index')}}"
                                    title="Blog Listesi">
                                    <x-dashboard.icon.menu-list width="16"/> Blog Listele
                                </a>
                                <a class="dropdown-item"
                                    href="{{ route('blog.create')}}"
                                    title="Blog Oluştur">
                                    <x-dashboard.icon.add width="16"/> Blog Oluştur
                                </a>
                                
                                <a class="dropdown-item"
                                    href="{{ route('category.index', ['q' => 'blog','name' => 'Blog'])}}"
                                    title="Kategori Listesi">
                                    <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                </a>
                                
                                <a class="dropdown-item" href="{{route('activity')}}" title="Silinmiş Sayfalar">
                                    <x-dashboard.icon.delete width="16"/> Silinmiş Hizmetler
                                </a>
                            </div>
                        </div>
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle {{ Request::is('go/site/faq*') ? 'show' : '' }}" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <x-dashboard.icon.question-mark width="16" height="16"/> S.S.S.
                            </a>
                            <div class="dropdown-menu {{ Request::is('go/site/faq*') ? 'show' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('faq.index')}}"
                                    title="Sayfa Listesi">
                                    <x-dashboard.icon.menu-list width="16"/> S.S.S Listesi
                                </a>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('faq.create')}}"
                                    title="Sayfa Oluştur">
                                    <x-dashboard.icon.add width="16"/> S.S.S Oluştur
                                </a>

                                <a class="dropdown-item"
                                href="{{ route('category.index', ['q' => 'sss','name' => 'SSS'])}}"
                                    title="Kategori Listesi">
                                    <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                </a>
                                
                                <a class="dropdown-item" href="{{route('activity')}}" title="Etkinlikler">
                                    <x-dashboard.icon.delete width="16"/> Silinmiş Sayfalar
                                </a>
                            </div>
                        </div>
                        
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <x-dashboard.icon.image width="16" height="16"/> Resim Galeri
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('faq.index')}}"
                                    title="Sayfa Listesi">
                                    <x-dashboard.icon.menu-list width="16"/> S.S.S Listesi
                                </a>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('faq.create')}}"
                                    title="Sayfa Oluştur">
                                    <x-dashboard.icon.add width="16"/> S.S.S Oluştur
                                </a>

                                <a class="dropdown-item"
                                    href="{{ route('category.index', ['q' => 5,'name' => 'SSS'])}}"
                                    title="Kategori Listesi">
                                    <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                </a>
                                
                                <a class="dropdown-item" href="{{route('activity')}}" title="Etkinlikler">
                                    <x-dashboard.icon.delete width="16"/> Silinmiş Sayfalar
                                </a>
                            </div>
                        </div>

                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <x-dashboard.icon.video width="16" height="16"/> Video Galeri
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('faq.index')}}"
                                    title="Sayfa Listesi">
                                    <x-dashboard.icon.menu-list width="16"/> S.S.S Listesi
                                </a>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('faq.create')}}"
                                    title="Sayfa Oluştur">
                                    <x-dashboard.icon.add width="16"/> S.S.S Oluştur
                                </a>

                                <a class="dropdown-item"
                                    href="{{ route('category.index', ['q' => 'sss','name' => 'SSS'])}}"
                                    title="Kategori Listesi">
                                    <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                </a>
                                
                                <a class="dropdown-item" href="{{route('activity')}}" title="Etkinlikler">
                                    <x-dashboard.icon.delete width="16"/> Silinmiş Sayfalar
                                </a>
                            </div>
                        </div>


                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle {{ Request::is('go/site/team*') ? 'show' : '' }}" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <x-dashboard.icon.user width="16" height="16"/> Ekip Yönetimi
                            </a>
                            <div class="dropdown-menu {{ Request::is('go/site/team*') ? 'show' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('team.index')}}"
                                    title="Ekip Listesi">
                                    <x-dashboard.icon.menu-list width="16"/> Ekip Listesi
                                </a>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('team.create')}}"
                                    title="Ekip Oluştur">
                                    <x-dashboard.icon.add width="16"/> Ekip Oluştur
                                </a>

                                <a class="dropdown-item"
                                    href="{{ route('category.index', ['q' => 'ekip','name' => 'Ekip'])}}"
                                    title="Kategori Listesi">
                                    <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                </a>
                                
                                <a class="dropdown-item" href="{{route('activity')}}" title="Silinmiş Ekip Üyesi">
                                    <x-dashboard.icon.delete width="16"/> Silinmiş Ekip Üyesi
                                </a>
                            </div>
                        </div>


                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <x-dashboard.icon.slider width="16" height="16"/> Slider Yönetimi
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('faq.index')}}"
                                    title="Sayfa Listesi">
                                    <x-dashboard.icon.menu-list width="16"/> S.S.S Listesi
                                </a>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('faq.create')}}"
                                    title="Sayfa Oluştur">
                                    <x-dashboard.icon.add width="16"/> S.S.S Oluştur
                                </a>

                                <a class="dropdown-item"
                                    href="{{ route('category.index', ['q' => 5,'name' => 'SSS'])}}"
                                    title="Kategori Listesi">
                                    <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                </a>
                                
                                <a class="dropdown-item" href="{{route('activity')}}" title="Etkinlikler">
                                    <x-dashboard.icon.delete width="16"/> Silinmiş Sayfalar
                                </a>
                            </div>
                        </div>


                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle {{ Request::is('go/site/category*') ? 'show' : '' }}" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <x-dashboard.icon.menu-list width="16"/> Kategori
                            </a>
                            <div class="dropdown-menu {{ Request::is('go/site/category*') ? 'show' : '' }}">
                                <a class="dropdown-item"
                                    href="{{ route('category.indexAll')}}"
                                    title="Kategori Listesi">
                                    <x-dashboard.icon.menu-list width="16"/> Kategori Listesi
                                </a>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('category.create')}}"
                                    title="Kategori Oluştur">
                                    <x-dashboard.icon.add width="16"/> Kategori Oluştur
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </li>


                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#navbar-help"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside"
                        role="button"
                        aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-dashboard.icon.cart width="20" height="20"/>
                        </span>
                        <span class="nav-link-title pt-1">
                            E-Ticaret
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                Ürünler
                            </a>
                            <div class="dropdown-menu">
                                <a
                                    class="dropdown-item"
                                    href="{{ route('product.index')}}"
                                    title="Sayfa Listesi">
                                    Ürün Listesi
                                </a>

                            </div>
                        </div>
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                Siparişler
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('page.index')}}"
                                    title="Sayfa Listesi">
                                    Sipariş Listesi
                                </a>
                                <a class="dropdown-item"
                                    href="{{ route('page.index')}}"
                                    title="Sayfa Listesi">
                                    Gelen Sipariş
                                </a>
                                <a class="dropdown-item"
                                    href="{{ route('page.index')}}"
                                    title="Sayfa Listesi">
                                    İptal Sipariş
                                </a>
                                <a class="dropdown-item"
                                    href="{{ route('page.index')}}"
                                    title="Sayfa Listesi">
                                    Stok Yönetimi
                                </a>
                
                            </div>
                        </div>
                    </div>
                    
                    <div class="dropdown-menu">
                        <a
                            class="dropdown-item"
                            href="{{ route('page.index')}}"
                            title="Sayfa Listesi">
                            Sayfa Yönetimi
                        </a>
                        <a
                            class="dropdown-item"
                            href="{{ route('page.create')}}"
                            title="Sayfa Oluştur">
                            Sayfa Oluştur
                        </a>
                        <a
                            class="dropdown-item"
                            href="{{ route('user.create')}}"
                            title="Kullanıcı Oluştur">
                            Sıkça Sorulan Sorular
                        </a>
                        <a
                            class="dropdown-item"
                            href="{{ route('user.create')}}"
                            title="Kullanıcı Oluştur">
                            S.S.S. Kategori
                        </a>
                        
                        <a class="dropdown-item" href="{{route('activity')}}" title="Etkinlikler">
                            Silinmiş Sayfalar
                        </a>
                    </div>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('settings.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-dashboard.icon.settings width="20" height="20"/>
                        </span>
                        <span class="nav-link-title pt-1">
                            Ayarlar
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('redirects.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-dashboard.icon.redirect width="20" height="20"/>
                        </span>
                        <span class="nav-link-title pt-1">
                            Yönlendirme
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('language.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-dashboard.icon.language width="20" height="20"/>
                        </span>
                        <span class="nav-link-title pt-1">
                            Diller
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('translation.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-dashboard.icon.comment width="20" height="20"/>
                        </span>
                        <span class="nav-link-title pt-1">
                            Çeviri
                        </span>
                    </a>
                </li>

                

            </ul>
                        
          </div>
        </div>
      </aside>