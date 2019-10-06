@extends(view()->exists('laracms.dashboard.layouts.app') ? 'laracms.dashboard.layouts.app' : 'laracms.dashboard::layouts.app', ['page' => __('laracms::admin.menu.pages')] )

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endsection

@section('content')

<form method="post">
        {{ csrf_field() }}

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('laracms::admin.menu.pages') }}</h4>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label for="key">{{ __('laracms::admin.key') }}<span>*</span></label>
                    <input class="form-control" value="{{ old('key', isset($page) ? $page->key : '') }}" type="text" name="key" id="key">
                </div>

                <div class="form-group">
                    <label for="layout">{{ __('laracms::admin.layout') }}<span>*</span></label>
                    <select class="form-control" name="layout" id="layout">
                        @foreach($layouts as $layout)
                            <option @if(formValue($page ?? null, 'layout') == $layout)
                                    selected
                                    @endif value="{{ $layout }}">
                                {{ $layout }}
                            </option>
                        @endforeach
                    </select>
                    <small id="layout" class="form-text text-muted">
                        {{ __('laracms::admin.layout_description') }}
                    </small>
                </div>

                <div class="form-check mt-3">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="hidden" name="in_top_nav" value="0">
                            <input name="in_top_nav" class="form-check-input" type="checkbox"
                                   @if(old('in_top_nav', isset($page) ? $page->in_top_nav : 0)) checked @endif
                                   value="1"
                            >
                            {{ __('laracms::admin.show_in_top_menu') }}
                            <span class="form-check-sign"></span>
                        </label>
                    </div>
                </div>

                <div class="form-check mt-3">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="hidden" name="in_footer" value="0">
                            <input name="in_footer" class="form-check-input" type="checkbox"
                                   @if(old('in_footer', isset($page) ? $page->in_footer : 0)) checked @endif
                                   value="1"
                            >
                            {{ __('laracms::admin.show_in_footer') }}
                            <span class="form-check-sign"></span>
                        </label>
                    </div>
                </div>

                <div class="form-check mt-3">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="hidden" name="auth_only" value="0">
                            <input name="auth_only" class="form-check-input" type="checkbox"
                                   @if(old('auth_only', isset($page) ? $page->auth_only : 0)) checked @endif
                                   value="1"
                            >
                            {{ __('laracms::admin.auth_only') }}
                            <span class="form-check-sign"></span>
                        </label>
                    </div>
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
                                <input value="{{ formValue($page ?? null, 'text', $locale) }}" id="text_{{ $locale }}" type="hidden" name="{{ $locale }}[text]">
                                <trix-editor input="text_{{ $locale }}"></trix-editor>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('laracms::admin.save') }}</button>
</form>
@endsection
