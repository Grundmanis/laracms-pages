@extends('laracms.dashboard::layouts.app', ['page' => 'Pages'])

@include('laracms.dashboard::partials.summernote')

@section('content')
    <form method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="slug">URL<span>*</span></label>
            <input value="{{ formValue($page ?? null, 'url') }}" name="url" class="form-control" id="url"
                   placeholder="about or faq or whatever">
            <small id="url" class="form-text text-muted">This url will be shown in address bar</small>
        </div>

        <div class="form-group">
            <label for="slug">Layout<span>*</span></label>
            <select class="form-control" name="layout" id="layout">
                @foreach($layouts as $layout)
                    <option @if(formValue($page ?? null, 'layout') == $layout) selected
                            @endif value="{{ $layout }}">
                        {{ $layout }}
                    </option>
                @endforeach
            </select>
            <small id="layout" class="form-text text-muted">Layouts are located in <strong>resources/views/laracms/pages/layouts</strong>
            </small>
        </div>

        <!-- Nav tabs -->
        <div class="form-group">
            <ul class="nav nav-tabs" role="tablist">
                @foreach($locales as $key => $locale)
                    <li role="presentation" @if(!$key) class="active" @endif>
                        <a href="#{{ $locale }}" data-toggle="tab">
                            {{ $locale }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <label title="value">Text*</label>

            @foreach($locales as $key => $locale)
                <div class="tab-pane @if(!$key) active @endif" id="{{ $locale }}">
                    <div class="form-group">
                        <textarea class="summernote" name="{{ $locale }}[text]">
                            {{ formValue($page ?? null, 'text', $locale) }}
                        </textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
