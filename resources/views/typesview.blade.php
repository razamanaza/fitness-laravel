@extends('layouts.app')
@section('head')
<!-- Script for filling action field in the modal -->
<script>
  window.onload = function() {
    $('#alert').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var type_id = button.data('type_id') // Extract player_id from data-* attributes
      var rt = button.data('route')
      // Update the modal's content
      var modal = $(this)
      var action = '{{url("/")}}' + '/' + rt + '/' + type_id
      modal.find('#modal-delete').attr('action', action)
    })
  };
</script>
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Food / Workout types</div>

        <div class="card-body types">
          <ul class="nav nav-tabs" id="Types">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#workouts">Workout types</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#foods">Food types</a>
            </li>
          </ul>
          <div class="tab-content" id="TypesContent">
            <div class="tab-pane fade show active" id="workouts">
              @include('workout-types.index')
            </div>
            <div class="tab-pane fade" id="foods">
              @include('food-types.index')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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

@endsection
