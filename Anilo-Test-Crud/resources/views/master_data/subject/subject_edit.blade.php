@extends('layouts.master')
@section('title','laravel')
@section('content')
    
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit Data</h4>
              </div>
              <div class="card-body">
                <form action="{{route('subject.update',$subject->id)}}" method="POST">
                  @csrf
                  @method('patch')
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                              <label @error('nama_subject')
                                  class="text-danger"
                              @enderror>Name @error('nama_subject')
                                  | {{$message}}
                              @enderror</label>
                              <input type="text" class="form-control" name="nama_subject" required
                              @if (old('nama_subject'))
                                  value="{{old('nama_subject') }}"
                                  @else
                                  value="{{$subject->name}}"
                              @endif 
                              placeholder="Subject Name">
                                </div>
                          </div>
                      </div>
                      <div class="form-group">
                      <button class="btn btn-primary mr-1" type="submit">Submit </button>
                      <button class="btn btn-success" type="reset">Reset </button>
                  </div>
              </form>
      </div>
</div>
@endsection

@push('page-scripts')
    
@endpush
    
