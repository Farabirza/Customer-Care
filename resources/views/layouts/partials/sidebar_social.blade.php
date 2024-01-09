<style>
#btn-social {
    z-index: 99;
    position: fixed;
    right: 30px;
    bottom: 30px;
    background: #f1f1f1;
    padding: .8rem 1rem;
    border-radius: 50%;
    box-shadow: .125rem .125rem .25rem rgba(0,0,0,.075) !important;
    font-size: 1.5em;
}
#btn-social:hover {
    cursor: pointer;
    background: var(--color-darkBlue);
    color: #fff;
    transition: .2s ease-in-out;
}
#btn-social img { height: 40px; }

.notification-count {
    top: 10%;
    left: 85%;
    position: absolute;
    transform: translate(-50%,-50%) !important;
    padding: .35em .65em;
    background: #dc3545 !important;
    border-radius: 50rem !important;
    line-height: 1;
    font-size: .5em;
    font-weight: 700;
    color: #fff;
}

.btn-topbar:hover { color: var(--bs-warning); }

.offcanvas-body { scrollbar-color: #404040 #f1f1f1; scrollbar-width: thin; }

.comment-content { 
    width: 100%;
    position: relative; 
    background: #fff;
    padding: 10px 15px;
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
    border-radius: 8px; 
    margin-bottom: .5rem !important;
}
@media (max-width: 1199px) {
    .comment-user-picture { display: none; }
}
@media (max-width: 768px) {
    #btn-social { bottom: 20px; right: 20px; padding: .4rem .8rem .8rem .8rem; }
    #btn-social img { height: 30px; }
}
</style>

<div id="btn-social" role="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar-social" aria-controls="sidebar-social">
    <img src="{{asset('img/logo/logo_dark.png')}}">
    @if(Auth::check() && Auth::user()->notification->where('read', false)->count() > 0)
    <div class="notification-count">
        {{Auth::user()->notification->where('read', false)->count()}}
    </div>
    @endif
</div>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="sidebar-social" aria-labelledby="sidebar-socialLabel" style="background:#f1f1f1; border: 0;">
    <div class="flex-between gap-3 px-2 text-white" style="background:#202020">
        <a href="/"><img src="{{asset('img/logo/logo_long_white.png')}}" class="img-fluid" style="height:40px;"></a>
        <div class="py-2 flex-end">
            @auth
            <div style="position: relative">
                <i role="button" class="bx bx-bell bx-border btn-topbar" title="Notification" onclick="modalNotification()"></i>
                @if(Auth::user()->notification->where('read', false)->count() > 0)
                <div class="notification-count">
                    {{Auth::user()->notification->where('read', false)->count()}}
                </div>
                @endif
            </div>
            @if(Auth::check() && Auth::user()->id != $user->id)
            <a href="/cv/{{Auth::user()->username}}" class="fs-9"><i class="bx bxs-home bx-border btn-topbar" title="Home"></i></a>
            @endif
            <a href="/dashboard" class="fs-9"><i class="bx bxs-dashboard bx-border btn-topbar" title="Dashboard"></i></a>
            @if(Auth::check() && Auth::user()->id == $user->id)
            <span role="button" class="" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-edit-alt bx-border btn-topbar" title="Edit data"></i></span>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/dashboard/edit/profile">Profile</a></li>
                <li><a class="dropdown-item" href="/dashboard/edit/education">Education</a></li>
                <li><a class="dropdown-item" href="/dashboard/edit/experience">Experience</a></li>
                <li><a class="dropdown-item" href="/dashboard/edit/certificate">Certificate</a></li>
                <li><a class="dropdown-item" href="/dashboard/edit/skill">Skill</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/portfolio">Portfolio</a></li>
                <li><a class="dropdown-item" href="/dashboard/edit/config">Configuration</a></li>
            </ul>
            <i role="button" type="button" class="bx bx-palette bx-border btn-topbar" title="Preference" data-bs-toggle="offcanvas" data-bs-target="#sidebar-preference" aria-controls="sidebar-preference"></i>
            @endif
            @endauth
            @guest
            <div class="py-2 me-2"><button class="btn btn-outline-light btn-sm" onclick="modal_login_show()">Sign in</button></div>
            @endguest
            <div class="fs-9" role="button" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bx bx-x bx-border btn-topbar" title="Close"></i></div>
        </div>
    </div>
    <div class="offcanvas-body">
        <!-- status start -->
        <div class="flex-start gap-3">
            @if($user->picture)
            <img src="{{asset('img/profiles/'.$user->picture)}}" id="socialBar-user-picture" class="rounded rounded-circle shadow-sm" style="max-width:80px">
            @else
            <img src="{{asset('img/profiles/user.jpg')}}" id="socialBar-user-picture" class="rounded rounded-circle shadow-sm" style="max-width:80px">
            @endif
            <div class="col">
                <p class="fs-9 mb-0"><span class="fw-bold text-darkBlue">{{$user->username}}</span> | {{$user->profile->title}}</p>
                <div class="flex-start gap-3 mb-0 mt-2 fs-9">
                    <div class="flex-start gap-2">
                        @if($liked == true)
                        <i id="btn-like-cv" class="bx bxs-heart bx-border-circle btn-danger border-danger" role="button" onclick="likeCV()"></i>
                        <span id="cv-count-like">{{count($user->liked)}}</span>
                        @else
                        <i id="btn-like-cv" class="bx bxs-heart bx-border-circle btn-outline-danger border-danger" role="button" onclick="likeCV()"></i>
                        <span id="cv-count-like">{{count($user->liked)}}</span>
                        @endif
                    </div>
                    <div class="flex-start gap-2">
                        <i class="bx bxs-message bx-border-circle bg-success border-success text-white"></i>  
                        <span id="cv-count-comment">{{count($user->comment)}}</span> 
                    </div>
                </div>
            </div>
        </div>
        <!-- status end -->
        <div class="my-4"><hr></div>
        <!-- comment start -->
        @auth
        <div class="mb-4">
            <form action="action/comment" method="post" id="form-comment" class="form-comment m-0">
            <input type="hidden" name="action" value="comment_user">
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <div class="flex-start gap-2 mb-3">
                @if(Auth::user()->picture)
                <img src="{{asset('img/profiles/'.Auth::user()->picture)}}" class="img-fluid rounded-circle shadow-sm comment-user-picture" style="height:40px">
                @else
                <img src="{{asset('img/profiles/user.jpg')}}" class="img-fluid rounded-circle shadow-sm comment-user-picture" style="height:40px">
                @endif
                <p class="mb-2 fw-500">{{Auth::user()->profile->full_name}}</p>
            </div>
            <textarea name="content" id="cv-comment" style="min-height:80px;" class="form-control" required></textarea>
            <div class="flex-end gap-3 mt-3">
                <hr class="col">
                <button type="submit" class="btn btn-success rounded-pill flex-start gap-2" style="font-size:.8em;"><i class="bx bxs-message"></i>Kirim komentar</button>
            </div>
            </form>
        </div>
        @endauth
        <!-- comment end -->
        <!-- comment container start -->
        <div id="container-comments">
            <!-- comment item start -->
            <?php $i = 0; ?>
            @forelse($user->commented->sortByDesc('created_at') as $item)
            @if($item->parent_comment_id == 0)
            <?php 
                $isCommentLiked = false;
                foreach($item->like as $like) {
                    if(Auth::check() && $like->user_id == Auth::user()->id) {
                        $isCommentLiked = true;
                    }
                }
            ?>
            <div class="comment-content">
                <div class="flex-start gap-2 mb-3">
                    @if($item->user->picture)
                    <img src="{{asset('img/profiles/'.$item->user->picture)}}" class="img-fluid rounded-circle shadow-sm comment-user-picture" style="height:40px">
                    @else
                    <img src="{{asset('img/profiles/user.jpg')}}" class="img-fluid rounded-circle shadow-sm comment-user-picture" style="height:40px">
                    @endif
                    <p class="flex-start gap-2 m-0 fs-8 fw-500">
                        <a href="/cv/{{$item->user->username}}" class="text-darkBlue fw-500">{{$item->user->profile->full_name}}</a>
                        @if($item->user->profile->title) | <span>{{$item->user->profile->title}}</span> @endif
                        @if($item->user->id == $user->id) <span class="badge bg-secondary">Author</span> @endif
                    </p>
                </div>
                <p class="mb-3 fs-8">{{$item->content}}</p>
                <div class="flex-start gap-3 fs-7 text-secondary">
                    <div class="flex-start gap-2"><i class="bx bx-time"></i>{{$item->created_at->diffForHumans()}}</div>
                    @if($isCommentLiked == true)
                    <div id="comment-like-{{$i}}" class="flex-start gap-2 text-danger" role="button" onclick="likeComment(false, '{{$item->id}}', '{{$i}}')">
                        <i class="bx bxs-like"></i><span id="like-comment-count-{{$i}}">{{count($item->like)}}</span>
                    </div>
                    @else
                    <div id="comment-like-{{$i}}" class="flex-start gap-2 hover-danger" role="button" onclick="likeComment(true, '{{$item->id}}', '{{$i}}')">
                        <i class="bx bx-like"></i><span id="like-comment-count-{{$i}}">{{count($item->like)}}</span>
                    </div>
                    @endif
                    @if(Auth::check() && $item->user_id == Auth::user()->id)
                    <span class="flex-start gap-1 hover-primary" role="button" onclick="replyComment('{{$item->id}}', '{{$i}}', '0')"><i class='bx bx-reply'></i>Reply</span>
                    @else
                    <span class="flex-start gap-1 hover-primary" role="button" onclick="replyComment('{{$item->id}}', '{{$i}}', '{{$item->user_id}}')"><i class='bx bx-reply'></i>Reply</span>
                    @endif
                    @if(Auth::check() && Auth::user()->id == $item->user_id)
                    <a href="/comment/{{$item->id}}/delete" class="flex-start gap-1 hover-danger btn-warn" data-warning="Anda ingin menghapus komentar ini?"><i class='bx bx-trash-alt'></i>Delete</a>
                    @endif
                </div>
            </div>
            <?php $i++ ?>
            <!-- reply start -->
            @if(count($item->reply) > 0)
                <?php $j = 0; ?>
                @foreach($item->reply->sortBy('created_at') as $reply)
                <?php 
                    $dataArray = json_decode($reply->like, true);
                    $user_ids = array_column($dataArray, 'user_id');
                    $isReplyLiked = (Auth::check() && in_array(Auth::user()->id, $user_ids)) ? true : false;
                ?>
                <div class="ps-3 mb-3">
                    <div class="comment-content">
                        <div class="flex-start gap-2 mb-3">
                            @if($reply->user->picture)
                            <img src="{{asset('img/profiles/'.$reply->user->picture)}}" class="img-fluid rounded-circle shadow-sm comment-user-picture" style="height:40px">
                            @else
                            <img src="{{asset('img/profiles/user.jpg')}}" class="img-fluid rounded-circle shadow-sm comment-user-picture" style="height:40px">
                            @endif
                            <p class="mb-2 flex-start gap-2 fw-500 fs-8">
                                <a href="/cv/{{$reply->user->username}}" class="fw-500 text-darkBlue">{{$reply->user->profile->full_name}}</a>
                                @if($reply->user->profile->title) | <span>{{$reply->user->profile->title}}</span> @endif
                                @if($reply->user->id == $user->id) <span class="badge bg-secondary">Author</span> @endif
                            </p>
                        </div>
                        <p class="mb-3 fs-8">{{$reply->content}}</p>
                        <div class="flex-start gap-3 fs-7 text-secondary">
                            <div class="flex-start gap-2"><i class="bx bx-time"></i>{{$reply->created_at->diffForHumans()}}</div>
                            @if($isReplyLiked == true)
                            <div id="comment-like-{{$i}}-{{$j}}" class="flex-start gap-2 text-danger" role="button" onclick="likeComment(false, '{{$reply->id}}', '{{$i}}-{{$j}}')">
                                <i class="bx bxs-like"></i><span id="like-comment-count-{{$i}}-{{$j}}">{{count($reply->like)}}</span>
                            </div>
                            @else
                            <div id="comment-like-{{$i}}-{{$j}}" class="flex-start gap-2 hover-danger" role="button" onclick="likeComment(true, '{{$reply->id}}', '{{$i}}-{{$j}}')">
                                <i class="bx bx-like"></i><span id="like-comment-count-{{$i}}-{{$j}}">{{count($reply->like)}}</span>
                            </div>
                            @endif
                            @if(Auth::check() && $reply->user_id == Auth::user()->id)
                            <span class="flex-start gap-1 hover-primary" role="button" onclick="replyComment('{{$item->id}}', '{{$i}}-{{$j}}', '0')"><i class='bx bx-reply'></i>Reply</span>
                            @else
                            <span class="flex-start gap-1 hover-primary" role="button" onclick="replyComment('{{$item->id}}', '{{$i}}-{{$j}}', '{{$reply->user_id}}')"><i class='bx bx-reply'></i>Reply</span>
                            @endif
                            @if(Auth::check() && Auth::user()->id == $reply->user_id)
                            <a href="/comment/{{$reply->id}}/delete" class="flex-start gap-1 hover-danger btn-warn" data-warning="Anda ingin menghapus komentar ini?"><i class='bx bx-trash-alt'></i>Delete</a>
                            @endif
                        </div>
                    </div>
                </div>
                <?php $j++; ?>
                @endforeach
            @endif
            <!-- reply end -->
            @endif
            <!-- comment item end -->
            @empty
            <div class="alert alert-secondary fs-9">
                <p class="text-center m-0">Belum ada komentar dibuat</p>
            </div>
            @endforelse
        </div>
        <?php $commentItemCount = $i; ?>
        <!-- comment container end -->
    </div>
    <div class="offcanvas-footer">
    </div>
</div>


<!-- Modal Reply -->
<div class="modal fade" id="modal-reply" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center fw-medium"><i class='bx bx-message me-2'></i><span>Balas komentar</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/cv/{{$user->username}}/comment" id="form-reply" method="POST">
            @csrf
            <input type="hidden" id="reply-comment_id" name="parent_comment_id">
            <input type="hidden" id="reply-user_id" name="reply_user_id" value="0">
            <div class="modal-body">
                <label for="reply-content" class="form-label">Pesan</label>
                <textarea name="content" id="reply-content" style="min-height:120px;" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-success px-3 rounded-pill flex-start gap-2"><i class='bx bxs-message'></i>Kirim balasan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Reply end -->

@guest
<!-- modal authentication -->
@include('layouts.partials.modal_auth')
@endguest
@auth
<!-- modal notification start -->
@include('layouts.partials.modal_notification')
@endauth

@push('scripts')
<script type="text/javascript">
var isAuth = false;
var liked = '{{$liked}}';
@auth
var isAuth = true;
@endauth

// btn social
$('#btn-social').on('mouseover', function() {
    $(this).find('img').attr('src', "{{asset('img/logo/logo.png')}}");
}).on('mouseout', function() {
    $(this).find('img').attr('src', "{{asset('img/logo/logo_dark.png')}}");
});

// refresh
const fetchSocialStatusCount = () => {
    let formData = { action: 'fetch_status_count', user_id: '{{$user->id}}', };
    let config = {
        method: 'post', url: domain + 'action/user', data: formData,
    };
    axios(config)
    .then((response) => {
        $('#cv-count-visit').html(response.data.visit_count);
        $('#cv-count-like').html(response.data.like_count);
        $('#cv-count-comment').html(response.data.comment_count);
    })
    .catch((error) => {
        console.log(error.response.data);
    });
};

// like start
const likeCV = () => {
    if(isAuth == false) { return modal_login_show(); }
    if(liked == false) { $('#btn-like-cv').removeClass('bxs-heart').addClass('bx-loader bx-spin'); }
    let formData = { action: 'like_cv', liked_user_id: '{{$user->id}}' }
    let config = { method: 'post', url: domain + 'action/user', data: formData, };
    axios(config)
    .then((response) => {  
        if(response.data.liked == true) {
            setTimeout(function () {
                $('#btn-like-cv').removeClass('bx-loader bx-spin btn-outline-danger').addClass('bxs-heart btn-danger');
                liked = true;
            }, 500);
        } else {
            $('#btn-like-cv').removeClass('btn-danger').addClass('btn-outline-danger');
            liked = false;
        }
        fetchSocialStatusCount();
    })
    .catch((error) => {
        console.log(error.response.data);
    });
};
// like end

// comment start
var commentItemCount = {{$commentItemCount}};
$('#form-comment').submit(function(e) {
    e.preventDefault();
    if(isAuth == false) { return modal_login_show(); }
    let formData = new FormData($(this)[0]);
    let config = { method: 'post', url: domain + 'action/comment', data: formData, };
    axios(config)
    .then((res) => {
        if(commentItemCount == 0) { $('#container-comments').html(''); }
        let author = res.data.author ? `<span class="badge bg-secondary">Author</span>` : ``;
        $('#container-comments').prepend(`
        <div class="comment-content">
            <div class="flex-start gap-2 mb-3">
                <img src="`+$('#socialBar-user-picture').attr('src')+`" class="img-fluid rounded-circle shadow-sm comment-user-picture" style="height:40px">
                <p class="flex-start gap-2 m-0 fs-8 fw-500">
                    <a href="`+res.data.username+`" class="text-darkBlue fw-500">`+res.data.full_name+`</a> `+author+`
                </p>
            </div>
            <p class="mb-3 fs-8">`+res.data.comment.content+`</p>
            <div class="flex-start gap-3 fs-7 text-secondary">
                <div class="flex-start gap-2"><i class="bx bx-time"></i>Just now</div>
                <div id="comment-like-`+commentItemCount+`" class="flex-start gap-2" role="button" onclick="likeComment(false, '`+res.data.comment.id+`', '`+commentItemCount+`')">
                    <i class="bx bx-like"></i><span id="like-comment-count-`+commentItemCount+`">0</span>
                </div>
                <span class="flex-start gap-1 hover-primary" role="button" onclick="replyComment('`+res.data.comment.id+`', '`+commentItemCount+`', 0)"><i class='bx bx-reply'></i>Reply</span>
                <a href="/comment/`+res.data.comment.id+`/delete" class="flex-start gap-1 hover-danger btn-warn" data-warning="Anda ingin menghapus komentar ini?"><i class='bx bx-trash-alt'></i>Delete</a>
            </div>
        </div>
        `);
        $(this).trigger('reset');
        successMessage(res.data.message);
        commentItemCount++;
    })
    .catch((err) => {
       console.log(err.response.data);
    });
});
const replyComment = (comment_id, item_id, reply_user_id) => {
    if(isAuth == false) { return modal_login_show(); }
    $('#reply-comment_id').val(comment_id);
    $('#reply-user_id').val(reply_user_id);
    $('#modal-reply').modal('show');
};
const likeComment = (like, comment_id, item_id) => {
    if(isAuth == false) { return modal_login_show(); }
    let formData = { action: 'like_cv_comment', like: like, liked_user_id: '{{$user->id}}', comment_id: comment_id };
    let config = { method: 'post', url: domain + 'action/comment', data: formData, };
    axios(config)
    .then((response) => {
        if(response.data.liked == true) {
            $('#comment-like-' + item_id).removeClass('hover-danger').addClass('text-danger').attr('onclick', `likeComment(false, '`+ comment_id +`', '`+ item_id +`')`);
            $('#comment-like-' + item_id).children("i").removeClass('bx-like').addClass('bxs-like');
        } else {
            $('#comment-like-' + item_id).removeClass('text-danger').addClass('hover-danger').attr('onclick', `likeComment(true, '`+ comment_id +`', '`+ item_id +`')`);;
            $('#comment-like-' + item_id).children("i").removeClass('bxs-like').addClass('bx-like');
        }
        $('#like-comment-count-' + item_id).html(response.data.like_count);
    })
    .catch((error) => {
        console.log(error.response.data);
    });
};
// comment end
</script>
@endpush