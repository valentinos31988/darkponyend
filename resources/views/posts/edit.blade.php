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
                        <h3 class="card-title">Edit Post</h3>
                        <div class="card-tools">
                            <form action="{{ route('posts.destroy',$post->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label >Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $post->title}}">
                            </div>
                            <div class="form-group">
                                <label >Type</label>
                                <input type="text" name="type" class="form-control"  >
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea name="wysiwyg_text" id="editor" value="{{ $post->wysiwyg_text}}">This is some sample content.</textarea>
                            </div>
                            <div class="form-group">
                                <label >Image input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input">
                                        <label class="custom-file-label" for="exampleInputFile" >Choose Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="custom-select my-1 mr-sm-2" name="status" value="{{ $post->status}}">
                                    <option value="1" <?php if($post->status==1){ ?> selected <?php } ?>>Active</option>
                                    <option value="0" <?php if($post->status==0){ ?> selected <?php } ?>>Inactive</option>
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