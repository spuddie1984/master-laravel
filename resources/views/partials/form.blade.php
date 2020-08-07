    <div class="form-group">
        <label for="input-title">Title</label>
        <input type="text" class="form-control" id="input-title" name="title" value="{{ old('title', $post->title ?? null) }}" aria-describedby="Title">
        @if ($errors->has('title'))
            <div class="alert alert-danger" role="alert">{{ $errors->first('title') }}</div>
        @endif

    </div>
    <div class="form-group">
        <label for="input-content">Post</label>
        <input type="text" class="form-control" id="input-content" name="content" value="{{ old('content', $post->content ?? null) }}" aria-describedby="Post Content">
        @if ($errors->has('content'))
            <div class="alert alert-danger" role="alert">{{ $errors->first('content') }}</div>
        @endif
    </div>

