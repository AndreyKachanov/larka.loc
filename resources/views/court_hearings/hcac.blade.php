@extends('layouts.app_court_hearings')

@section('content')
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <chartline-component
                :fields="{{ json_encode($fields) }}"
                :items="{{ json_encode($items) }}"
                route_room_number="{{route('change_room_number')}}"
            >
            </chartline-component>
        </div>
    </div>
@endsection
