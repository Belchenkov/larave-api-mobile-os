# Api методов задач в кабинете согласования для МБ ГК Основа

#### GET /api/v1/tasks/approval

Метод получения всех задач на соглосавание текущего пользователя

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": [
        {
            "id": {Int},
            "name": {String},
            "type": {String},
            "type_descriptions": {String},
            "initiator": {
                "ad_login": {String},
                "tab_no": {String},
                "full_name": {String},
                "avatar": {
                    "name": {String},
                    "background": {String},
                    "color": {String},
                    "image": {String}
                },
            },
            "comment": {String},
            "executor": {String},
            "status": {String},
            "actions": {Int},
            "related_tasks": {
                []
            },
            "doc_info": {
                "theme": {String},
                "organization": {String},
                "partner": {String},
                "doc_no": {String},
                "date": {String},
                "cost": {Int},
                "executor": {String},
                "project": {String},
                "article": {String},
                "files": {
                    "file_id" => {Int},
                    "file_name" => {String}
                }
            },  
            "created_at": {Int},
        }
    ],
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
            <td>ID задачи</td>
        </tr>
        <tr>
            <td>data.name</td>
            <td>Название задачи</td>
        </tr>
        <tr>
            <td>data.type</td>
            <td>Тип задачи</td>
        </tr>
        <tr>
            <td>data.type_descriptions</td>
            <td>Описание типа</td>
        </tr>
        <tr>
            <td>data.initiator.ad_login</td>
            <td>AD инициатора</td>
        </tr>
        <tr>
            <td>data.initiator.tab_no</td>
            <td>Табельный номер инициатора</td>
        </tr>
        <tr>
            <td>data.initiator.full_name</td>
            <td>ФИО инициатора</td>
        </tr>
        <tr>
            <td>data.initiator.avatar.name</td>
            <td>Первая буквы фамилии и имени</td>
        </tr>
        <tr>
            <td>data.initiator.avatar.background</td>
            <td>Фон</td>
        </tr>
        <tr>
            <td>data.initiator.avatar.color</td>
            <td>Цвет шрифта</td>
        </tr>
        <tr>
            <td>data.initiator.avatar.image</td>
            <td>Аватар</td>
        </tr>
         <tr>
            <td>data.comment</td>
            <td>Комментарий</td>
        </tr>
        <tr>
            <td>data.executor</td>
            <td>Исполнитель</td>
        </tr>
        <tr>
            <td>data.status</td>
            <td>Статус задачи</td>
        </tr>
        <tr>
            <td>data.actions</td>
            <td>Действие задачи</td>
        </tr>
        <tr>
            <td>data.related_tasks</td>
            <td>Подписавшиеся к задаче лица</td>
        </tr>
        <tr>
            <td>data.doc_info.theme</td>
            <td>Тема документа</td>
        </tr>
        <tr>
            <td>data.doc_info.organization</td>
            <td>Организация</td>
        </tr>
        <tr>
            <td>data.doc_info.partner</td>
            <td>Контрагент</td>
        </tr>
        <tr>
            <td>data.doc_info.doc_no</td>
            <td>Номер</td>
        </tr>
        <tr>
            <td>data.doc_info.date</td>
            <td>Дата</td>
        </tr>
        <tr>
            <td>data.doc_info.cost</td>
            <td>Сумма</td>
        </tr>
        <tr>
            <td>data.doc_info.executor</td>
            <td>Ответственный</td>
        </tr>
        <tr>
            <td>data.doc_info.project</td>
            <td>Проект</td>
        </tr>
        <tr>
            <td>data.doc_info.article</td>
            <td>СтатьяДДС</td>
        </tr>
        <tr>
            <td>data.doc_info.files.file_id</td>
            <td>Ссылка на файл</td>
        </tr>
        <tr>
            <td>data.doc_info.files.file_name</td>
            <td>Название файла</td>
        </tr>
    </tbody>
</table>


#### GET /api/v1/tasks/approval/{task_id}

