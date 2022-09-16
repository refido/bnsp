<x-app-layout>
    <div class="py-12">
        <div class="row bg-white overflow-hidden shadow-sm rounded px-8 mx-auto py-12">
            <div class="col-md-12 mb-4">
                <h3 style="font-size: 1.75rem!important">Arsip Surat >> Unggah</h3>
                <p>Unggah yang telah terbit pada form ini untuk diarsipkan.</p>
                <p>Catatan:</p>
                <p class="ms-3">- Gunakan file berformat PDF</p>
            </div>
            <form action="/archive" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="col-md-12 mt-2">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <font class="font-bold">Nomor Surat</font>
                                </div>
                                <div class="col-md-10">
                                    <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="no" id="no" placeholder="2022/PD1/TU/001.." required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <font class="font-bold">Kategori</font>
                                </div>
                                <div class="col-md-10">
                                    <select class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="kategori" id="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Undangan">Undangan</option>
                                        <option value="Pengumuman">Pengumuman</option>
                                        <option value="Nota Dinas">Nota Dinas</option>
                                        <option value="Pemberitahuan">Pemberitahuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <font class="font-bold">Judul</font>
                                </div>
                                <div class="col-md-10">
                                    <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="judul" id="judul" placeholder="Nota Dinas" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <font class="font-bold">File Surat(PDF)</font>
                                </div>
                                <div class="col-md-10">
                                    <input class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="file" name="file" id="file" accept="application/pdf,application/vnd.ms-excel" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <a href="/archive" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded me-2">
                                {{'<<'}} Kembali
                            </a>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded me-2" type="submit">Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>