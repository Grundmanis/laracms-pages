@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.pages')] )

{{--@include('laracms.dashboard::partials.summernote')--}}

@section('content')
    <form method="post">
        {{ csrf_field() }}

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('laracms::admin.menu.pages') }}</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="slug">{{ __('laracms::admin.layout') }}<span>*</span></label>
                    <select class="form-control" name="layout" id="layout">
                        @foreach($layouts as $layout)
                            <option @if(formValue($page ?? null, 'layout') == $layout) selected
                                    @endif value="{{ $layout }}">
                                {{ $layout }}
                            </option>
                        @endforeach
                    </select>
                    <small id="layout" class="form-text text-muted">
                        {{ __('laracms::admin.layout_description') }}
                        {{--Layouts are located in <strong>resources/views/laracms/pages/layouts</strong>--}}
                    </small>
                </div>

                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul id="tabs" class="nav nav-tabs" role="tablist">
                            @foreach($locales as $key => $locale)
                                <li class="nav-item">
                                    <a class="nav-link @if(!$key) active @endif" data-toggle="tab" href="#{{ $locale }}"
                                       role="tab" aria-expanded="true">{{ $locale }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div id="my-tab-content" class="tab-content text-center">
                    @foreach($locales as $key => $locale)
                        <div class="tab-pane @if(!$key) active @endif" id="{{ $locale }}" role="tabpanel"
                             aria-expanded="true">
                            <div class="form-group">
                                <label for="">{{ __('laracms::admin.url') }}</label>
                                <input value="{{ formValue($page ?? null, 'url', $locale) }}" type="text"
                                       class="form-control" name="{{ $locale }}[url]">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('laracms::admin.text') }}</label>
                                <textarea class="form-control" name="{{ $locale }}[text]">{{ formValue($page ?? null, 'text', $locale) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('laracms::admin.save') }}</button>
    </form>
@endsection
