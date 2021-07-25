import { Component } from '@angular/core';
import {TaskService} from '../Services/task.service';
import {HelpersService} from "../Services/helpers.service";

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  public workingDayHours = 0;
  public taskList = [];
  public seconds = null;
  public taskName: string = null;
  public timerRunning = false;
  private timer;

  constructor(
    public taskService: TaskService,
    private helpers: HelpersService
  ) {}

  ionViewWillEnter() {
    this.getTasksOfDay();
  }

  getTasksOfDay() {
    this.taskService.getTasksOfDay().then(data => {
      this.taskList = data;
      this.workingDayHours = this.taskService.workingDayTime(this.taskList);
    });
  }

  toggleTimer() {
    if (!this.taskName) {
      this.helpers.displayToast('Task name can\'t be empty');
      return;
    }

    this.timerRunning = !this.timerRunning;

    if (this.timerRunning) {
      this.seconds = 0;
      this.timer = setInterval(() => {
        this.seconds++;
      }, 1000);
    } else {
      clearInterval(this.timer);

      this.taskService.postTask(this.taskName, this.seconds).then(data => {
        this.taskList = data;
        this.seconds = null;
        this.taskName = null;
        this.workingDayHours = this.taskService.workingDayTime(this.taskList);
      });
    }
  }
}
