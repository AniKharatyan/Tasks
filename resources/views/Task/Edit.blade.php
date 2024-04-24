<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование задачи</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            margin-top: 100px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
            color: #555;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .submit-btn {
            background-color: #DADADA;
            color: #443D3A;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .submit-btn:hover {
            background-color: #C9C9C9;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Редактирование задачи</h1>
    <form id="task-form" action="{{ route('update_task') }}" method="POST">
        @csrf
        <input id='task_id' type="hidden" name="task_id" value={{$task->id}}>
        <div class="form-group">
            <input type="text" id="name" name="name" placeholder="{{$task->name}}" required>
        </div>
        <div class="form-group">
            <input type="text" id="author" name="author" placeholder="{{$task->author}}" required>
        </div>
        <div class="form-group">
            <select id="status" name="status" required>
                <option value="Не срочная" @if($task->status === 'Не срочная') selected @endif>Не срочная</option>
                <option value="Обычная" @if($task->status === 'Обычная') selected @endif>Обычная</option>
                <option value="Срочная" @if($task->status === 'Срочная') selected @endif>Срочная</option>
                <option value="Очень срочная" @if($task->status === 'Очень срочная') selected @endif>Очень срочная</option>
            </select>
        </div>
        <button type="submit" class="submit-btn">Редактировать</button>
    </form>
</div>
</body>
</html>
