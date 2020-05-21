@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="panel panel-body">
        <div class="row panel-body panel-shadow">
            @foreach ($number_blocks as $block)
            <div class="col-md-6">
                <div class="info-box">
                        <span class="info-box-icon bg-info"
                              style="display:flex; flex-direction: column; justify-content: center;">
                            <i class="fa  fa-chart-line" style="color:white"></i>
                        </span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ $block['title'] }}</span>
                        <span class="info-box-number">{{ $block['number'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row panel-shadow panel-body">
            @foreach ($list_blocks as $block)
                <div class="col-md-12 mx-auto card-body">
                    <h4 class="text-center">{{ $block['title'] }}</h3>
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Last login at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($block['entries'] as $entry)
                            <tr>
                                <td>{{ $entry->name }}</td>
                                <td>{{ $entry->email }}</td>
                                <td>{{ $entry->last_login_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">{{ __('No entries found') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <hr style="height:20px black">
                </div>

            @endforeach
        </div>

        <div class="row panel-shadow">
            <div class="{{ $chart->options['column_class'] }}">
                <h3 style="text-align: center">{!! $chart->options['chart_title'] !!}</h3>
                {!! $chart->renderHtml() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    {!! $chart->renderJs() !!}
@endsection
