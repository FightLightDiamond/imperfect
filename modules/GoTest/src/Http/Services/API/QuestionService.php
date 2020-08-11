<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 *
 */

namespace GoTest\Http\Services\API;

use GoTest\Http\Repositories\QuestionRepository;

class QuestionService
{
    private $repository;

    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($input)
    {
        $input[RELATIONSHIP_FILTER] = null;
        $input[SORT_FILTER] = 'id|desc';

        return $this->repository->myPaginate($input);
    }

    public function store($input)
    {
        return $this->repository->store($input);
    }

    public function show($id)
    {
       return $this->repository->find($id);
    }

    public function edit($id)
    {
       return $this->repository->find($id);
    }

    public function update($input, $id)
    {
        $question = $this->repository->find($id);

        return $this->repository->change($input, $question);
    }

    public function destroy($id)
    {
        $question = $this->repository->find($id);

		if (! empty($question)) {
            $this->repository->delete($id);
        }

        return $question;
    }
}
