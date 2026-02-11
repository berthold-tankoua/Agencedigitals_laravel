<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IaImage;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Image;

class BotController extends Controller
{
    //
    public function ProductList(){

        $datas = Product::where('status',1)->latest()->get();
                return response()->json([
            'datas' => $datas
        ]);
    }

    public function ProductImgList(){

        $datas = IaImage::latest()->get();
        return response()->json([
            'datas' => $datas
        ]);
    }

    public function ProductItem($id){

        $data = IaImage::where('id',$id)->first();
        return response()->json([
            'data' => $data->only(['id','old_image','store_id'])
        ]);
    }

    public function CompressImageUpdate(Request $request, $id){
        // $url= 'https://i.ibb.co/9mrtBWNK/file.jpg';
        $url= $request->fileurl;
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0'
        ])->get($url);

        if (!$response->successful()) {
            return response()->json(['error' => 'Échec du téléchargement'], 400);
        }

        $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
        $filename = uniqid() . '.' . $extension;

        $directory = 'upload/medias';
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory . '/' . $filename;

        try {
            $image = Image::make($response->body());
            $image->resize(615, 405);
            $image->save($path, 95, $extension);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur Intervention : ' . $e->getMessage()], 500);
        }

        IaImage::findOrFail($id)->update([
            'new_image' => 'upload/medias/' . $filename,
            'status' => 2,
            'img_status' => 'Image Modifiée',
            'updated_at' => now()
        ]);

        // Fonction provisoire juste pour les tests
        $item=IaImage::where('id',$id)->first();

            Product::findOrFail($item->product_id)->update([
                'product_thambnail' => $item->new_image,
            ]);

        return response('success');
    }

    public function NoCompressImageUpdate(Request $request,$id){
        // $url= 'https://i.ibb.co/9mrtBWNK/file.jpg';
        $url= $request->fileurl;
        $response = Http::get($url);

        if (!$response->successful()) {
            return response()->json(['error' => 'Échec du téléchargement'], 400);
        }

        $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
        $filename = uniqid() . '.' . $extension;

        $path = 'upload/medias/' . $filename;

        file_put_contents($path, $response->body());
        $url = 'upload/medias/' . $filename;
        IaImage::findOrFail($id)->update([
            'new_image' => $url,
            'status' => 2,
            'img_status' => 'Image Modifie',
            'updated_at'    => Carbon::now()
         ]);

         return response('success');

    }
}
