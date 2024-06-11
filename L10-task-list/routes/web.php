<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
class Tasks
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {
    }
}



Route::get('/', function(){
    return redirect()->route('task.index');
});
Route::get('/task', function () {
    return view('index', [
        // 'tasks' => \App\Models\Task::latest()->where('completed', false)->get()
        'tasks' => Task::latest()->paginate(10)

    ]);
})->name('task.index');

Route::view('/task/create', 'create')->name('create.task');
Route::get('/task/{task}/edit', function(Task $task) {
    $tasks = $task;
    return view('edit', ['task' => $tasks]);

})->name('task.edit');

Route::get('/task/{task}', function(Task $task) {
    $tasks = $task;
    if(!$tasks){
        return 'This task does not exist';
    }
    return view('show', ['task' => $tasks]);

})->name('task.show');

Route::post('/task', function(TaskRequest $request){

    $task = Task::create($request ->validated());
    //redirect the user to the task list to see recent tasks
    return redirect()->route('task.show', ['task' => $task->id])
    //this is a flash message for subsequent request
    ->with('success', 'task created successfully');
})->name('task.store');

Route::put('/task/{task}', function(Task $task, TaskRequest $request){

    $task -> update($request ->validated());
    //redirect the user to the task list to see recent tasks
    return redirect()->route('task.show', ['task' => $task->id])
    //this is a flash message for subsequent request
    ->with('success', 'task updated successfully');
})->name('task.update');
Route::delete('task/{task}', function(Task $task){
    $task -> delete();

    return redirect()->route('task.index')
    ->with('success','task deleted successfully');
})->name('task.destroy');
Route::put('task/{task}/toggle-completed', function(Task $task){
    $task->toggleComplete();

    return redirect()->back()->with('Success', 'Task updated Succefully');
})->name('task.toggle-complete');
// Route::get("/hello", function(){
//     return "Hello Page";
// })->name("hello");

// Route::get("/hallo", function(){
//     return redirect()->route("hello");
// });

// Route::get("/greet/{name}", function($name){
//     return "Good Morning" . $name . "!";
// });
// //handle the 404 NOT FOUND page
// Route::fallBack(function(){
//     return "Still got somewhere";
// });