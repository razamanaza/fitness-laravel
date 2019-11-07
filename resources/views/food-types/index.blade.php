<a href="{{ route('food-types.create') }}" class="btn btn-primary new-food-type">New Food Type</a>

<table class="table food-types">
  <thead class="thead-dark">
    <tr>
      <th>Name</th>
      <th>Is alcohol</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  @foreach($food_types as $food_type)
  <tr>
    <td class="align-left">{{$food_type->name}}</td>
    <td><input type="checkbox" {{$food_type->is_alcohol ? "checked" : ""}} onclick="return false;"></td>
    <td class="align-middle"><a href="{{url('/food-types/' . $food_type->id . '/edit')}}" class="btn  btn-success">Edit</a></td>
    <td class="align-middle">
      <button class="btn btn-danger" data-toggle="modal" data-target="#alert" data-type_id="{{ $food_type->id }}" data-route="food-types">Delete</button>
    </td>
  </tr>
  @endforeach
</table>
