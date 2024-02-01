@extends('layouts.app')
@section('content')

   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>cree un task</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="">
          <!-- general form elements -->
          <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title"> cree un image </h3>
            </div>
            <!-- .card-header -->
            <!-- form start -->
            <form method="post" action="{{route('images.store')}}">
              @csrf
              <div class="card-body">
                  
                <div class="form-group">
                  <label for="title">image name</label>
                  <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Entre Tache name">
                  <div style="color:red">
                      @error("name")
                      {{$message}}
                      @enderror
                      </div>
                </div>

                <div class="form-group">
                  <label for="description">l'url</label>
                  <input type="text" class="form-control" value="{{ old('url') }}" id="url" name="url" placeholder="entre la url">
                  <div style="color:red">
                      @error("url")
                      {{$message}}
                      @enderror
                      </div>                   
                </div>

                <div class="form-group">
                    <label for="description">reference</label>
                    <input type="text" class="form-control" value="{{ old('reference') }}" id="url" name="reference" placeholder="entre la reference">
                    <div style="color:red">
                        @error("reference")
                        {{$message}}
                        @enderror
                        </div>                   
                  </div>
             
           
             <div class="form-group">
                <label for="description">presentation</label>

                <select id="filter_by_projects" class="form-control" name="presentation_id">
                    <option value="">tous presentations</option>
                    @foreach($presentations as $presentation)
                        <option value="{{ $presentation->id }}">{{ $presentation->title }}</option>
                    @endforeach
                </select>    

             </div>
      
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-success">cree image</button>
         
                  <a href="{{route('images.index')}}" type="submit" class="btn btn-secondary">annuler</a>

              </div>
            </form>
          </div>
      </div>
  </div>
  </section>

@endsection
