<tr>
    <td>{{ $cta->title }}</td>
    <td>{{ $cta->description }}</td>
    <td>{{ $cta->delay }}</td>
    <td>{{ $cta->duration }}</td>
    <td>{{ $cta->button_url }}</td>
    <td>{{ $cta->button_text }}</td>
    <td>
        <form action="{{ route('admin.cta.destroy', [$cta]) }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </td>
</tr>