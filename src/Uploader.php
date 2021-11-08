<?php


namespace Tomeet\Uploader;


use Illuminate\Support\Facades\Storage;

class Uploader
{

    /**
     * Uploader constructor.
     *
     * @param Repository $config
     */
    public function __construct() {}


    public function upload($file)
    {
        if ($file->isValid()) {
            try {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $mineType = $file->getClientMimeType();
                $filesize = $file->getSize();
                $filepath = Storage::put(date('Y/m/d'), $file);

                return [
                    'originalName' => $originalName,
                    'filename' => basename($filepath),
                    'filepath' => $filepath,
                    'url' => Storage::url($filepath),
                    'ext' => $extension,
                    'size' => $filesize,
                    'mine_type' => $mineType,
                ];
            } catch (Exception $exception) {
                // 指定错误日志
                Log::useFiles(storage_path('logs/uploads.log'), 'info');
                Log::info($exception->getMessage());
                // 返回错误提示
                throw new Exception('文件上传失败！');
            }
        }

        throw new Exception('无效的上传文件！');
    }


    public function delete($file)
    {
        Storage::delete($file);
    }
}
