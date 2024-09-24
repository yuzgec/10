<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container">
                <div class="row flex-fill align-items-center">
                    <div class="col">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('home')}}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-dashboard.icon.home width="20"/>
                                    </span>
                                    <span class="nav-link-title pt-1">
                                        Anasayfa
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"
                                    href="#navbar-help"
                                    data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside"
                                    role="button"
                                    aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-dashboard.icon.user width="20"/>
                                    </span>
                                    <span class="nav-link-title pt-1">
                                        CRM
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                  
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
                                            <a href="./cards.html" class="dropdown-item">
                                                Müşteri Listesi
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
                                        <x-dashboard.icon.user width="20"/>
                                    </span>
                                    <span class="nav-link-title pt-1">
                                        İ.K.
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                            <x-dashboard.icon.add/> Personel
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
                                            <x-dashboard.icon.add/> İzin
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
                                <a class="nav-link dropdown-toggle"
                                    href="#navbar-help"
                                    data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside"
                                    role="button"
                                    aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <x-dashboard.icon.user width="20"/>
                                    </span>
                                    <span class="nav-link-title pt-1">
                                        Kullanıcı
                                    </span>
                                </a>
                                <div class="dropdown-menu">
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
                                    <a class="dropdown-item" href="./chat.html">
                                        Kullanıcı Yetkileri
                                    </a>
                                    <a class="dropdown-item" href="{{route('activity')}}" title="Etkinlikler">
                                        Kullanıcı Etkinlikleri
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
                                        <x-dashboard.icon.user width="20"/>
                                    </span>
                                    <span class="nav-link-title pt-1">
                                        Site Yönetimi
                                    </span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                            Sayfa
                                        </a>
                                        <div class="dropdown-menu">
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
                                                href="{{ route('category.index', ['q' => 1,'name' => 'Sayfa'])}}"
                                                title="Sayfa Kategori Listesi">
                                                <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                            </a>
                                            <a class="dropdown-item" href="{{route('page.trash')}}" title="Silinmiş Sayfalar">
                                                <x-dashboard.icon.delete width="16"/> Silinmiş Sayfalar
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                            Hizmet
                                        </a>
                                        <div class="dropdown-menu">
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
                                            href="{{ route('category.index', ['q' => 2,'name' => 'Hizmet'])}}"
                                            title="Sayfa Oluştur">
                                                <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                            </a>
                                            
                                            <a class="dropdown-item" href="{{route('service.trash')}}" title="Silinmiş Hizmetler">
                                                <x-dashboard.icon.delete width="16"/> Silinmiş Sayfalar
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                            Blog
                                        </a>
                                        <div class="dropdown-menu">
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
                                                href="{{ route('category.index', ['q' => 3,'name' => 'Blog'])}}"
                                                title="Kategori Listesi">
                                                <x-dashboard.icon.category width="16"/> Kategori Yönetimi
                                            </a>
                                            
                                            <a class="dropdown-item" href="{{route('activity')}}" title="Silinmiş Sayfalar">
                                                <x-dashboard.icon.delete width="16"/> Silinmiş Hizmetler
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                            S.S.S.
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
                                            Galeri
                                        </a>
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
                                            
                                            <a class="dropdown-item" href="{{route('activity')}}" title="Etkinlikler">
                                                Silinmiş Sayfalar
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                            Slider
                                        </a>
                                        <div class="dropdown-menu">
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('page.index')}}"
                                                title="Sayfa Listesi">
                                                Slider Listele
                                            </a>
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('page.create')}}"
                                                title="Sayfa Oluştur">
                                                Slider Ekle
                                            </a>
                                            
                                           
                                        </div>
                                    </div>
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                            Kategori
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('category.index')}}"
                                                title="Sayfa Listesi">
                                                Kategori Yönetimi
                                            </a>
                                            <a class="dropdown-item"
                                                href="{{ route('page.create')}}"
                                                title="Sayfa Oluştur">
                                                Kategori Oluştur
                                            </a>
                                            
                                            <a class="dropdown-item" href="{{route('activity')}}" title="Etkinlikler">
                                                Silinmiş Sayfalar
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
                                        <x-dashboard.icon.cart width="20"/>
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

                            
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>