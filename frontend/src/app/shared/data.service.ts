import { Injectable } from '@angular/core';
import { Task } from '../model/task.model';
import { TaskStatus } from '../enum/enum';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class DataService {
  baseUrl: string;
  tasks: Task[] = [];

  constructor(private httpClient: HttpClient) {
    this.baseUrl = 'http://127.0.0.1:8000/api';
  }

  getCategories() {
    return <any>this.httpClient.get(`${this.baseUrl}/categories`);
  }

  getAllTasks() { 
    return <any>this.httpClient.post(`${this.baseUrl}/tasks/all`, {});
  }

  filteredTasks(payload:any) { 
    return <any>this.httpClient.post(`${this.baseUrl}/tasks/filtered`, payload);
  }

  changeSatatus(task:Task) {
    return <any>this.httpClient.put(
      `${this.baseUrl}/tasks/${task.id}/change/status`,
      {
        status: task.status,
      }
    );
  }

 

  addTask(task: Task) {
    return <any>this.httpClient.post(`${this.baseUrl}/tasks`, task);
  }

  updateTask(updatedTask: Task) {
    return <any>(
      this.httpClient.put(`${this.baseUrl}/tasks/${updatedTask.id}`, updatedTask)
    );
  }

  deleteTask(task:Task) {
    return <any>this.httpClient.delete(`${this.baseUrl}/tasks/${task.id}`);
  }
}
