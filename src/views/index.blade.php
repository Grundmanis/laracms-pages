@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.pages')] )

@section('content')
    <div class="form-group">
        <a class="btn btn-success" href="{{ route('laracms.pages.create') }}">{{ __('laracms::admin.create') }}</a>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('laracms::admin.menu.pages') }}</h4>
                    </div>
                    <div class="card-body">
                        @if (count($pages))
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('laracms::admin.url') }}</th>
                                        <th>{{ __('laracms::admin.layout') }}</th>
                                        <th>{{ __('laracms::admin.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pages as $sitePage)
                                        <tr>
                                            <td>{{ $sitePage->id }}</td>
                                            <td>
                                                <a href="{{ $sitePage->getLink() }}">
                                                    {{ $sitePage->url }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $sitePage->layout }}
                                            </td>
                                            <td class="text-right">
                                                <a title="{{ __('laracms::admin.edit') }}"
                                                   href="{{ route('laracms.pages.edit', $sitePage->id) }}"
                                                   rel="tooltip" class="btn btn-success btn-icon btn-sm ">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="{{ __('laracms::admin.delete') }}"
                                                   onclick="return confirmDelete('{{ route('laracms.pages.destroy', $sitePage->id) }}');"
                                                   href="javascript:void(0);" type="button"
                                                   rel="tooltip" class="btn btn-danger btn-icon btn-sm ">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $pages->links() }}
                            </div>
                        @else
                            <blockquote>
                                <p class="blockquote blockquote-primary">
                                    {{ __('laracms::admin.no_records') }}
                                </p>
                            </blockquote>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
