@extends('layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">tout les images</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header   -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

        @if(session('success'))
         <div class="alert alert-success">
        {{ session('success') }}
         </div>
           @endif  

           @if(session('error'))
           <div class="alert alert-danger">
          {{ session('error') }}
           </div>
           
             @endif 

             <a  class="btn btn-primary mb-4"  href="{{ route('images.create') }}">
                creé image <i class="fas fa-plus"></i>
             </a>

            <!-- Small boxes (Stat box) -->
            <div class="card">
                <div class="card-header">

                  
                  {{-- search input  --}}
                  <div class=""> <!-- Use d-flex and justify-content-between classes -->
                    <div class="float-left"> <!-- Set width for select element -->
                        <select id="filter_by_projects" class="js-example-basic-single" style="width:250px;" name="project">
                            <option value="">tous projets</option>
                            @foreach($presentations as $presentation)
                                <option value="{{ $presentation->title }}">{{ $presentation->title }}</option>
                            @endforeach
                        </select>                   
                    </div>
                    <div class="input-group input-group-sm float-right search-container" style="width: 190px;">
                        <!-- SEARCH input -->
                        <input style="height: 35px;" type="text" name="search" id="searchInput" class="form-control" placeholder="search .. ">            
                    </div>
                </div>
                
                </div>
            <div id="resulthtml">
                    @include('images.imagesTable')
              </div>
            </div>
            </div>

    </section>
    <!-- /.content -->




@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
// In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});


$(document).ready(function() {
    $(document).on('click', '.delete-image', function () {
        var imageid = $(this).data('image-id');
        var imagename = $(this).data('image-name'); 

        var deleteUrl = "{{ route('images.destroy', ':id') }}";
        deleteUrl = deleteUrl.replace(':id', imageid);
        console.log(deleteUrl);

      
            $('#modal-default .modal-body').html(`
            <div>
            If you are sure you want to delete this task
            <strong>"${imagename}"</strong>
           click Delete to continue
            </div>
            `);

        // Update form action URL
        $('#deleteForm').attr('action', deleteUrl);
    });
});



    const tableContainer = $('#table-container');
    var searchQuery = '';
    const search = (query = '', page = 1) => {
        $.ajax('{{ route('images.index') }}', {
            data: {
                query: query,
                page: page
            },
            success: (data) => updateTable(data)
        });
        history.pushState(null, null, '?query=' + query + '&page=' + page);
    };



const updateTable = (html) => {
    try {
        $('#resulthtml').html(html); // Target the tbody element and update its content
        updatePaginationLinks();
        console.log(html);
    } catch (error) {
        // console.error('Error updating table:', error);
    }
};


const updatePaginationLinks = () => {
    // console.log('updatePaginationLinks');

            $('button[page-number]').each(function() {
                $(this).on('click', function() {
                // console.log('click');

                    pageNumber = $(this).attr('page-number')
                    search(searchQuery, pageNumber)
                })
            })
        }
     

        
    $(document).ready(() => {
    // console.log('hey')
  
        $('#searchInput').on('input', function() {
            searchQuery = $('#searchInput').val();
            // searchQuery = $(this).val();
    console.log(searchQuery)

            search(searchQuery);
        });

        updatePaginationLinks();
        
    });

    $(document).ready(() => {
    // console.log('hey')
        $('#filter_by_projects').on('input', function() {
            searchQuery = $('#filter_by_projects').val();
            // searchQuery = $(this).val();
    console.log(searchQuery)
            search(searchQuery);
        });

        updatePaginationLinks();
        
    });
  
</script>