Метод получения задачи на соглосавание по id

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>BODY</b>
 ```
{
    "taks_id": {uuid}
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
            <td>taks_id</td>
            <td>ID задачи</td>
        </tr>
    </tbody>
</table> 

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
            "id": {Int},
            "name": {String},
            "type": {String},
            "type_descriptions": {String},
            "initiator": {
                "ad_login": {String},
                "tab_no": {String},
                "full_name": {String},
                "avatar": {
                    "name": {String},
                    "background": {String},
                    "color": {String},
                    "image": {String}
                },
            },
            "comment": {String},
            "executor": {String},
            "status": {String},
            "actions": {Int},
            "related_tasks": {
                []
            },
            "doc_info": {
                "theme": {String},
                "organization": {String},
                "partner": {String},
                "doc_no": {String},
                "date": {String},
                "cost": {Int},
                "executor": {String},
                "project": {String},
                "article": {String},
                "files": {
                    "file_id" => {Int},
                    "file_name" => {String}
                }
            },  
            "created_at": {Int},
        },
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
            <td>ID задачи</td>
        </tr>
        <tr>
            <td>data.name</td>
            <td>Название задачи</td>
        </tr>
        <tr>
            <td>data.type</td>
            <td>Тип задачи</td>
        </tr>
        <tr>
            <td>data.type_descriptions</td>
            <td>Описание типа</td>
        </tr>
        <tr>
            <td>data.initiator.ad_login</td>
            <td>AD инициатора</td>
        </tr>
        <tr>
            <td>data.initiator.tab_no</td>
            <td>Табельный номер инициатора</td>
        </tr>
        <tr>
            <td>data.initiator.full_name</td>
            <td>ФИО инициатора</td>
        </tr>
        <tr>
            <td>data.initiator.avatar.name</td>
            <td>Первая буквы фамилии и имени</td>
        </tr>
        <tr>
            <td>data.initiator.avatar.background</td>
            <td>Фон</td>
        </tr>
        <tr>
            <td>data.initiator.avatar.color</td>
            <td>Цвет шрифта</td>
        </tr>
        <tr>
            <td>data.initiator.avatar.image</td>
            <td>Аватар</td>
        </tr>
         <tr>
            <td>data.comment</td>
            <td>Комментарий</td>
        </tr>
        <tr>
            <td>data.executor</td>
            <td>Исполнитель</td>
        </tr>
        <tr>
            <td>data.status</td>
            <td>Статус задачи</td>
        </tr>
        <tr>
            <td>data.actions</td>
            <td>Действие задачи</td>
        </tr>
        <tr>
            <td>data.related_tasks</td>
            <td>Подписавшиеся к задаче лица</td>
        </tr>
        <tr>
            <td>data.doc_info.theme</td>
            <td>Тема документа</td>
        </tr>
        <tr>
            <td>data.doc_info.organization</td>
            <td>Организация</td>
        </tr>
        <tr>
            <td>data.doc_info.partner</td>
            <td>Контрагент</td>
        </tr>
        <tr>
            <td>data.doc_info.doc_no</td>
            <td>Номер</td>
        </tr>
        <tr>
            <td>data.doc_info.date</td>
            <td>Дата</td>
        </tr>
        <tr>
            <td>data.doc_info.cost</td>
            <td>Сумма</td>
        </tr>
        <tr>
            <td>data.doc_info.executor</td>
            <td>Ответственный</td>
        </tr>
        <tr>
            <td>data.doc_info.project</td>
            <td>Проект</td>
        </tr>
        <tr>
            <td>data.doc_info.article</td>
            <td>СтатьяДДС</td>
        </tr>
        <tr>
            <td>data.doc_info.files.file_id</td>
            <td>Ссылка на файл</td>
        </tr>
        <tr>
            <td>data.doc_info.files.file_name</td>
            <td>Название файла</td>
        </tr>
        <tr>
            <td>data.created_at</td>
            <td>Время добавления задачи</td>
        </tr>
    </tbody>
</table>

#### POST /api/v1/tasks/approval/{task_id}

Обновление задачи на соглосавание по id

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>BODY</b>
 ```
{
    "taks_id": {uuid},
    "comment": {String},
    "status": {Int}
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
            <td>taks_id</td>
            <td>ID задачи</td>
        </tr>
        <tr>
            <td>comment</td>
            <td>Комментарий к задаче</td>
        </tr>
        <tr>
            <td>status</td>
            <td>Статус задачи</td>
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