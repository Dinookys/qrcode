<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\RequestQRCode as Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Mockery\Expectation;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class QRCodeController extends Controller
{

    protected $storage_public;

    public function __construct()
    {
        $this->storage_public = storage_path('/app/public/');
    }

    public function index()
    {
        return view('qr.index');
    }

    public function create(Request $request)
    {
        $bg = $request->get('bgcolor', '#ffffff');
        $color = $request->get('color', '#000000');
        $content = $request->get('content');
        $size = $request->get('size', 300);
        $name = $request->get('name', '');

        $qr = (new BaconQrCodeGenerator())->format('png');
        
        $logo_name = 'log-temp' . uniqid() . '.png';

        if ($request->hasFile('logo') && ($request->file('logo') && strlen($request->file('logo')->getContent()))) {
            $this->storageImageLogo($request->file('logo')->getContent(), $logo_name);
        } else if ($request->has('logo') && strlen($request->get('logo', ''))) {

            $ch = curl_init($request->get('logo'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, false);
            $result = curl_exec($ch);
            curl_close($ch);

            $this->storageImageLogo($result, $logo_name);
            // $this->storageImageLogo(file_get_contents($request->get('logo')), $logo_name);
        }

        if (Storage::exists($logo_name)) {
            $qr->errorCorrection('H');
            $qr->mergeString(Storage::get($logo_name));
        }

        list($c_r, $c_g, $c_b) = $this->hexToRGB($color);
        list($bc_r, $bc_g, $bc_b) = $this->hexToRGB($bg);

        $image = $qr->color($c_r, $c_g, $c_b)
            ->backgroundColor($bc_r, $bc_g, $bc_b)
            ->size($size);

        if ($name) {
            $name = filter_var(preg_replace('/ /', '-', $name), FILTER_SANITIZE_EMAIL);
            $filename = "{$name}_{$size}.png";
            $image->generate($content, "{$this->storage_public}/{$filename}");
            return redirect(route('image', ['image' => "{$filename}"]));
        }

        $img = $image->generate($content);

        Storage::delete($logo_name);

        return response($img)
            ->header('Content-Type', 'image/png');
    }

    protected function hexToRGB($hex_string)
    {
        if ($hex_string[0] == '#') {
            $hex_string = substr($hex_string, 1);
        }

        $hex_string = str_pad($hex_string, 6, 0);
        $hex_string = str_split($hex_string, 2);
        return array_map('hexdec', $hex_string);
    }

    public function image($image)
    {
        $img = "{$this->storage_public}/{$image}";
        if (file_exists($img)) {
            return response(file_get_contents($img))->header('Content-Type', filetype($img));
        }
        abort('404');
    }

    protected function storageImageLogo($contents, $filename)
    {
        Storage::put($filename, $contents);

        $file = storage_path('app/' . $filename);

        $img = @imagecreatefrompng($file);

        list($width, $height) = getimagesize($file);

        $dst_width =  $width;
        $dst_height = $height;
        $dst_y = 0;
        $dst_x = 0;

        if ($width > $height) {
            $dst_width =  $dst_height = $width;
            $dst_y = ($dst_width - $height) / 2;
            $dst_x = 0;
        } else if ($width < $height) {
            $dst_width =  $dst_height =  $height;
            $dst_x = ($dst_height - $width) / 2;
            $dst_y = 0;
        }

        $ts = imagecreatetruecolor($dst_width, $dst_height);
        imagefill($ts, 0, 0, imagecolorallocatealpha($ts, 0, 0, 0, 127));
        imagesavealpha($ts, true);

        imagecopymerge($ts, $img, $dst_x, $dst_y, 0, 0, $width, $height, 100);

        imagepng($ts, $file);
        imagedestroy($img);
        imagedestroy($ts);
    }
}
