@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('import::update_prices.title'))

    <li class="active">{{ trans('import::update_prices.title') }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.update_prices.update') }}" class="form-horizontal">
        @csrf

    	<div class="accordion-content">
    		<div class="accordion-box-content clearfix">
    			<div class="col-md-12">
    				<div class="accordion-box-content">
    					<div class="tab-content clearfix">
    						<div class="tab-pane fade in active">

    							<div class="row">
    							    <div class="col-lg-6 col-md-12">
                                        {{ Form::number('marge', trans('import::update_prices.marge'), $errors, null, ['min' => 0]) }}
                                        {{ Form::select('increase_or_decrease', trans('import::update_prices.increase_or_decrease'), $errors, trans('import::update_prices.select_increase_or_decrease'), null) }}
		    							<div class="form-group">
		    							    <div class="col-md-offset-3 col-md-10">
		    							        <button type="submit" class="btn btn-primary" data-loading>
		    							            {{ trans('import::importer.run') }}
		    							        </button>
		    							    </div>
		    							</div>
    							    </div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </form>
@endsection
