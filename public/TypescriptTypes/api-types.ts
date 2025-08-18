// Types générés automatiquement depuis l'API OpenAPI
// Ne pas modifier manuellement

// Types de base
export interface BaseApiResponse {
  success: boolean;
  message: string;
}

export interface ApiSuccessResponse<T = any> extends BaseApiResponse {
  success: true;
  data: T;
}

export interface ApiErrorResponse extends BaseApiResponse {
  success: false;
}

// Interfaces des ressources
export interface EquipeResource {
  id: number;
  name: string;
  slug: string;
  created_at: number;
  updated_at: number;
  /** Relations */
  membres?: MembreResource[];
}

export interface MembreResource {
  id: number;
  full_name: string;
  first_name: string;
  last_name: string;
  email: string;
  role: string;
  team_id: number;
  joined_at: string;
  created_at: string;
  updated_at: string;
  /** Relations */
  equipe?: EquipeResource;
  created_tasks?: TacheResource[];
  assigned_tasks?: TacheResource[];
}

export interface TacheResource {
  id: number;
  title: string;
  description: string | null;
  due_date: string;
  status: string;
  is_overdue: boolean;
  is_completed: boolean;
  created_by: number;
  created_at: string;
  updated_at: string;
  /** Relations */
  creator?: MembreResource;
  assigned_members?: MembreResource[];
}

// Interfaces des requêtes
export interface AssignTacheRequest {
  member_ids: number[];
}

export interface StoreEquipeRequest {
  name: string;
}

export interface StoreMembreRequest {
  first_name: string;
  last_name: string;
  email: string;
  role: 'manager' | 'developer' | 'designer' | 'tester';
  team_id: number;
  joined_at?: string | null;
}

export interface StoreTacheRequest {
  title: string;
  description?: string | null;
  due_date: string;
  status: 'todo' | 'in_progress' | 'done';
  created_by: number;
  assigned_members?: any[] | null;
}

export interface UpdateEquipeRequest {
  name: string;
}

export interface UpdateMembreRequest {
  first_name?: string;
  last_name?: string;
  email?: string;
  role?: 'manager' | 'developer' | 'designer' | 'tester';
  team_id?: number;
  joined_at?: string | null;
  password?: string | null;
}

export interface UpdateTacheRequest {
  title?: string;
  description?: string | null;
  due_date?: string;
  status?: 'todo' | 'in_progress' | 'done';
  created_by?: number;
  assigned_members?: any[] | null;
}

// Interfaces des endpoints (nomenclature: METHOD_PATH_ACTION)
export interface POST_AUTH_LOGIN_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: {
    user: string;
    token: string;
    token_type: 'Bearer';
  };
}

export interface POST_AUTH_LOGIN_ERROR_422 extends ApiErrorResponse {
  errors: Record<string, string[]>;
}

export interface POST_AUTH_LOGOUT_SUCCESS_RESPONSE extends ApiSuccessResponse {
}

export interface POST_AUTH_LOGOUT_ERROR_401 extends ApiErrorResponse {
}

export interface GET_AUTH_USER_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: {
    user: MembreResource;
  };
}

export interface GET_AUTH_USER_ERROR_401 extends ApiErrorResponse {
}

export interface GET_TEAMSA_SUCCESS_RESPONSE extends ApiSuccessResponse {
}

export interface GET_TEAMS_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: EquipeResource[];
}

export interface GET_TEAMS_ERROR_401 extends ApiErrorResponse {
}

export interface POST_TEAMS_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: EquipeResource;
}

export interface POST_TEAMS_ERROR_401 extends ApiErrorResponse {
}

export interface POST_TEAMS_ERROR_422 extends ApiErrorResponse {
  errors: Record<string, string[]>;
}

export interface GET_TEAMS_TEAM_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: EquipeResource;
}

export interface GET_TEAMS_TEAM_ERROR_404 extends ApiErrorResponse {
}

export interface GET_TEAMS_TEAM_ERROR_401 extends ApiErrorResponse {
}

export interface PUT_TEAMS_TEAM_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: EquipeResource;
}

export interface PUT_TEAMS_TEAM_ERROR_404 extends ApiErrorResponse {
}

export interface PUT_TEAMS_TEAM_ERROR_401 extends ApiErrorResponse {
}

export interface PUT_TEAMS_TEAM_ERROR_422 extends ApiErrorResponse {
  errors: Record<string, string[]>;
}

