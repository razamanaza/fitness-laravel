<form id="other-form" action="{{ url('weight') }}" method="POST">
  @csrf
  <div class="form-group">
    <label for="other-date">Date</label>
    <input
      type="date"
      id="other-date"
      class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"
      name="date"
      value="{{ old('date') ? old('date') : date("Y-m-d") }}"
      required
    >
  </div>
  <div class="form-group">
    <label for="other-type">Type</label>
    <select
      class="form-control {{ $errors->has('other_type_id') ? 'is-invalid' : '' }}"
      name="other_type"
      id="other-type"
      onchange="otherFormChange()"
      required
    >
      <option value="">&nbsp;</option>
      <option value="sleeps">Sleep</option>
      <option value="moods">Mood</option>
      <option value="weights">Weight</option>
    </select>
  </div>
  <div class="form-group" id="other-amount-fg">
    <label for="other-amount">Amount</label>
    <input
      type="text"
      id="other-amount"
      class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
      name="amount"
      value="{{ old('amount') }}"
    >
  </div>

  <div class="form-group bottom-submit">
    <button type="submit" class="btn btn-primary">Add other</button>
  </div>
</form>
@include('errors')
