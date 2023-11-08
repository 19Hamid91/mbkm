@extends('main')
@section('title', 'SHOW')
@section('content')
    <div>
        <h1>Show Note</h1>

        <form>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" value="" readonly>
            </div>

            <div class="form-group">
                <label for="due">Due</label>
                <input type="text" class="form-control" id="due" value="" readonly>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" readonly></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" value="" readonly>
            </div>

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
        });
    </script>
@endsection