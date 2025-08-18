# Résumé des endpoints générés

## POST_AUTH_LOGIN
**Endpoint:** `post /auth/login`
**Description:** Connexion utilisateur
**Réponses:**
- ✅ 200: `POST_AUTH_LOGIN_SUCCESS_RESPONSE`
- ❌ 422: `POST_AUTH_LOGIN_ERROR_422`

## POST_AUTH_LOGOUT
**Endpoint:** `post /auth/logout`
**Description:** Déconnexion utilisateur
**Réponses:**
- ✅ 200: `POST_AUTH_LOGOUT_SUCCESS_RESPONSE`
- ❌ 401: `POST_AUTH_LOGOUT_ERROR_401`

## GET_AUTH_USER
**Endpoint:** `get /auth/user`
**Description:** Récupérer les informations de l'utilisateur connecté
**Réponses:**
- ✅ 200: `GET_AUTH_USER_SUCCESS_RESPONSE`
- ❌ 401: `GET_AUTH_USER_ERROR_401`

## GET_TEAMSA
**Endpoint:** `get /teamsA`
**Description:** Non définie
**Réponses:**
- ✅ 200: `GET_TEAMSA_SUCCESS_RESPONSE`

## GET_TEAMS
**Endpoint:** `get /teams`
**Description:** Affiche la liste des équipes
**Réponses:**
- ✅ 200: `GET_TEAMS_SUCCESS_RESPONSE`
- ❌ 401: `GET_TEAMS_ERROR_401`

## POST_TEAMS
**Endpoint:** `post /teams`
**Description:** Crée une nouvelle équipe
**Réponses:**
- ✅ 201: `POST_TEAMS_SUCCESS_RESPONSE`
- ❌ 401: `POST_TEAMS_ERROR_401`
- ❌ 422: `POST_TEAMS_ERROR_422`

## GET_TEAMS_TEAM
**Endpoint:** `get /teams/{team}`
**Description:** Affiche une équipe spécifique
**Réponses:**
- ✅ 200: `GET_TEAMS_TEAM_SUCCESS_RESPONSE`
- ❌ 404: `GET_TEAMS_TEAM_ERROR_404`
- ❌ 401: `GET_TEAMS_TEAM_ERROR_401`

## PUT_TEAMS_TEAM
**Endpoint:** `put /teams/{team}`
**Description:** Met à jour une équipe
**Réponses:**
- ✅ 200: `PUT_TEAMS_TEAM_SUCCESS_RESPONSE`
- ❌ 404: `PUT_TEAMS_TEAM_ERROR_404`
- ❌ 401: `PUT_TEAMS_TEAM_ERROR_401`
- ❌ 422: `PUT_TEAMS_TEAM_ERROR_422`

## DELETE_TEAMS_TEAM
**Endpoint:** `delete /teams/{team}`
**Description:** Supprime une équipe avec toutes ses données associées
**Réponses:**
- ❌ 500: `DELETE_TEAMS_TEAM_ERROR_500`
- ✅ 204: `DELETE_TEAMS_TEAM_SUCCESS_RESPONSE`
- ❌ 404: `DELETE_TEAMS_TEAM_ERROR_404`
- ❌ 401: `DELETE_TEAMS_TEAM_ERROR_401`

## GET_MEMBERS
**Endpoint:** `get /members`
**Description:** Affiche la liste des membres avec filtres
**Réponses:**
- ✅ 200: `GET_MEMBERS_SUCCESS_RESPONSE`
- ❌ 401: `GET_MEMBERS_ERROR_401`

## POST_MEMBERS
**Endpoint:** `post /members`
**Description:** Crée un nouveau membre
**Réponses:**
- ✅ 201: `POST_MEMBERS_SUCCESS_RESPONSE`
- ❌ 401: `POST_MEMBERS_ERROR_401`
- ❌ 422: `POST_MEMBERS_ERROR_422`

## GET_MEMBERS_MEMBER
**Endpoint:** `get /members/{member}`
**Description:** Affiche un membre spécifique
**Réponses:**
- ✅ 200: `GET_MEMBERS_MEMBER_SUCCESS_RESPONSE`
- ❌ 404: `GET_MEMBERS_MEMBER_ERROR_404`
- ❌ 401: `GET_MEMBERS_MEMBER_ERROR_401`

