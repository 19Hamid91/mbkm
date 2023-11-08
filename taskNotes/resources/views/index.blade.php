@extends('main')
@section('title', 'INDEX')
@section('content')
    <div>
        <h1>Data dari API</h1>
        <ul id="data-list"></ul>
        <table id="data-notes" class="table">
            <tr>
                <th>Title</th>
                <th>Due</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </table>
    </div>
@endsection

@section('script')
    <script>
        // Menggunakan jQuery untuk melakukan permintaan Ajax
        $(document).ready(function () {
            $.ajax({
                url: '/api/notes', // Sesuaikan dengan endpoint API Anda
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var dataNotes = $('#data-notes');
                    $.each(data, function (index, item) {
                    dataNotes.append('<tr>' +
                        '<td>' + item.title + '</td>' +
                        '<td>' + item.due + '</td>' +
                        '<td>' + item.description + '</td>' +
                        '<td>' + item.status + '</td>' +
                        '<td>' +
                            '<a href="/show/' + item.id + '" class="btn btn-primary show-button">Show</a>' +
                            '<a href="/edit/' + item.id + '"class="btn btn-warning edit-button">Edit</a>' +
                            '<button class="btn btn-danger delete-button" data-id="' + item.id + '">Hapus</button>' +
                        '</td>' +
                        '</tr>'
                    );
                });

                $('.delete-button').click(function() {
                    var id = $(this).data('id');
                    deleteNote(id);
                    });
                },
                error: function (error) {
                    console.error('Terjadi kesalahan:', error);
                }
            });

            function deleteNote(id) {
                $.ajax({
                    url: '/api/notes/' + id,
                    type: 'DELETE',
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