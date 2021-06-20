<?php

namespace App\Contracts;

interface ReposetoryInterface
{
    public function getAll();

    public function find($id);

    public function persist($request);

    public function update($request, $id);

    public function remove($id);
}