@extends('main.app')
@section('title')
        Employees | MyCash
@endsection
@section('css')
@endsection
@section('content')
    <section class="table-sec pt-3">
        <div class="container px-2 px-md-5">
            <div class="align-items-start border-bottom flex-column">
                <x-first-head label="Employees Tabel" icon="database" />

                <button class="btn-primary btn  border" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Create</button>

                <x-modal buttonText="Create" modalId="exampleModal"
                    formAction="{{ route('employee.create') }}" formMethod="POST" modalTitle="Create">
                    @csrf

                    <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> First Name </label>
                    <input class="form-control" id="adminTitle" name="first_name" type="text" placeholder="Ahmed"
                        required />
                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Last Name </label>
                    <input class="form-control" id="last" name="last_name" type="text" placeholder="mohamed"
                        required />
                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="adminTitle"> Salary </label>
                    <input class="form-control" id="adminTitle" name="salary" type="number" placeholder="231321"
                        required />

                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="manager_id">Manager</label>
                        <select class="form-control" id="manager_id" name="manager_id">
                            <option value="">-- Select Manager --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="department_id"> Department </label>
                        <select class="form-control" id="department_id" name="department_id">
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>

                        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="image">Upload Image</label>
                        <input class="form-control" id="image" name="image" type="file" />
                </x-modal>
                <br>
            </div>

            {{-- <x-import-form action="{{ route('reference.import-File') }}" method="POST">
                (name , code)
            </x-import-form> --}}

            <div class="card">
                <div class="container">
                    <div class="card-body">

                        @foreach ($employees as $employee)
                           <x-modal modalId="editModal{{ $employee->id }}"
                                formAction="{{ route('employee.update', ['employee' => $employee->id]) }}"
                                formMethod="POST" modalTitle="Edit Employee">
                                @method('PUT')
                                @csrf

                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="first_name">
                                    First Name </label>
                                <input class="form-control" id="first_name{{ $employee->id }}" name="first_name" type="text" value="{{ $employee->first_name }}" />

                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="last_name">
                                    Last Name </label>
                                <input class="form-control" id="last_name{{ $employee->id }}" name="last_name" type="text" value="{{ $employee->last_name }}" />

                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="salary">
                                    Salary </label>
                                <input class="form-control" id="salary{{ $employee->id }}" name="salary" type="number" value="{{ $employee->salary }}" />

                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="manager_id">
                                    Manager </label>
                                <select class="form-control" id="manager_id{{ $employee->id }}" name="manager_id">
                                    <option value="">Select Manager</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $employee->manager_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="department_id">
                                    Department </label>
                                <select class="form-control" id="department_id{{ $employee->id }}" name="department_id">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="image">
                                    Image </label>
                                <input class="form-control" id="image{{ $employee->id }}" name="image" type="file" value="{{ $employee->image }}" />

                                <button type="submit" class="btn btn-primary">Update</button>
                        </x-modal>
                            <x-modal modalId="deleteModal{{ $employee->id }}"
                                formAction="{{ route('employee.delete', $employee->id) }}" formMethod="POST"
                                modalTitle="Delete {{$employee->name}}">
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
        $(document).on('click', '.editEmployee', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/employee/' + id + '/edit',
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
