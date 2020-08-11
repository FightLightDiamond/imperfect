<?php

namespace App\Http\Controllers;

use GoTest\Http\Repositories\QuestionRepository;
use GoTest\Models\Question;
use Illuminate\Http\Request;

class SingleTestController extends Controller
{
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function test(Request $request, $id) {
        try {
            $answerRequest = $request->answer;
            $question = $this->questionRepository->find($id, ['answer', 'type']);

            $answer = $question->answer;

            if($question->type === Question::MULTI_ANSWER_TYPE)
                return response()->json($this->multiAnswerCheck($answerRequest, $answer));

            return response()->json($answerRequest == $answer);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    protected function multiAnswerCheck($answerRequest, $answer)
    {
        $answer = json_decode($answer, true);
        sort($answerRequest);
        sort($answer);

        return $answer === $answerRequest;
    }
}
