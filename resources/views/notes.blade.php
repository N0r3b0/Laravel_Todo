@extends('app')
<!doctype html>
<html lang="en">
<head>
    @include('partials.header')

</head>
<body>

@include('partials.navbar') 


@extends('app')

<div class="container mt-5">
    <h2 class="text-center mb-4">Notes for Todo: <strong>{{ $todo->title }}</strong></h2>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Dodaj formularz do dodawania notatki -->
            <form class="row g-3 justify-content-center" method="POST" action="{{ route('notes.store', ['todo' => $todo->id]) }}">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="content" placeholder="Add a note...">
                    <button type="submit" class="btn btn-primary">Add Note</button>
                </div>
            </form>

            <!-- Wyświetl listę notatek dla danego todo -->
            @if ($todo->notes->count() > 0)
                <h3>Notes:</h3>
                <ul class="list-group">
                    @foreach ($todo->notes as $note)
                        <li class="list-group-item note-item p-3 mb-3" style="background-color: #b9ad06;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>{{ $note->content }}</div>
                                <div class="text-right">
                                    <small class="text-muted mr-3">{{ $note->created_at->diffForHumans() }}</small>
                                    <a href="{{ route('editNote', ['noteId' => $note->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{ route('notes.destroy', ['todoId' => $todo->id, 'noteId' => $note->id]) }}" class="btn btn-sm btn-danger" onclick="delete()"><i class="fas fa-solid fa-trash-can"></i></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No notes for this todo.</p>
            @endif
        </div>
    </div>
</div>





@yield('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
$(document).on('click', '.button', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure!",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "{{url('/destroy')}}",
                data: {id:id},
                success: function (data) {
                              //
                    }         
            });
    });
});
</script>
</body>
</html>