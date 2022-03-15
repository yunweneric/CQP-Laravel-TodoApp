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

    public function show($id)
    {
        $findTodo = Todo::where('id', $id)->first();
        // return gettype($findTodo);
        if ($findTodo == null) {
            return $this->error("Todo could not be found", []);
        }
        return $this->success("Todo successfully gotten", $findTodo->toArray());
    }

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
