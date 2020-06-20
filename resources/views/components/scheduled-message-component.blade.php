<tr>
    <td>{{ $message->time }}</td>
    <td>{{ $message->name }}</td>
    <td>{{ $message->message }}</td>
    <td>
        <form action="{{ route('admin.scheduled.destroy', [$message->webinar, $message]) }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </td>
</tr>