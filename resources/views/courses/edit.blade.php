<form action="{{ route('courses.update', $course) }}" method="post">
    @csrf
    @method('PUT')
    Name
    <input type="text" name="name" value="{{ $course->name }}">
    @if($errors->has('name'))
        <ul>
            @foreach ($errors->get('name') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <br>
    <button type="submit">Update</button>
</form>
