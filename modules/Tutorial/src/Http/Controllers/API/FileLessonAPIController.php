<?php


namespace Tutorial\Http\Controllers\API;

use Cuongpm\Uploader\Facades\UploadFa;
use Tutorial\Http\Repositories\LessonRepository;
use Tutorial\Http\Requests\API\DeleteFileLessonAPIRequest;
use Tutorial\Http\Requests\API\UpdateFileLessonAPIRequest;

class FileLessonAPIController
{
    protected $lessonRepository;
    protected $lesson;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function update(UpdateFileLessonAPIRequest $request, $id)
    {
        try {
            $lesson = $this->lessonRepository->find($id, ['id', 'images']);
            $file = $request->image;

            $files = json_decode($lesson->images, true);

            $files[] = UploadFa::file($file, config("filesystems.disks.public.root") . '/images-lessons');

            $lesson->images = json_encode($files);
            $lesson->save();

            return response()->json($this->convertURL($files));
        } catch (\Exception $exception) {
            logger($exception);

            return response()->json($exception->getMessage(), $exception->getCode());
        }
    }

    public function convertURL($files)
    {
        foreach ($files as $key => $file) {
            $files[$key] = config("filesystems.disks.public.url") .$file;
        }

        return $files;
    }


    public function destroy(DeleteFileLessonAPIRequest $request, $id)
    {
        try {
            $lesson = $this->lessonRepository->find($id, ['id', 'images']);
            $index = request('index');

            $files = json_decode($lesson->images, true);
//            return $files;

            if(count($files) > 0) {
                $file = $files[$index];

//                unlink(config("filesystems.disks.public.root") . $file);

//                unset($files[$index]);

                $files = array_values($files);

                $lesson->images = json_encode($files);
                $lesson->save();
            }

            return response()->json($this->convertURL($files));
        } catch (\Exception $exception) {
            logger($exception);

            return response()->json($exception->getMessage(), $exception->getCode());
        }
    }
}
