@props([
    'url' => '',
    'thead' => [],
    'tbody' => [],
    'actions' => []
])

<table class="table table-hover text-nowrap border" id="index-dataTable" data-url="{{ $url }}" style="width: 100%">
    <thead class="border-top">
    <tr>
        @foreach($thead as $_index=>$th)
            @if (isset($th['sortable']) && $th['sortable'] == true)
                <th href="{{ url($url, ['query' => $query, 'sort_by' => $th['data'], 'sort_order' => ($sort_by == $th['data'] && $sort_order == 'asc') ? 'desc' : 'asc']) }}">{{ $th['title'] }}</th>
            @else
                <th>{{ $th['title'] ?? ""}}</th>
            @endif

        @endforeach
        @if (count($actions)>0)
            <th>Actions</th>
        @endif
    </tr>
    </thead>
    <tbody>
        @foreach($tbody as $tbody_index=>$_item)
            <tr data-index="{{$tbody_index}}">
                @foreach($thead as $_index=>$th)
                    <td data-th="{{$th['title']??""}}">{{$_item[$th['data']]??""}}</td>
                @endforeach

                <td data-th="{{$th['title']??""}}">
                    @foreach($actions as $action)
                        <a href="{{ route($action['route'], $_item['id']) }}" class="btn {{$action['btn-class']}} btn-sm"

                        @if ($action['data']='delete')
                            data-alert-title="{{ __('Delete '.$_item['name']??"") }}"
                            data-confirm="{{ __('Confirm') }}"
                            data-cancel="{{ __('Cancel') }}"
                            title="{{ __('Delete') }}"
                        @endif
                        >
                            <i class="{{$action['icon']}}">
                            </i>
                            {{$action['title']??""}}
                        </a>

                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
