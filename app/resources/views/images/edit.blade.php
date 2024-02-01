@extends('layouts.app')
@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>modify image</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="">
          <!-- general form elements -->
          <div class="card card-info">
            <div class="card-header">
            <h3 class="card-title">image</h3>
            </div>
            <!-- .card-header -->
            <!-- form start -->
            <form method="post" action="{{route('images.update', $image->id)}}">
              @csrf 
              @method("PUT")
              <div class="card-body">
              <input type="hidden" name="presentation_id" value="{{$image->presentation_id}}">
                <div class="form-group">
                  <label for="title">le nom de l'image</label>
                  <input type="text" class="form-control" value="{{ $image->name }}" name="name" id="image" placeholder="entre le nom image">
                  <div style="color:red">
                      @error("title")
                      {{$message}}
                      @enderror
                      </div>
                </div>

                <div class="form-group">
                  <label for="description">url</label>
                  <input type="text" class="form-control" value="{{ $image->url }}" id="url" name="url" placeholder="Entre l'url">
                  <div style="color:red">
                      @error("description")
                      {{$message}}
                      @enderror
                      </div>                   
                </div>

                <div class="form-group">
                  <label for="description">reference</label>
                  <input type="text" class="form-control" value="{{ $image->reference }}" id="url" name="reference" placeholder="Entre reference">
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
                <button type="submit" class="btn btn-info">modifie image</button>
         
                  <a href="{{route('images.index')}}" type="submit" class="btn btn-secondary">annuler</a>

              </div>
            </form>
          </div>
      </div>
  </div>
  </section>

@endsection
