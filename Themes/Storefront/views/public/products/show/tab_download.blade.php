@if ($product->hasDownloadsAttribute())
    <div id="download" class="tab-pane download" :class="{ active: activeTab === 'download' }">
        {{--        <div class="download-inner">--}}
        {{--            <div class="download-row">--}}
        {{--                <div class="title">--}}
        {{--                    <h5>{{ trans('storefront::product.downloadFiles') }}</h5>--}}
        {{--                </div>--}}

        {{--                <ul class="list-inline specification-list">--}}
        {{--                    @foreach($downloadFiles as $downloadFile)--}}

        {{--                        <li><a href="{{$downloadFile->path}}" target="_blank">{{$downloadFile->filename}}</a></li>--}}
        {{--                    @endforeach--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="table-responsive">
            <table class="table table-borderless my-downloads-table">
                <thead>
                <tr>
                    <th>{{ trans('storefront::account.downloads.filename') }}</th>
                    <th>{{ trans('storefront::account.action') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($downloadFiles as $download)
                    <tr>
                        <td>
                            {{ $download->filename }}
                        </td>

                        <td>
                            <a href="{{$download->path}}"
                               class="btn btn-download" target="_blank">
                                <i class="las la-cloud-download-alt"></i>
                                {{ trans('storefront::account.downloads.download') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
