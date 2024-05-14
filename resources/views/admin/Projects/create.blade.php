@extends('admin.layouts.app')
@section('title')
    Add Project
@endsection
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <div class="card-header  p-0 pt-1">
                                <div class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <x-tabs.nav-item route="admin.projects.index" icon="fas fa-list-alt ">Project List</x-tabs.nav-item>
                                    <x-tabs.nav-item route="admin.projects.create" icon="fas fa-plus-square">Add Project</x-tabs.nav-item>
                                </div>
                            </div>
                            <form action="{{route('admin.projects.store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" class="form-control" value="{{ old('type') }}" name="type" id="type" placeholder="Enter type">
                                        @error('type')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" value="{{ old('title') }}" name="title" id="title" placeholder="Enter title">
                                        @error('title')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="badges">Badges</label>
                                        <input type="text" class="form-control" value="{{ old('badges') }}" name="badges" id="badges" placeholder="Enter badges">
                                        @error('badges')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="project_link">Project Link</label>
                                        <input type="text" class="form-control" value="{{ old('project_link') }}" name="project_link" id="project_link" placeholder="Enter project link">
                                        @error('project_link')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="github_link">GitHub Link</label>
                                        <input type="text" class="form-control" value="{{ old('github_link') }}" name="github_link" id="github_link" placeholder="Enter GitHub link">
                                        @error('github_link')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control-file" name="image" id="image">
                                        @error('image')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea name="desc" class="form-control" id="desc">{{ old('desc') }}</textarea>
                                        @error('desc')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer w-100 d-flex justify-content-end">
                                    <button type="submit" id="settingUpdate" class="btn btn-primary">Save Project</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
<script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

<script src="{{asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

<script src="{{asset('admin/plugins/select2/js/select2.min.js')}}"></script>

<script >
    $(document).ready(function(){


        $(document).on('keyup', '#name', (ev) => {
            let nameValue = $('#name').val();
            let slug = slugify(nameValue);
            $('#slug').val(slug);
        });
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
            $(this).on('switchChange.bootstrapSwitch', function(event, state) {
                onSwitchChange(state);
            });
        });
        function onSwitchChange(state) {
            if (state) {
            console.log("Switch is ON",state);
            // Perform actions when switch is ON
            } else {
            console.log("Switch is OFF",state);
            // Perform actions when switch is OFF
            }
        }
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
@endsection
