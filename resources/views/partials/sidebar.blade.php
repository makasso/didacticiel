<div class="iq-sidebar  sidebar-default">
    <div class="iq-sidebar-logo d-flex align-items-center">
        @auth
            <a href="{{ auth()->user()->role_as == '1' ? route('admin.dashboard') : route('prof.dashboard') }}"
                class="header-logo d-flex align-items-center">
                <h2 class="text-primary mr-1">{{ Str::substr(config('app.name'), 0, 1) }}</h2>
                <h4 class="logo-title light-logo">{{ config('app.name') }}</h4>
            </a>
        @endauth
        @guest
            <a href="#" class="header-logo d-flex align-items-center">
                <h2 class="text-primary mr-1">{{ Str::substr(config('app.name'), 0, 1) }}</h2>
                <h4 class="logo-title light-logo">{{ config('app.name') }}</h4>
            </a>
        @endguest
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                @auth
                    @if (auth()->user()->role_as == '0')
                        <li class="{{ request()->routeIs('prof.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('prof.dashboard') }}" class="svg-icon">
                                <i class="ri-home-3-fill"></i>
                                <span class="ml-4">Tableau de bord</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('prof.course.*') ? 'active' : '' }}">
                            <a href="{{ route('prof.course.index') }}">
                                <i class="ri-book-open-fill"></i>
                                <span class="ml-4">Cours</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('prof.examen.*') ? 'active' : '' }}">
                            <a href="{{ route('prof.examen.index') }}">
                                <i class="ri-honour-fill"></i>
                                <span class="ml-4">Examens</span>
                            </a>
                        </li>
                    @elseif (auth()->user()->role_as == '1')
                        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ auth()->user()->role_as == '1' ? route('admin.dashboard') : route('prof.dashboard') }}"
                                class="svg-icon">
                                <i class="ri-home-3-fill"></i>
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
                                <li class="{{ request()->routeIs('admin.course.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.course.index') }}">
                                        <i class="las la-minus"></i><span>Lister les cours</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.course.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.course.create') }}">
                                        <i class="las la-minus"></i><span>Ajouter un cours</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ request()->routeIs('admin.module.*') ? 'active' : '' }}">
                            <a href="#modules" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <i class="ri-sound-module-fill"></i>
                                <span class="ml-4">Modules</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="modules" class="iq-submenu collapse" data-parent="#modules">
                                <li class="{{ request()->routeIs('admin.module.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.module.index') }}">
                                        <i class="las la-minus"></i><span>Lister les modules</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.module.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.module.create') }}">
                                        <i class="las la-minus"></i><span>Ajouter un module</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ request()->routeIs('admin.company.*') ? 'active' : '' }}">
                            <a href="#companies" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <i class="ri-building-fill"></i>
                                <span class="ml-4">Sociétés</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="companies" class="iq-submenu collapse" data-parent="#companies">
                                <li class="{{ request()->routeIs('admin.company.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.company.index') }}">
                                        <i class="las la-minus"></i><span>Lister les sociétés</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.company.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.company.create') }}">
                                        <i class="las la-minus"></i><span>Ajouter une société</span>
                                    </a>
                                </li>
                            </ul>
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
                        <li class="{{ request()->routeIs('admin.qnaans-module.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.qnaans-module.index') }}">
                                <i class="ri-question-fill"></i>
                                <span class="ml-4">Questions</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.examen.*') ? 'active' : '' }}">
                            <a href="#examens" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <i class="ri-honour-fill"></i>
                                <span class="ml-4">Examens</span>
                                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                            </a>
                            <ul id="examens" class="iq-submenu collapse" data-parent="#examens">
                                <li class="{{ request()->routeIs('admin.examen.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.examen.index') }}">
                                        <i class="las la-minus"></i><span>Lister les examens</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('admin.examen.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.examen.create') }}">
                                        <i class="las la-minus"></i><span>Ajouter un examen</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ request()->routeIs('admin.certificate*') ? 'active' : '' }}">
                            <a href="{{ route('admin.certificate') }}">
                                <i class="ri-star-fill"></i>
                                <span class="ml-4">Certificats</span>
                            </a>
                        </li>


                    @endif

                    @if (auth()->guard('student')->user())
                        <li class="{{ request()->routeIs('student.frontendCourse') ? 'active' : '' }}">
                            <a href="{{ url('cours/' . $course->copy_link) }}" class="mr-2">
                                <i class="ri-book-open-fill"></i>
                                <span class="ml-2">{{ $course->name }}</span>
                                <i class="ri-alert-fill ml-2"></i>
                            </a>

                        </li>
                        @foreach ($course->modulesCourses as $moduleCourse)
                            @if (\App\Models\StudentModule::where([['module_id', '<', $moduleCourse->id], ['student_id', '=', auth()->id()]])->where('is_completed', '=', 0)->orderBy('module_id', 'desc')->first())
                                <li class="{{ request('module_id') == $moduleCourse->id ? 'active' : '' }}">
                                    <a href="#" class="svg-icon btn-module-disabled">
                                        <i class="ml-2 ri-sound-module-fill"></i>
                                        <span class="ml-4">{{ $moduleCourse->name }}</span>
                                        <i class="ri-alert-fill ml-2"></i>
                                    </a>

                                </li>
                            @else
                                <li class="{{ request('module_id') == $moduleCourse->id ? 'active' : '' }}">
                                    <a href="{{ route('student.frontendModule', ['copy_link' => $course->copy_link, 'module_id' => $moduleCourse->id]) }}"
                                        class="svg-icon">
                                        <i class="ml-2 ri-sound-module-fill"></i>
                                        <span class="ml-4">{{ $moduleCourse->name }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        @php
                            $count_modules = \App\Models\StudentModule::select('student_module.*')
                                ->join('modules', 'student_module.module_id', 'modules.id')
                                ->join('courses', 'modules.course_id', 'courses.id')
                                ->where([
                                    'student_module.student_id' => Auth::id(),
                                    'courses.copy_link' => $course->copy_link,
                                ])
                                ->count();

                            $completed_modules = \App\Models\StudentModule::select('student_module.*')
                                ->join('modules', 'student_module.module_id', 'modules.id')
                                ->join('courses', 'modules.course_id', 'courses.id')
                                ->where([
                                    'student_module.student_id' => Auth::id(),
                                    'student_module.is_completed' => 1,
                                    'courses.copy_link' => $course->copy_link,
                                ])
                                ->count();
                        @endphp
                        @if ($count_modules == $completed_modules)
                            <li class="{{ request()->routeIs('student.examen') ? 'active' : '' }}">
                                <a href="{{ route('student.examen', $course->copy_link) }}" class="svg-icon">
                                    <i class="ml-2 ri-honour-fill"></i>
                                    <span class="ml-4">Passer l'examen</span>
                                </a>
                            </li>
                        @endif
                    @endif

                @endauth
            </ul>
        </nav>
        @if (auth()->guard('student')->user())
            @isset($completion_percentage)
                <div id="sidebar-bottom" class="position-relative sidebar-bottom">
                    <div class="card border-none mb-0 shadow-none">
                        <div class="card-body p-0">
                            <div class="sidebarbottom-content">
                                <h5 class="mb-3">Taux de complétion des modules</h5>
                                <div id="circle-progress-6"
                                    class="sidebar-circle circle-progress circle-progress-primary mb-4" data-min-value="0"
                                    data-max-value="100" data-value="{{ $completion_percentage }}" data-type="percent"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    aria-valuenow="{{ $completion_percentage }}"><svg version="1.1" width="100"
                                        height="100" viewBox="0 0 100 100" class="circle-progress">
                                        <circle class="circle-progress-circle" cx="50" cy="50" r="47"
                                            fill="none" stroke="#ddd" stroke-width="8"></circle>
                                        <path d="M 50 3 A 47 47 0 1 1 35.47620126437745 94.69965626587222"
                                            class="circle-progress-value" fill="none" stroke="#00E699"
                                            stroke-width="8"></path><text class="circle-progress-text" x="50" y="50"
                                            font="16px Arial, sans-serif" text-anchor="middle" fill="#999"
                                            dy="0.4em">{{ $completion_percentage }}%</text>
                                    </svg></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        @endif
        <div class="pt-5 pb-2"></div>
    </div>
</div>
