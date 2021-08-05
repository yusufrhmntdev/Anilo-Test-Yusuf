@extends('layouts.master')
@section('title','subject')
@section('content')
    
<div class="section-body">
    @if (session('message')) 
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          {{session('message')}}
        </div>
      </div>
    @endif
        <div class="card">
            <div class="card-header">
                <div class="col-12 col-md-6 col-lg-6">
                    <a href="{{route('subject.create')}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i>Tambah data</a>
                </div>
            </div>
            
            <div class="card-body">
                @if($subject->count() > 0)
                <div class="table-responsive">
                <table class="table table-striped text-center" id="table-1">
                    <thead class="thead-dark">
                    <tr>
                        <th style="display: none"></th>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    

                    
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($subject as $data)
                        <td style="display: none"></td>
                                <td>{{$data->id}}</td>
                                <td>{{$data->name}}</td>
                                
                                <td>
                                    <a href="{{route('subject.edit',$data->id)}}" class="btn btn-icon icon-left btn-primary btn-sm"><i class="far fa-edit"></i>Update</a>
                                    <a href="#" data-id="{{$data->id}}"class="btn btn-icon icon-left btn-danger btn-sm swal-confrim">
                                  
                                        <form action="{{route('subject.destroy',$data->id)}}" id="delete{{$data->id}}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                            <i class="fas fa-times"></i>
                                        Delete</a>
                                    
                                </td>
                           
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                @else 
               <h4 class="text-center"> Data Not Found </h4>
                @endif
                </div>
            </div>
        </div>
</div>
@endsection


@push('page-script')
{{-- @once
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>
@endonce --}}
<script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
<script>
$(".swal-confrim").click(function(e) {
    id = e.target.dataset.id; // ambil targeet id dari element dataset(data-id)
    swal({
        title: 'Are you sure?',
         text: "You won't be able to revert this!",
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
        swal('Success ', {
          icon: 'success',
        });
        $(`#delete${id}`).submit();
        } else {
        swal('not deleted');
        }
      });
  });
  
 </script>



@endpush
    