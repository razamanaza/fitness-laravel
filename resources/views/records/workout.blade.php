<form action="{{ url('workouts') }}" method="POST">
  @csrf
  <div class="form-group">
    <label for="workout-date">Date</label>
    <input
      type="date"
      id="workout-date"
      class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"
      name="date"
      value="{{ old('date') ? old('date') : $currentDate }}"
      required
    >
  </div>
  <div class="form-group">
    <label for="workout-name">Workout name</label>
    <select
      class="form-control {{ $errors->has('workout_type_id') ? 'is-invalid' : '' }}"
      name="workout_type_id"
      id="workout-name"
      onchange="workoutDistanceCheck()"
      required
    >
      <option value="">&nbsp;</option>
      @foreach($workout_types as $workout_type)
      <option
        value="{{$workout_type->id}}">
        {{$workout_type->name}}
      </option>
      @endforeach
    </select>
  </div>
  <div class="form-group" id="workout-distance-fg">
    <label for="workout-distance">Distance in meters</label>
    <input
      type="text"
      id="workout-distance"
      class="form-control {{ $errors->has('distance') ? 'is-invalid' : '' }}"
      name="distance"
    >
  </div>
  <div class="form-group">
      <label for="workout-duraion">Duration</label>
      <div class="form-row align-items-left">
        <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">hours</div>
              </div>
              <input
                type="text"
                class="form-control {{ $errors->has('duration-mm') ? 'is-invalid' : '' }}"
                id="workout-duraion"
                name="duration-hh"
                value="{{ old('duration-hh') }}"
              >
            </div>
        </div>
        <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">minutes</div>
              </div>
              <input
                type="text"
                class="form-control {{ $errors->has('duration-mm') ? 'is-invalid' : '' }}"
                name="duration-mm"
                value="{{ old('duration-mm') }}"
                required
              >
            </div>
        </div>
      </div>
  </div>

  <div class="form-group">
    <label for="workout-calories">Burned</label>
    <div class="form-row align-items-left">
      <div class="col-auto">
        <div class="input-group mb-2">
          <input
            type="text"
            class="form-control {{ $errors->has('calories') ? 'is-invalid' : '' }}"
            id="workout-calories"
            name="calories"
            value="{{ old('calories') }}"
            required
          >
        </div>
      </div>
      <div class="col-auto">
        <div class="input-group mb-2">
          <select class="form-control" name="denomination" id="workout-denomination">
            <option value="calories" selected>calories</option>
            <option value="kilojoules">kilojoules</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group bottom-submit">
    <button type="submit" class="btn btn-primary">Add workout</button>
  </div>
</form>
@include('errors')
