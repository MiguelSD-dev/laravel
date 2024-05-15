<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:5|max:255',
        ]);

         // Crear una nueva tarea usando el método `create` del modelo
         Task::create($request->all());

        // Redireccionar a la vista de listado de tareas
        return redirect()->route('tasks.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:5|max:255',
        ]);

        // Buscar la tarea por su ID
        $task = Task::findOrFail($id);

        // Actualizar los datos de la tarea
        $task->update($request->all());

        // Redireccionar a la vista de listado de tareas
        return redirect()->route('tasks.index');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
