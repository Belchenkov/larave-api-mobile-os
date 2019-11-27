# Api методов кабинета руководителя (делегирование полномочий) для МБ ГК Основа

#### GET /api/v1/portal/kip/initiator

Метод получения списка поручений, созданных текущим пользователем по ID пользака (по инициативе сервера МП), 
с перечнем комментариев и списками файлов.

<b>HEADERS</b>

```
Content-Type: application/json
User-Agent: *
```

```
Authorization: Bearer <accessToken>
```

#### GET /api/v1/portal/kip/executor

Метод получения списка поручений, назначенных текущему пользователю по ID пользака (по инициативе сервера МП), 
с перечнем комментариев и списками файлов.

<b>HEADERS</b>

```
Content-Type: application/json
User-Agent: *
```

```
Authorization: Bearer <accessToken>
```

#### GET /api/v1/portal/kip/{kip_id}

Возврат поручения по ID поручения

<b>HEADERS</b>

```
Content-Type: application/json
User-Agent: *
```

```
Authorization: Bearer <accessToken>
```

<b>BODY</b>
 ```
{
    "kip_id": {int}
}
```

<table>
    <thead>
        <tr>
            <td>Название</td>
            <td>Описание</td>
        </tr>
    </thead>
    <tbody>
         <tr>
            <td>kip_id</td>
            <td>ID поручения</td>
        </tr>
    </tbody>
</table> 

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": [
            {
                "id": {String},
                "number": {String},
                "theme": {String},
                "note": {String},
                "priority": {String},
                "date_start": {Datetime},
                "date_end": {Datetime},
                "planned_date": {Datetime},
                "fact_date": {Datetime},
                "current_status_id": {Int},
                "projectd": {
                    "project_id": {Int},
                    "nm": {String},
                    "id_1c": {Uuid},
                    "id_1c_parent": {Uuid}
                },
                "delegated": {Boolean},
                "initiator_user": {User},
                "executor_user": {User},
                "is_complete": {Int},
                "is_overdue": {Int},
                "is_archive": {Int},
                "files": {File},
                "assistants": [{User}],
                "observers": [{User}],
                "comments": [
                    {
                        "id": {String},
                        "text": {String},
                        "dt": {String},
                        "user": {User}
                        },
                        "files": {File}
                    },
                ]
            }
    "result": {Boolean},
    "debug": {
        "queries": {Int},
        "queries_time": {String}
    }
}

```
<table>
    <thead>
        <tr>
            <td>Название</td>
            <td>Описание</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>data.id</td>
            <td>ID поручения</td>
        </tr>
        <tr>
            <td>data.number</td>
            <td>Номер поручения</td>
        </tr> 
        <tr>
            <td>data.theme</td>
            <td>Тема поручения</td>
        </tr>
        <tr>
            <td>data.note</td>
            <td>Описание поручения</td>
        </tr>
        <tr>
            <td>data.priority</td>
            <td>Приоритет</td>
        </tr>
        <tr>
            <td>data.current_status_id</td>
            <td>Текущий статус id</td>
        </tr>
        <tr>
            <td>data.date_start</td>
            <td>Дата начала поручения</td>
        </tr>
        <tr>
            <td>data.date_end</td>
            <td>Дата когда поручения необходимо исполнить</td>
        </tr>
        <tr>
            <td>data.planned_date</td>
            <td>Планируемая дата окончания поручения</td>
        </tr>
        <tr>
            <td>data.fact_date</td>
            <td>Фактическая дата окончания поручения</td>
        </tr>
         <tr>
            <td>data.delegated</td>
            <td>Яв-ся ли поручение делегированным</td>
        </tr>
        <tr>
            <td>data.projectd.project_id</td>
            <td>ID проекта</td>
        </tr>
        <tr>
            <td>data.projectd.nm</td>
            <td>Адрес проекта</td>
        </tr>
        <tr>
            <td>data.projectd.id_1c</td>
            <td>ID проекта из 1C</td>
        </tr>
        <tr>
            <td>data.projectd.id_1c_parent</td>
            <td>ID родителя проекта из 1C</td>
        </tr>
        <tr>
            <td>data.initiator_user</td>
            <td>Данные сотрудника создавшего поручение</td>
        </tr>
        <tr>
            <td>data.executor_user</td>
            <td>Данные сотрудника назначенного на поручение</td>
        </tr>
        <tr>
            <td>data.is_complete</td>
            <td>Поручение выполнено</td>
        </tr>
        <tr>
            <td>data.is_overdue</td>
            <td>Поручение просроченно</td>
        </tr>
        <tr>
            <td>data.is_archive</td>
            <td>Поручение в архиве</td>
        </tr>
        <tr>
            <td>data.files</td>
            <td>Прикрепленный файл</td>
        </tr>
        <tr>
            <td>data.assistants</td>
            <td>Список ассистентов</td>
        </tr>
        <tr>
            <td>data.observers</td>
            <td>Список наблюдателей</td>
        </tr>
        <tr>
            <td>data.comments.id</td>
            <td>ID комментария</td>
        </tr>
        <tr>
            <td>data.comments.text</td>
            <td>Текст комментария</td>
        </tr>
        <tr>
            <td>data.comments.dt</td>
            <td>Дата создания комментария</td>
        </tr>
        <tr>
            <td>data.comments.user</td>
            <td>Сотрудник создавший комментарий</td>
        </tr>
    </tbody>
</table>

## Types
```
User: {
    "user_id": {Int},
    "tab_no": {String},
    "id_phperson": {Uuid},
    "full_name": {Int},
    "avatar": {
        "name": {String},
        "background": {String},
        "color": {String},
        "image": {String}
    }
}
```
<table>
    <thead>
        <tr>
            <td>Название</td>
            <td>Описание</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>user.user_id</td>
            <td>ID сотрудника</td>
        </tr>
        <tr>
            <td>user.tab_no</td>
            <td>tab_no сотрудника</td>
        </tr>
        <tr>
            <td>user.id_phperson</td>
            <td>id_phperson сотрудника</td>
        </tr>
        <tr>
            <td>user.full_name</td>
            <td>ФИО сотрудника</td>
        </tr>
        <tr>
            <td>user.avatar.name</td>
            <td>Имя сотрудника</td>
        </tr>
        <tr>
            <td>user.avatar.background</td>
            <td>Цвет фона</td>
        </tr>
        <tr>
            <td>user.avatar.color</td>
            <td>Цвет шрифта</td>
        </tr>
        <tr>
            <td>user.avatar.image</td>
            <td>Аватар</td>
        </tr>
    </tbody>
</table>

```
File: {
    "id": {Int},
    "file_name": {Int},
    "dt_added": {String},
    "exists": {Int},
    "url_show": {String},
    "file_size": {String}
}
```
<table>
    <thead>
        <tr>
            <td>Название</td>
            <td>Описание</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>File.id</td>
            <td>ID файла</td>
        </tr>
        <tr>
            <td>File.file_name</td>
            <td>Название файла</td>
        </tr>
        <tr>
            <td>File.dt_added</td>
            <td>Дата добавление файла</td>
        </tr>
        <tr>
            <td>File.exists</td>
            <td>Файл существует</td>
        </tr>
        <tr>
            <td>File.url_show</td>
            <td>Путь до файла</td>
        </tr>
        <tr>
            <td>File.file_size</td>
            <td>Размер файла</td>
        </tr>
    </tbody>
</table>

#### POST /api/v1/portal/kip/{kip_id}/comment

Метод добавления комментария к поручению

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```
<b>BODY</b>
 ```
{
    "comment": {String}
}
```

