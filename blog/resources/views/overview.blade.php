@extends ('layout')


@section ('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Overview</h1>
    </div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    @if(Auth::check())
    <br>
    @foreach ($listhacks as $listhack)
    <h2><?php echo "Lifehack " . $listhack->id . ": " . $listhack->name ?></h2>
    <br>
    <div class="row">
        <div class="col">
            <img src="{{ asset('/uploads/images/' . $listhack->image)}}" style="height: 200px;" />
        </div>
        <div class="col" style="margin-top: 70px;">
            <h4><?php echo $listhack->description ?></h4>
        </div>
    </div>

    <br>
    <h4><?php echo "Made by " . $listhack->user . " " ?>
        @foreach($users as $user)
        @if($user->name == $listhack->user)
        @if($user->profile_image != null)
        <img src="{{ asset($user->profile_image) }}" style="width: 40px; height: 40px; border-radius: 50%; margin-left: +10px;">
        @endif
        @break
        @endif
        @endforeach
    </h4>
    <br>
    <div style="margin-left: 20px">

        <h4>Comments</h4>
        @foreach($comments as $comment)
        @if($comment->lh_id == $listhack->id)
        <div class="display-comment" style="margin-left:40px;">
            <div class="row">
                <div class="col">
                    <strong><img src="{{ asset($comment->user->profile_image) }}" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 20px; margin-left: -60px;">{{ $comment->user->name }} on {{ $comment->created_at->format('D dS M Y')}} at {{ $comment->created_at->format('H:i')}}</strong>
                    <p>{{ $comment->body }}</p>
                </div>
                @can('delete', $comment)
                <div class="col">

                    {{ Form::open(array('url' => 'overview/' . $comment->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning', 'onclick'=> "return confirm('Are you sure you want to delete this comment?')")) }}
                    {{ Form::close() }}

                </div>
                @endcan
                </form>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <hr />
    <div style="margin-left: 20px">
        <h5>Add comment</h5>
        <form method="post" action="{{ route('overview.store'   ) }}">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="body"></textarea>
                <input type="hidden" name="lh_id" value="{{ $listhack->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Add!" />
            </div>
        </form>
    </div>
    <br><br><br>
    @endforeach
    @endif


    @if(!Auth::check())
    @foreach ($listhacks as $listhack)
    <h2><?php echo "Lifehack " . $listhack->id . ": " . $listhack->name ?></h2>
    <br>
    <div class="row">
        <div class="col">
            <img src="{{ asset('/uploads/images/' . $listhack->image)}}" style="height: 200px;" />
        </div>
        <div class="col" style="margin-top: 70px;">
            <h4><?php echo $listhack->description ?></h4>
        </div>
    </div>
    <br>
    <h4><?php echo "Made by " . $listhack->user . " " ?>
        @foreach($users as $user)
        @if($user->name == $listhack->user)
        @if($user->profile_image != null)
        <img src="{{ asset($user->profile_image) }}" style="width: 40px; height: 40px; border-radius: 50%; margin-left: +10px;">
        @endif
        @break
        @endif
        @endforeach
    </h4>
    <br>

    <div style="margin-left: 20px">

        <h4>Comments</h4>
        @foreach($comments as $comment)
        @if($comment->lh_id == $listhack->id)

        <div class="display-comment" style="margin-left:40px;">
            <strong><img src="{{ asset($comment->user->profile_image) }}" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 20px; margin-left: -60px;">{{ $comment->user->name }}  on {{ $comment->created_at->format('D dS M Y')}} at {{ $comment->created_at->format('H:i')}} </strong>
            <p>{{ $comment->body }}</p>
            </form>
        </div>


        @endif
        @endforeach
    </div>

    <br><br><br>
    @endforeach
    @endif
    @endsection
