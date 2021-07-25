import { Injectable } from '@angular/core';
import {ApiService} from './api.service';
import {HelpersService} from './helpers.service';

@Injectable({
  providedIn: 'root'
})
export class TaskService {

  constructor(
    private api: ApiService,
    private helpers: HelpersService,
  ) {
  }

  async getTasksOfDay() {
    const endpoint = '/task';

    return await this.api.get(endpoint)
      .then(data => data as [])
      .catch(err => {
        if (/Resource not found/.test(err)) {
          this.helpers.displayToast('Empty task list');
        } else {
          throw err;
        }
        return [];
      });
  }

  async postTask(name, duration) {

    const body = {
      name,
      duration
    };

    return await this.api.post('/task', body)
      .then((data) => {
        this.helpers.displayToast('Ok', 1000, 'success');
        return data as [];
      });
  }

  workingDayTime(taskList) {
    let totalWorkingDayTime = 0;
    taskList.each(task => {
      totalWorkingDayTime += task.duration;
    });

    return Math.round(totalWorkingDayTime / 360) / 10;
  }
}
