<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="d-flex">
        <a href="{{ url('admin/dashboard') }}" class="brand-link">
            
            <h2 class="p-2">My Site</h2>
            
        </a>

    </div>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ auth()->user()->profile_photo }}" class="img-circle elevation-2" alt="User Image"> --}}
            </div>
            <div class="info">
                {{-- <a href="{{ route('profile') }}" class="d-block">{{ auth()->user()->name }}</a> --}}
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/dashboard') }}"
                        class="nav-link {{ strpos(Route::currentRouteName(), 'dashboard') !== false ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <x-menus.sidebar.nav-item
                        route="user-management"
                        icon="fas fa-user"
                        label="User Management"
                        :active-when="['user-management']"
                    />
                <x-menus.sidebar.nav-item
                    route="vendors-management.index"
                    icon="fas fa-industry"
                    label="Vendor Management"
                    :active-when="['vendors-management.*']"
                />
                <x-menus.sidebar.nav-item
                    route="introduction-question"
                    icon="fas fa-file-alt"
                    label="Introduction Question"
                    :active-when="['introduction-question']"
                />
                <x-menus.sidebar.nav-item
                        route="helpSupport"
                        icon="fas fa-question-circle"
                        label="Help & Support"
                        :active-when="['helpSupport']"
                    />
                <x-menus.sidebar.nav-item
                        route="subscriber-list"
                        icon="fas fa-users"
                        label="Subscribers"
                        :active-when="['subscriber-list']"
                    />
                {{-- <li class="nav-item">
                    <a href="{{ url('admin/subscription-plan') }}" class="nav-link {{ strpos(Route::currentRouteName(), 'subscription-plan') !== false ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Subscription Plan</p>
                    </a>
                </li> --}}

                <x-menus.sidebar.nav-parent-item icon="fas fa-store" label="Ecommerce" :active-when="['products.*','categories.*','brands.*','admin.product_units.*','admin.variations.*']" >
                    <x-menus.sidebar.nav-item
                        route="products.index"
                        icon="far fa-circle"
                        label="Products"
                        :active-when="['products.*']"
                    />
                    <x-menus.sidebar.nav-item
                        route="categories.index"
                        icon="far fa-circle"
                        label="Categories"
                        :active-when="['categories.*']"
                    />
                    <x-menus.sidebar.nav-item
                        route="brands.index"
                        icon="far fa-circle"
                        label="Brands"
                        :active-when="['brands.*']"
                    />
                    <x-menus.sidebar.nav-item
                        route="admin.product_units.index"
                        icon="far fa-circle"
                        label="Units"
                        :active-when="['admin.product_units.*']"
                    />
                    <x-menus.sidebar.nav-item
                        route="admin.variations.index"
                        icon="far fa-circle"
                        label="Variations"
                        :active-when="['admin.variations.*']"
                    />
                </x-menus.sidebar.nav-parent-item>
                <x-menus.sidebar.nav-parent-item icon="fas fas fa-cog" label="Setting" :active-when="['setting','roles.*','permissions.*']" >
                    <x-menus.sidebar.nav-item
                        route="setting"
                        icon="far fa-circle"
                        label="Settings"
                        :active-when="['setting']"
                    />
                    <x-menus.sidebar.nav-item
                        route="roles.index"
                        icon="far fa-circle"
                        label="Roles & Permissions"
                        :active-when="['roles.*','permissions.*']"
                    />
                </x-menus.sidebar.nav-parent-item>

                <x-menus.sidebar.nav-item
                        route="PrivacyPolicyView"
                        icon="fas fa-file-alt"
                        label="Privacy Policy"
                        :active-when="['PrivacyPolicyView.*']"
                    />
                <x-menus.sidebar.nav-item
                    route="termsConditionsView"
                    icon="fas fa-file-alt"
                    label="Terms & Conditions"
                    :active-when="['termsConditionsView.*']"
                />
                <x-menus.sidebar.nav-item
                    route="view-faq"
                    icon="fas fa-file-alt"
                    label="FAQ"
                    :active-when="['view-faq']"
                />

            </ul>
        </nav>
    </div>
</aside>
