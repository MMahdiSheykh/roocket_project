@foreach($comments as $comment )
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between">
            <div class="commenter fw-bold">
                <span>{{ $comment->user->name }}</span>
                <span
                    class="text-muted">{{ ($comment->created_at == $comment->updated_at) ? 'Written in the '.$comment->created_at->diffForHumans() : 'Updated in the '.$comment->updated_at->diffForHumans() }}</span>
            </div>
            @auth
                <span class="btn btn-sm btn-primary" data-toggle="modal" data-target="#sendComment"
                      data-id="{{ $comment->id }}"
                      data-type="product">Recomment</span>
            @endauth
        </div>
        <div class="card-body">
            {{ $comment->comment }}

            @include('layouts.comments', ['comments' => $comment->child ])

        </div>
    </div>
@endforeach
