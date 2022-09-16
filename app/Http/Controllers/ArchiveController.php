<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archives = Archive::orderByDesc('id')
            ->get();

        return view('archive', ['archives' => $archives]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createArchive');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $archives = Archive::where('judul', 'like', '%' . $request->judul . '%')->orderByDesc('id')
            ->get();

        ob_start();
        foreach ($archives as $value) {
?>
            <tr>
                <td><?php echo $value->no; ?></td>
                <td><?php echo $value->kategori; ?></td>
                <td><?php echo $value->judul; ?></td>
                <td><?php echo $value->updated_at; ?></td>
                <td style="white-space: nowrap;">
                    <div>
                        <a href="#" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded text-base" onclick="deleteItem(<?php echo $value->id ?>)">Hapus</a>
                        <a href="<?php echo asset('/storage/pdfArchive/' . $value->file) ?>" target="_blank" rel="noopener" class="bg-yellow-500 hover:bg-yellow-700 text-black py-1 px-3 rounded text-base">Unduh</a>
                        <a href="/archive/<?php echo $value->id ?>" class="bg-cyan-500 hover:bg-cyan-700 text-white py-1 px-3 rounded text-base">Lihat
                            >></a>
                    </div>
                </td>
            </tr>
<?php
        }
        $embedHtml = ob_get_clean();

        if ($embedHtml == null || $embedHtml == '') {
            $embedHtml = '<tr><td colspan="5" class="text-center">Judul tidak ditemukan.<td/></tr>';
        }
        return $embedHtml;
    }

    public function store(Request $request)
    {
        $data = new Archive;

        // INSERTING PDF
        $file = $request->file('file');
        if (!empty($file)) {
            $file_name = date('ymdhis') . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs(
                'pdfArchive',
                $file_name,
                'public'
            );
        } else {
            $file_name = null;
        }


        $data->no = $request->no;
        $data->kategori = $request->kategori;
        $data->judul = $request->judul;
        $data->file = $file_name;
        $data->user_id = \Auth::user()->id;

        $data->save();

        return redirect('/archive');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function show(Archive $archive)
    {

        return view('showArchive', ['archive' => $archive]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function edit(Archive $archive)
    {
        return view('editArchive', ['archive' => $archive]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archive $archive)
    {
        // INSERTING PDF
        $file = $request->file('file');
        if (!empty($file)) {
            // DELETING OLD FILE FIRST
            Storage::disk('public')->delete('pdfArchive/' . $request->old_file);

            $file_name = date('ymdhis') . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs(
                'pdfArchive',
                $file_name,
                'public'
            );
            $archive->file = $file_name;
        } else {
            $file_name = null;
        }


        $archive->no = $request->no;
        $archive->kategori = $request->kategori;
        $archive->judul = $request->judul;
        $archive->user_id = \Auth::user()->id;

        $archive->save();

        return redirect('/archive');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archive $archive)
    {
        // DELETING IN FILES
        if (!empty($archive->file)) {
            Storage::disk('public')->delete('pdfArchive/' . $archive->file);
        }

        $archive->delete();

        return redirect('/archive');
    }
}
