@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <span style="font-size: 20px;color:#4dc0b5;"><strong>Categories</strong></span>
                        <div style="float: right;margin-top: -8px !important;margin-right: 10px;" class="row">
                            <button type="button" class="btn btn-info btn-sm full-title" data-toggle="modal" data-target="#addCategory" data-toggle="tooltip" data-title="Add Category"><i class="fa fa-plus"></i></button>

                            <form class="mx-sm-3 mb-2 form-inline">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-search"></i></div>
                                        </div>
                                        <input type="text" name="name" id="name" placeholder="Search"
                                               class="form-control form-control-sm"></div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="panel-body text-center">


                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name AR</th>
                                <th>Name EN</th>
                                <th>Color</th>
                                <th>Icon</th>
                                <th>Choices</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($parents as $parent)
                                <tr>
                                    <th scope="row">{{ $parent->id }}</th>
                                    <td class="name_ar">{{ $parent->name_ar }}</td>
                                    <td class="name_en">{{ $parent->name_en }}</td>
                                    <td class="color" style="background-color: {{ $parent->color }} ">{{ $parent->color }}</td>
                                    <td class="icon"><img src="{{ strpos($parent->icon,'http')?$parent->icon:asset($parent->icon) }}" width="40px"></td>
                                    <td>

                                            <a href="{{ route('admin.quotes',['id'=>$parent->id]) }}" class="btn btn-info btn-sm full-title" data-toggle="tooltip" data-title="Show Quotes" ><i class="fa fa-list-alt"></i></a>
                                            <button class="btn btn-info btn-sm full-title edit-category" data-toggle="modal"
                                               data-target="#editCategory" data-toggle="tooltip" data-title="Edit Category" data-id="{{ $parent->id }}"
                                               data-name_ar="{{ $parent->name_ar }}"  data-name_en="{{ $parent->name_en }}" data-color="{{ $parent->color }}"
                                            ><i class="fa fa-edit"></i></button>

                                        <button class="btn btn-danger btn-sm delete-button" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete Category"
                                                data-id="{{ $parent->id }}"><i class="fa fa-times"></i></button>
                                         <a href="{{ route('admin.categories.show',['id'=>$parent->id]) }}" class="btn btn-{{ !$parent->show ?'warning':'success' }} btn-sm full-title"  data-toggle="tooltip" data-title="{{ !$parent->show ?'hidden':'shown' }}" ><i class="fa fa-{{ !$parent->show ?'lock':'unlock' }}"></i></a>

                                    </td>
                                </tr>
                            @empty
                                <tr>

                                    <td colspan="5">No Categories are Provided</td>

                                </tr>

                            @endforelse
                            </tbody>
                        </table>
                        @if(count($parents))
                            {{ $parents->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="addCategory" class="modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.post-category') }}">
                <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label for="name_ar" class="col-form-label">Name AR:</label>
                            <input  dir="rtl" type="text" name="name_ar" class="form-control" id="name_ar" value="{{ old('name_ar') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name_en" class="col-form-label">Name EN:</label>
                            <input type="text" name="name_en" class="form-control" id="name_en"  value="{{ old('name_en') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-form-label">Color:</label>
                            <input type="text" name="color" class="form-control" id="color" value="{{ old('color') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="show" class="col-form-label">Show:</label>
                            <select name="show" class="form-control" required>
                                <option {{ old('show') && old('show') == 1 ? 'selected':'' }} value="1">Show</option>
                                <option {{ old('show') && old('show') == 0 ? 'selected':'' }} value="0">Hide</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="icon" class="col-form-label">Icon:</label>
                            <input type="file" name="icon" class="form-control" id="icon" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    <div id="editCategory" class="modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.update-category') }}">
                    <div class="modal-body">

                        @csrf
                        <input type="hidden" name="id" class="form-control" id="edit_id" required>

                        <div class="form-group">
                            <label for="edit_name_ar" class="col-form-label">Name AR:</label>
                            <input  dir="rtl" type="text" name="name_ar" class="form-control" id="edit_name_ar" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_name_en" class="col-form-label">Name EN:</label>
                            <input type="text" name="name_en" class="form-control" id="edit_name_en"   required>
                        </div>
                        <div class="form-group">
                            <label for="edit_color" class="col-form-label">Color:</label>
                            <input type="text" name="color" class="form-control" id="edit_color" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>



@endsection
@section('scripts')

    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('click', '.edit-category', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var name_ar = $(this).data('name_ar');
                var name_en = $(this).data('name_en');
                var color = $(this).data('color');

                $('#edit_name_ar').empty().val(name_ar);
                $('#edit_name_en').empty().val(name_en);
                $('#edit_color').empty().val(color);
                $('#edit_id').empty().val(id);

            });
            $(document).on('click', '.delete-button', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.categories.delete') }}",
                            data: {id: id},
                            cache: false,
                            success: function (data, textStatus, xhr) {
                                if (data.error) {
                                    Swal.fire({
                                        position: 'center',
                                        type: 'error',
                                        title: 'Error!',
                                        text: data.error,
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    $('.swal2-container').css('z-index', '30000');
                                } else {
                                    if (xhr.status == 200) {
                                        Swal.fire({
                                            position: 'center',
                                            type: 'success',
                                            title: 'Success!',
                                            text: data.success,
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                        $('.swal2-container').css('z-index', '30000');
                                        setTimeout(function () {
                                            location.reload();
                                        }, 2500);
                                    }
                                }

                            },

                        });
                    }
                })
            });


        });
    </script>
@endsection
