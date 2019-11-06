<a href="{{ route('workout-types.create') }}" class="btn btn-primary new-workout-type">New Workout Type</a>

<table class="table players">
  <thead class="thead-dark">
    <tr>
      <th>Name</th>
      <th>Has distance</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  @foreach($workout_types as $workout_type)
  <tr>
    <td class="align-left">{{$workout_type->name}}</td>
    <td></td>
    <td class="align-middle"><a href="{{url('/workout-types/' . $workout_type->id . '/edit')}}" class="btn  btn-success">Edit</a></td>
    <td class="align-middle">
      <button class="btn btn-danger" data-toggle="modal" data-target="#alert" data-workout_type_id="{{ $workout_type->id }}">Delete</button>
    </td>
  </tr>
  @endforeach
</table>
