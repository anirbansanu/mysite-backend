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
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" value="{{ old('name') }}"
                                            name="name" id="name" placeholder="Enter name" >
                                            @error('name')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug</label>
                                        <input type="text" class="form-control" value="{{ old('slug') }}"
                                            name="slug" id="slug" placeholder="Auto generated" readonly >
                                            @error('slug')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea name="description" class="form-control" id="description" >{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="parent_id">Parent Project</label>
                                        <select class="form-control" name="parent_id" id="parent_id">
                                            <option value="">Select Parent Project</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_active">Status </label><br>
                                        <input type="checkbox" name="is_active" checked=""
                                                data-bootstrap-switch=""
                                                data-size="large"
                                                data-on-text="Active"
                                                data-off-text="Inactive"
                                                data-handle-width="80px"
                                                data-label-width="25px"
                                                />
                                    @error('is_active')
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
