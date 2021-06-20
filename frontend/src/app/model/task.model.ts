import { TaskStatus } from '../enum/enum';
export class Task {
  id?: number;
  constructor(
    public title: string,
    public status: TaskStatus = TaskStatus.Active,
    public category_id: number
  ) {}
}
