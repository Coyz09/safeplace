<form action="{{ route('barangay.destroy',$id) }}" method="POST">
      <a href="{{ route('barangay.edit', $id)}}" title="Edit" class="edit"><i class='bx bxs-pencil' ></i></a>
            @csrf
            @method('DELETE')
      <button class="delete"><i class="bx bxs-trash-alt" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
</form> 


