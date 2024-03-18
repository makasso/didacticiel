@extends('layouts.app')
@section('title') Modifier votre profile @endsection
@section('content')
<div class="container-fluid">
    <div class="row">
       <div class="col-lg-12">
          <div class="iq-edit-list-data">
             <div class="tab-content">
                <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                   <div class="card">
                      <div class="card-header d-flex justify-content-between">
                         <div class="iq-header-title">
                            <h4 class="card-title">Modifier votre profile</h4>
                         </div>
                      </div>
                      <div class="card-body">
                         <form method="POST" action="">
                            @csrf
                            @method('PUT')
                            <div class="row align-items-center">
                               <div class="form-group col-sm-6">
                                  <label for="name">Nom:</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                                  @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                               </div>
                               <div class="form-group col-sm-6">
                                  <label for="email">Email:</label>
                                  <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                                  @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                               </div>
                               
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                         </form>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection