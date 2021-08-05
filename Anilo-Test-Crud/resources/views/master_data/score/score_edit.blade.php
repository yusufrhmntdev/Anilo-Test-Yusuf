@extends('layouts.master')
@section('title','laravel')
@section('content')
    
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit Data</h4>
                <a href="{{route('score.index')}}" class="btn btn-warning btn-sm ml-auto" ><i class="fa fa-undo"></i> kembali</a>
              </div>
              <div class="card-body">
                <form action="{{route('score.update',$score->id)}}" method="POST">

                  @csrf
                  @method('patch')
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                      <label @error('student_id')
                                              class="text-danger"
                                          @enderror>Student  @error('student_id')
                                              | {{$message}}
                                          @enderror
                                        </label>
                                      <select name="student_id" id="" class="form-control" required>
                                        @foreach ($student as $data )
                                          <option value="{{$data->id}}"{{$data->id == $score->student_id ? "selected" : null }}>{{$data->id.'-'.$data->name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>
                            <div class="col-md-4 col-md-offset-4">
                              <div class="form-group">
                                    <label @error('subject_id')
                                            class="text-danger"
                                        @enderror>Subject  @error('subject_id')
                                            | {{$message}}
                                        @enderror
                                      </label>
                                    <select name="subject_id" id="" class="form-control" required>
                                      @foreach ($subject as $data )
                                        <option value="{{$data->id}}"{{$data->id == $score->subject_id ? "selected" : null }}>{{$data->id.'-'.$data->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                          </div>
                          <div class="col-md-4 col-md-offset-4">
                            <div class="form-group">
                                  <label @error('score')
                                          class="text-danger"
                                      @enderror>Score  @error('score')
                                          | {{$message}}
                                      @enderror
                                    </label>
                                    <input type="number" class="form-control" name="score" @if (old('score'))
                                    value="{{old('score')}}"
                                    @else
                                    value="{{$score->score}}"
                                    @endif  placeholder="Example : 80" required>
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
    
