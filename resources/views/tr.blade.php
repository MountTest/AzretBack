<tr>
    <td>{{ $employee->name }}</td>
    <td>{{ $employee->address}}</td>
    <td>{{ $employee->role->name }}</td>
    <td>
        <select class="browser-default custom-select" name="role_id">
            @foreach($statuses as $status)
                <option value="{{ $employee->id }}"> {{ $status->status }}</option>
            @endforeach
        </select>
    </td>
    <td><button class="btn" style="background-color: darkred; color: white"><i class="fa fa-close"></i></button></td>
</tr>
