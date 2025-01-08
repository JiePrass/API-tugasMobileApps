<?php 

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index()
    {
        try {
            $siswa = DB::table('siswa')->select('nis', 'nama')->get();

            return response()->json([
                'success' => true,
                'data' => $siswa,
                'message' => 'Data siswa berhasil diambil.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required|max:255',
        ]);

        try {
            $inserted = DB::table('siswa')->insert([
                'nis' => $request->nis,
                'nama' => $request->nama,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil disimpan.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete($nis)
    {
        try {
            // Mencari siswa berdasarkan NIS
            $siswa = DB::table('siswa')->where('nis', $nis)->first();

            if (!$siswa) {
                // Jika siswa tidak ditemukan
                return response()->json([
                    'success' => false,
                    'message' => 'Data siswa tidak ditemukan.'
                ], 404);
            }

            // Menghapus data siswa
            DB::table('siswa')->where('nis', $nis)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil dihapus.'
            ], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $nis)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|max:255',
        ]);

        try {
            // Mencari siswa berdasarkan NIS
            $siswa = DB::table('siswa')->where('nis', $nis)->first();

            if (!$siswa) {
                // Jika siswa tidak ditemukan
                return response()->json([
                    'success' => false,
                    'message' => 'Data siswa tidak ditemukan.'
                ], 404);
            }

            // Mengupdate data siswa
            DB::table('siswa')->where('nis', $nis)->update([
                'nama' => $request->nama,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil diupdate.'
            ], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
