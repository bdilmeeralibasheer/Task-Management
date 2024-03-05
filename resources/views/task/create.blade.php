@extends('layouts.app')
@section('content')
<section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-8  offset-md-2  offset-lg-2 col-lg-68">
          <div class="card">
            <form  id="createTask"  class="needs-validation" novalidate="">
                @csrf
              <div class="card-header">
                <h4>Create Task</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" required="">
                  <div class="invalid-feedback">What's your Title?</div>
                </div>
                <div class="form-group">
                  <label for="priority">Priority</label>
                  <input type="number" class="form-control" name="priority" id="priority" required="">
                  <div class="invalid-feedback">Oh no! Priority is invalid.</div>
                </div>

                <div class="form-group">
                  <label for="due_date">Due Date</label>
                  <input type="date" name="due_date" id="due_date" class="form-control">
                  <div class="valid-feedback">Please Enter Date!</div>
                </div>
                <div class="form-group mb-0">
                  <label for="description">Message</label>
                  <textarea class="form-control" rows="5" name="description" id="description" required=""></textarea>
                  <div class="invalid-feedback">Please Enter the  Description?</div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    $(document).ready(function() {
        $('#createTask').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: "{{ route('task.store') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    window.location.href = "{{ route('task.index') }}";
                    $('#createTask')[0].reset();
                },
                error: function(xhr) {

                }
            });
        });
    });


  </script>
@endsection
