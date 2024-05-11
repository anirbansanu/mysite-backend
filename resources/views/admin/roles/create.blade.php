@extends('admin.layouts.app')
@section('title')
    @if($role->exists)
        Edit Role
    @else
        Add Role
    @endif
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

                                    <x-tabs.nav-item route="roles.index" icon="fas fa-list-alt ">Roles</x-tabs.nav-item>
                                    <x-tabs.nav-item route="permissions.index" icon="fas fa-list-alt ">Permissions</x-tabs.nav-item>


                                    <x-tabs.nav-item route="roles.create" icon="fas fa-plus-square">Create Role</x-tabs.nav-item>
                                    <x-tabs.nav-item route="permissions.create" icon="fas fa-plus-square">Create Permission</x-tabs.nav-item>
                                    @if($role->exists)
                                        <x-tabs.nav-item route="roles.edit" routeParams="{{$role->id}}" icon="fas fa-edit">Edit Role</x-tabs.nav-item>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ $role->exists ? route('roles.update', $role->id) : route('roles.store') }}">
                                    @csrf
                                    @if($role->exists)
                                        @method('put')
                                    @endif
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="name" class="control-label">{{ __('Name') }}
                                                        <span class="text-danger">*</span></label>
                                                    <x-form.input type="text" name="name"
                                                                value="{{ $role->exists ? $role->name : old('name') }}"/>
                                                    <x-form.error key="name"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="guard_name" class="control-label">{{ __('Gaurd Name') }}
                                                        <span class="text-danger">*</span></label>
                                                    <x-form.input type="text" name="guard_name"
                                                                value="{{ $role->exists ? $role->guard_name : old('guard_name') }}"/>
                                                    <x-form.error key="guard_name"/>
                                                </div>
                                                <div class="form-group">
                                                    <x-form.submit-and-cancel url="{{  url()->previous() }}"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                @foreach($permissions as $key => $value)
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input check-all" id="{{ $key }}" value="{{ $key }}">
                                                            <label class="form-check-label text-primary" for="{{ $key }}">{{ __(ucfirst($key)) }}</label>
                                                        </div>
                                                        <hr class="mt-1">
                                                        <div class="row">
                                                            @foreach($value as $g)
                                                                <div class="col-md-3">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <?php
                                                                            $checked = false;
                                                                            if (isset($rolePermissions)) {
                                                                                if (in_array($g['name'] , $rolePermissions)) $checked = true;
                                                                            }
                                                                            ?>
                                                                            <div class="form-check">
                                                                                <input type="checkbox" name="perm[]" class="form-check-input {{ $key }}" id="p-{{ $g->id }}" value="{{ $g->id }}" @if($checked) checked @endif>
                                                                                <label class="form-check-label" for="p-{{ $g->id }}">{{ __($g->name) }}</label>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>


                        </div>
                    </div>

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
        $(function () {
            $('.check-all').change(function () {
                var me = $(this);
                if(me.prop('checked')) {
                    $('.' + me.val()).prop('checked', true);
                } else {
                    $('.' + me.val()).prop('checked', false);
                }
            });
        });

        $('#parent_id').select2({
            width: '100%',
            theme: 'bootstrap4',
            ajax: {
                url: "{{route('categories.json')}}",
                type: "POST",
                dataType: 'json',
                delay: 250,

                data: function(params) {
                    console.log(params);
                    return {
                        q: params.term,
                        page: params.page || 1
                    };
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processResults: function(data) {
                    return {
                        results: data.data.map(function(category) {
                            return {
                                id: category.id,
                                text: category.name
                            };
                        }),
                        pagination: {
                            more: data.current_page < data.last_page
                        }
                    };
                },
                cache: true
            },
            placeholder : 'Select a parent category',

        });
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
