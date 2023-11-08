@extends('main')
@section('title', 'EDIT')
@section('content')
    <div>
        <h1>Edit Note</h1>

        <form id="form" action="" method="POST" style="display: inline-block;">
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" value="">
            </div>

            <div class="form-group">
                <label for="due">Due</label>
                <input type="text" class="form-control" id="due" value="">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description"></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" value="">
            </div>

            <button type="button" class="btn btn-primary" id="update-button">Update</button>
            <a href="/index" class="btn btn-secondary">Back</a>
        </form>
    </div>
@section('script')
    
@endsection
    <script>
        $(document).ready(function () {
            var currentUrl = window.location.href;
            var urlParts = currentUrl.split('/');
            var id = urlParts[urlParts.length - 1];
            $('#form').attr("action", "http://localhost:8000/api/notes/"+id);

            $.ajax({
                url: '/api/notes/'+id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    // Memasukkan data ke dalam elemen HTML
                    $('#title').val(data.title);
                    $('#due').val(data.due);
                    $('#description').text(data.description);
                    $('#status').val(data.status);
                },
                error: function (error) {
                    console.error('Terjadi kesalahan:', error);
                }
            });

            $('#update-button').click(function() {
                    var id = urlParts[urlParts.length - 1];
                    updateNote(id);
                    });

            function updateNote(id) {
                $.ajax({
                    url: '/api/notes/' + id,
                    type: 'PUT',
                    data: "formData",
                    dataType: 'json',
                    success: function (data) {
                        // Jika penghapusan berhasil, mereload halaman
                        location.reload();
                    },
                    error: function (error) {
                        console.error('Terjadi kesalahan:', error);
                    }
                });
            }
        });
    </script>
@endsection