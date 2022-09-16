<x-app-layout>
    <style>
        .pdfobject-container {
            height: 30rem;
            border: 1rem solid rgba(0, 0, 0, .1);
        }
    </style>
    <div class="py-12">
        <div class="row bg-white overflow-hidden shadow-sm rounded px-8 mx-auto py-12">
            <div class="col-md-12 mb-4">
                <h3 style="font-size: 1.75rem!important">Arsip Surat >> Lihat</h3>
                <p>Nomor : {{$archive->no}}</p>
                <p>Kategori : {{$archive->kategori}}</p>
                <p>Judul : {{$archive->judul}}</p>
                <p>Waktu Diunggah : {{$archive->updated_at}}</p>
            </div>
            <div class="col-md-12 mt-2">
                <div id="example1">
                    <iframe src='{{  asset('/laraview/#../storage/pdfArchive/' . $archive->file) }}' width="800"
                        height="678">
                        <p>This browser does not support PDF!</p>
                    </iframe>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <a href="/archive"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded me-2">
                            {{'<<'}} Kembali
                        </a>
                        <a href="{{ asset('/storage/pdfArchive/'.$archive->file) }}" target="_blank" rel="noopener"
                            class="bg-yellow-500 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded me-2">
                            Unduh
                        </a>
                        <a href="/archive/{{$archive->id}}/edit"
                            class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded me-2">
                            Edit / Ganti File
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.8/pdfobject.min.js"
        integrity="sha512-MoP2OErV7Mtk4VL893VYBFq8yJHWQtqJxTyIAsCVKzILrvHyKQpAwJf9noILczN6psvXUxTr19T5h+ndywCoVw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        PDFObject.embed("{{$pathPdf}}", "#example1");
    </script> --}}
</x-app-layout>