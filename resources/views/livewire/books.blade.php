<div>
    <?php  $increment = 1 ?>

    <div class="content-wrapper " style="margin-top: 12rem">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Books</h1>
                    </div>
                    <div class="col-sm-6" style="align-self: center">
                        <ol  class="breadcrumb float-sm-right">
                            <a wire:click="addNewBook" class="btn btn-block btn-success"><span>Add New Book</span></a>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if(session('message'))
                            <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                                <i class="bi-check-circle-fill"></i>
                                <strong class="mx-2">Success!</strong> {{session('message')}}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                                <i class="bi-check-circle-fill"></i>
                                <strong class="mx-2">Error!</strong> {{session('error')}}
                            </div>
                        @endif

                        {{-- Edit Hotel Model Start--}}

                        <!-- Modal -->
                        <div wire:ignore.self class="modal fade" id="showBooksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" >
                                            <!-- left column -->
                                            {{--Hotel Details Start--}}
                                            <div class="col-md-12">
                                                <div class="card card-warning">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Book Details</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="booktitle">Book Title</label>
                                                                <input type="text" min="0" id="booktitle" name="booktitle" class="form-control" wire:model.defer="booktitle">
                                                                @error('booktitle') <span style="color: red"> {{$message}}</span> @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="author">Auther Name</label>
                                                                <input type="text" min="1" id="author" name="author" class="form-control" wire:model.defer="author">
                                                                @error('author') <span style="color: red"> {{$message}}</span> @enderror
</div>
                                                            <div class="form-group">
                                                                <label for="edition">Edition</label>
                                                                <input type="text" min="0" id="edition" name="edition" class="form-control" wire:model.defer="edition">
                                                                @error('edition') <span style="color: red"> {{$message}}</span> @enderror
</div>
                                                            <div class="form-group">
                                                                <label for="number_of_Pages">Number Of Pages</label>
                                                                <input type="number" min="0" id="number_of_Pages" name="number_of_Pages" class="form-control" wire:model.defer="number_of_Pages">
                                                                @error('number_of_Pages') <span style="color: red"> {{$message}}</span> @enderror
</div>
                                                        </form>

                                                    </div>
                                                    <!-- /.card-header -->
                                                </div>
                                            </div>
                                            {{--Hotel Details End--}}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" wire:click.prevent="addEditBook">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Edit Hotel Model End--}}

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Books Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Num.</th>
                                        <th>Book Title</th>
                                        <th>Author Name</th>
                                        <th>Edition</th>
                                        <th>Number Of Pages</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <td>{{$increment}}</td>
                                            <td>{{$book->title}}</td>
                                            <td>{{$book->author}}</td>
                                            <td>{{$book->edition}}</td>
                                            <td>{{$book->no_of_pages}}</td>
                                            <td>
                                                @if($book->status == '1')
                                                    <a wire:click.prevent="status({{$book->id}},1)" class="btn btn-block btn-success"><span>Active</span></a>
                                                @else
                                                    <a wire:click.prevent="status({{$book->id}},0)" class="btn btn-block btn-secondary"><span>Deactive</span></a>
                                                @endif
                                            </td>
                                            <td>
                                                <a wire:click.prevent="editBook({{$book->id}})" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                                                <a wire:click.prevent="deleteBook({{$book->id}})" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></a>
                                            </td>

                                                <?php  $increment += 1 ?>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Num.</th>
                                        <th>Book Title</th>
                                        <th>Author Name</th>
                                        <th>Edition</th>
                                        <th>Number Of Pages</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div>
                                    {{--                                        {!! $hotels->links() !!}--}}
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @push('books-scripts')
        <script>
            window.addEventListener('showBooksEvent', event=>{
                $('#showBooksModal').modal('show');
            });

            window.addEventListener('hideBooksEvent', event=>{
                $('#showBooksModal').modal('hide');
            });
        </script>
    @endpush
</div>



