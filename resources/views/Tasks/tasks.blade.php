@extends('main.app')
@section('title')
        Tasks | MyCash
@endsection
@section('css')
@endsection
@section('content')
    <section class="table-sec pt-3">
        <div class="container px-2 px-md-5">
            <div class="align-items-start border-bottom flex-column">
                <x-first-head label="Tasks Tabel" icon="database" />

                <button class="btn-primary btn  border" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Create</button>
                <x-modal buttonText="Create" modalId="exampleModal"
                    formAction="{{ route('tasks.create') }}" formMethod="GET" modalTitle="Create">
                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="employee_id"> Employees </label>
                    <select class="form-control" id="employee_id" name="employee_id">
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                        @endforeach
                    </select>
                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle">Task</label>
                    <input class="form-control" id="last" name="task" type="text" placeholder="mohamed"
                        required />
                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="pending" >Pending</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                </x-modal>
                <br>
            </div>

            {{-- <x-import-form action="{{ route('reference.import-File') }}" method="POST">
                (name , code)
            </x-import-form> --}}

            <div class="card">
                <div class="container">
                    <div class="card-body">

                        @foreach ($tasks as $task)
                            <x-modal modalId="editModal{{ $task->id }}"
                                formAction="{{ route('tasks.update', ['tasks' => $task->id]) }}"
                                formMethod="POST" modalTitle="Edit">
                                @method('PUT')
                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="employee_id">
                                    Employees </label>
                                <select class="form-control" id="employee_id{{ $employee->id }}" name="employee_id">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $task->employee_id == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle">
                                    Task </label>
                                    <input class="form-control" id="adminTitle{{ $task->id }}" name="task" type="text" value="{{ $task->task }}" />
                                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="status{{ $task->id }}">Status</label>
                                        <select class="form-control" id="status{{ $task->id }}" name="status" required>
                                            <option value="pending" {{ old('status', $task->status ?? 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="in-progress" {{ old('status', $task->status ?? '') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="completed" {{ old('status', $task->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>

                                </x-modal>
                            <x-modal modalId="deleteModal{{ $task->id }}"
                                formAction="{{ route('tasks.delete', $task->id) }}" formMethod="POST"
                                modalTitle="Delete {{$task->name}}">
                                @method('DELETE')
                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle">
                                    Are You Sure ? </label>

                            </x-modal>
                        @endforeach
                        {{ $dataTable->table(['class' => 'table  table-striped table-bordered table-sm fs--1 mb-0']) }}
                    </div>
                </div>
            </div>
    </section>

    <script>
        $(document).on('click', '.editTasks', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/tasks/' + id + '/edit',
                method: 'GET',
                success: function(response) {
                    $('#code' + id).val(response.code);
                    $('#adminTitle' + id).val(response.name);
                    $('#editModal' + id).modal('show');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

@endsection

@section('js')


<script>
    var columnTitleArr = window.columnTitleArr = [];

    window.createExportModalElements = function() {
        const exportModal = document.querySelector('.export-modal');

        columnTitleArr.forEach(element => {
            const div = document.createElement('div');
            div.classList.add('form-check');
            div.classList.add('col-5');

            const input = document.createElement('input');
            input.classList.add('form-check-input');
            input.type = 'checkbox';
            input.id = element;
            input.value = element;

            const label = document.createElement('label');
            label.classList.add('form-check-label');
            label.setAttribute('for', element);
            label.textContent = element;

            div.appendChild(input);
            div.appendChild(label);

            exportModal.appendChild(div);
        });
    }
    $('#related_table').on('page.dt', function() {
        $('.selected-item').text(window.LaravelDataTables['related_table'].rows({
            selected: true
        }).count());
        $('.selected-badge').text(window.LaravelDataTables['related_table'].rows({
            selected: true
        }).count());
    });

    var arrOfFilterBtn = [];
    var searchValues = [];


    // Select all th elements inside the thead of the table and skip the first two
    $('.useDataTable thead tr th').slice(1, -1).each(function(index) {
        var id = 'checkbox_' + index;
        // Get the inner text of the th element and push it to thTextArray
        arrOfFilterBtn.push({
            text: () => {
                return `<div class="d-flex align-items-center"> <input class="me-2" id="${id}" type="checkbox">
        <label for=""${id}"">  ${$(this).text()}  <label>

        </div>`
            },
            action: function(e, dt, node, config, cb) {
                var buttonElement = $(this.node());
                $('#' + id).prop('checked', function(_, oldProp) {
                    if (oldProp) {
                        window.LaravelDataTables['related_table'].columns(index +
                            2).search(
                            "").draw();
                        searchValues = searchValues.filter(item => item.Column_No !==
                            index + 2);
                    }
                    return !oldProp;
                });
            }
        });
    });
    function getCheckedCheckboxes() {
            const exportModal = document.querySelector('.export-modal');
            const checkboxes = exportModal.querySelectorAll('.form-check-input');
            const checkedCheckboxes = [];
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedCheckboxes.push(checkbox.value);
                }
            });
            return checkedCheckboxes;
        }

        let exportFormat;
        $(document).on("click", "#excelModalBtn", function() {
            exportFormat = $(this).data("exportformat");
        });

        $(document).on("click", "#pdfModalBtn", function() {
            exportFormat = $(this).data("exportformat");
        });

        $(document).on("click", "#csvModalBtn", function() {
            exportFormat = $(this).data("exportformat");
        });

        $(document).on('click','.exportSelected',function() {
            let SelectedRows = JSON.parse(localStorage.getItem('related_checkBoxIdsArray'));
            $("#SelectedRows").val(SelectedRows);
        });
        $(document).on("click", "#sendRequestBtn", function() {
            let selectedColumns = getCheckedCheckboxes();
            $("#exportFormatInput").val(exportFormat);
            $("#selectedColumnsInput").val(selectedColumns);
            $("#exportModalForm").submit();
        });


</script>
{!! str_replace(
    '"DataTable.render.select()"',
    'DataTable.render.select()',
    $dataTable->scripts(attributes: ['type' => 'module']),
) !!}

    {{-- Generating Link Request --}}
@endsection
