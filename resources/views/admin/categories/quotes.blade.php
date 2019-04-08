@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <span style="font-size: 20px;color:#4dc0b5;"><strong>{{ $category_name }} Quotes</strong></span>
                        <div style="float: right;margin-top: -8px !important;margin-right: 10px;" class="row">
                            <a href="{{ route('admin.categories') }}"
                                    class="mx-sm-3 mb-2 btn btn-outline-info btn-sm">Back
                            </a>
                            <button type="button" class="btn btn-info btn-sm full-title" data-toggle="modal" data-target="#addQuote" data-toggle="tooltip" data-title="Add Quote"><i class="fa fa-plus"></i></button>

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

                    <div class="panel-body">


                        <table class="table table-bordered table-hover table-responsive-lg">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Quote Ar</th>
                                <th>Quote En</th>
                                <th>Author Ar</th>
                                <th>Author En</th>
                                <th>Tags</th>
                                <th>Favorite</th>
                                <th>Choices</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($quotes as $quote)
                                <tr>
                                    <th scope="row">{{ $quote->id }}</th>
                                    <td class="quote_ar">{{ $quote->quote_ar }}</td>
                                    <td class="quote_en">{{ $quote->quote_en }}</td>
                                    <td class="author_ar">{{ $quote->author_ar }}</td>
                                    <td class="author_en">{{ $quote->author_en }}</td>
                                    <td class="tags">{{ $quote->tags }}</td>
                                    <td class="fave">{{ $quote->fave }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm delete-button" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete Quote"
                                                data-id="{{ $quote->id }}"><i class="fa fa-times"></i></button>

                                        <button class="btn btn-info btn-sm full-title edit-quote" data-toggle="modal"
                                                data-target="#editQuote" data-toggle="tooltip" data-title="Edit Quote" data-id="{{ $quote->id }}"
                                                data-quote_ar="{{ $quote->quote_ar }}"
                                                data-quote_en="{{ $quote->quote_en }}"
                                                data-author_ar="{{ $quote->author_ar }}"
                                                data-author_en="{{ $quote->author_en }}"
                                                data-tags="{{ $quote->tags }}"
                                        ><i class="fa fa-edit"></i></button>

                                        <a href="{{ route('admin.quotes.show',['id'=>$quote->id]) }}" class="btn btn-{{ !$quote->show ?'warning':'success' }} btn-sm full-title"  data-toggle="tooltip" data-title="{{ !$quote->show ?'hidden':'shown' }}" ><i class="fa fa-{{ !$quote->show ?'lock':'unlock' }}"></i></a>

                                    </td>
                                </tr>
                            @empty
                                <tr>

                                    <td colspan="8">No Quotes are Provided</td>

                                </tr>

                            @endforelse
                            </tbody>
                        </table>
                        @if(count($quotes))
                            {{ $quotes->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addQuote" class="modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Quote</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.post-quote') }}">
                    <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label for="quote_ar" class="col-form-label">Quote AR:</label>
                            <input  dir="rtl" type="text" name="quote_ar" class="form-control" id="quote_ar" value="{{ old('quote_ar') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="quote_en" class="col-form-label">Quote EN:</label>
                            <input type="text" name="quote_en" class="form-control" id="quote_en"  value="{{ old('quote_en') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="author_ar" class="col-form-label">Author AR:</label>
                            <input  dir="rtl" type="text" name="author_ar" class="form-control" id="author_ar" value="{{ old('author_ar') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="author_en" class="col-form-label">Author EN:</label>
                            <input type="text" name="author_en" class="form-control" id="author_en"  value="{{ old('author_en') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tags" class="col-form-label">Tags:</label>
                            <input type="text" name="tags" class="form-control" id="tags" value="{{ old('tags') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="col-form-label">Category:</label>
                            <select name="category_id" class="form-control" required>
                                @foreach($categories as $category)
                                <option  value="{{ $category->id }}">{{ $category->name_ar .'-'. $category->name_en }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="show" class="col-form-label">Show:</label>
                            <select name="show" class="form-control" required>
                                <option {{ old('show') && old('show') == 1 ? 'selected':'' }} value="1">Show</option>
                                <option {{ old('show') && old('show') == 0 ? 'selected':'' }} value="0">Hide</option>
                            </select>

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
    <div id="editQuote" class="modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Quote</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.update-quote') }}">
                    <div class="modal-body">

                        @csrf
                        <input type="hidden" name="id" class="form-control" id="edit_id" required>

                        <div class="form-group">
                            <label for="edit_quote_ar" class="col-form-label">Quote AR:</label>
                            <input  dir="rtl" type="text" name="quote_ar" class="form-control" id="edit_quote_ar"  required>
                        </div>
                        <div class="form-group">
                            <label for="edit_quote_en" class="col-form-label">Quote EN:</label>
                            <input type="text" name="quote_en" class="form-control" id="edit_quote_en"   required>
                        </div>
                        <div class="form-group">
                            <label for="edit_author_ar" class="col-form-label">Author AR:</label>
                            <input  dir="rtl" type="text" name="author_ar" class="form-control" id="edit_author_ar"  required>
                        </div>
                        <div class="form-group">
                            <label for="edit_author_en" class="col-form-label">Author EN:</label>
                            <input type="text" name="author_en" class="form-control" id="edit_author_en"  required>
                        </div>
                        <div class="form-group">
                            <label for="edit_tags" class="col-form-label">Tags:</label>
                            <input type="text" name="tags" class="form-control" id="edit_tags"  required>
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
            $(document).on('click', '.edit-quote', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var quote_ar = $(this).data('quote_ar');
                var quote_en = $(this).data('quote_en');
                var author_ar = $(this).data('author_ar');
                var author_en = $(this).data('author_en');
                var tags = $(this).data('tags');

                $('#edit_quote_ar').empty().val(quote_ar);
                $('#edit_quote_en').empty().val(quote_en);
                $('#edit_author_ar').empty().val(author_ar);
                $('#edit_author_en').empty().val(author_en);
                $('#edit_tags').empty().val(tags);
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
                            url: "{{ route('admin.quotes.delete') }}",
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