export interface DELETE_TEAMS_TEAM_ERROR_500 extends ApiErrorResponse {
  errors: string;
}

export interface DELETE_TEAMS_TEAM_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: null;
}

export interface DELETE_TEAMS_TEAM_ERROR_404 extends ApiErrorResponse {
}

export interface DELETE_TEAMS_TEAM_ERROR_401 extends ApiErrorResponse {
}

export interface GET_MEMBERS_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: MembreResource[];
}

export interface GET_MEMBERS_ERROR_401 extends ApiErrorResponse {
}

export interface POST_MEMBERS_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: MembreResource;
}

export interface POST_MEMBERS_ERROR_401 extends ApiErrorResponse {
}

export interface POST_MEMBERS_ERROR_422 extends ApiErrorResponse {
  errors: Record<string, string[]>;
}

export interface GET_MEMBERS_MEMBER_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: MembreResource;
}

export interface GET_MEMBERS_MEMBER_ERROR_404 extends ApiErrorResponse {
}

export interface GET_MEMBERS_MEMBER_ERROR_401 extends ApiErrorResponse {
}

export interface PUT_MEMBERS_MEMBER_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: MembreResource;
}

export interface PUT_MEMBERS_MEMBER_ERROR_404 extends ApiErrorResponse {
}

export interface PUT_MEMBERS_MEMBER_ERROR_401 extends ApiErrorResponse {
}

export interface PUT_MEMBERS_MEMBER_ERROR_422 extends ApiErrorResponse {
  errors: Record<string, string[]>;
}

export interface PUT_MEMBERS_MEMBER_ERROR_403 extends ApiErrorResponse {
}

export interface DELETE_MEMBERS_MEMBER_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: null;
}

export interface DELETE_MEMBERS_MEMBER_ERROR_404 extends ApiErrorResponse {
}

export interface DELETE_MEMBERS_MEMBER_ERROR_401 extends ApiErrorResponse {
}

export interface GET_TASKS_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: TacheResource[];
}

export interface GET_TASKS_ERROR_401 extends ApiErrorResponse {
}

export interface POST_TASKS_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: TacheResource;
}

export interface POST_TASKS_ERROR_401 extends ApiErrorResponse {
}

export interface POST_TASKS_ERROR_422 extends ApiErrorResponse {
  errors: Record<string, string[]>;
}

export interface GET_TASKS_TASK_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: TacheResource;
}

export interface GET_TASKS_TASK_ERROR_404 extends ApiErrorResponse {
}

export interface GET_TASKS_TASK_ERROR_401 extends ApiErrorResponse {
}

export interface PUT_TASKS_TASK_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: TacheResource;
}

export interface PUT_TASKS_TASK_ERROR_404 extends ApiErrorResponse {
}

export interface PUT_TASKS_TASK_ERROR_401 extends ApiErrorResponse {
}

export interface PUT_TASKS_TASK_ERROR_422 extends ApiErrorResponse {
  errors: Record<string, string[]>;
}

export interface PUT_TASKS_TASK_ERROR_403 extends ApiErrorResponse {
}

export interface DELETE_TASKS_TASK_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: null;
}

export interface DELETE_TASKS_TASK_ERROR_404 extends ApiErrorResponse {
}

export interface DELETE_TASKS_TASK_ERROR_401 extends ApiErrorResponse {
}

export interface POST_TASKS_TASK_ASSIGN_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: TacheResource;
}

export interface POST_TASKS_TASK_ASSIGN_ERROR_404 extends ApiErrorResponse {
}

export interface POST_TASKS_TASK_ASSIGN_ERROR_401 extends ApiErrorResponse {
}

export interface POST_TASKS_TASK_ASSIGN_ERROR_422 extends ApiErrorResponse {
  errors: Record<string, string[]>;
}

export interface DELETE_TASKS_TASK_UNASSIGN_SUCCESS_RESPONSE extends ApiSuccessResponse {
  data: TacheResource;
}

export interface DELETE_TASKS_TASK_UNASSIGN_ERROR_404 extends ApiErrorResponse {
}

export interface DELETE_TASKS_TASK_UNASSIGN_ERROR_401 extends ApiErrorResponse {
}

export interface DELETE_TASKS_TASK_UNASSIGN_ERROR_422 extends ApiErrorResponse {
  errors: Record<string, string[]>;
}

