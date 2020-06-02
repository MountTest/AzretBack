<table class="table">
    <thead>
    <th>ФИО</th>
    <th>Адрес</th>
    <th>Роль</th>
    <th>Статус</th>
    <th>Действия</th>
    </thead>
    <tbody id="employee_table">
    @foreach($employees as $employee)
        <tr id="{{ $employee->id }}">
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->address}}</td>
            <td>{{ $employee->role->name }}</td>
            <td>
                <select class="browser-default custom-select slc" name="role_id">
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" data-id="{{$employee->id}}"
                                data-role="{{ $employee->role_id }}"
                                {{ $employee->status_id == 2 }} ? selected :> {{ $status->status }}</option>
                    @endforeach
                </select>
                {{--                {{ $employee->status->status }}--}}
            </td>
            <td>
                    <button class="btn delete_record" style="background-color: darkred; color: white" data-id="{{ $employee->id }}"><i class="fa fa-close"></i>
                    </button>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
