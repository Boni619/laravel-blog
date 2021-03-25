

 <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}"><i class="far fa-edit"></i></a>


                                    @csrf
                                    @method('DELETE')


                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