<table>
    <thead>
        <tr>
            <td>Название</td>
            <td>Описание</td>
            <td>Формат</td>
        </tr>
    </thead>
    <tbody>
         <tr>
            <td>comment</td>
            <td>Комментарий</td>
            <td>Обязательно</td>
        </tr>
    </tbody>
</table> 


<b>RESPONSE</b>

+ 200 OK

```
{
    "result": {Boolean},
    "debug": {
        "queries": {Int},
        "queries_time": {String}
    }
}
```

#### POST /api/v1/portal/kip/{kip_id}/update/status

Метод обновления статуса поручения

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```
<b>Params</b>
 ```
{
    "kip_id": {int}
}
```

<b>BODY</b>
```

{
    "status": {Int|[7, 8, 9]}
}
6 => Новая,
2 => Выполняется,
7 => Ожидает контроля,
9 => Завершено,
8 => Отложено,
10 => В очереди
```

<table>
    <thead>
        <tr>
            <td>Название</td>
            <td>Описание</td>
            <td>Формат</td>
        </tr>
    </thead>
    <tbody>
         <tr>
            <td>kip_id</td>
            <td>ID поручения</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>status</td>
            <td>Статус поручения</td>
            <td>Обязательно</td>
        </tr>
    </tbody>
</table> 


<b>RESPONSE</b>

+ 200 OK

```
{
    "result": {Boolean},
    "debug": {
        "queries": {Int},
        "queries_time": {String}
    }
}
```

#### POST /api/v1/portal/kip/create

Метод создания поручения

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```
<b>BODY</b>

```
{
    "theme": {String},
    "note": {String},
    "date_start": {Datetime [Y-m-d H:i:s] | before:date_end},
    "date_end": {Datetime [Y-m-d H:i:s] | after:date_start},
    "initiator_user": {Uuid = id_phperson},
    "executor_user": {Uuid = id_phperson},
    "assistants": {Array of id_phperson},
    "observers": {Array of id_phperson},
}
```

<table>
    <thead>
        <tr>
            <td>Название</td>
            <td>Описание</td>
            <td>Формат</td>
        </tr>
    </thead>
    <tbody>
         <tr>
            <td>theme</td>
            <td>Тема поручения</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>note</td>
            <td>Содержание поручения</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>date_start</td>
            <td>Время старта поручения</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>date_end</td>
            <td>Время окончания поручения</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>initiator_user</td>
            <td>Сотрудник создающий поручение</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>executor_user</td>
            <td>Исполнитель поручения</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>assistants</td>
            <td>Список ассистенов поручения</td>
        </tr>
        <tr>
            <td>observers</td>
            <td>Список наблюдателей поручения</td>
        </tr>
    </tbody>
</table> 


<b>RESPONSE</b>

+ 200 OK

```
{
    "result": {Boolean},
    "debug": {
        "queries": {Int},
        "queries_time": {String}
    }
}
```

#### GET /api/v1/file/{file_id}

Загрузка файла по file_id

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>BODY</b>
 ```
{
    "file_id": {uuid}
}
```

<table>
    <thead>
        <tr>
            <td>Название</td>
            <td>Описание</td>
        </tr>
    </thead>
    <tbody>
         <tr>
            <td>file_id</td>
            <td>ID файла (file_id)</td>
        </tr>
    </tbody>
</table> 

<b>RESPONSE</b>

+ 200 OK

```
{
    "result": {Resourse},
    "debug": {
        "queries": {Int},
        "queries_time": {String}
    }
}
```