## PUT_MEMBERS_MEMBER
**Endpoint:** `put /members/{member}`
**Description:** Met à jour un membre
**Réponses:**
- ✅ 200: `PUT_MEMBERS_MEMBER_SUCCESS_RESPONSE`
- ❌ 404: `PUT_MEMBERS_MEMBER_ERROR_404`
- ❌ 401: `PUT_MEMBERS_MEMBER_ERROR_401`
- ❌ 422: `PUT_MEMBERS_MEMBER_ERROR_422`
- ❌ 403: `PUT_MEMBERS_MEMBER_ERROR_403`

## DELETE_MEMBERS_MEMBER
**Endpoint:** `delete /members/{member}`
**Description:** Supprime un membre
**Réponses:**
- ✅ 204: `DELETE_MEMBERS_MEMBER_SUCCESS_RESPONSE`
- ❌ 404: `DELETE_MEMBERS_MEMBER_ERROR_404`
- ❌ 401: `DELETE_MEMBERS_MEMBER_ERROR_401`

## GET_TASKS
**Endpoint:** `get /tasks`
**Description:** Affiche la liste des tâches avec filtres
**Réponses:**
- ✅ 200: `GET_TASKS_SUCCESS_RESPONSE`
- ❌ 401: `GET_TASKS_ERROR_401`

## POST_TASKS
**Endpoint:** `post /tasks`
**Description:** Crée une nouvelle tâche
**Réponses:**
- ✅ 201: `POST_TASKS_SUCCESS_RESPONSE`
- ❌ 401: `POST_TASKS_ERROR_401`
- ❌ 422: `POST_TASKS_ERROR_422`

## GET_TASKS_TASK
**Endpoint:** `get /tasks/{task}`
**Description:** Affiche une tâche spécifique
**Réponses:**
- ✅ 200: `GET_TASKS_TASK_SUCCESS_RESPONSE`
- ❌ 404: `GET_TASKS_TASK_ERROR_404`
- ❌ 401: `GET_TASKS_TASK_ERROR_401`

## PUT_TASKS_TASK
**Endpoint:** `put /tasks/{task}`
**Description:** Met à jour une tâche
**Réponses:**
- ✅ 200: `PUT_TASKS_TASK_SUCCESS_RESPONSE`
- ❌ 404: `PUT_TASKS_TASK_ERROR_404`
- ❌ 401: `PUT_TASKS_TASK_ERROR_401`
- ❌ 422: `PUT_TASKS_TASK_ERROR_422`
- ❌ 403: `PUT_TASKS_TASK_ERROR_403`

## DELETE_TASKS_TASK
**Endpoint:** `delete /tasks/{task}`
**Description:** Supprime une tâche
**Réponses:**
- ✅ 204: `DELETE_TASKS_TASK_SUCCESS_RESPONSE`
- ❌ 404: `DELETE_TASKS_TASK_ERROR_404`
- ❌ 401: `DELETE_TASKS_TASK_ERROR_401`

## POST_TASKS_TASK_ASSIGN
**Endpoint:** `post /tasks/{task}/assign`
**Description:** Assigne des membres à une tâche
**Réponses:**
- ✅ 200: `POST_TASKS_TASK_ASSIGN_SUCCESS_RESPONSE`
- ❌ 404: `POST_TASKS_TASK_ASSIGN_ERROR_404`
- ❌ 401: `POST_TASKS_TASK_ASSIGN_ERROR_401`
- ❌ 422: `POST_TASKS_TASK_ASSIGN_ERROR_422`

## DELETE_TASKS_TASK_UNASSIGN
**Endpoint:** `delete /tasks/{task}/unassign`
**Description:** Désassigne des membres d'une tâche
**Réponses:**
- ✅ 200: `DELETE_TASKS_TASK_UNASSIGN_SUCCESS_RESPONSE`
- ❌ 404: `DELETE_TASKS_TASK_UNASSIGN_ERROR_404`
- ❌ 401: `DELETE_TASKS_TASK_UNASSIGN_ERROR_401`
- ❌ 422: `DELETE_TASKS_TASK_UNASSIGN_ERROR_422`

