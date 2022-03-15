<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;


class TodosController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * @OA\Get(
     * path="/api/index",
     * summary="Endpoint for creating new Todo",
     * description="Endpoint for creating new Todo",
     * operationId="",
     * tags={"Todo"},
       
    
     * @OA\Response(
     *    response=401,
     *    description="An unknown error has occurred !!! Please try again later",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="true"),
     *       @OA\Property(property="status_code", type="string", example="401"),
     *       @OA\Property(property="status", type="string", example="Unauthorized"),
     *       @OA\Property(property="message", type="string", example="Protected page, please log in"),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="An unknown error has occurred !!! Please try again later",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="true"),
     *       @OA\Property(property="status_code", type="string", example="422"),
     *       @OA\Property(property="status", type="string", example="Unprocessable Entity"),
     *       @OA\Property(property="message", type="string", example="An unknown error has occurred !!! Please try again later"),
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Todo successfully created",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="false"),
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Todo successfully added."),
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="2"),
     *          @OA\Property(property="name", type="string", example="Text here"),
     *          @OA\Property(property="activity", type="string", example="description here"),
     *          @OA\Property(property="dateline", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *          @OA\Property(property="updated at", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *          @OA\Property(property="created at", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *       )
     *    )
     * ),
     * )
     */
    public function index()
    {

        $todos =  Todo::all();
        // return $todos;
        return $this->success("Todos successfully fetch", $todos == [] ? [] : $todos->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    /**
     * @OA\Post(
     * path="/api/store",
     * summary="Endpoint for deleting new Todo",
     * description="Endpoint for updating new Todo",
     * operationId="auth",
     * tags={"Todo"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Endpoint for updating new Todo",
     *    @OA\JsonContent(
     *       required={"name", "name","field","activity", "state", "dateline"},
     *       @OA\Property(property="name", type="string", example="Cook Food"),
     *       @OA\Property(property="activity", type="string", example="Ambitioconcilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum."),
     *       @OA\Property(property="state", type="string", example="1 0r 0"),
     *       @OA\Property(property="dateline", type="string", example="12/12/2022"),
     *      
     * ),
     * ),
     * @OA\Response(
     *    response=401,
     *    description="An unknown error has occurred !!! Please try again later",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="true"),
     *       @OA\Property(property="status_code", type="string", example="401"),
     *       @OA\Property(property="status", type="string", example="Unauthorized"),
     *       @OA\Property(property="message", type="string", example="Protected page, please log in"),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="An unknown error has occurred !!! Please try again later",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="true"),
     *       @OA\Property(property="status_code", type="string", example="422"),
     *       @OA\Property(property="status", type="string", example="Unprocessable Entity"),
     *       @OA\Property(property="message", type="string", example="An unknown error has occurred !!! Please try again later"),
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Todo successfully created",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="false"),
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Todo successfully added."),
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="2"),
     *          @OA\Property(property="name", type="string", example="Text here"),
     *          @OA\Property(property="activity", type="string", example="description here"),
     *          @OA\Property(property="dateline", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *          @OA\Property(property="updated at", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *          @OA\Property(property="created at", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *       )
     *    )
     * ),
     * )
     */

    public function store(Request $request)
    {
        // Validation

        $this->validate($request, [
            "name" => "required|string|unique:todos|max:20",
            "activity" => "required|string|",
            "state" => "required|integer",
            "dateline" => "required|date",
        ]);
        $todo = Todo::create($request->all())->toArray();
        if ($todo == null) {
            $this->error("Todo not created", []);
        }
        return $this->success("Todo successfully created", $todo);
    }

    /**
     * @OA\Get(
     * path="/api/show/id",
     * summary="Endpoint for Showing one Todo",
     * description="Endpoint for showind one Todo",
     * operationId="show",
     * tags={"Todo"},
       
    
     * @OA\Response(
     *    response=401,
     *    description="An unknown error has occurred !!! Please try again later",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="true"),
     *       @OA\Property(property="status_code", type="string", example="401"),
     *       @OA\Property(property="status", type="string", example="Unauthorized"),
     *       @OA\Property(property="message", type="string", example="Protected page, please log in"),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="An unknown error has occurred !!! Please try again later",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="true"),
     *       @OA\Property(property="status_code", type="string", example="422"),
     *       @OA\Property(property="status", type="string", example="Unprocessable Entity"),
     *       @OA\Property(property="message", type="string", example="An unknown error has occurred !!! Please try again later"),
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Todo successfully created",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="false"),
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Todo successfully added."),
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="2"),
     *          @OA\Property(property="name", type="string", example="Text here"),
     *          @OA\Property(property="activity", type="string", example="description here"),
     *          @OA\Property(property="dateline", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *          @OA\Property(property="updated at", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *          @OA\Property(property="created at", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *       )
     *    )
     * ),
     * )
     */
    public function show($id)
    {
        $findTodo = Todo::where('id', $id)->first();
        // return gettype($findTodo);
        if ($findTodo == null) {
            return $this->error("Todo could not be found", []);
        }
        return $this->success("Todo successfully gotten", $findTodo->toArray());
    }

    /**
     * @OA\Put(
     * path="/api/update/id",
     * summary="Endpoint for updating Todo",
     * description="Endpoint for updating Todo",
     * operationId="update",
     * tags={"Todo"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Endpoint for updating Todo",
     *    @OA\JsonContent(
     *       required={"name", "name","field","activity", "state", "dateline"},
     *       @OA\Property(property="name", type="string", example="Cook Food"),
     *       @OA\Property(property="activity", type="string", example="Ambitioconcilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum."),
     *       @OA\Property(property="state", type="string", example="1 0r 0"),
     *       @OA\Property(property="dateline", type="string", example="12/12/2022"),
     *      
     * ),
     * ),
     * @OA\Response(
     *    response=401,
     *    description="An unknown error has occurred !!! Please try again later",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="true"),
     *       @OA\Property(property="status_code", type="string", example="401"),
     *       @OA\Property(property="status", type="string", example="Unauthorized"),
     *       @OA\Property(property="message", type="string", example="Protected page, please log in"),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="An unknown error has occurred !!! Please try again later",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="true"),
     *       @OA\Property(property="status_code", type="string", example="422"),
     *       @OA\Property(property="status", type="string", example="Unprocessable Entity"),
     *       @OA\Property(property="message", type="string", example="An unknown error has occurred !!! Please try again later"),
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Todo successfully created",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="false"),
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Todo successfully updated."),
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="2"),
     *          @OA\Property(property="name", type="string", example="Text here"),
     *          @OA\Property(property="activity", type="string", example="description here"),
     *          @OA\Property(property="dateline", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *          @OA\Property(property="updated at", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *          @OA\Property(property="created at", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *       )
     *    )
     * ),
     * )
     */

    public function update(Request $request, $id)
    {
        $findTodo = Todo::where('id', $id)->first();
        if ($findTodo == null) {
            return $this->error("Todo could not be found", []);
        }
        $findTodo->update($request->all());
        $findTodo = Todo::where('id', $id)->first();
        return $this->success("Todo successfully updated", $findTodo->toArray());
    }

    /**
     * @OA\Delete(
     * path="/api/delete/id",
     * summary="Endpoint for deleting new Todo",
     * description="Endpoint for deleting new Todo",
     * operationId="delete",
     * tags={"Todo"},
 
     * @OA\Response(
     *    response=401,
     *    description="An unknown error has occurred !!! Please try again later",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="true"),
     *       @OA\Property(property="status_code", type="string", example="401"),
     *       @OA\Property(property="status", type="string", example="Unauthorized"),
     *       @OA\Property(property="message", type="string", example="Protected page, please log in"),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="An unknown error has occurred !!! Please try again later",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="true"),
     *       @OA\Property(property="status_code", type="string", example="422"),
     *       @OA\Property(property="status", type="string", example="Unprocessable Entity"),
     *       @OA\Property(property="message", type="string", example="An unknown error has occurred !!! Please try again later"),
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Todo successfully deleted",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="boolean", example="false"),
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="status_code", type="integer", example="200"),
     *       @OA\Property(property="message", type="string", example="Todo successfully updated."),
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *          @OA\Property(property="id", type="integer", example="2"),
     *          @OA\Property(property="name", type="string", example="Text here"),
     *          @OA\Property(property="activity", type="string", example="description here"),
     *          @OA\Property(property="dateline", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *          @OA\Property(property="updated at", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *          @OA\Property(property="created at", type="string", example= "2022-03-15T12:05:50.000000Z",),
     *       )
     *    )
     * ),
     * )
     */


    public function done(Request $request, $id)
    {
        // return $id;
        $findTodo = Todo::where('id', $id)->first();
        if ($findTodo == null) {
            return $this->error("Todo could not be found", []);
        }
        $newState = $findTodo->state == 1 ? 0 : 1;
        $request->state = $newState;
        $findTodo['state'] = $newState;
        $findTodo->update($findTodo->toArray());
        $findTodo = Todo::where('id', $id)->first();

        return $this->success("Todo successfully updated", $findTodo->toArray());
    }
    public function delete($id)
    {
        $findTodo = Todo::where('id', $id)->first();
        // return gettype($findTodo);
        if ($findTodo == null) {
            return $this->error("Todo could not be found", []);
        }
        $findTodo->delete($id);
        return $this->success("Todo successfully deleted", $findTodo->toArray());
    }

    protected function success(string $message = "", array $data = [])
    {

        return $this->response(false, $message, 'success', 200, $data);
    }

    /**
     * Send response.
     *
     * @param  bool $error
     * @param  string $message
     * @param  string $status
     * @param  int $code
     * @param  array $datas
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response(bool $error, string $message, string $status, int $code,  array $data = [])
    {

        $default = [
            'error' => $error,
            'status' => $status,
            'status_code' => $code,
            'message' => $message
        ];

        // if (!empty($data)) {

        $default['data'] = $data;
        // }

        return response()->json($default, $code);
    }



    /**
     * unauthorized
     *
     * @param  string $message
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message = 'Protected page, log in', array $data = [])
    {

        return $this->response(true, $message, 'Unauthorized', 401, $data);
    }
}
