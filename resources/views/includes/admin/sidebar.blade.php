<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{asset('/frontend_assets/images/favicon.png')}}" alt="" class="brand-image">
        <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item {{(url()->current()==route('admin.dashboard'))?'menu-open':''}}">
                    <a href="{{route('admin.dashboard')}}" class="nav-link {{(url()->current()==route('admin.dashboard'))?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- CMS Pages -->
                <li class="nav-item">
                    <a href="{{route('admin.CmsPages')}}" class="nav-link {{(url()->current()==route('admin.CmsPages'))?'active':''}}">
                        <i class="nav-icon fas fa-file "></i>
                        <p>CMS Pages</p>
                    </a>
                </li>
                <!-- News Publications -->
                <li class="nav-item">
                    <a href="{{route('admin.NewsPublications')}}" class="nav-link {{(url()->current()==route('admin.NewsPublications'))?'active':''}}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>News Publications</p>
                    </a>
                </li>
                <!-- Settings -->
                <li class="nav-item 
                 {{(
                   url()->current()==route('admin.Settings','general-settings')
                 ||url()->current()==route('admin.Settings','payment-settings')
                 ||url()->current()==route('admin.Settings','page-settings')
                 ||url()->current()==route('admin.Settings','banner-settings')
                 ||url()->current()==route('admin.Settings','homepage-settings')
                 ||url()->current()==route('admin.Settings','agents-brokers-settings')
                 ||url()->current()==route('admin.Settings','news-settings')
                 ||url()->current()==route('admin.Settings','publications-settings')
                 ||url()->current()==route('admin.Settings','prescriptions-settings')
                 ||url()->current()==route('admin.Settings','vision-settings')
                 ||url()->current()==route('admin.Settings','contact-us-settings')
                 ||url()->current()==route('admin.Settings','providers-settings')
                 ||url()->current()==route('admin.Settings','plan-members-settings')
                 ||url()->current()==route('admin.Settings','services-settings')

                   )?'menu-is-opening menu-open':''}}">


                    <a href="#" class="nav-link 
                     {{(
                        url()->current()==route('admin.Settings','general-settings')
                      ||url()->current()==route('admin.Settings','payment-settings')
                      ||url()->current()==route('admin.Settings','page-settings')
                      ||url()->current()==route('admin.Settings','banner-settings')
                      ||url()->current()==route('admin.Settings','homepage-settings')
                      ||url()->current()==route('admin.Settings','agents-brokers-settings')
                      ||url()->current()==route('admin.Settings','news-settings')
                      ||url()->current()==route('admin.Settings','publications-settings')
                      ||url()->current()==route('admin.Settings','prescriptions-settings')
                      ||url()->current()==route('admin.Settings','vision-settings')
                      ||url()->current()==route('admin.Settings','contact-us-settings')
                      ||url()->current()==route('admin.Settings','providers-settings')
                      ||url()->current()==route('admin.Settings','plan-members-settings')
                      ||url()->current()==route('admin.Settings','services-settings')

                      )?'active':''}}">


                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.Settings','general-settings')}}" class="nav-link {{(url()->current()==route('admin.Settings','general-settings'))?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General Settings</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.Settings','payment-settings')}}" class="nav-link {{(url()->current()==route('admin.Settings','payment-settings'))?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment Settings</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.Settings','page-settings')}}" class="nav-link 
                            {{(
                                 url()->current()==route('admin.Settings','page-settings') 
                              || url()->current()==route('admin.Settings','banner-settings') 
                              || url()->current()==route('admin.Settings','homepage-settings') 
                              || url()->current()==route('admin.Settings','agents-brokers-settings') 
                              || url()->current()==route('admin.Settings','news-settings') 
                              || url()->current()==route('admin.Settings','publications-settings') 
                              || url()->current()==route('admin.Settings','prescriptions-settings') 
                              || url()->current()==route('admin.Settings','vision-settings') 
                              || url()->current()==route('admin.Settings','contact-us-settings') 
                              || url()->current()==route('admin.Settings','providers-settings') 
                              || url()->current()==route('admin.Settings','plan-members-settings') 
                              || url()->current()==route('admin.Settings','services-settings') 

                              )?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Page Settings</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Custom Boxes -->
                <li class="nav-item">
                    <a href="{{route('admin.CustomBoxes')}}" class="nav-link {{(url()->current()==route('admin.CustomBoxes'))?'active':''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Custom Boxes
                        </p>
                    </a>
                </li>
                <!-- Accordian -->
                <li class="nav-item">
                    <a href="{{route('admin.Accordians')}}" class="nav-link {{(url()->current()==route('admin.Accordians'))?'active':''}}">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>Accordians</p>
                    </a>
                </li>
                <!-- Emails -->
                <li class="nav-item">
                    <a href="{{route('admin.emails.index')}}" class="nav-link {{(url()->current()==route('admin.emails.index'))?'active':''}}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Email Management</p>
                    </a>
                </li>
                <!-- Primary Members -->
                <li class="nav-item">
                    <a href="{{route('admin.members.index')}}" class="nav-link {{(url()->current()==route('admin.members.index'))?'active':''}}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Members</p>
                    </a>
                </li>
                <!-- Import Providers and Provider Offices -->
                <li class="nav-item">
                    <a href="{{route('admin.import')}}" class="nav-link {{(url()->current()==route('admin.import'))?'active':''}}">
                        <i class="nav-icon fas fa-file-import"></i>
                        <p>Import Old Data</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>