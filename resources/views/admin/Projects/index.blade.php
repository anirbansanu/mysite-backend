@extends('admin.layouts.app')
@section('title')
     Project List
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
                                <x-tabs.nav-item route="admin.projects.index" icon="fas fa-list-alt ">Project List</x-tabs.nav-item>
                                <x-tabs.nav-item route="admin.projects.create" icon="fas fa-plus-square">Add Project</x-tabs.nav-item>

                            </div>

                        </div>
                        <div class="card-body table-responsive p-0">
                            <div class="row m-0 p-2">

                                <div class="col-sm-12 col-md-6">

                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="d-flex justify-content-end">
                                        <form action="{{ route('admin.projects.index') }}" method="GET">
                                            <div class="input-group input-group-sm" style="width: 250px;">
                                                <input type="text" name="query"
                                                    class="form-control float-right" placeholder="Search by Name, Description" value="{{$search_query ?? '' ?? ''}}">
                                                <input type="hidden" class="d-none" name="sort_by" value="{{$sort_by ?? '' ?? 'updated_at'}}">
                                                <input type="hidden" class="d-none" name="sort_order" value="{{$sort_order ?? 'desc'}}">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <!-- This HTML and Blade code for displaying project list here -->
                            <table class="table table-hover text-nowrap border-top">
                                <thead class="border-top">
                                    <tr>
                                        <th>
                                            SL No.
                                        </th>
                                        <th>
                                            <a class="sortable-link" href="{{ route('admin.projects.index', ['search_query' => $search_query ?? '' , 'sort_by' => 'title', 'sort_order' => ($sort_by ?? ''  == 'title' && $sort_order  == 'asc') ? 'desc' : 'asc']) }}">
                                                Title {!! ($sort_by ?? ''  == 'title') ? ($sort_order  == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>') : '<i class="fas fa-sort"></i>' !!}
                                            </a>
                                        </th>
                                        <th>
                                            Types
                                        </th>
                                        <th>
                                            Badges
                                        </th>
                                        <th>Description</th>
                                        <th>
                                            <a class="sortable-link" href="{{ route('admin.projects.index', ['search_query' => $search_query ?? '' , 'sort_by' => 'updated_at', 'sort_order' => ($sort_by ?? ''  == 'updated_at' && $sort_order  == 'asc') ? 'desc' : 'asc']) }}">
                                                Updated At {!! ($sort_by ?? ''  == 'updated_at') ? ($sort_order  == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>') : '<i class="fas fa-sort"></i>' !!}
                                            </a>
                                        </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                        <tr>
                                            <td>{{$projects->firstItem() + $loop->index}}</td>
                                            <td>{{ $project->title }}</td>
                                            @php
                                                $types = $project->type; // Convert JSON string to PHP array
                                                $badgeColors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'];
                                            @endphp
                                            <td>
                                                @if(is_array($types))
                                                    @foreach($types as $type)
                                                        @php
                                                            $randomColor = $badgeColors[array_rand($badgeColors)]; // Select a random color from $badgeColors
                                                            $colorClass = 'badge badge-' . $randomColor; // Generate the color class
                                                        @endphp
                                                        <span class="{{ $colorClass }}">{{ $type }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $badges = $project->badges; // Convert JSON string to PHP array
                                                @endphp
                                                @if(is_array($badges))
                                                    @foreach($badges as $badge)
                                                        @php
                                                            $randomColor = $badgeColors[array_rand($badgeColors)]; // Select a random color from $badgeColors
                                                            $colorClass = 'badge badge-' . $randomColor; // Generate the color class
                                                        @endphp
                                                        <span class="{{ $colorClass }}">{{ $badge }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($project->desc, 60, '...') }}</td>

                                            <td>{{ $project->updated_at }}</td>
                                            <td>
                                                <x-actions.edit-btn route="admin.projects.edit" label="Edit" :route-params="[$project->id]" />
                                                <x-actions.delete-btn route="admin.projects.destroy" label="Delete" :route-params="[$project->id]" alertTitle="Delete {{$project->name}}"/>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- End table -->
                        </div> <!-- End div.Card Body -->
                        {{$projects->links()}}
                    </div><!-- End div.Card -->
                </div><!-- End div.col -->
            </div><!-- End div.row -->
        </div><!-- End div.container-fluid -->
    </section><!-- End section -->
</div><!-- End div.content-wrapper -->
@endsection
@section('js')
<script src="{{asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
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
    });
</script>
@endsection
