<x-mail::message>
    <center>
        <h3>Anda Telah Dipilih Menjadi Pembimbing Lapangan</h3>
    </center>
    <p>Login dengan email dan password berikut</p>
    <p>email: {{ $email }}</p>
    <p>pass: {{ $pass }}</p>
    <p>Tekan tombol dibawah untuk menuju ke website</p>
<x-mail::button :url="$url">
LINK
</x-mail::button>

</x-mail::message>
