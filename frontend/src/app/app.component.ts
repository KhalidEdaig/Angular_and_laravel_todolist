import { Component } from '@angular/core';
import { Task } from '../app/model/task.model';
import { TaskStatus } from '../app/enum/enum';
import { DataService } from './shared/data.service';
import { Category } from './model/Category.model';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent {
  title = 'todo-app';

  tasks: Task[];
  task?:Task;
  categories: Category[];
  query:string
  constructor(private dataService: DataService) {
    this.categories = [];
    this.tasks = [];
    this.query=''
  }

  ngOnInit(): void {
    this.dataService.getAllTasks().subscribe((response) => {
      this.tasks=response.payload
    });
    this.dataService.getCategories().subscribe((response) => {
      this.categories=response.payload
    });
    
  }

  search(query){
    if(query)
    this.dataService.filteredTasks({query}).subscribe((response) => {
      this.tasks=response.payload
    });
  }

  addTaskEventEmitter($event: any) {
    this.dataService
      .addTask(
        new Task($event.taskTitle, TaskStatus.Active, $event.category_id)
      )
      .subscribe((response) => {
        this.tasks.push(response.payload);
      });
  }

  editTaskEventEmitter($event:any){
    this.task=$event
  }
}
