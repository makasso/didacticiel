@extends('layouts.app')
@section('title')
    Tableau de Bord
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="top-block d-flex align-items-center justify-content-between">
                            <h5>Cours</h5>
                            <span class="badge badge-secondary">Stats</span>
                        </div>
                        <h3><span class="counter">{{ $courses }}</span></h3>
                        
                        <div class="iq-progress-bar bg-secondary-light mt-2">
                            <span class="bg-secondary iq-progress progress-1" data-percent="100"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="top-block d-flex align-items-center justify-content-between">
                            <h5>Examens</h5>
                            <span class="badge badge-danger">Stats</span>
                        </div>
                        <h3><span class="counter">{{ $examens }}</span></h3>
                        
                        <div class="iq-progress-bar bg-danger-light mt-2">
                            <span class="bg-danger iq-progress progress-1" data-percent="100"></span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6 col-lg-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="top-block d-flex align-items-center justify-content-between">
                            <h5>Etudiants</h5>
                            <span class="badge badge-primary">Stats</span>
                        </div>
                        <h3><span class="counter">{{ $etudiants }}</span></h3>
                        
                        <div class="iq-progress-bar bg-danger-light mt-2">
                            <span class="bg-primary iq-progress progress-1" data-percent="100"></span>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-8">
                <div class="card-transparent card-block card-stretch card-height">
                    <div class="card-body p-0">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">
                                        Statistiques
                                    </h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-inline p-0 mb-0">
                                    <li class="mb-1">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">
                                                    Catégories
                                                </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="iq-progress-bar bg-secondary-light">
                                                        <span class="bg-secondary iq-progress progress-1"
                                                            data-percent="65"></span>
                                                    </div>
                                                    <span class="ml-3">65%</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="iq-media-group text-sm-right">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-1">
                                        <div class="d-flex align-items-center justify-content-between row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">
                                                    Modules
                                                </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="iq-progress-bar bg-primary-light">
                                                        <span class="bg-primary iq-progress progress-1"
                                                            data-percent="59"></span>
                                                    </div>
                                                    <span class="ml-3">59%</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="iq-media-group text-sm-right">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center justify-content-between row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">
                                                    Cours
                                                </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="iq-progress-bar bg-warning-light">
                                                        <span class="bg-warning iq-progress progress-1"
                                                            data-percent="78"></span>
                                                    </div>
                                                    <span class="ml-3">78%</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="iq-media-group text-sm-right">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="card border-bottom pb-2 shadow-none">
                            <div class="card-body text-center inln-date flet-datepickr">
                                <input type="text" id="inline-date" class="date-input basicFlatpickr d-none"
                                    readonly="readonly" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
@endsection
