@extends('admin.master')

@section('title')

@endsection

@section('content')
<form action="{{ route('courses.store') }}" method="post">
    @csrf
    Name
    <input type="text" name="name" value=" {{ old('name') }}">
    @if($errors->has('name'))
        <ul>
            @foreach ($errors->get('name') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <br>
    <button type="submit">Them</button>
</form>
@endsection

