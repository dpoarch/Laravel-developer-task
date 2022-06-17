import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { NewsletterService } from '../services/newsletter.service';
import { NbComponentStatus, NbGlobalPhysicalPosition, NbToastrService } from '@nebular/theme';
import { SubscribeService } from '../services/subscribe.service';
import { ISubscribe } from '../subscribe/subscribe';

@Component({
  selector: 'app-article',
  templateUrl: './article.component.html',
  styleUrls: ['./article.component.css']
})
export class ArticleComponent implements OnInit {
  positions = NbGlobalPhysicalPosition;

  public subscribers = <ISubscribe[]>{};
  public mySubscription = <ISubscribe>{};
  subscribe = new ISubscribe();
  isAlert = false;
  isEmailSent = "";
  newsletterData : any;
  id: any;
  constructor(private route: ActivatedRoute, private newsletterService: NewsletterService, private service: SubscribeService, private toastrService: NbToastrService) {
      this.id = this.route.snapshot.paramMap.get('id');
      this.getNewsletterById(this.id);
   }

  ngOnInit(): void {
  }

  getNewsletterById(id:any){
    this.newsletterService.getNewsletterById(id).subscribe(res => {
      this.newsletterData = res;
    })
  }

  onSubmit(): void {
    this.subscribe.newsletter_id = this.id;
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
