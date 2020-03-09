@extends('layouts.app_court_hearings')

@section('content')

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            123
            <chartline-component
                :data="{{ json_encode($data) }}"
            >
            </chartline-component>
        </div>
    </div>


@endsection
