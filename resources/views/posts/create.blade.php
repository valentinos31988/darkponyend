@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Post</h3>
                    </div>
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label >Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label >Type</label>
                                <input type="text" name="type" class="form-control"  >
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea name="wysiwyg_text" id="editor" value="{{ old('wysiwyg_text') }}">This is some sample content.</textarea>
                            </div>
                            <div class="form-group">
                                <label >Image input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" value="{{ old('image') }}">
                                        <label class="custom-file-label" for="exampleInputFile" >Choose Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="custom-select my-1 mr-sm-2" name="status" value="{{ old('status') }}">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- Default box -->
                <!-- /.card -->
            </div>
        </div>
    </div>
    <script>

        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                toolbar: [ 'heading', '|', 'bold', 'italic','|', 'link', 'bulletedList', 'numberedList', 'blockQuote','insertTable','|' , 'undo', 'redo'],

            } )

        .catch( error => {

        } );
    </script>






@endsection