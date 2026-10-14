{{-- Menampilkan pesan error dari session jika ada --}}
@if (session('error'))

    {{-- Kotak pesan error --}}
    <div style="background-color: #f8d7da; color: #f03548; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
        {{-- Menampilkan isi pesan error --}}
        {{ session('error') }}
    </div>
@endif

{{-- Menampilkan pesan sukses dari session jika ada --}}
@if (session('success'))

    {{-- Kotak pesan sukses --}}
    <div style="background-color: #d4edda; color: #28db52; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
        {{-- Menampilkan isi pesan sukses --}}
        {{ session('success') }}
    </div>
@endif

{{-- Mengecek apakah terdapat error dari proses validasi --}}
@if ($errors->any())

    {{-- Kotak untuk menampilkan daftar error validasi --}}
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px;">

        {{-- Membuat daftar error --}}
        <ul style="margin: 0; padding-left: 20px;">

            {{-- Mengambil dan menampilkan semua pesan error --}}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>
    </div>
@endif