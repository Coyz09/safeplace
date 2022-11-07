{{-- <td align="center"><a href="{{route('policestation.edit',$id) }}">
            <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px"></a></i></td>

          <td align="center">
            <form action="{{route('policestation.destroy',$id) }}" method = "POST">
            @csrf
            @method('DELETE')
            <button><i class="fa fa-trash-o" style="font-size:24px; color:red"></i></button>
            </form>
          </td> --}}


<form action="{{ route('policestation.destroy',$id) }}" method="POST">
      <a href="{{ route('policestation.edit', $id)}}" title="Edit" class="edit"><i class='bx bxs-pencil' ></i></a>
            @csrf
            @method('DELETE')
      <button class="delete"><i class="bx bxs-trash-alt" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
</form> 



