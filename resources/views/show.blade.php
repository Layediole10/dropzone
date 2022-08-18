@extends('dropzone')
 
 
@section('content')
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Filename</th>
                <th scope="col">Original Filename</th>
                <th scope="col">Resized Filename</th>
            </tr>
            </thead>
            <tbody>
            @foreach($images as $image)
                <tr>
                    <td><img src="{{asset('images/'. $image->resized_name )}}"></td>
                    <td>{{ $image->filename }}</td>
                    <td>{{ $image->original_name }}</td>
                    <td>{{ $image->resized_name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection