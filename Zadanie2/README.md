# User API

Это простой REST API для управления пользователями, реализованный на чистом PHP.

## Методы API

### 1. Создание пользователя

- **Метод:** POST
- **URL:** /users
- **Тело запроса:**
  json
  {
      "username": "string",
      "password": "string",
      "email": "string"
  }

- **Ответ:**
  
json
  {
      "id": "uniqueuserid",
      "username": "string",
      "email": "string"
  }

  
### 2. Получение информации о пользователе

- **Метод:** GET
- **URL:** /users/{id}
- **Ответ:**
  
json
  {
      "id": "uniqueuserid",
      "username": "string",
      "email": "string"
  }
  
### 3. Обновление информации пользователя

- **Метод:** PUT
- **URL:** /users/{id}
- **Тело запроса:**
  
json
  {
      "username": "string",
      "email": "string"
  }
- **Ответ:**
  
json
  {
      "id": "uniqueuserid",
      "username": "string",
      "email": "string"
  }
  ### 4. Удаление пользователя

- **Метод:** DELETE
- **URL:** /users/{id}
- **Ответ:**
  
json
  {
      "success": true
  }
  ### 5. Авторизация пользователя

- **Метод:** POST
- **URL:** /login
- **Тело запроса:**
  
json
  {
      "username": "string",
      "password": "string"
  }
  
- **Ответ:**
  
json
  {
      "id": "uniqueuserid",
      "username": "string",
      "email": "string"
  }