@extends('admin.layouts.app')
@section('title')
     Project List

@endsection
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .my-dropzone {
        position: relative;
        width: 100%;
        height: 200px; /* Set an appropriate height */
        border: 2px dashed #ddd;
        background: white;
        padding: 20px;
        box-sizing: border-box;
        color: #eae9e9;
    }

</style>
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endsection
@section('content')
<div class="content-wrapper pt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">

                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <x-tabs.nav-item route="admin.projects.index" icon="fas fa-list-alt ">Project List</x-tabs.nav-item>
                                <x-tabs.nav-item route="admin.projects.create" icon="fas fa-plus-square">Add Project</x-tabs.nav-item>
                                <x-tabs.nav-item route="admin.projects.edit" route-params="{{$project->id}}" icon="fas fa-list-alt ">Edit Project</x-tabs.nav-item>


                            </ul>
                        </div>
                        <div class="card-body ">
                            <!-- This HTML and Blade code for category edit form here -->
                            <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" class="form-control" value="{{ implode(', ', $project->type) }}" name="type" id="type" placeholder="Enter type">
                                        @error('type')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" value="{{ $project->title }}" name="title" id="title" placeholder="Enter title">
                                        @error('title')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="badges">Badges</label>
                                        <input type="text" class="form-control" value="{{ implode(', ', $project->badges) }}" name="badges" id="badges" placeholder="Enter badges">
                                        @error('badges')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="project_link">Project Link</label>
                                        <input type="text" class="form-control" value="{{ $project->project_link }}" name="project_link" id="project_link" placeholder="Enter project link">
                                        @error('project_link')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="github_link">GitHub Link</label>
                                        <input type="text" class="form-control" value="{{ $project->github_link }}" name="github_link" id="github_link" placeholder="Enter GitHub link">
                                        @error('github_link')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        @if($project->image)
                                            <img src="{{ asset('storage/' . $project->image) }}" alt="Project Image" style="max-width: 200px; height: auto;">
                                        @else
                                        <input type="file" class="form-control-file" name="image" id="image">
                                        @error('image')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea name="desc" class="form-control" id="desc">{{ $project->desc }}</textarea>
                                        @error('desc')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer w-100 d-flex justify-content-end">
                                    <button type="submit" id="updateProject" class="btn btn-primary">Update Project</button>
                                </div>
                            </form>
                        </div> <!-- End div.Card Body -->
                    </div><!-- End div.Card -->
                </div><!-- End div.col -->
            </div><!-- End div.row -->
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        </div><!-- End div.container-fluid -->
    </section><!-- End section -->
</div><!-- End div.content-wrapper -->
@endsection
@section('js')
<script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

<script src="{{asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

<script src="{{asset('admin/plugins/select2/js/select2.min.js')}}"></script>

<script >
    $(document).ready(function(){


    });
    function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '_')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
    }
</script>
<script src="{{asset("admin/plugins/dropzone/dropzone.js")}}"></script>

<script>
    // // Dropzone has been added as a global variable.
    // const dropzone = new Dropzone("div.my-dropzone", {
    //     url: "/file/post",
    //     maxFilesize: 5, // Set maximum file size in megabytes
    //     acceptedFiles: ".png, .jpg, .jpeg, .gif", // Specify allowed file types
    //     addRemoveLinks: true, // Show remove links on each file preview
    //     success: function(file, response) {
    //         // Handle successful file upload
    //         console.log(response);
    //     },
    //     error: function(file, response) {
    //         // Handle errors during file upload
    //         console.log(response);
    //     }
    // });

</script>
@endsection
