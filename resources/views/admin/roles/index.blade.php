@extends('admin.layouts.app')
@section('title')
    Roles

@endsection
@section('css')

<style>
    .sortable-link{
        cursor: pointer !important;
        color: black;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper pt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <div class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                                <x-tabs.nav-item route="roles.index" icon="fas fa-list-alt ">Roles</x-tabs.nav-item>
                                <x-tabs.nav-item route="permissions.index" icon="fas fa-list-alt ">Permissions</x-tabs.nav-item>
                                <x-tabs.nav-item route="roles.create" icon="fas fa-plus-square">Create Role</x-tabs.nav-item>
                                <x-tabs.nav-item route="permissions.create" icon="fas fa-plus-square">Create Permission</x-tabs.nav-item>


                            </div>

                        </div>
                        <div class="card-body">
                            <x-datatable
                                url="{{ route('roles.index') }}"
                                :thead="[['data'=>'id','title'=>'Id'],['data'=>'name','title'=>'Name'],
                                        // ['data'=>'permissions','title'=>'Permissions']
                                        ]"
                                :tbody="$roles"
                                :actions="[['route'=>'roles.edit','data'=>'edit','title'=>'Edit','btn-class'=>'btn-info','icon'=>'fas fa-pencil-alt'],
                                ['route'=>'roles.destroy','data'=>'delete','title'=>'Delete','btn-class'=>'btn-danger btn-delete','icon'=>'fas fa-trash',

                                ]]"
                            />
                        </div>
                        @push('script')
                            <script src="{{ asset('js/role.js') }}"></script>
                        @endpush
                    </div><!-- End div.Card -->
                </div><!-- End div.col -->
            </div><!-- End div.row -->
        </div><!-- End div.container-fluid -->
    </section><!-- End section -->
</div><!-- End div.content-wrapper -->
@endsection
@section('js')


<script >
    $(document).ready(function(){
        $(document).on('change', '.onChangeStatus', function() {
            var id = $(this).attr("data-id");
            var route = $(this).attr("data-route");
            $.ajax({
                type: "POST",
                url: route,
                data: {
                    "_token": '{{ csrf_token() }}',
                    "is_active": $(this).val(),
                },
                success: function(data) {
                    toastr.success(data.msg);
                },
                error:function(data){
                    toastr.error(data.msg);
                }
            })
        });
        // $(document).on('change', '.delete', function() {
        //     var id = $(this).attr("data-id");
        //     var route = $(this).attr("data-route");
        //     $.ajax({
        //         type: "POST",
        //         url: route,
        //         data: {
        //             "_token": '{{ csrf_token() }}',
        //             "is_active": $(this).val(),
        //         },
        //         success: function(data) {
        //             toastr.success(data.msg);
        //         },
        //         error:function(data){
        //             toastr.error(data.msg);
        //         }
        //     })
        // });
        

    });
</script>
@endsection


