import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { SubscribeService } from '../services/subscribe.service';
import { ISubscribe } from '../subscribe/subscribe';

@Component({
  selector: 'app-redirect',
  templateUrl: './redirect.component.html',
  styleUrls: ['./redirect.component.css']
})
export class RedirectComponent implements OnInit {
  public routeSub: any;
  public subscribeData = new ISubscribe;
  constructor(private service: SubscribeService, private route: ActivatedRoute) { }

  ngOnInit(): void {
    const email = this.route.snapshot.paramMap.get('email');
    const news_id = this.route.snapshot.paramMap.get('news_id');

    this.subscribeData.newsletter_id = news_id;
    this.subscribeData.email = email;
    this.subscribeData.state = 'active';
    console.log(this.subscribeData);
    this.service.confirmSubscription(this.subscribeData).subscribe(res => {
      console.log(res);
    })
  }

}
