<x-app-layout>
    <div class="py-12">
        <div class="row bg-white overflow-hidden shadow-sm rounded px-8 mx-auto py-12">
            <div class="col-md-12">
                <h3 style="font-size: 1.75rem!important">Arsip Surat</h3>
                <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan. <br> Klik "Lihat" pada kolom aksi
                    untuk menampilkan surat.</p>
            </div>
            <div class="col-md-12 mt-4">
                <form id="form-search" onsubmit="searchItem()">
                    <div class="row">
                        <div class="col-md-2 text-right mb-2">
                            <font class="text-xl">Cari Surat :</font>
                        </div>
                        <div class="col-md-8 mb-2">
                            <input
                                class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" name="judul" id="judul" placeholder="Search letter ...">
                        </div>
                        <div class="col-md-2 mb-2">
                            <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                                type="submit">Cari!</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12 mt-2">
                <div style="overflow-x:auto;">
                    <table class="table-auto table">
                        <thead>
                            <tr>
                                <th>Nomor Surat</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Waktu Pengarsipan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @foreach ($archives as $item)
                            <tr>
                                <td>{{$item->no}}</td>
                                <td>{{$item->kategori}}</td>
                                <td>{{$item->judul}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td style="white-space: nowrap;">
                                    <div>
                                        <a href="#"
                                            class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded text-base"
                                            onclick="deleteItem({{$item->id}})">Hapus</a>
                                        <a href="{{ asset('/storage/pdfArchive/'.$item->file) }}" target="_blank"
                                            rel="noopener"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-black py-1 px-3 rounded text-base">Unduh</a>
                                        <a href="/archive/{{$item->id}}"
                                            class="bg-cyan-500 hover:bg-cyan-700 text-white py-1 px-3 rounded text-base">Lihat
                                            >></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <a href="/archive/create"
                    class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Arsipkan
                    Surat..</a>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-xl" id="exampleModalLabel">Peringatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus arsip surat?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white py-1 px-3 rounded text-base"
                        data-bs-dismiss="modal">Close</button>
                    <form id="delete-form" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded text-base">Iya!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="success" tabindex="-1" aria-labelledby="successLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-xl" id="successLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Data berhasil diarsipkan!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white py-1 px-3 rounded text-base"
                        data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    {{-- MODAL --}}

    <script>
        const searchItem = () => {
            var formData = {
                _token: "{{ csrf_token() }}",
                judul: $("#judul").val(),
              };
          
              $.ajax({
                type: "POST",
                url: "/archive/search",
                data: formData,
                encode: true,
              }).done(function (data) {
                // console.log(data);
                $('#table-body').html(data);
              }).fail(function(data)  {
                console.log(data);
              });
          
            event.preventDefault();
        }

        const deleteItem = (key) => {
            //EMBED ID
            $('#delete-form').attr('action', '/archive/' + key);
            $('#exampleModal').modal('show');
        }
    </script>
</x-app-layout>