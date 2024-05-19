<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                <i class="ri-menu-line wrapper-menu"></i>
                <a href="../backend/index.html" class="header-logo">
                    <h4 class="logo-title text-uppercase">Didacticiel</h4>

                </a>
            </div>
            <div class="navbar-breadcrumb">
                <h5>@yield('title')</h5>
            </div>
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list align-items-center">
                        <li class="nav-item nav-icon dropdown caption-content py-2">
                            <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center"
                                id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img src=" {{ asset('assets/images/user/user-2.jpg') }}"
                                    class="img-fluid rounded-circle" alt="user">
                                <div class="caption ml-3">
                                    @auth
                                        <h6 class="mb-0 line-height">{{ auth()->user()->name }}
                                            {{ isset(auth()->user()->role_as) ? (auth()->user()->role_as == '1' ? '(Administrateur)' : '(Professeur)') : '(Etudiant)' }}<i
                                                class="las la-angle-down ml-2"></i></h6>
                                    @endauth
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right border-none"
                                aria-labelledby="dropdownMenuButton">

                                @if (!auth()->guard('student')->user())
                                    <li class="dropdown-item d-flex svg-icon">
                                        <svg class="svg-icon mr-0 text-primary" id="h-02-p" width="20"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        @auth
                                            @if (auth()->user()->role_as == 0)
                                                <a href="{{ route('profile.prof.edit') }}">Modifier Profile</a>
                                            @else
                                                <a href="{{ route('admin.profile.edit') }}">Modifier Profile</a>
                                            @endif
                                        @endauth
                                    </li>
                                    <li class="dropdown-item d-flex svg-icon">
                                        <svg class="svg-icon mr-0 text-primary" id="h-02-p" width="20"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        @auth
                                            @if (auth()->user()->role_as == 0)
                                                <a href="{{ route('profile.prof.password') }}">Modifier Mot de passe</a>
                                            @else
                                                <a href="{{ route('admin.profile.password') }}">Modifier Mot de passe</a>
                                            @endif
                                        @endauth
                                    </li>

                                @else
                                <li class="dropdown-item d-flex svg-icon">
                                    <svg class="svg-icon mr-0 text-primary" id="h-02-p" width="20"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    @auth
                                        <a href="#" data-toggle="modal"
                                        data-target="#updateStudentProfile">Modifier Profile</a>
                                    @endauth
                                </li>
                                    
                                @endif

                                <li class="dropdown-item  d-flex svg-icon border-top">
                                    <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="modal fade" id="updateStudentProfile" tabindex="-1" aria-labelledby="updateStudentProfile"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form method="POST" action="{{ route('student.profile.update')}}">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="form-group col-sm-6">
                               <label for="name">Nom:</label>
                               <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                               <div class="pt-2 pb-2"></div>
                               @error('name')
                                 <small class="text-danger">{{$message}}</small>
                              @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
        </div>
    </div>
</div>
