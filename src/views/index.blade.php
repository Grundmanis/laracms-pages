@extends('laracms.dashboard::layouts.app', ['page' => 'Pages'])

@section('content')
    <div class="form-group">
        <a class="btn btn-success" href="{{ route('laracms.pages.create') }}">Create</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Url</th>
                <th>Layout</th>
                <th></th>
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
                    <td>
                        <a href="{{ route('laracms.pages.edit', $sitePage->id) }}">Edit</a>
                        |
                        <a onclick="return confirm('Are you sure?')"
                           href="{{ route('laracms.pages.destroy', $sitePage->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $pages->links() }}
    </div>
@endsection
