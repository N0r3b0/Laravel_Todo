<!doctype html>
<html lang="en">
<head>
    @include('partials.header')
    
</head>
<body>
    @include('partials.navbar')

    <div class="text-center mt-5">
        <h2>Edit note</h2>
    </div>
    
    <form  method="POST" action="{{route('notes.update',['noteId' => $note->id, 'content' => $note->content])}}">
    
        @csrf
    
        {{ method_field('PUT') }}
    
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <input type="text" class="form-control" name="content" placeholder="Content" value="{{$note->content}}">
                </div>
    
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </div>
    
    </form>

</body>
</html>