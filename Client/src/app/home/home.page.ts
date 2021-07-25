import { Component } from '@angular/core';
import {TaskService} from '../Services/task.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  public taskList;
  public seconds = 0;
  public taskName: string = null;
  public timerRunning = false;
  private timer;

  constructor(
    public taskService: TaskService,
  ) {}

  ionViewWillEnter() {
    this.getTasksOfDay();
  }

  getTasksOfDay() {

  }

  toggleTimer() {
    this.timerRunning = !this.timerRunning;

    if (this.timerRunning) {
      this.timer = setInterval(() => {
        this.seconds++;
      }, 1000);
    } else {
      clearInterval(this.timer);
      this.taskService.postTask(this.taskName, this.seconds).then((tasks) => {
        this.taskList = tasks;
        this.seconds = 0;
      });
    }
  }
}
