<img src="{{$message->image}}" alt="" class="img-thumbnail">
<p></p>

<p class="card-text">
  <div class="text-muted">Por: <a href="/{{$message->user->username}}">{{ $message->user->name }} </a></div>
    {{$message->content}}
    <a href="/messages/{{$message->id}}"> Leer Mas</a>
</p>
<div class="card-text text-muted float-right">
  {{$message->created_at}}
</div>