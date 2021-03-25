

 <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this Comment?');" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
