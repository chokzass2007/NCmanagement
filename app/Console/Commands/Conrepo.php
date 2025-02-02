<?php
// ลงทะเบียนคำสั่งใน app/Console/Kernel.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;


class Conrepo extends Command
{
    protected $signature = 'make:conrepo {path}';
    protected $description = 'Create a new Controller repository file in the specified folder';

    public function handle()
    {
        // แยกพารามิเตอร์ path เป็นโฟลเดอร์และชื่อไฟล์
        $path = $this->argument('path');
        $segments = explode('/', $path);
        $fileName = array_pop($segments).'Controller'; // ชื่อไฟล์
        $folderPath = app_path('http/Controllers/' . implode('/', $segments)); // โฟลเดอร์

        // ตรวจสอบและสร้างโฟลเดอร์หากไม่มี
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }
        
        // เส้นทางไฟล์
        $filePath = $folderPath . '/' . $fileName . '.php';

        // ตรวจสอบว่าไฟล์มีอยู่แล้วหรือไม่
        if (File::exists($filePath)) {
            $this->error('File already exists!');
            return;
        }

        // สร้างเนื้อหาไฟล์
        $namespace = 'App\\Http\Controllers';
        if (!empty($segments)) {
            $namespace .= '\\' . implode('\\', $segments);
        }

        $content = "<?php\n\n";
        $content .= "namespace {$namespace };\n\n";
        $content .= "use Illuminate\Foundation\Auth\Access\AuthorizesRequests;\n\n";
        $content .= "use Illuminate\Foundation\Validation\ValidatesRequests;\n\n";
        $content .= "use Illuminate\Routing\Controller as BaseController;\n\n";
        $content .= "class {$fileName} extends BaseController\n";
        $content .= "{\n";
        $content .= '//public function dataJsonIndex(siloFG_viewRepositories $siloFG_viewRepositories){' . "\n";
        $content .= '//  $data = $siloFG_viewRepositories->getAll();' . "\n";
        $content .= '//  return response()->json($data);' . "\n";
        $content .= '//}' . "\n";  
        $content .= "}\n";

        // เขียนไฟล์
        File::put($filePath, $content);

        $this->info("{$filePath} Controller Repository created successfully: {$fileName}.php");
    }
}

