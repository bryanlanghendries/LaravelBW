<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex align-items-center">
                <a href="{{ route('profile', $post->user->name) }}" style="text-decoration: none; color: inherit;">
                    <div class="profile-image">
                        @if ($post->user->avatar)
                            <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="{{ $post->user->name }}"
                                class="rounded-circle" style="width: 50px; height: 50px;">
                        @else
                            <img src="{{ asset('user_avatar.png') }}" alt="{{ $post->user->name }}"
                                class="rounded-circle" style="width: 50px; height: 50px;">
                        @endif
                    </div>
                    <div class="user-info ml-3">
                        <strong class="mb-1" style="font-size: 18px; cursor: pointer;">
                            {{ $post->user->name }}
                        </strong>
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        @if ($post->is_edited)
                            <small class="font-weight-bold"> *edited* </small>
                        @endif

                    </div>
                </a>
                @auth
                    <div>
                        @if ($post->user_id == Auth::user()->id)
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary mr-2">Edit</a>
                            <form method="POST" action="{{ route('posts.destroy', $post->id) }}" style="display: inline;">
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
        <h3 class="mt-3"><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h3>
        <p class="card-text">{{ $post->content }}</p>
        @if ($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="Post Image" class="img-fluid mb-2"
                style="max-width: 400px; max-height: 300px;">
        @endif
        <div class="mt-3">
            <a href="{{ route('like', $post->id) }}" class="btn btn-light">
                <i class="{{ $post->likedByUser(Auth::user()) ? 'fas' : 'far' }} fa-heart text-danger"></i>
                {{ $post->likes->count() }}
            </a>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-light">
                <i class="far fa-comment"></i> 0 comments
            </a>
        </div>
    </div>
</div>
