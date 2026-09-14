<?php

namespace App\Http\Controllers;

use App\Models\TemplateSertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateSertifikatController extends Controller
{
    public function index()
    {
        $templates = TemplateSertifikat::latest()->get();

        return view('template-sertifikat.index', compact('templates'));
    }

    public function create()
    {
        return view('template-sertifikat.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $this->storeUploadedFiles($request, $data);

        TemplateSertifikat::create($data);

        return redirect()
            ->route('template-sertifikat.index')
            ->with('success', 'Template sertifikat berhasil dibuat!');
    }

    public function edit(TemplateSertifikat $templateSertifikat)
    {
        return view('template-sertifikat.edit', compact('templateSertifikat'));
    }

    public function update(Request $request, TemplateSertifikat $templateSertifikat)
    {
        $data = $this->validatedData($request);

        $this->storeUploadedFiles($request, $data, $templateSertifikat);
        $templateSertifikat->update($data);

        return redirect()
            ->route('template-sertifikat.index')
            ->with('success', 'Template sertifikat berhasil diperbarui!');
    }

    public function destroy(TemplateSertifikat $templateSertifikat)
    {
        $this->deleteFiles($templateSertifikat);
        $templateSertifikat->delete();

        return redirect()
            ->route('template-sertifikat.index')
            ->with('success', 'Template sertifikat berhasil dihapus!');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama_template' => 'required|string|max:255',
            'background' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'logo_sekolah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ttd_kepsek' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_kepsek' => 'nullable|string|max:255',
            'nip_kepsek' => 'nullable|string|max:255',
            'ttd_panitia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_panitia' => 'nullable|string|max:255',
            'nip_panitia' => 'nullable|string|max:255',
            'font_size_nama' => 'nullable|integer|min:10|max:72',
            'font_size_detail' => 'nullable|integer|min:8|max:36',
            'perataan_teks' => 'nullable|in:kiri,tengah,kanan',
        ]);
    }

    private function storeUploadedFiles(
        Request $request,
        array &$data,
        ?TemplateSertifikat $template = null
    ): void {
        $files = [
            'background' => ['directory' => 'template/background', 'column' => 'background_path'],
            'logo_sekolah' => ['directory' => 'template/logo', 'column' => 'logo_sekolah_path'],
            'ttd_kepsek' => ['directory' => 'template/ttd', 'column' => 'ttd_kepsek_path'],
            'ttd_panitia' => ['directory' => 'template/ttd', 'column' => 'ttd_panitia_path'],
        ];

        foreach ($files as $input => $config) {
            if (!$request->hasFile($input)) {
                continue;
            }

            if ($template && $template->{$config['column']}) {
                Storage::disk('public')->delete($template->{$config['column']});
            }

            $data[$config['column']] = $request->file($input)->store($config['directory'], 'public');
        }

        unset($data['background'], $data['logo_sekolah'], $data['ttd_kepsek'], $data['ttd_panitia']);
    }

    private function deleteFiles(TemplateSertifikat $template): void
    {
        foreach (['background_path', 'logo_sekolah_path', 'ttd_kepsek_path', 'ttd_panitia_path'] as $column) {
            if ($template->{$column}) {
                Storage::disk('public')->delete($template->{$column});
            }
        }
    }
}
