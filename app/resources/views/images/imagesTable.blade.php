<div class="" id="tablecontainer">
    <div class="card-body p-0 table-data">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>le nom de l'image</th>
                    <th>l'url de image</th>
                    <th>reference</th>

                    <th class="project-actions text-center">Actions</th>        
                </tr>
            </thead>
            <tbody id="tbodyresults">
                @foreach($images as $image)
<tr>
    <td>{{ $image->name }}</td>
    <td>
        @php
            $words = explode(' ', $image->url);
            $shorteneddescription = implode(' ', array_slice($words, 0, 4));
            $remainingWords = count($words) - 4;
        @endphp
    
        {{ $shorteneddescription }} @if ($remainingWords > 0) ... @endif
    </td>
    <td>{{ $image->reference }}</td>   

    <td class="project-actions text-center">
        {{-- edit --}}
        <a class="btn btn-info btn-sm" href="{{route('images.edit', $image->id)}}">
            <i class="fas fa-pencil-alt"></i>    
        </a>
  
    

        <button type="button" class="btn btn-danger delete-image" data-toggle="modal" data-target="#modal-default" data-image-id="{{ $image->id }}" data-image-title="{{ $image->title }}">
            <i class="fa-solid fa-trash"></i>
          </button>
       
              
    </td>
</tr>
@endforeach
            </tbody>
        </table>
    </div>






<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="deleteForm" style="display: inline-block;" action="" method="post">
            @csrf
            @method("DELETE")

            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">est ce que vous etes sur</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
               
                <!-- Modal body content here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">annuler</button>
                <button type="submit" class="btn btn-danger">suprimer</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  


    <div class="card-footer clearfix">
     
            <div class="float-right">
            <div id="paginationContainer">                 
                @if ($images->count() > 0)
                <ul class="pagination m-0">
                    @if ($images->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">«</span>
                        </li>
                    @else
                        <li class="page-item">
                            <button class="page-link" page-number="{{ $images->currentPage() - 1 }}" rel="prev"
                                aria-label="@lang('pagination.previous')">«</button>
                        </li>
                    @endif
        
                    @for ($i = 1; $i <= $images->lastPage(); $i++)
                        @if ($i == $images->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
                        @else
                            <li class="page-item"><button class="page-link" page-number="{{ $i }}">{{ $i }}</button></li>
                        @endif
                    @endfor
        
                    @if ($images->hasMorePages())
                        <li class="page-item">
                            <button class="page-link" page-number="{{ $images->currentPage() + 1 }}" rel="next"
                                aria-label="@lang('pagination.next')">»</button>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">»</span>
                        </li>
                    @endif
                </ul>
            @endif              
            </div>
        </div>                                          

    </div>
</div>