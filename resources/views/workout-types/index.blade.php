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
      <button class="btn btn-danger" data-toggle="modal" data-target="#alert" data-workout_type_id="{{ $workout_type->id }}">Delete</button>
    </td>
  </tr>
  @endforeach
</table>
<!-- A modal for showing final alert before taking a delete action -->
<div class="modal fade" id="alert" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Attention!!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You are about to delete a record in the database. Are you sure you want to do this?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- form to perform actual deletion. Action field filled by the javascript based on the filed from original button -->
        <form action="#" method="POST" id="modal-delete">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Script for filling action field in the modal -->
<script>
  jQuery('#alert').on('show.bs.modal', function(event) {
    var button = jQuery(event.relatedTarget) // Button that triggered the modal
    var workout_type_id = button.data('workout_type_id') // Extract player_id from data-* attributes
    // Update the modal's content
    var modal = jQuery(this)
    modal.find('#modal-delete').attr('action', '{{url("/workout_types")}}/' + workout_type_id)
  })
</script>
