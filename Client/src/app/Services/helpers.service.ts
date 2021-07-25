import {Injectable} from '@angular/core';
import {ToastController} from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class HelpersService {

  constructor(
    private toast: ToastController,
  ) {
  }

  async displayToast(message, duration = 2500, color = 'danger') {
    const toast = await this.toast.create({
      message,
      position: 'middle',
      mode: 'ios',
      duration,
      color,
      cssClass: 'toast',
    });
    await toast.present();

    return toast;
  }
}
