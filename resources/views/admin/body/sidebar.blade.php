@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('admin.dashboard.home') }}">

                    <div class="d-flex align-items-center d-lg-flex flex-column justify-content-center">
                        <h3><b>AgenceDigitals </b> Admin </h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ $prefix == '/admin' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard.home') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ $prefix == '/message' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="mail"></i>
                    <span>Message(s)</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'booking.view' ? 'active' : '' }}">
                        <a href="{{ route('user.chat.msg') }}"><i class="ti-more"></i>Client -> Admin</a>
                    </li>

                    <li class="{{ $route == 'message.view' ? 'active' : '' }}">
                        <a href="{{ route('message.view') }}"><i class="ti-more"></i> Aide ou Information</a>
                    </li>

                </ul>
            </li>
            <li class="treeview {{ $prefix == '/about' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="info"></i> <span>A Propos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.about' ? 'active' : '' }}">
                        <a href="{{ route('all.about') }}"><i class="ti-more"></i>Appercu</a>
                    </li>
                    <li class="{{ $route == 'principal.slider.view' ? 'active' : '' }}">
                        <a href="{{ route('principal.slider.view') }}"><i class="ti-more"></i>Accueil Info</a>
                    </li>
                    <li class="{{ $route == 'view.all.services' ? 'active' : '' }}">
                        <a href="{{ route('view.all.services') }}"><i class="ti-more"></i>Liste des Services</a>
                    </li>
                    <li class="{{ $route == 'all.choose.us' ? 'active' : '' }}">
                        <a href="{{ route('all.choose.us') }}"><i class="ti-more"></i>Pourquoi nous choisir ?</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/category' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="git-pull-request"></i> <span>Categories</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'all.category' ? 'active' : '' }}">
                        <a href="{{ route('all.category') }}"><i class="ti-more"></i>Liste des Categories</a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ $prefix == '/products' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="shopping-cart"></i>
                    <span>Mes Produits</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'add.formation.view' ? 'active' : '' }}">
                        <a href="{{ route('add.formation.view') }}"><i class="ti-more"></i>Ajouter une Formation</a>
                    </li>
                </ul>
            </li>
            <li class="{{ $prefix == '/users/list' ? 'active' : '' }}">
                <a href="{{ route('admin.user.list') }}">
                    <i data-feather="users"></i>
                    <span>Utilisateurs</span>
                </a>
            </li>

            <li class="{{ $prefix == '/blog/view' ? 'active' : '' }}">
                <a href="{{ route('blog.view') }}">
                    <i data-feather="book"></i>
                    <span>Mon Blog</span>
                </a>
            </li>
            <li class="{{ $prefix == '/currency/view' ? 'active' : '' }}">
                <a href="{{ route('currency.view') }}">
                    <i data-feather="device"></i>
                    <span>Devise</span>
                </a>
            </li>
            <li class="{{ $prefix == '/notification/view' ? 'active' : '' }}">
                <a href="{{ route('notif.view') }}">
                    <i data-feather="bell"></i>
                    <span>Mes Notifications</span>
                </a>
            </li>
            <li class="{{ $prefix == '/testimonial/view' ? 'active' : '' }}">
                <a href="{{ route('testimonial.view') }}">
                    <i data-feather="star"></i>
                    <span>Temoignages</span>
                </a>
            </li>

            <li class="treeview {{ $prefix == '/brand' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="plus-square"></i>
                    <span>Autre(s)</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>

            </li>

            </li>
        </ul>
    </section>


</aside>
