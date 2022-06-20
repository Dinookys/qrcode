<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\RequestQRCode as Request;
use Facade\FlareClient\Http\Response;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class QRCodeController extends Controller
{

    protected $storage_public;

    public function __construct()
    {
        $this->storage_public = storage_path('/app/public/');
    }

    public function index ()
    {
        return view('qr.index');
    }
    
    public function create (Request $request)
    {
        $bg = $request->get('bgcolor', '#ffffff');
        $color = $request->get('color', '#000000');
        $content = $request->get('content');
        $size = $request->get('size', 300);
        $name = $request->get('name', '');
        
        $qr = (new BaconQrCodeGenerator())->format('png');

        if($request->hasFile('logo')) {
            $qr->mergeString($request->file('logo')->getContent(), .2, true);            
        } else if($request->has('logo')) {
            $qr->merge($request->get('logo'), .2, true);            
        }

        list($c_r, $c_g, $c_b) = $this->hexToRGB($color);
        list($bc_r, $bc_g, $bc_b) = $this->hexToRGB($bg);
        
        $image = $qr->color($c_r, $c_g, $c_b)
            ->backgroundColor($bc_r, $bc_g, $bc_b)
            ->size($size);
            
        if($name) {
            $name = filter_var(preg_replace('/ /', '-', $name), FILTER_SANITIZE_EMAIL);
            $filename = "{$name}_{$size}.png";
            $image->generate($content, "{$this->storage_public}/{$filename}");
            return redirect(route('image', ['image' => "{$filename}"]));

        }
                
        $img = $image->generate($content);
        return response($img)
            ->header('Content-Type', 'image/png');
    }

    protected function hexToRGB ($hex_string)
    {
        if($hex_string[0] == '#') {
            $hex_string = substr($hex_string, 1);
        }

        $hex_string = str_pad($hex_string, 6, 0);
        $hex_string = str_split($hex_string, 2);
        return array_map('hexdec', $hex_string);
    }

    public function image($image) {
        $img = "{$this->storage_public}/{$image}";
        if(file_exists($img)) {
            return response(file_get_contents($img))->header('Content-Type', filetype($img));
        }
        abort('404');
    }
}
