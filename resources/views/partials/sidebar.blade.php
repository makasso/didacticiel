<div class="iq-sidebar  sidebar-default">
    <div class="iq-sidebar-logo d-flex align-items-center">
        <a href="{{ url('/') }}" class="header-logo d-flex align-items-center">
            <h2 class="text-primary mr-1">D</h2>
            <h4 class="logo-title light-logo">{{ env('APP_NAME') }}</h4>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="svg-icon">
                        <i class="ri-home-3-line"></i>
                        <span class="ml-4">Tableau de bord</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                    <a href="#categories" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="ri-file-fill"></i>
                        <span class="ml-4">Catégories</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>
                    <ul id="categories" class="iq-submenu collapse" data-parent="#categories">
                        <li class="{{ request()->routeIs('admin.category.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.category.index') }}">
                                <i class="las la-minus"></i><span>Lister les catégories</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.category.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.category.create') }}">
                                <i class="las la-minus"></i><span>Ajouter une catégorie</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('admin.course.*') ? 'active' : '' }}">
                    <a href="#cours" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="ri-book-open-fill"></i>
                        <span class="ml-4">Cours</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>
                    <ul id="cours" class="iq-submenu collapse" data-parent="#cours">
                        <li class="{{ request()->routeIs('admin.category.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.course.index') }}">
                                <i class="las la-minus"></i><span>Lister les cours</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.category.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.course.create') }}">
                                <i class="las la-minus"></i><span>Ajouter un cours</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('admin.module.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.module.index') }}">
                        <i class="ri-sound-module-fill"></i>
                        <span class="ml-4">Modules</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.prof.*') ? 'active' : '' }}">
                    <a href="#profs" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="ri-user-2-fill"></i>
                        <span class="ml-4">Professeurs</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>
                    <ul id="profs" class="iq-submenu collapse" data-parent="#profs">
                        <li class="{{ request()->routeIs('admin.prof.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.prof.index') }}">
                                <i class="las la-minus"></i><span>Lister les professeurs</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.prof.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.prof.create') }}">
                                <i class="las la-minus"></i><span>Ajouter un professeur</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">
                    <a href="#sliders" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="ri-slideshow-2-fill"></i>
                        <span class="ml-4">Slides</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>
                    <ul id="sliders" class="iq-submenu collapse" data-parent="#sliders">
                        <li class="{{ request()->routeIs('admin.slider.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.slider.index') }}">
                                <i class="las la-minus"></i><span>Lister les slides</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.slider.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.slider.create') }}">
                                <i class="las la-minus"></i><span>Ajouter un slide</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('admin.examen.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.examen.index') }}">
                        <i class="ri-questionnaire-fill"></i>
                        <span class="ml-4">Quiz</span>
                    </a> 
                </li>
                <li class="{{ request()->routeIs('admin.qnaans-module.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.qnaans-module.index') }}">
                        <i class="ri-honour-fill"></i>
                        <span class="ml-4">Examens</span>
                    </a> 
                </li>
               
                <li class="{{ request()->routeIs('admin.marks.examen.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.marks.examen') }}">
                        <i class="ri-bookmark-2-fill"></i>
                        <span class="ml-4">Notes</span>
                    </a> 
                </li>
                <li class="{{ request()->routeIs('reviewQna.*') ? 'active' : '' }}">
                    <a href="{{ route('reviewQna') }}">
                        <i class="ri-bookmark-3-fill"></i>
                        <span class="ml-4">Correction Notes</span>
                    </a> 
                </li>

            </ul>
        </nav>
        <div class="pt-5 pb-2"></div>
    </div>
</div>
