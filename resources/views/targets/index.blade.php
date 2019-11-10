<h2>My targets</h2>
<a href="{{ url('targets/create') }}" class="btn btn-primary new-target">New Target</a>

<ul class="list-group list-group-flush">
  @foreach($targets as $target)
  <li class="list-group-item">
    <form action="{{ url('targets/' . $target->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm">Finish</button>
    </form>
    {{$target->target}}
  </li>
  @endforeach
</ul>
