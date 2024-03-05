@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Task</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="TaskTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th>Task Title</th>
                                        <th>Priority</th>
                                        <th>Due Date</th>
                                        <th>Completed</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('#TaskTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('task.list-data') }}",
                    "type": "GET",
                    "dataSrc": "data.data",
                },
                "columns": [
                    {"data": "id"},
                    {"data": "title"},
                    {"data": "priority"},
                    {"data": "due_date"},
                    {"data": "completed"},
                    {
                        "data": "created_at",
                        "render": function (data) {
                            return moment(data).format('DD/MM/YYYY HH:mm:ss');
                        }
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<a href="{{ url('tasks/edit', ['id' => '']) }}/' + row.id + '" class="btn btn-sm btn-success">Edit</a>' +
                                ' <a href="{{ url('tasks/destroy', ['id' => '']) }}/' + row.id + '" class="btn btn-sm btn-danger">Delete</a>';
                        }
                    }
                ]
            });
        });


    </script>
@endsection
