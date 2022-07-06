<?php

namespace App\Http\Controllers\Notebook;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notebook\StoreRequest;
use App\Http\Requests\Notebook\UpdateRequest;
use App\Http\Resources\NotebookResource;
use App\Models\Notebook\Notebook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotebooksController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/notebook",
     *      operationId="getNotesList",
     *      tags={"Notebook"},
     *      summary="Get list of notes",
     *      description="Returns list of notes",
     *      @OA\Parameter(
     *          name="page",
     *          description="Page number",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/NotebookResource")
     *       ),
     *     )
     */

    public function index(Request $request)
    {
        if (!isset($request->page)) {
            $notebook = Notebook::all();
        } else {
            $notebook = Notebook::simplePaginate(10);
        }

        return NotebookResource::collection($notebook);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/notebook",
     *      operationId="storeNotebook",
     *      tags={"Notebook"},
     *      summary="Store new note",
     *      description="Returns note data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Notebook")
     *       ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     * )
     */

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $notebook = Notebook::create($data);

        return response()->json([
            'data' => new NotebookResource($notebook),
        ], Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/notebook/{id}",
     *      operationId="getNoteById",
     *      tags={"Notebook"},
     *      summary="Get note information",
     *      description="Returns note data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Note id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Notebook")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      ),
     *
     * )
     */

    public function show(Notebook $notebook)
    {
        return new NotebookResource($notebook);
    }

    /**
     * @OA\Patch(
     *      path="/api/v1/notebook/{id}",
     *      operationId="updateNote",
     *      tags={"Notebook"},
     *      summary="Update existing note",
     *      description="Returns updated note data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Note id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Notebook")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     * )
     */

    public function update(UpdateRequest $request, Notebook $notebook)
    {
        $data = $request->validated();
        $notebook->update($data);

        return response()->json([
            'data' => new NotebookResource($notebook),
        ]);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/notebook/{id}",
     *      operationId="deleteNote",
     *      tags={"Notebook"},
     *      summary="Delete existing note",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Note id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */

    public function destroy(Notebook $notebook)
    {
        $notebook->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
