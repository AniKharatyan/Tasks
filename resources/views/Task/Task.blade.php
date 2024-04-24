<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задачник</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
            color: #555;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin-bottom: 0;
        }
        .filters {
            display: flex;
            align-items: center;
        }
        .filters select {
            margin-right: 10px;
            padding: 5px;
            border: 1px solid #ccc;
        }
        .tasks-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }
        .tasks-table th, .tasks-table td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            border-right: 1px solid #ccc;
        }
        .tasks-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .tasks-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .tasks-table tbody tr:hover {
            background-color: #e0e0e0;
        }
        .create-task-btn {
            text-decoration: none;
            background-color: #DADADA;
            color: #443D3A;
            padding: 10px 20px;
            border-radius: 5px;
            border: 2px solid #443D3A;
        }
        .create-task-btn:hover {
            background-color: #C9C9C9;
            cursor: alias;
        }
        .tasks-table th {
            background-color: #B9B9B9;
        }

        .tasks-table tbody tr:nth-child(even) {
            background-color: #B9B9B9;
        }

        .tasks-table tbody tr:nth-child(odd) {
            background-color: #E8E8E8;
        }

        .tasks-table button {
            border: none;
            background: none;
            cursor: pointer;
            color: #3B4245;
            font-size: 15px;
        }

        .tasks-table button:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
<div class="container" style="margin-top: 100px">
    <div class="header">
        <h1>Задачник</h1>
        <a href="{{route('create_task')}}" class="create-task-btn">Новая задача</a>
    </div>
    <div class="filters">
        <select name="author_filter" id="author_filter">
            <option value="{{null}}" @if(!$selectedAuthor) selected @endif>Все авторы ({{count($authors)}})</option>
            @foreach($authors as $author)
                <option value="{{ $author }}" @if($selectedAuthor == $author) selected @endif>{{ $author }}</option>
            @endforeach
        </select>
        <select name="status_filter" id="status_filter">
            <option value="{{null}}" @if(!$selectedStatus) selected @endif>Все статусы ({{count($statuses)}})</option>
            @foreach($statuses as $status)
                <option value="{{ $status }}" @if($selectedStatus == $status) selected @endif>{{ $status }}</option>
            @endforeach
        </select>
    </div>
    <table class="tasks-table" style="margin-top: 15px">
        <thead>
        <tr>
            <th></th>
            <th>Название Задачи</th>
            <th>Автор</th>
            <th>Статус</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                    <button id="task-{{$task->id}}" class="delete-button hover:text-indigo-900" style="color: #3B4245; font-size: 15px">X</button>
                </td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->author }}</td>
                <td>{{ $task->status }}</td>
                <td>
                    <a href="{{ route('edit_task') .'?task_id=' . $task->id }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    {{ $tasks->appends(['author' => $selectedAuthor, 'status' => $selectedStatus])->onEachSide(1)->links('pagination.custom') }}
</div>
<script>
    const deleteButton = document.querySelectorAll('.delete-button');

    deleteButton.forEach((button) => {
        button.addEventListener('click', (e) => {
            const id = e.target.id.split('-')[1];
            const isConfirmed = confirm('Вы уверены что хотите удалить эту задачу?');
            if (isConfirmed) {
                fetch(`/tasks/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(data => {
                        document.getElementById('task-' + id).closest('tr').remove();
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    });

</script>

<script>
    function search() {
        const author = document.getElementById('author_filter').value;
        const status = document.getElementById('status_filter').value;
        let url = "/tasks?page=" + 1;
        url += (author ? "&author=" + author : '') + (status ? "&status=" + status : '');
        window.location.href = url;
    }

    document.getElementById('author_filter').addEventListener('change', search);
    document.getElementById('status_filter').addEventListener('change', search);

</script>

</body>
</html>
