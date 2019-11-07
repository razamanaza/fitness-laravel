<a href="{{ route('workout-types.create') }}" class="btn btn-primary new-workout-type">New Workout Type</a>

<table class="table workout-types">
  <thead class="thead-dark">
    <tr>
      <th>Name</th>
      <th>Has distance</th>
      <th>Color</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  @foreach($workout_types as $workout_type)
  <tr>
    <td class="align-left">{{$workout_type->name}}</td>
    <td><input type="checkbox" {{$workout_type->has_distance ? "checked" : ""}} onclick="return false;"></td>
    <td>
      <div class="workout-type-color" style="background-color: {{$workout_type->color}}"></div>
    </td>
    <td class="align-middle"><a href="{{url('/workout-types/' . $workout_type->id . '/edit')}}" class="btn  btn-success">Edit</a></td>
    <td class="align-middle">
      <button class="btn btn-danger" data-toggle="modal" data-target="#alert" data-type_id="{{ $workout_type->id }}" data-route="workout-types">Delete</button>
    </td>
  </tr>
  @endforeach
</table>
