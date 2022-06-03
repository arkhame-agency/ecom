@extends('report::admin.reports.layout')

@section('filters')
    @include('report::admin.reports.filters.from')
    @include('report::admin.reports.filters.to')
    @include('report::admin.reports.filters.status')
    @include('report::admin.reports.filters.group')

    <div class="form-group">
        <label for="product">{{ trans('report::admin.filters.brand') }}</label>
        <input type="text" name="product" class="form-control" id="product" value="{{ $request->brand }}">
    </div>
@endsection

@section('report_result')
    <h3 class="tab-content-title">
        {{ trans('report::admin.filters.report_types.products_purchase_report') }}
    </h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('report::admin.table.date') }}</th>
                    <th>{{ trans('report::admin.table.brand') }}</th>
                    <th>{{ trans('report::admin.table.qty') }}</th>
                    <th>{{ trans('report::admin.table.total') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($report as $brand)
                    <tr>
                        <td>{{ $brand->start_date->toFormattedDateString() }} - {{ $brand->end_date->toFormattedDateString() }}</td>

                        <td>
                                {{ $brand->name }}
                        </td>

                        <td>{{ $brand->qty }}</td>
                        <td>{{ $brand->total->format() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="8">{{ trans('report::admin.no_data') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pull-right">
            {!! $report->links() !!}
        </div>
    </div>
@endsection
