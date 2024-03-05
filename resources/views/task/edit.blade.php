@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8  offset-md-2  offset-lg-2 col-lg-68">
                    <div class="card">
                        <form id="UpdateTask" class="needs-validation" novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>Update Task</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$task->title ??''}}" required="">
                                    <div class="invalid-feedback">What's your Title?</div>
                                </div>
                                <div class="form-group">
                                    <label for="priority">Priority</label>
                                    <input type="number" class="form-control" id="priority" min="0" name="priority" value="{{$task->priority ??''}}" required="">
                                    <div class="invalid-feedback">Oh no! Priority is invalid.</div>
                                </div>

                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" id="due_date" name="due_date" class="form-control" value="{{$task->due_date ??''}}">
                                    <div class="valid-feedback">Please Enter Date!</div>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" required="">{{$task->description ??''}}</textarea>
                                    <div class="invalid-feedback">Please Enter Description?</div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $('#UpdateTask').submit(function (e) {
                e.preventDefault();
                const formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('task.update',$task->id) }}",
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        window.location.href = "{{ route('task.index') }}";
                        $('#createTask')[0].reset();
                    },
                    error: function (xhr) {
                    }
                });
            });
        });
    </script>
@endsection
