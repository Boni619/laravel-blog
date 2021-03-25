

 <form action="{{ route('posts.destroy',$post->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')


                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this Post?');" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
