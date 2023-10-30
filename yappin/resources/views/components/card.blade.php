<div class="card mb-4" style="cursor: pointer;" onclick="window.location.href = '{{ route('posts.show', $post->id) }}';">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <div class="profile-image">
                <a href="{{ route('profile', $post->user->name) }}" style="margin-right: 8px;">
                    @if ($post->user->avatar)
                        <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="{{ $post->user->name }}"
                            class="rounded-circle" style="width: 50px; height: 50px;">
                    @else
                        <img src="{{ asset('user_avatar.png') }}" alt="{{ $post->user->name }}" class="rounded-circle"
                            style="width: 50px; height: 50px;">
                    @endif
                </a>
            </div>
            <div class="d-flex flex-column">
                <div>
                    <a href="{{ route('profile', $post->user->name) }}"
                        style="text-decoration: none; font-size: 18px; margin-right: 4px;">
                        <strong>{{ $post->user->name }}</strong>
                    </a>
                </div>
                <div>
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                    @if ($post->is_edited)
                        <small class="font-weight-bold"> *edited* </small>
                    @endif
                </div>
            </div>
        </div>
        <h3>{{ $post->title }}</h3>
        <p class="card-text">{{ $post->content }}</p>
        @if ($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="Post Image" class="img-fluid mb-2"
                style="max-width: 400px; max-height: 300px;">
        @endif
        <div class="mt-3 d-flex justify-content-between">
            <div>
                <a href="{{ route('like', $post->id) }}" class="btn btn-light">
                    <i class="{{ $post->likedByUser(Auth::user()) ? 'fas' : 'far' }} fa-heart text-danger"></i>
                    {{ $post->likes->count() }}
                </a>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-light">
                    <i class="far fa-comment"></i> {{ $post->comments->count() }}
                    {{ Str::plural('comment', $post->comments->count()) }}
                </a>
            </div>
            @auth
                <div>
                    @if ($post->user_id == Auth::user()->id)
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary mr-2">Edit</a>
                        <form method="POST" action='{{ route('posts.destroy', $post->id) }}' style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this Yapp?');">Delete</button>
                        </form>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</div>
