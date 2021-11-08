<?php


namespace Tomeet\Uploader\Http\Controllers;


use Tomeet\Uploader\Facades\Uploader;
use Illuminate\Http\Request;
use Exception;
use Jiannei\Response\Laravel\Support\Facades\Response;

class FileController
{
    /**
     * 上传
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        try {
            if (!$request->hasFile('file')) {
                throw new Exception('无效的上传文件！');
            }

            $result = Uploader::upload($request->file('file'));
            return Response::success($result);
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }


    /**
     * 删除
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        try {
            Uploader::delete($request->file);
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }
}
