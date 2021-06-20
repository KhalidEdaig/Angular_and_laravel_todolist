import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { Task } from '../model/task.model';
import { DataService } from '../shared/data.service';

@Component({
  selector: 'app-task-list',
  templateUrl: './task-list.component.html',
  styleUrls: ['./task-list.component.css'],
})
export class TaskListComponent implements OnInit {
  @Input() tasks;
  @Output() editTaskEventEmitter = new EventEmitter();
  constructor(private dataService: DataService,) {}

  ngOnInit(): void {

  }

  filteredTasks(status?:string) {
    if(status==='Done' || status==='Active'){
      status=status
    }
    this.dataService.filteredTasks({status}).subscribe((response) => {
      this.tasks=response.payload
    });
  }
  changeStatus(task: Task) {
    this.dataService.changeSatatus(task).subscribe((response) => {
      const index=this.tasks.findIndex((task)=> task.id===response.payload.id)
      this.tasks.splice(index,1,response.payload);
    });
  }
  updateTask(task: Task) {
    this.dataService.changeSatatus(task).subscribe((response) => {
      const index=this.tasks.findIndex((task)=> task.id===response.payload.id)
      this.tasks.splice(index,1,response.payload);
    });
  }
  
  deleteTask(taskToDelete:Task) {
    this.dataService.deleteTask(taskToDelete).subscribe(() => {
      const index=this.tasks.findIndex((task)=> task.id===taskToDelete.id)
      this.tasks.splice(index,1);
    });
  }

  editTask(task:Task){
  this.editTaskEventEmitter.emit(task)
  }

}