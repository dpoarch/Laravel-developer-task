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
  constructor(private service: SubscribeService, private route: ActivatedRoute) { }
  subscribe = new ISubscribe();
  public list = <ISubscribe[]>{};
  
  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    this.subscribe.id = id;
    this.subscribe.state = 'active';

    this.service.list(id).subscribe(response => this.list = response);
    
    console.log(this.list);
    this.service.confirmSubscription(this.subscribe).subscribe(res => {
      
    })

    
  }

  getList(){
    
  }

}
