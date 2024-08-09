@extends('app')
<!doctype html>
<html lang="en">
<head>
    @include('partials.header')

</head>
<body>

@include('partials.navbar') 


<div class="text-center mt-5">
    <h2>Hello <strong>{{ auth()->user()->name }}</strong>, these are your todos</h2>
    <h2>Add Todo</h2>

    <form class="row g-3 justify-content-center" method="POST" action="{{route('todos.store')}}">
        @csrf
        <div class="col-6">
            <input type="text" class="form-control" name="title" placeholder="Title">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </div>
    </form>
</div>


<div class="text-center">
    <h2>All Todos</h2>
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @php $counter=1; @endphp

                @foreach($todos as $todo)
				 @if(auth()->user()->id == $todo->user_id)
                    <tr>
                        <th>{{$counter}}</th>
                        <td>{{$todo->title}}</td>
                        <td>{{$todo->created_at}}</td>
                        <td>
                            @if($todo->is_completed)
                                <div class="badge bg-success">Completed</div>
                            @else
                                <div class="badge bg-warning">Not Completed</div>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('todos.edit',['todo'=>$todo->id])}}"><i class="fas fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route('todos.destroy',['todo'=>$todo->id])}}"><i class="fas fa-solid fa-trash-can onclick="delete()"></i></a>
                            <a href="{{ route('notes.show', ['todo' => $todo->id]) }}"><i class="fas fa-solid fa-note-sticky"></i></a>

                        </td>
                    </tr>
                    @php $counter++; @endphp
				@endif


                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>