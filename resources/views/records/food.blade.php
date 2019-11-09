<form action="{{ url('foods') }}" method="POST">
  @csrf
  <div class="form-group">
    <label for="food-date">Date</label>
    <input
      type="date"
      id="food-date"
      class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"
      name="date"
      value="{{ old('date') ? old('date') : date("Y-m-d") }}"
      required
    >
  </div>
  <div class="form-group">
    <label for="food-name">Food name</label>
    <select
      class="form-control {{ $errors->has('food_type_id') ? 'is-invalid' : '' }}"
      name="food_type_id"
      id="food-name"
      onchange="foodDrinksCheck()"
      required
    >
      <option value="">&nbsp;</option>
      @foreach($food_types as $food_type)
      <option
        value="{{$food_type->id}}"
        {{ $food_type->id == old('food_type_id') ? 'selected="selected"' : '' }}
      >
        {{$food_type->name}}
      </option>
      @endforeach
    </select>
  </div>
  <div class="form-group" id="food-drinks-fg">
    <label for="food-drinks">Drinks</label>
    <input
      type="text"
      id="food-drinks"
      class="form-control {{ $errors->has('drinks') ? 'is-invalid' : '' }}"
      name="drinks"
      value="{{ old('drinks') }}"
    >
  </div>

  <div class="form-group">
    <label for="food-calories">Burned</label>
    <div class="form-row align-items-left">
      <div class="col-auto">
        <div class="input-group mb-2">
          <input
            type="text"
            class="form-control {{ $errors->has('calories') ? 'is-invalid' : '' }}"
            id="food-calories"
            name="calories"
            value="{{ old('calories') }}"
            required
          >
        </div>
      </div>
      <div class="col-auto">
        <div class="input-group mb-2">
          <select class="form-control" name="denomination" id="food-denomination">
            <option value="calories" selected>calories</option>
            <option value="kilojoules">kilojoules</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group bottom-submit">
    <button type="submit" class="btn btn-primary">Add food</button>
  </div>
</form>
@include('errors')
