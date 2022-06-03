@extends('report::admin.reports.layout')

@section('filters')
    @include('report::admin.reports.filters.from')
    @include('report::admin.reports.filters.to')
    @include('report::admin.reports.filters.status')
    @include('report::admin.reports.filters.group')

    <div class="form-group">
        <label for="product">{{ trans('report::admin.filters.category') }}</label>
        <input type="text" name="product" class="form-control" id="product" value="{{ $request->category }}">
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
                    <th>{{ trans('report::admin.table.category') }}</th>
                    <th>{{ trans('report::admin.table.qty') }}</th>
                    <th>{{ trans('report::admin.table.total') }}</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($report as $category)
                    <tr>
                        <td>{{ $category->start_date->toFormattedDateString() }} - {{ $category->end_date->toFormattedDateString() }}</td>

                        <td>
                                {{ $category->name }}
                        </td>

                        <td>{{ $category->qty }}</td>
                        <td>{{ $category->total->format() }}</td>
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
