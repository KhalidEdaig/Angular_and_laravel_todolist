import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { DataService } from '../shared/data.service';
@Component({
  selector: 'app-task-add',
  templateUrl: './task-add.component.html',
  styleUrls: ['./task-add.component.css']
})
export class TaskAddComponent implements OnInit {

  @Output() addTaskEventEmitter = new EventEmitter();
  @Input() categories;
  @Input() task;
  taskForm !: FormGroup
  constructor(private formBuilder : FormBuilder,private dataService:DataService) { }

  ngOnInit(): void {
   
    this.taskForm = this.formBuilder.group({
      taskTitle : [this.task ? this.task.title :"", [Validators.required]],
      category_id : [this.task ? this.task.category_id :"", [Validators.required]]
    });
   
   
  }
  ngOnChanges() {
    // this.taskForm = this.formBuilder.group({
    //   taskTitle : [this.task ? this.task.title :"", [Validators.required]],
    //   category_id : [this.task ? this.task.category_id :"", [Validators.required]]
    // });
}

  onKeyPress($event){
    if(this.taskForm.valid){
      this.addTaskEventEmitter.emit(this.taskForm.value);
      this.taskForm.patchValue({
        taskTitle : '',
        category_id : ''
      })
    }
  }

}