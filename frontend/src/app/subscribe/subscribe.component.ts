import { Component, OnInit } from '@angular/core';
import { NbComponentStatus, NbGlobalPhysicalPosition, NbToastrService } from '@nebular/theme';
import { SubscribeService } from '../services/subscribe.service';
import { ISubscribe } from './subscribe';

@Component({
  selector: 'app-subscribe',
  templateUrl: './subscribe.component.html',
  styleUrls: ['./subscribe.component.css']
})
export class SubscribeComponent implements OnInit {
  positions = NbGlobalPhysicalPosition;

  public subscribers = <ISubscribe[]>{};
  public mySubscription = <ISubscribe>{};
  subscribe = new ISubscribe();
  isAlert = false;
  isEmailSent = "";
  constructor(private service: SubscribeService, private toastrService: NbToastrService) { }


  ngOnInit(): void {
  }


  onSubmit(): void {
    this.subscribe.subject = 'Newsletter Subscription';
    this.service.addSubscription(this.subscribe).subscribe(res => {
      console.log(res);
      this.isEmailSent = this.subscribe.email;
      this.isAlert = true;
      this.showToast('success');
    
      this.subscribe.email = "";
      this.subscribe.name = "";
      localStorage.setItem('pendingSubscription', "true");
    })
  }

  showToast(status: NbComponentStatus) {
    this.toastrService.show('Success' || 'Success', ` Your Newsletter Subscription Link has been sent to ${this.isEmailSent}`, { status });
  }

}
